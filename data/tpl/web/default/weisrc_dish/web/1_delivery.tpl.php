<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li <?php  if($operation == 'display' || empty($operation)) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('delivery', array('op' => 'display'))?>">配送员管理</a></li>
    <li <?php  if($operation == 'post') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('delivery', array('op' => 'post'))?>">添加配送员</a></li>
    <li <?php  if($operation == 'setting') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('delivery', array('op' => 'setting'))?>">配送详情设置</a></li>
    <li><a href="<?php  echo $this->createWebUrl('deliveryarea', array('op' => 'display'))?>">管理配送点</a></li>
    <li><a href="<?php  echo $this->createWebUrl('deliveryarea', array('op' => 'post'))?>">添加配送点</a></li>
    <?php  if($_W['role'] == 'manager' || $_W['isfounder']) { ?>
    <li <?php  if($operation == 'record') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('delivery', array('op' => 'record'))?>">配送佣金审核</a></li>
    <li><a href="<?php  echo $this->createWebUrl('cashlog', array('op' => 'display', 'logtype' => 2))?>">配送提现管理</a></li>
    <?php  } ?>
</ul>
<?php  if($operation == 'display') { ?>
<div class="main">
    <div class="panel panel-default">
        <div class="panel-heading">筛选</div>
        <div class="table-responsive panel-body">
            <form action="./index.php" method="get" class="navbar-form navbar-left" role="form">
                <input type="hidden" name="c" value="site" />
                <input type="hidden" name="a" value="entry" />
                <input type="hidden" name="m" value="weisrc_dish" />
                <input type="hidden" name="do" value="delivery" />
                <input type="hidden" name="op" value="display" />
                <input type="hidden" name="storeid" value="<?php  echo $storeid;?>" />
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="请输入姓名/手机号码搜索" name="keyword" style="width: 190px;"/>
                </div>
                <button class="btn btn-success"><i class="fa fa-search"></i> 搜索</button>
            </form>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="table-responsive panel-body">
        <form action="" method="post" class="form-horizontal form" >
            <input type="hidden" name="storeid" value="<?php  echo $storeid;?>" />
            <table class="table table-hover">
                <thead class="navbar-inner">
                <tr>
                    <th style="width:8%;">顺序</th>
                    <th style="width:15%;">(ID)姓名</th>
                    <th style="width:15%;">手机号码</th>
                    <th style="width:15%;">配送点</th>
                    <th style="width:20%;">可提现金额</th>
                    <th style="width:10%;">状态</th>
                    <th style="width:10%;text-align:right;">操作</th>
                </tr>
                </thead>
                <tbody id="level-list">
                <?php  if(is_array($list)) { foreach($list as $row) { ?>
                <tr>
                    <td><input type="text" class="form-control" name="displayorder[<?php  echo $row['id'];?>]" value="<?php  echo $row['displayorder'];?>"></td>
                    <td>
                        <?php  if(!empty($row['headimgurl'])) { ?>
                        <img src="<?php  echo tomedia($row['headimgurl']);?>" style="width:30px;height:30px;padding1px;border:1px solid #ccc"/>
                        <br/>
                        <?php  } ?>
                        (<?php  echo $row['id'];?>)<?php  if(!empty($row['username'])) { ?><?php  echo $row['username'];?><?php  } else { ?>------<?php  } ?>


                    </td>
                    <td><?php  if(!empty($row['mobile'])) { ?><?php  echo $row['mobile'];?><?php  } else { ?>------<?php  } ?></td>
                    <td><?php  echo $row['areaname'];?></td>
                    <td>
                        <span class="label label-success"><?php  echo $row['delivery_price'];?></span>
                    </td>
                    <td><?php  if($row['status']==2) { ?><span class="label label-success">启用</span><?php  } else { ?><span class="label label-danger">禁止</span><?php  } ?></td>
                    <td style="text-align:right;">
                        <a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('delivery', array('op' => 'post', 'id' => $row['id'], 'storeid' => $storeid))?>" title="编辑">改</a>
                        <a class="btn btn-default btn-sm" onclick="return confirm('确认删除吗？');return false;"
                           href="<?php  echo $this->createWebUrl('delivery', array('id' => $row['id'], 'op' => 'delete', 'storeid' => $storeid))?>" title="删除">删</a>
                    </td>
                </tr>
                <?php  } } ?>
                </tbody>
            </table>
        </form>
        <?php  echo $pager;?>
        </div>
    </div>
</div>
<?php  } else if($operation == 'post') { ?>
<link rel="stylesheet" href="<?php  echo $_W['siteroot'];?>addons/weisrc_dish/public/web/css/awesome-bootstrap-checkbox.css">
<div class="main">
    <script type="text/javascript">
        require(['jquery', 'util'], function($, u){
            $('#form1').submit(function(e) {
                if($.trim($(':text[name="username"]').val()) == '') {
                    u.message('没有输入用户名.', '', 'error');
                    return false;
                }
                if($('#storeid option:selected').val() == 0) {
                    u.message('请选择所属门店.', '', 'error');
                    return false;
                }
            });
        });
    </script>
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
        <div class="alert alert-info">
            <h4>说明: 可添加多个员工, 员工可在手机端管理门店</h4>
        </div>
        <input type="hidden" name="storeid" value="<?php  echo $storeid;?>" />
        <div class="panel panel-default">
            <div class="panel-heading">
                添加配送员
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label"><span class="require">*</span>真实姓名</label>
                    <div class="col-sm-10 col-lg-9">
                        <input type="text" name="username" class="form-control" value="<?php  echo $account['username'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label"><span class="require">*</span>手机号码</label>
                    <div class="col-sm-10 col-lg-9">
                        <input type="text" name="mobile" class="form-control" value="<?php  echo $account['mobile'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">所属配送点</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="area" id="area">
                            <option value="0">请选择</option>
                            <?php  if(is_array($area)) { foreach($area as $item) { ?>
                            <option value="<?php  echo $item['id'];?>" <?php  if($account['areaid']==$item['id']) { ?>selected<?php  } ?>><?php  echo $item['title'];?></option>
                            <?php  } } ?>
                        </select>
                        <div class="help-block">
                            还没有配送点，点我 <a href="<?php  echo $this->createWebUrl('deliveryarea', array('op' => 'post'))?>"><i class="fa fa-plus-circle"></i> 添加配送点</a>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">*</span>微信昵称</label>
                    <div class="col-sm-9 col-xs-12">
                        <div class="input-group">
                            <input type="text" name="nickname" value="<?php  echo $fans['nickname'];?>" class="form-control" readonly="">
                            <input type="hidden" name="from_user" value="<?php  echo $account['from_user'];?>">
                        <span class="input-group-btn">
				            <button class="btn btn-default" type="button" onclick="$('#modal-module-menus').modal();" data-original-title="" title="">选择粉丝</button>
			            </span>
                        </div>
                        <div class="input-group cover" style="margin-top:.5em;">
                            <img src="<?php  echo tomedia($fans['headimgurl']);?>" width="150" />
                        </div>
                        <div class="help-block">手机端管理订单，接收订单通知。</div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">坐标</label>
                    <div class="col-sm-9">
                        <?php  echo tpl_form_field_coordinate('baidumap', $account)?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
                    <div class="col-sm-9">
                        <div class="radio radio-info radio-inline">
                            <input type="radio" id="status1" name="status" value="2" <?php  if($account['status']==2||empty($account)) { ?>checked<?php  } ?>>
                            <label for="status1">启用</label>
                        </div>
                        <div class="radio radio-info radio-inline">
                            <input type="radio" id="status2" name="status" value="1" <?php  if($account['status']==1) { ?>checked<?php  } ?>>
                            <label for="status2">关闭</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">备注</label>
                    <div class="col-sm-10 col-lg-9">
                        <textarea name="remark" style="height:80px;" class="form-control"><?php  echo $account['remark'];?></textarea>
                        <span class="help-block">方便注明此用户的身份</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <input type="submit" name="submit" value="保存设置" class="btn btn-primary col-lg-3" />
            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
        </div>
    </form>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_modal_fans', TEMPLATE_INCLUDEPATH)) : (include template('web/_modal_fans', TEMPLATE_INCLUDEPATH));?>
<?php  } else if($operation == 'setting') { ?>
<link rel="stylesheet" href="<?php  echo $_W['siteroot'];?>addons/weisrc_dish/public/web/css/awesome-bootstrap-checkbox.css">
<div class="main">
    <script type="text/javascript">
        require(['jquery', 'util'], function($, u){
            $('#form1').submit(function(e) {
                if($.trim($(':number[name="delivery_money"]').val()) == '') {
                    u.message('没有输入每单佣金.', '', 'error');
                    return false;
                }
            });
        });
    </script>
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
        <div class="alert alert-info">
            <h4>提示： 不设置提现费率，默认费率是零；例：费率设置10%，配送员提现10元，配送员实际收入9元，平台自己收入1元。</h4>
        </div>
        <input type="hidden" name="storeid" value="<?php  echo $storeid;?>" />
        <div class="panel panel-default">
            <div class="panel-heading">
                配送详情设置
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">配送佣金模式</label>
                    <div class="col-sm-9">
                        <div class="radio radio-info radio-inline">
                            <input type="radio" id="delivery_commission_mode1" name="delivery_commission_mode" value="1" <?php  if($setting['delivery_commission_mode']==1||empty($setting)) { ?>checked<?php  } ?>>
                            <label for="delivery_commission_mode1">以每单计算</label>
                        </div>
                        <div class="radio radio-info radio-inline">
                            <input type="radio" id="delivery_commission_mode2" name="delivery_commission_mode" value="2" <?php  if($setting['delivery_commission_mode']==2) { ?>checked<?php  } ?>>
                            <label for="delivery_commission_mode2">以每件商品佣金计算</label>
                        </div>
                        <div class="radio radio-info radio-inline">
                            <input type="radio" id="delivery_commission_mode3" name="delivery_commission_mode" value="3" <?php  if($setting['delivery_commission_mode']==3) { ?>checked<?php  } ?>>
                            <label for="delivery_commission_mode3">以订单的配送费为佣金</label>
                        </div>
                    </div>
                </div>
                <div class="form-group" id="delivery_money" <?php  if($setting['delivery_commission_mode']!=1) { ?>style="display:none;"<?php  } ?>>
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label"><span class="require">*</span>每单佣金
                    </label>
                    <div class="col-sm-10 col-lg-9">
                        <div class="input-group ">
                            <input type="number" step="0.01" class="form-control"
                                   value="<?php  echo $setting['delivery_money'];?>" name="delivery_money">
                            <span class="input-group-addon">元</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">提现费率设置</label>
                    <div class="col-sm-10 col-lg-9">
                        <div class="input-group ">
                            <input type="number" step="0.01" class="form-control" value="<?php  echo $setting['delivery_rate'];?>" name="delivery_rate">
                            <span class="input-group-addon">%</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">最低提现费用</label>
                    <div class="col-sm-10 col-lg-9">
                        <div class="input-group">
                            <input type="text" name="delivery_cash_price" class="form-control"  value="<?php  echo $setting['delivery_cash_price'];?>">
                            <span class="input-group-addon">元</span>
                        </div>
                        <div class="help-block">最低提现金额不能小于1元，建议填写整数，不填写为不限制</div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">配送员同时接收订单量</label>
                    <div class="col-sm-10 col-lg-9">
                        <div class="input-group ">
                            <input type="number" step="1" class="form-control" value="<?php  echo $setting['delivery_order_max'];?>" name="delivery_order_max">
                            <span class="input-group-addon">单</span>
                        </div>
                        <div class="help-block">为0表示不限制</div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">定时推送下单时间大于多少秒的单子</label>
                    <div class="col-sm-10 col-lg-9">
                        <div class="input-group ">
                            <input type="number" step="1" class="form-control" value="<?php  echo $setting['delivery_auto_time'];?>" name="delivery_auto_time">
                            <span class="input-group-addon">秒</span>
                        </div>
                        <div class="help-block">为0表示不自动推送，定时推送需要打开总订单管理页</div>
                    </div>
                </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">自动完成已配送后多少秒的订单</label>
                <div class="col-sm-10 col-lg-9">
                    <div class="input-group ">
                        <input type="number" step="1" class="form-control" value="<?php  echo $setting['delivery_finish_time'];?>"
                               name="delivery_finish_time">
                        <span class="input-group-addon">秒</span>
                    </div>
                    <div class="help-block">为0表示不自动推送，定时完成需要打开总订单管理页</div>
                </div>
            </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">下单配送通知</label>
                    <div class="col-sm-9">
                        <div class="radio radio-info radio-inline">
                            <input type="radio" id="delivery_mode2" name="delivery_mode" value="1" <?php  if($setting['delivery_mode']==1||empty($setting)) { ?>checked<?php  } ?>>
                            <label for="delivery_mode2">不通知</label>
                        </div>
                        <div class="radio radio-info radio-inline">
                            <input type="radio" id="delivery_mode1" name="delivery_mode" value="2" <?php  if($setting['delivery_mode']==2) { ?>checked<?php  } ?>>
                            <label for="delivery_mode1">所有配送员</label>
                        </div>
                        <div class="radio radio-info radio-inline">
                            <input type="radio" id="delivery_mode3" name="delivery_mode" value="3" <?php  if($setting['delivery_mode']==3) { ?>checked<?php  } ?>>
                            <label for="delivery_mode3">最近配送点</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <input type="submit" name="submit" value="保存设置" class="btn btn-primary col-lg-3" />
            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
        </div>
    </form>
</div>
<script>
    $("input[name=delivery_commission_mode]").click(function () {
        var mode = $(this).val();
        if (mode == 1) {
            $('#delivery_money').show();
        } else {
            $('#delivery_money').hide();
        }
    });
</script>
<?php  } else if($operation == 'record') { ?>
<div class="main">
    <div class="alert alert-info">
        <h4>
            <i class="fa fa-info-circle"></i>
            说明:佣金提现申请审核后会自动打款到配送员的配送佣金里面!
        </h4>
        <p style="color: red">&nbsp;&nbsp;&nbsp;&nbsp;结算数据涉及钱款操作，请认真审核，谨慎操作！</p>
    </div>
    <form action="" method="post" class="form-horizontal form">
        <div class="panel panel-default">
            <div class="table-responsive panel-body">
                <table class="table table-hover">
                    <thead class="navbar-inner">
                    <tr>
                        <th style="width:15%;">(ID)申请时间</th>
                        <th style="width:15%;">订单编号</th>
                        <th style="width:10%;">配送佣金</th>
                        <th style="width:10%;">配送员</th>
                        <th style="width:10%;">支付方式</th>
                        <th style="width:10%;">状态</th>
                        <th style="width:10%;">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php  if(is_array($list)) { foreach($list as $item) { ?>
                    <tr>
                        <td>
                            (<?php  echo $item['id'];?>)<?php  echo date("Y-m-d H:i:s", $item['dateline'])?>
                            <?php  if($item['type']== 1 && $item['status'] == 1) { ?>
                            <br/>
                            <span class="label label-success">商户单号:<?php  echo $item['trade_no'];?></span>
                            <br/>
                            <span class="label label-success">微信单号:<?php  echo $item['payment_no'];?></span>
                            <?php  } ?>
                        </td>
                        <td>
                            <a href="<?php  echo $this->createWebUrl('allorder', array('op' => 'detail', 'id' => $item['orderid']))?>">
                                <?php  echo $item['order']['ordersn'];?>
                            </a>
                        </td>
                        <td>
                            <?php  echo $item['price'];?>元
                        </td>
                        <td>
                            <img src="<?php  echo tomedia($item['headimgurl']);?>" style="width:30px;height:30px;padding1px;border:1px solid #ccc"/>
                            </br>昵称:<?php  echo $item['nickname'];?>
                            </br>姓名:<?php  echo $item['deliveryuser'];?>
                        </td>
                        <td>
                            <?php  if($item['order']['paytype']) { ?>
                            <?php  if($item['order']['paytype'] == 1) { ?>
                            <span class="label label-success"><i class="fa fa-money">&nbsp;余额支付</i></span>
                            <?php  } ?>
                            <?php  if($item['order']['paytype'] == 2) { ?>
                            <span class="label label-success"><i class="fa fa-check-circle">&nbsp;微信支付</i></span>
                            <?php  } ?>
                            <?php  if($item['order']['paytype'] == 3) { ?>
                            <span class="label label-success"><i class="fa fa-money">&nbsp;现金支付</i></span>
                            <?php  } ?>
                            <?php  if($item['order']['paytype'] == 4) { ?>
                            <span class="label label-info"><i class="fa fa-alipay">&nbsp;支付宝</i></span>
                            <?php  } ?>
                            <br/>
                            <?php  } ?>
                            <?php  if($item['order']['ispay'] == 0) { ?><span class="label label-warning">未支付</span><?php  } ?>
                            <?php  if($item['order']['ispay'] == 1) { ?><span class="label label-success"><i class="fa fa-cloud">已支付</i></span><?php  } ?>
                            <?php  if($item['order']['ispay'] == 2) { ?><span class="label label-info">待退款</span><?php  } ?>
                            <?php  if($item['order']['ispay'] == 3) { ?><span class="label label-danger">已退款</span><?php  } ?>
                            <?php  if($item['order']['ispay'] == 4) { ?><span class="label label-danger">退款失败</span><?php  } ?>
                        </td>
                        <td>
                            <?php  if($item['status'] == 1) { ?>
                            <span class="label label-success">已提现</span>
                            <?php  } else { ?>
                            <span class="label label-danger">未审核</span>
                            <?php  } ?>
                        </td>
                        <td>
                            <?php  if($item['status'] == 0) { ?>
                            <a class="btn btn-success btn-sm"
                               href="<?php  echo $this->createWebUrl('delivery', array('id' => $item['id'], 'op' => 'setstatus'))?>" title="审核" onclick="return confirm('确认操作吗？');return false;"><i
                                    class="fa fa-cog"></i> 审核</a>
                            <?php  } ?>
                        </td>
                    </tr>
                    <?php  } } ?>
                    </tbody>
                </table>
                <?php  echo $pager;?>
            </div>
        </div>
    </form>
</div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/footer', TEMPLATE_INCLUDEPATH)) : (include template('public/footer', TEMPLATE_INCLUDEPATH));?>