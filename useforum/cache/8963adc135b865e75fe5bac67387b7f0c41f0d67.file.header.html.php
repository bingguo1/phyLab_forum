<?php /* Smarty version Smarty-3.0.6, created on 2014-02-05 22:18:03
         compiled from "D:\Hosting\11794775\html\useforum/template/green\header.html" */ ?>
<?php /*%%SmartyHeaderCode:489152f2481b731748-81251915%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8963adc135b865e75fe5bac67387b7f0c41f0d67' => 
    array (
      0 => 'D:\\Hosting\\11794775\\html\\useforum/template/green\\header.html',
      1 => 1391609281,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '489152f2481b731748-81251915',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php if ($_smarty_tpl->getVariable('t')->value){?><?php echo $_smarty_tpl->getVariable('t')->value;?>
-<?php }?><?php echo $_smarty_tpl->getVariable('sitename')->value;?>
</title>
<link href="<?php echo $_smarty_tpl->getVariable('siteurl')->value;?>
/template/green/images/style.css" rel="stylesheet" type="text/css" media="screen" />
<meta name="keywords" content="<?php echo $_smarty_tpl->getVariable('keywords')->value;?>
" />
<meta name="description" content="<?php echo $_smarty_tpl->getVariable('description')->value;?>
" />
<meta name="generator" content="Useforum" />
<?php if ($_SESSION['userinfo']){?>
	<link rel="stylesheet" href="<?php echo $_smarty_tpl->getVariable('siteurl')->value;?>
/include/editor/themes/default/default.css" />
	<script charset="utf-8" src="<?php echo $_smarty_tpl->getVariable('siteurl')->value;?>
/include/editor/kindeditor-min.js"></script>
	<script charset="utf-8" src="<?php echo $_smarty_tpl->getVariable('siteurl')->value;?>
/include/editor/lang/zh_CN.js"></script>
	<script>
			KindEditor.ready(function(K) {
			K('#notice').click(function() {
				
				var dialog = K.dialog({
					width : 600,
					title : '提醒',
					body : '<div style="margin:10px;"><?php if (is_array($_smarty_tpl->getVariable('notice')->value['notice'])){?><?php  $_smarty_tpl->tpl_vars['result'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('notice')->value['notice']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['result']->key => $_smarty_tpl->tpl_vars['result']->value){
?><p><?php echo $_smarty_tpl->tpl_vars['result']->value;?>
</p><?php }} ?><?php }else{ ?>暂无新提醒<?php }?><br><br><a href=<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'user','a'=>'clearnotice'),$_smarty_tpl);?>
 target=_blank>清空提醒</a></div>',
					closeBtn : {
						name : '关闭',
						click : function(e) {
							dialog.remove();
						}
					}
				});
				$.post('<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'user','a'=>'hasread'),$_smarty_tpl);?>
');
				$.post('<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'user','a'=>'clearnotice'),$_smarty_tpl);?>
');
			});
		});
	</script>
	<?php }?>
</head>

<body>

<div id="logo">
    <a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'main','a'=>'index'),$_smarty_tpl);?>
" class="first">
         <img src="<?php echo $_smarty_tpl->getVariable('logo')->value;?>
"/>
    </A>
    <p><em style="text-indent:2em;"><?php echo $_smarty_tpl->getVariable('siteinstruction')->value;?>
</em></p>
</div>
<div id="header">
    <div id="menu">
        <ul>
            <li><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'main','a'=>'index'),$_smarty_tpl);?>
" class="first">首页</a></li>
            <?php if ($_SESSION['userinfo']['uname']){?>
            <li><?php if ($_GET['a']=='post'){?><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'main','a'=>'post'),$_smarty_tpl);?>
"><span  class="menuCurrent">新话题</span></a>
                <?php }else{ ?><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'main','a'=>'post'),$_smarty_tpl);?>
">新话题</a><?php }?></li>
            <?php }?>
            <li><?php if ($_GET['a']=='userlist'){?><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'user','a'=>'userlist'),$_smarty_tpl);?>
"><span  class="menuCurrent">排行榜</span></a>
                <?php }else{ ?><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'user','a'=>'userlist'),$_smarty_tpl);?>
">排行榜</a><?php }?></li>
            <li><?php if ($_GET['a']=='search'){?><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'main','a'=>'search'),$_smarty_tpl);?>
"><span  class="menuCurrent">搜索</span></a>
                <?php }else{ ?><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'main','a'=>'search'),$_smarty_tpl);?>
">搜索</a><?php }?></li>
        </ul>
    </div>
    <div id="navi">
        <?php if ($_SESSION['userinfo']['uname']){?>
        <div id="navi">
            <?php if ($_GET['a']=='profile'){?><b class="current"><?php echo $_SESSION['userinfo']['uname'];?>
 </b>
            <?php }else{ ?><a href= "<?php ob_start();?><?php echo $_SESSION['userinfo']['uname'];?>
<?php $_tmp1=ob_get_clean();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'user','a'=>'profile','uname'=>$_tmp1),$_smarty_tpl);?>
"><b><?php echo $_SESSION['userinfo']['uname'];?>
 </b></a><?php }?>
            | <?php if ($_GET['a']=='editprofile'){?><span class="current">设置</span><?php }else{ ?><a href= "<?php ob_start();?><?php echo $_SESSION['userinfo']['uid'];?>
<?php $_tmp2=ob_get_clean();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'user','a'=>'editprofile','uid'=>$_tmp2),$_smarty_tpl);?>
">设置</a><?php }?>
            <?php if ($_smarty_tpl->getVariable('notice')->value['update']==1){?>| <span class="notice" id="notice"><a href= "javascript:void(0);">新提醒</a></span>
            <?php }else{ ?>| <span id="notice"><a href= "javascript:void(0);">提醒</a></span><?php }?>
			<?php if (("GBADMIN"==$_SESSION['userinfo']['acl'])){?>
			| <?php if ($_GET['c']=='admin'){?><span class="current">管理</span><?php }else{ ?><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'admin','a'=>'index'),$_smarty_tpl);?>
">管理</a><?php }?>
				<?php }?>
			| <a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'main','a'=>'logout'),$_smarty_tpl);?>
">退出</a>
        </div>
        <?php }else{ ?>
        <div id="navi">	<?php if ($_GET['a']=='register'){?><span class="current" >注册</span><?php }else{ ?><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'user','a'=>'register','backurl'=>$_smarty_tpl->getVariable('currenturl')->value),$_smarty_tpl);?>
">注册</a><?php }?>
         | <?php if ($_GET['a']=='login'){?><span class="current">登录</span><?php }else{ ?><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'main','a'=>'login','backurl'=>$_smarty_tpl->getVariable('currenturl')->value),$_smarty_tpl);?>
">登录</a><?php }?>
        </div>
        <?php }?>
    </div>
</div>