<?php
	namespace Admin\Controller;
	use Think\Controller;
	/*
	 * 类功能：进行值班人员信息的导入，包括时间
	 */
	class MemberController extends Controller {
	    /*
	     *  查询方法：人员信息展示
	     * */
	    public function selectMember() {

        }
		/*
		 *	添加方法：人员添加表单
		 */
		public function addMember() {
			$this->title="添加人员";
			$this->display();
		}
		/*
		 *	添加方法：执行人员添加的操作
		 */
		public function doAddMember() {
			$limit_count = $this -> exam($_POST);
			$n=M('Member');
			$data['name'] = trim(I('post.name'));
			$data['rules'] = trim(I('post.rules'));
			$data['limit_count']=$limit_count;
			$data['description']=trim(I('post.description'));
			$data['phone'] = trim(I('post.phone'));
			$data['email'] = trim(I('post.email'));
			$data['other'] = trim(I('post.other'));
			$data['class1'] = trim(I('post.class1'));

			$result=$n -> add($data);
			if($result) {
				$this->success('添加成功!');
			} else {
				$this->error('添加失败,请稍后再试!');
			}
		}
		/*
		 * 删除方法：删除人员信息
		 * */

		public function deleteMember() {
			$id = $_GET['id'];
			$n = M("Member");
			$result = $n -> where("id = $id") -> delete();
			if ($result) {
				$this -> success("删除成功");
			} else {
				$this -> error("删除失败");
			}
        }
		/*
		 * 修改方法：跳转到修改人员信息界面
		 * */
		public function updateMember() {
			$id = $_GET['id'];
			$n = M("Member");
			$result = $n -> where("id = $id") -> find();
			$this -> title = "修改信息";
			$this -> assign("data", $result);
			$this -> display();
        }
		/*
		 * 修改方法：执行修改人员信息的操作
		 * */
		public function doUpdateMember() {
			$n = M("Member");
			$id = trim(I('post.id'));
			$this -> exam($_POST);
			$n -> name = trim(I("post.name"));
			$n -> class1 = trim(I("post.class1"));
			$n -> rules = trim(I("post.rules"));
			$n -> limit_count = trim(I("post.limit_count"));
			$n -> description = trim(I("post.description"));
			$n -> phone = trim(I("post.phone"));
			$n -> email = trim(I("post.email"));
			$n -> other = trim(I("post.other"));
			$n -> createtime = date("Y-m-d");
			$result = $n -> where("id = $id") -> save();
			if ($result) {
				$this -> redirect("Member/contact");
			} else {
				$this -> error("修改失败");
			}
        }
        /*
         * 联系方式的展示
         * */
        public function contact() {
        	$n = M("Member");
        	$result = $n -> where("id != 0") -> select();
        	$this->title = "联系方式";
        	$this -> assign("data", $result);
        	$this -> display();
        }

        /*
         * 联系方式的修改
         * */


        /*
         * 联系方式的删除
         * */

        /*
         * 导入表格信息
         * */
	   	public function excel(){
	        $tableName="member";
	        $title=array("name","rules","limit_count","description", "phone", "email", "class1", "other");
	        $result=importExcel($tableName,$title);
	        $this->success($result);
	    }

        /*
         * 导出表格信息
         * */
        public function export() {
	    	$n = M('Member');
			$query = "select name, class1, other, phone, email from tp_member";
			$data = $n -> query($query);
			$subject = "人员信息";
			$title = array('姓名', '班级', '类别', '电话', '邮箱');
			exportExcel($data,$title,$subject);
	    }
	    /*
		 * 判断姓名、值班时间段、电话、邮箱是否符合规则
		 * */
	    private function exam($value) {
	    	$name = trim($value['name']);
	    	$rules = trim($value['rules']);
	    	$limit_count = trim($value['limit_count']);
	    	$phone = trim($value['phone']);
	    	$email = trim($value['email']);
	    	$class1 = trim($value['class1']);
			
			if($name == '') {
				$this -> error('姓名不能为空!');
			}
			if(!valid_rules($rules)) {
				$this -> error('值班时间段不符合规则!');
			}
			if(!valid_phone($phone)) {
				$this -> error('电话格式错误!');
			}

			if(!valid_email($email)) {
				$this -> error('邮箱格式错误!');
			}
			if($class1 == '') {
				$this -> error('班级不能为空');
			}

			if($limit_count==''||$limit_count<0) {
				$limit_count=-1;
			}

			return $limit_count;
	    }

        /**
         * 此方法用于测试表格的导出
         */
        public function export1() {
            $n = M('Member');
            $query = "select name, rules, limit_count, description, createtime, phone, email, class1, other from tp_member";
            $data = $n -> query($query);
            $subject = "所有信息";
            $title = array("name","rules","limit_count","description", "createtime", "phone", "email", "class1", "other");
            exportExcel($data,$title,$subject);
        }
	}