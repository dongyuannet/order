<?php defined('IN_IA') or exit('Access Denied');?><div class="tab-pane" id="tab_qrcode">
    <div class="panel panel-default">
        <div class="panel-heading">
            二维码
        </div>
        <?php  if($item['isoptions'] == 0) { ?>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">外卖二维码</label>
                <div class="col-sm-9">
                    <img alt="<?php  echo $item['title'];?>"
                         src="<?php echo $this->fm_qrcode($_W['siteroot'] . 'app/index.php?i=' . $_W['uniacid'] . '&c=entry&mode=2&storeid=' . $storeid . '&do=addqrcodefood&id=' . $item['id'] . '&m=weisrc_dish', 'qrcode_food_' . $item['id'], '', $logo);?>" width="200px">
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">快餐二维码</label>
                <div class="col-sm-9">
                    <img alt="<?php  echo $item['title'];?>"
                         src="<?php echo $this->fm_qrcode($_W['siteroot'] . 'app/index.php?i=' . $_W['uniacid'] . '&c=entry&mode=4&storeid=' . $storeid . '&do=addqrcodefood&id=' . $item['id'] . '&m=weisrc_dish', 'qrcode_food_' . $item['id'], '', $logo);?>" width="200px">
                </div>
            </div>
        </div>
        <?php  } ?>
    </div>
</div>