<?php
/**
 * Created by PhpStorm.
 * User: doubibobo
 * Date: 17-3-4
 * Time: 下午3:22
 */
/*
 *利用正则表达式判断邮箱格式是否正确
 */
function valid_email($email)
{
    if (preg_match('/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i', $email)) {
        return true;
    }
    return false;
}
/*
 *利用正则表达式判断电话格式是否正确
 */
function valid_phone($phone)
{
    if (preg_match('/^\d{7,11}$/', $phone)) {
        return true;
    }
    return false;
}

function valid_realname($realname)
{
    if(empty($realname) || !preg_match("/^\p{Han}+$/u", $realname))
    {
        return false;
    }
    return true;
}
/*
 *利用正则表达式判断用账号格式是否正确
 */
function valid_userid($userid)
{
    if(preg_match('/^[a-zA-Z\d_*]{3,50}$/i', $userid))
    {
        return true;
    }
    return false;
}
/*
 *利用正则表达式判断密码格式是否正确
 */
function valid_passwd($passwd)
{
    if(empty($passwd))
    {
        return false;
    }
    return true;
}
/*
 *判断用户输入的时间段是否符合正则表达式
 */
function valid_rules($rules)
{
    return preg_match("/^((([01]\d)|(2[0-3])):[0-5]\d-(([01]\d)|(2[0-3])):[0-5]\d\s*,\s*)+$/", $rules.',');
}
/*
 *重写alert
 */
function alert($type, $content)
{
    echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>';
    echo "<script language='javascript'>alert('$type: $content');history.back();</script>";
}

/**
 * Excel表格导出
 * @param $data 导出表格数据
 * @param $title    导出表格名称
 * @param $subject  导出表格字段
 */
function exportExcel($data,$title,$subject){  
    Vendor("Excel.Util.PHPExcel");
    Vendor('Excel.PHPExcel.IOFactory');
    Vendor('Excel.PHPExcel.Reader.Excel5');
    // Create new PHPExcel object  
    $objPHPExcel = new PHPExcel();  
    // Set properties  
    $objPHPExcel->getProperties()->setCreator("ctos")  
        ->setLastModifiedBy("ctos")  
        ->setTitle("Office 2007 XLSX Test Document")  
        ->setSubject("Office 2007 XLSX Test Document")  
        ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")  
        ->setKeywords("office 2007 openxml php")  
        ->setCategory("Test result file");  
    $length1=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD');
    $length2=array('A1','B1','C1','D1','E1','F1','G1','H1','I1','J1','K1','L1','M1','N1','O1','P1','Q1','R1','S1','T1','U1','V1','W1','X1','Y1','Z1','AA1','AB1','AC1','AD1');
    //set width  
    for($a=0;$a<count($title);$a++){
         $objPHPExcel->getActiveSheet()->getColumnDimension($length1[$a])->setWidth(20); 
    }
    //set font size bold  
    $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);  
    $objPHPExcel->getActiveSheet()->getStyle($length2[0].':'.$length2[count($title)-1])->getFont()->setBold(true); 
    $objPHPExcel->getActiveSheet()->getStyle($length2[0].':'.$length2[count($title)-1])->getFont()->setBold(true);    
    $objPHPExcel->getActiveSheet()->getStyle($length2[0].':'.$length2[count($title)-1])->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  
    
    // set table header content  
    for($a=0;$a<count($title);$a++){
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue($length2[$a], $title[$a]); 
    }
    for($i=0;$i<count($data);$i++){ 
        $buffer=$data[$i];
        $number=0;
        foreach ($buffer as $value) {
            $objPHPExcel->getActiveSheet(0)->setCellValueExplicit($length1[$number].($i+2),$value,PHPExcel_Cell_DataType::TYPE_STRING);//设置单元格为文本格式
            $number++;
        }
        unset($value);
        $objPHPExcel->getActiveSheet()->getStyle($length1[0].($i+2).':'.$length1[$number-1].($i+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);  
        $objPHPExcel->getActiveSheet()->getStyle($length1[0].($i+2).':'.$length1[$number-1].($i+2))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  
        $objPHPExcel->getActiveSheet()->getRowDimension($i+2)->setRowHeight(16);  
    }  
    // Set active sheet index to the first sheet, so Excel opens this as the first sheet  
    $objPHPExcel->setActiveSheetIndex(0);  
    ob_end_clean();//清除缓冲区,避免乱码
    // Redirect output to a client’s web browser (Excel5)  
    header('Content-Type: application/vnd.ms-excel');  
    header('Content-Disposition: attachment;filename='.$subject.'('.date('Y-m-d').').xls');  
    header('Cache-Control: max-age=0');  
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
    $objWriter->save('php://output');  
}

/** 
 * author:10xjzheng
 * Excel导入
 * @param title 导入表格的字段
 * @param tableName 导入表格的名字
 * @param savePath 文件保存的路径，默认在Public/Excel/
 */
function importExcel($tableName,$title,$savePath="Public/Excel/")
{   
    import('Org.Util.ExcelToArrary');//导入excelToArray类
    $tmp_file = $_FILES ['excel'] ['tmp_name'];
    $file_types = explode ( ".", $_FILES ['excel'] ['name'] );
    $file_type = $file_types [count ( $file_types ) - 1];
     /*判别是不是.xls文件，判别是不是excel文件*/
    if (strtolower ( $file_type ) != "xlsx" && strtolower ( $file_type ) != "xls")              
    {
        $rs='不是Excel文件，重新上传';
        return $rs;
    }
    //检查是否有该文件夹，如果没有就创建，并给予最高权限 
    if(!file_exists($savePath)) 
    { 
        mkdir($savePath, 0700); 
    }//END IF
    /*以时间来命名上传的文件*/
    $str = date ( 'Ymdhis' ); 
    $file_name = $str . "." . $file_type;
    /*是否上传成功*/
    if (! copy ( $tmp_file, $savePath . $file_name )) 
    {
         $rs= '上传失败';
         return $rs;
    }
    $ExcelToArrary = new ExcelToArrary();//实例化
    $res=$ExcelToArrary->read($savePath.$file_name,"UTF-8",$file_type);//传参,判断office2007还是office2003
    foreach ( $res as $k => $v ) //循环excel表
    {
        if($k>1){
            $k=$k-2;//addAll方法要求数组必须有0索引
            for ($i=0; $title[$i]; $i++) {
                $data[$k][$title[$i]] = $v [$i];//创建二维数组
            }
        }
    }
    $model=M($tableName);//M方法
    $result=$model->addAll($data);
    if(! $result)
    {
         $rs='导入数据库失败';
    }
    else
    {
         $rs= '导入成功';    
    }
    return $rs;
}

/**
* 根据HTML代码获取word文档内容
* 创建一个本质为mht的文档，该函数会分析文件内容并从远程下载页面中的图片资源
* 该函数依赖于类WordMake
* 该函数会分析img标签，提取src的属性值。但是，src的属性值必须被引号包围，否则不能提取
*
* @param string $content HTML内容
* @param string $absolutePath 网页的绝对路径。如果HTML内容里的图片路径为相对路径，那么就需要填写这个参数，来让该函数自动填补成绝对路径。这个参数最后需要以/结束
* @param bool $isEraseLink 是否去掉HTML内容中的链接
*/
function WordMake($content , $absolutePath = "" , $isEraseLink = true )
{
    import('Org.Util.Wordmaker');
    $mht = new Wordmaker();
    if ($isEraseLink) {
        $content = preg_replace('/<a\s*.*?\s*>(\s*.*?\s*)<\/a>/i' , '$1' , $content);   //去掉链接
    }
    $images = array();
    $files = array();
    $matches = array();
    //这个算法要求src后的属性值必须使用引号括起来
    if ( preg_match_all('/<img[.\n]*?src\s*?=\s*?[\"\'](.*?)[\"\'](.*?)\/>/i',$content ,$matches ) ) {
        $arrPath = $matches[1];
        for ( $i=0;$i<count($arrPath);$i++) {
            $path = $arrPath[$i];
            $imgPath = trim( $path );
            if ( $imgPath != "" ) {
                $files[] = $imgPath;
                if( substr($imgPath,0,7) == 'http://') {
                //绝对链接，不加前缀
                } else {
                    $imgPath = $absolutePath.$imgPath;
                }
                $images[] = $imgPath;
            }
        }
    }
    $mht->AddContents("tmp.html",$mht->GetMimeType("tmp.html"),$content);
    for ( $i=0;$i<count($images);$i++) {
        $image = $images[$i];
        if ( @fopen($image , 'r') ) {
            $imgcontent = @file_get_contents( $image );
            if ( $content )
            $mht->AddContents($files[$i],$mht->GetMimeType($image),$imgcontent);
        }
        else {
            echo "file:".$image." not exist!<br />";
        }
    }
    return $mht->GetFile();
}

/**
 * @param $to       邮件目的地址
 * @param $title    邮件标题
 * @param $content  邮件内容
 * @return bool     成功返回ture，失败返回false
 */
function sendMail($to, $title, $content, $from) {
    Vendor('PHPMailer.PHPMailerAutoload');
    $mail = new PHPMailer(); //实例化
    $mail->isSMTP(); // 启用SMTP
    $mail->Host=C('MAIL_HOST'); //smtp服务器的名称（这里以QQ邮箱为例）
    $mail->SMTPAuth = C('MAIL_SMTPAUTH'); //启用smtp认证
    $mail->Username = C('MAIL_USERNAME'); //你的邮箱名
    $mail->Password = C('MAIL_PASSWORD') ; //邮箱密码
    $mail->From = C('MAIL_FROM'); //发件人地址（也就是你的邮箱地址）
    $mail->FromName = $from; //发件人姓名
    $mail->addAddress($to,"假日值班通知");
    $mail->WordWrap = 50; //设置每行字符长度
    $mail->isHTML(C('MAIL_ISHTML')); // 是否HTML格式邮件
    $mail->CharSet=C('MAIL_CHARSET'); //设置邮件编码
    $mail->Subject =$title; //邮件主题
    $mail->Body = $content; //邮件内容
    $mail->AltBody = "这是一个纯文本的身体在非营利的HTML电子邮件客户端"; //邮件正文不支持HTML的备用显示
    return($mail->Send());
}

