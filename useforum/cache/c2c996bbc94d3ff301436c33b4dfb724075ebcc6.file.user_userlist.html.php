<?php /* Smarty version Smarty-3.0.6, created on 2014-02-05 22:20:36
         compiled from "D:\Hosting\11794775\html\useforum/template/green\user_userlist.html" */ ?>
<?php /*%%SmartyHeaderCode:1391652f248b43425e8-54675278%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c2c996bbc94d3ff301436c33b4dfb724075ebcc6' => 
    array (
      0 => 'D:\\Hosting\\11794775\\html\\useforum/template/green\\user_userlist.html',
      1 => 1391609283,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1391652f248b43425e8-54675278',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("header.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('t',"排行榜"); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?><?php if ($_smarty_tpl->getVariable('pager')->value['current_page']==''){?><?php if (!isset($_smarty_tpl->tpl_vars['pager']) || !is_array($_smarty_tpl->tpl_vars['pager']->value)) $_smarty_tpl->createLocalArrayVariable('pager', null, null);
$_smarty_tpl->tpl_vars['pager']->value['current_page'] = 1;?><?php }?>
<div id="page">
	<div class="post">
		<table width="100%" class="item_list">
			<thead>
            <?php if (substr($_GET['sort'],-4,-1)!="DES"){?><?php $_smarty_tpl->tpl_vars['s'] = new Smarty_variable("DESC", null, null);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['s'] = new Smarty_variable("ASC", null, null);?><?php }?>
				<th width="15" ></th>
				<th width="600" ><b>用户名</b></th>
				<th width="100" class="tdcenter"><a href=<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'user','a'=>'userlist','sort'=>"credits%20DESC"),$_smarty_tpl);?>
>积分</a></th>
				<th width="150" class="tdcenter"><a href=<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'user','a'=>'userlist','sort'=>"ctime%20".($_smarty_tpl->getVariable('s')->value)),$_smarty_tpl);?>
>注册时间</a></th>
				<th width="100" class="tdcenter"><a href=<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'user','a'=>'userlist','sort'=>"post%20DESC"),$_smarty_tpl);?>
>发帖数</a></th>
			</thead>
			<tbody>
			<?php  $_smarty_tpl->tpl_vars['result'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('results')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['result']->index=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['result']->key => $_smarty_tpl->tpl_vars['result']->value){
 $_smarty_tpl->tpl_vars['result']->index++;
?>
				<tr>
					<td><?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['result']->index+1+($_smarty_tpl->getVariable('pager')->value['current_page']-1)*30, null, null);?>
					<?php if ($_smarty_tpl->getVariable('i')->value<=3){?>
						<img src ="./template/green/images/rank_<?php echo $_smarty_tpl->getVariable('i')->value;?>
.gif">
					<?php }else{ ?>
						<?php echo $_smarty_tpl->getVariable('i')->value;?>

					<?php }?></td>
					<td>
					<?php if ($_smarty_tpl->tpl_vars['result']->value['male']==1){?>
						<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'user','a'=>'profile','uname'=>$_smarty_tpl->tpl_vars['result']->value['uname']),$_smarty_tpl);?>
" title="Boy"><font color="skyblue"><?php echo $_smarty_tpl->tpl_vars['result']->value['uname'];?>
</font></a>
					<?php }elseif($_smarty_tpl->tpl_vars['result']->value['male']==2){?>
						<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'user','a'=>'profile','uname'=>$_smarty_tpl->tpl_vars['result']->value['uname']),$_smarty_tpl);?>
" title="Girl"><font color="pink"><?php echo $_smarty_tpl->tpl_vars['result']->value['uname'];?>
</font></a>
					<?php }else{ ?>
						<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'user','a'=>'profile','uname'=>$_smarty_tpl->tpl_vars['result']->value['uname']),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->tpl_vars['result']->value['uname'];?>
</a>
                        <?php if ("1"==$_smarty_tpl->tpl_vars['result']->value['admit']){?><img src="./template/green/images/admit.png" title="身份认证"/><?php }?>
					<?php }?>
					(<?php echo $_smarty_tpl->tpl_vars['result']->value['introduce'];?>
)</td>
					<td class="tdcenter"><?php echo $_smarty_tpl->tpl_vars['result']->value['credits'];?>
</td>
					<td class="tdcenter"><?php echo tpl_myDate(array('time'=>$_smarty_tpl->tpl_vars['result']->value['ctime']),$_smarty_tpl);?>
</td>
					<td class="tdcenter"><?php echo $_smarty_tpl->tpl_vars['result']->value['post'];?>
 <?php if ("GBADMIN"==$_SESSION['userinfo']['acl']){?><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'user','a'=>'editprofile','uid'=>$_smarty_tpl->tpl_vars['result']->value['uid']),$_smarty_tpl);?>
" target="_blank">编辑</a><?php }?></td>
				</tr>
			<?php }} ?>
			</tbody>
		</table>	
		<div class="scott">
			<p>
				<?php if ($_smarty_tpl->getVariable('pager')->value['all_pages']){?>
                    <?php echo tpl_pager(array('pager'=>$_smarty_tpl->getVariable('pager')->value,'c'=>"user",'a'=>"userlist",'idname'=>"sort",'id'=>$_GET['sort']),$_smarty_tpl);?>

				<?php }?>
			</p>
		</div>
	</div>
</div>
<?php $_template = new Smarty_Internal_Template("footer.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>