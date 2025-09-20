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
        if($this->real['isapi']!=1)$this->redirect(url('home/Account/actrealname'));
		if ($this->request->isPost()){
		    $data=input();
			try{
				$this->validate($data, 'account.checkapi');
            }catch (\Exception $e){
				$str=$e->getMessage();
				$res=getArr($str);
				return json(["tip"=>$res[0],"content"=>$res[1],'token'=>token()]);
            }
			$res=realName($data['idcard'],$data['username']);
			if($res['status']!="01"){
				return json(["tip"=>"#idcard","content"=>$res['msg'],'token'=>token()]);
				exit;
			}
			$map['shopid']=session('user_auth.shop_id');
			$map['name']=$data['username'];
			$map['retype']=1;
			$map['clas']=1;
			$map['idcard']=$data['idcard'];
			$find=UserAuth::where(['shopid'=>session('user_auth.shop_id')])->find();
			if($find){
				if($find['retype']!=4){
					return json(["tip"=>"#anjian","content"=>"非法操作记录数据库"]);
				    exit;
				}else{
				  $find->save($map);
				}
			}else{
			   $ok=UserAuth::create($map);
			}
			return json(['confirm'=>['name'=> "实名认证成功！", 'width'=>400, 'prompt'=> "success",'time'=>1,'url'=>'/user_realname.html'],'content'=>'操作成功....']);
		}
		if(request()->isMobile()){
			return view('account/wap/alireal',['title'=>"实名认证"]);
		}else{
		   return view('alireal');
		}
		
	}
	
	public function actrealname(){
		if ($this->request->isPost()){
		    $data=input();
			try{
				$this->validate($data, 'account.checkpic');
            }catch (\Exception $e){
				$str=$e->getMessage();
				$res=getArr($str);
				return json(["tip"=>$res[0],"content"=>$res[1],'token'=>token()]);
            }
			$map['shopid']=session('user_auth.shop_id');
			$map['name']=$data['username'];
			$map['retype']=3;
			$map['hastype']=1;
			$map['clas']=1;
			$map['idcard']=$data['idcard'];
			$map['positive_img']=$data['idjust'];
			$map['back_img']=$data['idback'];
			$map['hand_img']=$data['license'];
			$find=UserAuth::where(['shopid'=>session('user_auth.shop_id')])->find();
			if($find){
				if($find['retype']!=4){
					return json(["tip"=>"#anjian","content"=>"非法操作记录数据库"]);
				    exit;
				}else{
				  $find->save($map);
				}
			}else{
			  $ok=UserAuth::create($map);
			}
			return json(['confirm'=>['name'=> "提交认证成功！", 'width'=>400, 'prompt'=> "warning",'time'=>1,'url'=>'/user_realname.html'],'content'=>'等待认证审核...']);
		}
		View::assign("da",UserAuth::where(['shopid'=>$this->user['shopid']])->find());
		if(request()->isMobile()){
			return view('account/wap/actrealname',['title'=>"实名认证"]);
		}else{
		   return view();
		}
		
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
