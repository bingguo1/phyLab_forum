<?php /* Smarty version Smarty-3.0.6, created on 2014-02-05 22:18:13
         compiled from "D:\Hosting\11794775\html\useforum/template/green\main_viewforum.html" */ ?>
<?php /*%%SmartyHeaderCode:448552f248256ba314-87062106%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ccd9e78984ca5dd4199bd45eb460f7c282744639' => 
    array (
      0 => 'D:\\Hosting\\11794775\\html\\useforum/template/green\\main_viewforum.html',
      1 => 1391609283,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '448552f248256ba314-87062106',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("header.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('t',$_smarty_tpl->getVariable('info')->value['name']); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<div id="page">
	<div class="post">
			<?php if ($_SESSION['userinfo']['uname']){?>
                <span class="scott" style="text-align: left;font-size: 16px;"><span class="total"><?php echo $_smarty_tpl->getVariable('info')->value['name'];?>
</span>
                <a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'main','a'=>'post','fid'=>$_smarty_tpl->getVariable('info')->value['id']),$_smarty_tpl);?>
">新话题</a></span>
			<?php }else{ ?>
				<p><b><?php echo $_smarty_tpl->getVariable('info')->value['name'];?>
</b>  请<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'main','a'=>'login','backurl'=>$_smarty_tpl->getVariable('currenturl')->value),$_smarty_tpl);?>
">登录</a>后参与或创建话题。
			<?php }?>主题：<?php echo $_smarty_tpl->getVariable('info')->value['topicnum'];?>

            <?php if ($_smarty_tpl->getVariable('info')->value['bm']){?>
                版主：
                <?php  $_smarty_tpl->tpl_vars['bm'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('info')->value['bm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['bm']->key => $_smarty_tpl->tpl_vars['bm']->value){
?>
                    <a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'user','a'=>'profile','uname'=>$_smarty_tpl->tpl_vars['bm']->value['uname']),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->tpl_vars['bm']->value['uname'];?>
</a>
                <?php }} ?>
            <?php }?>
			<a id='rss' href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'rss','a'=>'forum','id'=>$_smarty_tpl->getVariable('info')->value['id']),$_smarty_tpl);?>
">订阅</a></p>
			<?php if ($_smarty_tpl->getVariable('info')->value['rule']){?>
				<p class="signature"><?php echo $_smarty_tpl->getVariable('info')->value['rule'];?>
</p>
			<?php }?>
			<?php if ($_smarty_tpl->getVariable('results')->value||$_smarty_tpl->getVariable('tops')->value){?>
				<table width="100%" class="item_list">
					<thead>
						<th width="600" ><b>标题</b></th>
						<th width="100"><b>作者</b></th>
						<th width="130" class="tdcenter"><b>发布时间</b></th>
						<th width="130" class="tdcenter"><b>最后回复</b></th>
						<th width="39" class="tdcenter" ><b>回复</b></th>
						<th width="59" class="tdcenter" ><b>阅读</b></th>
					</thead>
		<tbody>
		<?php if ($_smarty_tpl->getVariable('pager')->value['current_page']==1||$_smarty_tpl->getVariable('pager')->value['current_page']==null){?>
			<?php  $_smarty_tpl->tpl_vars['top'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('tops')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['top']->key => $_smarty_tpl->tpl_vars['top']->value){
?>
				<tr>
					<td><img src="<?php echo $_smarty_tpl->getVariable('siteurl')->value;?>
/template/green/images/pin.gif" /><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'main','a'=>'view','gid'=>$_smarty_tpl->tpl_vars['top']->value['gid']),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->tpl_vars['top']->value['title'];?>
</a>
					<?php if ($_smarty_tpl->tpl_vars['top']->value['digest']=="1"){?>
					<img src="<?php echo $_smarty_tpl->getVariable('siteurl')->value;?>
/template/green/images/digest_1.gif" class="commonimg"/>
					<?php }?></td>
					<td class="tdcenter"><?php echo tpl_getUrl(array('uname'=>$_smarty_tpl->tpl_vars['top']->value['uname']),$_smarty_tpl);?>
</td>
					<td class="tdcenter"><?php echo tpl_myDate(array('time'=>$_smarty_tpl->tpl_vars['top']->value['ctime']),$_smarty_tpl);?>
</td>
					<td class="tdcenter"><?php echo tpl_myDate(array('time'=>$_smarty_tpl->tpl_vars['top']->value['rtime']),$_smarty_tpl);?>
</td>
					<td class="tdcenter"><?php echo $_smarty_tpl->tpl_vars['top']->value['replynum'];?>
</td>
					<td class="tdcenter">
						<?php echo $_smarty_tpl->tpl_vars['top']->value['view'];?>

						<?php if (("GBADMIN"==$_SESSION['userinfo']['acl'])){?>
							<a href="javascript:void(0);" onclick="delconfirm(<?php echo $_smarty_tpl->tpl_vars['top']->value['gid'];?>
,'<?php echo $_smarty_tpl->tpl_vars['top']->value['title'];?>
');">删除</a>
						<?php }?>
					</td>
				</tr>
			<?php }} ?>
		<?php }?>
		<?php  $_smarty_tpl->tpl_vars['result'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('results')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['result']->key => $_smarty_tpl->tpl_vars['result']->value){
?>
			<tr>
				<td>
				<?php if ($_smarty_tpl->tpl_vars['result']->value['digest']=="1"){?>
				<img src="<?php echo $_smarty_tpl->getVariable('siteurl')->value;?>
/template/green/images/digest_1.gif" class="commonimg"/>
				<?php }?>
				<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'main','a'=>'view','gid'=>$_smarty_tpl->tpl_vars['result']->value['gid']),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->tpl_vars['result']->value['title'];?>
</a></td>
				<td class="tdcenter"><?php echo tpl_getUrl(array('uname'=>$_smarty_tpl->tpl_vars['result']->value['uname']),$_smarty_tpl);?>
</td>
				<td class="tdcenter"><?php echo tpl_myDate(array('time'=>$_smarty_tpl->tpl_vars['result']->value['ctime']),$_smarty_tpl);?>
</td>
				<td class="tdcenter"><?php echo tpl_myDate(array('time'=>$_smarty_tpl->tpl_vars['result']->value['rtime']),$_smarty_tpl);?>
</td>
				<td class="tdcenter"><?php echo $_smarty_tpl->tpl_vars['result']->value['replynum'];?>
</td>
				<td class="tdcenter"><?php echo $_smarty_tpl->tpl_vars['result']->value['view'];?>

					<?php if (("GBADMIN"==$_SESSION['userinfo']['acl'])){?>
						<a href="javascript:void(0);" onclick="delconfirm(<?php echo $_smarty_tpl->tpl_vars['result']->value['gid'];?>
,'<?php echo $_smarty_tpl->tpl_vars['result']->value['title'];?>
');">删除</a>
					<?php }?>
				</td>
			</tr>
		<?php }} ?>
		</tbody>
				</table>
				<?php }else{ ?><p>这里什么都没有……</p><?php }?>
		<div class="scott">
			<p>
				<?php if ($_smarty_tpl->getVariable('pager')->value){?>
                    <?php echo tpl_pager(array('pager'=>$_smarty_tpl->getVariable('pager')->value,'c'=>"main",'a'=>"viewforum",'idname'=>"id",'id'=>$_smarty_tpl->getVariable('info')->value['id']),$_smarty_tpl);?>

                <?php }?>
			</p>
		</div>
	</div>
</div>
<script>
function delconfirm(gid,title){
	if( window.confirm("确定删除“" + title + "”话题？") ){
		window.location = "<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'admin','a'=>'del'),$_smarty_tpl);?>
&gid=" + gid;
	}
}
</script>
<?php $_template = new Smarty_Internal_Template("footer.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>