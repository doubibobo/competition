<?php
/**
 * Created by PhpStorm.
 * User: doubibobo
 * Date: 17-3-4
 * Time: 下午2:46
 */
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
    public function index() {
        $title = "用户注册";
        $this -> title = $title;
        $this -> display();
    }
    /*
     * the function is used to do register
     */
    public function doRegister() {
        $data['userid'] = trim(I('post.userid'));
        $data['username'] = trim(I('post.username'));
        $data['useremail'] = trim(I('post.useremail'));
        $data['userphone'] = trim(I('post.userphone'));
        $data['realname'] = trim(I('post.realname'));
        $data['userpass'] = md5(trim(I('post.userpass')));
        $data['create_time'] = date('Y-m-d');
        $data['isadmin'] = 0;
        $repass = trim(I('post.repass'));
        if(empty($data['userid']) || !valid_userid($data['userid'])) {
            alert("ERROR!", "账号不能为空或者账号非法");
            exit();
        }
        if(empty($data['username'])) {
            alert("ERROR!","用户名不能为空");
            exit();
        }
        if(empty($data['useremail']) || !valid_email($data['useremail'])) {
            alert("ERROR!","邮箱不能为空或者格式错误");
            exit();
        }
        if(empty($data['userphone']) || !valid_phone($data['userphone'])) {
            alert("ERROR!","电话号码不能为空或者格式错误");
            exit();
        }
        if(empty($data['userpass']) || !valid_passwd($data['userpass'])) {
            alert("ERROR!", "密码不能为空或者格式错误");
            exit();
        }
        if (md5($repass) !== $data['userpass']) {
            alert("ERROR!", "两次密码输入不一致");
            exit();
        }
        //	create a new records
        $n = M("User");
        $query = "SELECT * FROM tp_user WHERE userid = ".$data['userid']."";
        $result = $n -> query($query);
        if(!empty($result)) {
            alert("ERROR!", "账号已经存在");
            exit();            
        }
        $n -> create($data);
        $result = $n -> add();
        if ($result) {
        	// $this -> display('Index/index');
        	// redirect is used to the funciton, not the view.
        	$this -> redirect('Index/index');
        } else {
        	$this -> error("register error!");
        }
    }
    /*
     * the function is used to show login
     */
    public function showLogin() {
    	$this -> title = " 用户登录";
    	$this -> display();
    }
    /*
     * the function is used to login and set session
     */
    public function doLogin() {
    	$userid = trim(I('post.userid'));
        $userpass = trim(I('post.userpass'));
        if(empty($userid) || empty($userpass)) {
            alert("ERROR!", "The userid and  the userpass must be written!");
            exit();
        }
        $n = M("User");
        $result = $n -> where("userid = $userid") -> find();
        if($result) {
            $pass = $result['userpass'];
            if(md5($userpass) == $pass) {
                session("userid", $result['userid']);
                session("username", $result['username']);
                session("isadmin", $result['isadmin']);
                $this -> title = "The home";
                $this -> redirect("Index/index");
            } else {
                alert("ERROR!", "The password is false!");
                exit();
            }
        }
    }
    /*
     * the function is used to logout and reset session
     */
    public function doLogout() {
        if (session('?userid')) {
            $username=session('username');
            session(null);
            session('[destroy]');
            $this->success('用户'.$username.'退出成功',U('Home/Index/index'));
        } else { 
            $this->error('你尚未登陆!',U('Home/Index/index'));
        }
    }
}  