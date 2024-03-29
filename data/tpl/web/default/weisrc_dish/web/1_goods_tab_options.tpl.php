<?php defined('IN_IA') or exit('Access Denied');?><script type="text/html" id="distance-form-html">
    <?php  include $this->template('web/_goods_options_item');?>
</script>

<div class="tab-pane" id="tab_options">
    <div class="lastest-notification alert alert-info">
        <div class="notification-label">
            温馨提示:<br/>
            使用商品属性功能需要先在商品基本信息中开启商品属性，开启商品属性后顾客下单将按照你设置的商品属性进行选择，商品的最终价格是基本信息中商品的基础价格与选择的各属性价格总和，如果不希望某个属性值带上价格，可以将它的属性价格设为0，商品属性可灵活运用于各场景，比如套餐、大杯小杯、冷饮热饮、辣或不辣等等。
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            规格设置
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">启用商品规格</label>
                <div class="col-sm-9">
                    <div class="radio radio-info radio-inline">
                        <input type="radio" id="isoptions1" value="1" name="isoptions" <?php  if($item['isoptions']==1) { ?>checked<?php  } ?>>
                        <label for="isoptions1"> 开启 </label>
                    </div>
                    <div class="radio radio-info radio-inline">
                        <input type="radio" id="isoptions2" value="0" name="isoptions" <?php  if($item['isoptions']==0) { ?>checked<?php  } ?>>
                        <label for="isoptions2"> 关闭 </label>
                    </div>
                    <div class="radio radio-info radio-inline">
                        请设置添加 <a id="add-distance" style="color: #428bca;"><i class="fa fa-plus-circle"></i>
                        添加规格</a>
                    </div>
                    <div class="help-block">
                        <font color="#f00">（注意：开启此功能，需要设置下方商品属性内容，否则将影响下单。）</font>
                        <br/>
                        （商品最终价格=商品设置的价格+属性加价）
                    </div>
                </div>
            </div>
            <div id="distance-list">
                <!--<div class="form-group">-->
                    <!--<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>-->
                    <!--<div class="col-sm-3">-->
                        <!--<div class="input-group">-->
                            <!--<span class="input-group-addon">属性名：</span>-->
                            <!--<input type="text" class="form-control" value="<?php  echo $row['begindistance'];?>" name="begindistance[]">-->
                        <!--</div>-->
                    <!--</div>-->
                    <!--<div class="col-sm-1">-->
                        <!--<a class="btn btn-success btn-sm" href="#" id="add-distance">添加属性值</a>-->
                    <!--</div>-->
                    <!--<div class="col-sm-1">-->
                        <!--<a class="btn btn-danger btn-sm" onclick="$(this).parents('.form-group').remove(); return false;" href="#">删除-->
                        <!--</a>-->
                    <!--</div>-->
                <!--</div>-->
                <?php  if(!empty($optionlist)) { ?>
                <?php  if(is_array($optionlist)) { foreach($optionlist as $row) { ?>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-7">
                        <div class="input-group">
                            <span class="input-group-addon" style="color: #f00;">排序：</span>
                            <input type="text" class="form-control" value="<?php  echo $row['displayorder'];?>" name="optiondisplayorder[]">
                            <span class="input-group-addon" style="color: #f00;">规格名：</span>
                            <input type="text" class="form-control" value="<?php  echo $row['start'];?>" name="optionstart[]">
                            <span class="input-group-addon" style="color: #f00;">属性值：</span>
                            <input type="text" class="form-control" value="<?php  echo $row['title'];?>" name="optiontitle[]">
                            <span class="input-group-addon no-b" style="color: #f00;">加价</span>
                            <input type="text" class="form-control" value="<?php  echo $row['price'];?>" name="optionprice[]">
                            <span class="input-group-addon no-l-b" style="color: #f00;">元</span>
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <a class="btn btn-danger btn-sm" onclick="$(this).parents('.form-group').remove(); return false;" href="#">删除
                        </a>
                    </div>
                </div>
                <?php  $flag = false;?>
                <?php  } } ?>
                <?php  } ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#add-distance').click(function(){
        $('#distance-list').append($('#distance-form-html').html());

    });
</script>