<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
	/*
	 * 前置方法，判断管理员是否已经登录
	 */
	// public function __initialize() {
	// 	if (session('?valid_user')) {
	// 		if(session('isadmin')) { 

	// 		} else {
	// 			$this->error('用户'.session('valid_user').'没有管理员权限!');
	// 		}
	// 	}		
	// }

    /**
     * 用来提供数据的测试
     * 2017年4月19日22点51分将index3替换index成为主方法，index则替换为index3
     */
    public function index() {
        $member = M("Member");
        $n = D("Setted");
        $m = M("Device");
        $allSetted = $n->relation(true)->select();
        for ($i = 0; $i < count($allSetted); $i++) {
            $allSetted[$i]['period'] = explode(";", $allSetted[$i]['period']);
            $allSetted[$i]['date'] = explode(";", $allSetted[$i]['date']);
            $allSetted[$i]['dateCount'] = count($allSetted[$i]['date']);
            for ($j = 0; $j < count($allSetted[$i]['allDevice']); $j++) {
                $select_device = $allSetted[$i]['allDevice'][$j]['select_device'];
                $allSetted[$i]['allDevice'][$j]['memberName'] = $member->where("id=$select_device")->getField("name");

                //  进行某个时段可以值班的人和不可以值班的人的查询
                $search['rules'] = array('like', "%".$allSetted[$i]['allDevice'][$j]['period']."%");
                $searchNo['rules'] = array("NOTLIKE", "%".$allSetted[$i]['allDevice'][$j]['period']."%");
                $allSetted[$i]['allDevice'][$j]['allPeopleIn'] = $member->where($search)->select();
                $theFirst = $member->where("id=0")->select();
                array_unshift( $allSetted[$i]['allDevice'][$j]['allPeopleIn'], $theFirst[0]);
                $allSetted[$i]['allDevice'][$j]['allPeopleNotIn'] = $member->where($searchNo)->select();
                array_shift($allSetted[$i]['allDevice'][$j]['allPeopleNotIn']);

                // 针对上述可值班和不可值班的人进行此数是否符合要求的判断
                for ($k = 0; $k < count($allSetted[$i]['allDevice'][$j]['allPeopleIn']); $k++) {
                    $id = $allSetted[$i]['allDevice'][$j]['allPeopleIn'][$k]['id'];
                    $theLimitTime = $allSetted[$i]['allDevice'][$j]['allPeopleIn'][$k]['limit_count'];
                    $theData = $member -> where("id=$id") -> select();
                    $count = $m->where("$id = select_device")->count();
                    if (self::timeIsOrNot($count, $theLimitTime)) {

                    } else {
                        $allSetted[$i]['allDevice'][$j]['allPeopleIn'] = self::deleteElements($allSetted[$i]['allDevice'][$j]['allPeopleIn'], $theData[0]);
                        array_unshift($allSetted[$i]['allDevice'][$j]['allPeopleNotIn'], $theData[0]);
                    }
                }
            }
        }
        $this -> date = date("Y-m-d");
        $this -> title = "首页";

        $this->assign("all_member_rest", $allSetted);
        $this->assign("all_member_lists", $allSetted);
        $this->assign("allSetted", $allSetted);
        $this->display();
    }

    /*
     * 方法功能：添加值班事项
     */
    public function addMatter() {
        $n = M("Setted");
        $data['date'] = I(trim('post.date'));
        $data['period'] = I(trim('post.period'));
        $data['create_time'] = date("Y-m-d h:i:s");
        $data['address'] = I(trim('post.address'));
        $result = $n -> add($data);
        self::addFormerSet($data, $result);
        if ($result) {
            alert("设置成功!");
        } else {
            alert("设置失败");
            exit();
        }
    }

    /**
     * 方法功能：删除值班事项
     */
    public function deleteMatter() {

    }
    /**
     *  方法功能：修改值班事项
     */

    /**
     * @param $data
     * 方法功能：为每一个值班任务预先确定人选，默认为空
     */
    public function addFormerSet($data, $sid) {
        $allinfor = M("Device");
        // 首先对数据$data['date']进行过滤提取，存放在$allDateRules中,$allDateRules是一个数组
        $allDateRules = explode(';', $data['date']);
        // 其次岁数据$data['period']进行过滤提取，存放在$allPeriodRules中，$allPeriodRules是一个数组
        $allPeriodRules = explode(';', $data['period']);
        $allAddressRules = $data['address'];
        // 添加值班安排的准备数组
        $manage = array();

        for ($i = 0; $i < count($allPeriodRules); $i++) {
            for ($j = 0; $j < count($allDateRules); $j++) {
                $manage['period'] = $allPeriodRules[$i];
                $manage['date'] = $allDateRules[$j];
                $manage['address'] = $allAddressRules;
                $manage['select_device'] = 0;
                $manage['sid'] = $sid;
                $result = $allinfor->add($manage);
                if (!$result) {
                    alert("设置失败");
                }
            }
        }
    }

    /*
     * 函数功能：增加值班安排
     */
    public function doSet() {
        $id = $_POST['deviceId'];
        $memberName = $_POST['memberName'];
        $m = M("Device");
        $m -> select_device = $memberName;
        $result = $m -> where("id = $id") -> save();
        if ($result) {
            $this->redirect("index");
        } else {
            $this -> error("安排失败");
        }
    }

    /**
     * 判断值班次数是否超过限制
     * @param $count
     * @param $limits
     * @return bool
     */
    private function timeIsOrNot($count, $limits) {
        if ($count < $limits) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 删除数组中的某一个元素
     * @param $data
     * @param $element
     * @return mixed
     */
    private function deleteElements($data, $element) {
        $key = array_search($element, $data);
        if ($key !== false) {
            array_splice($data, $key, 1);
        }
        return $data;
    }

    /*
    * 方法功能：首页展示排版的情况（如本次需要安排的值班时间、值班地点等）
    */

    public function index1(){
        $date = I(trim(date("Y-m-d")));
        $n = M("setted");
        $all_the_rules = $n -> select();
        $count_set_rules = $n -> count();

        for ($i = 0; $i < $count_set_rules; $i++) {
            $all_the_rules[$i]['period'] = explode(';', $all_the_rules[$i]['period']);
            $all_the_rules[$i]['date'] = explode(';', $all_the_rules[$i]['date']);
        }
//      设立相应的值班规则，利用字符串处理函数进行设定


        $all_member = M("Member");
        $all_member_lists = $all_member -> select();
        $count = $all_member -> count();

        $m = M("Device");

        for ($i = 0, $j = 0; $i < $count; $i++) {
            $id = $all_member_lists[$i]['id'];
            $limit_times = $all_member_lists[$i]['limit_count'];
            $max_time = $m -> where("select_device = $id") ->count();
            if ($max_time < $limit_times) {
                $all_member_lists_things[$j]['id'] = $id;
                $all_member_lists_things[$j]['name'] = $all_member -> where("id = $id") ->getField("name");
                $j++;
            }
        }
        $all_setted = $m -> select();
        $all_setted_count = $m -> count();
        for ($i = 0; $i < $all_setted_count; $i++) {
            $id = $all_setted[$i]['select_device'];
            $all_setted[$i]['name'] = $all_member -> where("id = $id") -> getField('name');
        }

        $this -> date = date("Y-m-d");
        $this -> title = "安排值班";
        $this -> assign("name", $all_member_lists_things);
        $this -> assign("all_the_rules", $all_the_rules);
        $this -> assign("all_setted", $all_setted);
        $this -> assign("all_setted_count", $all_setted_count);
        $this -> display();
    }

    /**
     * 用来提供数据的测试2
     */
    public function index2() {
        $member = M("Member");
        $m = M("Device");
        $n = D("Setted");
        // 此处进行关联查询
        $allSetted = $n->relation(true)->select();

        for ($i = 0; $i < count($allSetted); $i++) {
            $allSetted[$i]['period'] = explode(";", $allSetted[$i]['period']);
            $allSetted[$i]['date'] = explode(";", $allSetted[$i]['date']);
            $allSetted[$i]['dateCount'] = count($allSetted[$i]['date']);
            for ($j = 0; $j < count($allSetted[$i]['allDevice']); $j++) {
                $select_device = $allSetted[$i]['allDevice'][$j]['select_device'];
                $allSetted[$i]['allDevice'][$j]['memberName'] = $member->where("id=$select_device")->getField("name");
                //  进行某个时段可以值班的人和不可以值班的人的查询
                $search['rules'] = array('like', "%".$allSetted[$i]['allDevice'][$j]['date']."%");
                $searchNo['rules'] = array("NOTLIKE", "%".$allSetted[$i]['allDevice'][$j]['date']."%");
                $allSetted[$i]['allDevice'][$j]['allPeopleIn'] = $member->where($search)->select();
                $allSetted[$i]['allDevice'][$j]['allPeopleNotIn'] = $member->where($searchNo)->select();
                var_dump(count($allSetted[$i]['allDevice'][$j]['allPeopleIn']));
                for ($k = 0; $k < count($allSetted[$i]['allDevice'][$j]['allPeopleIn']); $k++) {
                    $id = $allSetted[$i]['allDevice'][$j]['allPeopleIn'][$k]['id'];
                    $theLimitTime = $allSetted[$i]['allDevice'][$j]['allPeopleIn'][$k]['limit_count'];
                    var_dump($id);
                    var_dump($theLimitTime);
                    $theData = $member -> where("$id = id") -> select();
                    $count = $m->where("$id = sid")->count();
                    if (self::timeIsOrNot($count, $theLimitTime)) {

                    } else {
                        self::deleteElements($allSetted[$i]['allDevice'][$j]['allPeopleIn'], $theData);
                        array_unshift($allSetted[$i]['allDevice'][$j]['allPeopleIn'], $theData);
                    }
                }
            }
        }
//        var_dump($allSetted[0]['allDevice']);
    }

    /**
     * 方法功能：重写展示页面的方法
     * 用来提供数据的测试
     * 2017年4月19日22点51分被index3替换
     */
    public function index3() {
        $n = D("Setted");
        // 此处进行关联查询
        $allSetted = $n->relation(true)->select();
        for ($i = 0; $i < count($allSetted); $i++) {
            $allSetted[$i]['period'] = explode(";", $allSetted[$i]['period']);
            $allSetted[$i]['date'] = explode(";", $allSetted[$i]['date']);
            $allSetted[$i]['dateCount'] = count($allSetted[$i]['date']);
        }


        //  遍历可以安排的人
        $k = M("Member");
        $all_member = $k -> select();
        $count = $k -> count();

        $m = M("Device");
        for ($i = 0, $j = 0, $x = 0; $i < $count; $i++, $x++) {
            $id = $all_member[$i]['id'];
            $limit_times = $all_member[$i]['limit_count'];
            $max_time = $m -> where("select_device = $id") ->count();
            $result = $k -> where("id = $id") ->getField("name");
            if ($max_time < $limit_times) {
                $all_member_lists[$j]['id'] = $id;
                $all_member_lists[$j]['name'] = $result;
                $j++;
            } else {
                $all_member_rest[$x]['id'] = $id;
                $all_member_rest[$x]['name'] = $result;
            }
            for ($q = 0; $q < count($allSetted[$i]['allDevice']); $q++) {
                $select_device = $allSetted[$i]['allDevice'][$q]['select_device'];
                $allSetted[$i]['allDevice'][$q]['memberName'] = $k->where("id=$select_device")->getField("name");
            }
        }

        $this -> date = date("Y-m-d");
        $this -> title = "首页";

        $this->assign("all_member_rest", $all_member_rest);
        $this->assign("all_member_lists", $all_member_lists);
        $this->assign("allSetted", $allSetted);
        $this->display();
    }

}