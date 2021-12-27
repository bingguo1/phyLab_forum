<?php /* Smarty version Smarty-3.0.6, created on 2014-02-05 22:18:54
         compiled from "D:\Hosting\11794775\html\useforum/template/green\jump.html" */ ?>
<?php /*%%SmartyHeaderCode:1463152f2484ece1f23-27307907%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '574a490b9c81404285b8319b059622cc80d423d0' => 
    array (
      0 => 'D:\\Hosting\\11794775\\html\\useforum/template/green\\jump.html',
      1 => 1391609282,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1463152f2484ece1f23-27307907',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("header.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<div id="page">
    <div class="middle">
        <img src="<?php echo $_smarty_tpl->getVariable('siteurl')->value;?>
/template/green/images/<?php echo "s"==$_smarty_tpl->getVariable('type')->value ? "success" : "error";?>
.gif"/>
        <br>
        <p class="middle"><?php echo $_smarty_tpl->getVariable('msg')->value;?>
</p><a href =<?php echo $_smarty_tpl->getVariable('url')->value;?>
>如果浏览器没有自动跳转，请点击这里</a>
    </div>
</div>
<?php $_template = new Smarty_Internal_Template("footer.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<head><meta http-equiv='refresh' content='<?php echo $_smarty_tpl->getVariable('time')->value;?>
;url=<?php echo $_smarty_tpl->getVariable('url')->value;?>
'></head>