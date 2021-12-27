<?php /* Smarty version Smarty-3.0.6, created on 2014-02-05 22:18:32
         compiled from "D:\Hosting\11794775\html\useforum/template/green\main_login.html" */ ?>
<?php /*%%SmartyHeaderCode:1492652f2483814f8f2-48411725%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dbbff665f58c5a1b60c0ae8bafa7b7f4d376b0ac' => 
    array (
      0 => 'D:\\Hosting\\11794775\\html\\useforum/template/green\\main_login.html',
      1 => 1391609282,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1492652f2483814f8f2-48411725',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("header.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('t',"登录"); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
	<div id="page">
		<div class="post">
			<h2 class="title">登录</h2>
			<div class="entry">
                <p><?php if ($_smarty_tpl->getVariable('errmsg')->value){?><span class="notice"><?php echo $_smarty_tpl->getVariable('errmsg')->value;?>
</span><?php }else{ ?>请输入您的帐号及密码：<?php }?></p>
				<form action="" method="POST" onsubmit="return aclcode();" autocomplete="off">
					<p>帐　　号：<input type="text" name="uname"  value="<?php echo $_POST['uname'];?>
" required="required" id="uname"> 用户名或E-Mail</p>
					<p>密　　码：<input type="password" name="upass" value="<?php echo $_POST['upass'];?>
" required="required"></p>
                    <p>自动登录：<input type="checkbox" name="autologin" checked></p>
					<p>
						<input type="submit" class="links" value="提  交" />  
						<a href="javascript:void(0);" onclick="findpwd();" title="请先在账号框内输入用户名再点击" >找回密码</a>
					</p>
				</form>
			</div>
		</div>
	</div>
<?php $_template = new Smarty_Internal_Template("footer.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<script>
function findpwd(){
	window.location = "<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'user','a'=>'findpwd'),$_smarty_tpl);?>
&uname=" + document.getElementById("uname").value;
}
</script>