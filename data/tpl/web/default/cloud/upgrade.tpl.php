<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="upgrade-content" id="js-cloud-upgrade" ng-controller="CloudUpgradeCtrl" ng-cloak>
	<div class="upgrade-heading we7-padding-vertical text-center">
		<img src="./resource/images/logo/logo-lg.png" alt="" class="we7-logo"/>
		<h2 class="upgrade-version">系统当前版本: <?php echo IMS_FAMILY;?><?php echo IMS_VERSION;?>（<?php echo IMS_RELEASE_DATE;?>）</h2>
	</div>
	<div class="alert we7-page-alert">
		<p><i class="wi wi-info-sign"></i>系统更新后，如果出现样式错误等，请自行更新缓存并“CTRL+F5”强行刷新</p>
	</div>
	<form action="" class="form we7-form" ng-if="upgrade && upgrade.upgrade">
		<div class="upgrade-info we7-padding-bottom">
			<div class="panel we7-panel">
				<div class="panel-heading we7-padding">
					<span class="col-sm-2 we7-padding-none color-gray">最新版本</span>
					<span class="col-sm-7 we7-padding-none">系统 {{upgrade.family}}{{upgrade.version}}【{{upgrade.release}}】版</span>
				</div>
				<div class="panel-body we7-padding">
					<div class="form-group">
						<label for="" class="control-label color-gray col-sm-2">需要更新文件</label>
						<div class="form-controls col-sm-7 form-control-static">{{upgrade.files.length > 0 ? upgrade.files.length : 0}} 个</div>
						<span class="color-default col-sm-3 text-right"><a href="#upgrade-file" data-toggle="modal" >查看</a></span>
					</div>
					<div class="form-group">
						<label for="" class="control-label color-gray col-sm-2">需要更新数据库</label>
						<div class="form-controls col-sm-7 form-control-static">{{upgrade.database.length > 0 ? upgrade.database.length : 0}} 项</div>
						<span class="color-default col-sm-3 text-right"><a href="#upgrade-databases" data-toggle="modal" >查看</a></span>
					</div>
					<div class="form-group">
						<label for="" class="control-label color-gray col-sm-2">需要更新脚本</label>
						<div class="form-controls col-sm-7 form-control-static">{{upgrade.scripts.length > 0 ? upgrade.scripts.length : 0}} 项</div>
						<span class="color-default col-sm-3 text-right"><a href="#upgrade-scripts" data-toggle="modal" >查看</a></span>
					</div>
					<div class="form-group  we7-padding-none">
						<label for="" class="control-label color-gray col-sm-2">更新协议事项</label>
						<div class="form-controls col-sm-10 form-control-static">
							<div class="">
								<input id='agreement_0' type="checkbox" name='agreement_0' autocomplete="off" />
								<label for="agreement_0">确保您的系统文件官方文件保持一致，避免被非法篡改，远离盗版</label>
							</div>
							<div class="">
								<input id='agreement_1' type="checkbox" name='agreement_1' autocomplete="off"/>
								<label for="agreement_1">已经做好了相关文件的备份工作，认同官方的更新行为并自愿承担更新所存在的风险</label>
							</div>
							<div class="">
								<input id='agreement_2' type="checkbox" name='agreement_2' autocomplete="off"/>
								<label for="agreement_2">认同“购买系统商业授权后进行商业化运营”的协议</label>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="text-center">
				<input type="button" name="" id="forward" value="一键更新" class="btn btn-danger" ng-click="submit()"/>
				<input name="rollback" type="button" value="撤回更新" class="btn btn-default" data-toggle="modal" data-target="#rollback-panel" />
			</div>
		</div>
	</form>
	<form action="" method="post" ng-if="!upgrade || !upgrade.upgrade">
		<div class="upgrade-info we7-padding-bottom">
			<div class="panel we7-panel">
				<div class="panel-heading we7-padding">
					<span class="we7-padding-none color-gray">当前版本为最新版本，您可以点击此按钮, 立即检查是否有新版本。</span>
				</div>
			</div>
			<div class="text-center">
				<input name="submit" type="submit" value="{{showtext}}" class="btn btn-danger" disabled ng-show="submitDisabled">
				<input name="submit" type="submit" value="{{showtext}}" class="btn btn-danger" ng-show="!submitDisabled">
				<input name="rollback" type="button" value="撤回更新" class="btn btn-default" data-toggle="modal" data-target="#rollback-panel" />
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
			</div>
		</div>
	</form>
	<div class="panel we7-panel">
		<div class="panel-heading">
			更新通知
		</div>
		<div class="panel-body we7-padding">
			<ul class="list-unstyled">
			<script type="text/javascript" src="//bbs.we7.cc/api.php?mod=js&bid=17"></script>
			</ul>
		</div>
	</div>
	<div class="panel we7-panel">
		<div class="panel-heading">
			官方动态
		</div>
		<div class="panel-body we7-padding">
			<ul class="list-unstyled">
			<script type="text/javascript" src="//bbs.we7.cc/api.php?mod=js&bid=20"></script>
			</ul>
		</div>
	</div>
	<div class="modal fade" id="upgrade-file" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog we7-modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span>
					</button>
					<h4 class="modal-title">更新文件</h4>
				</div>
				<div class="modal-body color-dark">
					<div ng-repeat="line in upgrade.files track by $index" ng-if="upgrade.files.length > 0">{{line}}</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary"  data-dismiss="modal">确定</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="upgrade-databases" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog we7-modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span>
					</button>
					<h4 class="modal-title">更新数据库</h4>
				</div>
				<div class="modal-body color-dark">
					<div class="row" ng-repeat="database in upgrade.database" ng-if="upgrade.database">
						<div class="col-sm-2">表名:</div>
						<div class="col-sm-4" ng-bind="database.tablename"></div>
						<div class="col-sm-6" ng-if="database.new">New</div>
						<div class="col-sm-6" ng-if="!database.new">
							<span ng-if="database.fields">fields: {{database.fields}}</span>
							<span ng-if="database.indexes">indexes: {{database.indexes}}</span>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">确定</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="upgrade-scripts" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog we7-modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span>
					</button>
					<h4 class="modal-title">更新脚本</h4>
				</div>
				<div class="modal-body color-dark">
					<div ng-repeat="scripts in upgrade.scripts" ng-if="upgrade.scripts"><span style="display:inline-block; width:100px;" ng-bind="scripts.release"></span>{{scripts.message}}</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">确定</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="rollback-panel" tabindex="-1" role="dialog" aria-labelledby="rollback-label">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">更新回滚列表</h4>
				</div>
				<div class="modal-body">
					<div class="alert alert-danger">
						如果要恢复更早的记录请直接查看 <b>/data/patch/</b> 目录
					</div>
					<div class="alert alert-success">
						恢复时，请手动将此目录中的文件上传至网站即可（选中全部文件和目录直接上传）
					</div>
					<?php  if(!empty($patchs)) { ?>
					<table class="table">
						<tr>
							<th style="width: 200px">日期</th>
							<th >路径</th>
						</tr>
						<?php  if(is_array($patchs)) { foreach($patchs as $path) { ?>
						<tr>
							<td><?php  echo date('Y-m-d')?> <?php  echo substr($path, 0, 2)?>:<?php  echo substr($path, 2, 2)?></td>
							<td><?php  echo $path;?></td>
						</tr>
						<?php  } } ?>
					</table>
					<?php  } else { ?>
					今天暂无更新
					<?php  } ?>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	angular.module('cloudUpgradeApp', []);
	angular.module('cloudUpgradeApp').value('config', {
		'links': {
			'process': "<?php  echo url('cloud/process')?>",
			'getUpgradeInfo': "<?php  echo url('cloud/upgrade/get_upgrade_info')?>",
		}
	});
	angular.module('cloudUpgradeApp').controller('CloudUpgradeCtrl', ['$scope', '$http', 'config', function($scope, $http, config) {
		$scope.upgrade = {};
		$scope.showtext = '正在检查更新...';
		$scope.submitDisabled = true;
		$scope.submit = function() {
			var a = $("#agreement_0").is(':checked');
			var b = $("#agreement_1").is(':checked');
			var c = $("#agreement_2").is(':checked');
			if(a && b && c) {
				if(confirm('更新将直接覆盖本地文件, 请注意备份文件和数据. \n\n**另注意** 更新过程中不要关闭此浏览器窗口.')) {
					location.href = config.links.process;
				}
			} else {
				util.message("抱歉，更新前请仔细阅读更新协议！", '', 'error');
				return false;
			}
		};
		$http.post(config.links.getUpgradeInfo)
			.success(function (data) {
				$scope.showtext = '立即检查新版本';
				$scope.submitDisabled = false;
				if (data.message.errno == 0) {
					$scope.upgrade = data.message.message;
				} else {
					util.message(data.message);
				}
			});
	}]);
	angular.bootstrap($('#js-cloud-upgrade'), ['cloudUpgradeApp']);
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
