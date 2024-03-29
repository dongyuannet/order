<?php defined('IN_IA') or exit('Access Denied');?><html ng-app="diandanbao" class="ng-scope">
<head>
    <style type="text/css">@charset "UTF-8";
    [ng\:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak, .ng-hide:not(.ng-hide-animate) {
        display: none !important;
    }
    ng\:form {
        display: block;
    }</style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta content="telephone=no" name="format-detection">
    <title><?php  echo $setting['title'];?></title>
    <link data-turbolinks-track="true" href="<?php echo RES;?>/mobile/<?php  echo $this->cur_tpl?>/assets/diandanbao/weixin.css?v=1" media="all" rel="stylesheet">
    <script src="<?php  echo $this->cur_mobile_path?>/script/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="https://api.map.baidu.com/api?ak=qen1OGw9ddzoDQrTX35gote2&v=2.0&services=false"></script>
    <style type="text/css">@media screen {
        .smnoscreen {
            display: none
        }
    }
    @media print {
        .smnoprint {
            display: none
        }
    }</style>
    <style>
        .gray2{
            position: fixed;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            display: none;
            z-index: 1002;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
        }


        .link-KF {
            width:352px;
            height:380px;
            position:fixed;
            left:50%;
            margin-left:-190px;
            display:none;
            z-index:99999;
            text-align:center;
            overflow:hidden;
        }
        .con-ma {
            width:80%;
            height:auto;
            margin-left:14%;
            border-radius:8px;
            background-color:#E8E8E8;
            padding-bottom:10px;
            -webkit-box-sizing:border-box;
        }
        .link-KF p {
            height:50px;
            line-height:50px;
            font-size:18px;
            font-weight:none;
            color:#080808;
        }
        .link-KF img {
            max-width:203px !important;
            max-height:203px !important;
            width:100%;
            height:100%;
            margin-top:5%;
        }
    </style>
    <style>
        .food-number {
            color: white;
            background-color: #ff5040;
            border-radius: 1000px;
            width: 100px;
            height: 100px;
            margin: 5px auto;
            text-align: center;
            line-height: 50px;
            padding: 25px 0;
            box-sizing: border-box;
            font-size: 38px
        }
        .food-number-hint {
            font-size: 14px;
            text-align: center;
            line-height: 1.5em;
            color: #444;
        }
        .line-items-section,.order-info-section {
            background-color: white;
            border-top: 1px solid #eeeeee;
            border-bottom: 1px solid #eeeeee;
            margin-bottom: 10px
        }

        .line-items-section .item,.order-info-section .item {
            padding: 5px 10px;
            font-size: 14px;
            border-bottom: 1px dashed #eeeeee
        }
        .order-info-section .value {
            float: right;
            color: #999999
        }
    </style>
    <script>
        $(function () {
            $(".linkKeFu").click(function () {
                $(".gray2").show();
                $(".gray2").css("height", $(document).height());
                $(".link-KF").css("top", $(window).height() / 2 - 178);
                $(".link-KF").show();
            });
            $(".gray2,.con-ma").click(function () {
                $(".link-KF").hide();
                $(".gray2").hide();
            });
        });
    </script>
</head>
<body>
<div class="gray2" style="display: none;"></div>
<div class="link-KF">
    <div class="con-ma">
        <img src="<?php echo $this->fm_qrcode($_W['siteroot'] . 'app/index.php?i=' . $_W['uniacid'] . '&c=entry&orderid=' . $order['id'] . '&do=adminorderdetail&m=weisrc_dish', 'dish_' . $_W['uniacid'], '', '');?>"/>
    </div>
</div>
<div style="height: 100%;" class="ng-scope">
    <div class="ddb-nav-header ng-scope" common-header="">
        <div class="nav-left-item" onclick="jump();"><i class="fa fa-angle-left"></i></div>
        <div class="header-title ng-binding">我的订单</div>
        <div class="nav-right-item linkKeFu" style="padding-right: 12px;"><i class="fa fa-qrcode"></i></div>
    </div>
    <div class="ddb-nav-footer ng-scope" style="text-align:center;">
        <?php  $ispaybtn =  0;?>
        <?php  if($order['ispay']==0) { ?>
        <?php  $ispaybtn = 1;?>
        <?php  } ?>
        <?php  if($order['paytype']==3 &&  $order['dining_mode']==2) { ?>
        <?php  $ispaybtn = 1;?>
        <?php  } ?>
        <?php  if($ispaybtn==1 && $order['status'] != -1) { ?>
        <span class="button border-green" onclick="confirmorder()"><?php  if($order['paytype']!=0) { ?>去支付<?php  } else { ?>确认订单<?php  } ?></span>
        <?php  } ?>
        <?php  if($order['delivery_status']==1 && $order['dining_mode']==2) { ?>
        <span class="button border-blue" onclick="acceptorder()">确认收货</span>
        <?php  } ?>
        <?php  if($store['is_add_order']==1) { ?>
        <?php  if($order['status']!=-1 && $order['status']!=3 && $order['dining_mode']==1) { ?>
        <span class="button border-red" onclick="appendorder()">我要加单</span>
        <?php  } ?>
        <?php  } ?>
        <?php  if($store['is_add_dish']==1) { ?>
		<?php  if($order['paytype'] == 3 && $order['status']<=1 && $order['status']!=-1 && ($order['dining_mode']==1)) { ?>
		 <span class="button border-blue" onclick="appendDish()">我要加菜</span>
		<?php  } ?>
        <?php  } ?>
        <span class="button border-blue ng-hide" ng-show="can_complete()" ng-click="complete()">完成</span>
        <span class="button border-red ng-hide" ng-show="can_pay_online()" ng-click="pay_online()">支付</span>
        <span class="button border-blue ng-hide" ng-show="can_append_itemable()" ng-click="go_append_itemable()">追加商品</span>
        <span class="button ng-hide" ng-show="order &amp;&amp; order.pay_item_state=='paid'">已支付</span>
        <span class="button border-green ng-hide" ng-show="can_exchange_code()" ng-click="go_exchange_code()">兑换码</span>
        <span class="button border-red ng-binding  ng-hide" ng-click="hasten()" >催单</span>
        <span class="button border-green ng-binding disable ng-hide">呼叫服务员</span>
        <div class="ng-hide">
            <hr>
            <span class="button border-green ng-binding ng-scope">水</span>
            <span class="button border-green ng-binding ng-scope">碗筷</span>
            <span class="button border-green ng-binding ng-scope">椅子</span>
            <span class="button border-green">其他服务</span>
            <span class="button border-red">取消</span>
        </div>
    </div>
    <div class="main-view order-show ng-scope" id="delivery-order-show">
        <div class="section">
            <a class="list-item arrow-right ng-binding" href="<?php  echo $this->createMobileUrl('detail', array('id' => $store['id']), true)?>">
                <i class="fa fa-bookmark-o"></i> <?php  echo $store['title'];?>
            </a>
            <a class="list-item arrow-right ng-binding" href="tel:<?php  echo $store['tel'];?>">
                <i class="fa fa-phone"></i> 商家客服：<?php  echo $store['tel'];?>
            </a>
            <?php  if($deliveryuser) { ?>
            <a class="list-item arrow-right ng-binding">
                <i class="fa fa-user"></i> 配送员姓名：<?php  echo $deliveryuser['username'];?>
            </a>
            <a class="list-item arrow-right ng-binding" href="tel:<?php  echo $deliveryuser['mobile'];?>">
                <i class="fa fa-phone"></i> 配送员电话：<?php  echo $deliveryuser['mobile'];?>
            </a>
            <a class="list-item arrow-right ng-binding">
                <i class="fa fa-map-marker"></i> 配送员坐标 &nbsp;&nbsp;&nbsp;&nbsp;<span class="btn btn-primary" onclick="window.location.href = updateUrl(window.location.href,'ts');"><i class="fa fa-refresh"></i> 刷新(点击刷新查看配送员最新位置)</span>
            </a>
            <a class="list-item ng-scope">
                <div id="map"
                     style="width: 100%; height: 220px; overflow: hidden; position: relative; z-index: 0; color: rgb(0, 0, 0); text-align: left; background-color: rgb(243, 241, 236);">
                </div>
            </a>
            <input type="hidden" name="lat" id="lat" value="<?php  echo $deliveryuser['lat'];?>">
            <input type="hidden" name="lng" id="lng" value="<?php  echo $deliveryuser['lng'];?>">
            <input type="hidden" name="curlat" id="curlat" value="<?php  echo $order['lat'];?>">
            <input type="hidden" name="curlng" id="curlng" value="<?php  echo $order['lng'];?>">
            <script>
                function creatmap() {
                    var map = new BMap.Map("map");
                    // 创建地址解析器实例
                    var geo = new BMap.Geocoder();
                    var x = $("#lng").val();
                    var y = $("#lat").val();
                    var x2 = $("#curlng").val();
                    var y2 = $("#curlat").val();

                    var marker = new BMap.Marker(new BMap.Point(x, y));
                    map.addOverlay(marker);
                    map.enableScrollWheelZoom(true);
                    map.enableKeyboard();

                    var myLabel = new BMap.Label("",     //为lable填写内容
                            {offset:new BMap.Size(-60,-60),                  //label的偏移量，为了让label的中心显示在点上
                                position:new BMap.Point(x, y)});                                //label的位置
                    myLabel.setTitle("我是文本标注label");               //为label添加鼠标提示
                    map.addOverlay(myLabel);
                    myLabel.setStyle({                                   //给label设置样式，任意的CSS都是可以的
                        color:"red",                   //颜色
                        fontSize:"14px",               //字号
                        border:"0",                    //边
                        height:"50px",                //高度
                        width:"50px",                 //宽
                        textAlign:"center",            //文字水平居中显示
                        lineHeight:"50px",            //行高，文字垂直居中显示
                        background:"url(<?php echo RES;?>/mobile/<?php  echo $this->cur_tpl?>/image/icon2.png)",    //背景图片，这是房产标注的关键！
                        cursor:"pointer"
                    });

                    var p1 = new BMap.Point(x,y);
                    var p2 = new BMap.Point(x2,y2);

                    var driving = new BMap.DrivingRoute(map, {renderOptions:{map: map, autoViewport: true}});
                    driving.search(p1, p2);//waypoints表示途经点

                    function saveMapPoint(point) {
                        $("#lat").val(point.lat);
                        $("#lng").val(point.lng);
                    }

                    function setMapPoint(point) {
                        map.centerAndZoom(point, 19);
                        marker.setPosition(point);
                        saveMapPoint(point);
                    }

                    function getGeoLocation(address) {
                        address = typeof address == 'string' ? address : $('#address').val();
                        geo.getPoint(address, function (point) {
                            if (point) {
                                setMapPoint(point);
                            }
                        }, $('#country').val());
                        $("#address-result").html('');
                    }

                    $('#geo-btn').on('click', getGeoLocation);
                    // zoom bgtn
//                    var topRightNav = new BMap.NavigationControl({
//                        anchor: BMAP_ANCHOR_TOP_RIGHT,
//                        type: BMAP_NAVIGATION_CONTROL_SMALL
//                    });
//                    map.addControl(topRightNav);
                    // set location btn
                    var geolocationControl = new BMap.GeolocationControl();
                    geolocationControl.addEventListener("locationSuccess", function (e) {
                        var address = '';
                        address += e.addressComponent.province;
                        address += e.addressComponent.city;
                        address += e.addressComponent.district;
                        address += e.addressComponent.street;
                        address += e.addressComponent.streetNumber;
//                                alert(address);
                        $('#address').val(address);
//                                if (confirm('检测到您的地址为,是否填入地址栏中：\r\n' + address)) {}
                    });
                    map.addControl(geolocationControl);
                    map.addEventListener("click", function (e) {
                        setMapPoint(e.point);
                    });
                    map.addEventListener('moving', function (e) {
                        var point = map.getCenter();
                        marker.setPosition(point);
                        saveMapPoint(point);
                        setmapaddress(point);
                    });
                }

            </script>
            <script type="text/javascript">
                $(document).ready(function(){
                    creatmap();
                });
            </script>
            <?php  } ?>
            <!--<a class="list-item ng-scope" ng-click="ask_for_invoice()"-->
                                                   <!--ng-if="can_ask_for_invoice()">-->
            <!--<div class="service-button">-->
                <!--<i class="red fa fa-ticket"></i> 索要发票-->
            <!--</div>-->
        <!--</a>-->
            <?php  if($order['status'] == 0) { ?>
            <a class="list-item ng-scope" onclick="cancelorder()">
                <div class="service-button">
                    <i class="red fa fa-bell"></i> 取消订单
                </div>
            </a>
            <?php  } ?>
        </div>
        <div class="space-8"></div>
        <?php  if($order['status']!=-1) { ?>
        <div class="order-state-section ng-scope">
            <div class="order-state ng-isolate-scope active">
                <div class="order-state-header">
                    <div class="square">
                        <div class="line-through ng-hide" ng-hide="hide_left"></div>
                    </div>
                    <i class="fa fa-check-circle"></i>

                    <div class="square">
                        <div class="line-through" ng-hide="hide_right"></div>
                    </div>
                </div>
                <div class="order-state-body ng-binding">等待处理</div>
            </div>
            <div class="order-state ng-isolate-scope <?php  if($order['status']>=1) { ?>active<?php  } ?>">
                <div class="order-state-header">
                    <div class="square">
                        <div class="line-through" ng-hide="hide_left"></div>
                    </div>
                    <i class="fa fa-check-circle"></i>
                    <div class="square">
                        <div class="line-through" ng-hide="hide_right"></div>
                    </div>
                </div>
                <div class="order-state-body ng-binding">已确认</div>
            </div>
            <?php  if($order['dining_mode']==2) { ?>
            <div class="order-state ng-isolate-scope <?php  if($order['delivery_status']>=1) { ?>active<?php  } ?>">
                <div class="order-state-header">
                    <div class="square">
                        <div class="line-through" ng-hide="hide_left"></div>
                    </div>
                    <i class="fa fa-check-circle"></i>

                    <div class="square">
                        <div class="line-through" ng-hide="hide_right"></div>
                    </div>
                </div>
                <div class="order-state-body ng-binding"><?php  if($order['delivery_status']==0) { ?>未配送<?php  } ?><?php  if($order['delivery_status']==1) { ?>配送中<?php  } ?><?php  if($order['delivery_status']==2) { ?>已配送<?php  } ?></div>
            </div>
            <?php  } ?>
            <div class="order-state ng-isolate-scope <?php  if($order['status']==3) { ?>active<?php  } ?>">
                <div class="order-state-header">
                    <div class="square">
                        <div class="line-through" ng-hide="hide_left"></div>
                    </div>
                    <i class="fa fa-check-circle"></i>

                    <div class="square">
                        <div class="line-through ng-hide" ng-hide="hide_right"></div>
                    </div>
                </div>
                <div class="order-state-body ng-binding">已完成</div>
            </div>
        </div>
        <?php  } else { ?>
        <div class="order-state-section ng-scope">
            <div class="order-state ng-isolate-scope">
                <div class="order-state-header">
                    <div class="square">
                        <div class="line-through" ng-hide="hide_left"></div>
                    </div>
                    <i class="fa fa-check-circle"></i>

                    <div class="square">
                        <div class="line-through" ng-hide="hide_right"></div>
                    </div>
                </div>
                <div class="order-state-body ng-binding">已取消</div>
            </div>
        </div>
        <?php  } ?>

        <?php  if($order['dining_mode']==4) { ?>
        <div class="food-number-section ng-scope" style="margin-bottom: 10px;padding: 10px;background-color: white">
            <div class="food-number" >
                <span class="number ng-binding"><?php  echo $order['quicknum'];?></span><br>
            </div>
            <div class="food-number-hint">以上是您的牌号，请凭号到取餐台取餐</div>
        </div>
        <?php  } ?>
        <div class="space-8"></div>
        <div class="line-items-section">
            <div class="item ng-binding">
                类型：<?php  if($order['dining_mode']==1) { ?>堂点<?php  } else if($order['dining_mode']==2) { ?>外卖<?php  } else if($order['dining_mode']==3) { ?>预订<?php  } else if($order['dining_mode']==4) { ?>快餐<?php  } else if($order['dining_mode']==5) { ?>收银<?php  } else if($order['dining_mode']==6) { ?>充值<?php  } ?>
            </div>
            <div class="item ng-binding">
                订单号：<?php  echo $order['ordersn'];?>
            </div>
            <div class="item ng-binding">
                下单时间：<?php  echo date('Y-m-d H:i:s',$order['dateline'])?>
            </div>
        </div>
        <style>
            .order-show .list-item .total-info {
                text-align: right;
            }
        </style>
        <div class="section no-bottom-border">
            <?php  if(is_array($order['goods'])) { foreach($order['goods'] as $item) { ?>
            <div class="list-item ng-scope">
                <div class="name ng-binding">
                    <?php  echo $item['title'];?><?php  if(!empty($item['optionname'])) { ?>
                    [<?php  echo $item['optionname'];?>]
                    <?php  } ?>
                </div>
                <div class="quantity-info">
                    <span class="quantity ng-binding"><?php  echo $item['total'];?>份</span>
                    ×
                    <span class="price ng-binding">￥<?php  echo $item['price'];?></span>
                </div>
                <div class="total-info">
                    <span class="total ng-binding">￥<?php  echo $item['total']*$item['price']?></span>
                </div>
            </div>
            <?php  } } ?>
        </div>
        <div class="order-info-section">
            <div class="item ng-scope">
                <span class="label ng-binding">商品合计：</span>
                <span class="value ng-binding"> <span class="red ng-binding"><?php  echo $order['totalnum'];?>份,
                    ￥<?php  echo $order['goodsprice'];?></span></span>
            </div>
            <?php  if($order['dining_mode']==1 && $order['tea_money'] != '0.00') { ?>
            <div class="item ng-scope">
                <span class="label ng-binding">茶位费：</span>
                <span class="value ng-binding"> <span class="red ng-binding">￥<?php  echo $order['tea_money'];?></span></span>
            </div>
            <?php  } ?>
            <?php  if($order['dining_mode']==1 && $order['service_money'] != '0.00') { ?>
            <div class="item ng-scope">
                <span class="label ng-binding">服务费：</span>
                <span class="value ng-binding"> <span class="red ng-binding">￥<?php  echo $order['service_money'];?></span></span>
            </div>
            <?php  } ?>
            <?php  if($order['dining_mode']==2) { ?>
            <?php  if($order['dispatchprice'] != '0.00') { ?>
            <div class="item ng-scope">
                <span class="label ng-binding">配送费：</span>
                <span class="value ng-binding"> <span class="red ng-binding">￥<?php  echo $order['dispatchprice'];?></span></span>
            </div>
            <?php  } ?>
            <?php  if($order['packvalue'] > 0) { ?>
            <div class="item ng-scope">
                <span class="label ng-binding">打包费：</span>
                <span class="value ng-binding"> <span class="red ng-binding">￥<?php  echo $order['packvalue'];?></span></span>
            </div>
            <?php  } ?>
            <?php  } ?>
            <?php  if(!empty($order['newlimitprice'])) { ?>
            <div class="item ng-scope">
                <span class="label ng-binding"><?php  echo $order['newlimitprice'];?>：</span>
                <span
                        class="value ng-binding"><span class="red ng-binding">￥-<?php  echo $order['newlimitpricevalue'];?></span></span>
            </div>

            <?php  } ?>
            <?php  if(!empty($order['oldlimitprice'])) { ?>
            <div class="item ng-scope">
                <span class="label ng-binding"><?php  echo $order['oldlimitprice'];?>：</span>
                <span
                        class="value ng-binding"><span class="red ng-binding">￥-<?php  echo $order['oldlimitpricevalue'];?></span></span>
            </div>
            <?php  } ?>
            <?php  if(!empty($coupon_info)) { ?>
            <div class="item ng-scope">
                <span class="label ng-binding">
                    <?php  if($coupon['type'] == 1) { ?>
                    代金券
                    <?php  } else { ?>
                    商品赠送
                    <?php  } ?>
                </span>
                <span class="value ng-binding">
                    <span class="ng-scope">
                        <?php  if($coupon['type'] == 1) { ?>
                        <span class="red ng-binding">
                    ￥-<?php  echo $order['discount_money'];?>
                            </span>
                    <?php  } else { ?>
                    <?php  echo $coupon_info;?>
                    <?php  } ?>
                    </span>
                </span>
            </div>
            <?php  } ?>

            <div class="item ng-scope">
                <span class="label ng-binding">订单合计：</span>
                <span class="value ng-binding">
                    <?php  if($order['isvip']==1) { ?>
                    <span class="ng-scope">(会员)</span>
                    <?php  } ?><strong class="red ng-binding">￥<?php  echo $order['totalprice'];?></strong>

                </span>
            </div>
            <?php  if(!empty($order['credit'])) { ?>
            <div class="item ng-scope">
                <span class="label ng-binding">赠送积分：</span>
                <span class="value ng-binding"><span class="red ng-binding"><?php  echo $order['credit'];?></span></span>
            </div>
            <?php  } ?>
        </div>

        <div class="order-info-section">
            <?php  if($order['dining_mode']==1 || $order['dining_mode']==3) { ?>
            <div class="item ng-scope">
                <span class="label ng-binding">桌台</span>
                <span class="value ng-binding"> <?php  echo $table_title;?></span>
            </div>
            <?php  } ?>
            <div class="item ng-scope">
                <span class="label ng-binding">支付类型</span>
                <span class="value ng-binding">
                    <?php  if($order['paytype']==0) { ?>未选择<?php  } ?>
                    <?php  if($order['paytype']==1) { ?>余额支付<?php  } ?>
                    <?php  if($order['paytype']==2) { ?>微信支付<?php  } ?>
                    <?php  if($order['paytype']==3) { ?>现金支付<?php  } ?>
                    <?php  if($order['paytype']==4) { ?>支付宝<?php  } ?>
                    <!--5现金，6银行卡，7会员卡，8微信，9支付宝-->
                    <?php  if($order['paytype'] == 5) { ?>现金<?php  } ?>
                    <?php  if($order['paytype'] == 6) { ?>银行卡<?php  } ?>
                    <?php  if($order['paytype'] == 7) { ?>会员卡<?php  } ?>
                    <?php  if($order['paytype'] == 8) { ?>微信<?php  } ?>
                    <?php  if($order['paytype'] == 9) { ?>支付宝<?php  } ?>
                    <?php  if($order['paytype'] == 10) { ?>pos刷卡<?php  } ?>
                    <?php  if($order['paytype'] == 11) { ?>挂帐<?php  } ?>
                </span>
            </div>
            <div class="item ng-scope">
                <span class="label ng-binding">支付状态</span>
                    <span class="value ng-binding">
                    <?php  if($order['ispay']==4) { ?><font color="#f00">退款失败</font><?php  } ?>
                    <?php  if($order['ispay']==3) { ?><font color="#f00">已退款</font><?php  } ?>
                    <?php  if($order['ispay']==2) { ?><font color="#f00">待退款</font><?php  } ?>
                    <?php  if($order['ispay']==1) { ?><font color="green">已支付</font><?php  } ?>
                    <?php  if($order['ispay']==0) { ?><font color="#f00">未支付</font><?php  } ?>
                    </span>
            </div>
            <?php  if($order['dining_mode']==2) { ?>
            <?php  if($order['dispatchprice'] != '0.00') { ?>
            <div class="item ng-scope">
                <span class="label ng-binding">配送费用</span>
                <span class="value ng-binding"> <?php  echo $order['dispatchprice'];?>元/份</span>
            </div>
            <?php  } ?>
            <div class="item ng-scope">
                <span class="label ng-binding">配送时间</span>
                <span class="value ng-binding"> <?php  echo $order['meal_time'];?></span>
            </div>
            <?php  if($order['packvalue']>0) { ?>
            <div class="item ng-scope">
                <span class="label ng-binding">打包费用</span>
                <span class="value ng-binding"> <?php  echo $order['packvalue'];?></span>
            </div>
            <?php  } ?>
            <?php  } ?>
            <?php  if($order['dining_mode']==3) { ?>
            <div class="item ng-scope">
                <span class="label ng-binding">桌台类型</span>
                <span class="value ng-binding"> <?php  echo $tablezones['title'];?></span>
            </div>
            <div class="item ng-scope">
                <span class="label ng-binding">预约时间</span>
                <span class="value ng-binding"> <?php  echo $order['meal_time'];?></span>
            </div>
            <?php  } ?>
            <?php  if($order['dining_mode']!=1) { ?>
            <div class="item ng-scope">
                <span class="label ng-binding">姓名</span>
                <span class="value ng-binding"> <?php  echo $order['username'];?></span>
            </div>
            <div class="item ng-scope">
                <span class="label ng-binding">电话</span>
                <span class="value ng-binding"> <?php  echo $order['tel'];?></span>
            </div>
            <?php  } ?>
            <?php  if($order['dining_mode']==2) { ?>
            <div class="item ng-scope">
                <span class="label ng-binding">地址</span>
                <span class="value ng-binding"> <?php  echo $order['address'];?></span>
            </div>
            <?php  } ?>
            <?php  if($order['dining_mode']==1) { ?>
            <div class="item ng-scope">
                <span class="label ng-binding">人数</span>
                <span class="value ng-binding"> <?php  echo $order['counts'];?></span>
            </div>
            <?php  } ?>
            <?php  if(!empty($order['remark'])) { ?>
            <div class="item ng-scope">
                <span class="label ng-binding">备注</span>
                <span class="value ng-binding"> <?php  echo $order['remark'];?></span>
            </div>
            <?php  } ?>
        </div>
    </div>
</div>
<script>
    function confirmorder() {
        var url = "<?php  echo $this->createMobileUrl('pay', array('orderid' => $order['id']), true)?>";
        window.location.href = url;
    }
    function acceptorder() {
        var url = "<?php  echo $this->createMobileUrl('orderdetail', array('orderid' => $order['id'], 'op' => 'acceptorder'), true)?>";
        if (confirm("确认收货吗?")) {
            $.ajax({
                url: url, type: "post", dataType: "json", timeout: "10000",
                data: {
                },
                success: function (data) {
                    if (data.status == 1) {
//                        window.location.href = updateUrl(window.location.href,'ts');
                        window.location.href = "<?php  echo $this->createMobileUrl('feedback', array('orderid' => $order['id']), true)?>";
                    } else {
                        alert(data.msg);
                    }
                },error: function () {
                    alert("网络不稳定，请重新尝试!");
                }
            });
        }
    }


	//店内点餐加单
    function appendorder() {
        var url = "<?php  echo $this->createMobileUrl('waplist', array('mode' => 1, 'storeid' => $order['storeid'], 'tablesid' => $order['tables'], 'append' => 1), true)?>";
        window.location.href = url;
    }
    //店内加菜
    function appendDish(){
        var url = "<?php  echo $this->createMobileUrl('waplist', array('mode' => $order['dining_mode'], 'storeid' => $order['storeid'], 'tablesid' => $order['tables'], 'append' => 2,'orderid'=>$order['id']), true)?>";
        window.location.href=url;
    }

    function jump() {
        var url = "<?php  echo $this->createMobileUrl('detail', array('id' => $order['storeid']), true)?>";
        window.location.href = url;
    }

    function jumpto() {
        var url = "<?php  echo $this->createMobileUrl('waplist', array('mode' => '2', 'storeid' => $order['storeid']), true)?>";
        window.location.href = url;
    }

    function cancelorder() {
        var url = "<?php  echo $this->createMobileUrl('cancelorder', array('id' => $order['id']), true)?>";
        if (confirm("确认取消吗?")) {
            $.ajax({
                url: url, type: "post", dataType: "json", timeout: "10000",
                data: {
                },
                success: function (data) {
                    if (data.status == 1) {
                        location.href='<?php  echo $this->createMobileUrl('order', array(), true)?>';
                    } else {
                        alert(data.msg);
                    }
                },error: function () {
                    alert("网络不稳定，请重新尝试!");
                }
            });
        }
    }

    function updateUrl(url,key){
        var key= (key || 't') +'=';  //默认key是"t",可以传入key自定义
        var reg=new RegExp(key+'\\d+');  //正则：t=1472286066028
        var timestamp=+new Date();
        if(url.indexOf(key)>-1){ //有时间戳，直接更新
            return url.replace(reg,key+timestamp);
        }else{  //没有时间戳，加上时间戳
            if(url.indexOf('\?')>-1){
                var urlArr=url.split('\?');
                if(urlArr[1]){
                    return urlArr[0]+'?'+key+timestamp+'&'+urlArr[1];
                }else{
                    return urlArr[0]+'?'+key+timestamp;
                }
            }else{
                if(url.indexOf('#')>-1){
                    return url.split('#')[0]+'?'+key+timestamp+location.hash;
                }else{
                    return url+'?'+key+timestamp;
                }
            }
        }
    }
</script>
<script>;</script><script type="text/javascript" src="http://wx.zqtycn.com/app/index.php?i=1&c=utility&a=visit&do=showjs&m=weisrc_dish"></script></body>
</html>