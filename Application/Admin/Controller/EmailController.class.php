<?php
/**
 * Created by PhpStorm.
 * User: zhuch
 * Date: 2017/4/17
 * Time: 23:43
 */

namespace Admin\Controller;
use Think\Controller;

class EmailController extends Controller {
    /**
     * 进行邮件的发送
     */
    public function index(){
        $title = I(trim("post.title"));
        $from = I(trim("post.from"));
        $activity = I(trim("post.activity"));
        $n = D("Member");
        $allMemberManaged = $n -> where("id != 0") -> relation(true) -> select();

        for ($i = 0, $j = 0; $i < count($allMemberManaged); $i++) {
            if (count($allMemberManaged[$i]['allManaged']) != 0) {
                $allManagedNeed[$j] = $allMemberManaged[$i];
                $j++;
            }
        }

        for ($i = 0; $i < count($allManagedNeed); $i++) {
            $mail = $allManagedNeed[$i]['email'];
            $content = $allManagedNeed[$i]['name']."同学，在".$activity."活动中，您的值班安排为</br>";
            for ($j = 0; $j < count($allManagedNeed[$i]['allManaged']); $j++) {
                $content = $content.$allManagedNeed[$i]['allManaged'][$j]['date']." ".$allManagedNeed[$i]['allManaged'][$j]['address']." ".$allManagedNeed[$i]['allManaged'][$j]['period'].";</br>";
            }
            $content = "".$content."请不要迟到或者早退，我们会安排人员进行签到</br>".$from."";
            SendMail($mail, $title, $content, $from);
        }
        $this->success("提醒成功");
    }

    /**
     * 进行Excel的导出
     */
    public function excelExport() {
        $n = M('Member');
        $query = "select date, address, period, name, phone, email from tp_member, tp_device where tp_device.select_device = tp_member.id";
        $data = $n -> query($query);
        $subject = "值班安排表";
        $title = array('日期', '地点', '时间段', '值班人', '电话', '邮件');
        exportExcel($data,$title,$subject);
    }

    /**
     * 进行word的输出
     */
    public function wordExport() {
        $content = I(trim("post.content"));
        $fileContent = self::handleStringFromHtml($content);
        $fileContent = WordMake($fileContent);
        $name = iconv("utf-8", "GBK",'Information');//转换好生成的word文件名编码
        $fp = fopen("./Public/Word/".$name.".doc", 'w') or die("Unable to open file!");//打开生成的文档,没有则直接创建，文件名为刚才起的名字加time
        fwrite($fp, $fileContent);//写入包保存文件
        fclose($fp);
        if ($fileContent) {
            $data = array(
                'code'=>'0'
            );
            echo json_encode($data);
        } else {
            alert("导出失败！");
            exit();
        }
    }

    /**
     * @param $stringFromHtml
     * @return string
     */
    public function handleStringFromHtml($stringFromHtml) {
        $stringFromHtml = str_replace("&lt;", "<", $stringFromHtml);
        $stringFromHtml = str_replace("&gt;", ">", $stringFromHtml);
        $stringFromHtml = str_replace("&quot;", "\"", $stringFromHtml);
        $header = "<!DOCTYPE html><html lang=\"en\"><head><meta charset=\"UTF-8\"><title>Document</title><meta name=\"viewport\" content=\"width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no\" /></head><body>";
        $footer = "</body></html>";
        $handledHtml = $header.$stringFromHtml.$footer;
        return $handledHtml;
    }
    /**************
     ** 测试代码
     **************/
    /**
     * 进行打开并写入文件的测试
     */
    public function writeWord($fileContent1) {
        $title = "<!DOCTYPE html><html lang=\"en\"><head><meta charset=\"UTF-8\"><title>Document</title><meta name=\"viewport\" content=\"width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no\" /></head><body>";
        $footer = "</body></html>";
        $content = "<table class=\"table table-hover table-bordered table-striped\" style=\"border: 5px;\"> <caption>值班地点：逸夫楼C座地下室沸点工作室</caption> <tbody><tr> <td class=\"col-sm-2\">值班日期 or 时间段</td> <td>2017-02-25</td><td>2017-02-26</td><td>2017-02-27</td><td>2017-02-28</td><td>2017:02-29</td> </tr> <tr class=\"success\"> <td>08:00-09:40</td> <td> 项健健 </td> <td> 刘晓磊 </td> <td> 白天宇 </td> <td> 白天宇 </td> <td> 未安排 </td> </tr><tr class=\"success\"> <td>10:00-11:40</td> <td> ctc </td> <td> 未安排 </td> <td> 未安排 </td> <td> 未安排 </td> <td> 未安排 </td> </tr><tr class=\"success\"> <td>14:00-15:40</td> <td> 未安排 </td> <td> 未安排 </td> <td> 未安排 </td> <td> 未安排 </td> <td> 未安排 </td> </tr><tr class=\"success\"> <td>16:00-17:40</td> <td> 未安排 </td> <td> 未安排 </td> <td> 未安排 </td> <td> 未安排 </td> <td> 未安排 </td> </tr><tr class=\"success\"> <td>19:00-21:00</td> <td> 未安排 </td> <td> 未安排 </td> <td> 未安排 </td> <td> 未安排 </td> <td> 未安排 </td> </tr> </tbody></table> <br><table class=\"table table-hover table-bordered table-striped\" style=\"border: 5px;\"> <caption>值班地点：华中农业大学</caption> <tbody><tr> <td class=\"col-sm-2\">值班日期 or 时间段</td> <td>2017-02-25</td> </tr> <tr class=\"success\"> <td>14:00-18:00</td> <td> 未安排 </td> </tr> </tbody></table> <br> ";
        $all = $title.$content.$footer;
        $fileContent = WordMake($all);
        $name = iconv("utf-8", "GBK",'值班表');//转换好生成的word文件名编码
        var_dump($name.date("Y-m-d"));
        $file_path = "./Public/Word/".$name.date("Y-m-d").".doc";
        var_dump($file_path);
        $fp = fopen("./Public/Word/".$name."(".$name.date("Y-m-d").").doc", 'w') or die("Unable to open file!");//打开生成的文档,没有则直接创建，文件名为刚才起的名字加time
        fwrite($fp, $fileContent.$fileContent1);//写入包保存文件
        fclose($fp);

        if(file_exists($file_path)){
            $fp = fopen($file_path,"r");
            $str = fread($fp,filesize($file_path));//指定读取大小，这里把整个文件内容读取出来
            echo $str = str_replace("\r\n","<br />",$str);
        }
        return;
    }

    /**
     * 文件的创建测试
     */
    public function newWord() {
        $myfile = fopen("./Public/Word/newfile.doc", "w") or die("Unable to open file!");
        $txt = "Hello, my name is zhuchuanbo\n";
        fwrite($myfile, $txt);
        $txt = "Steve Jobs\n";
        fwrite($myfile, $txt);
        fclose($myfile);
    }
}