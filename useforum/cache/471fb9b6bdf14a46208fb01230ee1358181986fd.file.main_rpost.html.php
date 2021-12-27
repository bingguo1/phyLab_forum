<?php /* Smarty version Smarty-3.0.6, created on 2014-02-05 22:21:19
         compiled from "D:\Hosting\11794775\html\useforum/template/green\main_rpost.html" */ ?>
<?php /*%%SmartyHeaderCode:1035852f248dfed5494-89885256%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '471fb9b6bdf14a46208fb01230ee1358181986fd' => 
    array (
      0 => 'D:\\Hosting\\11794775\\html\\useforum/template/green\\main_rpost.html',
      1 => 1391609284,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1035852f248dfed5494-89885256',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (is_array($_smarty_tpl->getVariable('add')->value)){?>
<tr><td valign="top" width="60px">
<?php if ((''!=$_smarty_tpl->getVariable('add')->value['replyer']['avatar'])){?>
		<img class="avatar" src ="<?php echo $_smarty_tpl->getVariable('add')->value['replyer']['avatar'];?>
" width="60" align="left" />
	<?php }else{ ?>
		<img src ="./template/green/images/noavatar_big.gif" width="60" class="avatar" align="left" />
<?php }?>
</td><td>
	<p>
	 <?php echo $_smarty_tpl->getVariable('num')->value;?>
楼
	<b><a href ="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'user','a'=>'profile','uname'=>$_smarty_tpl->getVariable('add')->value['uname']),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->getVariable('add')->value['uname'];?>
</a></b>
	<?php if ($_smarty_tpl->getVariable('add')->value['replyer']['admit']=="1"){?>
		<img class="none" src="./template/green/images/admit.png" title="认证用户"/><?php }?>
	<?php if ($_smarty_tpl->getVariable('add')->value['replyer']['acl']=="GBADMIN"){?>管理员<?php }elseif($_smarty_tpl->getVariable('add')->value['replyer']['forum']=="0"){?>普通用户<?php }else{ ?>版主<?php }?>
	<?php echo tpl_myDate(array('time'=>$_smarty_tpl->getVariable('add')->value['ctime']),$_smarty_tpl);?>

	 积分 <?php echo $_smarty_tpl->getVariable('add')->value['replyer']['credits'];?>
 精华数 <?php echo $_smarty_tpl->getVariable('add')->value['replyer']['digestpost'];?>

	<?php if (("GBADMIN"==$_SESSION['userinfo']['acl']||$_smarty_tpl->getVariable('info')->value['forum']==$_SESSION['userinfo']['forum'])){?>
	<a href="javascript:void(0);" onclick="delconfirm(<?php echo $_smarty_tpl->getVariable('add')->value['rid'];?>
,'<?php echo $_smarty_tpl->getVariable('add')->value['uname'];?>
');">删除</a>
	<?php }?>
	</p>
<div class="content"><?php echo $_smarty_tpl->getVariable('add')->value['content'];?>
</div>
</td></tr>
<tr><td rowspan="1" colspan="2">
	<?php if ($_smarty_tpl->getVariable('add')->value['replyer']['signature']){?><p class="signature"><?php echo $_smarty_tpl->getVariable('add')->value['replyer']['signature'];?>
</p>
	<?php }else{ ?><p class="nosign"></p><?php }?>
</td></tr>
<?php }?>