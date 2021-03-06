<?php
/**
 * Useforum  Copyright (C) 2010-2013 用户留言模型
 * 添加日期 2011 GW
 */
class lib_userBoard extends spModel
{
	var $pk = "pgid";
	var $table = "profilegb";
		
	var $verifier = array(  // 留言内容验证规则
		"rules" => array( 
			'content' => array(
				'notnull' => TRUE,
				'minlength' => 3,
				'maxlength' => 1000 
			),
		),
		"messages" => array( 
			'content' => array(
				'notnull' => "内容不能为空",
				'minlength' => "内容必须大于3个字符",
				'maxlength' => "内容必须小于1000个字符", 
			),
		)
	);
	
	/* 覆盖了spModel的create函数，对新增的记录加入时间与用户名 */
	public function create($row){
		// 使用array_merge构造新的$row
		$row = array_merge($row, array(
			'ctime' => $_SERVER['REQUEST_TIME'],
			'uname' => $_SESSION["userinfo"]["uname"]
		));
		// 调用父类（spModel）的create方法
		parent::create($row);
	}

	/* 发送提醒 */
	public function sendnotice($uid){
		$user = spClass("lib_user") ->find(array("uid"=>$uid),"uname");
		if($_SESSION["userinfo"]["uname"] != $user['uname']){
			$url = spUrl("user","profile",array('uname'=>$_SESSION["userinfo"]["uname"]));
			$receiver = spUrl("user","profile",array('uid'=>$uid));
			$notice = spAccess('r',$user['uname']); 
			$notice['update']=1;
			$newrow = "<a href={$url} target=_blank>{$_SESSION["userinfo"]["uname"]}</a>给您留言了，<a href={$receiver} target=_blank>快去看看吧</a>！";
			$notice['notice'][] = $newrow;
			spAccess('w' , $user['uname'], $notice); 
		}
	}
}