<?php
/**
 * Useforum  Copyright (C) 2010-2013 用户控制器
 * 添加日期 2011 GW
 */
class user extends useforum
{
	// 查看用户信息内容
	public function profile(){
		// 这里先判断是否传入了uid
		if( $uname = $this->spArgs("uname") ){
			// 查找user表，获取留言信息
			$this->info = spClass("lib_user")->find(array('uname'=>$uname));
			if($this->info){
				$this->results = spClass("lib_userBoard")->spPager($this->spArgs("page",1),10)->findAll(array('uid'=>$this->info["uid"]),"ctime DESC","secret,content,uname,pgid,ctime");
				$this->pager = spClass("lib_userBoard")->spPager()->getPager();
				$this->topics = spClass("lib_topic")->spLinker()->findAll(array('uname'=>$uname),"ctime DESC","gid,uname,title,ctime,forum"," 0,9 ");
			}else{
				$this->error('无此用户！', "javascript:window.history.go(-1);");
			}
		}elseif( $uid = $this->spArgs("uid") ){
			$this->info = spClass("lib_user")->find(array('uid'=>$uid));
			if($this->info){
				$this->results = spClass("lib_userBoard")->spPager($this->spArgs("page",1),10)->findAll(array('uid'=>$uid),"ctime DESC","secret,content,uname,pgid,ctime");
				$this->pager = spClass("lib_userBoard")->spPager()->getPager();
				$this->topics = spClass("lib_topic")->spLinker()->findAll(array('uname'=>$this->info['uname']),"ctime DESC","gid,title,ctime,forum"," 0,9 ");//输出该用户最近9条话题
			}else{
				$this->error('无此用户！', "javascript:window.history.go(-1);");
			}
		}else{
			$this->error('无此用户！', "javascript:window.history.go(-1);");
		}
	}

	//用户列表
	public function userlist(){
		$sort = $this->spArgs("sort") ? $this->spArgs("sort") : "credits DESC";
		$this->results = spClass("lib_user")->spPager($this->spArgs("page",1),30)->findAll(NULL,$sort,"introduce,uid,credits,admit,post,uname,ctime,male");
		$this->pager = spClass("lib_topic")->spPager()->getPager();
	}

	//编辑个人资料
	public function editprofile(){
	// 这里先判断是否传入了uid
		if( $uid = $this->spArgs("uid") ){
			//这里判断用户权限（账号所有者或管理员）
			if ( "GBADMIN" == $_SESSION["userinfo"]["acl"] || $uid == $_SESSION["userinfo"]["uid"]){
				// 有权限则查找user表
				$this->info = spClass("lib_user")->find(array('uid'=>$uid));
			}else{
				//无权限则弹出
				$this->error('您无权编辑本用户', "javascript:window.history.go(-1);"); 
			}
		}else{
		// 无uid则直接跳转回上一页面
			$this->jump("javascript:window.history.go(-1);");
		}
	}

	//修改密码
	public function changepwd(){
		if ( "GBADMIN" == $_SESSION["userinfo"]["acl"] || $this->spArgs("uid") ==	$_SESSION["userinfo"]["uid"] ){
		// 这里先判断是否传入了uid
			if( $old = $this->spArgs("passwordold") ){
				$passwordObj = spClass("lib_user"); 
				$passwordObj->verifier = $passwordObj->pwdverifier;
				$results = $passwordObj->spVerifier($this->spArgs());
				if( false == $results ){
					$conditions = array( // PHP数组
						'uid' => $this->spArgs("uid"),
						'upass' => md5($old),
					);
					if( null == $passwordObj->findAll($conditions) ){
						$this->error("旧密码输入错误",  "javascript:window.history.go(-1);");
					}else{
						$passwordObj->updateField(array('uid'=>$this->spArgs("uid")), 'upass', md5($this->spArgs("password")));
						$this->success("修改成功",  spUrl("user","editprofile",array('uid'=>$this->spArgs("uid"))));
					}
				}else{
					foreach($results as $item){
						foreach($item as $msg){
							$this->error($msg, "javascript:window.history.go(-1);");
						}
					}
				}
			}
		}else{
			$this->error('您无权编辑本用户', "javascript:window.history.go(-1);"); 
		}
	}

	//设置安全提问
	public function secure(){
		if ( "GBADMIN" == $_SESSION["userinfo"]["acl"] || $this->spArgs("uid") ==	$_SESSION["userinfo"]["uid"] ){
			$Obj = spClass("lib_user"); 
			$this->q = $Obj->find(array('uid'=>$this->spArgs("uid"),'q1,q2,uid'));
			if( $old = $this->spArgs("upass")){
				$conditions = array( // PHP数组
					'uid' => $this->spArgs("uid"),
					'upass' => md5($old),
					'email' => $this->spArgs("email"),
				);
				if( null == $Obj->findAll($conditions) ){
					$this->error("旧密码或邮箱输入错误。",  "javascript:window.history.go(-1);");
				}else{
					$r = $this->spArgs();
					unset($r['email'],$r['upass'],$r['uid']);
					@$Obj->update(array('uid'=>$this->spArgs("uid")),strReplaces($r) );
					$this->success("设置成功",  spUrl("user","secure",array('uid'=>$this->spArgs("uid"))));
				}
			}
		}else{
			$this->error('您无权设置本用户', "javascript:window.history.go(-1);"); 
		}
	}

	//找回密码
	public function findpwd(){
		if ( "GBADMIN" == $_SESSION["userinfo"]["acl"] || $this->spArgs("uid") ==	$_SESSION["userinfo"]["uid"] ){
			$Obj = spClass("lib_user"); 
			$this->q = $Obj->find(array('uname'=>$this->spArgs("uname"),'q1,q2'));
			if(!$this->q['q1'] && !$this->q['q2']):
				$this->error("未设置安全提问，请联系管理员。",  spUrl("main","index"));
			endif;
			if( $email = $this->spArgs("email")){
				if( $_COOKIE['fdnum'] <= 5 ||($_SERVER['REQUEST_TIME'] - $_COOKIE['fdtime']) > 900){
					$conditions = array_merge($_POST,array("uname"=>$this->spArgs("uname")));
					if(!$Obj->findAll($conditions) ){
						setcookie("fdnum",$_COOKIE['fdnum'] + 1, $_SERVER['REQUEST_TIME']+900);
						$_COOKIE['fdnum']++;
						if($_COOKIE['fdnum'] > 5){setcookie("fdtime",$_SERVER['REQUEST_TIME'], $_SERVER['REQUEST_TIME']+3600); }
						$this->error("安全问题输入错误。",  spUrl("user","findpwd",array('uname'=>$this->spArgs("uname"))));
					}else{
						$newpass = substr($_SERVER['REQUEST_TIME'],1,7);
						@$Obj->updateField(array('uname'=>$this->spArgs("uname")),'upass',md5($newpass));
						$this->success("密码已设置为{$newpass}，登陆后请立即修改！",  spUrl("main","login"),5);
					}
				}else{
					$this->errmsg ="输入错误超过5次，请等待15分钟再试！";
				}
			}
		}else{
			$this->error('您无权设置本用户', "javascript:window.history.go(-1);"); 
		}
	}

	//用户资料编辑
	public function editnow(){
        $conditions = array('uid'=>$this->spArgs("uid")); 
		$str= clearLabel($this->spArgs());
		$gb = spClass('lib_user');
		@$gb->update($conditions,$str);
		$this->success("编辑成功！", spUrl("user","profile",$conditions));
	}

	//注册
	function register(){ 
		$userObj = spClass("lib_user");
		$userObj->verifier = $userObj->reg_verifier;
		if(array_key_exists("uname",$this->spArgs())){ // 已经提交，这里开始进行登录验证
			if($this->regcode==1){//验证码是否开启
				$result = spClass('xpClickCode')->verify($this->spArgs("codex"), $this->spArgs("codey"));
			}else{
				$result = true;
			}
			if($result==true){
				$upass = md5($this->spArgs("upass"));
				$results = $userObj->spVerifier($this->spArgs());
				if( false == $results ){
					$userObj->creatuser($this->spArgs("uname"),$this->spArgs("email"),$upass);
					$useracl = spClass("spAcl")->get(); 
					/*自动登录写入*/
					if($autologin = $this->spArgs("uname")){
						setcookie('autologin',$this->spArgs("uname"),time()+3600*24*10);//保持7天自动登录
						$pass = rand() . $_SERVER['REQUEST_TIME'] . 'Useforum' . $this->spArgs("uname");
						setcookie('temppassword',md5($pass),time()+3600*24*10);
						$notice = spAccess('r',$this->spArgs("uname"));
						$notice['temppassword'] = md5($pass);
						spAccess('w' , $this->spArgs("uname"), $notice,3600*24*10);
					}
					$this->success("欢迎您，尊敬的会员！",rawurldecode($this->spArgs("backurl")));
				}else{
					foreach($results as $item){
						foreach($item as $msg){ 
							$this->errmsg = "{$msg}；{$this->errmsg}";
						}
					}
				}
			}else{
				$this->errmsg = "验证码输入错误";
			}
		}
   }

	//发布留言
	public function rpost(){
		$rObj = spClass("lib_userBoard");
		$str= strReplaces($this->spArgs());
		$results = $rObj->spVerifier($str);
		if( false == $results ){
			if( ($_SERVER['REQUEST_TIME'] - $_SESSION['time']) > $this->posttime){
				$rObj->create($str);
				$rObj->sendnotice($this->spArgs('uid'));
				$_SESSION['time']= $_SERVER['REQUEST_TIME'] ;
				$this->success("留言成功！",spUrl("user","profile",array('uid'=>$this->spArgs("uid")))."#gbk");
			}else{
				$this->error("请不要灌水，请等待{$this->posttime}秒再发布！","javascript:window.history.go(-1);");
			}
		}else{
			foreach($results as $item){
				foreach($item as $msg){ 
					$this->error($msg,"javascript:window.history.go(-1);");
				}
			}
		}
	}

	//清除提醒，可手动
	public function clearnotice(){
		$notice = spAccess('r',  $_SESSION["userinfo"]["uname"]);
		foreach ($notice['notice'] as $i => $value) {
			unset($notice['notice'][$i]);
		}
		spAccess('w' , $_SESSION["userinfo"]["uname"], $notice); 
		$notice = spAccess('r',  $_SESSION["userinfo"]["uname"]);
		$notice["update"] = 0;
		spAccess('w' , $_SESSION["userinfo"]["uname"], $notice); 
		$this->success("已经清空！","javascript:window.close();");
	}

	public function hasread(){
		$notice = spAccess('r',  $_SESSION["userinfo"]["uname"]);
		$notice["update"] = 0;
		spAccess('w' , $_SESSION["userinfo"]["uname"], $notice); 
	}

	//Ajax检查用户名
	function checkName(){
		// 接收提交的username值
		$nameObj = spClass("lib_user");
		$uname = $this->spArgs('uname');
		$test = $nameObj->find(array('uname'=>$uname));
		// 检查用户名重名，若返回$test不为空则用户名已存在
		if( $test != '' ){
			$result = array('message' => '已经存在该用户名',);
		}
		echo json_encode( $result ); // 返回（显示）JSON结果
	}

	//Ajax检查Email
	function checkEmail(){
		$email = $this->spArgs('email');
		$test = spClass("lib_user")->find(array('email'=>$email));
		$result = ($test ? array( 'message' => '邮箱已被注册' ) : array( 'message' => '' ));
		echo json_encode( $result ); // 返回（显示）JSON结果
	}

}	