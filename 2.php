<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>开启php模式的四对不同的开始和结束标记</title>
</head>
<body>

	<?php
	/* Report all errors except E_NOTICE */
	error_reporting(E_ALL^E_NOTICE);
		echo "1.这个标记是标准的php语言标记";
	?>
	
	<script language="php">
	echo "2.这个标记是脚本风格，是最长的标记。";
	</script>
	<? echo "3.这个标记风格是最简单的" ?>
	<?= $expression ?>这也是一种简写方式，等价于<? echo $expression ?>
	<% echo "4.这个标记风格类似于asp标签的写法" %>
	<%= $expression %>这也是一种简写方式，等价于<% echo $expression %>
</body>
</html>