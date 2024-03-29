<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<?php  if($operation == 'display') { ?>
<div class="main">
    <div class="panel panel-default account">
        <div class="panel-body">
            <p style="margin: 0px"><strong>排号大屏幕 :</strong> <a href="javascript:;" title="点击复制Token"><?php echo $_W['siteroot'] . 'app/index.php?i=' . $weid . '&c=entry&storeid=' . $storeid . '&do=Screen&m=weisrc_dish'?></a></p>
        </div>
    </div>
    <script>
        require(['jquery', 'util'], function($, u){
            $('.account p a').each(function(){
                u.clip(this, $(this).text());
            });
        });
    </script>

    <style>
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
    </style>
    <div class="panel panel-default">
        <!--/backend/shops/yezi/branches/20459/queue_settings/board-->
        <div class="panel-body">
            <div class="row">
                <ul class="nav nav-pills" role="tablist">
                    <li class="active">
                        <a href="<?php  echo $this->createWebUrl('queueorder', array('op' => 'display', 'storeid' => $storeid))?>">客人队列</a>
                    </li>
                    <li>
                        <a href="<?php  echo $this->createWebUrl('queuesetting', array('op' => 'display', 'storeid' => $storeid))?>">队列设置</a>
                    </li>
                    <li>
                        <a href="<?php  echo $this->createWebUrl('queuesetting', array('op' => 'setting', 'storeid' => $storeid))?>">排号详情设置</a>
                    </li>
                </ul>
            </div>
            <div class="header">
                <h3>客人队列 列表</h3>
            </div>

        <div id="guest-queue-index-body">
            <?php  $itemindex = 1?>
            <?php  if(is_array($list)) { foreach($list as $item) { ?>
            <?php  if($itemindex%5==1) { ?><?php  $curcolor = 'block-gray';?><?php  } ?>
            <?php  if($itemindex%5==2) { ?><?php  $curcolor = 'block-red';?><?php  } ?>
            <?php  if($itemindex%5==3) { ?><?php  $curcolor = 'block-primary';?><?php  } ?>
            <?php  if($itemindex%5==4) { ?><?php  $curcolor = 'block-success';?><?php  } ?>
            <?php  if($itemindex%5==0) { ?><?php  $curcolor = 'block-orange';?><?php  } ?>
            <a class="<?php  echo $curcolor;?> queue_setting" href="<?php  echo $this->createWebUrl('queueorder', array('op' => 'detail', 'storeid' => $storeid, 'queueid' => $item['id']))?>">
                <div class="table-display">
                    <div class="name">当前排队人数：<?php  if($queue_count[$item['id']]['count']) { ?><?php  echo $queue_count[$item['id']]['count'];?><?php  } else { ?>0<?php  } ?></div>
                </div>
                <div class="table-display">
                    <div class="queue-enabled"><?php  echo $item['title'];?></div>
                </div>
            </a>
            <?php  $itemindex++;?>
            <?php  } } ?>
            <div class="clearfix"></div>
        </div>
        </div>
    </div>
</div>
<?php  } else if($operation == 'detail') { ?>
<audio id="music" >
    <source src="http://fanyi.sogou.com/reventondc/microsoftGetSpeakFile?from=translateweb&spokenDialect=zh-CHS&text=A-004，A-004，请就餐？" type="audio/mpeg">
    <embed height="0" width="0" src="http://fanyi.sogou.com/reventondc/microsoftGetSpeakFile?from=translateweb&spokenDialect=zh-CHS&text=A-004，A-004，请就餐？">
</audio>
<script>
    "<?php  if(!empty($item)) { ?>"
    var audioEl = $("#music")[0];
    (function() {
        var i=1;
        function checkorder() {
            if (i > 2) {
                return false;
            }
            var tip = "<?php  echo $item['num'];?>，<?php  echo $item['num'];?>，请就餐？";
            audioEl.src="http://fanyi.sogou.com/reventondc/microsoftGetSpeakFile?from=translateweb&spokenDialect=zh-CHS&text=" + tip;
            audioEl.load();
            audioEl.play();
            i++;
            setTimeout(checkorder, 5000);
        }

        function log(info) {
            console.log(info);
            // alert(info);
        }
        function forceSafariPlayAudio() {
            audioEl.load(); // iOS 9   还需要额外的 load 一下, 否则直接 play 无效
            audioEl.play(); // iOS 7/8 仅需要 play 一下
        }

        // 可以自动播放时正确的事件顺序是
        // loadstart
        // loadedmetadata
        // loadeddata
        // canplay
        // play
        // playing
        //
        // 不能自动播放时触发的事件是
        // iPhone5  iOS 7.0.6 loadstart
        // iPhone6s iOS 9.1   loadstart -> loadedmetadata -> loadeddata -> canplay
        audioEl.addEventListener('loadstart', function() {
            log('loadstart');
        }, false);
        audioEl.addEventListener('loadeddata', function() {
            log('loadeddata');
        }, false);
        audioEl.addEventListener('loadedmetadata', function() {
            log('loadedmetadata');
        }, false);
        audioEl.addEventListener('canplay', function() {
            log('canplay');
        }, false);
        audioEl.addEventListener('play', function() {
            log('play');
            // 当 audio 能够播放后, 移除这个事件
            window.removeEventListener('touchstart', checkorder, false);
        }, false);
        audioEl.addEventListener('playing', function() {
            log('playing');
        }, false);
        audioEl.addEventListener('pause', function() {
            log('pause');
        }, false);

        // 由于 iOS Safari 限制不允许 audio autoplay, 必须用户主动交互(例如 click)后才能播放 audio,
        // 因此我们通过一个用户交互事件来主动 play 一下 audio.
        window.addEventListener('touchstart', checkorder, false);
        checkorder();
    })();
    "<?php  } ?>"
</script>
<style>
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
</style>
<div class="main">
    <div class="panel panel-default">
        <div class="table-responsive panel-body">
            <div class="row">
                <ul class="nav nav-pills" role="tablist">
                    <li class="active">
                        <a href="<?php  echo $this->createWebUrl('queueorder', array('op' => 'display', 'storeid' => $storeid))?>">客人队列</a>
                    </li>
                    <li>
                        <a href="<?php  echo $this->createWebUrl('queuesetting', array('op' => 'display', 'storeid' => $storeid))?>">队列设置</a>
                    </li>
                    <li>
                        <a href="<?php  echo $this->createWebUrl('queuesetting', array('op' => 'setting', 'storeid' => $storeid))?>">排号模式</a>
                    </li>
                </ul>
            </div>
            <div class="header">
                <h3>客人队列 列表</h3>
            </div>
            <div class="form-group">
                <a href="<?php  echo $this->createWebUrl('queueorder', array('op' => 'detail', 'queueid' => $queueid,'storeid' => $storeid, 'status' => 1))?>" class="btn btn-sm btn-primary">
                    排队中
                </a>
                <a href="<?php  echo $this->createWebUrl('queueorder', array('op' => 'detail', 'queueid' => $queueid,'storeid' => $storeid, 'status' => 2))?>" class="btn btn-sm btn-success">
                    已入号
                </a>
                <a href="<?php  echo $this->createWebUrl('queueorder', array('op' => 'detail', 'queueid' => $queueid,'storeid' => $storeid, 'status' => -1))?>" class="btn btn-sm btn-danger">
                    已取消
                </a>
                <a href="<?php  echo $this->createWebUrl('queueorder', array('op' => 'detail', 'queueid' => $queueid, 'storeid' => $storeid, 'status' => 3))?>" class="btn btn-sm btn-info">
                    已过号
                </a>
            </div>
            <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
                <table class="table table-hover">
                    <thead class="navbar-inner">
                    <tr>
                        <th style="width:10%;">号码</th>
                        <th style="width:10%;">状态</th>
                        <th style="width:10%;">是否已通知</th>
                        <th style="width:15%;">电话</th>
                        <th style="width:15%;">客人数量</th>
                        <th style="width:15%;">开始排队时间</th>
                        <th style="width:25%;text-align: center;">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php  if(is_array($list)) { foreach($list as $item) { ?>
                    <tr>
                        <td>
                            <?php  echo $item['num'];?>
                        </td>
                        <td>
                            <?php  if($item['status']==1) { ?>
                            <span class="label label-primary">排队中</span>
                            <?php  } else if($item['status']==2) { ?>
                            <span class="label label-success">已入号</span>
                            <?php  } else if($item['status']==3) { ?>
                            <span class="label label-info">已过号</span>
                            <?php  } else if($item['status']=-1) { ?>
                            <span class="label label-danger">已取消</span>
                            <?php  } ?>
                        </td>
                        <td>
                            <?php  if($item['isnotify']==1) { ?>
                            <span class="label label-success">已通知</span>
                            <?php  } else { ?>
                            <span class="label label-default">未通知</span>
                            <?php  } ?>
                        </td>
                        <td>
                            <img src="<?php  echo tomedia($item['fans']['headimgurl']);?>" style="width:30px;height:30px;padding1px;border:1px solid #ccc"/>
                            </br>
                            <?php  echo $item['fans']['nickname'];?>
                            </br>
                            <?php  echo $item['mobile'];?>
                        </td>
                        <td>
                            <?php  echo $item['usercount'];?>
                        </td>
                        <td>
                            <?php  echo date('Y-m-d H:i:s', $item['dateline'])?>
                        </td>
                        <td style="max-width:70px;text-align: center;">
                            <a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('queueorder', array('id' => $item['id'], 'storeid' => $storeid, 'queueid' => $queueid, 'op' => 'post'))?>" title="编辑">编辑</a>
                            <?php  if($item['status']==1) { ?>
                            <a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('queueorder', array('id' => $item['id'], 'storeid' => $storeid, 'queueid' => $queueid, 'op' => 'setstatus' ,'status' => 2))?>" title="接受" onclick="return confirm('确认操作吗？');return false;">接受</a>
                            <a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('queueorder', array('id' => $item['id'], 'storeid' => $storeid, 'queueid' => $queueid, 'op' => 'setstatus' ,'status' => 3))?>" title="过号" onclick="return confirm('确认操作吗？');return false;">过号</a>
                            <a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('queueorder', array('id' => $item['id'], 'storeid' => $storeid, 'queueid' => $queueid, 'op' => 'setstatus' ,'status' => -1))?>" title="取消" onclick="return confirm('确认操作吗？');return false;">取消</a>
                            <?php  } else if($item['status']==3) { ?>
                            <a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('queueorder', array('id' => $item['id'], 'storeid' => $storeid, 'queueid' => $queueid, 'op' => 'setstatus' ,'status' => 2))?>" title="接受" onclick="return confirm('确认操作吗？');return false;">接受</a>
                            <?php  } ?>
                            <a class="btn btn-warning btn-sm" href="<?php  echo $this->createWebUrl('queueorder', array('id' => $item['id'], 'storeid' => $storeid, 'queueid' => $queueid, 'op' => 'notice' ,'status' => 2))?>" title="通知" onclick="return confirm('确认操作吗？');return false;">通知</a>
                        </td>
                    </tr>
                    <?php  } } ?>
                    </tbody>
                    <tfoot>
                    <!--<tr>-->
                        <!--<td colspan="7">-->
                            <!--<input name="submit" type="submit" class="btn btn-primary" value="批量排序">-->
                            <!--<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />-->
                        <!--</td>-->
                    <!--</tr>-->
                    </tfoot>
                </table>
            </form>
        </div>
    </div>
    <?php  echo $pager;?>
</div>
<?php  } else if($operation == 'post') { ?>
<div class="main">
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php  echo $queueid;?>" />
        <div class="panel panel-default">
            <div class="panel-heading">
                编辑客人队列
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">号码</label>
                    <div class="col-sm-9">
                        <input type="text" name="num" class="form-control" value="<?php  echo $item['num'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">电话</label>
                    <div class="col-sm-9">
                        <input type="text" name="mobile" class="form-control" value="<?php  echo $item['mobile'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">客人数量</label>
                    <div class="col-sm-9">
                        <input type="text" name="usercount" class="form-control" value="<?php  echo $item['usercount'];?>" />
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <input type="submit" name="submit" value="保存设置" class="btn btn-primary col-lg-1" />
            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
        </div>
    </form>
</div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/footer', TEMPLATE_INCLUDEPATH)) : (include template('public/footer', TEMPLATE_INCLUDEPATH));?>