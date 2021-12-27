<?php /* Smarty version Smarty-3.0.6, created on 2014-02-05 22:20:45
         compiled from "D:\Hosting\11794775\html\useforum/template/green\subnavibar.html" */ ?>
<?php /*%%SmartyHeaderCode:675352f248bdac5a08-24324401%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '55b8660f63b9cfadc693cc7c4a1a3477f94f6266' => 
    array (
      0 => 'D:\\Hosting\\11794775\\html\\useforum/template/green\\subnavibar.html',
      1 => 1391609283,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '675352f248bdac5a08-24324401',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_GET['c']=='admin'){?>
<?php $_template = new Smarty_Internal_Template("header.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('t',"管理中心"); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<div id="admin" >
    <ul><li><?php if ($_GET['a']=='index'){?><a id="justit">管理首页</a><?php }else{ ?><a href ="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'admin','a'=>'index'),$_smarty_tpl);?>
">管理首页</a><?php }?></li>
        <li><?php if ($_GET['a']=='topic'){?><a id="justit">话题管理</a><?php }else{ ?><a href ="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'admin','a'=>'topic'),$_smarty_tpl);?>
">话题管理</a><?php }?></li>
        <li><?php if ($_GET['a']=='user'){?><a id="justit">用户管理</a><?php }else{ ?><a href ="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'admin','a'=>'user'),$_smarty_tpl);?>
">用户管理</a><?php }?></li>
        <li><?php if ($_GET['a']=='forum'){?><a id="justit">版块管理</a><?php }else{ ?><a href ="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'admin','a'=>'forum'),$_smarty_tpl);?>
">版块管理</a><?php }?></li>
        <li><?php if ($_GET['a']=='acl'){?><a id="justit">权限&用户组</a><?php }else{ ?><a href ="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'admin','a'=>'acl'),$_smarty_tpl);?>
">权限&用户组</a><?php }?></li>
        <li><?php if ($_GET['a']=='option'){?><a id="justit">论坛设置</a><?php }else{ ?><a href ="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'admin','a'=>'option'),$_smarty_tpl);?>
">论坛设置</a><?php }?></li>
        <li><?php if ($_GET['a']=='backup'){?><a id="justit">数据操作</a><?php }else{ ?><a href ="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'admin','a'=>'backup'),$_smarty_tpl);?>
">数据操作</a><?php }?></li></ul>
</div>
<?php }elseif($_GET['c']=='user'){?>
<?php $_template = new Smarty_Internal_Template("header.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('t',"个人设置"); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<div id="admin" >
    <ul><li><?php if ($_GET['a']=='editprofile'){?><a id="justit">编辑资料</a><?php }else{ ?><a href ="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'user','a'=>'editprofile','uid'=>$_GET['uid']),$_smarty_tpl);?>
">编辑资料</a><?php }?></li>
        <li><?php if ($_GET['a']=='changepwd'){?><a id="justit">修改密码</a><?php }else{ ?><a href ="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'user','a'=>'changepwd','uid'=>$_GET['uid']),$_smarty_tpl);?>
">修改密码</a><?php }?> </li>
        <li><?php if ($_GET['a']=='secure'){?><a id="justit">安全设置</a><?php }else{ ?><a href ="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'user','a'=>'secure','uid'=>$_GET['uid']),$_smarty_tpl);?>
">安全设置</a><?php }?></li>
    </ul>
</div>
<?php }?>