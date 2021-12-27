<?php
/**
 * Useforum  Copyright (C) 2010-2013 安装程序
 * www.gw269.com All Rights Reserved.
 */

// 定义当前目录
define("APP_PATH",dirname(__FILE__));
if(true == @file_exists(APP_PATH.'/install.lock')){
	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\" /><center>Useforum看起来已经安装过了，请删除install.lock再试。</center>";
    exit();
}
//默认的参数 
$defaults = array(
	
	"DB_HOST" => "localhost",
	"DB_USER" => "root",
	"DB_PASSWORD" => "",
	"DB_DBNAME" => "useforum",
	"DB_PREFIX" => "uf_",
		
	"uname" => "admin",
	"email" => "",
	"upass" => ""
);

function ins_checkdblink($configs){//用获得的数据库参数来检验数据库是否可以正常了连接
	global $dblink,$err;
	$dblink = mysql_connect($configs['DB_HOST'], $configs['DB_USER'], $configs['DB_PASSWORD']);
	if(false == $dblink){$err = '无法链接网站数据库，请检查网站数据库设置！';return false;}
	if(! mysql_select_db($configs['DB_DBNAME'], $dblink)){$err = '无法选择网站数据库，请确定网站数据库名称正确！'; return false;}
	ins_query("SET NAMES UTF8");
	return true;
}

function ins_query($sql,$prefix = ""){// 本地数据库入库
	global $dblink,$err;
	$sqlarr = explode(";", $sql);
	foreach($sqlarr as $single){
		if( !empty($single) && strlen($single) > 5 ){
			$single = str_replace("\n",'',$single);
			$single = str_replace("#DBPREFIX#",$prefix,$single );
			if( !mysql_query($single, $dblink) ){$err = "数据库执行错误：".mysql_error();return false;}
		}
	}
}

function ins_registeruser($configs, $prefix = ""){//增加管理员用户
	global $dblink,$err,$adminsql;
	$ctime = time();
	$md5 = md5($configs["upass"]);
        $adminsql = "insert into `{$prefix}user` (`uid`,`uname`,`upass`,`email`,`ctime`,`acl`) values(1,'{$configs["uname"]}','{$md5}','{$configs["email"]}','{$ctime}','GBADMIN');
		INSERT INTO `{$prefix}topic` ( `gid` ,`title` ,`contents` ,`ctime` ,`rtime` ,`uname` ,`forum` ,`ip` ,`top` ,`digest` ,`view`  ) VALUES 
 (1,'欢迎使用Useforum轻论坛','<p><span>很高兴，Useforum迎来了第二个正式版本。相对于0.3.0新增了很多实用功能，优化了各页面的显示方式，是Useforum迈向成熟的关键一步。</span></p><p>Useforum 0.3.1更新内容：</p><p>1.无需发送邮件的找回密码功能，节约时间的选择；</p><p>2.智能的字符串截取，不会再出现乱码问题；</p><p>3.对屏蔽用户功能进一步升级，运行保留版主身份的屏蔽；</p><p>4.Ajax回复，节省时间，提升用户体验；</p><p>5.修改缓存功能，记录最后登录时间；</p><p>6.便捷的提醒功能，在有人回复、评分、留言时发送；</p><p>7.对一些不必要的页面进行删除，用弹框替代；</p><p>8.增加移动主题功能；</p><p>9.改变程序整体构架，目录清晰化；</p><p>10.字段更新功能修改语法，提高程序速度。</p><p><p>Useforum 0.3.0 更新内容：</p><p>1.修复加精华相关错误；</p><p>2.修复登录次数限制不能保存的问题；</p><p>3.更正智能时间函数显示模式；</p><p>4.修改错误的分页按钮；</p><p>5.后台不能全选的bug；</p><p>6.导出用户信息不能换行的bug；</p><p>7.置顶帖只在第一页显示；</p><p>8.用户资料编辑跳转优化；</p><p>9.完善时区设置(config.php)，修正了时间错误问题。</p><p>0.22更新列表：</p><p>1.注册，登录页面提示优化；</p><p>2.登录次数限制，错误五次15分钟不能登录；</p><p>3.版主管理模块，允许精华、置顶、删除；</p><p>4.优化后台版块编辑页面；</p><p>5.改变主题列表排序方式，以最后回复时间排序。</p></p>',1371797024,1371868973,'{$configs["uname"]}',1,'127.0.0.1',0,1,24);";
		
	//return $adminsql;
        return True;

}

function ins_writeconfig($configs){//生成配置文件
	$configex = file_get_contents(APP_PATH."/config.php");
	foreach( $configs as $skey => $value ){
		$skey = "#".$skey."#";
		$configex = str_replace($skey, $value, $configex);
	}
	file_put_contents (APP_PATH."/config.php" ,$configex);
	file_put_contents (APP_PATH."/install.lock" ,"");
}

$sql = "
DROP TABLE IF EXISTS #DBPREFIX#acl;

DROP TABLE IF EXISTS #DBPREFIX#user;

DROP TABLE IF EXISTS #DBPREFIX#topic;

DROP TABLE IF EXISTS #DBPREFIX#reply;

DROP TABLE IF EXISTS #DBPREFIX#profilegb;

DROP TABLE IF EXISTS #DBPREFIX#option;

DROP TABLE IF EXISTS #DBPREFIX#score;

DROP TABLE IF EXISTS #DBPREFIX#forum;

DROP TABLE IF EXISTS #DBPREFIX#access_cache;

CREATE TABLE IF NOT EXISTS `#DBPREFIX#access_cache` (
  `cacheid` bigint(20) NOT NULL auto_increment,
  `cachename` varchar(100) NOT NULL,
  `cachevalue` text,
  PRIMARY KEY  (`cacheid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `#DBPREFIX#acl` (
  `aclid` int(11) NOT NULL auto_increment,
  `name` varchar(200) collate utf8_unicode_ci NOT NULL,
  `controller` varchar(50) collate utf8_unicode_ci NOT NULL,
  `action` varchar(50) collate utf8_unicode_ci NOT NULL,
  `acl_name` varchar(50) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`aclid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=74 ;

INSERT INTO `#DBPREFIX#acl` (`aclid`, `name`, `controller`, `action`, `acl_name`) VALUES
(1, '留言管理后台', 'admin', 'index', 'GBADMIN'),
(2, '删除留言', 'admin', 'del', 'GBADMIN'),
(3, '提交留言', 'main', 'post', 'GBUSER'),
(4, '提交留言', 'main', 'post', 'GBADMIN'),
(5, '首页', 'main', 'index', 'SPANONYMOUS'),
(6, '登录', 'main', 'login', 'SPANONYMOUS'),
(7, '查看留言', 'main', 'view', 'SPANONYMOUS'),
(8, '登出', 'main', 'logout', 'SPANONYMOUS'),
(9, '回复主题', 'main', 'rpost', 'GBUSER'),
(10, '回复主题', 'main', 'rpost', 'GBADMIN'),
(11, '注册', 'user', 'register', 'SPANONYMOUS'),
(12, '查看用户资料', 'user', 'profiler', 'GBUSER'),
(13, '查看用户资料', 'user', 'profiler', 'GBADMIN'),
(14, '删除用户', 'admin', 'deluser', 'GBADMIN'),
(15, '用户管理首页', 'admin', 'user', 'GBADMIN'),
(16, '编辑话题', 'main', 'edit', 'GBUSER'),
(17, '编辑话题', 'main', 'edit', 'GBADMIN'),
(18, '留言给用户 ', 'user', 'rpost', 'GBADMIN'),
(19, '留言给用户 ', 'user', 'rpost', 'GBUSER'),
(20, '后台查看话题 ', 'admin', 'view', 'GBADMIN'),
(21, '后台删除回复 ', 'admin', 'delreply', 'GBADMIN'),
(22, '后台用户单页 ', 'admin', 'profile', 'GBADMIN'),
(23, '后台删除用户留言 ', 'admin', 'delpg', 'GBADMIN'),
(24, '版块管理', 'admin', 'forum', 'GBADMIN'),
(50, '删除权限', 'admin', 'delacl', 'GBADMIN'),
(27, '后台帖子列表', 'admin', 'thread', 'GBADMIN'),
(28, '编辑用户资料', 'user', 'editprofile', 'GBADMIN'),
(29, '编辑用户资料执行', 'user', 'editnow', 'GBADMIN'),
(30, '用户编辑', 'user', 'editprofile', 'GBUSER'),
(31, '用户编辑', 'user', 'editnow', 'GBUSER'),
(48, '权限管理页面', 'admin', 'acl', 'GBADMIN'),
(41, '后台全局编辑', 'admin', 'optionedited', 'GBADMIN'),
(49, '排行榜', 'user', 'userlist', 'SPANONYMOUS'),
(42, '后台全局变量', 'admin', 'option', 'GBADMIN'),
(43, '板块编辑', 'admin', 'editforum', 'GBADMIN'),
(44, '板块编辑执行', 'admin', 'forumedited', 'GBADMIN'),
(45, '板块添加', 'admin', 'addforum', 'GBADMIN'),
(46, '板块删除', 'admin', 'delforum', 'GBADMIN'),
(51, '添加权限', 'admin', 'addacl', 'GBADMIN'),
(52, '置顶', 'admin', 'totop', 'GBADMIN'),
(54, '精华', 'admin', 'digest', 'GBADMIN'),
(55, '删除', 'admin', 'del', 'GBUSER'),
(56, '精华', 'admin', 'digest', 'GBUSER'),
(57, '置顶', 'admin', 'totop', 'GBUSER'),
(58, '删除回复', 'admin', 'delreply', 'GBUSER'),
(59, '删除留言', 'admin', 'delpg', 'GBADMIN'),
(62, '修改密码', 'user', 'changepwd', 'GBUSER'),
(63,'修改密码','user','changepwd','GBADMIN'),
(64,'搜索','main','search','SPANONYMOUS'),
(65,'批量删除','admin','multidel','GBADMIN'),
(66,'数据备份','admin','backup','GBADMIN'),
(67,'用户信息导出','admin','derivecsv','GBADMIN'),
(68,'话题评分','main','score','GBUSER'),
(69,'话题评分','main','score','GBADMIN'),
(70,'安全设置','user','secure','GBADMIN'),
(71,'安全设置','user','secure','GBUSER'),
(72,'安全设置','user','secure','shield'),
(73,'找回密码','user','findpwd','SPANONYMOUS');

CREATE TABLE IF NOT EXISTS `#DBPREFIX#forum` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(20) NOT NULL,
  `instruc` varchar(300) NOT NULL,
  `color` varchar(8) character set latin1 NOT NULL,
  `order` int(11) NOT NULL default '0',
  `rule` text NOT NULL,
  `icon` varchar(1000) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=2 ;

INSERT INTO `#DBPREFIX#forum` (`id`, `name`, `instruc`, `color`, `order`, `rule`, `icon`) VALUES
 (1,'默认版块','这里是，默认版块','#E53333',1,'','');

CREATE TABLE IF NOT EXISTS `#DBPREFIX#option` (
  `name` varchar(20) character set latin1 NOT NULL,
  `val` varchar(1000) NOT NULL,
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `#DBPREFIX#option` (`name`, `val`) VALUES
('sitename', 'Useforum轻论坛 0.3.1'),
('siteinstruction', '又一个Useforum轻论坛！'),
('listpager', '10'),
('replypager', '15'),
('keywords', 'Useforum,轻论坛,论坛'),
('description', 'Useforum轻论坛 0.3.1'),
('logo', './template/green/images/logo.png'),
('openlogin_qq_appid', ''),
('openlogin_qq_appkey', ''),
('openlogin_qq_open', ''),
('openlogin_qq_callbac', ''),
('newtopic', '2'),
('newreply', '1'),
('digest', '5'),
('waittime', '900'),
('posttime', '30'),
('regcode', '1'),
('postcode', '0'),
('logincode', '0');

CREATE TABLE IF NOT EXISTS `#DBPREFIX#profilegb` (
  `pgid` int(11) NOT NULL auto_increment,
  `content` varchar(1000) NOT NULL,
  `ctime` int(15) NOT NULL,
  `uname` varchar(30) NOT NULL,
  `uid` int(11) NOT NULL,
  `secret` varchar(5) character set latin1 NOT NULL,
  PRIMARY KEY  (`pgid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `#DBPREFIX#reply` (
  `rid` int(11) NOT NULL auto_increment,
  `content` varchar(2000) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `gid` int(11) NOT NULL,
  `ctime` int(11) NOT NULL,
  `ip` varchar(20) character set latin1 NOT NULL,
  PRIMARY KEY  (`rid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `#DBPREFIX#score` (
  `sid` int(11) NOT NULL auto_increment,
  `uname` varchar(100) NOT NULL,
  `gid` int(11) NOT NULL,
  `reason` text NOT NULL,
  `score` int(11) NOT NULL,
  `ctime` int(20) NOT NULL,
  PRIMARY KEY  (`sid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `#DBPREFIX#topic` (
  `gid` int(11) NOT NULL auto_increment,
  `title` varchar(90) NOT NULL,
  `contents` varchar(2000) NOT NULL,
  `ctime` int(12) NOT NULL,
  `rtime` int(12) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `forum` int(11) NOT NULL default '1',
  `ip` varchar(20) character set latin1 NOT NULL,
  `top` int(1) NOT NULL,
  `digest` int(1) NOT NULL,
  `view` int(11) NOT NULL,
  PRIMARY KEY  (`gid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `#DBPREFIX#user` (
  `uid` int(11) NOT NULL auto_increment,
  `uname` varchar(20) NOT NULL,
  `upass` varchar(32) character set latin1 NOT NULL,
  `acl` varchar(10) NOT NULL default 'GBUSER',
  `ctime` int(12) NOT NULL,
  `email` varchar(30) NOT NULL,
  `ip` varchar(15) character set latin1 NOT NULL,
  `live` varchar(15) NOT NULL default '火星',
  `introduce` varchar(300) NOT NULL default '这家伙很懒，什么也没留下~~~',
  `qq` int(10) default NULL,
  `male` int(1) NOT NULL,
  `birth` date default NULL,
  `phone` int(20) default NULL,
  `avatar` varchar(666) NOT NULL,
  `signature` text NOT NULL,
  `address` text NOT NULL,
  `photo` text NOT NULL,
  `truename` varchar(20) NOT NULL,
  `admit` int(2) NOT NULL,
  `credits` int(11) NOT NULL,
  `post` int(11) NOT NULL,
  `digestpost` int(11) NOT NULL,
  `forum` int(11) NOT NULL,.
  `q1` varchar(255) NOT NULL,
  `a1` varchar(255) NOT NULL,
  `q2` varchar(255) NOT NULL,
  `a2` varchar(255) NOT NULL,
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;
";

if(empty($_GET['step']) || $_GET['step'] == 1){
    $tips = $defaults;
    require(APP_PATH.'/template/install/step1.html');
}else{
	// 第三步，验证资料，写入资料，完成安装
	$dblink = null;$err=null;$adminsql = null;
	while(1){
		// 检查本地数据库设置
		ins_checkdblink($_POST);if( null != $err )break;
		// 增加管理员用户
		ins_registeruser($_POST,$_POST["DB_PREFIX"]);if( null != $err )break;
		// 本地数据库入库
		$sql .= $adminsql;
		ins_query($sql,$_POST["DB_PREFIX"]);if( null != $err )break;
		// 改写本地配置文件
		ins_writeconfig($_POST);if( null != $err )break;
		break;
	}
        if( null != $err ){ // 有错误则覆盖
		$tips = array_merge($defaults, $_POST); // 显示原值或新值
		require(APP_PATH.'/template/install/step1.html');
	}else{
		require(APP_PATH.'/template/install/step2.html');
	}
}

