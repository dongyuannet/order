<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<?php  if($operation == 'display') { ?>
<div class="main">
    <style>
        .form-control-excel {
            height: 34px;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
            -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        }
        .header {
            line-height: 28px;
            margin-bottom: 16px;
            margin-top: 18px;
            padding-bottom: 4px;
            border-bottom: 1px solid #CCC
        }
        .block-gray{
            background-color: #555555;
            color: white;
        }
        .block-red{
            background-color: #ef4437;
            color: white;
        }
        .block-primary{
            background-color: #428bca;
            color: white;
        }
        .block-success{
            background-color: #5cb85c;
            color: white;
        }
        .block-orange{
            background-color: orange;
            color: white;
        }
        #guest-queue-index-body .queue_setting, #queue-setting-index-body .queue_setting {
            display: block;
            float: left;
            height: 100px;
            width: 31.3%;
            margin-right: 2%;
            margin-bottom: 20px;
            text-align: center
        }
        #queue-setting-index-body .queue_setting {
            width: 150px;
            height: 150px;
            border-radius: 1000px;
            margin-right: 20px
        }
        #guest-queue-index-body .queue_setting .name, #queue-setting-index-body .queue_setting .name{
            display: table-cell;
            font-size: 20px;
            font-weight: bold;
            line-height: 30px;
            vertical-align: middle;
            height: 60px
        }
        #queue-setting-index-body .queue_setting .name {
            height: 90px;
        }
        .table-display{
            display: table;
            width: 100%;
        }
        .table-state-tables{
            padding: 10px;
        }
        .table-state-tables .state-table{
            margin: 0 20px 20px 0;
            font-size: 20px;
            line-height: 30px;
            width: 140px;
            float: left
        }
        .table-state-tables .state-table .round{
            display: table;
            margin: 20px;
            width: 100px;
            height: 100px;
            border-radius: 1000px;
        }
        .table-state-tables .state-table .round.idle{
            background-color: #555555;
            color: white
        }
        .table-state-tables .state-table .state{
            height: 100px;
            width: 100%;
            display: table-cell;
            text-align: center;
            vertical-align: middle
        }
        .table-state-tables .state-table .name{
            background-color: #eeeeee;
            color: #555555;
            font-size: 16px;
            line-height: 40px;
            text-align: center
        }
        .table-state-tables .state-table .round.opened{
            background-color: #ef4437;
            color: white;
        }
        .table-state-tables .state-table .round.ordered{
            background-color: #428bca;
            color: white
        }
        .table-state-tables .state-table .round.paid{
            background-color: #5cb85c;
            color: white
        }

        .qr-code-table .qr-code-item {
            float: left;
            width: 200px;
            margin: 0px 20px 20px 0;
            text-align: center;
            color: #555555
        }
        .qr-code-table .qr-code-op{
            height: 24px;
            line-height: 24px;
            font-size: 16px;
            text-align: left;
            visibility: visible
        }

        /*.qr-code-table .qr-code-item a{*/
        /*color: #555555;*/
        /*text-decoration: none*/
        /*}*/
        .qr-code-table .qr-code-item a{
            color: #555555;
            text-decoration: none;
        }
        .qr-code-table .qr-code-op .fa-edit{
            color: #5cb85c
        }
        .qr-code-table .qr-code-op .fa-trash-o{
            color: #d9534f
        }
        .qr-code-table .qr-code-box{
            border: 1px solid #dbdbdb
        }
        .qr-code-table .qr-code-item-info{
            background-color: #eeeeee;
            border-top: 1px solid #dbdbdb;
            height: 24px
        }

    </style>
    <ul class="nav nav-tabs" role="tablist">
        <li class="active">
            <a href="<?php  echo $this->createWebUrl('tablezones', array('op' => 'display', 'storeid' => $storeid))?>">餐桌类型</a>
        </li>
        <li>
            <a href="<?php  echo $this->createWebUrl('tables', array('op' => 'display', 'storeid' => $storeid))?>">餐桌管理</a>
    </ul>
    <div class="panel panel-default">

        <div class="panel-body">

            <div class="header">
                <h3>桌台类型 列表</h3>
            </div>
            <div class="form-group">
                <a class="btn btn-primary btn-sm" href="<?php  echo $this->createWebUrl('tablezones', array('op' => 'post', 'storeid' => $storeid))?>">新建 桌台类型</a>
            </div>
            <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
                <table class="table table-hover">
                    <thead class="navbar-inner">
                    <tr>
                        <th style="width:8%;">顺序</th>
                        <th style="width:12%;">名字</th>
                        <th style="width:12%;">服务费</th>
                        <th style="width:12%;">最低消费</th>
                        <th style="width:12%;">预订预付款</th>
                        <th style="width:14%;">桌子数量</th>
                        <th style="width:14%;">所属门店</th>
                        <th style="width:14%;text-align: center;">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php  if(is_array($list)) { foreach($list as $item) { ?>
                    <tr>
                        <td><input type="text" class="form-control" name="displayorder[<?php  echo $item['id'];?>]" value="<?php  echo $item['displayorder'];?>"></td>
                        <td>
                            <?php  echo $item['title'];?>
                        </td>
                        <td>
                            <?php  if($item['service_rate']>0) { ?>
                            <?php  echo $item['service_rate'];?>%
                            <?php  } else { ?>
                            无
                            <?php  } ?>
                        </td>
                        <td>
                            <?php  echo $item['limit_price'];?>
                        </td>
                        <td>
                            <?php  echo $item['reservation_price'];?>
                        </td>
                        <td>
                            <?php  if(empty($table_count[$item['id']]['count'])) { ?>0<?php  } else { ?><?php  echo $table_count[$item['id']]['count'];?><?php  } ?>
                        </td>
                        <td>
                            <?php  echo $stores[$item['storeid']]['title'];?>
                        </td>
                        <td style="max-width:70px;text-align: center;">
                            <a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('tablezones', array('id' => $item['id'], 'storeid' => $storeid, 'op' => 'post'))?>" title="编辑">改</a>
                            <a class="btn btn-danger btn-sm" href="<?php  echo $this->createWebUrl('tablezones', array('id' => $item['id'], 'storeid' => $storeid, 'op' => 'delete'))?>" onclick="return confirm('确认操作吗？');return false;" title="删除">删</a>
                            <a class="btn btn-success btn-sm" href="<?php  echo $this->createWebUrl('tables', array('tablezonesid' => $item['id'], 'storeid' => $storeid, 'op' => 'post'))?>" title="编辑">新建 桌台</a>
                        </td>
                    </tr>
                    <?php  } } ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="8">
                            <input name="submit" type="submit" class="btn btn-primary" value="批量排序">
                            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </form>
        </div>
    </div>
</div>
<?php  } else if($operation == 'post') { ?>
<div class="main">
    <div class="panel panel-default">
        <div class="panel-body">
            <a class="btn btn-warning" href="<?php  echo $this->createWebUrl('tablezones', array('op' => 'display', 'storeid' => $storeid))?>">返回餐桌类型管理
            </a>
        </div>
    </div>
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
        <input type="hidden" name="storeid" value="<?php  echo $storeid;?>" />
        <input type="hidden" name="id" value="<?php  echo $item['id'];?>" />
        <div class="panel panel-default">
            <div class="panel-heading">
                桌台类型 详情
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">名字</label>
                    <div class="col-sm-9">
                        <input type="text" name="title" class="form-control" value="<?php  echo $item['title'];?>"  placeholder="例如：大厅，包厢"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">服务费比例</label>
                    <div class="col-sm-9">
                        <input type="number" name="service_rate" class="form-control" value="<?php  echo $item['service_rate'];?>" placeholder=""/>
                        <span class="help-block">
                            下单时需要支付的百分比 %，随订单的总金额自动调整
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">最低消费</label>
                    <div class="col-sm-9">
                        <input name="limit_price" class="form-control" placeholder="" step="any" type="number" value="<?php  if(empty($item)) { ?>0.0<?php  } else { ?><?php  echo $item['limit_price'];?><?php  } ?>"/>
                        <span class="help-block">
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">预订预付款</label>
                    <div class="col-sm-9">
                        <input type="number" name="reservation_price" class="form-control" value="<?php  if(empty($item)) { ?>0.0<?php  } else { ?><?php  echo $item['reservation_price'];?><?php  } ?>" placeholder=""/>
                        <span class="help-block" style="color:#f00;">
                            仅预订订座时需要预付款的金额
                        </span>
                    </div>
                </div>
                <!--<div class="form-group">-->
                    <!--<label class="col-xs-12 col-sm-3 col-md-2 control-label">可预订桌台数量</label>-->
                    <!--<div class="col-sm-9">-->
                        <!--<input type="number" step="1" name="table_count" class="form-control" value="<?php  echo $item['table_count'];?>"  placeholder=""/>-->
                    <!--</div>-->
                <!--</div>-->
            </div>
        </div>
        <div class="form-group col-sm-12">
            <input type="submit" name="submit" value="保存设置" class="btn btn-primary col-lg-3" />
            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
        </div>
    </form>
</div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/footer', TEMPLATE_INCLUDEPATH)) : (include template('public/footer', TEMPLATE_INCLUDEPATH));?>