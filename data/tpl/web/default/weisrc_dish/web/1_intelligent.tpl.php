<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<style>
    .checkbox-dish {
        /*background: #368ee0;*/
        background: #5ac5d4;
        border-radius: 3px;
        height: 40px;
        padding: 10px 5px 0px 5px;
        margin-bottom: 5px;
    }
</style>
<?php  if($operation == 'post') { ?>
<div class="main">
    <div class="panel panel-default">
        <div class="panel-body">
            <a class="btn btn-warning" href="<?php  echo $this->createWebUrl('intelligent', array('op' => 'display', 'storeid' => $storeid))?>">返回活动推荐管理
            </a>
        </div>
    </div>
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
	<input type="hidden" name="parentid" value="<?php  echo $parent['id'];?>" />
        <div class="panel panel-default">
            <div class="panel-heading">
                活动推荐编辑
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">活动名称</label>
                    <div class="col-sm-9">
                        <input type="text" name="title" class="form-control" value="<?php  echo $intelligent['title'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">顶部图片</label>
                    <div class="col-sm-9">
                        <?php  echo tpl_form_field_image('thumb', $intelligent['thumb'])?>
                        <span class="help-block" style="color: #f00;">建议尺寸:300*100</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商品选择</label>
                    <div class="col-sm-9">
                        <?php  if(is_array($categorys)) { foreach($categorys as $category) { ?>
                        <b><?php  echo $category['name'];?></b><br/>
                        <?php  if(is_array($goods_arr[$category['id']])) { foreach($goods_arr[$category['id']] as $item) { ?>
                        <label class="checkbox-dish">
                            <input type="checkbox" name="goodsids[]" value="<?php  echo $item['id'];?>" <?php  if(in_array($item['id'], $goodsids)) { ?>checked<?php  } ?>> <span class="label"><?php  echo $item['title'];?></span>
                        </label>
                        <?php  } } ?>
                        <br>
                        <?php  } } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">显示顺序</label>
                    <div class="col-sm-9">
                        <input type="text" name="displayorder" class="form-control" value="<?php  echo $intelligent['displayorder'];?>" />
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
<?php  } else if($operation == 'display') { ?>
<div class="main">
    <div class="panel panel-default">
        <div class="panel-body">
            <a class="btn btn-default" href="<?php  echo $this->createWebUrl('intelligent', array('op' => 'post', 'storeid' => $storeid))?>"><i class="fa fa-plus"></i> 添加活动</a>
            <a class="btn btn-default" href="<?php  echo $this->createWebUrl('goods', array('op' => 'display', 'storeid' => $storeid))?>"><i class="fa fa-list"></i> 商品管理</a>
        </div>
    </div>
    <div class="panel panel-default">
        <form action="" method="post" class="form-horizontal form" >
        <div class="table-responsive panel-body">
        <table class="table table-hover">
            <thead class="navbar-inner">
            <tr>
                <th style="width:10%;">显示顺序</th>
                <th style="width:15%;">活动名称</th>
                <th style="width:60%;text-align: left;">商品</th>
                <th style="width:10%;text-align:right;">操作</th>
            </tr>
            </thead>
            <tbody id="level-list">
            <?php  if(is_array($intelligents)) { foreach($intelligents as $row) { ?>
            <tr>
                <td><input type="text" class="form-control" name="displayorder[<?php  echo $row['id'];?>]" value="<?php  echo $row['displayorder'];?>"></td>
                <td ><?php  echo $row['title'];?></td>
                <td style="white-space:normal;">
                    <?php  $goodsids = explode(',', $row['content']);?>
                    <?php  if(is_array($goodsids)) { foreach($goodsids as $goodsid) { ?>
                    <label class="checkbox-dish"><span class="label" ><?php  echo $goods_arr[$goodsid];?></span></label>
                    <?php  } } ?>
                </td>
                <td style="text-align:right;"><a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('intelligent', array('op' => 'post', 'id' => $row['id'], 'storeid' => $storeid))?>" title="编辑">改</a>&nbsp;&nbsp;<a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('intelligent', array('op' => 'delete', 'id' => $row['id'], 'storeid' => $storeid))?>" onclick="return confirm('确认删除此分类吗？');return false;" title="删除">删</a></td>
            </tr>
            <tr>
                <td colspan="4">
                    <?php echo $_W['siteroot'] . 'app/index.php?i=' . $weid . '&c=entry&storeid=' . $storeid . '&do=waplist&m=weisrc_dish&mode=2&intelligentid=' . $row['id']?>
                </td>
            </tr>
            <?php  } } ?>

            <tr>
                <td colspan="4">
                    <input name="submit" type="submit" class="btn btn-primary" value="批量更新排序">
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </td>
            </tr>
            </tbody>
        </table>
        </div>
        </form>
    </div>
    <?php  echo $pager;?>
</div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/footer', TEMPLATE_INCLUDEPATH)) : (include template('public/footer', TEMPLATE_INCLUDEPATH));?>