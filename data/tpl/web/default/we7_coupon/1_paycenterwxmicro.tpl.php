<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li <?php  if($op == 'pay') { ?>class="active"<?php  } ?>><a href="javascript:;">刷卡收款</a></li>
</ul>

<?php  if($op == 'pay') { ?>
<style>
	.panel .panel-heading input[name="fee"] {
		line-height:60px;
		height:60px; font-size:40px;
		padding-top:10px;
		text-align:right;
	}
	.panel .panel-heading .form-group{
		margin-bottom: 0px;
	}
	.panel .panel-body .row .col-md-4{
		margin-bottom: 15px;
	}
	.panel .panel-body .row .col-md-4 button, .panel-footer .row .col-md-6 button{
		line-height: 40px;
		font-size: 20px;
	}
	#wechat-pay .modal-content .form-group p{
		font-size: 16px;
	}
	#wechat-pay .modal-content .form-group p span{
		color: red;
	}
	#wechat-pay .modal-content .modal-body{
		text-align: center;
	}
	.row .col-md-3 .panel .panel-body span{
		font-size: 22px;
		color: #666;
		display: block;
	}
</style>
<div class="clearfix" ng-controller="microPay" id="microPay">
	<div class="row">
		<div class="col-md-3">
			<div class="panel panel-default text-center">
				<div class="panel-heading">
					<img src="<?php  echo MODULE_URL . '/template/style/img/money.png'?>" height="50">
				</div>
				<div class="panel-body">
					<span>￥<?php  echo $credit_total;?></span>
					今日收款
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel panel-default text-center">
				<div class="panel-heading">
					<img src="<?php  echo MODULE_URL . '/template/style/img/wx-icon.png'?>" height="50">
				</div>
				<div class="panel-body">
					<span>￥<?php  echo $wechat_total;?></span>
					今日收款
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon">￥</span>
						<input type="text" name="fee" class="form-control input-lg" ng-model="micro.config.fee" ng-init="micro.config.fee" placeholder="支付金额(至少0.01元)" disabled>
						<span class="input-group-addon">元</span>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-4" ng-repeat="num in micro.config.nums">
						<button type="button" class="btn btn-info btn-lg btn-block" ng-click="micro.num(num[0])">{{num[1]}}</button>
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<div class="row">
					<div class="col-md-6">
						<a ng-if="micro.config.fee == '0'" ng-click="micro.mcardPay()" class="btn btn-success btn-lg btn-block ">会员卡支付(-)</a>
						<a ng-if="micro.config.fee !='0'" data-toggle="modal" ng-click="micro.mcardPay('1')" class="btn btn-success btn-lg btn-block mccard">会员卡支付(-)</a>
					</div>
					<div class="col-md-6">
						<a ng-if="micro.config.fee == '0'" ng-click="micro.mcardPay()" class="btn btn-success btn-lg btn-block">微信刷卡支付(+)</a>
						<a ng-if="micro.config.fee != '0'" ng-click="micro.mcardPay('2')" data-toggle="modal" class="btn btn-success btn-lg btn-block">微信刷卡支付(+)</a>
						<div class="modal fade" id="wechat-pay">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-body" style="text-align:center;">
										<div class="form-group">
											<h2>刷卡支付</h2>
											<p>收款金额为<span> {{micro.config.fee}}元</span></p>
											<p class="js-userpaying" style="display:none;"><span>用户正在支付中</span></p>
											<input type="text" name="code" class="form-control js-input input-lg" ng-model="micro.config.code" tabindex="4" placeholder="微信刷卡支付授权码(请链接扫码枪扫码)">
										</div>
										<div class="form-group">
											<p class="js-pay-warning text-left" style="color:red;"></p>
										</div>
										<div class="form-group text-right">
											<a class="btn btn-primary btn-lg" id="micro-submit" ng-click="micro.submit()" ng-disabled="micro.last_money < 0">确认收款</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				消费记录(最近10条)
			</div>
			<div class="panel-body">
				<table class="table table-hover">
					<tr>
						<th>#</th>
						<th>消费方式</th>
						<th>金额</th>
						<th>优惠金额</th>
						<th>实际支付</th>
						<th>状态</th>
					</tr>
					<?php  if(is_array($paycenter_records)) { foreach($paycenter_records as $record) { ?>
					<tr>
						<td><?php  echo $record['id'];?></td>
						<td>
							<?php  if($record['cash'] == '0') { ?>
							<span class="label label-info">会员卡支付</span>
							<?php  } else if(!empty($record['cash']) && $record['credit2'] == '0' && $record['credit1'] == '0') { ?>
							<span class="label label-success">微信支付</span>
							<?php  } else if(!empty($record['cash']) && (!empty($record['credit2']) || !empty($record['credit1']))) { ?>
							<span class="label label-warning">混合支付</span>
							<?php  } ?>
						</td>
						<td><?php  echo $record['fee'];?></td>
						<td><?php  echo $record['fee'] - $record['final_fee']?></td>
						<td><?php  echo $record['final_fee'];?></td>
						<td>
							<?php  if($record['status'] == '1') { ?>
							<span class="label label-primary">支付成功</span>
							<?php  } else { ?>
							<span class="label label-danger">支付失败</span>
							<?php  } ?>
						</td>
					</tr>
					<?php  } } ?>
				</table>
			</div>
		</div>
	</div>
<?php  } ?>

<?php  if(!empty($card_set)) { ?>
	<div ng-show="micro.config.body && micro.config.fee" class="modal fade" id="mcard-pay" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<div class="form-group">
						<label>会员卡卡号</label>
						<input type="text" name="cardsn" class="form-control js-input" ng-model="micro.config.cardsn"  tabindex="1" placeholder="请输入11位会员卡卡号">
					</div>
					<div ng-show="micro.config.card_error" ng-bind="micro.config.card_error" class="text-danger"></div>
					<div ng-show="micro.config.loading" ng-bind="micro.config.loading"></div>
					<div ng-show="micro.config.member.uid > 0">
					<table class="table table-hover table-bordered" ng-show="micro.config.member.uid">
						<tr>
							<td colspan="4" style="text-align:center"><h4>{{micro.config.cardsn}}</h4></td>
						</tr>
						<tr>
							<th width="100">姓名</th>
							<td>{{micro.config.member.realname}}</td>
							<th>手机号</th>
							<td>{{micro.config.member.mobile}}</td>
						</tr>
						<tr>
							<th>积分</th>
							<td>{{micro.config.member.credit1}}</td>
							<th>余额</th>
							<td>{{micro.config.member.credit2}}</td>
						</tr>
						<tr>
							<th>会员等级</th>
							<td>{{micro.config.member.groupname}}</td>
							<th>优惠信息</th>
							<td>{{micro.config.member.discount_cn}}</td>
						</tr>
					</table>
					<div class="form-group" ng-if="micro.config.member.uid > 0">
						<label>实际支付金额</label>
						<input type="text" name="fact_fee" class="form-control" ng-model="micro.config.fact_fee" readonly>
					</div>
					<div ng-if="micro.config.fact_fee > 0">
						<div class="form-group">
							<label>支付方式</label>
							<table class="table table-hover table-bordered">
								<tr>
									<td>
										<label class="checkbox-inline">余额支付</label>
										<div class="input-group">
											<input type="text" class="form-control js-input" tabindex="2" name="credit2" ng-model="micro.config.credit2"/>
											<span class="input-group-addon">元</span>
										</div>
									</td>
								</tr>
								<tr ng-if="micro.config.card.offset_rate > 0">
									<td>
										<label class="checkbox-inline">积分抵现</label>
										<div class="input-group">
											<span class="input-group-addon">当前积分可抵扣<span>{{micro.config.member.credit1 / micro.config.card.offset_rate | credit1_num}}</span>元,选择抵扣</span>
											<input type="text" tabindex="3" class="form-control js-input" id="offset_money" ng-model="micro.config.offset_money"/>
											<span class="input-group-addon">元</span>
										</div>
									</td>
								</tr>
							</table>
						</div>
						<div class="form-group" ng-if="micro.config.is_showCode == '1'">
							<label>微信需支付</label>
							<div class="input-group">
								<input type="text" name="cash" class="form-control" ng-model="micro.last_money" readonly><span class="input-group-addon">元</span>
							</div>
							<label>刷卡授权码</label>
							<input type="text" name="code" class="form-control js-input" ng-model="micro.config.code" tabindex="4" placeholder="微信刷卡支付授权码(请链接扫码枪扫码)">
						</div>
						<div class="form-group">
							<div ng-show="micro.last_money >= 0">
								应支付<span ng-bind="micro.config.fact_fee"></span>元,余额抵扣<span ng-bind="micro.config.credit2"></span>元,还需支付<span ng-bind="micro.last_money"></span>元.
							</div>
							<div ng-show="micro.last_money < 0">
								超额支付
							</div>
						</div>
					</div>
					</div>
					<div class="form-group text-right" ng-show="micro.config.member.uid > 0">
						<a class="btn btn-primary js-mc-pay" id="micro-submit" ng-click="micro.submit()" ng-disabled="micro.last_money < 0">确认收款</a>
						<a class="btn btn-success" id="micro-query" ng-show="micro.show_query == 1" ng-click="micro.query()">查询支付情况</a>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php  } ?>
</div>
<script>
$(function(){
	var card_set_str = '<?php  echo $card_set_str;?>';
	var card_check_url = '<?php  echo $this->createWeburl('paycenter', array('op' => 'check'))?>';
	var pay_url = '<?php  echo $this->createWeburl('paycenter', array('op' => ''))?>';
	var query_url = '<?php  echo $this->createWeburl('paycenter', array('op' => 'query'))?>';
	var checkpay_url = '<?php  echo $this->createWeburl('paycenter', array('op' => 'checkpay'))?>';
	var redirect_url = '<?php  echo $this->createWeburl('paycenter')?>';
	require({
		paths: {
			'angular-hotkeys' : "<?php  echo MODULE_URL . '/template/style/js/angular-hotkeys'?>",
		}
	});
	require(['angular', 'angular-hotkeys'], function(angular, hotkeys){
		angular.module('app', ['cfp.hotkeys'])
		.filter('credit1_num', function() {
			return function(credit1) {
				credit1 = Math.floor(credit1);
				return credit1;
			}
		})
		.service('servicePaycenterBase', ['$rootScope', function($rootScope) {
			var servicePaycenterBase = {};
			var baseData = {
				config: {
					body: '刷卡支付收款',
					fee: '0',
					cardsn: '',
					card: '',
					credit1: 0,
					credit2: 0,
					last_money: 0,
					offset_money: 0,
					is_showCode: 0,
					loading : '',
					card_error : '',
					member: {
						uid: 0,
						credit2: 0,
					},
					nums : [['7' , '7'], ['8' , '8'], ['9' , '9'], ['4' , '4'], ['5' , '5'], ['6' , '6'], ['1' , '1'], ['2' , '2'], ['3' , '3'], ['0' , '0'], ['.' , '.'], ['clear' , '清除']]
				}
			};

			servicePaycenterBase.paycenterBaseData = function(card) {
				baseData.config.card = card;
				return baseData;
			};

			return servicePaycenterBase;
		}])
		.controller('microPay', ['$scope', '$timeout', '$http', 'hotkeys', 'servicePaycenterBase', function($scope, $timeout, $http, hotkeys, servicePaycenterBase) {
			card = $.parseJSON(card_set_str);
			hotkeys.add({
				combo: 'return+up',
				description: 'Description goes here',
				allowIn: ['INPUT'],
				callback: function(event, hotkey) {
					$scope.micro.submit();
				}
			});
			hotkeys.add({
				combo: 'esc',
				description: 'Description goes here',
				allowIn: ['INPUT'],
				callback: function(event, hotkey) {
					$scope.micro.reset();
				}
			});
			hotkeys.add({
				combo: 'backspace',
				description: 'Description goes here',
				allowIn: ['INPUT'],
				callback: function(event, hotkey) {
					$scope.micro.counter_handler('backspace');
					event.preventDefault();	
				}
			});
			hotkeys.add({
				combo: '-',
				description: 'Description goes here',
				allowIn: ['INPUT'],
				callback: function(event, hotkey) {
					if ($scope.micro.config.fee != '0') {
						$scope.micro.mcardPayManage();
					} else {
						util.message('请输入金额', '', 'error');
					}
				}
			});
			hotkeys.add({
				combo: '+',
				description: 'Description goes here',
				allowIn: ['INPUT'],
				callback: function(event, hotkey) {
					if ($scope.micro.config.fee != '0') {
						$scope.micro.wechatPayManage();
					} else {
						util.message('请输入金额', '', 'error');
					}
				}
			});
			nums = ['7', '8', '9', '4', '5', '6', '1', '2', '3', '0', '.'];
			$scope.micro = servicePaycenterBase.paycenterBaseData(card);

			angular.forEach(nums, function(data, index) {
				hotkeys.add({
					combo: data,
					description: 'Description goes here',
					allowIn: ['INPUT'],
					callback: function(event, hotkey) {
						$scope.micro.counter_handler(event.key);
					}
				});
			});
			$scope.micro.mcardPayManage = function() {
				$('#mcard-pay').on('shown.bs.modal', function () {
					$('.js-input').focus();
					var index = 2;
					hotkeys.add({
						combo: 'return',
						description: 'Description goes here',
						allowIn: ['INPUT'],
						callback: function(event, hotkey) {
							input_count = $scope.micro.input_count();
							if (index > input_count) {
								// index = 1;
								$scope.micro.submit();
							}
							$('input[tabindex="' + index + '"]').focus();
							index++;
						}
					});
					hotkeys.del('backspace');
					angular.forEach(nums, function(data, index) {
						hotkeys.del(data);
					});
				});
				$('#mcard-pay').on('hidden.bs.modal', function () {
					hotkeys.del('return');
					angular.forEach(nums, function(data, index) {
						hotkeys.add({
							combo: data,
							description: 'Description goes here',
							allowIn: ['INPUT'],
							callback: function(event, hotkey) {
								$scope.micro.counter_handler(event.key);
							}
						});
					});
				});
				$('#mcard-pay').modal('show');
			};
			$scope.micro.wechatPayManage = function() {
				$('#wechat-pay').on('shown.bs.modal', function () {
					$('.js-input').focus();
					hotkeys.add({
						combo: 'return',
						description: 'Description goes here',
						allowIn: ['INPUT'],
						callback: function(event, hotkey) {
							$scope.micro.submit();
						}
					});
					hotkeys.del('backspace');
					angular.forEach(nums, function(data, index) {
						hotkeys.del(data);
					});
				}); 

				$('#wechat-pay').on('hidden.bs.modal', function () {
					hotkeys.del('return');
					angular.forEach(nums, function(data, index) {
						hotkeys.add({
							combo: data,
							description: 'Description goes here',
							allowIn: ['INPUT'],
							callback: function(event, hotkey) {
								$scope.micro.counter_handler(event.key);
							}
						});
					});
				});
				$('#wechat-pay').modal('show');
			};
			$scope.micro.num = function(key) {
				$scope.micro.counter_handler(key);
			};
			$scope.$watch('micro.config.code', function(newValue, oldValue) {
				if (newValue && newValue.length > 0) {
					$('.js-pay-warning').html('')
				}
			});
			$scope.micro.counter_handler = function(newValue) {
				newValue += '';
				if (newValue == 'backspace') {
					current_fee_length = $scope.micro.config.fee.length;
					if (current_fee_length == '1') {
						$scope.micro.config.fee = '0';
					} else {
						$scope.micro.config.fee = $scope.micro.config.fee.substr(0, current_fee_length - 1);
					}
					return;
				}
				if (newValue == 'clear') {
					$scope.micro.config.fee = '0';
					return;
				};
				if ($scope.micro.config.fee == '0' && $scope.micro.config.fee.length == '1' && newValue != '.') {
					$scope.micro.config.fee = newValue;
					return;
				};
				if ($scope.micro.config.fee.length >= 9 || ($scope.micro.config.fee.length == 8 && newValue == '.')) {
					return;
				};
				if ($scope.micro.config.fee.indexOf('.') > -1) {
					float = $scope.micro.config.fee.split('.');
					if ((float[1] && float[1].length >= 2) || newValue == '.') {
						return;
					}
				}
				$scope.micro.config.fee += newValue;
			};
			$scope.micro.reset = function() {
				$scope.micro.config.fee = '0';
			};
			$scope.$watch('micro.config.offset_money', function(newValue, oldValue) {
				var offset_max_money = Math.floor($scope.micro.config.member.credit1 / $scope.micro.config.card.offset_rate);
				$scope.micro.config.offset_money = parseInt(newValue);
				if (newValue >= offset_max_money) {
					$scope.micro.config.offset_money = offset_max_money;
				}
				if (!newValue) {
					$scope.micro.config.offset_money = 0;
				}
				$scope.micro.config.credit1 = $scope.micro.config.card.offset_rate * $scope.micro.config.offset_money;
				$scope.micro.checkLast_money();
			});
			$scope.$watch('micro.config.credit2', function(newValue, oldValue) {
				reg = /^\d*\.{0,1}\d{0,1}\d{0,1}$/;
				if (!reg.test(newValue)) {
					$scope.micro.config.credit2 = oldValue;
				}
				if (newValue > $scope.micro.config.member.credit2) {
					$scope.micro.config.credit2 = $scope.micro.config.member.credit2;
				};
				$scope.micro.checkLast_money();
			});
			$scope.$watch('micro.config.last_money', function(newValue, oldValue) {
				if (newValue < 0) {
					$scope.config.last_money = 0;
				};
				$scope.micro.checkLast_money();
			});
			$scope.micro.checkBasic = function() {
				var body = $.trim($scope.micro.config.body);
				if (!body) {
					util.message('商品名称不能为空');
					return false;
				}
				var reg = /^(([1-9]{1}\d*)|([0]{1}))(\.(\d){1,2})?$/;
				var fee = $.trim($scope.micro.config.fee);
				if (!reg.test(fee)) {
					util.message('支付金额不能少于0.01元');
					return false;
				}
			};
			$scope.micro.input_count = function() {
				input_count = $('#mcard-pay input.js-input').length;
				return input_count;
			};
			$scope.$watch('micro.config.cardsn', function(newValue, oldValue) {
				if (newValue.length == 11) {
					$scope.micro.checkCard();
				} else {
					$scope.micro.config.member.uid = -1;
					$scope.micro.config.credit2 = 0;
					if(newValue.length > 11) {
						$scope.micro.config.card_error = '会员卡卡号错误';
					}
				}
			});
			$scope.micro.mcardPay = function(type) {
				if ($scope.micro.config.fee == '0') {
					util.message('请输入金额', '', 'error');
				} else {
					$scope.micro.config.cardsn = '';
					$scope.micro.config.member.uid = -1;
				}
				if (type == '1') {
					$scope.micro.mcardPayManage();
				} else if (type == '2') {
					$scope.micro.wechatPayManage();
				}
				
			};
			$scope.micro.is_showCode = function() {
				var offset_rate = Math.floor($scope.micro.config.member.credit1 / $scope.micro.config.card.offset_rate);
				if ($scope.micro.config.fact_fee <= $scope.micro.config.member.credit2) {
					$scope.micro.config.is_showCode = 0;
				} else {
					if ($scope.micro.config.card.offset_rate > 0) {
						max = $scope.micro.config.fact_fee - $scope.micro.config.member.credit2 - Math.floor($scope.micro.config.member.credit1 / $scope.micro.config.card.offset_rate);
						reg =/^-?[1-9]\d*$/;
						if (max > 0) {
							$scope.micro.config.is_showCode = 1;
						} else if (max ==0) {
							$scope.micro.config.is_showCode = 0;
						} else {
							if (!reg.test(max)) {
								$scope.micro.config.is_showCode = 1;
							} else {
								$scope.micro.config.is_showCode = 0;
							}
						}
					} else {
						max = $scope.micro.config.fact_fee - $scope.micro.config.member.credit2;
						if (max > 0) {
							$scope.micro.config.is_showCode = 1;
						} else {
							$scope.micro.config.is_showCode = 0;
						}
					}
				}
			};
			$scope.micro.checkCard = function() {
				$scope.micro.checkBasic();
				var cardsn = $.trim($scope.micro.config.cardsn);
				if (cardsn.length == 11) {
					$scope.micro.config.loading = '加载中..';
					$scope.micro.config.card_error = '';
					$http.post(card_check_url, {cardsn: cardsn}).success(function(dat){
						$scope.micro.config.loading = '';
						if (dat.message.errno == -1) {
							$scope.micro.config.card_error = dat.message.message;
						} else{
							$scope.micro.config.card_error = '';
							$scope.micro.config.member = dat.message.message;
							$scope.micro.config.fact_fee = $scope.micro.config.fee;
							var fee = parseInt($scope.micro.config.fee);
							var condition = parseInt($scope.micro.config.member.discount.condition);
							if ($scope.micro.config.member.discount_type > 0 && $scope.micro.config.member.discount && (fee >= condition)) {
								if ($scope.micro.config.member.discount_type == 1) {
									$scope.micro.config.fact_fee = $scope.micro.config.fee - $scope.micro.config.member.discount.discount;
								} else {
									$scope.micro.config.fact_fee = $scope.micro.config.fee * $scope.micro.config.member.discount.discount;
								}
								$scope.micro.config.fact_fee = $scope.micro.config.fact_fee.toFixed(2);
								if ($scope.micro.config.fact_fee < 0) {
									$scope.micro.config.fact_fee = 0;
								}
							}
							$scope.micro.last_money = $scope.micro.config.fact_fee;
							$scope.micro.checkCredit2();
							$scope.micro.is_showCode();
							return false;
						}

					});
				} else {
					util.message('卡号不足11位', '', 'error');
					return false;
				}
			};

			$scope.micro.checkCredit2 = function() {
				$scope.micro.checkLast_money();
				$scope.micro.config.credit2 = Math.min.apply(null, [$scope.micro.config.member.credit2, $scope.micro.last_money]);
				$scope.micro.checkLast_money();
			};
			$scope.micro.checkLast_money = function() {
				var last_money = $scope.micro.config.fact_fee - $scope.micro.config.credit2 - $scope.micro.config.offset_money;
				if (last_money < 0) {
					$scope.config.last_money = 0;
				}
				$scope.micro.last_money = last_money.toFixed(2);
			};

			$scope.micro.query = function() {
				if (!$scope.micro.uniontid) {
					util.message('系统错误', '', 'error');
					return false;
				}
				$http.post("<?php  echo url('paycenter/wxmicro/query');?>", {uniontid: $scope.micro.uniontid}).success(function(data) {
					if (data.message.errno == 0) {
						util.message('支付成功', '', 'success');
						location.reload();
					} else {
						util.message('支付失败:' + data.message.message, '', 'error');
					}
				});
			};

			$scope.micro.checkpay = function() {
				$http.post(checkpay_url, {uniontid: $scope.micro.uniontid}).success(function(data){
					if (data.message.trade_state == 'SUCCESS') {
						util.message('支付成功', redirect_url, 'success');
					} else if (data.message.trade_state == 'NOTPAY') {
						util.message('支付失败:用户取消支付', redirect_url, 'error');
					} else if (data.message.trade_state == 'USERPAYING') {
						$timeout(function(){
							$scope.micro.checkpay();
						},5000);
					} else {
						util.message(data.message.trade_state_desc, redirect_url, 'error');
					}
				});
			};
			$scope.micro.submit = function() {
				if (!confirm('确认支付吗?')) {
					return false;
				}
				if ($scope.micro.config.is_showCode == 1 || $scope.micro.config.member.uid <= 0) {
					if (!$.trim($scope.micro.config.code)) {
						$('.js-pay-warning').html('支付授权码不能为空')
						return false;
					}
				}
				if ($scope.micro.config.is_showCode == 1) {
					$scope.micro.config.cash = $scope.micro.last_money;
				} else {
					$scope.micro.config.cash = 0;
				}
				if ($scope.micro.config.member.uid > 0) {
					$scope.micro.checkLast_money();
					if ($scope.micro.last_money - $scope.micro.config.cash != 0) {
						util.message('支付方式设置的支付金额不等于实际支付金额', '', 'error');
						return false;
					}
				}
				$http.post(pay_url, $scope.micro.config).success(function(data){
					if (data.message.errno == 0) {
						util.message(data.message.message, data.redirect, 'success');
					} else if (data.message.errno == -1) {
						util.message('支付失败:' + data.message.message, '', 'error');
						$('#form1 :text[name="code"]').val('');
					} else if(data.message.errno == -10) {
						$('.js-userpaying').show();
						// $scope.micro.show_query = 1;
						$scope.micro.uniontid = data.message.uniontid;
						$timeout(function(){
							$scope.micro.checkpay();
						}, 5000);
					}
					return false;
				});
			}
		}])
		

		angular.bootstrap($('#microPay')[0], ['app']);
	});
});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>