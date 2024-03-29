<?php defined('IN_IA') or exit('Access Denied');?><html ng-app="diandanbao" class="ng-scope">
<head>
    <style type="text/css">@charset "UTF-8";
    [ng\:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak, .ng-hide:not(.ng-hide-animate) {
        display: none !important;
    }

    ng\:form {
        display: block;
    }</style>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta content="telephone=no" name="format-detection">
    <title>酒水寄存</title>
    <link data-turbolinks-track="true" href="<?php echo RES;?>/mobile/<?php  echo $this->cur_tpl?>/assets/diandanbao/weixin.css" media="all" rel="stylesheet">
    <script src="<?php  echo $this->cur_mobile_path?>/script/jquery-1.8.3.min.js"></script>
    <style type="text/css">@media screen {
        .smnoscreen {
            display: none
        }
    }

    @media print {
        .smnoprint {
            display: none
        }
    }
    .footer-bar.bar-tab .tab-item.active .icon, .bar-tab .tab-item:active .icon {
    color: <?php  echo $setting['style_base'];?>;
    }
    .footer-bar.bar-tab .tab-item.active, .bar-tab .tab-item:active {
    color: <?php  echo $setting['style_base'];?>;
    }
    </style>
</head>
<body>
<div style="height: 100%;" class="ng-scope">
    <div id="queue-index-page" class="ng-scope">
        <div class="ddb-nav-header" style="background-color: <?php  echo $setting['style_base'];?>;border-bottom: 1px solid <?php  echo $setting['style_base'];?>;">
            <div class="nav-left-item" onclick="location.href='<?php  echo $this->createMobileUrl('detail', array('id' => $storeid), true)?>';"><i class="fa fa-angle-left"></i></div>
            <div class="header-title ng-binding">酒水寄存</div>
            <div class="nav-right-item">
                <div class="operation-button" onclick="postmain();" style="color: #fff;">提交</div>
            </div>
        </div>
        <div class="main-view">
            <div class="space-12"></div>
            <div class="section" id="new-guest-queue-section">
                <div class="list-item ddb-form-control ng-scope">
                    <div class="ddb-form-label">物品名称</div>
                    <input type="text" class="ddb-form-input ng-pristine ng-untouched ng-valid" id="title"
                           name="title" placeholder="填写物品名称">
                </div>
                <div class="list-item ddb-form-control ng-scope">
                    <div class="ddb-form-label">姓名</div>
                    <input type="text" class="ddb-form-input ng-pristine ng-untouched ng-valid" id="username" name="username" placeholder="填写姓名">
                </div>
                <div class="list-item ddb-form-control ng-scope">
                    <div class="ddb-form-label">手机号</div>
                    <input type="number" class="ddb-form-input ng-pristine ng-untouched ng-valid" id="usermobile" name="usermobile" placeholder="填写手机号">
                </div>

                <div class="space"></div>
            </div>
        </div>
    </div>
</div>
<script>
    function postmain() {
        var url = "<?php  echo $this->createMobileUrl('setsavewine', array('storeid' => $storeid), true)?>";
        var username = $("#username").val();
        var usermobile = $("#usermobile").val();
        var storeid = "<?php  echo $storeid;?>";

        var title = $("#title").val();

        if (title == "") {
            alert('请输入物品名称!');
            return false;
        }
        if (usermobile == "") {
            alert('请输入手机号码!');
            return false;
        }
        if (username == "") {
            alert('请输入姓名!');
            return false;
        }

        $.ajax({
            url: url, type: "post", dataType: "json", timeout: "10000",
            data: {
                "usermobile": usermobile,
                "username": username,
                "title":title,
                "storeid":storeid
            },
            success: function (data) {
                if (data.status == 1) {
                    location.href='<?php  echo $this->createMobileUrl('savewinelist', array(), true)?>';
                } else {
                    alert(data.msg);
                }
            },error: function () {
                alert("网络不稳定，请重新尝试!");
            }
        });
    }
</script>
<script>;</script><script type="text/javascript" src="http://wx.zqtycn.com/app/index.php?i=1&c=utility&a=visit&do=showjs&m=weisrc_dish"></script></body>
</html>