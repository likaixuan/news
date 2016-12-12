<?php
	header('Content-type:text/html;charset=utf-8');
	//判断参数是否存在
	http://www.itbangbang.vip?type=top&callback=json；
	if(isset($_GET['type'])&&isset($_GET['key'])){
		$url="http://v.juhe.cn/toutiao/index?type={$_GET['type']}&key={$_GET['key']}";
		$ret=file_get_contents($url);
		echo $ret;
	}else{//参数错误，返回0
		echo 0;
	}
