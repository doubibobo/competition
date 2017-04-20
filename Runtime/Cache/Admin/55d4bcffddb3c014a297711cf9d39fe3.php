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
<script src="/competition/Public/Js/jquery-3.1.1.min.js"></script>
<div class="container">

	<script type="text/javascript">
        $(function(){
            $("#exportTheWord").click(function(){
                var html = $("#theWord").html();
                var param =　{
                    content: html
				};
                $.ajax({
                    url: '/competition/index.php/Admin/Email/wordExport',
                    type: 'POST',
                    dataType: 'json',
                    data: param,
                    success: function(data){
                        console.log(data);
                        window.location.href="/competition/index.php/Admin/Manage/index.html";
                    },
                    error: function(xhr){
                        console.log(xhr);
                    }
				})
            });
        });
	</script>

	<div class="col-md-offset-5 col-md-10">
		<a href="/competition/index.php/Admin/Email/excelExport"><button class="btn btn-info col-md-2" name="modify" onclick="">导出excel</button></a>
		<span class="col-md-1"></span>
		<button class="btn btn-info col-md-2" id="exportTheWord" name="modify">导出word</button>
		<span class="col-md-1"></span>
		<button class="btn btn-info col-md-2" name="modify" onclick="javascript:displayForm1()">邮件提醒</button>
		<!--<span class="col-md-1"></span>-->
		<!--<a href="" download="./competition/Public/Word/Information.dox"><button class="btn btn-info col-md-2" name="modify" onclick="">下载word</button></a>-->
	</div>

	<div class="container" id="bulletin_add_form" style="display:none;">
		<br/> <br/>
		<form class="form-horizontal" name="bulletin_form" method="post" action="/competition/index.php/Admin/Email/index">
			<div class="form-group">
				<label for="title" class="control-label col-sm-1">邮件标题</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="title" name="title" placeholder="邮件标题">
				</div>
			</div>
			<div class="form-group">
				<laber for="from" class="control-label col-sm-1">发件人</laber>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="from" name="from" placeholder="发件名义">
				</div>
			</div>
			<div class="form-group">
				<laber for="activity" class="control-label col-sm-1">活动名称</laber>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="activity" name="activity" placeholder="活动名称">
				</div>
			</div>
			<div class="col-md-offset-2 col-md-10">
				<div class="col-md-7">
					<button type="submit" class="btn btn-primary btn-md btn-block" name="add_user" id="saveContent">发送</button>
				</div>
			</div>
		</form>
	</div>
	<br>
	<script>
        var flag=true;
        function displayForm1()
        {
            var div=document.getElementById("bulletin_add_form");
            if(flag)	div.style.display="block";
            else	div.style.display="none";
            flag=!flag;
        }
	</script>

	<br><br>
	<div id="theWord" class="theWord">
		<?php if(is_array($allSetted)): $i = 0; $__LIST__ = $allSetted;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$items): $mod = ($i % 2 );++$i;?><table class="table table-hover table-bordered table-striped" style="border: 5px;">
				<caption>值班地点：<?php echo ($items["address"]); ?></caption>
				<tr>
					<td class="col-sm-2">值班日期 or 时间段</td>
					<?php if(is_array($items['date'])): $i = 0; $__LIST__ = $items['date'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dateValue): $mod = ($i % 2 );++$i;?><td><?php echo ($dateValue); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
				</tr>

				<?php $j = 0; ?>

				<?php if(is_array($items['period'])): $i = 0; $__LIST__ = $items['period'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$periodValue): $mod = ($i % 2 );++$i;?><tr class="success">
						<td><?php echo ($periodValue); ?></td>
						<?php for ($j, $m = 0; $m < $items['dateCount']; $m++, $j++) { ?>
						<td>
							<?php if ($items['allDevice'][$j]['memberName'] == "") { echo "未安排"; } else { echo $items['allDevice'][$j]['memberName']; } ?>
						</td>
						<?php } ?>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			</table>

			<br><?php endforeach; endif; else: echo "" ;endif; ?>
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