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

	<?php if(is_array($allSetted)): $i = 0; $__LIST__ = $allSetted;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$items): $mod = ($i % 2 );++$i;?><table class="table table-hover table-bordered table-striped">
			<caption>值班地点：<?php echo ($items["address"]); ?></caption>
			<tr>
				<td class="col-sm-2">值班日期 or 时间段</td>
				<?php if(is_array($items['date'])): $i = 0; $__LIST__ = $items['date'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dateValue): $mod = ($i % 2 );++$i;?><td><?php echo ($dateValue); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
			</tr>

			<?php $j = 0; ?>

			<?php if(is_array($items['period'])): $i = 0; $__LIST__ = $items['period'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$periodValue): $mod = ($i % 2 );++$i;?><tr class="success">
					<td><?php echo ($periodValue); ?></td>
					<?php for ($j, $m = 0; $m < $items['dateCount']; $m++, $j++) { $afterMember = $items['allDevice'][$j]['select_device']; $afterMemberName = $items['allDevice'][$j]['memberName']; ?>
					<td>
						<div style="position: relative; top: -7px;">
							<form action="/competition/index.php/Admin/Index/doSet" method="post">
								<input type="text" value="<?php echo $items['allDevice'][$j]['id']; ?>" name="deviceId" id="deviceId" hidden>
								<select name="memberName" id="theName" class="form-control" style="position: absolute; width: 65%;">
									<?php $allPeopleIn = $items['allDevice'][$j]['allPeopleIn']; $allPeopleNotIn = $items['allDevice'][$j]['allPeopleNotIn']; for ($k = 0; $k < count($allPeopleIn); $k++){ if ($afterMember == $allPeopleIn[$k]['id']) { ?>
												<option value="<?php echo ($afterMember); ?>" selected="selected">
													<?php echo $allPeopleIn[$k]['name']; ?>
												</option>
									<?php } else { $id = $allPeopleIn[$k]['id']; ?>
												<option value="<?php echo ($id); ?>">
													<?php echo $allPeopleIn[$k]['name']; ?>
												</option>
									<?php } } ?>
									<?php for ($k = 0; $k < count($allPeopleNotIn); $k++){ if ($afterMember == $allPeopleNotIn[$k]['id']) { ?>
												<option value="<?php echo ($afterMember); ?>" selected="selected">
													<?php echo $allPeopleNotIn[$k]['name']; ?>
												</option>
									<?php } else { $id = $allPeopleNotIn[$k]['id']; ?>
									<option value="<?php echo ($id); ?>">
										<?php echo $allPeopleNotIn[$k]['name']; ?>
									</option>
									<?php } } ?>


									<option value="0" disabled>以下不可选</option>
									<?php if(is_array($all_member_rest)): $i = 0; $__LIST__ = $all_member_rest;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$member): $mod = ($i % 2 );++$i; if($member["id"] == $afterMember): ?><option value="<?php echo ($member["id"]); ?>" selected="selected" disabled> <?php echo ($member["name"]); ?> </option>
											<?php else: ?>
											<option value="<?php echo ($member["id"]); ?>" disabled> <?php echo ($member["name"]); ?> </option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
								</select>

								<button type="submit" class="btn btn-info" style="position: absolute; width: 35%;left: 66%;">
									确定
								</button>
							</form>
						</div>
					</td>
					<?php } ?>
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