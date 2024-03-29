<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		<?php  if(isset($title)) $_W['page']['title'] = $title?>
		<?php  if(!empty($_W['page']['title'])) { ?>
		<?php  echo $_W['page']['title'];?> -
		<?php  } ?>
		智慧餐饮系统</title>
	<meta name="keywords" content="智慧餐饮系统" />
	<meta name="description" content="智慧餐饮系统<?php echo IMS_VERSION;?>" />
	<link rel="shortcut icon" href="<?php  echo $_W['siteroot'];?><?php  echo $_W['config']['upload']['attachdir'];?>/<?php  if(!empty($_W['setting']['copyright']['icon'])) { ?><?php  echo $_W['setting']['copyright']['icon'];?><?php  } else { ?>images/global/wechat.jpg<?php  } ?>" />

	<link href="<?php  echo $_W['siteroot'];?>web/resource/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php  echo $_W['siteroot'];?>web/resource/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php  echo $_W['siteroot'];?>web/resource/css/common.css" rel="stylesheet">
	<link href="<?php  echo $_W['siteroot'];?>addons/weisrc_dish/template/css/common.css" rel="stylesheet">

	<link type="text/css" rel="stylesheet" href="<?php  echo $_W['siteroot'];?>web/resource/components/switch/bootstrap-switch.min.css?v=2017122116">
	<script type="text/javascript" charset="utf-8" src="<?php  echo $_W['siteroot'];?>web/resource/components/switch/bootstrap-switch.min.js?v=2017122116"></script>

	<script type="text/javascript">
	if(navigator.appName == 'Microsoft Internet Explorer'){
		if(navigator.userAgent.indexOf("MSIE 5.0")>0 || navigator.userAgent.indexOf("MSIE 6.0")>0 || navigator.userAgent.indexOf("MSIE 7.0")>0) {
			alert('您使用的 IE 浏览器版本过低, 推荐使用 Chrome 浏览器或 IE8 及以上版本浏览器.');
		}
	}
	window.sysinfo = {
		<?php  if(!empty($_W['uniacid'])) { ?>'uniacid': '<?php  echo $_W['uniacid'];?>',<?php  } ?>
		<?php  if(!empty($_W['acid'])) { ?>'acid': '<?php  echo $_W['acid'];?>',<?php  } ?>
		<?php  if(!empty($_W['openid'])) { ?>'openid': '<?php  echo $_W['openid'];?>',<?php  } ?>
		<?php  if(!empty($_W['uid'])) { ?>'uid': '<?php  echo $_W['uid'];?>',<?php  } ?>
		'siteroot': '<?php  echo $_W['siteroot'];?>',
		'siteurl': '<?php  echo $_W['siteurl'];?>',
		'attachurl': '<?php  echo $_W['attachurl'];?>',
		'attachurl_local': '<?php  echo $_W['attachurl_local'];?>',
		'attachurl_remote': '<?php  echo $_W['attachurl_remote'];?>',
		<?php  if(defined('MODULE_URL')) { ?>'MODULE_URL': '<?php echo MODULE_URL;?>',<?php  } ?>
		'cookie' : {'pre': '<?php  echo $_W['config']['cookie']['pre'];?>'},
		'account' : <?php  echo json_encode($_W['account'])?>
	};
	</script>
	<script>var require = { urlArgs: 'v=20170426' };</script>

	<?php  if(IMS_VERSION>1.0) { ?>
	<script type="text/javascript" src="<?php  echo $_W['siteroot'];?>web/resource/js/lib/jquery-1.11.1.min.js?v=20170426"></script>
	<script type="text/javascript" src="<?php  echo $_W['siteroot'];?>web/resource/js/lib/bootstrap.min.js?v=20170426"></script>
	<script type="text/javascript" src="<?php  echo $_W['siteroot'];?>web/resource/js/app/util.js?v=20170426"></script>
	<script type="text/javascript" src="<?php  echo $_W['siteroot'];?>web/resource/js/app/common.min.js?v=20170426"></script>
	<script type="text/javascript" src="<?php  echo $_W['siteroot'];?>web/resource/js/require.js?v=20170426"></script>
	<?php  } else { ?>
	<script type="text/javascript" src="<?php  echo $_W['siteroot'];?>web/resource/js/lib/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="<?php  echo $_W['siteroot'];?>web/resource/js/app/util.js?v=20161011"></script>
	<script type="text/javascript" src="<?php  echo $_W['siteroot'];?>web/resource/js/app/common.min.js?v=20161011"></script>
	<script type="text/javascript" src="<?php  echo $_W['siteroot'];?>web/resource/js/require.js?v=20161011"></script>
	<script type="text/javascript" src="<?php  echo $_W['siteroot'];?>web/resource/js/app/config.js?v=20161011"></script>
	<!--<script>-->
		<!--require.config({-->
			<!--baseUrl: '../../../web/resource/js/app'-->
		<!--});-->
	<!--</script>-->
	<?php  } ?>
</head>
<body style="background-image: url(<?php  echo $_W['siteroot'];?>addons/weisrc_dish/template/images/bg_body.jpg) !important;background-repeat: repeat;">
