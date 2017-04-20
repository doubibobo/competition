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
<link type="text/css" rel="stylesheet" href="/competition/Public/Common/css/bootstrap-theme.min.css">
<link type="text/css" rel="stylesheet" href="/competition/Public/Common/css/bootstrap.min.css">
<link type="text/css" rel="stylesheet" href="/competition/Public/Common/css/bootstrap-datetimepicker.css" />
<link type="text/css" rel="stylesheet" href="/competition/Public/Common/css/bootstrap-datetimepicker.min.css" />
<script src="/competition/Public/Common/js/bootstrap-datetimepicker.min.js"></script>
<script src="/competition/Public/Common/js/bootstrap-datetimepicker.js"></script>
<script src="/competition/Public/Common/js/bootstrap-datetimepicker.zh-CN.js "></script> 
<script src="/competition/Public/Common/js/jquery-1.8.3.min.js" charset="UTF-8"></script>
	<div class="container">
		<div class="col-md-offset-10 col-md-10">
			<button class="btn btn-primary btn-md col-md-2" name="modify" onclick="javascript:displayForm1()">添加事务</button>
		</div>
		<br>

		<div class="container" id="bulletin_add_form" style="display:none;">
			<br/>
			<form class="form-horizontal" name="bulletin_form" method="post" action="/competition/index.php/Admin/Index/addMatter">
				<div class="form-group">
					<label for="date" class="control-label col-sm-1">值班日期</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="date" name="date" placeholder="添加值班日期">
					</div>
				</div>
				<div class="form-group">
					<laber for="address" class="control-label col-sm-1">值班地点</laber>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="address" name="address" placeholder="添加值班地点">
					</div>
				</div>
				<div class="form-group">
					<laber for="period" class="control-label col-sm-1">时间段</laber>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="period" name="period" placeholder="添加时间段">
					</div>
				</div>
				<div class="col-md-offset-2 col-md-10">
					<div class="col-md-10">
						<button type="submit" class="btn btn-primary btn-md btn-block" name="add_user" id="saveContent">添加</button>
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
            function displayForm() {
				var div=document.getElementById("hahaha");
				if (flag) div.style.display="block";
				else div.style.display="none";
				flag=!flag;
            }
		</script>
    	<div class="input-group date form_date col-md-3" data-date="" data-date-format="" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
      		<input class="form-control" size="16" type="text" value="" readonly>
  			<span class="input-group-addon">
  				<span class="glyphn目录下有两个文件 Phpticon glyphicon-remove"></span>
  			</span>
     		<span class="input-group-addon">
     			<span class="glyphicon glyphicon-calendar"></span>
     		</span>
 		</div>
		<br><br>

		<!--注意四层嵌套volist标签的问题-->
		<!--<?php-->
			<!--global $val;-->
			<!--$val = 0;-->
		<!--?>-->
		<?php  ?>
		<?php if(is_array($all_the_rules)): $i = 0; $__LIST__ = $all_the_rules;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$someitems): $mod = ($i % 2 );++$i;?><table class="table table-hover table-bordered table-striped">
				<caption>值班地点：<?php echo ($someitems["address"]); ?></caption>
				<tr>
					<td class="col-sm-2">值班日期 or 时间段</td>
					<?php if(is_array($someitems['date'])): $i = 0; $__LIST__ = $someitems['date'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?><td><?php echo ($value); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
				</tr>
				<?php if(is_array($someitems['period'])): $i = 0; $__LIST__ = $someitems['period'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?><tr class="success">
						<td><?php echo ($value); ?></td>
						<?php if(is_array($someitems['date'])): $i = 0; $__LIST__ = $someitems['date'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value0): $mod = ($i % 2 );++$i;?><td>
								<form action="/competition/index.php/Admin/Index/doSet" method="post">
								<select class="input-small" id="getFormselect" name="select_device" onchange="deviceChanged()">
									<?php for($i = 0; $i < $all_setted_count; $i++) { if($all_setted[$i]['period'] == $value && $all_setted[$i]['date'] == $value0 && all_setted[$i]['address'] == $someitems['address']) { $hahaha = $all_setted[$i]['name']; $hehehe = $all_setted[$i]['select_device']; ?>
												<option value="<?php echo ($hehehe); ?>"><?php echo ($hahaha); ?></option>
									<?php } else { ?>
												<option value="0">---</option>
									<?php } } ?>
									<?php if(is_array($name)): $i = 0; $__LIST__ = $name;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><option value="<?php echo ($item["id"]); ?>"><?php echo ($item["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
								</select>
								<input type="text" value="<?php echo ($value); ?>" id="getFormPeriod" name="period" hidden>
								<input type="text" value="<?php echo ($value0); ?>" id="getFormDate" name="date" hidden>
								<input type="text" value="<?php echo ($someitems["address"]); ?>" id="getFormaddress" name="address" hidden>
								<!--采用ajax方式提交表单数据并且及时刷新-->
								<!--<script type="text/javascript">-->
									<!--$('#formSumbit').click(function () {-->
										<!--var params = {-->
											<!--select_device:$('#getFormselect').val(),-->
											<!--period:$('#getFormPeriod').val(),-->
											<!--date:$('#getFormDate').val(),-->
											<!--address:$('#getFormaddress').val()-->
										<!--};-->
										<!--$.ajax({-->
											<!--url: '/competition/index.php/Admin/Index/doSet',-->
											<!--type: 'POST',-->
											<!--dataType: 'json',-->
											<!--data: params,-->
											<!--success: function(data){-->
												<!--console.log(data);-->
												<!--window.location.href="/competition/index.php/Admin/Index/index";-->
											<!--},-->
											<!--error: function(xhr){-->
												<!--console.log(xhr);-->
											<!--}-->
										<!--});-->
									<!--});-->
								<!--</script>-->
									<button class="btn btn-primary" type="submit" id="formSumbit<?php echo $val;?>">安排</button>
								</form>
							</td><?php endforeach; endif; else: echo "" ;endif; ?>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			</table><?php endforeach; endif; else: echo "" ;endif; ?>
		<div class="col-md-1">

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