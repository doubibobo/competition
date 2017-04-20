<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="/competition/Public/Common/css/bootstrap-theme.min.css">
    <link type="text/css" rel="stylesheet" href="/competition/Public/Common/css/bootstrap.min.css">
    <script src="/competition/Public/Common/js/jquery.min.js"></script>
    <script src="/competition/Public/Common/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="/competition/logo.ico" type="image/x-icon" />
    <link type="text/css" rel="stylesheet" href="/competition/Public/Admin/css/style.css">
    <link type="text/css" rel="stylesheet" href="/competition/Public/Common/css/multiple-select.css" />
    <link type="text/css" rel="stylesheet" href="/competition/Public/Common/css/style.css">
    <title><?php echo ($title); ?></title>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="/competition"><img src="/competition/Public/Home/img/logo.png" style="width:200px height:44.8px"></a>
                </div>

                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li <?php if(($title) == "安排值班"): ?>class="active"<?php endif; ?>><a href="<?php echo U('Index/index');?>">安排值班</a></li>
                        <li <?php if(($title) == "添加人员"): ?>class="active"<?php endif; ?>><a href="<?php echo U('Member/addMember');?>">添加人员</a></li>
                        <li <?php if(($title) == "值班概览"): ?>class="active"<?php endif; ?>><a href="<?php echo U('Manage/index');?>">值班概览</a></li>
                        <li <?php if(($title) == "联系方式"): ?>class="active"<?php endif; ?>><a href="<?php echo U('Member/contact');?>">联系方式</a></li>
                        <li <?php if(($title) == "公告管理"): ?>class="active"<?php endif; ?>><a href="<?php echo U('Information/index');?>">公告管理</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li <?php if(($title) == "设置"): ?>class="active"<?php endif; ?>><a href="{:U('Setting/setting_list')}">设置</a></li>
                        <li><a><?php echo session('valid_user');?></a></li>
                        <li><a href="{:U('Admin/logout')}">退出</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
	<!--显示折叠按钮 -->
	<div class="container">
		<div class="col-md-offset-11">
			<a href="#">
				<img src="/competition/Public/Admin/imgs/add.png" style="cursor:hand;" alt="addinformation" title="创建公告" onclick="javascript:displayForm()">
			</a>
		</div>
	</div>
	<!--添加公告-->
	<div class="container" id="bulletin_add_form" style="display:none;">
		<div class="col-sm-12 heading">add information</div> <br> <br>
        <textarea class="form-control" rows="1" id="title" name="title" placeholder="Please input the title..."></textarea> <br>
        <script id='container' name='content' type="text/plain" style="height:500px;width:100%">Please input the information...</script>
        <script src="/competition/Public/Js/jquery-3.1.1.min.js"></script>
        <!--配置文件-->
        <script type="text/javascript" src="/competition/Public/Ueditor/ueditor.config.js"></script>
        <!--编译器源码文件-->
        <script type="text/javascript" src="/competition/Public/Ueditor/ueditor.all.js"></script>
        <!--实例化编译器-->
        <script type="text/javascript">
            $(function(){
                var ue = UE.getEditor('container');
                $('#getContent').click(function(){
                    var html = ue.getContent();
                    alert(html);
                });

                $('#saveContent').click(function(){
                    var html = ue.getContent();
                    var param = {
                        title: $("#title").val(),
                        content: html
                    };
                    $.ajax({
                        url: '/competition/index.php/Admin/Information/doAddInformation',
                        type: 'POST',
                        dataType: 'json',
                        data: param,
                        success: function(data){
                            console.log(data);
                            window.location.href="/competition/index.php/Admin/Information/index";
                        },
                        error: function(xhr){
                            console.log(xhr);
                        }
                    });
                });
            });
            </script>
            <div class="form-group">
				<br/>
				<div class="col-md-12">
					<button type="submit" class="btn btn-success btn-md btn-block" name="add_user" id="getContent">获取内容</button>
				</div>
			</div><br>
            <div class="form-group">
				<br/>
				<div class="col-md-12">
					<button type="submit" class="btn btn-success btn-md btn-block" name="add_user" id="saveContent">保存</button>
				</div>
			</div>


	</div>
	<script>
		var flag=true;
		function displayForm()
		{
			var div=document.getElementById("bulletin_add_form");
			if(flag)	div.style.display="block";
			else	div.style.display="none";
			flag=!flag;
		}
		$(function() {
			$('#ms1').change(function() {
				console.log($(this).val());
			}).multipleSelect({
				width: '100%'
			});
		});
		$(function() {
			$('#ms2').change(function() {
				console.log($(this).val());
			}).multipleSelect({
				width: '100%'
			});
		});
	</script>
	<br/>
	<!--显示公告列表-->
	<div class="container">
		<div class="bulletin_list">
			<div class="col-sm-12 heading">公告管理</div>
			<br/>
			<table class="table table-bordered">
				<colgroup>
					<col width="10%">
					<col width="20%">
					<col width="">
					<col width="10%">
					<col width="5%">
					<col width="5%">
				</colgroup>
				<thead class="table-head">
					<tr>
						<td>userid</td>
						<td>tile</td>
						<td>content</td>
						<td>date</td>
						<td>delete</td>
						<td>update</td>
				</thead>
				<tbody>
					<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr <?php if(($mod) == "1"): ?>class="odd"<?php endif; ?>>
						<!-- <td title="<?php echo ($item["username"]); ?>">{$item.realname}</td> -->
						<td>111</td>
						<td><?php echo ($vo["title"]); ?></td>
						<td><?php echo ($vo["content"]); ?></td>
						<td><?php echo ($vo["date"]); ?></td>
						<td>
							<a href="/competition/index.php/Admin/Information/deleteInformation/id/<?php echo ($vo["id"]); ?>">
								<img src="/competition/Public/Admin/imgs/delete.png" width="20px" height="20px" alt="delete">
							</a>
						</td>
						<td>
							<a href="/competition/index.php/Admin/Information/updateInformation/id/<?php echo ($vo["id"]); ?>">
								<img src="/competition/Public/Admin/imgs/edit.png" width="20px" height="20px" alt="update">
							</a>
						</td>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="container">
		<div class="pagesplit" style="colspan:3 bgcolor:#FFF">
			<?php echo ($page); ?>
		</div>
	</div>
    <!-- 页脚部分 -->
    <div class="container">
        <div id="footer">
            <p title="逗比波波">©doubibobolalala2017 <a href="http://115.28.224.101">逗比波波</a></p>
        </div>

    </div>
</body>
</html>