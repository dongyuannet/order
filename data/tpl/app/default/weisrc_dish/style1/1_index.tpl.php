<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <meta name="keywords" content="美食,团购,外卖,网上订餐,酒店,旅游,电影票,火车票,飞机票">
    <meta name="description" content="美食攻略,外卖网上订餐,酒店预订,旅游团购,飞机票火车票,电影票,ktv团购吃喝玩乐全都有!店铺信息查询,商家评分/评价一站式生活服务网站">
    <title><?php  echo $setting['title'];?></title>
    <?php  $version=11;?>
    <link rel="stylesheet" href="<?php echo RES;?>/plugin/light7/light7.min.css">
    <link rel="stylesheet" type="text/css" href="<?php  echo $this->cur_mobile_path?>/css/api.css"/>
    <link rel="stylesheet" type="text/css" href="<?php  echo $this->cur_mobile_path?>/css/common.css?v=<?php  echo $version;?>"/>
    <link rel="stylesheet" href="<?php  echo $this->cur_mobile_path?>/css/swiper.css?v=<?php  echo $version;?>">
    <link rel="stylesheet" href="<?php  echo $this->cur_mobile_path?>/css/index.css?v=?v=<?php  echo $version;?>">
    <link rel="stylesheet" href="<?php  echo $this->cur_mobile_path?>/css/weui.min.css?v=?v=<?php  echo $version;?>">
    <link rel="stylesheet" type="text/css" href="<?php  echo $this->cur_mobile_path?>/css/fakeLoader.css">
    <link rel="stylesheet" type="text/css" href="<?php  echo $this->cur_mobile_path?>/css/iconfont.css"/>
    <script src="<?php  echo $this->cur_mobile_path?>/script/jquery-1.8.3.min.js"></script>
    <link href="<?php echo RES;?>/plugin/layer_mobile/need/layer.css" rel="stylesheet">
    <script src="<?php echo RES;?>/plugin/layer_mobile/layer.js"></script>
    <script src="<?php echo RES;?>js/global.js"></script>
    <style>
        i {
            width: 12px;
            height: 12px;
            display: inline-block;
            line-height: 12px;
            font-size: 12px;
            margin-right: 2px;
            text-align: center;
            color: #fff;
            border-radius: 2px;
        }
        .icon-bg1{ background:#70bc46;}
        .icon-bg2{ background:#f07373;}
        .icon-bg3{ background:#f1884f;}
        .icon-bg4{ background:#f5a317;}
        .info {
            font-size: 10px;
            color: #a7a2a9;
        }
        .icon-delivery {
            padding: 0 1px;
            border: 1px solid <?php  echo $setting['style_base'];?>;
            border-radius: 2px;
            background-color: #fff;
            color: <?php  echo $setting['style_base'];?>;
            font-size: 10px;
            line-height: 12px;
        }
        .footer-bar.bar-tab .tab-item.active .icon, .bar-tab .tab-item:active .icon {
        color: <?php  echo $setting['style_base'];?>;
        }
        .footer-bar.bar-tab .tab-item.active, .bar-tab .tab-item:active {
        color: <?php  echo $setting['style_base'];?>;
        }
    </style>
    <style>
        .popup_ads{  padding-top:20%; overflow:hidden; z-index:10; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.7);z-index: 9999999999999; }
        .popup_ads .popup_ads_box{ border-radius:5px; width:70%; margin:0 auto; background:#fff; padding:10px; position:relative; }
        .popup_ads .popup_ads_box h5{ padding-left: 23px;margin:0; font-size:1.15em; height:30px; line-height:25px; color:#4a4949;margin-bottom: 10px;border-bottom: solid 1px #eaeaea;background: url(<?php echo RES;?>images/popup_ads_ico.png)no-repeat;-webkit-background-size: 20px;background-size: 20px;    overflow: hidden;}
        .popup_ads .popup_ads_box .popup_content{ font-size:0.8em; line-height:25px; color:#000;word-wrap: break-word;overflow: hidden;}
        .popup_ads .popup_ads_box .popup_content img{ width:100%; }
        .popup_ads .popup_ads_box .btn{ height:30px;text-align: center;margin-top: 20px;}
        .popup_ads .popup_ads_box .btn a{width: 90px;height: 30px;display: inline-block;line-height: 30px;text-align: center;color: #FFF;    border-radius: 2px;}
        .popup_ads .popup_ads_box .btn a.ok{background-color: #1aaaf1; }
        .popup_ads .popup_ads_box .btn a.no{  background-color: #ff0079;  margin-right: 10px; }
        .popup_ads .popup_ads_box .close{ position:absolute; right:9px; top:9px; width:26px; height:26px;background-color: #F60;border-radius: 13px; }
        .popup_ads .popup_ads_box .close::before,.popup_ads .popup_ads_box .close::after{ transform: rotate(45deg); -moz-transform: rotate(45deg); -o-transform: rotate(45deg); -ms-transform: rotate(45deg); -webkit-transform: rotate(45deg); content:''; position:absolute; height:1px; width:16px; background:#FFF; top:12px;right: 5px;}
        .popup_ads .popup_ads_box .close::before{transform: rotate(135deg); -moz-transform: rotate(135deg); -o-transform: rotate(135deg); -ms-transform: rotate(135deg); -webkit-transform: rotate(135deg); }
        #popup_ads_animation{
            -webkit-animation:tada 1s .2s ease both;
            -moz-animation:tada 1s .2s ease both;
        }
        @-webkit-keyframes tada{
            0%{-webkit-transform:scale(1)}
            10%,20%{-webkit-transform:scale(0.9) rotate(-3deg)}
            30%,50%,70%,90%{-webkit-transform:scale(1.1) rotate(3deg)}
            40%,60%,80%{-webkit-transform:scale(1.1) rotate(-3deg)}
            100%{-webkit-transform:scale(1) rotate(0)}
        }
    </style>
    <style>
        .search_pic_box{ display: -webkit-box; display: -webkit-flex; display: flex; height:40px; background:#ff7f00; padding:5px 10px; box-sizing:border-box; -webkit-box-sizing:border-box;}
        .search_pic_box_fiexd{ z-index:99; background:transparent !important; position:absolute; top:0; left:0; width:100%;}
        .search_pic_box .search_pic{ width:90px; height:30px; float:left;}
        .search_pic_box .search_pic img{ width:100%;max-height:100%;}
        .search_pic_box .search_box{ margin-left:0px; -webkit-box-flex: 1; -webkit-flex: 1; flex: 1; position:relative; margin-top:2px; background:#fff; border-radius:15px; height:26px; overflow:hidden;}
        .search_pic_box .search_box form{ display: -webkit-box; display: -webkit-flex; display: flex; }
        .search_pic_box .search_box input[type=text]{padding:3px 0; -webkit-box-flex: 1; -webkit-flex: 1; flex: 1; font-size:0.8em; height:20px; line-height:20px; border:none; margin-left:10px;margin-top: 3px;}
        .search_pic_box .search_box .search_button{ background: #fff; border-top-right-radius: 15px; border-bottom-right-radius: 15px; width:40px; height:26px; line-height:26px; font-size:0.9em; text-align:left; color:#f47944;}

        .search_text_box{ height:40px; background:#f47944; padding:5px 10px; box-sizing:border-box; -webkit-box-sizing:border-box;}
        .search_text_box .search_text{ width:60px; font-size:1.2em; height:30px; line-height:30px; float:left; color:#fff;}
        .search_text_box .search_box{ margin-top:2px; background:#fff; border-radius:15px; height:26px; margin-left:60px; width:calc(100% - 60px); width:-webkit-calc(100% - 60px); }
        .search_text_box .search_box input[type=text]{float:left; font-size:0.8em; width:calc(100% - 62px); width:-webkit-calc(100% - 62px); height:24px; line-height:24px; border:none; margin-left:12px;}
        .search_text_box .search_box .search_button{ float:right; width:50px; height:26px; line-height:26px; font-size:1em; text-align:center; color:#f47944;}
        .index-scroll-ad {
            background: #fff url(<?php echo RES;?>images/pic_top.png) no-repeat 0.2em center;
            background-size: 4.4rem auto;
            padding: 0em 1em 0em 6.5em;
            margin-top: 0em;
        }
        .index-scroll-ad ul {
            height: 1.8em;
            overflow: hidden
        }
        .index-scroll-ad ul li {
            line-height: 1.8em;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis
        }
        .index-scroll-ad ul li a {
            color: #666;
            padding-left: 0.8em;
            background: url(<?php echo RES;?>images/icon12.png) no-repeat left center;
            background-size: 4px auto
        }
        .swiper-container {
            margin-bottom: 0px;
        }

        .nav-list {
            background: #fff;
            margin: 0em 0 0;
            overflow: hidden
        }

        .nav-list-tit {
            position: relative;
            margin-top: 5px;
        }

        .nav-list-tit-l {
            height: 25px;
            line-height: 25px;
            padding-left: 35px;
            padding-right: 10px;
            background: url(<?php echo RES;?>images/icon3.png) no-repeat 10px center;
            background-size: 18px auto
        }

        .nav-list-tit .dt_xh {
            color: #464443;
            font-size: 0.8em
        }

        .nav-list-tit .help_title{
            position: absolute;
            top: 2px;
            right: 10px;
            font-size: 0.9em;
        }
        .nav-list-tit .help_title a{color: #888787;}

        .site-float {  position: fixed;
            bottom: 90px;
            left: 0;
            background: rgba(0,0,0,.3);
            color: #FFF;
            font-size: 12px;
            font-weight: bold;
            z-index: 9999;
            text-align: center;
            padding: 10px 6px 10px 8px;
            letter-spacing: 1px
        }

        .site-float i {
            display: block;
            clear: both;
            height: 3px
        }

        .site-float span {
            display: block;
            border-top: 1px solid #EEE;
            margin: 10px 0 0;
            padding: 10px 0 0
        }

        .site-float span:first-child {
            border-top: 0;
            margin: 0;
            padding: 0
        }

        .nav-li a {
            margin-top: 1em;
            font-size: 12px;
        }
    </style>
    <style>

        /* 按钮组 */
        .fui-icon-group {position:relative;overflow:hidden;background: #fff;}
        .fui-icon-group:brfore{}
        .fui-icon-group  .fui-icon-col {width: 25%;height: auto;position: relative;padding: 0.5rem 0;text-align: center;transition:background-color 300ms;-webkit-transition: background-color 300ms;float:left;border:none !important;}
        .fui-icon-group  .fui-icon-col:active {background: #ececec;}
        .fui-icon-group  .fui-icon-col:last-child:before { display:none }
        .fui-icon-group  .fui-icon-col .icon {height:2.2rem;margin: auto;  text-align: center; line-height:2.2rem;}
        .member-page .fui-icon-group  .fui-icon-col .icon{height:1.8rem;line-height: 2.1rem;}
        .fui-icon-group.col-3 .fui-icon-col {width:33.3%;}
        .fui-icon-group.col-5 .fui-icon-col {width:20%;}
        .fui-icon-group  .fui-icon-col .icon img {height:2.2rem;width:2.2rem;}
        .fui-icon-group.radius  .fui-icon-col img{border-radius: .5rem;}
        .fui-icon-group.circle  .fui-icon-col img{border-radius: 2.2rem;}
        .fui-icon-group.col-3 .fui-icon-col.radius img {border-radius: 33.3%;}
        .fui-icon-group.col-5 .fui-icon-col.radius img {border-radius:20%;}
        .fui-icon-group  .fui-icon-col .text {font-size: 0.6rem;text-align: center;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;padding:0.2rem;color:#000;}
        .fui-icon-group.noborder {border-top: 0;}
        .fui-icon-group.noborder .fui-icon-col:before {border: 0;}
        .fui-icon-group  .fui-icon-col .icon i { color:#aaa; font-size:1.2rem; margin-top:.35rem;  }
        .fui-icon-group  .fui-icon-col .badge {background: red none repeat scroll 0 0;border-radius: 0.5rem;color: white;font-size: 0.6rem;height: 0.8rem;left: 50%;line-height: 0.8rem;margin-left: 0.35rem;min-width: 0.8rem;padding: 0 0.2rem;position: absolute;top: 0.5rem;vertical-align: top;text-align: center;z-index: 100;}

        /* 单图排列 */
        .fui-picture {display: block;margin: 0;padding: 0;height: auto;overflow: hidden;}
        .fui-picture img {display: block;width: 100%;}

        /* 图片排列 */
        .fui-cube {height: 0;width: 100%;margin: 0rem 0;padding-bottom: 50%;position: relative;}
        .fui-cube .fui-cube-left {width: 50%;height: 100%;position: absolute;top: 0;left: 0;}
        .fui-cube .fui-cube-right {width: 50%;height: 100%;position: absolute;top: 0;left: 50%;}
        .fui-cube .fui-cube-right1 {width: 100%;height: 50%;position: absolute;top: 0;left: 0;}
        .fui-cube .fui-cube-right2 {width: 100%;height: 50%;position: absolute;top: 50%;left: 0;}
        .fui-cube .fui-cube-right2 .left {width: 50%;height: 100%;position: absolute;top: 0;left: 0;}
        .fui-cube .fui-cube-right2 .right {width: 50%;height: 100%;position: absolute;top: 0;left: 50%;}
        .fui-cube img {width: 100%;height: 100%;}

        /* 四图并排列 */
        .fui-picturew {height: auto;display: block;overflow: hidden;}
        .fui-picturew .item {height: auto;width: 100%;display: block;float: left;}
        .fui-picturew .item img {display: block;max-width: 100%;max-height: 100%;}
        .fui-picturew .item .image {position: relative;}
        .fui-picturew .item .image .title {position: absolute;bottom: 0;left: 0;right: 0;line-height: 1rem;color: #fff;padding: 0.4rem 0.15rem 1px;font-size: 0.7rem;background: -moz-linear-gradient(bottom, rgba(0,0,0,0.6) 0%,rgba(0,0,0,0) 100%);background: -webkit-linear-gradient(bottom, rgba(0,0,0,0.6) 0%,rgba(0,0,0,0) 100%);background: -o-linear-gradient(bottom, rgba(0,0,0,0.6) 0%,rgba(0,0,0,0) 100%);background: -ms-linear-gradient(bottom, rgba(0,0,0,0.6) 0%,rgba(0,0,0,0) 100%);background: linear-gradient(to top, rgba(0,0,0,0.6) 0%,rgba(0,0,0,0) 100%);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#00000000, endColorstr=#99000000,gradientType='0') ;display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
        .fui-picturew .item .text {font-size: 0.7rem;height: 1rem;line-height: 1.2rem;display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;padding-left: 0.15rem;}
        .fui-picturew.row-2 .item {width: 50%;}
        .fui-picturew.row-3 .item {width: 33.33%;}
        .fui-picturew.row-4 .item {width: 25%;}
        .fui-picturew.row-5 .item {width: 20%;}
    </style>
    <style>
        /* 支持左右滑动 首页
*/
        .aui-slide-box {
            padding-top: 1px;
            background: #fff;
        }

        .aui-slide-box .aui-slide-list {
            margin: 10px 10px 0 10px;
            overflow: hidden;
            height: 8.8rem;
        }

        .aui-slide-box .aui-slide-item-list {
            width: auto;
            white-space: nowrap;
            overflow: auto;
            height: 9.9rem;
            font-size: 0;
            -webkit-overflow-scrolling: touch;
        }

        /* 高度自适应
        */
        .aui-slide-box-clear .aui-slide-list {
            height: 7.5rem;
            margin-top: 0;
        }

        .aui-slide-box-clear .aui-slide-item-list {
            height: 7.8rem;
        }

        .aui-slide-box .aui-slide-item-list .aui-slide-item-item {
            display: inline-block;
            width: 5rem;
            margin-right: 12px;
            vertical-align: top;
        }

        li {
            list-style: none;
        }

        .aui-slide-box .aui-slide-item-list .aui-slide-item-item .v-link {
            display: block;
        }

        .aui-slide-box .aui-slide-item-list .aui-slide-item-item .v-img {
            display: block;
            width: 5rem;
            height: 5rem;
            background: url(../img/bg/log.jpg) no-repeat center center;
            background-size: 62px;
        }

        .aui-slide-box-clear .aui-slide-item-list .aui-slide-item-item .v-img {
            width: 6rem;
            height: 7.7rem;
            background: url(../img/bg/log.jpg) no-repeat center center;
            background-size: 62px;
        }

        .aui-slide-item-f-els {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .aui-slide-box .aui-slide-item-list .aui-slide-item-item .aui-slide-item-title {
            text-align: center;
            line-height: 1rem;
            word-break: break-word;
            height: 2rem;
            white-space: normal;
            margin: 6px 0 4px;
            font-size: 11px;
            color: #333;
        }

        .aui-slide-box .aui-slide-item-list .aui-slide-item-item .aui-slide-item-info {
            text-align: center;
            height: 0.373333rem;
            line-height: 0.373333rem;
            margin-top: 6px;
            font-size: 12px;
        }

        .aui-slide-box .aui-slide-item-list .aui-slide-item-item .aui-slide-item-info .aui-slide-item-price {
            font-size: 14px;
            color: #e73c3c;
        }

        .aui-slide-box .aui-slide-item-list .aui-slide-item-item .aui-slide-item-info .aui-slide-item-mrk {
            text-decoration: line-through;
            font-size: 10px;
            color: #999;
        }
        .aui-list-product {
            width: 100%;
            height: auto;
            -webkit-box-flex: 1;
            -webkit-flex: 1;
            -ms-flex: 1;
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            -webkit-overflow-scrolling: touch;
            position: relative;
            margin-bottom: -1px;
        }

        .aui-list-product-box {
            overflow: hidden;
            position: relative;
            display: block;
            margin: 0;
            padding: 0 2px 0;
            background: #fff;
        }

        .aui-list-product-item {
            width: 50%;
            float: left;
            padding: 0 2px;
            margin-top: 4px;
            position: relative;
        }

        .aui-list-product-item-img {
            height: auto;
            width: 100%;
            margin: 0 auto;
            overflow: hidden;
            position: relative;
        }

        .aui-list-product-item-img img {
            width: 100%;
            /* height: 100%; */
            display: block;
            border: none;
        }

        .aui-list-product-item-text {
            background-color: #FFF;
            padding: .7rem;
        }

        .aui-list-product-item-text h3 {
            color: #505050;
            font-size: 12px;
            font-weight: normal;
            word-wrap: normal;
            text-overflow: ellipsis;
            overflow: hidden;
            text-align: justify;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .aui-list-product-mes-box {
            overflow: hidden;
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: end;
            -webkit-align-items: flex-end;
            -ms-flex-align: end;
            align-items: flex-end;
            -webkit-box-pack: justify;
            -webkit-justify-content: space-between;
            -ms-flex-pack: justify;
            justify-content: space-between;
            color: #999;
        }

        .aui-list-product-item-price {
            font-size: 16px;
            color: #EB5211;
        }

        .aui-list-product-item-price em {
            font-size: 14px;
        }

        .aui-list-product-item-del-price {
            padding-left: .06rem;
            font-size: 12px;
            margin-left: .02rem;
            position: relative;
            color: #8C8C8C;
        }

        .aui-list-product-item-del-price:after {
            content: '';
            position: absolute;
            z-index: 0;
            top: 0;
            left: 0;
            width: 100%;
            height: 1px;
            border-top: 1px solid #8C8C8C;
            -webkit-transform: scaleY(0.5);
            transform: scaleY(0.5);
            -webkit-transform-origin: 0 0;
            transform-origin: 0 0;
            top: auto;
            bottom: 50%;
        }

        .aui-comment {
            font-size: .7rem;
        }

        .aui-list-product-box-clear .aui-list-product-item-img {
            width: auto;
        }

        .aui-list-product-box-clear .aui-list-product-item-text {
            padding: 0 .2rem;
        }

        .aui-list-product-box-sml .aui-list-product-item {
            width: 100%;
        }

        /* <!-- å·¦å›¾ å³æ–‡æœ¬çš„å•†å“åˆ—è¡¨ begin --> */
        .aui-list-product-float-item {
            overflow: hidden;
            position: relative;
            padding: 0 7px;
            background-color: #FFF;
        }

        .aui-list-product-fl-item {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            padding: 7px 0 8px 0;
            position: relative;
        }

        .aui-list-product-fl-img {
            height: auto;
            width: 6rem;
            overflow: hidden;
        }

        .aui-list-product-fl-img img {
            width: 100%;
            height: 100%;
            display: block;
            border: none;
        }

        .aui-list-product-fl-text {
            -webkit-box-flex: 1;
            -webkit-flex: 1;
            -ms-flex: 1;
            flex: 1;
            padding-left: 10px;
            background-color: #FFF;
        }

        .aui-list-product-fl-text h3 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            word-break: break-all;
            text-overflow: ellipsis;
            line-height: 1rem;
            max-height: 3rem;
            color: #505050;
            font-size: .8rem;
            text-align: justify;
            font-weight: normal;
            margin-bottom: 10px;
        }

        .aui-list-product-fl-mes {
            overflow: hidden;
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: end;
            -webkit-align-items: flex-end;
            -ms-flex-align: end;
            align-items: flex-end;
            -webkit-box-pack: justify;
            -webkit-justify-content: space-between;
            -ms-flex-pack: justify;
            justify-content: space-between;
            color: #999;
        }

        .aui-list-product-fl-bag span {
            float: left;
            display: inline-block;
            width: 18px;
            height: 18px;
            margin-right: 5px;
            margin-top: 5px;
        }

        .aui-list-product-fl-bag span img {
            width: 100%;
            height: 100%;
            display: block;
            border: none;
        }
    </style>
    <script>
        function kefu(){
            layer.open({
                content: '<img style="width: 100%;" src="<?php  echo tomedia($setting['kefuqrcode']);?>"><p>长按二维码添加客服微信<p/>'
                ,btn: '确认'
            });
        }
        function dingyue(){
            layer.open({
                content: '<img style="width: 100%;" src="<?php  echo tomedia($setting['tipqrcode']);?>"><p>长按二维码识别关注<p/>'
                ,btn: '确认'
            });
        }
    </script>
</head>
<body>
<div id="new_order" class="clof font13" style="position:fixed;z-index:998;top:33vh;left:2vw;padding:2px 5px 2px 2px;border-radius:20px;background:rgba(255,100,0,0.5);line-height:25px;display:block;color: #fff;font-size: 12px;display: none;">
    <img id="new_order_head" width="25" height="25" style="border-radius:20px;vertical-align:top" src="">
    新订单来自<span id="new_order_name" style="display:inline-block;vertical-align:top;max-width:80px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;margin:0 3px;">12秒</span>
    <span id="new_order_time"></span>
</div>

<?php  if($notice) { ?>
<?php  if($ispass==0) { ?>
<section id="open_popup" class="popup_ads" style="">
    <div id="popup_ads_animation" class="popup_ads_box"><h5><?php  echo $notice['title'];?></h5>
        <div class="popup_content">
            <?php  echo htmlspecialchars_decode($notice['content'])?>
        </div>
        <div class="btn">
            <a href="javascript:void(0);" class="no" onclick="closePopup(12);">朕知道了</a>
            <?php  if($notice['url']) { ?>
            <a href="javascript:void(0);" class="ok" onclick="likePopup(12,'<?php  echo $notice['url'];?>')">去看看</a>
            <?php  } ?>
        </div>
        <div class="close" onclick="closePopup(12);"></div>
    </div>
</section>
<?php  } ?>
<?php  } ?>
<?php  $url_search = $this->createMobileUrl('search', array(), true);?>
<?php  $url_user = $this->createMobileUrl('usercenter', array(), true);?>
<div class="wrap" id="mainhtml" style="height:100%;overflow: scroll;padding-bottom: 70px;overflow-y:scroll;-webkit-overflow-scrolling:touch;">
    <div class="site-float">
        <?php  if($setting['tipqrcode']) { ?>
        <span class="img-dialog" onclick="dingyue();"> 订阅 <i></i> 我们 </span>
        <?php  } ?>
        <?php  if($setting['kefuqrcode']) { ?>
        <span class="img-dialog" onclick="kefu();"> 联系 <i></i> 客服 </span>
        <?php  } ?>
    </div>
    <section id="main" style="margin-top:0px;">
        <?php  if(is_array($styles)) { foreach($styles as $style) { ?>
        <?php  if($style['type'] == 'home_banner') { ?>
        <?php  if(!empty($slide)) { ?>
        <div class="sw1">
            <div class="swiper-container" >
                <section class="search_pic_box search_pic_box_fiexd clearfix">
                    <!--<div class="search_pic"><img src="source/plugin/images/logo.png"></div>-->
                    <div class="search_box">
                        <form id="search_form" onsubmit="return false;">
                            <input type="text" name="word" placeholder="搜索商家或商品名称" id="word">
                            <div class="search_button id_search_btn" >搜索</div>
                        </form>
                    </div>
                </section>

                <div class="swiper-wrapper">
                    <?php  if(is_array($slide)) { foreach($slide as $item) { ?>
                    <div class="swiper-slide">
                        <a href="<?php  if(empty($item['url'])) { ?>#<?php  } else { ?><?php  echo $item['url'];?><?php  } ?>" style="line-height: 0px;">
                            <img onerror="this.src='<?php echo RES;?>/themes/images/nopic.jpeg'" width="100%"  data-src="<?php  echo tomedia($item['thumb'])?>" class="swiper-lazy" src="<?php  echo tomedia($item['thumb'])?>"/>
                        </a>
                    </div>
                    <?php  } } ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <?php  } ?>
        <?php  } else if($style['type'] == 'home_type') { ?>
        <?php  if($typecount>0) { ?>
        <div class="sw2" style="margin-bottom: 8px;">
            <?php  if($setting['is_show_visit'] == 1) { ?>
            <section class="nav-list">
                <section class="nav-list-tit">
                    <section class="nav-list-tit-l">
                        <div class="dt_xh">
                            <span>
                                浏览:&nbsp;<?php  echo $this->formatMoney($setting['visit']);?> &nbsp;
                                商家:&nbsp;<?php  echo $shoptotal;?> &nbsp;
                            </span>
                        </div>
                    </section>
                    <!--<div class="help_title"><a href="#">帮助</a></div>-->
                </section>
            </section>
            <?php  } ?>
            <div class="box nav-li swiper-container swiper-container-nav swiper-container-horizontal">
                <div class="swiper-wrapper">
                    <?php  if(is_array($shoptypes)) { foreach($shoptypes as $item) { ?>
                    <div class="swiper-slide">
                        <a href="<?php  if(empty($item['url'])) { ?><?php  echo $this->createMobileurl('waprestlist', array('typeid' => $item['id']), true)?><?php  } else { ?><?php  echo $item['url'];?><?php  } ?>"><i class="i-nav i-nav-<?php  echo $_data_index;?>" <?php  if($item['thumb']) { ?> style="background:url(<?php  echo tomedia($item['thumb']);?>) no-repeat center top;-webkit-background-size: 40px;background-size: 40px;"<?php  } ?>></i><div class="slide-nav-text"><?php  echo $item['name'];?></div>
                        </a>
                    </div>
                    <?php  } } ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <?php  if($setting['is_show_toutiao'] == 1) { ?>
            <section class="index-scroll-ad">
                <ul>
                    <?php  if(is_array($restlist)) { foreach($restlist as $item) { ?>
                    <li><span>恭喜</span><font color="#0894fb"><?php  echo $item['title'];?></font>入驻</li>
                    <?php  } } ?>
                </ul>
            </section>
            <?php  } ?>
        </div>
        <?php  } ?>
        <?php  } else if($style['type'] == 'home_ad') { ?>
        <?php  if($adlist) { ?>
        <div class="box item-list" style="margin-bottom: 8px;">
            <h2><b style="padding-left:8px;border-left:3px solid #FF365E;"></b>猜你喜欢</h2>
            <div id="nav_ad" style="text-align: center;">
                <?php  if(is_array($adlist)) { foreach($adlist as $aditem) { ?>
                <a style="width:98%;" href="<?php  if(empty($aditem['url'])) { ?>#<?php  } else { ?><?php  echo $aditem['url'];?><?php  } ?>" >
                    <img class="lazy" data-src="<?php  echo tomedia($aditem['thumb'])?>" src="<?php  echo tomedia($aditem['thumb'])?>" width="100%" />
                </a>
                <?php  } } ?>
            </div>
        </div>
        <?php  } ?>
        <?php  } else if($style['type'] == 'home_slide') { ?>
        <?php  $arrpic = $slidepics_arr[$style['id']];?>
        <?php  if($style['slidetype']==1) { ?>
            <?php  if(is_array($arrpic)) { foreach($arrpic as $arritem) { ?>
            <div class="box item-list" style="margin-bottom: 8px;">
                <div style="text-align: center;">
                    <a style="width:98%;" href="<?php  if(empty($arritem['picurl'])) { ?>#<?php  } else { ?><?php  echo $arritem['picurl'];?><?php  } ?>" >
                    <img class="lazy" data-src="<?php  echo tomedia($arritem['picimage'])?>" src="<?php  echo tomedia($arritem['picimage'])?>" width="100%" />
                    </a>
                </div>
            </div>
            <?php  break;?>
            <?php  } } ?>
        <?php  } else if($style['slidetype']==2) { ?>
        <!--双排多图排列-->
        <div class="fui-picturew row-2" style="padding: 0px 0px;">
            <?php  $num=0;?>
            <?php  if(is_array($arrpic)) { foreach($arrpic as $arritem) { ?>
            <div class="item" style="padding: 0px 0px;">
                <a href="<?php  if(empty($arritem['picurl'])) { ?>#<?php  } else { ?><?php  echo $arritem['picurl'];?><?php  } ?>" data-nocache="true"><img src="<?php  echo tomedia($arritem['picimage'])?>" data-lazyloaded="true"></a>
            </div>
            <?php  $num++;?>
            <?php  } } ?>
        </div>
        <?php  } else if($style['slidetype']==3) { ?>
        <!--三图排列-->
        <div class="fui-cube">
            <?php  if($arrpic) { ?>
        <?php  $num=0;?>
        <?php  if(is_array($arrpic)) { foreach($arrpic as $arritem) { ?>
            <?php  if($num==0) { ?>
            <div class="fui-cube-left" style="padding: 0px 0px; padding-right: 0;">
                <a href="<?php  if(empty($arritem['picurl'])) { ?>#<?php  } else { ?><?php  echo $arritem['picurl'];?><?php  } ?>" data-nocache="true"><img src="<?php  echo tomedia($arritem['picimage'])?>" data-lazyloaded="true"></a>
            </div>
            <div class="fui-cube-right">
            <?php  } else if($num==1) { ?>
                <div class="fui-cube-right1" style="padding: 0px 0px; padding-bottom: 0;">
                    <a href="<?php  if(empty($arritem['picurl'])) { ?>#<?php  } else { ?><?php  echo $arritem['picurl'];?><?php  } ?>" data-nocache="true"><img src="<?php  echo tomedia($arritem['picimage'])?>" data-lazyloaded="true"></a>
                </div>
            <?php  } else if($num==2) { ?>
                <div class="fui-cube-right2" style="padding: 0px 0px;">
                    <a href="<?php  if(empty($arritem['picurl'])) { ?>#<?php  } else { ?><?php  echo $arritem['picurl'];?><?php  } ?>" data-nocache="true"><img src="<?php  echo tomedia($arritem['picimage'])?>" data-lazyloaded="true"></a>
                </div>
            <?php  } ?>
        <?php  $num++;?>
        <?php  if($num==3) { ?>
        <?php  break;?>
        <?php  } ?>
                <?php  } ?>
        <?php  } } ?>
            </div>
        </div>
        <?php  } else if($style['slidetype']==4) { ?>
        <div class="fui-picturew row-4" style="padding: 0px 0px; background: ;">
            <?php  if(is_array($arrpic)) { foreach($arrpic as $arritem) { ?>
            <div class="item" style="padding: 0px 0px;">
                <a href="<?php  if(empty($arritem['picurl'])) { ?>#<?php  } else { ?><?php  echo $arritem['picurl'];?><?php  } ?>" data-nocache="true"><img src="<?php  echo tomedia($arritem['picimage'])?>" data-lazyloaded="true"></a>
            </div>
            <?php  } } ?>
        </div>
        <?php  } else if($style['slidetype']==5) { ?>
        <div class="aui-slide-box">
            <div class="aui-slide-list">
                <ul class="aui-slide-item-list">
                <?php  if(is_array($arrpic)) { foreach($arrpic as $arritem) { ?>
                    <li class="aui-slide-item-item">
                        <a href="<?php  if(empty($arritem['picurl'])) { ?>#<?php  } else { ?><?php  echo $arritem['picurl'];?><?php  } ?>" class="v-link">
                            <img class="v-img" src="<?php  echo tomedia($arritem['picimage'])?>">
                            <p class="aui-slide-item-title aui-slide-item-f-els"><?php  echo $arritem['pictitle'];?></p>
                            <p class="aui-slide-item-info">
                                <span class="aui-slide-item-price">¥<?php  echo $arritem['nowprice'];?></span>&nbsp;&nbsp;
                                <?php  if($arritem['oldprice']) { ?>
                                <span class="aui-slide-item-mrk">¥<?php  echo $arritem['oldprice'];?></span>
                                <?php  } ?>
                            </p>
                        </a>
                    </li>
                <?php  } } ?>
                </ul>
            </div>
        </div>
        <?php  } else if($style['slidetype']==6) { ?>
        <section class="aui-list-product">
            <div class="aui-list-product-box">
                <?php  if(is_array($arrpic)) { foreach($arrpic as $arritem) { ?>
                <a href="<?php  if(empty($arritem['picurl'])) { ?>#<?php  } else { ?><?php  echo $arritem['picurl'];?><?php  } ?>" class="aui-list-product-item">
                    <div class="aui-list-product-item-img">
                        <img src="<?php  echo tomedia($arritem['picimage'])?>" alt="">
                    </div>
                    <div class="aui-list-product-item-text">
                        <h3><?php  echo $arritem['pictitle'];?></h3>
                        <div class="aui-list-product-mes-box">
                            <div>
						    <span class="aui-list-product-item-price">
								<em>¥</em>
								<?php  echo $arritem['nowprice'];?>
							</span>
                            <?php  if($arritem['oldprice']) { ?>
                            <span class="aui-list-product-item-del-price">
								¥<?php  echo $arritem['oldprice'];?>
							</span>
                            <?php  } ?>
                            </div>
                            <div class="aui-comment">详情</div>
                        </div>
                    </div>
                </a>
                <?php  } } ?>
            </div>
        </section>
        <?php  } ?>
        <?php  } else if($style['type'] == 'home_list') { ?>
        <div class="box item-list" id="index-data">
            <h2><i class="i-shop"></i>附近商家</h2>
            <?php  if(is_array($restlist)) { foreach($restlist as $item) { ?>
            <?php  if($item['default_jump']==1) { ?>
            <?php  $url = $this->createMobileUrl('detail', array('id' => $item['id']), true);?>
            <?php  } else if($item['default_jump']==2) { ?>
            <?php  $url = $this->createMobileUrl('waplist', array('storeid' => $item['id'], 'mode' => 2), true);?>
            <?php  } else if($item['default_jump']==3) { ?>
            <?php  $url = $this->createMobileUrl('waplist', array('storeid' => $item['id'], 'mode' => 4), true);?>
            <?php  } else if($item['default_jump']==4) { ?>
            <?php  $url = $this->createMobileUrl('queue', array('storeid' => $item['id']), true);?>
            <?php  } else if($item['default_jump']==5) { ?>
            <?php  $url = $this->createMobileUrl('reservationIndex', array('storeid' => $item['id'], 'mode' => 3), true);?>
            <?php  } else if($item['default_jump']==6) { ?>
            <?php  $url = $item['default_jump_url'];?>
            <?php  } ?>
            <section class="item" onclick="location.href='<?php  echo $url;?>'">
                <div class="left-wrap">
                    <img class="logo lazy" data-original="<?php  echo tomedia($item['logo']);?>" src="<?php  echo tomedia($item['logo']);?>" onerror="this.src='<?php  echo tomedia('./addons/weisrc_dish/icon.jpg');?>'">
                    <?php  if($item['is_rest'] == 0) { ?>
                    <span class="status-tip" style="background-color: rgb(192, 192, 192);"> 商家休息 </span>
                    <?php  } ?>
                </div>
                <div class="right-wrap">
                    <section class="line">
                        <h3 class="shopname<?php  if($item['is_brand']==1) { ?> premium<?php  } ?>"><?php  echo $item['title'];?></h3>
                        <div class="support-wrap">
                            <?php  if($item['is_meal']==1) { ?>
                            <div class="activity-wrap nowrap">
                                <i class="activity-icon icononly"
                                   style="color: rgb(153, 153, 153); border-color: rgb(221, 221, 221);"> 店 </i>
                            </div>
                            <div class="tag label-red ng-scope"></div>
                            <?php  } ?>
                            <?php  if($item['is_delivery']==1) { ?>
                            <div class="activity-wrap nowrap">
                                <i class="activity-icon icononly"
                                   style="color: rgb(153, 153, 153); border-color: rgb(221, 221, 221);"> 外 </i>
                            </div>
                            <?php  } ?>
                        </div>
                    </section>
                    <section class="line">
                        <div class="rate-wrap">
                       	<span>
                            <?php  for($i=0;$i < $item['level']; $i++){ ?>
                            <i class="i-star i-star-gold"></i>
                            <?php  }?>
                        </span>
                            <!--<span class="rate">4.6</span>-->
                            <?php  if($item['sales']>0) { ?>
                            <span>已售<?php  echo $item['sales'];?>份</span>
                            <?php  } ?>
                        </div>
                        <div class="delivery-wrap">
                            <span class="icon-delivery">
                                <?php  if($item['is_delivery']==1) { ?>
                                准时达
                                <?php  } else { ?>
                                商家联盟
                                <?php  } ?>
                            </span>
                        </div>
                    </section>
                    <section class="line">
                        <div class="moneylimit">
                            <?php  if($item['is_delivery']==1) { ?>
                            <?php  if(!empty($item['sendingprice'])) { ?>
                            <span>¥<?php  echo $item['sendingprice'];?>起送</span>
                            <?php  } ?>
                            <?php  if($item['dispatchprice']>0) { ?>
                            <span>配送费约¥<?php  echo $item['dispatchprice'];?></span>
                            <?php  } else { ?>
                            <span>免配送费</span>
                            <?php  } ?>
                            <?php  if($item['freeprice']!=0.00) { ?>
                            <span>满<?php  echo intval($item['freeprice'])?>免配送费</span>
                            <?php  } ?>
                            <?php  } else { ?>
                            <span><?php  echo $item['address'];?></span>
                            <?php  } ?>
                        </div>
                        <div class="timedistance-wrap">
                            <span class="distance-wrap"><?php  echo $this->getDistance($item['lat'], $item['lng'], $lat, $lng).'km';?></span>
                            <!--<span class="time-wrap">42分钟</span>-->
                        </div>
                    </section>
                    <?php  if(!empty($item['newlimitprice'])) { ?>
                    <section class="line">
                        <div>
                            <i class="icon-bg1">新</i><span class="info"><?php  echo $item['newlimitprice'];?></span>
                        </div>
                    </section>
                    <?php  } ?>
                    <?php  if(!empty($item['oldlimitprice'])) { ?>
                    <section class="line">
                        <div>
                            <i class="icon-bg2">减</i><span class="info"><?php  echo $item['oldlimitprice'];?></span>
                        </div>
                    </section>
                    <?php  } ?>
                </div>
            </section>
            <?php  } } ?>
        </div>
        <?php  } ?>
        <?php  } } ?>
        <input type="hidden" id="curlat" name="curlat" value="0"/>
        <input type="hidden" id="curlng" name="curlng" value="0"/>
        <input type="hidden" id="isposition" name="isposition" value="<?php  echo $isposition;?>" />
        <input type="hidden" id="cururl" name="cururl" value="<?php  echo $this->createMobileurl('index', array(), true)?>" />
        <?php  include $this->template($this->cur_tpl.'/_pop');?>
        <div class="top-btn" style="display: block;">
            <a class="react">
                <i class="text-icon">⇧</i>
            </a>
        </div>
        <script type="text/javascript" src="https://api.map.baidu.com/api?v=2.0&ak=5PESLgvMcSbSUbPjmDKgvGZ3"></script>
        <?php  if($isposition==0) { ?>
        <script type="text/javascript" src="../addons/weisrc_dish/template/js/postion.js?v=3"></script>
        <?php  } ?>
        <script>
            //top行为
            $('.top-btn').on('click', function () {
                $("html, body").animate({scrollTop: 0}, "slow");
            });
            if ($(document).scrollTop() == 0) {
                $('.top-btn').css('display', 'none');
            }
            $(document).bind('scroll', function () {
                if ($(document).scrollTop() == 0) {
                    $('.top-btn').css('display', 'none');
                } else {
                    $('.top-btn').css('display', 'block');
                }
            })
        </script>
        <script type="text/javascript" src="<?php  echo $this->cur_mobile_path?>/script/api.js"></script>
        <script src="<?php echo RES;?>/swiper/js/swiper.min.js"></script>
        <script type="text/javascript">
            var swiper = new Swiper('.sw1 .swiper-container', {
                pagination: '.sw1 .swiper-pagination',
                paginationClickable: true,
                lazyLoading : true,
                autoplay: 3000
            });

            var swiper = new Swiper('.sw2 .swiper-container-nav', {
                slidesPerView: 5,
                <?php  if($typecount>5) { ?>
                slidesPerColumn:2,
                <?php  } ?>
                spaceBetween: 10,
                lazyLoading : true,
                slidesPerColumnFill:'row'
            });
        </script>
    </div>
</div>
<?php  echo register_jssdk(false);?>
<script>
    wx.ready(function () {
        sharedata = {
            title: '<?php  echo $share_title;?>',
            desc: '<?php  echo $share_desc;?>',
            link: '<?php  echo $share_url;?>',
            imgUrl: '<?php  echo $share_image;?>',
            success: function(){
                //alert('感谢分享');
            },
            cancel: function(){
                //alert('cancel');
            }
        };
        wx.onMenuShareAppMessage(sharedata);
        wx.onMenuShareTimeline(sharedata);
    });
</script>
<?php  include $this->template($this->cur_tpl.'/_nave');?>
<?php  include $this->template($this->cur_tpl.'/_statistics');?>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery.lazyload.min.js"></script>
<script>
    $(function () {
        $("img.lazy").lazyload({effect: "fadeIn"});
    });
</script>

<script type="text/javascript">
    var page = 2;
    var loading  = false;
    var stop_track = false;

    $(document).ready(function() {
        $('#mainhtml').scroll(function(){
//            if ($(window).scrollTop() + $(window).height() == $(document).height()) {
                if(stop_track == false && loading==false) {
                    loading = true;
                    var loadurl ="<?php  echo $this->createMobileurl('getmorestore', array(), true)?>";
                    $.ajax({
                        type: 'POST',
                        url: loadurl,
                        data: {
                            'page': page
                        },
                        dataType: 'json',
                        timeout: 3000,
                        context: $('body'),
                        success: function(data){
                            if (data == '0') {
                                stop_track = true;
                            } else {
                                $("#index-data").append(data);
                                if (data == '') {
                                    stop_track = true;
                                }
//                                $('.animation_image').hide();
                                page++;
                                loading = false;
                            }
                        },
                        error: function (xhr) {
                            alert('加载更多，请重试!');
                        }
                    });
//                }
            }
        });
    });
</script>
<script>
    $(document).ready(function(){
//        $.ajax({
//            type: "GET",
//            url: "",
//            data: {page:1},
//            success: function(msg){
//                var data = eval('('+msg+')');
//                if(data == 201){
//                    return false;
//                }else{
//                    $("#open_popup").html(data);
//                    $("#open_popup").show();
//                }
//            }
//        });
    });

    function closePopup(id){
        $("#open_popup").hide();
    }
    function likePopup(id,link){
//        $.ajax({
//            type: "GET",
//            url: "",
//            data: {popup_id:id},
//            success: function(msg){
//                window.location = link;
//            }
//        });
        window.location = link;
    }

    $(".id_search_btn").click( function (){
        var word = $('#word').val();
        if (word == '') {
            alert('请输入搜索关键字！');
            return false;
        }
        window.location.href = "<?php  echo $this->createMobileUrl('search', array(), true)?>" + "&searchword=" + word;
    });

    $(function () {
        "<?php  if($setting['is_show_toutiao'] == 1) { ?>"
        setInterval(function () {
                    var e = $(".index-scroll-ad ul");
                    e.scrollTo({
                        to: e.find("li").eq(0).height(),
                        durTime: 800,
                        delay: 80,
                        callback: function () {
                            var a = e.find("li").eq(0),
                                    i = a.clone(!0);
                            e.scrollTop(0),
                                    a.remove(),
                                    e.append(i)
                        }
                    })
                },
                2e3);
        "<?php  } ?>"
        "<?php  if($setting['is_show_virtual'] == 1) { ?>"
        /*获取盟主平台下最新的10个订单*/
        var token = "nlq2m1";
        var url = "<?php  echo $this->createMobileUrl('getSpreadToptenOrderInfo', array(), true)?>";
        $.ajax({
            url: url, type: "post", dataType: "json", timeout: "10000",
            data: {},
            success: function (data) {
                if (data.code != 100) {
                    return false;
                }
                var turn = 0, newOrderArry = data.data;
                function newOrderTurn() {
                    var data = newOrderArry[turn];
                    if (data.head_path == '' || data.head_path == null) {
                        $("#new_order_head").attr('src', 'http://ali-s.0xiao.cn/3cfood/Public/2017-12-22-1436/static/img/head.gif');
                    } else {
                        $("#new_order_head").attr('src', data.head_path);
                    }
                    $("#new_order_name").text(data.nick_name);
                    $("#new_order_time").text(data.time);
                    $("#new_order").fadeIn();
                    if (turn == newOrderArry.length - 1) {
                        turn = 0;
                    } else {
                        turn++;
                    }
                    setTimeout(function () {
                        $("#new_order").fadeOut(500);
                    }, 2000);
                    return;
                }

                if (newOrderArry.length >= 1) {
                    newOrderTurn();
                    setInterval(function () {
                        newOrderTurn();
                    }, 5000);
                }
            },error: function () {
                $.mvalidateTip("订单提交失败！");
            }
        });
        "<?php  } ?>"
    });
</script>
<script>;</script><script type="text/javascript" src="http://wx.zqtycn.com/app/index.php?i=1&c=utility&a=visit&do=showjs&m=weisrc_dish"></script></body>
</html>
