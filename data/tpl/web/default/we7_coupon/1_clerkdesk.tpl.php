<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('common/header-base', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
	.menu .page-header{border:none; border-left:0.3em #333 solid; padding-left:1em;}
	.menu .tile{display:block; float:left; margin:0.4em;padding:.2em 1em .5em 1em; width:8em; text-align:center; background:#EEE; color:#333; text-decoration:none;}
	.menu .tile:hover{background:#7dacdd; color:#FFF;}
	.menu .tile > i{display:block; font-size:2em; margin:0.3em auto 0 auto;}
	.menu .tile > span{display:block;}
</style>
<div class="head">
	<nav class="navbar navbar-default" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="<?php  echo $_W['siteroot'];?>">
					<img src="<?php  if(!empty($_W['setting']['copyright']['blogo'])) { ?><?php  echo tomedia($_W['setting']['copyright']['blogo'])?><?php  } else { ?>./resource/images/logo/logo.png<?php  } ?>" class="pull-left" width="110px" height="35px">
					<span class="version"><?php echo IMS_VERSION;?></span>
				</a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-left">
					<li class="active"><a href="">工作台首页</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="wi wi-user color-gray"></i><?php  echo $_W['user']['username'];?> <span class="caret"></span></a>
						<ul class="dropdown-menu color-gray" role="menu">
							<li>
								<a href="<?php  echo url('user/logout');?>"><i class="fa fa-sign-out color-gray"></i> 退出系统</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</div>
<div class="main">
	<div class="container">
		<div class="panel-body clearfix main-panel-body">
			<div class="right-content">
				<ul class="nav nav-tabs">
					<li<?php  if($op == 'index') { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWeburl('clerkdeskwelcome', array('op' => 'index'));?>">工作台</a></li>
				</ul>
				<?php  if($op == 'index') { ?>
				<div class="clearfix">
					<div class="clearfix menu">
						<?php  if(empty($permissions)) { ?>
						<div class="alert alert-danger">您没有操作权限.请联系公众号管理员</div>
						<?php  } else { ?>
							<?php  if(is_array($permissions)) { foreach($permissions as $row) { ?>
								<h5 class="page-header"><?php  echo $row['title'];?></h5>
								<div class="clearfix">
									<?php  if(is_array($row['items'])) { foreach($row['items'] as $row1) { ?>
										<a href="<?php  if($row1['type'] == 'url') { ?><?php  echo $row1['url'];?><?php  } else { ?>javascript:;<?php  } ?>" class="tile img-rounded<?php  if($row1['type'] == 'modal') { ?> modal-trade-<?php  echo $row1['url'];?><?php  } ?>" data-type="<?php  echo $row1['url'];?>">
											<i class="<?php  echo $row1['icon'];?>"></i>
											<span><?php  echo $row1['title'];?></span>
										</a>
									<?php  } } ?>
								</div>
							<?php  } } ?>
						<?php  } ?>
					</div>
				</div>
				<!-- 登陆二维码 -->
				<div class="modal fade" id="login-qrcode-modal" style="display:none;">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">扫描登陆二维码</h4>
							</div>
							<div class="modal-body" style="text-align:center;">
								<img style="-webkit-user-select: none" src="<?php  echo url('utility/wxcode/qrcode', array('text' => murl('entry', array('m' => 'we7_coupon', 'do' => 'clerk'), true, true)));?>">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	require({
		paths: {
			'trade': '/addons/we7_coupon/template/style/js/trade'
		}
	});
	require(['trade', 'bootstrap'], function(trade){
		trade.init();

		$('.login-qrcode').click(function(){
			$('#login-qrcode-modal').modal('show');
		});
	});
</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>