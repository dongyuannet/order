<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<link href="<?php  echo $_W['siteroot'];?>addons/weisrc_dish/plugin/gritter/jquery.gritter.css" rel="stylesheet">
<script src="<?php  echo $_W['siteroot'];?>addons/weisrc_dish/plugin/gritter/jquery.gritter.min.js"></script>
<link rel="stylesheet" href="<?php  echo $_W['siteroot'];?>addons/weisrc_dish/public/web/css/back.css">
<link rel="stylesheet" href="<?php  echo $_W['siteroot'];?>addons/weisrc_dish/public/web/css/style.css?v=1.2">
<script src="<?php  echo $_W['siteroot'];?>addons/weisrc_dish/public/web/js/jquery.flot.js?v=2.1.4"></script>
<script src="<?php  echo $_W['siteroot'];?>addons/weisrc_dish/public/web/js/echarts-all.js?v=2.1.4"></script>
<style>
    .clearfix .row{
        margin-left: -15px;
        margin-right: -15px;
    }
</style>
<?php  if($operation == 'display') { ?>
<div class="clearfix">
    <div class="row">
        <div class="col-sm-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-color: #e7eaec;border-style: solid solid none;">
                    <span class="label label-success pull-right">今天</span>
                    <h5>收入</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php  echo $today_order_price;?>元</h1>

                    <div class="stat-percent font-bold text-success"><?php  if($today_order_price !=0 & $total_order_price!=0) { ?><?php  echo sprintf('%.2f', $today_order_price/$total_order_price);?><?php  } else { ?>0.00<?php  } ?>%<i
                                class="fa fa-bolt"></i>
                    </div>
                    <small>占总收入</small>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-color: #e7eaec;border-style: solid solid none;">
                    <span class="label label-info pull-right">今天</span>
                    <h5>订单数</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php  echo $today_order_count;?>单</h1>

                    <div class="stat-percent font-bold text-info"><?php  if($today_order_count !=0 & $total_order_count !=0) { ?><?php  echo sprintf('%.2f', $today_order_count/$total_order_count);?><?php  } else { ?>0.00<?php  } ?>%<i
                                class="fa fa-bolt"></i>
                    </div>
                    <small>占总订单</small>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-color: #e7eaec;border-style: solid solid none;">
                    <span class="label label-primary pull-right">今天</span>
                    <h5>访客统计</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php  echo $today_fans_count;?>人</h1>

                    <div class="stat-percent font-bold text-navy"><?php  if($today_fans_count !=0 & $total_fans_count !=0) { ?><?php  echo sprintf('%.2f', $today_fans_count/$total_fans_count);?><?php  } else { ?>0.00<?php  } ?>%<i
                                class="fa fa-bolt"></i>
                    </div>
                    <small>占总访客</small>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-color: #e7eaec;border-style: solid solid none;">
                    <span class="label label-danger pull-right">今天</span>
                    <h5>在线收款金额</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php  if(!empty($online_todayprice)) { ?><?php  echo $online_todayprice;?><?php  } else { ?>0<?php  } ?>元</h1>

                    <div class="stat-percent font-bold text-danger"><?php  if(!empty($online_todayprice)) { ?><?php  echo sprintf('%.2f', $online_todayprice/$online_totalprice);?>%<?php  } else { ?>0.00%<?php  } ?><i
                                class="fa fa-bolt"></i>
                    </div>
                    <small>占总收入</small>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-color: #e7eaec;border-style: solid solid none;"><h5>按日期筛选</h5>
                </div>
                <div class="ibox-content">
                    <form action="" method="get" class="form-horizontal" role="form" id="list">
                        <input type="hidden" name="c" value="site">
                        <input type="hidden" name="a" value="entry">
                        <input type="hidden" name="m" value="weisrc_dish">
                        <input type="hidden" name="do" value="start"/>
                        <input type="hidden" name="op" value="display"/>
                        <input type="hidden" name="storeid" value="<?php  echo $storeid;?>"/>

                        <div class="form-group clearfix">
                            <label class="col-xs-12 col-sm-2 col-md-1 control-label">时间范围</label>

                            <div class="col-sm-7 col-lg-8 col-md-8 col-xs-12">
                                <?php  echo tpl_form_field_daterange('time', array('starttime'=>date('Y-m-d H:i:s',$starttime),'endtime'=>date('Y-m-d H:i:s', $endtime)), true);?>
                                <input class="btn btn-sm btn-success" name="commit" type="submit" value="搜索">
                                <a class="btn btn-danger btn-sm store_close" href="javascript:void(0);">发送今日销售统计</a>

								<?php  if($store_info['is_show']) { ?>
                                <!--<a class="btn btn-danger btn-sm store_close" href="javascript:void(0);">打烊</a>-->
                                <?php  } else { ?> 
                                <!--<a class="btn btn-primary btn-sm store_open" href="javascript:void(0);">开店</a>-->
                                <?php  } ?>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="ibox-content">
                    <form action="" method="get" class="form-horizontal" role="form" id="list">
                        <input type="hidden" name="c" value="site">
                        <input type="hidden" name="a" value="entry">
                        <input type="hidden" name="m" value="weisrc_dish">
                        <input type="hidden" name="do" value="start"/>
                        <input type="hidden" name="op" value="out"/>
                        <input type="hidden" name="time" value="yesmorning"/>
                        <input type="hidden" name="storeid" value="<?php  echo $storeid;?>"/>
                        <div class="form-group clearfix">
                            <label class="col-xs-12 col-sm-2 col-md-2 control-label" style="margin-right: 20px">昨日10点至昨日22点收入情况 </label>
                            <input class="btn btn-sm btn-success" name="commit" type="submit" value="导出">
                            
                        </div>
                    </form>
                </div>
                <div class="ibox-content">
                    <form action="" method="get" class="form-horizontal" role="form" id="list">
                        <input type="hidden" name="c" value="site">
                        <input type="hidden" name="a" value="entry">
                        <input type="hidden" name="m" value="weisrc_dish">
                        <input type="hidden" name="do" value="start"/>
                        <input type="hidden" name="op" value="out"/>
                        <input type="hidden" name="time" value="yes"/>
                        <input type="hidden" name="storeid" value="<?php  echo $storeid;?>"/>
                        <div class="form-group clearfix">
                            <label class="col-xs-12 col-sm-2 col-md-2 control-label" style="margin-right: 20px">昨日22点至今日10点收入情况 </label>
                            <input class="btn btn-sm btn-success" name="commit" type="submit" value="导出">
                            
                        </div>
                    </form>
                </div>
                <div class="ibox-content">
                    <form action="" method="get" class="form-horizontal" role="form" id="list">
                        <input type="hidden" name="c" value="site">
                        <input type="hidden" name="a" value="entry">
                        <input type="hidden" name="m" value="weisrc_dish">
                        <input type="hidden" name="do" value="start"/>
                        <input type="hidden" name="op" value="out"/>
                        <input type="hidden" name="time" value="today"/>
                        <input type="hidden" name="storeid" value="<?php  echo $storeid;?>"/>
                        <div class="form-group clearfix">
                            <label class="col-xs-12 col-sm-2 col-md-2 control-label" style="margin-right: 20px">今日10点至今日22点收入情况 </label>
                            <input class="btn btn-sm btn-success" name="commit" type="submit" value="导出">
                            
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
	 <script>
        $(".store_close").click(function(){
        if (confirm("是否发送今日销售统计？")){
            $.ajax({
            type:"post",
                    url:"",
                    data:"check_status=1&store_status=0",
                    success:function(e){
                    window.history.go(0);
                    }
            })
        }

        });
        $(".store_open").click(function(){
            if(confirm("是否开店营业")){
                $.ajax({
                    type:"post",
                    url:"",
                    data:"check_status=1&store_status=1",
                    success:function(e){
                    window.history.go(0);
                    }
                })
            }
            
        });
    </script>
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-color: #e7eaec;border-style: solid solid none;"><h4><?php  if(!empty($_GPC['time'])) { ?><?php  echo date('Y-m-d',$starttime);?>至<?php  echo date('Y-m-d',$endtime)?><?php  } ?>数据统计</h4></div>
                <div class="account-stat"
                     style="background-color: #ffffff;border-color: #e7eaec;border-style: solid solid none;border-width: 1px 0px;">
                    <div class="account-stat-btn">
                        <div class="col-12" style="width: 160px;">总收入
                            <span><?php  echo sprintf('%.2f', $detail_total_order_price);?>元</span>
                        </div>
                        <div class="col-12" style="width: 160px;">实收金额
                            <span><?php  echo sprintf('%.2f', $shi_total_order_price);?>元</span>
                        </div>
                        <div class="col-12" style="width: 160px;">在线收入
                            <span><?php  echo sprintf('%.2f',$detail_online_totalprice);?>元</span>
                        </div>
                        <div class="col-12">总订单数<span><?php  echo $detail_total_order_count;?>单</span></div>
                        <div class="col-12">商品数<span><?php  echo $total_goods_count;?>个</span></div>
                        <div class="col-12">打印机数<span><?php  echo $total_print_count;?>台</span></div>
                        <div class="col-12">餐桌数<span><?php  echo $total_table_count;?>张</span></div>
                        <div class="col-12">排队数<span><?php  echo $total_queue_count;?>队</span></div>
                        <div class="col-12 text-center">用户人数<span><?php  echo $total_fans_count;?>人</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix">
        <div class="row">
            <div class="col-sm-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title" style="border-color: #e7eaec;border-style: solid solid none;">
                        <h5><?php  if(!empty($_GPC['time'])) { ?><?php  echo date('Y-m-d', $starttime)?>至<?php  echo date('Y-m-d',$endtime)?><?php  } ?>订单类型比例图</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="echarts" id="echarts-pie-chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title" style="border-color: #e7eaec;border-style: solid solid none;">
                        <h5>
<?php  if(!empty($_GPC['time'])) { ?><?php  echo date('Y-m-d', $starttime)?>至<?php  echo date('Y-m-d',$endtime)?><?php  } ?>支付方式比例图</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="echarts" id="echarts-pie-chart-a"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form class="form-horizontal" action="" method="post" onkeydown="if(event.keyCode == 13) return false;">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-text-center">
                        <thead class="navbar-inner">
                        <tr>
                            <th width="300">时间</th>
                            <th>营业额</th>
                            <th>订单数</th>
                            <th>余额支付</th>
                            <th>微信支付</th>
                            <th>支付宝</th>
                            <th>现金支付</th>
                            <!--<th>查看详情</th>-->
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th width="300">总计</th>
                            <th><?php  echo sprintf('%.2f', $footer_totalprice);?> 元</th>
                            <th><?php  echo intval($footer_totalcount);?> 单</th>
                            <th><?php  echo sprintf('%.2f', $footer_totalprice1);?> 元</th>
                            <th><?php  echo sprintf('%.2f', $footer_totalprice2);?> 元</th>
                            <th><?php  echo sprintf('%.2f', $footer_totalprice4);?> 元</th>
                            <th><?php  echo sprintf('%.2f', $footer_totalprice3);?> 元</th>
                            <!--<th>查看详情</th>-->
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php  if(is_array($return)) { foreach($return as $k => $dca) { ?>
                        <tr>
                            <th><?php  echo $k;?></th>
                            <td><?php  echo sprintf('%.2f', $dca['totalprice']);?> 元</td>
                            <td><?php  echo intval($dca['count']);?> 单</td>
                            <td><?php  echo sprintf('%.2f', $dca['1']);?> 元</td>
                            <td><?php  echo sprintf('%.2f', $dca['2']);?> 元</td>
                            <td><?php  echo sprintf('%.2f', $dca['4']);?> 元</td>
                            <td><?php  echo sprintf('%.2f', $dca['3']);?> 元</td>
                            <!--<td>-->
                            <!--<a href="#" class="btn btn-success" target="_blank">详情</a>-->
                            <!--</td>-->
                        </tr>
                        <?php  } } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    $(function () {
        var templates = {
            b: {
                title: {
                    text: '各种支付类型比例',
                    subtext: '比例图'
                },
                series: [{
                    name: '各种支付类型下单比例',
                    data: []
                }]
            },
            a: {
                title: {
                    text: '各种支付方式收入比例',
                    subtext: '比例图'
                },
                series: [{
                    name: '各种支付方式收入下单比例',
                    data: []
                }]
            }
        };
        //第一
        // var pieChart = echarts.init(document.getElementById("echarts-pie-chart"));
        var pieoption = {
            title: {
                text: '',
                x: 'center'
            },
            tooltip: {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            legend: {
                orient: 'vertical',
                x: 'left',
                data: ['店内', '外卖', '快餐', '预定']
            },
            calculable: true,
            series: [
                {
                    name: '访问来源',
                    type: 'pie',
                    radius: '60%',
                    center: ['50%', '60%'],
                    data: []
                }
            ]
        };
        // pieChart.setOption(pieoption);
        // $(window).resize(pieChart.resize);
        var GetChartData = function (type) {
            $('#echarts-pie-chart').html('');
            var storeid = "<?php  echo $storeid;?>";
            var url = "<?php  echo $this->createWebUrl('start');?>&op=" + type + "&storeid=" + storeid;
            var params = {
                'start': $('#list input[name="time[start]"]').val(),
                'end': $('#list input[name="time[end]"]').val()
            };
            $.post(url, params, function (data) {
                var data = $.parseJSON(data);
                var ds = $.extend(true, {}, pieoption, templates[type]);
                ds.series[0].data = data.message.message;
                var pieChart = echarts.init($('#echarts-pie-chart')[0]);
                pieChart.setOption(ds);
                $(window).resize(pieChart.resize);
            });
        }
        GetChartData('b');
        //第二
        var pieoption_a = {
            title: {
                text: '',
                x: 'center'
            },
            tooltip: {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            legend: {
                orient: 'vertical',
                x: 'left',
                data: ['支付宝支付', '微信支付', '现金支付', '余额支付']
            },
            calculable: true,
            series: [
                {
                    name: '访问来源',
                    type: 'pie',
                    radius: '60%',
                    center: ['50%', '60%'],
                    data: []
                }
            ]
        };
        var GetChartData = function (type) {
            $('#echarts-pie-chart-a').html('');
            var storeid = "<?php  echo $storeid;?>";
            var url = "<?php  echo $this->createWebUrl('start');?>&op=" + type + "&storeid=" + storeid;
            var params = {
                'start': $('#list input[name="time[start]"]').val(),
                'end': $('#list input[name="time[end]"]').val()
            };
            $.post(url, params, function (data) {
                var data = $.parseJSON(data);
                var ds = $.extend(true, {}, pieoption_a, templates[type]);
                ds.series[0].data = data.message.message;
                var myChart = echarts.init($('#echarts-pie-chart-a')[0]);
                myChart.setOption(ds);
                $(window).resize(myChart.resize);
            });
        }
        GetChartData('a');
    });
    "<?php  if($order_count > 0) { ?>"
    $(document).ready(function () {
        setTimeout(function () {
            $.gritter.add({
                title: "您有<?php  echo $order_count;?>条未处理订单",
                text: '请前往<a href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'storeid' => $storeid))?>" class="text-warning">订单管理</a>进行处理',
                time: 10000
            })
        }, 2000);
    });
    "<?php  } ?>"
</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/footer', TEMPLATE_INCLUDEPATH)) : (include template('public/footer', TEMPLATE_INCLUDEPATH));?>