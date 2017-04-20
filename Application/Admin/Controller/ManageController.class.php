<?php
/**
 * Created by PhpStorm.
 * User: doubibobo
 * Date: 17-3-10
 * Time: 下午7:58
 */
namespace Admin\Controller;
use Think\Controller;
/*
 * 模块功能：进行所安排的值班人员的展示，查询，导出excel表格或者Word文档作为值班安排
 * */
class ManageController extends Controller {
    /*
     * 方法功能：进行所安排的值班人员的展示
     * */
    public function index() {
        $n = D("Setted");
        $member = M("Member");
        // 此处进行关联查询
        $allSetted = $n->relation(true)->select();
        for ($i = 0; $i < count($allSetted); $i++) {
            $allSetted[$i]['period'] = explode(";", $allSetted[$i]['period']);
            $allSetted[$i]['date'] = explode(";", $allSetted[$i]['date']);
            $allSetted[$i]['dateCount'] = count($allSetted[$i]['date']);
            for ($j = 0; $j < count($allSetted[$i]['allDevice']); $j++) {
                $select_device = $allSetted[$i]['allDevice'][$j]['select_device'];
                $allSetted[$i]['allDevice'][$j]['memberName'] = $member->where("id=$select_device")->getField("name");
            }
        }

        $this -> date = date("Y-m-d");
        $this -> title = "值班概览";

        $this->assign("allSetted", $allSetted);
        $this->display();
    }

    /*
     * 方法功能：删除某种值班安排
     */
    public function deleteSetted() {

    }
    
    /*
     * 方法功能：查看某人的值班信息，根据姓名字段
     * */
    public function searchMemberSomething() {

    }

    /*
     * 方法功能：工作人员的安排查询
     * */
    public function searchWorkSomething() {

    }

    /*
     * 方法功能：导出Word文档
     * */
    public function importWord() {

    }

    /*
     * 方法功能：导出excel表格
     * */
    public function importExcel() {

    }

}