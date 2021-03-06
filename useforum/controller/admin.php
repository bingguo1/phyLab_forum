<?php
/**
 * Useforum  Copyright (C) 2010-2013管理模块控制器
 * 添加日期 2011 GW
 */
class admin extends useforum{
	// 后台管理首页
	public function index(){
		$this->uploadFile_maxsize = ini_get('upload_max_filesize');
		$this->ms_ver = mysql_get_server_info();
		$this->server = $_SERVER['SERVER_SOFTWARE'];
		$this->safeMode = ini_get('safe_mode') ? '开启' : '关闭';
		if(!function_exists("gd_info")) $this->gd = '不支持,无法处理图像';
		if(function_exists('gd_info')) {
			$gd = @gd_info();
			$this->gd = $gd["GD Version"];  $gd ? '&nbsp; 版本：'.$gd : '';
		}
	}

	//后台话题列表
	public function topic(){
	$this->results = spClass("lib_topic")->spPager($this->spArgs("page",1),30)->findAll(NULL,"ctime DESC","gid,uname,title,ip");
		$this->pager = spClass("lib_topic")->spPager()->getPager();
	}

	// 删除话题
	public function del(){
		// 这里先判断是否传入了gid
		if( $gid = $this->spArgs("gid") ){
			$user = spClass("lib_topic") ->find(array( 'gid' => $this->spArgs("gid") ),NULL,"uname,forum");
				if ("GBADMIN" == $_SESSION["userinfo"]["acl"] || $user['forum']== $_SESSION["userinfo"]["forum"]){
					spClass('lib_user')->decrField(array('uname' => $user['uname']), 'post');
					spClass('lib_user')->decrField(array('uname' => $user['uname']), 'credits',$this->newtopic);
				}else{
				$this->error('您无权删除本话题',"javascript:window.history.go(-1);");
				}
			spClass("lib_topic")->delete(array('gid'=>$gid));// 执行删除
			spClass("lib_reply")->delete(array('gid'=>$gid));// 删除回复
			$this->success("删除成功！","javascript:window.history.go(-1);");
		}else{
			$this->jump("javascript:window.history.go(-1);");
		}
	}

	//批量删除话题
	public function multidel(){
		if($this->spArgs("topic")){
			$topic = array('gid'=>$this->spArgs("topic"));
			$GID_Dele= implode(",",$topic['gid']);
			$SQL="delete from `{$GLOBALS['G_SP']['db']['prefix']}topic` where gid in ($GID_Dele)";
			spClass("lib_topic")->runsql($SQL);
			$SQLr="delete from `{$GLOBALS['G_SP']['db']['prefix']}reply` where gid in ($GID_Dele)";
			spClass("lib_reply")->runsql($SQLr);// 删除回复
			$this->success("删除成功！", spUrl("admin","topic"));
		}else{
			$this->error('您未选择任何话题', spUrl("admin","topic"));
		}
	}

	//删除回复
	public function delreply(){
		if( $rid = $this->spArgs("rid") ){
			$user = spClass("lib_reply") ->find(array( 'rid' => $this->spArgs("rid") ),NULL,"uname,gid");
			if ("GBADMIN" == $_SESSION["userinfo"]["acl"] || $user['forum']== $_SESSION["userinfo"]["forum"]){
				spClass('lib_user')->decrField(array('uname' => $user['uname']), 'post');
				spClass('lib_user')->decrField(array('uname' => $user['uname']), 'credits',$this->newreply);
				spClass("lib_reply")->deleteByPk($rid);// 执行删除
				$this->success("删除回复成功！","javascript:window.history.go(-1);");
			}else{
				$this->error('您无权删除本回复',"javascript:window.history.go(-1);");
			}
		}else{
			$this->jump("javascript:window.history.go(-1);");
		}
	}

	//删除留言
	public function delpg(){
		if( $pgid = $this->spArgs("pgid") ){
				spClass("lib_userBoard")->deleteByPk($pgid);// 执行删除
				$this->success("已删除该留言！","javascript:window.history.go(-1);");
		}else{
			$this->jump("javascript:window.history.go(-1);");
		}
	}

	//后台用户列表
	public function user(){
		$this->results = spClass("lib_user")->spPager($this->spArgs("page",1),30)->findAll(NULL,"ctime DESC","uid,uname,acl,ip,forum,credits,ctime");
		$this->pager = spClass("lib_topic")->spPager()->getPager();
	}

	//后台全局变量
	public function option(){
	}

	//后台全局编辑
	public function optionedited(){
		$gb = spClass('lib_common');
		foreach($this->spArgs() as $k=>$d){
			$gb->update(array('name'=>$k),array('val'=>$d));
		}
		$this->success("编辑成功！", spUrl("admin","option"));
	}


	 //后台板块排序
	public function reorder(){
		foreach($_POST as $k=>$d)
		{
			$SQL="UPDATE `{$GLOBALS['G_SP']['db']['prefix']}forum` SET  `order` =  {$d} WHERE  `{$GLOBALS['G_SP']['db']['prefix']}forum`.`id` = {$k}";
			spClass("lib_forum")->runsql($SQL);
		}
		$this->success("排序成功！", spUrl("admin","forum"));
	}

	//数据备份
	public function backup(){
		$db = spClass('dbbackup', array(0=>$GLOBALS['G_SP']['db'])); //初始化数据库处理
		$this->data =  $db->showAllTable($this->spArgs('chk'));  //显示表详情，如果chk问1 则检查表
		if($this->spArgs('ouall')) {
			$db->outAllData();exit;
		}
	}

	//删除用户
	public function deluser(){
		if( $uid = $this->spArgs("uid") ){
			spClass("lib_user")->delete(array('uid'=>$uid));
			$this->success("删除成功！", spUrl("admin","user"));
		}else{
			$this->jump(spUrl("admin","user"));// 无gid则直接跳转回user
		}
	}

	//置顶操作
	public function totop(){
		if( $gid = $this->spArgs("gid") ){
			$totop=spClass("lib_topic");
			$url = spUrl("main","view",array('gid'=>$gid));
			$oldtop = $totop ->find(array( 'gid' => $gid ),NULL,"top,forum");
				if ("GBADMIN" == $_SESSION["userinfo"]["acl"] || $oldtop['forum']== $_SESSION["userinfo"]["forum"]){
					$top = abs($oldtop['top'] - 1);
					$totop->updateField(array( 'gid' => $gid ), 'top', $top );
				}else{
					$this->error('您无权进行此操作',$url );
				}
			if($top == "0"){$news = "取消";}
			$this->success("已{$news}置顶！",$url);

		}else{
			$this->jump("javascript:window.history.go(-1);");
		}
	}

	//精华操作
	public function digest(){
		if( $gid = $this->spArgs("gid") ){
			$digest=spClass("lib_topic");
			$url = spUrl("main","view",array('gid'=>$gid));
			$val = $digest ->find(array( 'gid' => $gid ),NULL,"digest,uname,forum");
			if ("GBADMIN" == $_SESSION["userinfo"]["acl"] || $val['forum']== $_SESSION["userinfo"]["forum"]){
			$digestpost = abs($val['digest'] - 1);
			$digest->updateField(array( 'gid' => $gid ), 'digest', $digestpost );
			if($digestpost == "0"){
				spClass("lib_user")->decrField(array( 'uname' => $val['uname']),'digestpost');
				spClass("lib_user")->decrField(array('uname' => $val['uname']),'credits',$this->digest);
				$news = "取消";
			}else{
				spClass("lib_user")->incrField(array( 'uname' => $val['uname']),'digestpost',1);
				spClass("lib_user")->incrField(array('uname' => $val['uname']),'credits',$this->digest);

				$news = "设置为";
			}
			$this->success("已{$news}精华！",$url);
			}else{
				$this->error('您无权进行此操作',$url);
			}
		}else{
			$this->jump("javascript:window.history.go(-1);");
		}
	}

	//移动话题
	public function move(){
		$condition = array( 'gid' => $this->spArgs("gid") );
		$this->results = spClass("lib_forum")->findAll(NULL,"id ASC","id,name");
		$this->val = spClass("lib_topic") ->find($condition,NULL,"forum,gid,title");
		if( $forum = $this->spArgs("forum") ){
			if ("GBADMIN" == $_SESSION["userinfo"]["acl"] || $this->val['forum']== $_SESSION["userinfo"]["forum"]){
				spClass("lib_topic") -> updateField($condition, 'forum', $this->spArgs('forum'));
				$this->success("移动成功！", spUrl("main","view",$condition));
			}else{
					$this->error('您无权进行此操作',"javascript:window.history.go(-1);");
			}
		}
	}

	//添加版主
	public function addbm(){
		$conditions = array('uname'=>$this->spArgs('uname'));
		$gb = spClass('lib_user');
		if(false != spClass("lib_user")->find(array('uname'=>$this->spArgs('uname')))){
			$gb->updateField($conditions, 'forum', $this->spArgs('id') );
			$this->success("添加成功！", spUrl("admin","editforum",array("id"=>$this->spArgs('id'))));
		}else{
			$this->error("用户不存在！", spUrl("admin","editforum",array("id"=>$this->spArgs('id'))));
		}
	}

	//删除版主
	public function delbm(){
		$conditions = array('uname'=>$this->spArgs('uname'));
		$gb = spClass('lib_user');
		$gb->updateField($conditions, 'forum', "");
		$this->success("已取消该用户版主权限！","javascript:window.history.go(-1);");
	}

	// 版块管理
	public function forum(){
		$this->results = spClass("lib_forum")->findAll(NULL,"`order` ASC");
	}

	//删除版块保留话题
	public function delforum(){
		// 这里先判断是否传入了id
		if( $id = $this->spArgs("id") ){
			spClass("lib_forum")->delete(array('id'=>$id));
			$this->success("删除成功！", spUrl("admin","forum"));
		}else{
			// 无gid则直接跳转回forum
			$this->jump(spUrl("admin","forum"));
		}
	}

	// 版块添加
	public function addforum(){
		if($this->spArgs("name")):
			$addforum = spClass("lib_forum");
			$newrow = array(
				'name' => $this->spArgs('name'),
				'color' => $this->spArgs('color'),
				'instruc' => $this->spArgs('5'),
			);
			$addforum->create($newrow);
			$this->success("添加成功！", spUrl("admin","forum"));
		else:
			$this->jump(spUrl("admin","forum"));
		endif;
	}

	//板块编辑
	public function editforum(){
        if( $id = $this->spArgs("id") ){
			$this->info = spClass("lib_forum")->find(array('id'=>$id));
			$this->results = spClass("lib_user")->findAll(array('forum'=>$id),NULL,"uname");
        }else{
            $this->jump(spUrl("admin","forum"));
        }
    }

	//板块编辑执行
	public function forumedited(){
        $conditions = array('id'=>$this->spArgs('id'));
        $gb = spClass('lib_forum');
		@$gb->update($conditions,$this->spArgs());
		$this->success("编辑成功！", spUrl("admin","forum"));

	}

	// 权限管理
	public function acl(){
		$this->results = spClass("lib_acl")->findAll(NULL,"aclid ASC","aclid,name,controller,action,acl_name");
	}

	//删除权限
	public function delacl(){
		if( $aclid = $this->spArgs("aclid") ){
			spClass("lib_acl")->delete(array('aclid'=>$aclid));
			$this->success("删除成功！", spUrl("admin","acl"));
		}else{
			$this->jump(spUrl("admin","acl"));
		}
	}

	// 权限添加
	public function addacl(){
		$addforum = spClass("lib_acl");
		$newrow = array(
			'name' => $this->spArgs('name'),
			'controller' => $this->spArgs('controller'),
			'action' => $this->spArgs('action'),
			'acl_name' => $this->spArgs('acl_name'),
		);
		$addforum->create($newrow);
		$this->success("添加成功！", spUrl("admin","acl"));

	}

	// 导出到csv文件
	function derivecsv() {
		$time=date('Y-m-d H:i');
		header("Content-Type: text/csv");
		header("Content-Disposition: attachment; filename=用户信息{$this->time}.csv");
		header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
		header('Expires:0');
		header('Pragma:public');
		$results = spClass("lib_user")->findAll();
		print <<<CSV
"用户信息列表","{$time}","","","","","","","","","","","","","","",""
 UID,"用户名","积分","发帖数","精华数","现居地","性别","出生日期","真实姓名","认证情况","个人介绍","个性签名","联系方式","联系电话","电子邮箱","QQ","注册日期"

CSV;
		foreach($results as $one){
			$ctime = date("Y-m-d H:i", $one["ctime"]);
			if ($one["male"] ==1) {
				$sex = "男";
			}elseif ($one["male"] ==2) {
				$sex = "女";
			}
			print <<<CSV
{$one["uid"]},"{$one["uname"]}","{$one["credits"]}","{$one["post"]}","{$one["digestpost"]}","{$one["live"]}","{$sex}","{$one["birth"]}","{$one["truename"]}","{$one["admit"]}","{$one["introduce"]}","{$one["signature"]}","{$one["address"]}","{$one["phone"]}","{$one["email"]}","{$one["qq"]}","'{$ctime}"

CSV;
		}
    }

}