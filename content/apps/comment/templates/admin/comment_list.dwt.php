<?php defined('IN_ECJIA') or exit('No permission resources.');?>
<!--{extends file="ecjia.dwt.php"} -->

<!-- {block name="footer"} -->
<script type="text/javascript">
	ecjia.admin.comment_manage.init();
</script>
<!-- {/block} -->

<!-- {block name="main_content"} -->
<div>
	<h3 class="heading">
		<!-- {if $ur_here}{$ur_here}{/if} -->
	</h3>
</div>
<div class="nav-heading">
	<ul class="nav-status">
		<li><span>{t domain="comment"}全部{/t}</span></li>
		<!-- {if ($select_status)} -->
		<li class="hide-status"><span>></span></li>
		<li class="hide-status"><a class="data-pjax btn no-show-status" href='{url path="comment/admin/init" args="{if $smarty.get.rank neq null}&rank={$smarty.get.rank}{/if}{if $smarty.get.has_img neq null}&has_img={$smarty.get.has_img}{/if}{if $select_rank}&select_rank={$select_rank}{/if} {if $select_img}&select_img={$select_img}{/if}"}' style="padding:3px 5px;">
			{if $smarty.get.status eq 0}{t domain="comment"}待审核{/t}{else}{t domain="comment"}已批准{/t}{/if}
			<i class=" close-status fontello-icon-cancel cursor_pointer"></i></a>
		</li>
		<!-- {/if} -->
		<!-- {if $select_rank} -->
		<li class="hide-rank"><span>></span></li>
		<li class="hide-rank"><a class="data-pjax btn no-show-rank" href='{url path="comment/admin/init" args="{if $smarty.get.status neq null}&status={$smarty.get.status}{/if}{if $smarty.get.has_img neq null}&has_img={$smarty.get.has_img}{/if}{if $select_status}&select_status={$select_status}{/if}{if $select_img}&select_img={$select_img}{/if}"}' style="padding:3px 5px;">
			{if $smarty.get.rank eq 1}好评{elseif $smarty.get.rank eq 2} {t domain="comment"}中评{/t} {elseif $smarty.get.rank eq 3}{t domain="comment"}差评{/t}{/if}
			<i class=" close-status fontello-icon-cancel cursor_pointer"></i></a>
		</li>
		<!-- {/if} -->
		<!-- {if $select_img} -->
		<li class="hide-img"><span>></span></li>
		<li class="hide-img"><a class="data-pjax btn no-show-img" href='{url path="comment/admin/init" args="{if $smarty.get.status neq null}&status={$smarty.get.status}{/if}{if $smarty.get.rank neq null}&rank={$smarty.get.rank}{/if}{if $select_rank}&select_rank={$select_rank}{/if}{if $select_status}&select_status={$select_status}{/if}"}' style="padding:3px 5px;">{if $smarty.get.has_img eq 1}{t domain="comment"}有图{/t} {else}{t domain="comment"}无图{/t}{/if}
			<i class=" close-status fontello-icon-cancel cursor_pointer"></i></a>
		</li>
		<!-- {/if} -->
	</ul>
	<div class="trash-btn">
		<a class="btn plus_or_reply data-pjax" href="{$action_link.href}" id="sticky_a">
			<i class=""></i>{$action_link.text}
		</a>
	</div>
</div>
<div class="heading-table">
	<table class="table table-oddtd table-bordered">
		<tr>
			<td class="status-td" style="text-align:right; width:9%;">{t domain="comment"}审核状态：{/t}</td>
			<td>
				<div class="status-distance"><a class="data-pjax" href='{url path="comment/admin/init" args="status=0&select_status=1{if $smarty.get.select_rank}&select_rank={$smarty.get.select_rank}{/if}{if $smarty.get.select_img}&select_img={$smarty.get.select_img}{/if}{if $smarty.get.rank neq null}&rank={$smarty.get.rank}{/if}{if $smarty.get.has_img neq null}&has_img={$smarty.get.has_img}{/if}{if $smarty.get.keywords}&keywords={$smarty.get.keywords}{/if}"}'>{t domain="comment"}待审核{/t}</a></div>
				<div class="status-distance"><a class="data-pjax" href='{url path="comment/admin/init" args="status=1&select_status=1{if $smarty.get.select_rank}&select_rank={$smarty.get.select_rank}{/if}{if $smarty.get.select_img}&select_img={$smarty.get.select_img}{/if}{if $smarty.get.rank neq null}&rank={$smarty.get.rank}{/if}{if $smarty.get.has_img neq null}&has_img={$smarty.get.has_img}{/if}{if $smarty.get.keywords}&keywords={$smarty.get.keywords}{/if}"}'>{t domain="comment"}已批准{/t}</a></div>
			</td>
		</tr>
		<tr>
			<td class="status-td" style="text-align:right; width:9%;">{t domain="comment"}评分级别：{/t}</td>
			<td>
				<div class="status-distance"><a class="data-pjax" href='{url path="comment/admin/init" args="rank=1&select_rank=2{if $smarty.get.select_status}&select_status={$smarty.get.select_status}{/if}{if $smarty.get.select_img}&select_img={$smarty.get.select_img}{/if}{if $smarty.get.status neq null}&status={$smarty.get.status}{/if}{if $smarty.get.has_img neq null}&has_img={$smarty.get.has_img}{/if}{if $smarty.get.keywords}&keywords={$smarty.get.keywords}{/if}"}'>{t domain="comment"}好评{/t}</a></div>
				<div class="status-distance"><a class="data-pjax" href='{url path="comment/admin/init" args="rank=2&select_rank=2{if $smarty.get.select_status}&select_status={$smarty.get.select_status}{/if}{if $smarty.get.select_img}&select_img={$smarty.get.select_img}{/if}{if $smarty.get.status neq null}&status={$smarty.get.status}{/if}{if $smarty.get.has_img neq null}&has_img={$smarty.get.has_img}{/if}{if $smarty.get.keywords}&keywords={$smarty.get.keywords}{/if}"}'>{t domain="comment"}中评{/t}</a></div>
				<div class="status-distance"><a class="data-pjax" href='{url path="comment/admin/init" args="rank=3&select_rank=2{if $smarty.get.select_status}&select_status={$smarty.get.select_status}{/if}{if $smarty.get.select_img}&select_img={$smarty.get.select_img}{/if}{if $smarty.get.status neq null}&status={$smarty.get.status}{/if}{if $smarty.get.has_img neq null}&has_img={$smarty.get.has_img}{/if}{if $smarty.get.keywords}&keywords={$smarty.get.keywords}{/if}"}'>{t domain="comment"}差评{/t}</a></div>
			</td>
		</tr>
		<tr>
			<td class="status-td" style="text-align:right; width:9%;">{t domain="comment"}有无晒图：{/t}</td>
			<td>
				<div class="status-distance"><a class="data-pjax" href='{url path="comment/admin/init" args="has_img=1&select_img=3{if $smarty.get.select_status}&select_status={$smarty.get.select_status}{/if}{if $smarty.get.select_rank}&select_rank={$smarty.get.select_rank}{/if}{if $smarty.get.status neq null}&status={$smarty.get.status}{/if}{if $smarty.get.rank neq null}&rank={$smarty.get.rank}{/if}{if $smarty.get.keywords}&keywords={$smarty.get.keywords}{/if}"}'>{t domain="comment"}有{/t}</a></div>
				<div class="status-distance"><a class="data-pjax" href='{url path="comment/admin/init" args="has_img=0&select_img=3{if $smarty.get.select_status}&select_status={$smarty.get.select_status}{/if}{if $smarty.get.select_rank}&select_rank={$smarty.get.select_rank}{/if}{if $smarty.get.status neq null}&status={$smarty.get.status}{/if}{if $smarty.get.rank neq null}&rank={$smarty.get.rank}{/if}{if $smarty.get.keywords}&keywords={$smarty.get.keywords}{/if}"}'>{t domain="comment"}无{/t}</a></div>
			</td>
		</tr>
	</table>
</div>

<div class="row-fluid batch">
	<div class="btn-group f_l m_r5 row-batch">
		<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
			<i class="fontello-icon-cog"></i>{t domain="comment"}批量操作{/t}
			<span class="caret"></span>
		</a>
		<ul class="dropdown-menu">
			<!-- {if $comment_list.filter.status neq null && $comment_list.filter.status neq 1} -->
				<li><a class="batch-sale-btn"  data-toggle="ecjiabatch" data-idClass=".checkbox:checked" data-url="{$form_action}&sel_action=allow&status={$comment_list.filter.status}&page={$smarty.get.page}" data-msg="{t domain="comment"}您确定要批量允许显示选中的评论吗？{/t}" data-noSelectMsg="{t domain="comment"}请选择需要操作的评论{/t}}" href="javascript:;"><i class="fontello-icon-eye"></i>{t domain="comment"}允许显示{/t}</a></li>
			<!--{/if} -->
			<!-- {if $comment_list.filter.status eq 1} -->
				<li><a class="batch-notsale-btn" data-toggle="ecjiabatch" data-idClass=".checkbox:checked" data-url="{$form_action}&sel_action=deny&status={$comment_list.filter.status}&page={$smarty.get.page}" data-msg="{t domain="comment"}您确定要批量禁止显示选中的评论吗？{/t}" data-noSelectMsg="{t domain="comment"}请选择需要操作的评论{/t}}"  href="javascript:;"><i class="fontello-icon-eye-off"></i>{t domain="comment"}禁止显示{/t}</a></li>
			<!-- {/if} -->
			<li><a data-toggle="ecjiabatch" data-idClass=".checkbox:checked" data-url="{$form_action}&sel_action=trashed_comment{if $comment_list.filter.status neq null}&status={$comment_list.filter.status}{/if}&page={$smarty.get.page}" data-msg="{t domain="comment"}您确定要批量将选中的评论移至回收站吗？{/t}" data-noSelectMsg="{t domain="comment"}请选择需要操作的评论{/t}}"  href="javascript:;"><i class="fontello-icon-box"></i>{t domain="comment"}移至回收站{/t}</a></li>
		</ul>
	</div>
	<div class="choose_list f_r" >
		<form class="f_r form-inline" action="{RC_Uri::url('comment/admin/init')}{if $comment_list.filter.status neq null}&status={$comment_list.filter.status}{/if}{if $comment_list.filter.has_img neq null}&has_img={$comment_list.filter.has_img}{/if}{if $smarty.get.rank}&rank={$smarty.get.rank}{/if}{if $select_status}&select_status={$select_status}{/if}{if $select_rank}&select_rank={$select_rank}{/if}{if $select_img}&select_img={$select_img}{/if}"  method="post" name="searchForm">
			<input type="text" name="keyword" value="{$smarty.get.keywords}" placeholder='{t domain="comment"}输入评价关键词进行搜索{/t}' size="15" />
			<button class="btn search_comment" type="button">{t domain="comment"}搜索{/t}</button>
		</form>
	</div>
</div>

<div class="row-fluid list-page">
	<div class="span12">
		<table class="table table-striped smpl_tbl table-hide-edit">
			<thead>
				<tr>
					<th class="table_checkbox w50">
						<input class="uni_style" type="checkbox" data-toggle="selectall" data-children=".checkbox"/>
					</th>
					<th class="w100">{t domain="comment"}用户名{/t}</th>
					<th class='w100'>{t domain="comment"}商家名称{/t}</th>
					<th>{t domain="comment"}商品详情{/t}</th>
					<th class="w150">{t domain="comment"}星级{/t}</th>
				</tr>
			</thead>
			<tbody>
				<!-- {foreach from=$comment_list.item item=comment} -->
				<tr>
					<td><input class="checkbox" type="checkbox" name="checkboxes[]" value="{$comment.comment_id}"></td>
					<td>
						{if $comment.user_name}
							{$comment.user_name}
						{else}
							{t domain="comment"}匿名用户{/t}
						{/if}
					</td>
					<td>
						{$comment.merchants_name}
					</td>
					<td class="hide-edit-area">
						<div><a href='{url path="goods/admin/edit" args="goods_id={$comment.id_value}"}' target="_blank">{$comment.goods_name}</a></div>
						<div>{t domain="comment"}评论于{/t}&nbsp;&nbsp;{$comment.add_time}</div>
						<div>{$comment.content|truncate:100|escape:html}</div>
						{if $comment.has_image eq 1}
							{if $comment.imgs}
								<!-- {foreach from=$comment.imgs item=img_list} -->
										<img style="margin-right:8px;margin-top:10px;width:75px;height:75px;" alt="" src="{$img_list.file_path}">
								<!-- {/foreach} -->
							{/if}
						{/if}
						<div class="edit-list">
						    {if $comment.status lt 2}
								<a class="toggle_view" href='{url path="comment/admin/check" args="list=1&comment_id={$comment.comment_id}&status={$comment.status}{if $smarty.get.page}&page={$smarty.get.page}{/if}"}' data-msg='{t domain="comment"}您确定要更改此评论的状态吗？{/t}' data-val="{if $comment.status eq 0}allow{else}forbid{/if}" data-status="{$smarty.get.status}" >
									{if $comment.status eq '0'} {t domain="comment"}批准{/t} {elseif $comment.status eq '1'} <span class="ecjiafc-red">{t domain="comment"}驳回{/t}</span> {/if}
								</a>&nbsp;|&nbsp;
								<a class="data-pjax" href='{url path="comment/admin/reply" args="comment_id={$comment.comment_id}"}'>
									{t domain="comment"}查看及回复{/t}
								</a>&nbsp;|&nbsp;
                            <a class="ecjiafc-red toggle_view" href='{url path="comment/admin/check" args="list=1&comment_id={$comment.comment_id}{if $smarty.get.page}&page={$smarty.get.page}{/if}"}' data-msg='{t domain="comment" 1="{$comment.user_name}"}您确定要将该用户[%1]的评论移至回收站吗？{/t}' data-status="{$smarty.get.status}" data-val="trashed_comment" >{t domain="comment"}移至回收站{/t}</a>
						    {/if}
						</div>
					</td>
					<td>
						{section name=loop loop=$comment.comment_rank}
							<i class="fontello-icon-star" style="color:#FF9933;"></i>
						{/section}
						{section name=loop loop=5-$comment.comment_rank}
							<i class="fontello-icon-star" style="color:#bbb;"></i>
						{/section}
					</td>
				</tr>
				<tr style="border-top:none;">
					<td colspan="5" style="border-top:none;">
						<div style="border-top: 2px dashed #ddd;">
							<input class="form-control small span12" style="width:93%;margin-bottom:3px;margin-top:12px;" value="" name="reply_content" type="text" placeholder='{t domain="comment"}感谢您对本店的支持！我们会更加的努力，为您提供更优质的服务。（可在此输入回复内容，也可选择系统自动回复）{/t}'>
							<input class="btn btn-gebo quick_reply" style="height:36px;margin-top:9px;" type="button" data-url="{url path='comment/admin/quick_reply'}" data-id={$comment.comment_id} data-status={$comment.status} value="回复" />
						</div>
					</td>
				</tr>
				<!-- {foreachelse} -->
				<tr>
					<td class="no-records" colspan="5">{t domain="comment"}没有找到任何记录{/t}</td>
				</tr>
				<!-- {/foreach} -->
			</tbody>
		</table>
		<!-- {$comment_list.page} -->
	</div>
</div>
<!-- {/block} -->