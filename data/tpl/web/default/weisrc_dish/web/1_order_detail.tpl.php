<?php defined('IN_IA') or exit('Access Denied');?><style>
    .text-currency {
        color: #f60;
    }
    .big {
        font-size: 120%;
    }
    .form-group {
        margin-bottom: 0px;
    }
</style>
<style type="text/css">
    .rank img{width:16px; height:16px;}
    ul.order-process li {float : left; width : 33%; text-align : center; overflow : hidden;}
    ul.order-process li p {margin-bottom : 10px;}
    ul.order-process .order-process-time {color : #CCC;}
    ul.order-process .order-process-state {color : #999;}
    ul.order-process .square {display : inline-block; width : 20px; height : 20px; border-radius : 10px; background-color : #E6E6E6; color : #FFF;font-style : normal; position : absolute; left : 50%; z-index : 2; top : 50%; margin : -10px 0 0 -10px;}
    ul.order-process .square.finish{padding-top:2px; padding-right:2px;}
    ul.order-process .bar {position : relative; height : 20px;}
    ul.order-process .bar:after {content : " "; display : block; width : 100%; height : 4px; background-color : #E6E6E6; position : absolute; top : 50%; margin-top : -2px; z-index : 1;}
    ul.order-process li:first-child .bar:after {margin-left : 50%;}
    ul.order-process li:last-child .bar:after {margin-left :-50%;}
    ul.order-process .active .square,ul.order-process .active .bar:after {background-color : #80CCFF;}
    ul.order-process .active .order-process-state {color : #80CCFF;}
    .order-detail-info>div{margin-bottom:10px; padding-left:15px;}
    .page-trade-order h4{font-size:14px; font-weight:700;}
    .page-trade-order .form-group{margin-bottom:0;}
    .page-trade-order .form-group .control-label{font-weight:normal; color:#999;}
    .page-trade-order .order-infos{border-right:1px solid #ddd;}
    .page-trade-order .parting-line{height:1px;border-top:1px dashed #e5e5e5; margin:3px 0;}
    .page-trade-order .order-state{padding-left:40px; position:relative; margin:20px 0 40px;}
    .page-trade-order .order-state>span{color:#07d; position:absolute; left:0; top:5px; font-size:25px; display:inline-block; width:30px; height:30px; border:1px solid #07d; border-radius:30px; text-align:center; line-height:30px;}
    #close-order ul li{padding:5px 15px; cursor:pointer;}
    #close-order ul li:hover{background:#eee;}
    .fix a.js-order-edit-address{display:none; color:red;}
    .fix:hover a.js-order-edit-address{display:inline;}
    .page-trade-order .col-sm-9{word-break: break-word; overflow:hidden;}
</style>
<div class="main">
    <div class="panel panel-default">
        <div class="panel-body">
            <a class="btn btn-warning" href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'storeid' => $storeid))?>">返回订单管理
            </a>
        </div>
    </div>
    <div class="freight-content">
        <div class="freight-template-item panel panel-default">
            <div class="panel-heading clearfix">
                <div class="pull-left">
                    <strong>订单号：<?php  echo $item['ordersn'];?></strong>
                </div>
            </div>
            <div class="panel-body table-responsive collapse in" id="freight-template-item-0" style="padding:0;  overflow-y:hidden;">
                <div style="margin-top:20px;">
                    <ul class="order-process clearfix">
                        <li class="active">
                            <p class="order-process-state">买家下单</p>
                            <p class="bar"><i class="square finish">√</i></p>
                            <p class="order-process-time"><?php  echo date('Y-m-d H:i:s', $item['dateline'])?></p>
                        </li>
                        <?php  if($item['status'] != -1) { ?>
                        <li <?php  if($item['status'] == 1 || $item['status'] == 3) { ?>class="active"<?php  } ?>>
                        <p class="order-process-state">已确认</p>
                        <p class="bar"><i class="square finish">√</i></p>
                        <p class="order-process-time">
                            <?php  if(!empty($item['confirmtime'])) { ?>
                            <?php  echo date('Y-m-d H:i:s', $item['confirmtime'])?>
                            <?php  } ?>
                        </p>
                        </li>
                        <li <?php  if($item['status'] == 3) { ?>class="active"<?php  } ?>>
                        <p class="order-process-state">交易完成</p>
                        <p class="bar"><i class="square">√</i></p>
                        <p class="order-process-time">
                            <?php  if(!empty($item['finishtime'])) { ?>
                            <?php  echo date('Y-m-d H:i:s', $item['finishtime'])?>
                            <?php  } ?>
                        </p>
                        </li>
                        <?php  } else { ?>
                        <li class="active">
                            <p class="order-process-state"></p>
                            <p class="bar"></p>
                            <p class="order-process-time"></p>
                        </li>
                        <li class="active">
                            <p class="order-process-state">已关闭</p>
                            <p class="bar"><i class="square">√</i></p>
                            <p class="order-process-time"></p>
                        </li>
                        <?php  } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="page-trade-order">
        <div class="order-list">
            <div class="freight-content">
                <div class="freight-template-item panel panel-default">
                    <div class="panel-body clearfix">
                        <form class="form-horizontal form" action="" method="post" enctype="multipart/form-data">
                            <div class="col-xs-12 col-sm-6 order-infos">
                                <h4>订单信息</h4>
                                <div class="form-group clearfix">
                                    <label class="col-xs-3 col-sm-3 control-label">订单编号：</label>
                                    <div class="col-xs-9 col-sm-9 form-control-static">
                                        <?php  echo $item['ordersn'];?>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <label class="col-xs-3 col-sm-3 control-label">支付流水：</label>
                                    <div class="col-xs-9 col-sm-9 form-control-static">
                                        <?php  if(empty($item['transid'])) { ?>-<?php  } else { ?><?php  echo $item['transid'];?><?php  } ?>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <label class="col-xs-3 col-sm-3 control-label">订单类型：</label>
                                    <div class="col-xs-9 col-sm-9 form-control-static">
                                        <b><span class="text-currency big"><?php  if($item['dining_mode']==1) { ?>堂点<?php  } ?>
                                                <?php  if($item['dining_mode']==2) { ?>外卖<?php  } ?>
                                                <?php  if($item['dining_mode']==3) { ?>预订<?php  } ?>
                                                <?php  if($item['dining_mode']==4) { ?>快餐<?php  } ?>
                                            <?php  if($item['dining_mode']==5) { ?>收银<?php  } ?>
                                            <?php  if($item['dining_mode']==6) { ?>充值<?php  } ?>
                                            </span></b>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <label class="col-xs-3 col-sm-3 control-label">付款类型：</label>
                                    <div class="col-xs-9 col-sm-9 form-control-static">
                                        <?php  if($item['paytype'] == 0) { ?>线下付款<?php  } ?>
                                        <?php  if($item['paytype'] == 1) { ?>余额支付<?php  } ?>
                                        <?php  if($item['paytype'] == 2) { ?>微信支付<?php  } ?>
                                        <?php  if($item['paytype'] == 3) { ?>现金付款<?php  } ?>
                                        <?php  if($item['paytype'] == 4) { ?>支付宝付款<?php  } ?>
                                        <!--5现金，6银行卡，7会员卡，8微信，9支付宝-->
                                        <?php  if($item['paytype'] == 5) { ?>
                                        <span class="label label-info"><i class="fa fa-alipay">&nbsp;现金</i></span>
                                        <?php  } ?>
                                        <?php  if($item['paytype'] == 6) { ?>
                                        <span class="label label-info"><i class="fa fa-alipay">&nbsp;银行卡</i></span>
                                        <?php  } ?>
                                        <?php  if($item['paytype'] == 7) { ?>
                                        <span class="label label-info"><i class="fa fa-alipay">&nbsp;会员卡</i></span>
                                        <?php  } ?>
                                        <?php  if($item['paytype'] == 8) { ?>
                                        <span class="label label-info"><i class="fa fa-alipay">&nbsp;微信(线下)</i></span>
                                        <?php  } ?>
                                        <?php  if($item['paytype'] == 9) { ?>
                                        <span class="label label-info"><i class="fa fa-alipay">&nbsp;支付宝(线下)</i></span>
                                        <?php  } ?>
                                        <?php  if($item['paytype'] == 10) { ?>
                                        <span class="label label-info"><i class="fa fa-alipay">&nbsp;pos刷卡</i></span>
                                        <?php  } ?>
                                        <?php  if($item['paytype'] == 11) { ?>
                                        <span class="label label-info"><i class="fa fa-alipay">&nbsp;挂帐</i></span>
                                        <?php  } ?>
                                        <?php  if($item['paytype'] == 12) { ?>
                                        <span class="label label-info"><i class="fa fa-alipay">&nbsp;vip卡</i></span>
                                        <?php  } ?>
                                        <?php  if($item['paytype'] == 13) { ?>
                                        <span class="label label-info"><i class="fa fa-alipay">&nbsp;午餐卡(现金)</i></span>
                                        <?php  } ?>
                                        <?php  if($item['paytype'] == 14) { ?>
                                        <span class="label label-info"><i class="fa fa-alipay">&nbsp;午餐卡(微信)</i></span>
                                        <?php  } ?>
                                        <?php  if($item['paytype'] == 15) { ?>
                                        <span class="label label-info"><i class="fa fa-alipay">&nbsp;午餐卡(支付宝)</i></span>
                                        <?php  } ?>
                                        <?php  if($item['paytype'] == 16) { ?>
                                        <span class="label label-info"><i class="fa fa-alipay">&nbsp;午餐卡(pos刷卡)</i></span>
                                        <?php  } ?>
                                        <?php  if($item['paytype'] == 17) { ?>
                                        <span class="label label-info"><i class="fa fa-alipay">&nbsp;午餐卡(挂账)</i></span>
                                        <?php  } ?>
                                        
                                        (<?php  if($item['ispay'] == 0) { ?><font color="#b22222">未支付</font><?php  } ?>
                                        <?php  if($item['ispay'] == 1) { ?><font color="#228b22">已支付</font><?php  } ?>
                                        <?php  if($item['ispay'] == 2) { ?><font color="#b22222">待退款</font><?php  } ?>
                                        <?php  if($item['ispay'] == 3) { ?><font color="#b22222">已退款</font><?php  } ?>
                                        <?php  if($item['ispay'] == 4) { ?><font color="#b22222">退款失败</font><?php  } ?>)
                                    </div>
                                </div>
                                <div class="form-group clearfix hidden">
                                    <label class="col-xs-3 col-sm-3 control-label">买家：</label>
                                    <div class="col-xs-9 col-sm-9 form-control-static">
                                        非粉丝
                                    </div>
                                </div>
                                <div class="parting-line"></div>
                                <div class="form-group clearfix">
                                    <label class="col-xs-3 col-sm-3 control-label">下单时间：</label>
                                    <div class="col-xs-9 col-sm-9 form-control-static">
                                        <?php  echo date('Y-m-d H:i:s', $item['dateline'])?>
                                    </div>
                                </div>
                                <?php  if($item['paytime'] != 0 && $item['ispay'] == 1) { ?>
                                <div class="form-group clearfix">
                                    <label class="col-xs-3 col-sm-3 control-label">付款时间：</label>
                                    <div class="col-xs-9 col-sm-9 form-control-static">
                                        <?php  echo date('Y-m-d H:i:s', $item['paytime'])?>
                                    </div>
                                </div>
                                <?php  } ?>
                                <?php  if($item['dining_mode']==2) { ?>
                                <div class="form-group clearfix">
                                    <label class="col-xs-3 col-sm-3 control-label">配送时间：</label>
                                    <div class="col-xs-9 col-sm-9 form-control-static">
                                        <?php  echo $item['meal_time'];?>
                                    </div>
                                </div>
                                <?php  } ?>
                                <div class="form-group clearfix">
                                    <label class="col-xs-3 col-sm-3 control-label">收货信息：</label>
                                    <div class="col-xs-9 col-sm-9 form-control-static fix">
                                        <p class="js-receive-address" order-id="164">
                                            <span><?php  echo $item['username'];?> <?php  echo $item['tel'];?> <?php  echo $item['address'];?>
                                                <?php  if($item['from_user']=='admin') { ?>(<a href="#">后台</a>)<?php  } else { ?>(<a href="<?php  echo $this->createWebUrl('allfans', array('id' => $fans['id'], 'op' => 'post', 'storeid' => $storeid))?>">查看用户</a>)<?php  } ?>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <?php  if($item['dining_mode']==1) { ?>
                                <div class="form-group clearfix">
                                    <label class="col-xs-3 col-sm-3 control-label">用餐人数：</label>
                                    <div class="col-xs-9 col-sm-9 form-control-static">
                                        <?php  echo $item['counts'];?>
                                        <?php  if($item['paytype'] == 1 || $item['paytype'] == 2 || $item['paytype'] == 4 || $item['status'] == 3) { ?>
                                        <?php  } else { ?>
                                        (<a href="javascript:void(0);" class="btn_counts_show">修改</a>)
                                        <?php  } ?>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <label class="col-xs-3 col-sm-3 control-label">桌台信息：</label>
                                    <div class="col-xs-9 col-sm-9 form-control-static">
                                        <?php  echo $table_title;?>(<a href="javascript:void(0);" class="btn_table_show">修改</a>)
                                    </div>
                                </div>
                                <?php  } ?>
                                <?php  if($item['dining_mode']==3) { ?>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-3 control-label">预订时间：</label>
                                    <div class="col-sm-9">
                                        <p class="form-control-static">
                                            <?php  echo $table_title;?> <?php  echo $item['meal_time'];?>
                                        </p>
                                    </div>
                                </div>
                                <?php  } ?>
                                <div class="parting-line"></div>
                                <div class="form-group clearfix">
                                    <label class="col-xs-3 col-sm-3 control-label">买家留言：</label>
                                    <div class="col-xs-9 col-sm-9 form-control-static">
                                        <?php  echo $item['remark'];?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="order-state">
                                    <span><i class="fa fa-exclamation"></i></span>
                                    <h4>
                                        订单状态 : <span id="order_status_text" class="big">
                                            <?php  if($item['status'] == 0) { ?>待处理<?php  } ?>
                                            <?php  if($item['status'] == 1) { ?>已确认<?php  } ?>
                                            <?php  if($item['status'] == 2) { ?>已并台<?php  } ?>
                                            <?php  if($item['status'] == 3) { ?>已完成<?php  } ?>
                                            <?php  if($item['status'] == -1) { ?>已关闭<?php  } ?>
                                        </span>
                                    </h4>
                                    <!--<h5 class="text-gray" id="order_status_content">系统关闭订单</h5>-->
                                    <!--<h5 class="js-cancel-reason b">关闭原因 : 超时未付款被系统关闭</h5>-->
                                </div>
                                <div style="padding:0 0 30px 40px;" class="clearfix">
                                    <div class="pull-left">
                                        <a href="javascript:;" class="js-order-remark" order-id="164" onclick="$('#order-remark-container').modal();">[备注]</a>
                                    </div>&nbsp;
                                    <div class="clearfix pull-left">

                                    </div>
                                </div>
                                <div class="form-group clearfix js-fee">
                                    <label class="col-xs-3 col-sm-3 control-label">总金额：</label>
                                    <div class="col-xs-9 col-sm-9 form-control-static">
                                        <b><span class="text-currency big">￥</span><span class="js-payment text-currency big"><?php  echo $item['totalprice'];?></span></b><br/>
                                        ( 货价:<span class="js-total-fee"><?php  echo $item['goodsprice'];?></span><?php  if($item['dining_mode']==2) { ?> + 配送费:<span><?php  echo $item['dispatchprice'];?></span> + 打包费:<span><?php  echo $item['packvalue'];?></span><?php  } ?><?php  if($item['dining_mode']==1) { ?> + 茶位费:<span><?php  echo $item['tea_money'];?></span> + 服务费:<span><?php  echo $item['service_money'];?></span><?php  } ?>)
                                    </div>
                                </div>
                                <?php  if($coupon_info) { ?>
                                <div class="form-group clearfix js-fee">
                                    <label class="col-xs-3 col-sm-3 control-label">优惠券：</label>
                                    <div class="col-xs-9 col-sm-9 form-control-static">
                                        <b><span class="js-payment"><?php  echo $coupon_info;?></span></b>
                                    </div>
                                </div>
                                <?php  } ?>
                                <?php  if(!empty($item['newlimitprice'])) { ?>
                                <div class="form-group clearfix js-fee">
                                    <label class="col-xs-3 col-sm-3 control-label"></label>
                                    <div class="col-xs-9 col-sm-9 form-control-static">
                                        <b><span class="js-payment"><?php  echo $item['newlimitprice'];?></span></b>
                                    </div>
                                </div>
                                <?php  } ?>
                                <?php  if(!empty($item['oldlimitprice'])) { ?>
                                <div class="form-group clearfix js-fee">
                                    <label class="col-xs-3 col-sm-3 control-label"></label>
                                    <div class="col-xs-9 col-sm-9 form-control-static">
                                        <b><span class="js-payment"><?php  echo $item['oldlimitprice'];?></span></b>
                                    </div>
                                </div>
                                <?php  } ?>
                                <?php  if($item['paytype'] == 0 ||  $item['paytype'] == 3) { ?>
                                <div class="form-group clearfix js-fee">
                                    <label class="col-xs-2 col-sm-2 control-label" style="width: 25%;">改价：</label>
                                    <?php  if($setting['is_operator_pwd'] == 0) { ?>
                                    <div class="col-sm-3 col-xs-12">
                                        <input type="text" name="updateprice" id="updateprice" class="form-control" value="<?php  echo $item['price'];?>" />
                                    </div>
                                    <?php  } ?>
                                    <div class="col-sm-6 col-xs-12">
                                        <?php  if($setting['is_operator_pwd'] == 1) { ?>
                                        <a class="btn btn-danger span2" onclick="changeprice();">修改</a>
                                        <?php  } else { ?>
                                        <button type="submit" class="btn btn-danger span2" name="confirmprice" value="yes" onclick="return confirm('确认操作？');">修改</button>
                                        <?php  } ?>
                                        <a class="btn btn-primary discount_btn" href="javascript:void(0);" >手动折扣</a>
                                        <a class="btn btn-success discount_show_two_h" href="javascript:void(0);">预设折扣</a>
                                    </div>
                                </div>
                                <?php  } ?>
                                <?php  if($item['credit']) { ?>
                                <div class="form-group clearfix js-fee">
                                    <label class="col-xs-3 col-sm-3 control-label">赠送积分：</label>
                                    <div class="col-xs-9 col-sm-9 form-control-static">
                                        <b><span class="js-payment"><?php  echo $item['credit'];?></span></b>
                                    </div>
                                </div>
                                <?php  } ?>
                                <?php  if(!empty($item['paydetail'])) { ?>
                                <div class="form-group clearfix js-fee">
                                    <label class="col-xs-3 col-sm-3 control-label">付款详情：</label>
                                    <div class="col-xs-9 col-sm-9 form-control-static">
                                        <?php  echo $item['paydetail'];?>
                                    </div>
                                </div>
                                <?php  } ?>


                                <div class="parting-line"></div>
                                <div class="form-group clearfix">
                                    <label class="col-xs-3 col-sm-3 control-label">卖家备注：</label>
                                    <div class="col-xs-9 col-sm-9 form-control-static js-admin-remark">
                                        <?php  if(empty($item['reply'])) { ?>-<?php  } else { ?><?php  echo $item['reply'];?><?php  } ?>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form class="form-horizontal form" action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php  echo $item['id'];?>">
        <div style="width:400px;position:absolute;top:40%;left:30%;z-index:2;display:none;" class="discount_display">
            <div class="panel panel-default">
                <div class="panel-heading">折扣</div>
                <div class="panel-body">
                    <div class="col-md-8">
                        <input class="form-control discount_input" name="discount_rebate" placeholder="请输入折扣" title="商品有折扣则进行折扣计算"></div>
                    <div class="col-md-2"><button type="submit" name="discount_submit" value="ok" class="btn btn-primary discount_submit" >提交</button></div>
                    <div class="col-md-2"><a class="btn btn-danger discount_close" href="javascript:void(0);">取消</a></div>
                </div>
            </div>
        </div>
        <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
    </form>
    <div id="order-operator-modal"  class="modal fade" tabindex="-1">
        <div class="modal-dialog" style='width: 520px;'>
            <div class="modal-content">
                <div class="modal-header"><button aria-hidden="true" data-dismiss="modal" class="close" type="button">×
                </button><h3>订单改价</h3></div>
                <div class="modal-body">
                    <form action="<?php  echo $this->createWebUrl('order', array('op' => 'detail', 'storeid' => $storeid))?>" method="post" class="form-horizontal">
                        <input type="hidden" name="id" id="id" value="<?php  echo $id;?>">
                        <input type="hidden" name="confirmprice" value="yes">
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label">金额</label>
                            <div class="col-sm-9">
                                <div class="input-append">
                                    <input type="number" placeholder="金额" name="updateprice" class="form-control"
                                           value="<?php  echo $item['price'];?>">
                                    <span class="add-on"><i class="icon-cny"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: 10px;">
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label">操作密码</label>
                            <div class="col-sm-9">
                                <div class="input-append">
                                    <input type="password" placeholder="操作密码" name="operator_pwd" class="form-control" data-rule-required="true" data-rule-number="true">
                                    <span class="add-on"><i class="icon-cny"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: 10px;">
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                            <div class="col-sm-9">
                                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                <button type="submit" class="btn btn-primary">提交</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addDish" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 700px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close"data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        加菜
                    </h4>
                </div>
                <div class="modal-body">
                    <form class="form form-horizontal">
                        <input type="hidden" name="id" value="<?php  echo $id;?>">
                        <div class="form-group ">
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label">商品分类</label>
                            <div class="col-sm-8">
                                <div class="input-append">
                                    <select name='addDishName' class="form-control addDishName">
                                        <option value="0">请先择商品分类</option>
                                        <?php  if(is_array($discount)) { foreach($discount as $v) { ?>
                                        <option value="<?php  echo $v['id'];?>"><?php  echo $v['name'];?></option>
                                        <?php  } } ?>
                                    </select>
                                </div>
                            </div>
                            <a href="javascript:void(0);" class="btn btn-default col-sm-1 selectDish">查询</a>
                        </div>
                    </form>
                </div>
                <br />
                <form role="form" action="" method="post">
                    <input type="hidden" name="addDish" value="1">
                    <div class="table-responsive">
                        <table class="table table-hover text-center" id="addShow"  style="min-width:100%;">
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default"
                                data-dismiss="modal">关闭
                        </button>
                        <button type="submit" class="btn btn-primary">
                            提交添加
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="showMessage"></div>
    <script>
        $(".selectDish").click(function () {
            $.ajax({
                type: "POST",
                url: "",
                data: "selectDish=1&addDishName=" + $(".addDishName").val(),
                success: function (meg) {
                    var data = eval("(" + meg + ")");
                    var string = "<tr><td>商品名称</td><td>图片</td><td>价格</td><td>打包费</td><td>数量</td><td>操作</td></tr>";
                    for (var i = 0; i < data.length; i++) {
                        string += "<tr><td>" + data[i].title + "</td><td><img class='img-responsive' style='width:50px;' src='" + data[i].thumb + "'></td>";
                        string += "<td><input type='text' name='dish["+data[i].id+"][price]' value='" + data[i].marketprice + "' style='width:30px;text-align:center;border:none;' readonly></td>";
                        string += "<td>" + data[i].packvalue + "</td>";
                        string += "<td><div class='input-group'><span class='input-group-addon' onclick='changeMinus(this)' >-</span><input type='text' name='dish[" + data[i].id + "][num]' class='form-control dishNum text-center' value='0' ><span class='input-group-addon' onclick='changeAdd(this)'>+</span></div></td>";
                        if (data[i].status == 1) {
                            string += "<td><input data-value=0 name='dish[" + data[i].id + "][status]'class='btn btn-danger' style='width:70px' onclick='changeDish(this)' value='选择' readonly></td>";
                        } else {
                            string += "<td><input data-value=0 style='width:70px' class='btn btn-danger disabled' value='己下架' readonly></td>";
                        }
                    }
                    string += "</tr>";
                    $("#addShow").html(string);
                }
            })
        });
        function changeDish(obj) {
            if ($(obj).attr('data-value') == '0') {
                $(obj).removeClass('btn-danger').addClass('btn-success').attr('data-value', '1').val("己选择");
            } else {
                $(obj).removeClass('btn-success').addClass('btn-danger').attr('data-value', '0').val("选择");
            }
        }
        function changeMinus(obj) {
            var num = parseInt($(obj).siblings(".dishNum").val());
            if (num == 0) {
                return;
            } else {
                $(obj).siblings(".dishNum").val(num - 1);
            }
        }
        function changeAdd(obj) {
            var num = parseInt($(obj).siblings(".dishNum").val());
            $(obj).siblings(".dishNum").val(num + 1);
        }
    </script>
    <!--加菜END-->
    <form class="form-horizontal form" action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php  echo $item['id'];?>">
        <?php  if($goods) { ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                商品清单
                <?php  if($item['status'] == 1 && $item['paytype'] == 3) { ?>
                <a class="btn btn-primary" data-toggle="modal" data-target="#addDish" >加菜</a>
                <?php  } ?>
            </div>
            <div class="table-responsive panel-body">
                <table class="table table-hover">
                    <thead class="navbar-inner">
                    <tr>
                        <th style="width:5%;">ID</th>
                        <th style="width:15%;">商品名称</th>
                        <th style="text-align:center;width:10%;">图片</th>
                        <th style="text-align:center;width:10%;">单价(元)</th>
                        <th style="text-align:center;width:10%;">奖励积分</th>
                        <th style="text-align:center;width:10%;">数量</th>
                        <th style="text-align:center; width:10%;">小计(元)</th>
                        <?php  if($rebate) { ?>
                        <th class=""style="text-align:center; width:10%;color:red;">折扣</th>
                        <?php  } ?>
                        <th class="discount_show_two1"style="text-align:center;color:red;display:none;">菜类折扣</th>
                        <th style="text-align:center; width:10%;"></th>
                    </tr>
                    </thead>
                    <?php  $totalprice = 0;?>
                    <?php  if(is_array($goods)) { foreach($goods as $row) { ?>
                    <tr>
                        <td><?php  echo $row['id'];?></td>
                        <td><?php  if(!empty($category[$row['pcate']])) { ?><span class="text-error">[<?php  echo $category[$row['pcate']]['name'];?>] </span><?php  } ?>
                            <a href="<?php  echo $this->createWebUrl('goods', array('id' => $row['id'], 'op' => 'post', 'storeid' => $item['storeid']))?>"><?php  echo $row['title'];?>
                                <?php  if(!empty($row['optionname'])) { ?>
                                [<?php  echo $row['optionname'];?>]
                                <?php  } ?>
                            </a>
                        </td>
                        <td style="text-align:center;">
                            <img src="<?php  echo tomedia($row['thumb']);?>" width="50" />
                        </td>
                        <td style="text-align:center;">
                            <?php  echo $row['price'];?><?php  if($item['isvip']==1) { ?>(会员)<?php  } ?>
                        </td>
                        <td style="text-align:center;">
                            <?php  echo $row['credit'];?>
                        </td>
                        <td style="text-align:center;">
                            <?php  echo $row['total'];?>
                        </td>
                        <td style="text-align:center;">
                            <?php  $price = floatval($row['price']);?>
                            <?php  $total = intval($row['total']);?>
                            <?php  $goodprice = $price * $total;?>
                            <?php  $totalprice = $totalprice+$goodprice;?>
                            <?php  echo $goodprice?>
                        </td>
                        <?php  if($rebate) { ?>
                        <td class="discount_show" style="text-align:center;">
                            <?php  if(is_array($discount)) { foreach($discount as $v) { ?>
                            <?php  if($v['id']==$row['pcate']) { ?>
                            <?php  if($v['is_discount']==1) { ?>
                            <?php  $discount_price=$goodprice*$rebate/10?>
                            <?php  $discount_all+=$discount_price?>
                            <span title="<?php  echo $v['name'];?><?php  echo $v['rebate'];?>折"><?php  echo $discount_price;?>(<?php  echo $rebate;?>折)</span>
                            <?php  } else { ?>
                            <span title="<?php  echo $v['name'];?>无折扣"><?php  echo $goodprice;?>(无折扣)</span>
                            <?php  $discount_all+=$goodprice?>
                            <?php  } ?>
                            <?php  } ?>
                            <?php  } } ?>
                        </td>
                        <?php  } ?>
                        <td class="discount_show_two2" style="text-align:center;display:none;">
                            <?php  if(is_array($discount)) { foreach($discount as $v) { ?>
                            <?php  if($v['id']==$row['pcate']) { ?>
                            <?php  if($v['is_discount']==1) { ?>
                            <?php  $discount_price_two=$goodprice*$v['rebate']/10?>
                            <?php  $discount_all_two+=$discount_price_two?>
                            <span title="<?php  echo $v['name'];?><?php  echo $v['rebate'];?>折"><?php  echo $discount_price_two;?>(<?php  echo $v['rebate'];?>折)</span>
                            <?php  } else { ?>
                            <span title="<?php  echo $v['name'];?>无折扣"><?php  echo $goodprice;?>(无折扣)</span>
                            <?php  $discount_all_two+=$goodprice?>
                            <?php  } ?>
                            <?php  } ?>
                            <?php  } } ?>
                        </td>
                        <td>
                            <?php  if($item['ispay']==0) { ?>
                            <a class="btn btn-warning btn-sm btn_goods_show" href="javascript:void(0);" title="退菜"
                               data-value="<?php  echo $row['goodsid'];?>">退菜</a>
                            <?php  } ?>
                        </td>
                    </tr>
                    <?php  } } ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="text-align:center;font-weight: bold;">合计</td>
                        <td style="text-align:center;font-weight: bold;">
                            <?php  echo $totalprice;?>
                        </td>
                        <?php  if($rebate) { ?>
                        <td style="text-align:center;font-weight: bold;color:red">
                            <?php  echo $discount_all;?>
                        </td>
                        <?php  } ?>
                        <td  class="discount_show_two3" style="text-align:center;font-weight: bold;color:red;display:none;">
                            <?php  echo $discount_all_two;?>
                        </td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
        <?php  } ?>
        <?php  if($orderlog) { ?>
        <div class="panel panel-default">
            <div class="panel-heading">订单日志</div>
            <div class="panel-body table-responsive">
                <table class="table table-hover table-log">
                    <tbody>
                    <?php  if(is_array($orderlog)) { foreach($orderlog as $logitem) { ?>
                    <tr>
                        <td>
                            <p><i class="fa fa-info-circle"></i> <strong><?php  echo date("Y-m-d H:i:s", $logitem['dateline'])?></strong></p>
                            <p style="padding-left:15px; ">
                                <?php  if($logitem['fromtype']==1) { ?>
                                [手机]
                                <?php  } else if($logitem['fromtype']==2) { ?>
                                [电脑]
                                <?php  } ?>
                                <?php  echo $logitem['content'];?>
                            </p>
                        </td>
                    </tr>
                    <?php  } } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php  } ?>
        <div class="modal fade" id="order-remark-container" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        <h4 class="modal-title">卖家备注</h4></div>
                    <div class="modal-body">
                        <textarea name="reply" class="form-control" rows="5" oninput="$(this).parent().next().find('.js-count').text(255 - $(this).val().length);;" onpropertychange="$(this).parent().next().find('.js-count').text(255 - $(this).val().length);;" maxlength="255" placeholder="最多填写 255 字"></textarea>
                    </div>
                    <div class="modal-footer" style="padding: 5px 15px;">
                        <span class="help-block pull-left">					您还可以输入：<storng>
                            <span style="color:red; font-size:18px;" name="count" class="js-count">255</span></storng> 个字符</span>
                        <a class="btn btn-default js-cancel" data-dismiss="modal">取消</a>
                        <button type="submit" class="btn btn-primary" name="confrimsign" value="正常">提交</button>
                        <!--<a class="btn btn-primary js-order-remark-post">确定</a>-->
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-12" style="margin-bottom: 15px;">
            <?php  if($item['ispay']==0) { ?>
            <button type="submit" class="btn btn-danger span2" onclick="return confirm('确认设置该订单为完成支付吗？');
                    return false;" name="confrimpay"  value="确认付款">确认付款</button>
            <?php  } ?>
            <?php  if($item['status'] == 0) { ?>
        	<button type="submit" class="btn btn-primary span2" name="confirm" value="确认订单">确认订单</button>
    
	<!--button type="submit" class="btn btn-primary span2" onclick="return confirm('确认设置该订单为已确认吗？');
                    return false;" name="confirm" value="确认订单">确认订单</button>-->
            <?php  } ?>
            <?php  if($item['status'] == 1) { ?>
           	 
        	<button type="button" class="btn btn-primary span2" name="printall" value="打印订单">打印订单</button>
		<?php  if($item['ispay'] == 0) { ?>
            <a class="btn btn-success span2" href="#"  onclick="alert('请先支付订单，再完成订单');
                    return false;" title="完成">完成订单</a><?php  } else { ?><a class="btn btn-success span2" href="<?php  echo $this->createWebUrl('order', array('op' => 'detail', 'id' => $item['id'], 'storeid' => $storeid, 'finish' => 'finish'))?>"  onclick="return confirm('确认设置该订单为完成支付吗？'); return false;" title="完成">完成订单</a>
            <?php  } ?>
            <?php  } ?>
            <?php  if($item['status'] != -1) { ?>
            <button type="submit" class="btn span2" name="cancel" onclick="return confirm('确认关闭此订单吗？'); return false;" value="关闭">关闭订单</button>
            <?php  } else { ?>
            <button type="submit" class="btn span2 btn-primary" name="open" onclick="return confirm('确认开启此订单吗？'); return false;" value="关闭">开启订单</button>
            <?php  } ?>
            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
        </div>
    </form>
</div>

<script type="text/javascript">
    function changeprice() {
        $('#order-operator-modal').modal();
    }
	
    $(function(){
	$("button[name='printall']").click(function(){
		var itemid= $("input[name='id']").val();
		var id = new Array();
		 id[0] = itemid;
		if(confirm('您确定要打印该订单吗？')){
		//调用前台打印
                	var url = "<?php  echo $this->createWebUrl('order', array('op' => 'printall', 'storeid' =>$_GPC['storeid'] , 'position_type' => 1))?>";
			$.post(
                        url,
                        {idArr: id},
               		 );
			//调用后厨打印
			
			var url2 = "<?php  echo $this->createWebUrl('order', array('op' => 'printall', 'storeid' => $_GPC['storeid'], 'position_type' => 2))?>";
			$.post(
				url2,
				{idArr: id},
			      );
			alert('操作成功');	
		}else{
			return false;
		}
	});
    });
</script>
<form class="form-horizontal form" action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php  echo $item['id'];?>">
    <div style="width:400px;position:absolute;top:40%;left:30%;z-index:9999;display:none;" class="table_display">
        <div class="panel panel-default">
            <div class="panel-heading">桌台</div>
            <div class="panel-body">
                <div class="col-md-8">
                    <select name="tableid" class="form-control">
                        <?php  if(is_array($tablelist)) { foreach($tablelist as $row) { ?>
                        <option value="<?php  echo $row['id'];?>"<?php  if($row['id'] == $order['tables']) { ?>
                        selected="selected"<?php  } ?>><?php  echo $row['title'];?></option>
                        <?php  } } ?>
                    </select>
                </div>
                <div class="col-md-2"><button type="submit" name="confirmtable" value="ok" class="btn btn-primary discount_submit" >提交</button></div>
                <div class="col-md-2"><a class="btn btn-danger table_close" href="javascript:void(0);">取消</a></div>
            </div>
        </div>
    </div>
    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
</form>
<form class="form-horizontal form" action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php  echo $item['id'];?>">
    <div style="width:400px;position:absolute;top:40%;left:30%;z-index:2;display:none;" class="counts_display">
        <div class="panel panel-default">
            <div class="panel-heading">人数</div>
            <div class="panel-body">
                <div class="col-md-8">
                    <select name="counts" class="form-control">
                        <?php  for($i = 1;$i<21;$i++){?>
                        <option value="<?php  echo $i;?>" <?php  if($order['counts']==$i) { ?>selected<?php  } ?>><?php  echo $i;?></option>
                        <?php  }?>
                    </select>
                </div>
                <div class="col-md-2"><button type="submit" name="confirmcounts" value="ok" class="btn btn-primary discount_submit" >提交</button></div>
                <div class="col-md-2"><a class="btn btn-danger counts_close" href="javascript:void(0);">取消</a></div>
            </div>
        </div>
    </div>
    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
</form>
<form class="form-horizontal form" action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php  echo $item['id'];?>">
    <div style="width:400px;position:absolute;top:50%;left:30%;z-index:2;display:none;" class="table_goods">
        <div class="panel panel-default">
            <div class="panel-heading">退菜数量</div>
            <div class="panel-body">
                <div class="col-md-8">
                    <input type="text" name="goodsnum" id="goodsnum" class="form-control" value="1" />
                </div>
                <div class="col-md-2"><a class="btn btn-primary discount_submit" name="confirmtable" value="ok" >提交</a></div>
                <div class="col-md-2"><a class="btn btn-danger table_close" href="javascript:void(0);">取消</a></div>
            </div>
        </div>
    </div>
    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
    <input type="hidden" id="goodsid" value="0" />
</form>
<script language="javascript">
    var display = $(".discount_display");
    $(".discount_close").click(function () {
        $(".discount_input").val("");
        display.css('display', 'none');
    });
    $(".discount_btn").click(function () {
        display.css("display", '');
        $(".discount_input").val("");
    });
    $(".discount_show_two_h").click(function () {
        $(".discount_show_two1").css('display', '');
        $(".discount_show_two2").css('display', '');
        $(".discount_show_two3").css('display', '');
    });

    var table = $(".table_display");
    $(".btn_table_show").click(function () {
        table.css("display", '');
        $(".table_input").val("");
        setDivCenter('.table_display');
    });
    $(".table_close").click(function () {
        table.css('display', 'none');
    });

    var counts = $(".counts_display");
    $(".btn_counts_show").click(function () {
        counts.css("display", '');
        $(".counts_input").val("");
        setDivCenter('.counts_display');
    });
    $(".counts_close").click(function () {
        counts.css('display', 'none');
    });
</script>
<script>
    var tgoods = $(".table_goods");
    $(".btn_goods_show").click(function () {
        var id = $(this).attr('data-value');
        tgoods.css("display", '');
        $(".table_input").val("");
        $("#goodsid").val(id);
        setDivCenter('.table_goods');
    });

    function setDivCenter(divName){
        var top = ($(window).height() - $(divName).height())/2 - 100;
        var left = ($(window).width() - $(divName).width())/2-200;
        var scrollTop = $(document).scrollTop();
        var scrollLeft = $(document).scrollLeft();
        $(divName).css( { position : 'absolute', 'top' : top + scrollTop, left : left + scrollLeft } ).show();
    }

    $(".table_close").click(function () {
        goods.css('display', 'none');
    });
    $(".discount_submit").click(function () {
        var goodsid = $("#goodsid").val();
        var goodsnum = $("#goodsnum").val();
        var deliveryid = $("#deliveryid").val();
        var delivery_status = $("#delivery_status").val();
        if (confirm("确认要提交吗?")) {
            var url =
                    "<?php  echo $this->createWebUrl('retreat', array('orderid' => $id,'storeid' => $_GPC['storeid']))?>" + '&goodsid=' + goodsid + '&goodsnum=' + goodsnum;
            window.location.href = url;
        }
    });
</script>
