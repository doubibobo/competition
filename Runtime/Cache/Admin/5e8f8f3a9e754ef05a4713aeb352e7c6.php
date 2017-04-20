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
	<!--显示添加设备的表单-->
	<div class="container">
		<div class="col-sm-12 heading">修改信息</div>
		<br>
		<br>
			<form class="form-horizontal" role="form" method="post" action="<?php echo U('Member/doUpdateMember');?>">
				<div class="form-group">
					<label for="id" class="col-md-2 control-label">编　　号</label>
					<div class="col-md-9">
						<input type="text" class="form-control" id="id" name="id" placeholder="由系统自动分配" readonly="readonly" value="<?php echo ($data["id"]); ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="col-md-2 control-label">姓　　名</label>
					<div class="col-md-9">
						<input type="text" class="form-control" id="name" name="name" placeholder="姓名(不能为空)" value="<?php echo ($data["name"]); ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="col-md-2 control-label">班　　级</label>
					<div class="col-md-9">
						<input type="text" class="form-control" id="class1" name="class1" placeholder="班级(不能为空)" value="<?php echo ($data["class1"]); ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="col-md-2 control-label">类　　别</label>
					<div class="col-md-9">
						<input type="text" class="form-control" id="other" name="other" placeholder="类别" value="<?php echo ($data["other"]); ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="rules" class="col-md-2 control-label">值班时间</label>
					<div class="col-md-9">
						<input type="text" class="form-control" id="rules" name="rules" placeholder="示例：08:30-10:30, 10:30-13:30, 13:30-15:30, 15:30-18:00, 18:00-20:00" value="<?php echo ($data["rules"]); ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="limit_count" class="col-md-2 control-label">值班次数</label>
					<div class="col-md-9">
						<input type="text" class="form-control" id="limit_count" name="limit_count" placeholder="-1或留空表示不限次数, 0表示不能安排" value="<?php echo ($data["limit_count"]); ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="description" class="col-md-2 control-label">备　　注</label>
					<div class="col-md-9">
						<input type="text" class="form-control" id="description" name="description" placeholder="备注 (可以为空)" value="<?php echo ($data["description"]); ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="description" class="col-md-2 control-label">电　　话</label>
					<div class="col-md-9">
						<input type="text" class="form-control" id="phone" name="phone" placeholder="电话 (不可以为空)" value="<?php echo ($data["phone"]); ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="description" class="col-md-2 control-label">邮　　箱</label>
					<div class="col-md-9">
						<input type="text" class="form-control" id="email" name="email" placeholder="邮箱 (不可以为空)" value="<?php echo ($data["email"]); ?>">
					</div>
				</div>
				<br/>
				<div class="form-group">
					<div class="col-md-offset-2 col-md-10">
						<button class="btn btn-primary btn-md col-md-5" name="modify" onclick="javascript:history.back()">取消</button>
						<span class="col-md-1"></span>
						<button type="submit" class="btn btn-success btn-md col-md-5" name="modify">确认修改</button>
					</div>
				</div>
			</form>
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