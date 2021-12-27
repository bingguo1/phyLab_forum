<?php /* Smarty version Smarty-3.0.6, created on 2014-02-05 22:19:22
         compiled from "D:\Hosting\11794775\html\useforum/template/green\main_post.html" */ ?>
<?php /*%%SmartyHeaderCode:2867452f2486aedf912-84985775%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '183ff328bf5b4a31e4338458dcaf02cab8be8fc4' => 
    array (
      0 => 'D:\\Hosting\\11794775\\html\\useforum/template/green\\main_post.html',
      1 => 1391609282,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2867452f2486aedf912-84985775',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("header.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<div id="page">
    <div class="post">
		<h2 class="title" style="margin-bottom: 6px;">发布新话题</h2>
        <div class="entry" style="margin-top: -26px;">
            <form action="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'main','a'=>'post'),$_smarty_tpl);?>
" method="POST"  enctype="multipart/form-data" >
                <p>
                    <input type="text" name="title"  value="<?php echo htmlspecialchars($_POST['title']);?>
" style="width:730px;">
                    <select name="forum" style="width:130px;float: right;">
                        <?php  $_smarty_tpl->tpl_vars['result'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('results')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['result']->key => $_smarty_tpl->tpl_vars['result']->value){
?>
                        <?php if ($_smarty_tpl->tpl_vars['result']->value['id']==$_smarty_tpl->getVariable('fid')->value){?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['result']->value['id'];?>
" selected><?php echo $_smarty_tpl->tpl_vars['result']->value['name'];?>
</option>
                        <?php }else{ ?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['result']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['result']->value['name'];?>
</option>
                        <?php }?>
                        <?php }} ?>
                    </select>
                </p>
                <textarea name="contents" style="width:100%;height:300px;visibility:hidden;"><?php echo $_POST['contents'];?>
</textarea><br />
                <p><input type="submit" class="links" value="提  交" /><?php if ($_smarty_tpl->getVariable('errmsg')->value){?> <span class="notice"><?php echo $_smarty_tpl->getVariable('errmsg')->value;?>
</span><?php }else{ ?>你可以在内容中@某人，但要在此人用户名后加空格。<?php }?></p>
            </form>
        </div>
    </div>
</div>
<link rel="stylesheet" href="./include/editor/themes/default/default.css" />
<script charset="utf-8" src="./include/editor/kindeditor-min.js"></script>		<script charset="utf-8" src="./include/editor/lang/zh_CN.js"></script>
<script>
    var editor;
    KindEditor.ready(function(K) {
        editor = K.create('textarea[name="contents"]', {
            resizeType : 1,
            allowPreviewEmoticons : false,
            allowImageUpload : true,
            pasteType : 1
        });
    });
</script>
<?php $_template = new Smarty_Internal_Template("footer.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>