<?php defined('IN_IA') or exit('Access Denied');?><div class="tab-pane" id="tab_commission">
    <div class="panel panel-default">
        <div class="panel-heading">
            分销设置 <a href="<?php  echo $this->createWebUrl('commission', array('op' => 'display'))?>">佣金管理</a>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否开启分销</label>
                <div class="col-sm-9">
                    <label for="is_commission1" class="radio-inline"><input type="radio" name="is_commission" value="1" id="is_commission1" <?php  if($setting['is_commission'] == 1) { ?>checked="true"<?php  } ?> /> 是</label>
                    &nbsp;&nbsp;&nbsp;
                    <label for="is_commission2" class="radio-inline"><input type="radio" name="is_commission" value="0" id="is_commission2"  <?php  if(empty($setting) || $setting['is_commission'] == 0) { ?>checked="true"<?php  } ?> /> 否</label>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">分销关键字</label>
                <div class="col-sm-9">
                    <input type="text" name="commission_keywords" value="<?php  echo $setting['commission_keywords'];?>" class="form-control"/>
                    <span class="help-block">认证服务号必填</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">分销模式</label>
                <div class="col-sm-9">
                    <label for="commission_mode1" class="radio-inline"><input type="radio" name="commission_mode" value="1" id="commission_mode1" <?php  if($setting['commission_mode'] == 1) { ?>checked="true"<?php  } ?> /> 所有用户</label>
                    &nbsp;&nbsp;&nbsp;
                    <label for="commission_mode2" class="radio-inline"><input type="radio" name="commission_mode" value="2" id="commission_mode2"  <?php  if(empty($setting) || $setting['commission_mode'] == 2) { ?>checked="true"<?php  } ?> /> 指定代理商</label>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">佣金模式</label>
                <div class="col-sm-9">
                    <label for="commission_money_mode1" class="radio-inline"><input type="radio" name="commission_money_mode" value="1" id="commission_money_mode1" <?php  if(empty($setting) || $setting['commission_money_mode'] == 1) { ?>checked="true"<?php  } ?> /> 以订单计算</label>
                    &nbsp;&nbsp;&nbsp;
                    <label for="commission_money_mode2" class="radio-inline"><input type="radio" name="commission_money_mode" value="2" id="commission_money_mode2"  <?php  if($setting['commission_money_mode'] == 2) { ?>checked="true"<?php  } ?> />
                        以商品佣金计算</label>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group cmode" <?php  if($setting['commission_money_mode'] == 2) { ?>style="display:none;"<?php  } ?>>
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">分销层级</label>
                <div class="col-sm-8 col-md-8 col-xs-12">
                    <select class="form-control" name="commission_level">
                        <option value="1" <?php  if($setting['commission_level']==1) { ?>selected<?php  } ?>>一级分销</option>
                        <option value="2" <?php  if($setting['commission_level']==2) { ?>selected<?php  } ?>>二级分销</option>
                    </select>
                </div>
            </div>
            <div class="form-group cmode" <?php  if($setting['commission_money_mode'] == 2) { ?>style="display:none;"<?php  } ?>>
                <label class="col-xs-12 col-sm-2 col-md-2 control-label">一级分销佣金</label>
                <div class="col-sm-6 col-md-8 col-xs-12">
                    <div class="input-group" style="margin-bottom: .5rem">
                        <span class="input-group-addon">最高</span>
                        <input type="number" step="0.01" class="form-control" value="<?php  echo $setting['commission1_rate_max'];?>" name="commission1_rate_max">
                        <span class="input-group-addon">%</span>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">最高</span>
                        <input type="number" step="0.01" class="form-control" value="<?php  echo $setting['commission1_value_max'];?>" name="commission1_value_max">
                        <span class="input-group-addon">元</span>
                    </div>
                </div>
            </div>
            <div class="form-group cmode" <?php  if($setting['commission_money_mode'] == 2) { ?>style="display:none;"<?php  } ?>>
                <label class="col-xs-12 col-sm-2 col-md-2 control-label">二级分销佣金</label>
                <div class="col-sm-6 col-md-8 col-xs-12">
                    <div class="input-group" style="margin-bottom: .5rem">
                        <span class="input-group-addon">最高</span>
                        <input type="number" step="0.01" class="form-control" value="<?php  echo $setting['commission2_rate_max'];?>" name="commission2_rate_max">
                        <span class="input-group-addon">%</span>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">最高</span>
                        <input type="number" step="0.01" class="form-control" value="<?php  echo $setting['commission2_value_max'];?>" name="commission2_value_max">
                        <span class="input-group-addon">元</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">佣金结算</label>
                <div class="col-sm-6 col-md-8 col-xs-12">
                    <div class="input-group">
                        <label class="radio-inline">
                            <input type="radio" name="commission_settlement" value="1" <?php  if($setting['commission_settlement']==1) { ?>checked="true"<?php  } ?> /> 自动
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="commission_settlement" value="0" <?php  if(empty($setting) || $setting['commission_settlement'] == 0) { ?>checked="true"<?php  } ?> /> 手动
                        </label>
                    </div>
                    <span class="help-block">自动结算佣金：当订单完成后，分销佣金自动进入相应用户的余额里面；</span>
                    <span class="help-block">手动结算佣金：进入佣金管理列表，选择佣金结算并提交，需人工参与操作佣金结算；</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否自动升为分销商</label>
                <div class="col-sm-9">
                    <label for="is_auto_commission1" class="radio-inline"><input type="radio" name="is_auto_commission" value="1" id="is_auto_commission1" <?php  if($setting['is_auto_commission'] == 1) { ?>checked="true"<?php  } ?> /> 是</label>
                    <label for="is_auto_commission2" class="radio-inline"><input type="radio" name="is_auto_commission" value="0" id="is_auto_commission2"  <?php  if(empty($setting) || $setting['is_auto_commission'] == 0) { ?>checked="true"<?php  } ?> /> 否</label>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group" >
                <label class="col-xs-12 col-sm-2 col-md-2 control-label">升级条件</label>
                <div class="col-sm-6 col-md-8 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon">余额达到多少</span>
                        <input type="text" class="form-control" value="<?php  echo $setting['auto_commission_coin'];?>" name="auto_commission_coin">
                        <span class="input-group-addon">元</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("input[name=commission_money_mode]").click(function () {
        var mode = $(this).val();
        if (mode == 1) {
            $('.cmode').show();
        } else {
            $('.cmode').hide();
        }
    });
</script>