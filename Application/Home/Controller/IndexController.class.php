<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    /*
     * 方法功能：初始化操作，判断管理员是否已经登录
     * */
	public function __initialize() {
		var_dump($_SESSION);
	}
	/*
	 * 方法功能：后台主界面的展示，即所安排的值班信息的展示和通告的展示(值班信息按照天来查询)
	 * */
    public function index(){
    	
    }

    public function qrcode(){
        Vendor('phpqrcode.phpqrcode');
        $url='http://www.baidu.com/';
        $text = "name:doubibobo";
        $level=3;
        $size=4;
        $errorCorrectionLevel =intval($level) ;//容错级别
        $matrixPointSize = intval($size);//生成图片大小
        //生成二维码图片
        //echo $_SERVER['REQUEST_URI'];
        $file = './doubibobo.png';
        $object = new \QRcode();
        $qrfile = imagecreatefromstring(file_get_contents($file));
        $object->png($text, $file, $errorCorrectionLevel, $matrixPointSize, 2);

        // 重构二维码大小
        $qr_percent = 3.2;
        list($qr_width,$qr_height) = getimagesize($file);
        $qr_new_width = $qr_width * $qr_percent;
        $qr_new_height = $qr_height * $qr_percent;
        $qr_src = imagecreatefrompng($file);
        $qr_new = imagecreatetruecolor($qr_new_width, $qr_new_height);
        imagecopyresized($qr_new, $qr_src, 0, 0, 0, 0, $qr_new_width, $qr_new_height, $qr_width, $qr_height);
        $bgimg = imagecreatefromstring(file_get_contents('./doubibobo.png'));
        imagecopymerge($bgimg, $qr_new, 100, 300, 0, 0, imagesx($qr_new), imagesy($qr_new), 100);
        header('Content-Type:image/jpeg');
        imagejpeg($bgimg);
        imagedestroy($bgimg);
    }
}