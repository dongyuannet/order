<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>

<?php  if($operation == 'display') { ?>
<div class="main">
    <div class="panel panel-info">
        <div class="panel-heading"><a class="btn btn-primary" href="javascript:location.reload()"><i class="fa fa-refresh"></i> 刷新</a>
            <a class="btn btn-danger" href="<?php  echo $this->createWebUrl('PrintOrder', array('op' => 'deleteprintorder', 'storeid' => $storeid))?>" onclick="return confirm('此操作不可恢复，确认操作吗？');return false;">取消未打印订单</a></div>
        <div class="panel-body">
            <form action="" method="get" class="form-horizontal" role="form">
                <input type="hidden" name="c" value="site" />
                <input type="hidden" name="a" value="entry" />
                <input type="hidden" name="m" value="weisrc_dish" />
                <input type="hidden" name="do" value="printorder" />
                <input type="hidden" name="op" value="display" />
                <input type="hidden" name="storeid" value="<?php  echo $storeid;?>" />
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">订单号</label>
                    <div class="col-sm-2 col-lg-2">
                        <input class="form-control" name="ordersn" id="" type="text" value="<?php  echo $_GPC['ordersn'];?>">
                    </div>
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="width: 120px;">打印机终端号</label>
                    <div class="col-sm-3 col-lg-3">
                        <input class="form-control" name="selusr" id="" type="text" value="<?php  echo $_GPC['selusr'];?>">
                    </div>
                    <div class="col-sm-3 col-lg-2"><button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button></div>
                </div>
            </form>
        </div>
    </div>
    <input type="hidden" name="storeid" value="<?php  echo $storeid;?>" />
    <form action="" method="post" class="form-horizontal form">
        <div class="panel panel-default">
            <div class="table-responsive panel-body">
                <table class="table table-hover">
                    <thead class="navbar-inner">
                    <tr>
                        <th style="width:10%;">ID</th>
                        <th style="width:25%;">订单编号</th>
                        <th style="width:25%;">打印机终端编号</th>
                        <th style="width:20%;">创建时间</th>
                        <th style="width:10%;">状态</th>
                        <th style="width:10%; text-align:right;">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php  if(is_array($list)) { foreach($list as $item) { ?>
                    <tr>
                        <td><?php  echo $item['id'];?></td>
                        <td>
                            <a href="<?php  echo $this->createWebUrl('order', array('op' => 'detail', 'id' => $item['orderid'], 'storeid' => $storeid))?>" title="查看订单"><?php  echo $item['ordersn'];?></a>
                        </td>
                        <td><?php  echo $item['print_usr'];?></td>
                        <td>
                            <?php  echo date('Y-m-d H:i', $item['dateline'])?>
                        </td>
                        <td>
                            <!--0为打印成功, 1为过热,3为缺纸卡纸等-->
                            <?php  if($item['print_status'] == 0) { ?>
                            <span class="label label-success">已打印</span>
                            <?php  } else if($item['print_status'] == -1) { ?>
                            <span class="label label-danger">未打印</span>
                            <?php  } else if($item['print_status'] == 1) { ?>
                            <span class="label label-warning">过热</span>
                            <?php  } else if($item['print_status'] == 3) { ?>
                            <span class="label label-warning">缺纸</span>
                            <?php  } else { ?>
                            <span class="label label-danger">未知状态<?php  echo $item['print_status'];?></span>
                            <?php  } ?>
                        </td>
                        <td style="text-align:right;">
                            <a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('printorder', array('op' => 'delete', 'id' => $item['id'], 'storeid' => $storeid))?>" title="删除" onclick="return confirm('此操作不可恢复，确认删除？');return false;">删</a>
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
