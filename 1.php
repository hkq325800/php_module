<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>第一个php程序（获取服务器信息）</title>
</head>>
<body>
<?php
/* Report all errors except E_NOTICE */
error_reporting(E_ALL^E_NOTICE);

$sysos=$_SERVER["SERVER_SOFTWARE"];
$sysversion=php_version;

/*pdo构造数据源、初始化一个pdo对象
$count = $db->exec("INSERT INTO foo SET name = 'heiyeluren',gender='男',time=NOW()");[sql举例]
默认这个不是长连接，如果需要数据库长连接，变成这样：$db = new PDO($dsn, 'root', '', array(PDO::ATTR_PERSISTENT => true));*/
$dsn = "mysql:host=http://www.flappyant.com;dbname=library";
$db = new PDO($dsn, 'mengma', 'mengma');

//mysql_connect("localhost","root");
$mysqlinfo=mysql_get_server_info();

if(function_exists("gd_info")){
	$gd=gd_info();
	$gdinfo=$gd['GD Version'];
}else{
	$gdinfo="未知";
}

$freetype=$gd["FreeType Support"]?"支持":"不支持";

$allowurl=ini_get("allow_url_fopen")?"支持":"不支持";

$max_upload=ini_get("file_uploads")?ini_get("upload_max_filesize"):"Disable";

$max_ex_time=ini_get("max_excution_time")."秒";

date_default_timezone_set("Etc/GMT-8");
$systemtime=date("Y-m-d H:i:s",time());

echo "<table align=center cellspacing=0 cellpadding=0>";
echo "<caption> <h2> 系统信息 </h2> </caption>";
echo "<tr> <td> Web服务器: </td> <td> $sysos </td></tr>";
echo "<tr> <td> PHP版本: </td> <td> $sysversion </td></tr>";
echo "<tr> <td> MySQL版本: </td> <td> $mysqlinfo </td></tr>";
echo "<tr> <td> GD库版本: </td> <td> $gdinfo </td></tr>";
echo "<tr> <td> FreeType: </td> <td> $freetype </td></tr>";
echo "<tr> <td> 远程文件获取: </td> <td> $allowurl </td></tr>";
echo "<tr> <td> 最大上传限制: </td> <td> $max_upload </td></tr>";
echo "<tr> <td> 最大执行时间: </td> <td> $max_ex_time </td></tr>";
echo "<tr> <td> 服务器时间: </td> <td> $systemtime </td></tr>";
echo "</table>";

//pdo结束对象资源
$db = null;
?>
</body>
</html>
