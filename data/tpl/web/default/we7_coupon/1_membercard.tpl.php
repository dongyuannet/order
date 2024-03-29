<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<link href="./resource/css/app.css" rel="stylesheet">
<ul class="nav nav-tabs">
	<li class="active"><a href="javascript:;">会员卡设置</a></li>
</ul>
<div class="alert alert-info">
	<div>
		<i class="fa fa-info-circle"></i>
		会员在进行余额充值，会员组变更，会员积分变更，会员卡计次充值，会员卡计时充值等操作时，系统会进行微信模板消息通知。<a href="<?php  echo url('mc/tplnotice');?>">设置模板消息</a>
	</div>
	<div>
		<i class="fa fa-info-circle"></i>
		开启会员卡功能后,请先对会员卡进行设置,然后提交保存.
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		是否启用会员卡：
		<input type="checkbox" name="flag" value="1" class="hidden" <?php  if(intval($setting['status'])==1) { ?> checked="checked" <?php  } ?> data="<?php  echo $setting['id'];?>"/>
	</div>
</div>
<?php  if(empty($setting) || $setting['status'] == 1) { ?>
<form action="" method="post">
	<div class="usercard shopNav" ng-controller="MainCtrl">
		<div class="app clearfix">
			<input type="hidden" name="wapeditor[params]" id="wapeditor-params" value="{{submit.params}}" />
			<input type="hidden" name="wapeditor[html]" id="wapeditor-html" value="{{submit.html}}" />
			<div class="app-preview">
				<div class="app-header"></div>
				<div class="app-content">
					<div class="system-card">
						<div class="inner">
							<div class="clearfix">
								<div ng-if="module['id'] && module['id'] == 'cardBasic'" id="module-{{module.index}}" name="{{module.id}}" index="{{module.index}}" ng-class="{'modules-actions': activeItem.index == module.index, 'js-sorttable' : !module.issystem}" ng-repeat="module in activeModules | orderBy:'displayorder'"  ng-style="{'border' : module.issystem ? 'none' : ''}">
									<div ng-init="displayPanel = ('widget-'+(module['id'].toLowerCase())+'-display.html')" ng-include="displayPanel" ng-click="editItem(module.id)"></div>
									<!--自定义模块编辑部分-->
									<div class="text-right action-wrap">
										<span class="label-default action edit" ng-click="editItem(module.id)">编辑</span>
										<!--span class="label-default action app-add">加内容</span-->
										<span class="label-default action remove" data-container="body" data-toggle="popover" data-placement="left" ng-click="deleteItem(module.index)">删除</span>
									</div>
								</div>
								<div ng-if="module['id'] && module['id'] != 'cardBasic' && module['issystem']" id="module-{{module.index}}" name="{{module.id}}" index="{{module.index}}" ng-class="{'modules-actions': activeItem.index == module.index, 'js-sorttable' : true}" ng-repeat="module in activeModules | orderBy:'displayorder'">
									<div ng-init="displayPanel = ('widget-'+(module['id'].toLowerCase())+'-display.html')" ng-include="displayPanel" ng-click="editItem(module.id)"></div>
									<!--自定义模块编辑部分-->
									<div class="text-right action-wrap">
										<span class="label-default action edit" ng-click="editItem(module.id)">编辑</span>
										<!--span class="label-default action app-add">加内容</span-->
										<span class="label-default action remove" data-container="body" data-toggle="popover" data-placement="left" ng-click="deleteItem(module.index)" ng-if="module['id'] != 'cardActivity' && module['id'] != 'cardNums' && module['id'] != 'cardTimes'">删除</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="app-side">
				<div ng-init="editorPanel = ('widget-'+(editorid.toLowerCase())+'-editor.html'.toLowerCase())" ng-show="activeItem.id == editorid" ng-repeat="editorid in editors" test="{{editorPanel}}" ng-include="editorPanel" id="editor{{editorid}}" class="editor"></div>
			</div>
			<div class="shop-preview col-xs-12 col-sm-9 col-lg-10">
				<div class="text-center alert alert-warning">
					<button type="submit" class="btn btn-primary js-editor-submit single-submit">上架</button>
				</div>
			</div>
		</div>
	</div>
</form>
<?php  } ?>
<?php  echo tpl_ueditor('')?>
<script type="text/javascript">
	$(function(){
		$('.app-preview').click(function(){
			return false;
		});
		require(['underscore', 'bootstrap.switch'], function() {
			$(":checkbox[name='flag']").bootstrapSwitch();
			$(':checkbox').on('switchChange.bootstrapSwitch', function(e, state){
				$this = $(this);
				var status = this.checked ? 1 : 0;
				$.post("<?php  echo $this->createWeburl('membercard', array('op' => 'cardstatus'));?>", {status:status}, function(resp){
					resp = $.parseJSON(resp);
					if(resp.message.errno != 0) {
						util.message('操作失败, 请稍后重试.')
					} else {
						util.message('操作成功', location.href, 'success');
					}
				});
			});
			var newcard = false;
			var creditnames = {'credit1' : '<?php  echo $unisetting['creditnames']['credit1']['title'];?>', 'credit2' : '<?php  echo $unisetting['creditnames']['credit2']['title'];?>'};
			var activeModules = <?php echo !empty($setting['params']) ? $setting['params'] : 'null'?>;
			var fansFields = <?php  echo json_encode($fields);?>;
			var discounts = <?php  echo json_encode($discounts);?>;
			var siteroot = "<?php  echo $_W['siteroot']?>";
			angular.module('userCardApp').value('config',{ 
				'newcard' : newcard,
				'creditnames' : creditnames,
				'activeModules' : activeModules,
				'fansFields' : fansFields,
				'discounts' : discounts,
				'siteroot' : siteroot
			});
			angular.bootstrap($('.usercard'), ['userCardApp']);
		});
		$('.modules').click(function(){
			return false;
		});
		util.coupon = function(callback, options) {
			var opts = {
				type :'all',
				multiple :true 
			};
			opts = $.extend({}, opts, options);
			require({
				paths: {
					'coupon': "<?php  echo $_W['siteroot'] . '/addons/we7_coupon/template/style/js/coupon'?>"
				}
			})
			require(['coupon'], function(coupon){
				coupon.init(function(coupons){
					if(coupons){
						if($.isFunction(callback)){
							callback(coupons);
						}
					}
				}, opts);
			});
		};
	});
</script>


<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>