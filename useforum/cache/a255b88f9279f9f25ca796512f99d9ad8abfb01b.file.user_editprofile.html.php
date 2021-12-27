<?php /* Smarty version Smarty-3.0.6, created on 2014-02-05 22:20:45
         compiled from "D:\Hosting\11794775\html\useforum/template/green\user_editprofile.html" */ ?>
<?php /*%%SmartyHeaderCode:2082852f248bd9168b2-45587676%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a255b88f9279f9f25ca796512f99d9ad8abfb01b' => 
    array (
      0 => 'D:\\Hosting\\11794775\\html\\useforum/template/green\\user_editprofile.html',
      1 => 1391609281,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2082852f248bd9168b2-45587676',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("subnavibar.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<div id="page">
	<div class="post">
		<h2 class="title">编辑资料<?php if ($_SESSION['userinfo']['acl']=="GBADMIN"){?>-<?php echo $_smarty_tpl->getVariable('info')->value['uname'];?>
<?php }?></h2>
			<div class="entry">
				<form action="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'user','a'=>'editnow','uid'=>$_GET['uid']),$_smarty_tpl);?>
" method="POST">
				<?php if ($_smarty_tpl->getVariable('info')->value['avatar']){?>
					<img src ="<?php echo $_smarty_tpl->getVariable('info')->value['avatar'];?>
" width="160" title="<?php echo $_smarty_tpl->getVariable('info')->value['uname'];?>
" align="right"/>
				<?php }else{ ?>
					<img src ="<?php echo $_smarty_tpl->getVariable('siteurl')->value;?>
/template/green/images/noavatar_big.gif" width="160" title="<?php echo $_smarty_tpl->getVariable('info')->value['uname'];?>
" align="right">
				<?php }?>
				<p>性别
				<select name="male" style="width:60px;">
					<option value="1" <?php echo $_smarty_tpl->getVariable('info')->value['male']==1 ? "selected=selected" : '';?>
 >男</option>
					<option value="2" <?php echo $_smarty_tpl->getVariable('info')->value['male']==2 ? "selected=selected" : '';?>
 >女</option>
				</select>
				<?php if (("GBADMIN"==$_SESSION['userinfo']['acl'])){?>
					认证
					<select name="admit" style="width:120px;">
						<option value="1" <?php echo $_smarty_tpl->getVariable('info')->value['admit']==1 ? "selected=selected" : '';?>
 >已身份认证</option>
						<option value="0" <?php echo $_smarty_tpl->getVariable('info')->value['admit']==0 ? "selected=selected" : '';?>
 >未身份认证</option>
					</select> </p>
					<?php if (1!=$_smarty_tpl->getVariable('info')->value['uid']){?><a id="acl"></a>
						<p>组别 <input type="text" name="acl" value="<?php echo $_smarty_tpl->getVariable('info')->value['acl'];?>
">管理员 GBADMIN，普通用户 GBUSER。屏蔽 shield。 </p>
					<?php }?>
				<?php }?>
				<p>来自 <input type="text"  name="live" value="<?php echo $_smarty_tpl->getVariable('info')->value['live'];?>
">例如：北平 </p>
				<p>QQ <input type="text" name="qq" value="<?php echo $_smarty_tpl->getVariable('info')->value['qq'];?>
">例如：666666666</p>
				<p>生日 <input type="date" name="birth" value="<?php echo $_smarty_tpl->getVariable('info')->value['birth'];?>
">例如：2011-01-01</p>
				<p>头像 <input id="url1" type="text" name="avatar" value="<?php echo $_smarty_tpl->getVariable('info')->value['avatar'];?>
" /> <input type="button" id="image1" value="选择图片" />（网络图片或本地上传）</p>
				<p><span id="vtop">介绍 </span><textarea style="width: 300px;" rows=3 name="introduce"><?php echo $_smarty_tpl->getVariable('info')->value['introduce'];?>
</textarea></p>
				<p><span id="vtop">签名 </span><textarea style="width: 300px;" rows=3 name="signature"><?php echo $_smarty_tpl->getVariable('info')->value['signature'];?>
</textarea></p>
                    <?php if ("GBADMIN"==$_SESSION['userinfo']['acl']||$_smarty_tpl->getVariable('info')->value['admit']!=1){?>
                <p>若要申请身份认证，请填写以下认证信息：</p>
				<p>真实姓名 <input type="text" name="truename" value="<?php echo $_smarty_tpl->getVariable('info')->value['truename'];?>
"></p>
				<p>联系电话 <input type="tel" name="phone" value="<?php echo $_smarty_tpl->getVariable('info')->value['phone'];?>
"></p>
				<p id="vtop">联系方式 <textarea cols=45 rows=2 name="address"><?php echo $_smarty_tpl->getVariable('info')->value['address'];?>
</textarea></p>
				<p id="vtop">照片地址 <textarea cols=45 rows=2 id="url2" name="photo"><?php echo $_smarty_tpl->getVariable('info')->value['photo'];?>
</textarea><input type="button" id="image2" value="选择图片" />（网络图片或本地上传）</p>
				<?php }else{ ?><p>恭喜你，身份验证已经通过！</p><?php }?>
                <p><input type="submit" class="links" value="提  交" /></p>
			</form>
		</div>
	</div>
</div>
	<link rel="stylesheet" href="<?php echo $_smarty_tpl->getVariable('siteurl')->value;?>
/include/editor/themes/default/default.css" />
		<script charset="utf-8" src="<?php echo $_smarty_tpl->getVariable('siteurl')->value;?>
/include/editor/kindeditor-min.js"></script>
		<script charset="utf-8" src="<?php echo $_smarty_tpl->getVariable('siteurl')->value;?>
/include/editor/lang/zh_CN.js"></script>
			<script>
			KindEditor.ready(function(K) {
				var editor = K.editor();
				K('#image1').click(function() {
					editor.loadPlugin('image', function() {
						editor.plugin.imageDialog({
							imageUrl : K('#url1').val(),
							clickFn : function(url, title, width, height, border, align) {
								K('#url1').val(url);
								editor.hideDialog();
							}
						});
					});
				});
				K('#image2').click(function() {
					editor.loadPlugin('image', function() {
						editor.plugin.imageDialog({
							imageUrl : K('#url2').val(),
							clickFn : function(url, title, width, height, border, align) {
								K('#url2').val(K('#url2').val() + url + '\n');
								editor.hideDialog();
							}
						});
					});
				});
			});
		</script>
<?php $_template = new Smarty_Internal_Template("footer.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>