#新闻网站客户端

##下载须知
不要试图读懂我的代码
更不要试图优化我的代码
如果你想那样做
别怪我我没提醒你

##所用技术
>php做代理、解决跨域问题

>AngularJS 实现双向绑定、更新UI

>indexedDB 实现本地存储新闻

##产品介绍
移动端新闻网站、隔一段时间自动更新文章、top(头条，默认),shehui(社会),guonei(国内),guoji(国际),yule(娱乐),tiyu(体育)junshi(军事),keji(科技),caijing(财经),shishang(时尚)等栏目
##功能分析
> 1.导航栏显示不完全时(手机端)可以拖拽导航栏

> 2.每次拉取十条数据，滚到底部自动加载，当没有数据时，下方出现加载更多，更新数据


##接口分析

调用的聚合数据的新闻头条接口

接口地址：http://v.juhe.cn/toutiao/index

支持格式：json

请求方式：get/post

请求示例：http://v.juhe.cn/toutiao/index?type=top&key=APPKEY

| 名称   | 类型  | 必填  |说明 |
|:-----:|:-----:|:-------:|:-------|
|  key | string | 是 | 应用APPKEY |
| type | string | 否 |类型,,top(头条，默认),shehui(社会),guonei(国内),guoji(国际),yule(娱乐),tiyu(体育)junshi(军事),keji(科技),caijing(财经),shishang(时尚) |
>1.key是申请接口时给我们唯一的秘钥，type是新闻的类型，只要请求时带上着两个参数就好，使用很简单，不过也带来很多不方便的地方，比如我们不能要求接口返回具体条目数
>2.接口不支持jsonp跨域,所以我们必须自己搞出一个接口了，本项目是采用php做的这个中间层,我们调用接口时直接用ajax请求此文件就好

```php
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
```


###业务逻辑
把新拉取的新闻存入indexedDB数据库中、然后展现存入AngularJS 双向绑定的数组之中
需要注意的是 indexedDB 都是异步操作
