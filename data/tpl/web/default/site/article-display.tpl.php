<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="we7-page-title">微官网</div>
<ul class="we7-page-tab">
	<li><a href="<?php  echo url('site/multi')?>">微官网列表</a></li>
	<li><a href="<?php  echo url('site/style')?>">微官网模板</a></li>
	<li class="active"><a href="<?php  echo url('site/article')?>">文章管理</a></li>
	<li><a href="<?php  echo url('site/category')?>">文章分类管理</a></li>
</ul>
<div id="js-wesite-article-display" ng-controller="wesiteArticleDisplay" ng-cloak>
	<div class="we7-page-search we7-padding-bottom clearfix">
		<div class="pull-right">
			<a href="<?php  echo url('site/article/post')?>" class="btn btn-primary we7-padding-horizontal">+新建文章</a>
		</div>
		<form action="./index.php" method="get" class="form-inline" role="form">
			<input type="hidden" name="a" value="article" />
			<input type="hidden" name="c" value="site" />
			<input type="hidden" name="do" value="display" />
			<div class="form-group">
				<?php  echo tpl_form_field_category_2level('category', $parent, $children, $_GPC['category']['parentid'], $_GPC['category']['childid']);?>
			</div>
			<div class="input-group we7-padding-left col-sm-5">
				<input class="form-control" name="keyword" id="" type="text" value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入标题名">
				<span class="input-group-btn"><button class="btn btn-default"><i class="fa fa-search"></i></button></span>
			</div>
		</form>
	</div>
	<form action="./index.php?c=site&a=article&do=del" method="post" class="we7-form" role="form">
		<div class="panel we7-panel article-list-panel">
			<div class="panel-heading ">
				是否开启留言功能
				<span ng-class="setting.comment_status == 1 ? 'switch switchOn' : 'switch'" ng-click="comment()"></span>
			</div>
			<div class="panel-body">
				<table class="table we7-table table-hover article-list vertical-middle">
					<col width="80px">
					<col width="70px"/>
					<col />
					<col width="120px"/>
					<col width="270px"/>
					<tr>
						<th></th>
						<th>排序</th>
						<th class="text-left">标题</th>
						<th>属性</th>
						<th class="text-right">操作</th>
					</tr>
					<tr ng-if="!articleList">
						<td colspan="5" class="text-center">暂无数据</td>
					</tr>
					<tr ng-repeat="article in articleList" ng-if="articleList">
						<td>
							<input type="checkbox" we7-check-all="1" name="rid[]" id="rid-{{article.id}}" value="{{article.id}}">
							<label for="rid-{{article.id}}">&nbsp;</label>
						</td>
						<td ng-bind="article.displayorder"></td>
						<td class="text-left" ng-bind="article.title" style="text-overflow:ellipsis; white-space: nowrap;"></td>
						<td>
							<span class="label label-primary" ng-if="article.ishot == 1">头条</span>
							<span class="label label-primary" ng-if="article.iscommend == 1">推荐</span>
						</td>
						<td>
							<div class="link-group">
								<a class="article-list-reply" ng-if="article.count" ng-href="{{commentListLink}}id={{article.id}}">查看留言</a>
								<a  ng-if="!article.count" ng-href="{{commentListLink}}id={{article.id}}">查看留言</a>
								<a href="javascript:;" id="copy-{{article.id}}" clipboard supported="supported" text="article.link" on-copied="success(article.id)">复制链接</a>
								<a href="javascript:;" ng-click="editArticle(article.id)">编辑</a>
								<a href="javascript:;" class="del" ng-click="delArticle(article.id)">删除</a>
							</div>
						</td>
					</tr>
				</table>
			</div>
		<div class="pull-left we7-margin-top">
			<input type="checkbox" we7-check-all="1" name="rid[]" id="select_all" value="1" ng-style="{'margin-left': '30px'}">
			<label for="select_all">&nbsp;</label>
			<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
			<input type="submit" class="btn btn-danger" name="submit" value="删除" onclick="if(!confirm('确定删除选中的规则吗？')) return false;"/>
		</div>
		<div class="text-right we7-margin-top">
			<?php  echo $pager;?>
		</div>
	</form>
</div>
<script>
	$('#select_all').click(function(){
		$('.article-list :checkbox').prop('checked', $(this).prop('checked'));
	});
	angular.module('wesiteApp').value('config', {
		category: <?php echo !empty($category) ? json_encode($category) : 'null'?>,
		articleList: <?php echo !empty($list) ? json_encode($list) : 'null'?>,
		articleComment: <?php echo !empty($article_comment) ? json_encode($article_comment) : 'null'?>,
		setting: <?php echo !empty($setting) ? json_encode($setting) : 'null'?>,
		copyCommonLink: "<?php  echo murl('site/site/detail', array('id' => ''), true, true)?>",
		commentListLink: "<?php  echo url('site/comment/display')?>",
		commentLink: "<?php  echo url('site/comment/change_status')?>"
	});
	angular.bootstrap($('#js-wesite-article-display'), ['wesiteApp']);	
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>