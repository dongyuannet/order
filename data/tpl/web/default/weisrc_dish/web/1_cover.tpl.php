<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li class="active"><a href="?<?php  echo $_SERVER['QUERY_STRING'];?>"><?php  echo $entry['title'];?></a></li>
</ul>
<style type="text/css">
	.help-block em{display:inline-block;width:10em;font-weight:bold;font-style:normal;}
</style>
<script>
//	require(['angular.sanitize', 'bootstrap', 'underscore', 'util'], function(angular, $, _, util){
//		angular.module('app', ['ngSanitize']).controller('replyForm', function($scope, $http){
//			$scope.reply = {
//				advSetting: false,
//				advTrigger: false,
//				entry: <?php  echo json_encode($reply)?>
//			};
//			$scope.trigger = {};
//			$scope.trigger.descriptions = {};
//			$scope.trigger.descriptions.contains = '用户进行交谈时，对话中包含上述关键字就执行这条规则。';
//			$scope.trigger.descriptions.regexp = '用户进行交谈时，对话内容符合述关键字中定义的模式才会执行这条规则。<br/><strong>注意：如果你不明白正则表达式的工作方式，请不要使用正则匹配</strong> <br/><strong>注意：正则匹配使用MySQL的匹配引擎，请使用MySQL的正则语法</strong> <br /><strong>示例: </strong><br/><em>^微信</em>匹配以“微信”开头的语句<br /><em>微信$</em>匹配以“微信”结尾的语句<br /><em>^微信$</em>匹配等同“微信”的语句<br /><em>微信</em>匹配包含“微信”的语句<br /><em>[0-9\.\-]</em>匹配所有的数字，句号和减号<br /><em>^[a-zA-Z_]$</em>所有的字母和下划线<br /><em>^[[:alpha:]]{3}$</em>所有的3个字母的单词<br /><em>^a{4}$</em>aaaa<br /><em>^a{2,4}$</em>aa，aaa或aaaa<br /><em>^a{2,}$</em>匹配多于两个a的字符串';
//			$scope.trigger.descriptions.trustee = '如果没有比这条回复优先级更高的回复被触发，那么直接使用这条回复。<br/><strong>注意：如果你不明白这个机制的工作方式，请不要使用直接接管</strong>';
//			$scope.trigger.labels = {};
//			$scope.trigger.labels.contains = '包含关键字';
//			$scope.trigger.labels.regexp = '正则表达式模式';
//			$scope.trigger.labels.trustee = '直接接管操作';
//			$scope.trigger.active = 'contains';
//			$scope.trigger.items = {};
//			$scope.trigger.items.default = '';
//			$scope.trigger.items.contains = [];
//			$scope.trigger.items.regexp = [];
//			$scope.trigger.items.trustee = [];
//			if($scope.reply.entry.length != 0) {
//				$scope.reply.entry.istop = $scope.reply.entry.displayorder >= 255 ? 1 : 0;
//				$scope.reply.advSetting = $scope.reply.entry.displayorder!=0 || !$scope.reply.entry.status;
//				if($scope.reply.entry.keywords) {
//					angular.forEach($scope.reply.entry.keywords, function(v, k){
//						if(v.type == '1') {
//							this.default += (v.content + ',');
//						}
//						if(v.type == '2') {
//							this.contains.push({content: v.content, label: '请输入' + $scope.trigger.labels.contains, saved: true});
//						}
//						if(v.type == '3') {
//							this.regexp.push({content: v.content, label: '请输入' + $scope.trigger.labels.regexp, saved: true});
//						}
//						if(v.type == '4') {
//							this.trustee.push({});
//						}
//					}, $scope.trigger.items);
//					if($scope.trigger.items.default.length > 1) {
//						$scope.trigger.items.default = $scope.trigger.items.default.slice(0, $scope.trigger.items.default.length - 1);
//					}
//					if($scope.trigger.items.contains.length > 0 || $scope.trigger.items.regexp.length > 0 || $scope.trigger.items.trustee.length > 0) {
//						$scope.reply.advTrigger = true;
//					}
//					if($scope.trigger.items.contains.length > 0) {
//						$('a[data-toggle="tab"]').eq(0).tab('show');
//					} else if($scope.trigger.items.regexp.length > 0) {
//						$('a[data-toggle="tab"]').eq(1).tab('show');
//					} else if($scope.trigger.items.trustee.length > 0) {
//						$('a[data-toggle="tab"]').eq(2).tab('show');
//					}
//				}
//			}
//			$scope.trigger.addItem = function(){
//				var type = $scope.trigger.active;
//				if(type != 'trustee') {
//					$scope.trigger.items[type].push({content: '', label: '请输入' + $scope.trigger.labels[type], saved: false});
//				} else {
//					if($scope.trigger.items.trustee.length == 0) {
//						$scope.trigger.items.trustee.push({});
//					}
//				}
//			};
//			$scope.trigger.saveItem = function(item){
//				item.saved = !item.saved;
//			};
//			$scope.trigger.removeItem = function(item) {
//				var type = $scope.trigger.active;
//				$scope.trigger.items[type] = _.without($scope.trigger.items[type], item);
//				$scope.$digest();
//			}
//			if($.isFunction(window.initReplyController)) {
//				window.initReplyController($scope, $http);
//			}
//			$('#reply-form').submit(function(){
//				var val = [];
//				$scope.$digest();
//				if($scope.trigger.items.default != '') {
//					var kws = $scope.trigger.items.default.split(',');
//					kws = _.union(kws);
//					angular.forEach(kws, function(v){
//						if(v != '') {
//							val.push({type: 1, content: v});
//						}
//					}, val);
//				}
//				angular.forEach($scope.trigger.items, function(v, name){
//					if(name != 'default' && v.length > 0) {
//						angular.forEach(v, function(value){
//							var o = {};
//							switch(name) {
//								case 'contains':
//									o.type = 2;
//									break;
//								case 'regexp':
//									o.type = 3;
//									break;
//								case 'trustee':
//									o.type = 4;
//									break;
//							}
//							if(name != 'trustee') {
//								o.content = value.content;
//							}
//							this.push(o);
//						}, val);
//					}
//				}, val);
//				if(val.length == 0) {
//					util.message('请输入有效的触发关键字.');
//					return false;
//				}
//				$scope.$digest();
//				val = angular.toJson(val);
//				$(':hidden[name=keywords]').val(val);
//
//				if($.isFunction(window.validateReplyForm)) {
//					return window.validateReplyForm(this, $, _, util, $scope, $http);
//				}
//				return false;
//			});
//			$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
//				$scope.trigger.active = e.target.hash.replace(/#/, '');
//				$scope.$digest();
//			})
//		}).filter('nl2br', function($sce){
//			return function(text) {
//				return text ? $sce.trustAsHtml(text.replace(/\n/g, '<br/>')) : '';
//			};
//		}).directive('ngInvoker', function($parse){
//			return function (scope, element, attr) {
//				scope.$eval(attr.ngInvoker);
//			};
//		});
//		angular.bootstrap(document, ['app']);
//	});
	$(function() {
		require(['jquery.qrcode'], function(){
			url = $('input[name="url_show"]').val();
			$('.js-qrcode-show').show();
			$('.qrcode-block').html('').qrcode({
				render: 'canvas',
				width: 150,
				height: 150,
				text: url
			});
		})
	})
</script>
<style>
	.bs-callout-danger{
		border-left-color: #ce4844;
	}
	.bs-callout-danger h4 {
		color: #ce4844
	}
	.bs-callout{
		padding: 20px;
		padding-bottom: 5px;
		margin-bottom: 20px;
		border: 1px solid #eee;
		border-left-width: 5px;
		border-radius: 3px;
		background-color: white;
	}
	.bs-callout h4 {
		margin-top: 0;
		margin-bottom: 5px
	}

</style>
<div class="clearfix" ng-controller="replyForm">
	<div class="bs-callout bs-callout-danger" id="callout-glyphicons-empty-only">
		<h4><?php  echo $entry['title'];?>设置</h4>
		<p>如果你有oAuth权限也可以直接设置自定义菜单到指定链接位置.</p>
	</div>
	<form id="reply-form" class="form-horizontal form" action="?<?php  echo $_SERVER['QUERY_STRING'];?>" method="post" enctype="multipart/form-data">
		<div class="panel panel-default">
			<div class="panel-heading">
				直接链接 <span class="text-muted">直接进入的URL</span>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">直接URL</label>
					<div class="col-sm-9 col-xs-12 ">
						<input type="text" class="form-control" readonly="readonly" name="url_show" value="<?php  echo $entry['url_show'];?>" />
						<span class="help-block">
							<strong>直接指向到入口的URL。您可以在自定义菜单（有oAuth权限）或是其它位置直接使用。</strong>
						</span>
					</div>

				</div>
				<div class="form-group js-qrcode-show">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">二维码</label>
					<div class="col-sm-9 col-xs-12 ">
						<div class="qrcode-block" style="margin-top:20px"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				功能封面 <span class="text-muted"><?php  echo $entry['title'];?></span>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">封面名称</label>
					<div class="col-sm-6 col-xs-12">
						<input type="text" class="form-control" readonly="readonly" value="<?php  echo $entry['title'];?>" />
					</div>
					<div class="col-sm-3">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">触发关键字</label>
					<div class="col-sm-6 col-xs-12">
						<input type="text" class="form-control" placeholder="请输入触发关键字" name="keywords" value="<?php  echo $reply['keywords'][0]['content'];?>"/>
					</div>
					<div class="col-sm-3">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">封面参数</label>
					<div class="col-sm-9">
						<div class="panel panel-default reply-container" style="padding-top:2em;">
							<div ng-hide="entry.saved">
								<div class="form-group">
									<label class="col-xs-12 col-sm-3 col-md-2 control-label">标题</label>
									<div class="col-sm-9 col-xs-12">
										<input type="text" class="form-control" placeholder="标题" name="title" value="<?php  echo $cover['title'];?>"/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-12 col-sm-3 col-md-2 control-label">封面</label>
									<div class="col-sm-9 col-xs-12">
										<?php  echo tpl_form_field_image('thumb', $cover['src'], '', array('width' => 400));?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-12 col-sm-3 col-md-2 control-label">描述</label>
									<div class="col-sm-9 col-xs-12">
										<textarea class="form-control" placeholder="添加图文消息的简短描述" name="description" ></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-12 col-sm-3 col-md-2 control-label">直接URL</label>
									<div class="col-sm-9 col-xs-12">
										<p class="form-control-static" style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis;"><?php  echo $entry['url_show'];?></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-12">
				<input name="submit" type="submit" value="保存" class="btn btn-primary" />
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
			</div>
		</div>
	</form>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/footer', TEMPLATE_INCLUDEPATH)) : (include template('public/footer', TEMPLATE_INCLUDEPATH));?>