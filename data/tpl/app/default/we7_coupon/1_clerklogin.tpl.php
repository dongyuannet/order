<?php defined('IN_IA') or exit('Access Denied');?><?php  define(MUI, true);?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<header class="mui-bar mui-bar-nav">
	<h1 class="mui-title">登陆</h1>
</header>
<div class="mui-content paycenter-login" id="login-form">
	<div class="mui-input-group">
		<div class="mui-input-row">
			<label>账号</label>
			<input type="text" name="username" value="" placeholder="请输入登录账号"/>
		</div>
		<div class="mui-input-row">
			<label>密码</label>
			<input type="password" name="password" value="" placeholder="请输入登录密码"/>
		</div>
	</div>
	<div class="mui-content-padded">
		<button class="mui-btn mui-btn-success mui-btn-block" id="login-submit" type="submit">登录</button>
	</div>
</div>
<script>
$(function(){
	$('#login-submit').click(function(){
		var username = $.trim($('#login-form :text[name="username"]').val());
		if(!username) {
			alert('账号不能为空');
			return false;
		}
		var password = $.trim($('#login-form input[name="password"]').val());
		if(!password) {
			alert('密码不能为空');
			return false;
		}
		$.post(location.href, {username: username, password: password}, function(data) {
			var result = $.parseJSON(data);
			if(result.message.errno != 0) {
				alert(result.message.message);
			} else {
				util.toast('登陆成功', result.redirect, 'success');
			}
			return false;
		});
	});
});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>