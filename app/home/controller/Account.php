<?php
declare (strict_types = 1);

namespace app\home\controller;

use think\facade\Request;
use think\facade\View;
use app\common\controller\UserBase;
use app\common\model\UserAuth;
use app\common\model\Uploads as UploadsModel;
use think\facade\Config;
use think\facade\Filesystem;

class Account extends UserBase
{
     public function initialize()
     {
        parent::initialize();
		$action=Request::action();
		if(($this->user['userReal']['retype']!=0 && $this->user['userReal']['retype']!=4 && input('cz')!='toset') && ($action!="enterprise" && $action!='uploadImage')){
			$this->redirect(url('home/Member/realname'));
		}
	 }

    public function index(){
        // 重定向到新的简易认证页面
        $this->redirect(url('home/SimpleAuth/index'));
	}
	
	public function actrealname(){
        // 重定向到新的简易认证页面
        $this->redirect(url('home/SimpleAuth/index'));
	}
	
	//上传图片
    public function uploadImage()
    {
        try{
			$files = request()->file();			
			foreach($files as $k=>$v){
				validate([$k=>'fileSize:1000240|fileExt:jpg,png|hex:1'])->check($files);
			}
				$file = request()->file('image');
				//处理图片
				UploadsModel::UploadValidate($file);
				$params = Config::load('setting/qiniu','qiniu');
				//判断上传位置
				if($params['type']=='1'){//七牛
					$key = 'shop_'.UserId().'/'.date('Y/md/His_').substr(microtime(), 2, 6).'_'.mt_rand(0,999).'.'.$file->getOriginalExtension();
					$qiniu = new \app\common\library\Qiniu();
					$url = $params['domain'].$qiniu->upload($file->getRealPath(), $key);
					UploadsModel::CreateInfo('qiniu',$params['domain'], $key, $file->getSize(), $file->getOriginalMime());
					$result['code'] = 0;
					$result['info'] = '图片上传成功!';
					$result['imgurl']=  $url;
					return json($result);
				}else{//默认本地
					$savename = Filesystem::disk('public')->putFile('uploads/shop_'.UserId(),$file);
					$url = '/'.$savename;
					UploadsModel::CreateInfo('local','', $savename, $file->getSize(), $file->getOriginalMime());
					$result['code'] = 0;
					$result['info'] = '图片上传成功!';
					$result['imgurl']=  $url;
					return json($result);
				}
			
        }catch (\Exception $e) {
            return json(['code' => 0, 'info' => $e->getMessage()]);
        }
    }
	
	public function enterprise(){
		if($this->user['userReal']['retype']!=1){
			$this->redirect(url('home/Member/index'));
		}
       if ($this->request->isPost()){
		    $data=input();
			try{
				$this->validate($data, 'account.checkqiye');
            }catch (\Exception $e){
				$str=$e->getMessage();
				$res=getArr($str);
				return json(["tip"=>$res[0],"content"=>$res[1],'token'=>token()]);
            }
			
			$find=UserAuth::where(['shopid'=>session('user_auth.shop_id')])->update(['company_name'=>$data['company_name'],'canada'=>$data['canada'],'canada_img'=>$data['canada_img'],'retype'=>3,'clas'=>2,'hastype'=>1]);
			if($find){
				return json(['confirm'=>['name'=> "提交认证成功！", 'width'=>400, 'prompt'=> "warning",'time'=>1,'url'=>'/user_realname.html'],'content'=>'等待认证审核...']);
				   
			}else{
			  return json(["tip"=>"#anjian","content"=>"参数错误",'token'=>token()]);
			}
	   }	
	   View::assign("da",UserAuth::where(['shopid'=>$this->user['shopid']])->find());
        if(request()->isMobile()){
			return view('account/wap/enterprise',['title'=>"企业认证"]);
		}else{
		   return view();
		}	   
	}
	
	
}
