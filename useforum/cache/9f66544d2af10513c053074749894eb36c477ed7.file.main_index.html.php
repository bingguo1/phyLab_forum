<?php /* Smarty version Smarty-3.0.6, created on 2014-02-05 22:18:03
         compiled from "D:\Hosting\11794775\html\useforum/template/green\main_index.html" */ ?>
<?php /*%%SmartyHeaderCode:2662452f2481b4f9b19-91125041%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9f66544d2af10513c053074749894eb36c477ed7' => 
    array (
      0 => 'D:\\Hosting\\11794775\\html\\useforum/template/green\\main_index.html',
      1 => 1391609284,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2662452f2481b4f9b19-91125041',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("header.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
	<div id="page">

<p>话题: <?php echo $_smarty_tpl->getVariable('topicnum')->value;?>
 | 用户: <?php echo $_smarty_tpl->getVariable('user')->value;?>
 | 欢迎新会员<?php echo tpl_getUrl(array('uname'=>$_smarty_tpl->getVariable('newer')->value['uname']),$_smarty_tpl);?>
。
<?php if (''!=$_SESSION['userinfo']['uname']){?>
				欢迎您 <?php echo $_SESSION['userinfo']['uname'];?>
，您可以<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'main','a'=>'post'),$_smarty_tpl);?>
">创建新话题</a>。
<?php }else{ ?>
欢迎您 <?php echo $_SESSION['userinfo']['uname'];?>
，请<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'main','a'=>'login','backurl'=>$_smarty_tpl->getVariable('currenturl')->value),$_smarty_tpl);?>
">登录</a>。
<?php }?>
<a id='rss' href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'rss','a'=>'index'),$_smarty_tpl);?>
">订阅</a></p>
<?php if (0==$_smarty_tpl->getVariable('results')->value){?>
	<p>论坛暂停开放。</p>
<?php }else{ ?>
	<div id="index">
		<table>
			<tbody>
			<?php  $_smarty_tpl->tpl_vars['result'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('results')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['result']->key => $_smarty_tpl->tpl_vars['result']->value){
?>
				<tr>
					<td width="100px" id="vcenter" >
					  <?php if ($_smarty_tpl->tpl_vars['result']->value['icon']){?> <a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'main','a'=>'viewforum','id'=>$_smarty_tpl->tpl_vars['result']->value['id']),$_smarty_tpl);?>
"><img src ="<?php echo $_smarty_tpl->tpl_vars['result']->value['icon'];?>
" style="max-height:100px;max-width:100px"align="left"/></a>
					<?php }?>
					</td>
					<td width="50%">
						<h2 class="title"><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'main','a'=>'viewforum','id'=>$_smarty_tpl->tpl_vars['result']->value['id']),$_smarty_tpl);?>
"><span style=" color:<?php echo $_smarty_tpl->tpl_vars['result']->value['color'];?>
;"><?php echo $_smarty_tpl->tpl_vars['result']->value['name'];?>
</span></a></h2>
						<p style="margin-bottom: 0;"> <?php echo $_smarty_tpl->tpl_vars['result']->value['instruc'];?>
</p>
					</td>
					<td width="10%" >
						<p id="vcenter">
							<?php echo $_smarty_tpl->tpl_vars['result']->value['topicnum'];?>

						</p>
					</td>
					<td width="40%">
					<?php if ($_smarty_tpl->tpl_vars['result']->value['newpost'][0]['title']){?><p>
						<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'main','a'=>'view','gid'=>$_smarty_tpl->tpl_vars['result']->value['newpost'][0]['gid']),$_smarty_tpl);?>
"><?php echo tpl_cutString(array('str'=>$_smarty_tpl->tpl_vars['result']->value['newpost'][0]['title'],'length'=>20),$_smarty_tpl);?>
</a>
                        <?php echo tpl_myDate(array('time'=>$_smarty_tpl->tpl_vars['result']->value['newpost'][0]['rtime']),$_smarty_tpl);?>
</p>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['result']->value['bm']){?>
                        <p  style="margin-bottom: 0;">版主：
                            <?php  $_smarty_tpl->tpl_vars['bm'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['result']->value['bm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['bm']->key => $_smarty_tpl->tpl_vars['bm']->value){
?>
                                <?php echo tpl_getUrl(array('uname'=>$_smarty_tpl->tpl_vars['bm']->value['uname']),$_smarty_tpl);?>

                            <?php }} ?>
                        </p>
					<?php }?>
						
					</td>
				</tr>
			<?php }} ?>
			</tbody>
		</table>
	</div>	

	<br>
<?php }?>
	</div>
<?php $_template = new Smarty_Internal_Template("footer.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>