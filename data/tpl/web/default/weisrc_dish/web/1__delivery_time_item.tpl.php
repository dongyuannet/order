<?php defined('IN_IA') or exit('Access Denied');?><div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
    <div class="col-sm-7">
        <div class="input-group clockpicker">
            <span class="input-group-addon">时间段：</span>
            <input type="text" class="form-control" value="09:00" name="newdbegintime[]">
            <span class="input-group-addon no-b">至</span>
            <input type="text" class="form-control" value="23:59" name="newdendtime[]">
            <span class="input-group-addon no-b">加价</span>
            <input type="text" class="form-control" value="0" name="newdprice[]">
            <span class="input-group-addon no-l-b">元</span>
        </div>
    </div>
    <div class="col-sm-1">
        <a class="btn btn-danger btn-sm" onclick="$(this).parents('.form-group').remove(); return false;" href="#">删除
        </a>
    </div>
</div>