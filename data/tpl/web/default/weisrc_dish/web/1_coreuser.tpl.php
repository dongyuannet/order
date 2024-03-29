<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li <?php  if($operation == 'display' || empty($operation)) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('coreuser', array('op' => 'display', 'storeid' => $storeid))?>">员工管理</a></li>
    <li <?php  if($operation == 'post') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('coreuser', array('op' => 'post', 'storeid' => $storeid))?>">添加员工</a></li>
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
                <input type="hidden" name="do" value="coreuser" />
                <input type="hidden" name="op" value="display" />
                <input type="hidden" name="storeid" value="<?php  echo $storeid;?>" />
                <div class="form-group">
                    <select class="form-control" id="role" name="role" autocomplete="off">
                        <option value="">全部</option>
                        <option value="2">服务员</option>
                        <option value="3">收银员</option>
                        <option value="4">配送员</option>
                        <option value="5">老板</option>
                    </select>
                </div>
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
                    <th style="width:30%;">(ID)员工名称</th>
                    <th style="width:20%;">员工岗位</th>
                    <th style="width:20%;">手机号码</th>

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
                    <td>
                        <?php  if($row['role']==2) { ?>
                        <?php  $row_role = '服务员';?>
                        <?php  $row_label = 'label-info';?>
                        <?php  } else if($row['role']==3) { ?>
                        <?php  $row_role = '收银员';?>
                        <?php  $row_label = 'label-danger';?>
                        <?php  } else if($row['role']==4) { ?>
                        <?php  $row_role = '配送员';?>
                        <?php  $row_label = 'label-warning';?>
                        <?php  } else if($row['role']==5) { ?>
                        <?php  $row_role = '老板';?>
                        <?php  $row_label = 'label-success';?>
                        <?php  } ?>
                        <span class="label <?php  echo $row_label;?>">
                            <?php  echo $row_role;?>
                        </span>
                    </td>
                    <td><?php  if(!empty($row['mobile'])) { ?><?php  echo $row['mobile'];?><?php  } else { ?>------<?php  } ?></td>
                    <td><?php  if($row['status']==2) { ?><span class="label label-success">启用</span><?php  } else { ?><span class="label label-danger">禁止</span><?php  } ?></td>
                    <td style="text-align:right;">
                        <a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('coreuser', array('op' => 'post', 'id' => $row['id'], 'storeid' => $storeid))?>" title="编辑">改</a>
                        <a class="btn btn-default btn-sm" onclick="return confirm('确认删除吗？');return false;"
                           href="<?php  echo $this->createWebUrl('coreuser', array('id' => $row['id'], 'op' => 'delete', 'storeid' => $storeid))?>" title="删除">删</a>
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
                添加新员工
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
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">员工岗位</label>
                    <div class="col-sm-10 col-lg-9">
                        <div class="radio radio-info radio-inline">
                            <input type="radio" id="inlineRadio1" value="2" name="role" <?php  if($account['role']==2) { ?>checked<?php  } ?>>
                            <label for="inlineRadio1"> 服务员 </label>
                        </div>
                        <div class="radio radio-info radio-inline">
                            <input type="radio" id="inlineRadio2" value="3" name="role" <?php  if($account['role']==3) { ?>checked<?php  } ?>>
                            <label for="inlineRadio2"> 收银员 </label>
                        </div>
                        <div class="radio radio-info radio-inline">
                            <input type="radio" id="inlineRadio3" value="4" name="role" <?php  if($account['role']==4) { ?>checked<?php  } ?>>
                            <label for="inlineRadio3"> 配送员 </label>
                        </div>
                        <div class="radio radio-info radio-inline">
                            <input type="radio" id="inlineRadio4" value="5" name="role" <?php  if($account['role']==5) { ?>checked<?php  } ?>>
                            <label for="inlineRadio4"> 老板 </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">操作权限</label>
                    <div class="col-sm-10 col-lg-9">
                        <div class="checkbox checkbox-success checkbox-inline">
                            <input type="checkbox" id="inlineCheckbox2" value="1" <?php  if($account['is_admin_order']==1) { ?>checked<?php  } ?> name="is_admin_order">
                            <label for="inlineCheckbox2" style="padding-left: 0px;">订单管理</label>
                        </div>
                        <div class="checkbox checkbox-success checkbox-inline">
                            <input type="checkbox" id="inlineCheckbox1" value="1" <?php  if($account['is_notice_order']==1) { ?>checked<?php  } ?> name="is_notice_order">
                            <label for="inlineCheckbox1" style="padding-left: 0px;">接收订单通知</label>
                        </div>
                        <div class="checkbox checkbox-success checkbox-inline">
                            <input type="checkbox" id="inlineCheckbox3" value="1" <?php  if($account['is_notice_service']==1) { ?>checked<?php  } ?> name="is_notice_service">
                            <label for="inlineCheckbox3" style="padding-left: 0px;">服务员通知</label>
                        </div>
                        <div class="checkbox checkbox-success checkbox-inline">
                            <input type="checkbox" id="inlineCheckbox5" value="1" <?php  if($account['is_notice_queue']==1) { ?>checked<?php  } ?> name="is_notice_queue">
                            <label for="inlineCheckbox5" style="padding-left: 0px;">排队通知</label>
                        </div>
                        <div class="checkbox checkbox-success checkbox-inline">
                            <input type="checkbox" id="inlineCheckbox4" value="1" <?php  if($account['is_notice_boss']==1) { ?>checked<?php  } ?> name="is_notice_boss">
                            <label for="inlineCheckbox4" style="padding-left: 0px;">每日统计通知</label>
                        </div>
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
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/footer', TEMPLATE_INCLUDEPATH)) : (include template('public/footer', TEMPLATE_INCLUDEPATH));?>