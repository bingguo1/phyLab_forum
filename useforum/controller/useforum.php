<?php
/**
 * Useforum  Copyright (C) 2010-2013 继承控制器
 * 获取基本信息，执行基础任务。
 * 添加日期 13-6 GW
 */
class useforum extends spController{
	/**
	  * 构造函数
	  * 添加日期 13-6 GW
	  */
	function __construct(){
		// 必须加入启动父类构造函数的操作
		parent::__construct();
		$option = spClass("lib_common") ->findAll();
		foreach($option as $data)
		{//循环输出全局变量
			$this->$data['name'] = $data['val'];
		}
		//系统信息
		$this->useforumversion = "0.3.3";
		$currenturl = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];  
		$this->currenturl = rawurlencode($currenturl);//获取编码当前页地址
		if($_SESSION["userinfo"]["uname"]){
			$notice = spAccess('r' , $_SESSION["userinfo"]["uname"]);
			if ($notice["update"] ==1){
				$this->notice=$notice;
			}
		}
		//存在自动登录cookie则写入session并设置权限
		if((!$_SESSION["userinfo"])&&($_COOKIE['autologin'])){
			$notice = spAccess('r',$_COOKIE['autologin']);
			//检测安全密钥
			if($notice['temppassword'] === $_COOKIE['temppassword']){
				$result = spClass('lib_user')->find(array('uname'=>$_COOKIE['autologin']));
				spClass('spAcl')->set($result['acl']); 
				$_SESSION["userinfo"] = $result;
				$pass = rand() . $_SERVER['REQUEST_TIME'] . 'Useforum' . $result['uname'];
				$notice['temppassword'] = md5($pass);
				setcookie('temppassword',md5($pass),time()+3600*24*10);//保持7天自动登录
				spAccess('w' , $result['uname'],$notice,3600*24*10);
			}
		}
		if(!isset($_SESSION['time'])){
			$_SESSION['time']=0;
		}
		$site_uri = trim(dirname($GLOBALS['G_SP']['url']["url_path_base"]),"\/\\");
		if( '' == $site_uri ){
			$site_uri = 'http://'.$_SERVER["HTTP_HOST"];
		}else{
			$site_uri = 'http://'.$_SERVER["HTTP_HOST"].'/'.$site_uri;
		}
		$this->siteurl = $site_uri;//获取站点地址
	}

	/**
	 * 跳转函数
	 * @param msg 提示信息 @param url 跳转地址 @param time 等待时间
	 * 添加日期 13-7-21 GW
	 */
	public function success($msg, $url,$time=1){
		$this->msg = $msg;
		$this->url = $url;
		$this->time = $time;
		$this->type = "s";
		$this->display("jump.html");
		exit();
	}

	public function error($msg, $url,$time=1){
		$this->msg = $msg;
		$this->url = $url;
		$this->time = $time;
		$this->display("jump.html");
		exit();
	}

	//生成验证码
	function code(){
		$vcode = spClass('xpClickCode');
		$vcode->display();
	}
}