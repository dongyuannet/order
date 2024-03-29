<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li <?php  if($op == 'display') { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('cardmanage', array('op' => 'display'))?>">会员卡管理</a></li>
	<?php  if($op == 'record') { ?><li class="active"><a href="<?php  echo $this->createWebUrl('cardmanage', array('op' => 'record'))?>">消费记录</a></li><?php  } ?>
</ul>
<style>
	.label{line-height: 2}
	.danger{position: relative}
</style>
<?php  if($op == 'display') { ?>
<div class="panel panel-info">
	<div class="panel-heading">筛选</div>
	<div class="panel-body">
		<form action="./index.php" method="get" class="form-horizontal" role="form" id="form">
			<input type="hidden" name="c" value="site">
			<input type="hidden" name="a" value="entry">
			<input type="hidden" name="m" value="we7_coupon">
			<input type="hidden" name="do" value="cardmanage">
			<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
			<input type="hidden" name="status" value="<?php  echo $status;?>">
			<input type="hidden" name="num" value="<?php  echo $num;?>">
			<input type="hidden" name="endtime" value="<?php  echo $endtime;?>">
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">使用状态</label>
				<div class="col-sm-8 col-xs-12">
					<div class="btn-group">
						<a href="<?php  echo filter_url('status:-1');?>" class="btn <?php  if($status == '-1') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
						<a href="<?php  echo filter_url('status:1');?>" class="btn <?php  if($status == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">启用</a>
						<a href="<?php  echo filter_url('status:0');?>" class="btn <?php  if($status == 0) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">禁用</a>
					</div>
				</div>
			</div>
			<?php  if($setting['nums_status'] == 1) { ?>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label"><?php  echo $setting['nums_text'];?></label>
				<div class="col-sm-8 col-xs-12">
					<div class="btn-group">
						<a href="<?php  echo filter_url('num:-1');?>" class="btn <?php  if($num == -1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
						<a href="<?php  echo filter_url('num:1');?>" class="btn <?php  if($num == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">未用完</a>
						<a href="<?php  echo filter_url('num:0');?>" class="btn <?php  if($num == 0) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">已用完</a>
					</div>
				</div>
			</div>
			<?php  } ?>
			<?php  if($setting['nums_status'] == 1) { ?>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label"><?php  echo $setting['times_text'];?></label>
				<div class="col-sm-8 col-xs-12">
					<div class="btn-group">
						<a href="<?php  echo filter_url('endtime:-1');?>" class="btn <?php  if($endtime == -1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
						<a href="<?php  echo filter_url('endtime:0');?>" class="btn <?php  if($endtime == 0) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">已到期</a>
						<a href="<?php  echo filter_url('endtime:7');?>" class="btn <?php  if($endtime == 7) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">7天内到期</a>
						<a href="<?php  echo filter_url('endtime:14');?>" class="btn <?php  if($endtime == 14) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">半月内到期</a>
						<a href="<?php  echo filter_url('endtime:30');?>" class="btn <?php  if($endtime == 30) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">一月内到期</a>
						<a href="<?php  echo filter_url('endtime:90');?>" class="btn <?php  if($endtime == 90) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">三月内到期</a>
					</div>
				</div>
			</div>
			<?php  } ?>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">卡号</label>
				<div class="col-sm-8 col-xs-12">
					<input type="text" class="form-control" name="cardsn" value="<?php  echo $_GPC['cardsn'];?>" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">姓名/手机号</label>
				<div class="col-sm-8 col-xs-12">
					<input type="text" class="form-control" name="keyword" value="<?php  echo $_GPC['keyword'];?>" />
				</div>
				<div class="pull-right col-xs-12 col-sm-3 col-md-2 col-lg-2">
					<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="panel panel-default">
<div class="panel-body table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th width="150">卡号/所属用户组</th>
				<th width="150">姓名/手机号</th>
				<th width="150">积分/余额</th>
				<?php  if($setting['nums_status'] == 1) { ?>
					<th width="80"><?php  echo $setting['nums_text'];?></th>
				<?php  } ?>
				<?php  if($setting['times_status'] == 1) { ?>
					<th  width="150"><?php  echo $setting['times_text'];?></th>
				<?php  } ?>
				<th width="150">领卡时间</th>
				<th width="140">是否开启</th>
				<th width="250" class="text-right">操作</th>
			</tr>
		</thead>
		<?php  if(is_array($list)) { foreach($list as $row) { ?>
			<tr <?php  if($row['is_birth'] == 1) { ?>class="danger"<?php  } ?>>
				<td>
					<?php  echo $row['cardsn'];?><br>
					<?php  echo $_W['account']['groups'][$row['groupid']]['title'];?>
				</td>
				<td>
					<?php  echo $row['realname'];?>
					<br>
					<?php  echo $row['mobile'];?>
				</td>
				<td>
					<span class="label label-default">积分:<?php  echo $row['credit1'];?></span>
					<br>
					<span class="label label-info">余额:<?php  echo $row['credit2'];?></span>
				</td>
				<?php  if($setting['nums_status'] == 1) { ?>
					<td>
						<?php  if(!$row['nums']) { ?>
							<span class="label label-danger">已用完</span>
						<?php  } else { ?>
							<span class="label label-success"><?php  echo $row['nums'];?>次</span>
						<?php  } ?>
					</td>
				<?php  } ?>
				<?php  if($setting['times_status'] == 1) { ?>
					<td>
						<?php  if($row['endtime'] < time()) { ?>
							<span class="label label-danger"><?php  echo date('Y-m-d', $row['endtime']);?> 已到期</span>
						<?php  } else { ?>
							<span class="label label-success"><?php  echo date('Y-m-d', $row['endtime']);?></span>
						<?php  } ?>
					</td>
				<?php  } ?>
				<td><?php  echo date('Y-m-d H:i', $row['createtime']);?></td>
				<td>
					<input type="checkbox" class="hidden" value="1" <?php  if(intval($row['status'])==1) { ?> checked="checked" <?php  } ?> data="<?php  echo $row['id'];?>"/>
				</td>
				<td class="text-right">
					<div class="btn-group" style="margin-bottom: 5px">
						<a href="javascript:;" title="改卡号" class="btn btn-default modal-trade-cardsn" data-type="cardsn" data-uid="<?php  echo $row['uid'];?>">改卡号</a>
						<?php  if(!empty($actions_permit['we7_coupon_permission_mc_credit1'])) { ?>
						<a href="javascript:;" title="积分" class="btn btn-default modal-trade-credit1" data-type="credit1" data-uid="<?php  echo $row['uid'];?>">积分</a>
						<?php  } ?>
						<?php  if(!empty($actions_permit['we7_coupon_permission_mc_credit2'])) { ?>
						<a href="javascript:;" title="余额" class="btn btn-default modal-trade-credit2" data-type="credit2" data-uid="<?php  echo $row['uid'];?>">余额</a>
						<?php  } ?>
						<a href="javascript:;" title="消费" class="btn btn-default modal-trade-consume" data-type="consume" data-uid="<?php  echo $row['uid'];?>">消费</a>
					</div>
					<br>
					<div class="btn-group">
					<a class="btn btn-default" href="<?php  echo $this->createWebUrl('cardmanage', array('op' => 'delete', 'cardid' => $row['id']))?>" onclick="return confirm('此操作不可恢复，确认删除？');return false;">删除</a>
					<a class="btn btn-default" href="<?php  echo $this->createWebUrl('cardmanage', array('op' => 'record', 'uid' => $row['uid']))?>">消费记录</a>
					<?php  if($setting['times_status'] == 1 || $setting['nums_status'] == 1) { ?>
						<a class="btn btn-warning manage" href="javascript:;" data-uid="<?php  echo $row['uid'];?>">充值/消费</a>
					<?php  } ?>
					</div>
				</td>
			</tr>
		<?php  } } ?>
	</table>
</div>
</div>
<?php  echo $pager;?>

<div class="modal fade" id="manage-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<ul class="nav nav-pills">
					<?php  if($setting['nums_status'] == 1) { ?>
						<li role="presentation" data-id="nums_plus" class="active"><a href="#nums_plus" aria-controls="home" role="tab" data-toggle="tab"><?php  echo $setting['nums_text'];?>充值</a></li>
						<li role="presentation" data-id="nums_times"><a href="#nums_times" aria-controls="profile" role="tab" data-toggle="tab"><?php  echo $setting['nums_text'];?>消费</a></li>
					<?php  } ?>
					<?php  if($setting['times_status'] == 1) { ?>
						<li role="presentation" data-id="times_plus"><a href="#times_plus" aria-controls="messages" role="tab" data-toggle="tab"><?php  echo $setting['times_text'];?>充值</a></li>
						<li role="presentation" data-id="times_times"><a href="#times_times" aria-controls="messages" role="tab" data-toggle="tab"><?php  echo $setting['times_text'];?>消费</a></li>
					<?php  } ?>
				</ul>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				<button type="button" class="btn btn-primary">提交</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	require({
		paths: {
			'trade': '/addons/we7_coupon/template/style/js/trade'
		}
	})
	require(['trade', 'bootstrap.switch'], function(trade){
		trade.init();

		<?php  if($setting['times_status'] == 1 || $setting['nums_status'] == 1) { ?>
			$('.manage').click(function(){
				var uid = $(this).data('uid');
				$.post("<?php  echo $this->createWeburl('cardmanage', array('op' => 'modal'));?>", {uid:uid}, function(data){
					if(data != 'error') {
						$('#manage-modal .modal-body').html(data);
						$('#manage-modal').modal('show');

						$('#manage-modal .btn-primary').unbind('click');
						$('#manage-modal .btn-primary').click(function(){
							var id = $('#manage-modal .modal-header li.active').data('id');
							$('#manage-modal #' + id + '>form').submit();
							return false;
						});
					} else {
						util.message('系统出错', '', 'error');
						return false;
					}
				});
			});
		<?php  } ?>

		$(':checkbox').bootstrapSwitch();
		$(':checkbox').on('switchChange.bootstrapSwitch', function(e, state){
			$this = $(this);
			var cardid = $this.attr('data');
			var status = this.checked ? 1 : 0;
			$.post(location.href, {cardid:cardid, status:status}, function(resp){
				if(resp != 'success') {
					util.message('操作失败, 请稍后重试.')
				}
				<?php  if(!empty($module)) { ?>
				else {
					window.setTimeout(function(){location.href = location.href;}, 300);
				}
				<?php  } else { ?>
					util.message('修改成功');
				<?php  } ?>
			});
		});
	});
</script>

<?php  } else if($op == 'record') { ?>
<div class="panel panel-info">
	<div class="panel-heading">筛选</div>
	<div class="panel-body">
		<form action="./index.php" method="get" class="form-horizontal" role="form" id="form1">
			<input type="hidden" name="c" value="site">
			<input type="hidden" name="a" value="entry">
			<input type="hidden" name="do" value="cardmanage">
			<input type="hidden" name="op" value="record">
			<input type="hidden" name="m" value="we7_coupon">
			<input type="hidden" name="type" value="<?php  echo $type;?>">
			<input type="hidden" name="uid" value="<?php  echo $uid;?>">
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">类型</label>
				<div class="col-sm-8 col-xs-12">
					<div class="btn-group">
						<a href="<?php  echo filter_url('type:');?>" class="btn <?php  if($type == '') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
						<?php  if($setting['nums_status'] == 1) { ?>
						<a href="<?php  echo filter_url('type:nums');?>" class="btn <?php  if($type == 'nums') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>"><?php  echo $setting['nums_text'];?></a>
						<?php  } ?>
						<?php  if($setting['times_status'] == 1) { ?>
						<a href="<?php  echo filter_url('type:times');?>" class="btn <?php  if($type == 'times') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>"><?php  echo $setting['times_text'];?></a>
						<?php  } ?>
						<a href="<?php  echo $this->createWebUrl('statcredit1',array('uid' => $_GPC['uid']));?>" target="_blank" class="btn btn-default">积分消费记录</a>
						<a href="<?php  echo $this->createWebUrl('statcredit2',array('uid' => $_GPC['uid']));?>" target="_blank" class="btn btn-default">余额消费记录</a>
						<a href="<?php  echo $this->createWebUrl('statcash',array('uid' => $_GPC['uid']));?>" target="_blank" class="btn btn-default">现金消费记录</a>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">时间</label>
				<div class="col-sm-8 col-xs-12">
					<?php  echo tpl_form_field_daterange('endtime', array('start' => date('Y-m-d', $starttime), 'end' => date('Y-m-d', $endtime)));?>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="alert alert-warning">
	<i class="fa fa-info-circle"></i>
	<?php  if($setting['nums_status'] == 1) { ?><?php  echo $setting['nums_text'];?>剩余：<strong><?php  echo $card['nums'];?>次</strong><?php  } ?>
	<?php  if($setting['times_status'] == 1) { ?><?php  echo $setting['times_text'];?>：<strong><?php  echo date('Y-m-d', $card['endtime']);?>到期</strong><?php  } ?>
</div>
<div class="panel panel-default">
	<div class="panel-body table-responsive">
		<table class="table table-hover">
			<thead class="navbar-inner">
			<tr>
				<th>类型</th>
				<th>充值/消费</th>
				<th width="500">详情</th>
				<th width="250">备注</th>
				<th>时间</th>
			</tr>
			</thead>
			<?php  if(is_array($list)) { foreach($list as $row) { ?>
			<tr>
				<td>
					<?php  if($row['type'] == 'nums') { ?>
					<span class="label label-default"><?php  echo $setting['nums_text'];?></span>
					<?php  } else { ?>
					<span class="label label-info"><?php  echo $setting['times_text'];?></span>
					<?php  } ?>
				</td>
				<td>
					<?php  if($row['type'] == 'nums') { ?>
						<?php  if($row['model'] == 1) { ?>
							<span class="label label-success">充值<?php  echo $row['tag'];?>次</span>
						<?php  } else { ?>
							<span class="label label-danger">消费<?php  echo $row['tag'];?>次</span>
						<?php  } ?>
					<?php  } else { ?>
						<?php  if($row['model'] == 1) { ?>
							<span class="label label-success">服务延长<?php  echo $row['tag'];?>天</span>
						<?php  } else { ?>
							<span class="label label-danger">服务减少<?php  echo $row['tag'];?>天</span>
						<?php  } ?>
					<?php  } ?>
					<br>
					<span class="label label-warning" style="line-height:2.5">收费<?php  echo $row['fee'];?>元</span>
				</td>

				<td>
					<span style="cursor:pointer" data-toggle="popover" data-placement="bottom" data-content="<?php  echo $row['note'];?>"><?php  echo cutstr($row['note'], 45);?></span>
				</td>
				<td>
					<span style="cursor:pointer" data-toggle="popover" data-placement="bottom" data-content="<?php  echo $row['remark'];?>"><?php  echo cutstr($row['remark'], 30);?></span>
				</td>
				<td><?php  echo date('Y-m-d H:i', $row['addtime']);?></td>
			</tr>
			<?php  } } ?>
		</table>
	</div>
</div>
<?php  echo $pager;?>
<script>
	require(['bootstrap'],function($){
		$('.daterange').on('apply.daterangepicker', function(ev, picker) {
			$('#form1')[0].submit();
		});

		$('[data-toggle="popover"]').hover(function(){
			$(this).popover('show');
		}, function(){
			$(this).popover('hide');
		});
	});
</script>
<?php  } ?>