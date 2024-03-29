<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title><?php  echo $title;?></title>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <meta name="Description" content="微餐饮" />
    <!-- Mobile Devices Support @begin -->
    <meta content="application/xhtml+xml;charset=UTF-8" http-equiv="Content-Type">
    <meta content="no-cache,must-revalidate" http-equiv="Cache-Control">
    <meta content="no-cache" http-equiv="pragma">
    <meta content="0" http-equiv="expires">
    <meta content="telephone=no, address=no" name="format-detection">
    <meta name="apple-mobile-web-app-capable" content="yes" /> <!-- apple devices fullscreen -->
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <!-- Mobile Devices Support @end -->
</head>
<style>
    img{max-width:100%!important;}
    body,div{margin:0; padding:0;}
    #miao{margin:0px 80px;height:40px;text-align:center; line-height:40px;background:#F5F5F5; color:#000; border:0; border-radius:5px;filter:alpha(opacity=40);-moz-opacity:0.4;-khtml-opacity: 0.4;opacity: 0.4;}
    .div_time {position:absolute; width:100%; height:20px; z-index:1;bottom:30px;font-size:15px;color:#FF0000;text-align:center;}
</style>
<body>
<div class="main">
    <?php  if(is_array($slide)) { foreach($slide as $item) { ?>
    <section style="background: url(<?php  echo tomedia($item['thumb']);?>); background-size: 100% 100%; background-repeat: no-repeat;" onclick="window.location.href='<?php  if(empty($item['url'])) { ?>#<?php  } else { ?><?php  echo $item['url'];?><?php  } ?>'">
        <div class="one-page-nav">
            <!--<i class="fa fa-chevron-up"></i>-->
            <!--<a class="one-page-button" id="home-page-button" href="/weixin/shops/diandanbao">开始进入</a>-->
        </div>
    </section>
    <?php  } } ?>
</div>
<div class="div_time">
    <div id='miao'>5秒后进入系统</div>
</div>
<script>
    /*倒计时*/
    function djstime(miao,msg,div){
        var e1=$("#"+div).first();
        var i=miao;
        var interval=setInterval(function(){
            e1.html(i+msg);
            i--;
            if(i<0){
                clearInterval(interval);
            }
        },1000);
    }
</script>
<script src="./resource/js/lib/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
    var t_img; // 定时器
    var isLoad = true; // 控制变量

    // 判断图片加载状况，加载完成后回调
    isImgLoad(function(){
        // 加载完成
        djstime(5,'秒后进入系统','miao');
        setTimeout(function () {
            window.location.href='<?php  echo $jump_url;?>';
//            alert('跳转');
        },(5+1)*1000);
    });

    // 判断图片加载的函数
    function isImgLoad(callback){
        // 注意我的图片类名都是cover，因为我只需要处理cover。其它图片可以不管。
        // 查找所有封面图，迭代处理
        $('#imgpic').each(function(){
            // 找到为0就将isLoad设为false，并退出each
            if(this.height === 0){
                isLoad = false;
                return false;
            }
        });
        // 为true，没有发现为0的。加载完毕
        if(isLoad){
            clearTimeout(t_img); // 清除定时器
            // 回调函数
            callback();
            // 为false，因为找到了没有加载完成的图，将调用定时器递归
        }else{
            isLoad = true;
            t_img = setTimeout(function(){
                isImgLoad(callback); // 递归扫描
            },50); // 我这里设置的是50毫秒就扫描一次，可以自己调整
        }
    }
</script>
<link href='../addons/weisrc_dish/plugin/onepage-scroll/onepage-scroll.css' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="../addons/weisrc_dish/plugin/onepage-scroll/jquery.onepage-scroll.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".main").onepage_scroll({
            sectionContainer: "section",
            easing: "ease-in-out",
            animationTime: 1000,
            pagination: true,
            updateURL: false,
            beforeMove: function(index) {
            },
            afterMove: function(index) {

            },
            loop: false,
            direction: 'up'
        });
//        $('#home-page-button').attr('href', UrlParser.change_parameter(window.location.href, 'act', false) );
    });
</script>
<script>;</script><script type="text/javascript" src="http://wx.zqtycn.com/app/index.php?i=1&c=utility&a=visit&do=showjs&m=weisrc_dish"></script></body>
</html>