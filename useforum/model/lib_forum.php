<?php
/**
 * Useforum  Copyright (C) 2010-2013 版块模型
 * 添加日期 2012 GW
 */
class lib_forum extends spModel
{
	var $pk = "id"; // 每个留言唯一的标志，可以称为主键
	var $table = "forum"; // 数据表的名称
	//关联话题表，获得话题数
	var $linker = array(
		array(
			'type' => 'hasmany',   // 关联类型，这里是一对一关联
			'map' => 'topicnum',    // 关联的标识
			'mapkey' => 'id', // 本表与对应表关联的字段名
			'fclass' => 'lib_topic', // 对应表的类名
			'fkey' => 'forum',    // 对应表中关联的字段名
			'enabled' => true ,    // 启用关联
			'countonly' => true,
		),
		array(
			'type' => 'hasmany', // 分类对文章是一对多关联
			'map' => 'bm', // 关联标识
			'mapkey' => 'id', // 关联分类ID
			'fclass' => 'lib_user', // 文章对象
			'fkey' => 'forum', // 关联分类ID
			'field' => 'uname',
			'enabled' => true,
		),
		array(
			'type' => 'hasmany',   // 关联类型，这里是一对一关联
			'map' => 'newpost',    // 关联的标识
			'mapkey' => 'id', // 本表与对应表关联的字段名
			'fclass' => 'lib_topic', // 对应表的类名
			'fkey' => 'forum',    // 对应表中关联的字段名
			'enabled' => true ,    // 启用关联
			'limit' => '1', // 限制返回10条文章记录
			'sort' => 'rtime DESC',
			'field' => 'title,gid,rtime',
		)
	);
}