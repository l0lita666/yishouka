<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use think\facade\View;
use think\facade\Request;
use app\common\model\Banks;


class Bank extends AdminBase
{
    protected function _initialize()
    {
        parent::_initialize();
    }

    public function index($limit=15)
    {
		if ($this->request->isAjax()){
			$name=input('shop_id');
			if($name){
			    $list = Banks::where('bankName','like',"%".$name."%")->order('id desc')->paginate($limit);
			}else{
				$list = Banks::order('id desc')->paginate($limit);
			}
			$this->result($list);
		}
        return $this->fetch('index');
    }

    public function add()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            $result = Banks::create($param);
            if ($result == true) {
                $this->success('添加成功',url('/Bank/index'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        return $this->fetch('save');
    }

    public function edit()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
			$id=$param['id'];
			unset($param['id']);
			unset($param['_verify']);
            $data = Banks::where(['id'=>$id])->update($param);
            if ($data == true) {
                $this->success('修改成功', url('/Bank/index'));
            } else {
                $this->error($this->errorMsg);
            }
        }
        $data = Banks::where(['id'=>input('id')])->find();
        return view('save', [
            'data' => $data]);
    }

    public function del()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            Banks::destroy($param['id'],true);
            $this->success('删除成功');
        }
    }
    
}
