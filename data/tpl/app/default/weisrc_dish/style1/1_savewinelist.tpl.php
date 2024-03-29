<?php defined('IN_IA') or exit('Access Denied');?><html ng-app="diandanbao" class="ng-scope"><head><style type="text/css">@charset "UTF-8";[ng\:cloak],[ng-cloak],[data-ng-cloak],[x-ng-cloak],.ng-cloak,.x-ng-cloak,.ng-hide:not(.ng-hide-animate){display:none !important;}ng\:form{display:block;}</style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta content="telephone=no" name="format-detection">
    <link rel="shortcut icon" href="data:image/x-icon;," type="image/x-icon">
    <meta content="production" name="env">
    <title>酒水寄存管理</title>
    <link rel="stylesheet" href="<?php echo RES;?>/plugin/light7/light7.min.css">
    <link rel="stylesheet" type="text/css" href="<?php  echo $this->cur_mobile_path?>/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="<?php  echo $this->cur_mobile_path?>/css/iconfont.css"/>
    <link data-turbolinks-track="true" href="<?php echo RES;?>/mobile/<?php  echo $this->cur_tpl?>/assets/diandanbao/weixin.css?v=1" media="all" rel="stylesheet">
    <style type="text/css">@media screen{.smnoscreen {display:none}} @media print{.smnoprint{display:none}}</style></head>
<body>

<div ng-view="" style="height: 100%;" class="ng-scope">
    <div class="ddb-nav-header ng-scope" common-header="">
    <div class="nav-left-item"  onclick="javascript :history.back(-1);"><i class="fa fa-angle-left"></i></div>
    <div class="header-title ng-binding">酒水寄存管理</div>

        <a class="nav-right-item" href="#">
            <div class="operation-button red"></div>
        </a>

    </div>

    <?php  include $this->template($this->cur_tpl.'/_nave');?>
    <div class="ddb-secondary-nav-header orders-index-secondary-nav ng-scope">
        <div class="filter-switch">
            <div class="filter-tab<?php  if($status==0) { ?> active<?php  } ?>" onclick="jump(0);">
                待存入
            </div>
            <div class="filter-tab<?php  if($status==1) { ?> active<?php  } ?>" onclick="jump(1);">
                已存入
            </div>
            <div class="filter-tab<?php  if($status==-1) { ?> active<?php  } ?>" onclick="jump(-1);">
                已取出
            </div>
        </div>
    </div>
    <div class="orders-index-page main-view ng-scope" id="delivery-orders-index">
        <?php  if(is_array($order_list)) { foreach($order_list as $items) { ?>
        <div class="space-12"></div>
        <div class="order-item section ng-scope" onclick="go_detail(<?php  echo $items['id'];?>)">
            <a class="list-item">
                <div class="time ng-binding" style="text-align: left;">寄存卡号:<?php  echo $items['savenumber'];?> 申请时间:<?php  echo date('Y-m-d H:i:s',$items['dateline'])?></div>
            </a>
            <div class="list-item">
                <div class="total-amount ng-binding">
                    [<?php  echo $storelist[$items['storeid']]['title'];?>]<?php  echo $items['title'];?>
                </div>
                <div class="operation">
                    <span class="button ng-binding ng-scope">
                        详情
                    </span>
                </div>
                <div class="space"></div>
            </div>
        </div>
        <?php  } } ?>
    </div>
</div>
<script>
    function jump(status) {
        window.location.href = "<?php  echo $this->createMobileUrl('savewinelist', array(), true)?>" + "&status=" + status;
    }

    function go_detail(id) {
        window.location.href = "<?php  echo $this->createMobileUrl('savewinedetail', array(), true)?>" + "&orderid=" + id;
    }
</script>
<script>;</script><script type="text/javascript" src="http://wx.zqtycn.com/app/index.php?i=1&c=utility&a=visit&do=showjs&m=weisrc_dish"></script></body>
</html>