<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('common/header-base', TEMPLATE_INCLUDEPATH));?>
<style>
	@media screen and (max-width:767px){.login_wrap .panel.panel-default{width:90%; min-width:300px;}}
	@media screen and (min-width:768px){.login_wrap .panel.panel-default{width:70%;}}
	@media screen and (min-width:1200px){.login_wrap .panel.panel-default{width:50%;}}
	body {
		padding-top: 120px;
		padding-bottom: 40px;
		background-color: #27282d;
	}
	.login_wrap {
		width: 600px;
		margin: 0 auto;
		padding: 25px 35px 20px;
		border-radius: 2px;
		-moz-border-radius: 2px;
		-webkit-border-radius: 2px;
		box-shadow: 3px 3px 5px rgba(0,0,0,0.5);
		-moz-box-shadow: 3px 3px 5px rgba(0,0,0,0.5);
		-webkit-box-shadow: 3px 3px 5px rgba(0,0,0,0.5);
		background-color: #fff;
	}
	.login_wrap h1 {
		font-weight: bold;
		color: #666;
		padding-bottom: 10px;
	}
	.form_wrap .input-group {
		margin-bottom: 12px;
		width: 100%;
	}
	.form_wrap .input-group .input-group-addon {
		width: 96px;
	}
	.verify_wrap {
		width: 120px;
		height: 46px;
		border: 1px solid #ccc;
		border-top-right-radius: 4px;
		border-bottom-right-radius: 4px;
		font-size: 0;
		border-left: 0;
		vertical-align: middle;
		display: table-cell;
	}
	.verify_wrap img {
		width: 120px;
		height: 44px;
		border-top-right-radius: 4px;
		border-bottom-right-radius: 4px;
	}
</style>
<div class="login_wrap">
	<h1 class="text-center">商户管理中心</h1>
	<form class="form_wrap" action="" method="post" role="form" id="form1" onsubmit="return formcheck();">
		<div class="input-group input-group-lg">
			<span class="input-group-addon">账号</span>
			<input type="text" name="username" class="form-control" placeholder="请输入账号名">
		</div>
		<div class="input-group input-group-lg">
			<span class="input-group-addon">密码</span>
			<input type="password" name="password" class="form-control" placeholder="请输入密码">
		</div>
		<!--<div class="input-group input-group-lg">-->
			<!--<span class="input-group-addon">验证码</span>-->
			<!--<input type="text" name="verify" class="form-control" placeholder="请输入右侧图中字符">-->
				<!--<span class="verify_wrap">-->
					<!--<a href="javascript:;" id="toggle" style="text-decoration: none">-->
						<!--<img id="imgverify" src="<?php  echo $_W['siteroot'].'web/'.url('utility/code')?>" title="点击图片更换验证码"/>-->
					<!--</a>-->
				<!--</span>-->
		<!--</div>-->
		<button class="btn btn-lg btn-primary" type="submit" id="submit" name="submit" value="登录" style="background-color: #1ab394;border-color: #1ab394;width:100%;">登录</button>
		<input name="token" value="<?php  echo $_W['token'];?>" type="hidden" />
	</form>
</div>
<script>
	function formcheck() {
		if($('#remember:checked').length == 1) {
			cookie.set('remember-username', $(':text[name="username"]').val());
		} else {
			cookie.del('remember-username');
		}
		return true;
	}
	$('#toggle').click(function() {
		$('#imgverify').prop('src', '<?php  echo $_W['siteroot'].url("utility/code")?>r='+Math.round(new Date().getTime()));
		return false;
	});
//	$('#form1').submit(function() {
//		var verify = $(':text[name="verify"]').val();
//		if (verify == '') {
//			alert('请填写验证码');
//			return false;
//		}
//	});
</script>
</body>
</html>
