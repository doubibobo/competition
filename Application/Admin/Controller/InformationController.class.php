<?php
/**
 * Created by PhpStorm.
 * User: doubibobo
 * Date: 17-3-10
 * Time: 下午7:50
 */

namespace Admin\Controller;
use Think\Controller;

class InformationController extends Controller {
    /*
     * 方法功能：进行初始化操作操作，判断用户是否已经登录
     * */

    /*
     * 方法功能：跳转到添加通告界面
     * */
    public function addInformation() {

    }

    /*
     * 方法功能：执行添加通告方法
     * */
    public function doAddInformation() {
        $title = I('post.title');
        if (empty($title)) {
            alert("the title can not be null!");
            exit();
        }
        $content = I('post.content');
        if (empty($content)) {
            alert("the content can not be null");
            exit();
        }
        $userid = session("valid_userid");
        $n = M("Information");
        $date = date('Y-m-d');
        $data['title'] = $title;
        $data['content'] = htmlspecialchars_decode($content);
        // $data['userid'] = $userid;
        $data['userid'] = 111;
        $data['date'] = $date;
        $result = $n -> add($data);
        if ($result) {
            $data = array(
                'code'=>'0',
                'id'=>$id
            );
            echo json_encode($data);
        } else {
            alert("the add is wrong! please try again!");
            exit();
        }

    }
    /*
     * 方法功能：删除通告
     * */
    public function deleteInformation() {
        $id = I('get.id');
        $n = M("Information");
        $result = $n -> where("id = $id") -> delete();
        if ($result) {
            $this -> redirect("Admin/Information/index");
        } else {
            alert("delete is wrong, please try again!");
            exit();
        }
    }

    /*
     * 方法功能：跳转到修改通告界面
     * */
    public function updateInformation() {
        $id = I('get.id');
        $result = M("Information") -> where("id = $id") -> find();
        $this -> title = "edit";
        $this -> assign("data", $result);
        $this -> display();
    }

    /*
     * 方法功能：执行通告的修改
     * */
    public function doUpdateInformation() {
        $id = I("post.id");
        $n = M("Information");
        $data['title'] = trim(I("post.title"));
        $data['content'] = htmlspecialchars_decode(trim(I("post.content")));
        $result = $n -> where("id=$id") -> data($data) -> save();
        if ($result) {
            $data = array(
                'code' => '0',
                'id' => $id
            );
            echo json_encode($data);
        } else {
            alert("Something must be wrong in your edit");
            exit();
        }
    }
    
    /*
     * 方法功能：查询所有通告
     * */
    public function index() {
        $n = M("Information");
        $arr = $n -> select();
        $this -> title = "通知公告";
        $this -> assign("data", $arr);
        $this -> display();
    }
}