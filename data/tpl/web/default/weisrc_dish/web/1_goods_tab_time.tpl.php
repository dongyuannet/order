<?php defined('IN_IA') or exit('Access Denied');?><div class="tab-pane" id="tab_time">
    <div class="panel panel-default">
            <div class="panel-heading">
                可售卖时间
            </div>
            <div class="panel-body">
                <div class=" alert alert-warning">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商品限星期购买</label>
                    <div class="col-sm-9">
                        <div style="border:1px #eee dashed; padding:10px;background:#F5F5F5;">
                            <label for="week1" class="checkbox-inline">
                                <input id="week1" type="checkbox" name="week[]" value="1" <?php  if(empty($item) || in_array(1, $weeks)) { ?>checked<?php  } ?>> 星期一
                            </label>
                            <label for="week2" class="checkbox-inline">
                                <input id="week2" type="checkbox" name="week[]" value="2" <?php  if(empty($item) || in_array(2, $weeks)) { ?>checked<?php  } ?>> 星期二
                            </label>
                            <label for="week3" class="checkbox-inline">
                                <input id="week3" type="checkbox" name="week[]" value="3" <?php  if(empty($item) || in_array(3, $weeks)) { ?>checked<?php  } ?>> 星期三
                            </label>
                            <label for="week4" class="checkbox-inline">
                                <input id="week4" type="checkbox" name="week[]" value="4" <?php  if(empty($item) || in_array(4, $weeks)) { ?>checked<?php  } ?>> 星期四
                            </label>
                            <label for="week5" class="checkbox-inline">
                                <input id="week5" type="checkbox" name="week[]" value="5" <?php  if(empty($item) || in_array(5, $weeks)) { ?>checked<?php  } ?>> 星期五
                            </label>
                            <label for="week6" class="checkbox-inline">
                                <input id="week6" type="checkbox" name="week[]" value="6" <?php  if(empty($item) || in_array(6, $weeks)) { ?>checked<?php  } ?>> 星期六
                            </label>
                            <label for="week7" class="checkbox-inline">
                                <input id="week7" type="checkbox" name="week[]" value="0" <?php  if(empty($item) || in_array(0, $weeks)) { ?>checked<?php  } ?>> 星期日
                            </label>
                        </div>
                    </div>
                </div>
            </div>
                <div class=" alert alert-warning">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">可售卖时间</label>
                        <div class="col-sm-9">
                            <div class="radio radio-info radio-inline">
                                <input type="radio" id="istime2" value="0" name="istime" <?php  if($item['istime']==0) { ?>checked<?php  } ?>>
                                <label for="istime2"> 不限制时间 </label>
                            </div>
                            <div class="radio radio-info radio-inline">
                                <input type="radio" id="istime1" value="1" name="istime" <?php  if($item['istime']==1) { ?>checked<?php  } ?>>
                                <label for="istime1"> 自定义时间 </label>
                            </div>
                            <div class="help-block"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">日期范围</label>
                        <div class="col-sm-9">
                            <?php  echo tpl_form_field_daterange('datelimit', array('starttime'=>$starttime,'endtime'=>$endtime), true)?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">时间范围</label>
                        <div class="col-sm-3">
                            <div class="input-group clockpicker">
                                <input type="text" class="form-control" value="<?php  echo $item['begintime'];?>" name="begintime">
                                <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group clockpicker">
                                <input type="text" class="form-control" value="<?php  echo $item['endtime'];?>" name="endtime">
                                <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
