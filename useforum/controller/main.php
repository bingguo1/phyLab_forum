<?php
/**
 * Useforum  Copyright (C) 2010-2013 论坛基础控制器
 * 添加日期 2011 GW
 */
class main extends useforum
{
	/*
	 * 首页
	 * 若需要设置独立主页，须为版块列表建立独立控制器，此处可随意调用数据。
	 * 技术支持 U.gw269.com
	 */
	public function index(){
		$this->results = spClass("lib_forum")->spLinker()->findAll(NULL,"`order` ASC");
		$this->user = spClass("lib_user")->findCount(); // 使用了findCount
		$this->topicnum = spClass("lib_topic")->findCount();
		$this->newer = spClass("lib_user")->find(null,"ctime DESC","uname");
		}

	// 查看当前板块内容
	public function viewforum(){
		if( $forum = $this->spArgs("id") ){
			$this->info = spClass("lib_forum")->spLinker()->find(array('id'=>$forum));
			if(!$this->info)	$this->error("版块不存在！", spUrl('main', 'index'));
			$this->tops = spClass("lib_topic")->spLinker()->findAll(array('forum'=>$forum,'top'=>"1"),"rtime DESC");
			$this->results = spClass("lib_topic")->spLinker()->spPager($this->spArgs("page",1),$this->listpager)->findAll(array('forum'=>$forum,'top'=>"0"),"rtime DESC");
			$this->pager = spClass("lib_forum")->spPager()->getPager();
		}else{
			$this->error("版块不存在！", spUrl('main', 'index'));//无id按不存在处理
		}
	}

	// 查看内容
	public function view(){
		// 这里先判断是否传入了gid
		if( $gid = $this->spArgs("gid") ){
			$this->info = spClass("lib_topic")->spLinker()->find(array('gid'=>$gid),"gid,uname,title,ctime,ip,forum");
			if(!$this->info)	$this->error("话题不存在或已被删除！", "javascript:window.history.go(-1);");
			spClass('lib_topic')->incrField(array( 'gid' =>$this->spArgs("gid")), 'view');
			$this->poster = spClass("lib_user")->find(array('uname'=>$this->info['uname']),"uid,forum,live,post,credits,acl,ctime,avatar");
			$this->results = spClass("lib_reply")->spLinker()->spPager($this->spArgs("page",1),$this->replypager)->findAll(array('gid'=>$gid),"ctime ASC","content,rid,ip,uname,ctime");
			$this->pager = spClass("lib_topic")->spPager()->getPager();
		}else{
			$this->jump("javascript:window.history.go(-1);");
		}
	}

	//编辑话题
	public function edit(){
		if( $gid = $this->spArgs("gid") ){
			$editObject = spClass("lib_topic");
			$unamer = $editObject->find(array('gid'=>$this->spArgs("gid")));
			if(!$unamer) $this->error("话题不存在或已被删除！", spUrl('main', 'index'));
			if ("GBADMIN" == $_SESSION["userinfo"]["acl"] || $unamer['uname'] == $_SESSION["userinfo"]["uname"] || $unamer['forum'] == $_SESSION["userinfo"]["forum"]){
				$this->info = $unamer;
			}else{
			$this->error('您无权编辑本话题', "javascript:window.history.go(-1);");
			}
			if(array_key_exists("contents",$this->spArgs())){
				$conditions = array('gid'=>$gid);
				$edit= strReplaces($this->spArgs());//正则过滤函数
				$results = $editObject->spVerifier($edit);
				if( false == $results ){
					$editObject->updateField($conditions, 'title', $edit['title'] );
					$time=date("Y-m-d H:i",$_SERVER['REQUEST_TIME']);
					if("GBADMIN" != $_SESSION["userinfo"]["acl"]){
						$edit['contents'] .="\n <br/>​<i>该话题由{$_SESSION["userinfo"]["uname"]}在{$time}编辑</i>";
					}
					$editObject->updateField($conditions, 'contents', $edit['contents'] );
					$this->success("编辑成功！", spUrl("main","view",$conditions));
				}else{
					foreach($results as $item){
						foreach($item as $msg){
							$this->errmsg = $msg;
						}
					}
				}
			}
		}else{
			$this->jump("javascript:window.history.go(-1);");
        }
	}

	//编辑回复
	public function redit(){
		if( $gid = $this->spArgs("rid") ){
			$unamer = spClass("lib_reply")->find(array('rid'=>$this->spArgs("rid")));
			$topic =  spClass("lib_topic")->find(array('gid'=>$unamer['gid']),"forum");
			if(!$unamer) $this->error("话题不存在或已被删除！", spUrl('main', 'index'));
			if ("GBADMIN" == $_SESSION["userinfo"]["acl"] || $unamer['uname'] == $_SESSION["userinfo"]["uname"] || $topic['forum'] == $_SESSION["userinfo"]["forum"]){
				$this->info = $unamer;
			}else{
				$this->error('您无权编辑本回复', "javascript:window.history.go(-1);");
			}
			if($content = $this->spArgs("content")){
				$conditions = array('rid'=>$this->spArgs('rid'));
				$edit= strReplaces($this->spArgs());//正则过滤函数
				$time=date("Y-m-d H:i",$_SERVER['REQUEST_TIME']);
				if("GBADMIN" != $_SESSION["userinfo"]["acl"]){
					$edit['content'] .= "\n <br/><i>该回复由{$_SESSION["userinfo"]["uname"]}在{$time}编辑</i>";
				}
				spClass("lib_reply")->updateField($conditions, 'content', $edit['content'] );
				$this->success("编辑成功！", spUrl("main","view",array("gid" =>$unamer['gid'])));
			}
		}else{
			$this->jump("javascript:window.history.go(-1);");
		}
	}

	//评分
	public function score(){
		if( $gid = $this->spArgs("gid") ){
			if(spClass('lib_score')->find(array( 'uname' => $_SESSION['userinfo']['uname'],'gid' => $gid)) ==null || $_SESSION['userinfo']['acl'] == "GBADMIN"){
				if($_SESSION['userinfo']['acl'] != "GBADMIN"){
					$results = spClass('lib_score')->spVerifier($this->spArgs());
				}else{
					$results = false;
				}
				if($results == false){
					if($_SESSION['userinfo']['uname'] != $this->spArgs("poster")){
						spClass('lib_user')->incrField(array('uname' => $this->spArgs("poster") ), 'credits',$this->spArgs("score"));
						$newrow = array( // PHP的数组
							'uname' => $_SESSION['userinfo']['uname'],
							'reason' => $this->spArgs("reason"),
							'ctime' => $_SERVER['REQUEST_TIME'],
							'score' => $this->spArgs("score"),
							'gid' => $gid
						);
						spClass('lib_score')->sendnotice($gid,$this->spArgs("score"));
						spClass('lib_score')->create($newrow);
						$this->success("评分成功！" , "javascript:window.history.go(-1);");
					}else{
						$this->error("您不能为自己的帖子评分！" , "javascript:window.history.go(-1);");
					}
				}else{
					foreach($results as $item){
						foreach($item as $msg){ 
							$this->error($msg,"javascript:window.history.go(-1);");
						}
					}
				}
			}else{
				$this->error("您已为该主题评过分了！" , "javascript:window.history.go(-1);");
			}
		}else{
			$this->jump("javascript:window.history.go(-1);");
        }
	}

	//搜索
	public function search(){
		if( $search = clearLabel($this->spArgs("search")) ){ //清空HTML标签
			if( "topic" == $this->spArgs("type") ){
				$search = spClass("lib_topic")->escape('%'. $search .'%' );
				$this->result1 = spClass("lib_topic")->spLinker()->findAll(" title like $search ","rtime DESC","title,uname,ctime,rtime,gid,view"," 0,30 ");
			}elseif( "user" == $this->spArgs("type") ){
				$search = spClass("lib_user")->escape('%'. $search .'%' );
				$this->result2 = spClass("lib_user")->spLinker()->findAll(" uname like $search ","credits DESC","ctime,uname,uid,credits,introduce,live,avatar"," 0,30 ");
			}
		}
	}

	// 退出登录
	public function logout(){
		setcookie('autologin',"",time()-3600*24*10);
		setcookie('temppassword',"",time()-3600*24*10);
		// 这里是PHP.net关于删除SESSION的方法
		$_SESSION = array();
		if (isset($_COOKIE[session_name()])) setcookie(session_name(), '', $_SERVER['REQUEST_TIME']-42000, '/');
		session_destroy();
		// 跳转回首页
		$this->success("已退出，返回首页！", spUrl("main","index"));
	}

	// 显示用户登录框以及验证用户登录情况
	public function login(){
		$userObj = spClass("lib_user"); // 实例化lib_user类
		if(array_key_exists("uname",$this->spArgs())){ // 已经提交，这里开始进行登录验证
			$uname = $this->spArgs("uname");
			$upass = md5($this->spArgs("upass"));
			$autologin = $this->spArgs("autologin");
			if( $_COOKIE['lognum'] <= 5 ||($_SERVER['REQUEST_TIME'] - $_COOKIE['logtime']) > 900){
				if( false == $userObj->userlogin($uname, $upass,$autologin) ){
					setcookie("lognum",$_COOKIE['lognum'] + 1, $_SERVER['REQUEST_TIME']+900);
					$_COOKIE['lognum']++;
					if($_COOKIE['lognum'] > 5)setcookie("logtime",$_SERVER['REQUEST_TIME'], $_SERVER['REQUEST_TIME']+3600);
					$this->errmsg ="用户名或密码错误，请重新输入！";
				}else{
					$userObj->last($uname);
					$ip = $userObj->setIP($uname);
					$city = getCity(array( "ip" => $ip ));
					$useracl = spClass("spAcl")->get(); // 通过acl的get可以获取到当前用户的角色标识
					$acl = "GBADMIN" == $useracl ? "管理员":"用户";
					if ( $ip ) $lastip = "<br>上次登录IP {$ip} 地点 {$city}";
					$this->success("登录成功，欢迎您，尊敬的{$acl}！{$lastip}",rawurldecode($this->spArgs("backurl")),2);
				}
			}else{
				$this->errmsg ="输入错误超过5次，请等待15分钟再试！";
			}
		}
	}

	// 发布话题
	public function post(){
		$this->results = spClass("lib_forum")->findAll(NULL,"`order` ASC","id,name");//获取版块
		$this->fid = $this->spArgs("fid");
		if(array_key_exists("title",$this->spArgs())){//此处已经提交
			$post = strReplaces($this->spArgs());
			$guestbookObj = spClass("lib_topic");
			$results = $guestbookObj->spVerifier($post);
			if( false == $results ){
				if( ($_SERVER['REQUEST_TIME'] - $_SESSION['time']) > $this->posttime){
					$gid = $guestbookObj->create($post);
					$guestbookObj->sendAt($this->spArgs("contents"),$gid);
					$_SESSION['time']= $_SERVER['REQUEST_TIME'] ;
					spClass('lib_user')->incrField(array( 'uname' => $_SESSION["userinfo"]['uname'] ), 'post');
					spClass('lib_user')->incrField(array( 'uname' => $_SESSION["userinfo"]['uname'] ), 'credits',$this->newtopic);
					$this->success("创建新话题成功！", spUrl("main","view",array('gid'=>$gid)));
				}else{
					$this->errmsg = "请不要灌水，请等待{$this->posttime}秒再发布！";
				}
			}else{
				// $results不是false，所以没有通过验证，错误信息是$results
				foreach($results as $item){
					// 每一个规则，都有可能返回多个错误信息，循环$item来获取多个信息
					foreach($item as $msg){
						echo json_encode( array('message' => $msg));
					}
				}
			}
		}
	}
	
	// 回复
	public function rpost(){
		if($this->spArgs('content')){
			// 已经提交，开始对数据进行验证
			$rObj = spClass("lib_reply"); // 实例化留言对象
			$reply= strReplaces($this->spArgs());//正则过滤
			// 这里直接验证全部的提交数据（$this->spArgs()获取全部提交数据）
			if( ($_SERVER['REQUEST_TIME'] - $_SESSION['time']) > $this->posttime){
				$rObj->sendnotice($reply['gid']);
				$rid = $rObj->create($reply);
				$rObj->sendAt($reply['content'],$rid,$reply['gid']);
				$_SESSION['time']= $_SERVER['REQUEST_TIME'] ;
				//增加积分以及发帖数
				spClass('lib_user')->incrField(array( 'uname' => $_SESSION["userinfo"]['uname'] ), 'post');
				spClass('lib_user')->incrField(array( 'uname' => $_SESSION["userinfo"]['uname'] ), 'credits',$this->newreply);
				spClass("lib_topic")->updateField(array( 'gid' => $this->spArgs("gid") ), 'rtime', $_SERVER['REQUEST_TIME']);
				$this->add = spClass("lib_reply")->spLinker()->find(array('rid'=>$rid),"ctime ASC","content,uname,ctime");
				$this->num = $rObj->findCount(array("gid"=>$this->spArgs('gid')));
				$this->display('main_rpost.html');
			}else{
				echo json_encode( array('message' => "请不要灌水，请等待{$this->posttime}秒再发布！"));
			}
		}else{
			echo json_encode( array('message' => "内容不能为空。"));//0.3.1的ajax回复需要单独验证
		}
	}
}