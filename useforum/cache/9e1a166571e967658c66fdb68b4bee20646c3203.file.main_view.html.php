<?php /* Smarty version Smarty-3.0.6, created on 2014-02-05 22:18:16
         compiled from "D:\Hosting\11794775\html\useforum/template/green\main_view.html" */ ?>
<?php /*%%SmartyHeaderCode:3117252f24828797e68-39346155%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9e1a166571e967658c66fdb68b4bee20646c3203' => 
    array (
      0 => 'D:\\Hosting\\11794775\\html\\useforum/template/green\\main_view.html',
      1 => 1391609284,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3117252f24828797e68-39346155',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'D:\Hosting\11794775\html\useforum\include\Drivers\Smarty\plugins\modifier.date_format.php';
?><?php $_template = new Smarty_Internal_Template("header.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('t',($_smarty_tpl->getVariable('info')->value['title'])."-".($_smarty_tpl->getVariable('info')->value['f']['name'])); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<div id="page"><?php if ($_smarty_tpl->getVariable('pager')->value['current_page']==''){?><?php if (!isset($_smarty_tpl->tpl_vars['pager']) || !is_array($_smarty_tpl->tpl_vars['pager']->value)) $_smarty_tpl->createLocalArrayVariable('pager', null, null);
$_smarty_tpl->tpl_vars['pager']->value['current_page'] = 1;?><?php }?>
	<div class="post">
		<h2 class="title">				
			<?php if ($_smarty_tpl->getVariable('info')->value['digest']=="1"){?>
				<img src="<?php echo $_smarty_tpl->getVariable('siteurl')->value;?>
/template/green/images/digest_1.gif" class="commonimg"/>
			<?php }?>
			<?php if ($_smarty_tpl->getVariable('info')->value['top']=="1"){?>
				<img src="<?php echo $_smarty_tpl->getVariable('siteurl')->value;?>
/template/green/images/pin.gif" />
			<?php }?>
	       	<?php echo $_smarty_tpl->getVariable('info')->value['title'];?>

            <span style="font-size: 12px;color:#8A8A8A;" >
                [<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'main','a'=>'viewforum','id'=>$_smarty_tpl->getVariable('info')->value['forum']),$_smarty_tpl);?>
" style="font-size: 12px;"><?php echo $_smarty_tpl->getVariable('info')->value['f']['name'];?>
</a>]
                <?php echo tpl_myDate(array('time'=>$_smarty_tpl->getVariable('info')->value['ctime']),$_smarty_tpl);?>

            </span>
		</h2>
		<table width="100%">
			<tr>
				<td rowspan="2" valign="top" width="120px" class="viewleft">
					<div class="content">
						<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'user','a'=>'profile','uname'=>$_smarty_tpl->getVariable('info')->value['uname']),$_smarty_tpl);?>
">
							<?php if ($_smarty_tpl->getVariable('poster')->value['avatar']){?>
								<img src ="<?php echo $_smarty_tpl->getVariable('poster')->value['avatar'];?>
" width="120px" alt="<?php echo $_smarty_tpl->getVariable('info')->value['uname'];?>
"align="left" />
							<?php }else{ ?>
								<img src ="<?php echo $_smarty_tpl->getVariable('siteurl')->value;?>
/template/green/images/noavatar_big.gif" width="120px" align="left" />
							<?php }?>
						</a>
					</div>
					<h3 align="center" style="margin-top: 5px;" >
						<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'user','a'=>'profile','uname'=>$_smarty_tpl->getVariable('info')->value['uname']),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->getVariable('info')->value['uname'];?>
</a>
						<?php if ($_smarty_tpl->getVariable('poster')->value['admit']=="1"){?>
							<img style="border:none;" src="<?php echo $_smarty_tpl->getVariable('siteurl')->value;?>
/template/green/images/admit.png" title="认证用户"/>
						<?php }?>
					</h3>
					<div class="tdcenter"><?php echo $_smarty_tpl->getVariable('poster')->value['acl']=="GBADMIN" ? "管理员" : ($_smarty_tpl->getVariable('poster')->value['forum']=="0" ? "普通用户" : "版主");?>
<?php echo $_smarty_tpl->getVariable('poster')->value['acl']=="shield" ? "该用户被已屏蔽" : '';?>
</div>
					UID <?php echo $_smarty_tpl->getVariable('poster')->value['uid'];?>

					<br />来自 <?php echo $_smarty_tpl->getVariable('poster')->value['live'];?>

					<br />积分 <?php echo $_smarty_tpl->getVariable('poster')->value['credits'];?>

					<br />发帖 <?php echo $_smarty_tpl->getVariable('poster')->value['post'];?>

					<br />注册时间 <?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('poster')->value['ctime'],"%Y-%m-%d");?>

					<br /><?php echo tpl_lastLogin(array('uname'=>$_smarty_tpl->getVariable('info')->value['uname']),$_smarty_tpl);?>

				</td>
				<td class="viewrighttop"style="max-width: 800px;" >
					<div class="content" ><?php echo $_smarty_tpl->getVariable('info')->value['contents'];?>
</div>
				</td>		
			</tr>
			<tr>
				<td valign="bottom" class="viewrightbottom">
					<?php if (is_array($_smarty_tpl->getVariable('info')->value['score'][0])){?>
						<p class="signature">该话题的评分记录</p>
						<?php  $_smarty_tpl->tpl_vars['score'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('info')->value['score']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['score']->key => $_smarty_tpl->tpl_vars['score']->value){
?>
						<p>
							<b><?php echo $_smarty_tpl->tpl_vars['score']->value['score'];?>
分</b> <a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'user','a'=>'profile','uname'=>$_smarty_tpl->tpl_vars['score']->value['uname']),$_smarty_tpl);?>
"> <?php echo $_smarty_tpl->tpl_vars['score']->value['uname'];?>
</a>:<?php echo $_smarty_tpl->tpl_vars['score']->value['reason'];?>

						</p>
						<?php }} ?>
                    <?php }?>
					<br />
					<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'main','a'=>'viewforum','id'=>$_smarty_tpl->getVariable('info')->value['forum']),$_smarty_tpl);?>
">返回<?php echo $_smarty_tpl->getVariable('info')->value['f']['name'];?>
</a>
                    <?php if ($_SESSION['userinfo']){?>
                    | <a href="#reply">快速回复</a>
                    <?php }?>
					<?php if (("GBADMIN"==$_SESSION['userinfo']['acl']||$_smarty_tpl->getVariable('info')->value['uname']==$_SESSION['userinfo']['uname']||$_smarty_tpl->getVariable('info')->value['forum']==$_SESSION['userinfo']['forum'])){?>
					 | <a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'main','a'=>'edit','gid'=>$_smarty_tpl->getVariable('info')->value['gid']),$_smarty_tpl);?>
">编辑</a>
					<?php }?>
					<?php if (("GBADMIN"==$_SESSION['userinfo']['acl']||$_smarty_tpl->getVariable('info')->value['forum']==$_SESSION['userinfo']['forum'])){?>
					 | <b><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'admin','a'=>'move','gid'=>$_smarty_tpl->getVariable('info')->value['gid']),$_smarty_tpl);?>
">移动</a></b>
					 | <b><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'admin','a'=>'totop','gid'=>$_smarty_tpl->getVariable('info')->value['gid']),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->getVariable('info')->value['top']=="1" ? "取消置顶" : "置顶";?>
</a></b>
					 | <b><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'admin','a'=>'digest','gid'=>$_smarty_tpl->getVariable('info')->value['gid']),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->getVariable('info')->value['digest']=="1" ? "取消精华" : "精华";?>
</a></b>
					 | <b><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'admin','a'=>'del','gid'=>$_smarty_tpl->getVariable('info')->value['gid']),$_smarty_tpl);?>
">删除</a></b>
                     | <abbr title="<?php echo getCity(array('ip'=>$_smarty_tpl->getVariable('result')->value['ip']),$_smarty_tpl);?>
"> <?php echo $_smarty_tpl->getVariable('info')->value['ip'];?>
</abbr>
					<?php }?>
					<?php if ($_SESSION['userinfo']){?> | <span id="showscore"><a href="javascript:void(0);">评分</a></span><?php }?>
				</td>
			</tr>
        </table>
        <table width="100%" id='resulttable'>
            <?php  $_smarty_tpl->tpl_vars['result'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('results')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['result']->index=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['result']->key => $_smarty_tpl->tpl_vars['result']->value){
 $_smarty_tpl->tpl_vars['result']->index++;
?>
            <tr>
            <td valign="top" width="60px">
                <?php if ($_smarty_tpl->tpl_vars['result']->value['replyer']['avatar']){?>
                    <img class="avatar" src ="<?php echo $_smarty_tpl->tpl_vars['result']->value['replyer']['avatar'];?>
" width="60" align="left" />
                <?php }else{ ?>
                    <img class="avatar" src ="<?php echo $_smarty_tpl->getVariable('siteurl')->value;?>
/template/green/images/noavatar_big.gif" width="60" align="left" />
                <?php }?>
            </td>
            <td>
                <p>
                 <?php echo $_smarty_tpl->tpl_vars['result']->index+1+($_smarty_tpl->getVariable('pager')->value['current_page']-1)*$_smarty_tpl->getVariable('replypager')->value;?>
楼
                <b><?php echo tpl_getUrl(array('uname'=>$_smarty_tpl->tpl_vars['result']->value['uname']),$_smarty_tpl);?>
</b>
                <?php if ($_smarty_tpl->tpl_vars['result']->value['replyer']['admit']=="1"){?>
                    <img class="none" src="<?php echo $_smarty_tpl->getVariable('siteurl')->value;?>
/template/green/images/admit.png" title="认证用户"/>
                <?php }?>
                <?php echo $_smarty_tpl->tpl_vars['result']->value['replyer']['acl']=="GBADMIN" ? "管理员" : ($_smarty_tpl->tpl_vars['result']->value['replyer']['forum']=="0" ? "普通用户" : "版主");?>

                <?php echo tpl_myDate(array('time'=>$_smarty_tpl->tpl_vars['result']->value['ctime']),$_smarty_tpl);?>
<?php echo $_smarty_tpl->tpl_vars['result']->value['replyer']['acl']=="shield" ? "该用户已被屏蔽" : '';?>

                 积分 <?php echo $_smarty_tpl->tpl_vars['result']->value['replyer']['credits'];?>
 精华数 <?php echo $_smarty_tpl->tpl_vars['result']->value['replyer']['digestpost'];?>
 <?php echo tpl_lastLogin(array('uname'=>$_smarty_tpl->tpl_vars['result']->value['uname']),$_smarty_tpl);?>

                <?php if (("GBADMIN"==$_SESSION['userinfo']['acl']||$_smarty_tpl->getVariable('info')->value['forum']==$_SESSION['userinfo']['forum'])){?>
                    <a href="javascript:void(0);" onclick="delconfirm(<?php echo $_smarty_tpl->tpl_vars['result']->value['rid'];?>
,'<?php echo $_smarty_tpl->tpl_vars['result']->value['uname'];?>
');">删除</a>
                    <abbr title="<?php echo getCity(array('ip'=>$_smarty_tpl->tpl_vars['result']->value['ip']),$_smarty_tpl);?>
"> <?php echo $_smarty_tpl->tpl_vars['result']->value['ip'];?>
</abbr>
                <?php }?>
                <?php if (("GBADMIN"==$_SESSION['userinfo']['acl']||$_smarty_tpl->getVariable('info')->value['uname']==$_SESSION['userinfo']['uname']||$_smarty_tpl->getVariable('info')->value['forum']==$_SESSION['userinfo']['forum'])){?>
                    <a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'main','a'=>'redit','rid'=>$_smarty_tpl->tpl_vars['result']->value['rid']),$_smarty_tpl);?>
">编辑</a>
                <?php }?>
                <?php if ($_SESSION['userinfo']['uname']){?>
                    <a href="javascript:void(0);" onclick="replyto(<?php echo $_smarty_tpl->tpl_vars['result']->index+1+($_smarty_tpl->getVariable('pager')->value['current_page']-1)*$_smarty_tpl->getVariable('replypager')->value;?>
,'<?php echo $_smarty_tpl->tpl_vars['result']->value['uname'];?>
');">回复</a>
                <?php }?>
                </p>
                <div class="content"><?php echo $_smarty_tpl->tpl_vars['result']->value['content'];?>
</div>
            </td>
            </tr>
            <tr>
            <td rowspan="1" colspan="2">
                <?php if ($_smarty_tpl->tpl_vars['result']->value['replyer']['signature']){?>
                    <p class="signature"><?php echo $_smarty_tpl->tpl_vars['result']->value['replyer']['signature'];?>
</p>
                <?php }else{ ?>
                    <p class="nosign"></p>
                <?php }?>
            </td>
            </tr>
            <?php }} ?>
        </table>
		<div class="scott">
			<p>
			    	<?php if ($_smarty_tpl->getVariable('pager')->value['all_pages']){?>
                    <?php echo tpl_pager(array('pager'=>$_smarty_tpl->getVariable('pager')->value,'c'=>"main",'a'=>"view",'idname'=>"gid",'id'=>$_smarty_tpl->getVariable('info')->value['gid']),$_smarty_tpl);?>

				<?php }?>
			</p>
		</div>	
		<div class="entry">
			<?php if ($_SESSION['userinfo']){?>
				<a name="reply"></a>
				<p>我也说两句：<span class="notice"><span id="ex2result">&nbsp;</span></span><br /></p>
				<textarea id="content" name="content" style="width:600px;height:150px;" required="required"></textarea></p>
				<br/><p><input type="hidden" id="gid" name="gid" value="<?php echo $_smarty_tpl->getVariable('info')->value['gid'];?>
"></p>
                <p><input type="button" name="Submit3" class="links" value="提  交" id="ex3button"></p>
			<?php }else{ ?>
				<h3>请<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'main','a'=>'login','backurl'=>$_smarty_tpl->getVariable('currenturl')->value),$_smarty_tpl);?>
">登录或<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'user','a'=>'register','backurl'=>$_smarty_tpl->getVariable('currenturl')->value),$_smarty_tpl);?>
">注册</a>后再参与该话题。</h3>
			<?php }?>
		</div>
	</div>
</div>	
<script>
    function delconfirm(rid,uname){
        if( window.confirm("确定删除“" + uname + "”的回复？") ){
            window.location = "<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'admin','a'=>'delreply'),$_smarty_tpl);?>
&rid=" + rid;
        }
    }
    function replyto(floor,uname){
        editor.insertHtml('回复'+floor+'楼<a href=<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'user','a'=>'profile'),$_smarty_tpl);?>
&uname='+uname+'>@'+uname+' </a>:  ');
    }
</script>
<?php if ($_SESSION['userinfo']){?>
		<link rel="stylesheet" href="<?php echo $_smarty_tpl->getVariable('siteurl')->value;?>
/include/editor/themes/default/default.css" />
		<script charset="utf-8" src="<?php echo $_smarty_tpl->getVariable('siteurl')->value;?>
/include/editor/kindeditor-min.js"></script>
		<script charset="utf-8" src="<?php echo $_smarty_tpl->getVariable('siteurl')->value;?>
/include/editor/lang/zh_CN.js"></script>
		<script>
			var editor;
			KindEditor.ready(function(K) {
				editor = K.create('textarea[name="content"]', {
					resizeType : 1,
					allowPreviewEmoticons : false,
					allowImageUpload : true,
					items : [
						'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
						'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
						'insertunorderedlist', '|', 'emoticons', 'image', 'link',"|","source"]
				});
			});
			KindEditor.ready(function(K) {
				K('#showscore').click(function() {
					var dialog = K.dialog({
						width : 200,
						title : '评分',
						body : '<div style="margin:10px;"><form action=\"<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'main','a'=>'score','gid'=>$_smarty_tpl->getVariable('info')->value['gid']),$_smarty_tpl);?>
\" method="POST"><input type=\"hidden\" name="poster" value=\"<?php echo $_smarty_tpl->getVariable('info')->value['uname'];?>
\"><input name=\"score\" type=\"number\" value=3 style="width:50px;\"> 评分区间：1 ~ 5<br>理由：<br><input type=\"text\" name=\"reason\" style=\"width: 150px;\"><br><input type=\"submit\" value=\"评分\" class=\"links\"></form></div>',
						closeBtn : {
							name : '关闭',
							click : function(e) {
								dialog.remove();
							}
						}
					});
				});
			});
		</script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('siteurl')->value;?>
/include/jquery-1.4.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){ // 当页面加载完毕
	$("#ex3button").click(function(){ // “提交”按钮被点击
	$('#ex2result').html("请稍候");
		// 构造发送的数据，请注意如果获取表单各项的值
		var formdata = {
			'content' : editor.html(),
			'gid': $('#gid').val()
		};
		// 用$.post发送数据
		$.post('<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'main','a'=>'rpost'),$_smarty_tpl);?>
', formdata, function(add){
			if (add.length > 100){
				$('#resulttable').append(add); // 返回的数据直接追加到resulttable表格的后面
				$('#ex2result').html("");
				editor.text('');
			}else{
				$.getJSON("<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'main','a'=>'rpost'),$_smarty_tpl);?>
",formdata, function(json){
				$('#ex2result').html(json.message); // 使用json.message，对应myajax/check中的$result['message']
		}); }
		});
	});
});
</script>	
<?php }?>
<?php $_template = new Smarty_Internal_Template("footer.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>