<?php 
// 加载include.php文件
require_once '../include.php';
// 接收login.php以post方法传来的name=username的数据
$username=$_POST['username'];
$username=addslashes($username);
// 接收login.php以post方法传来的name=password的数据，并进行加加密
$password=md5($_POST['password']);
// 接收login.php以post方法传来的name=verify的数据
$verify=$_POST['verify'];
// 前一次生成的验证码
$verify1=$_SESSION['verify'];
// 接收login.php以post方法传来的name=autoFlag的数据
$autoFlag=$_POST['autoFlag'];
// 判断验证码是否正确
if($verify==$verify1){
	/* sql语句，查看所有来自imooc_admin数据表的当username='{$username}' 
	and password='{$password}'时所产生的数据*/
	$sql="select * from imooc_admin where username='{$username}' and password='{$password}'";
	// 调用验证管理员函数
	$row=checkAdmin($sql);
	if($row){
		//如果选了一周内自动登陆
		if($autoFlag){
			setcookie("adminId",$row['id'],time()+7*24*3600);
			setcookie("adminName",$row['username'],time()+7*24*3600);
		}
		// 验证用户数据是否一致
		$_SESSION['adminName']=$row['username'];
		// 验证用户ID
		$_SESSION['adminId']=$row['id'];
		// 提示登录成功，并跳转到index.php页面
		alertMes("登录成功","index.php");
	}else{
		// 提示登录失败，并跳转到login.php页面
		alertMes("登录失败，重新登陆","login.php");
	}
}else{
	// 提示验证码错误，并跳转到login.php页面
	alertMes("验证码错误","login.php");
}