<?php 
/**
 * 检查管理员是否存在
 * @param unknown_type $sql
 * @return Ambigous <multitype:, multitype:>
 */
// 验证管理员函数
function checkAdmin($sql){
	// 返回调用查看一条指定记录函数的结果
	return fetchOne($sql);
}
/**
 * 检测是否有管理员登陆.
 */
// 检测是否有管理员已经登录
function checkLogined(){
	// 如果$_SESSION和$_COOKIE都为空，则跳转到login.php页面
	if($_SESSION['adminId']==""&&$_COOKIE['adminId']==""){
		alertMes("请先登录","login.php");
	}
}
/**
 * 添加管理员
 * @return string
 */
// 添加管理员函数
function addAdmin(){
	// 接收post数据
	$arr=$_POST;
	// 加密密码
	$arr['password']=md5($_POST['password']);
	if(insert("imooc_admin",$arr)){
		$mes="添加成功!<br/><a href='addAdmin.php'>继续添加</a>|<a href='listAdmin.php'>查看管理员列表</a>";
	}else{
		$mes="添加失败!<br/><a href='addAdmin.php'>重新添加</a>";
	}
	return $mes;
}

/**
 * 得到所有的管理员
 * @return array
 */
// 得到所有的管理员函数
function getAllAdmin(){
	// sql语句，从imooc_admin数据表中查看id,username,email等字段组成的列表
	$sql="select id,username,email from imooc_admin ";
	// 调用得到所有结果函数
	$rows=fetchAll($sql);
	return $rows;
}
// 得到分页管理员函数
function getAdminByPage($page,$pageSize=2){
	// sql语句，获得imooc_admin数据表中所有数据
	$sql="select * from imooc_admin";
	// 全局变量
	global $totalRows;
	// 获取总记录条数
	$totalRows=getResultNum($sql);
	global $totalPage;
	$totalPage=ceil($totalRows/$pageSize);
	if($page<1||$page==null||!is_numeric($page)){
		$page=1;
	}
	if($page>=$totalPage)$page=$totalPage;
	$offset=($page-1)*$pageSize;
	$sql="select id,username,email from imooc_admin limit {$offset},{$pageSize}";
	$rows=fetchAll($sql);
	return $rows;
}

/**
 * 编辑管理员
 * @param int $id
 * @return string
 */
// 编辑或修改管理员函数
function editAdmin($id){
	// 接收post数据
	$arr=$_POST;
	// 加密密码
	$arr['password']=md5($_POST['password']);
	if(update("imooc_admin", $arr,"id={$id}")){
		$mes="编辑成功!<br/><a href='listAdmin.php'>查看管理员列表</a>";
	}else{
		$mes="编辑失败!<br/><a href='listAdmin.php'>请重新修改</a>";
	}
	return $mes;
}

/**
 * 删除管理员的操作
 * @param int $id
 * @return string
 */
// 删除管理员函数
function delAdmin($id){
	if(delete("imooc_admin","id={$id}")){
		$mes="删除成功!<br/><a href='listAdmin.php'>查看管理员列表</a>";
	}else{
		$mes="删除失败!<br/><a href='listAdmin.php'>请重新删除</a>";
	}
	return $mes;
}

/**
 * 注销管理员
 */
// 用户退出或注销函数
function logout(){
	// 创建空数组
	$_SESSION=array();
	if(isset($_COOKIE[session_name()])){
		// 清空cookie
		setcookie(session_name(),"",time()-1);
	}
	// 清空cookie
	if(isset($_COOKIE['adminId'])){
		setcookie("adminId","",time()-1);
	}
	// 清空cookie
	if(isset($_COOKIE['adminName'])){
		setcookie("adminName","",time()-1);
	}
	// 销毁cookie
	session_destroy();
	// 跳转login.php页面
	header("location:login.php");
}
/**
 * 添加用户的操作
 * @param int $id
 * @return string
 */
function addUser(){
	$arr=$_POST;
	$arr['password']=md5($_POST['password']);
	$arr['regTime']=time();
	$uploadFile=uploadFile("../uploads");
	if($uploadFile&&is_array($uploadFile)){
		$arr['face']=$uploadFile[0]['name'];
	}else{
		return "添加失败<a href='addUser.php'>重新添加</a>";
	}
	if(insert("imooc_user", $arr)){
		$mes="添加成功!<br/><a href='addUser.php'>继续添加</a>|<a href='listUser.php'>查看列表</a>";
	}else{
		$filename="../uploads/".$uploadFile[0]['name'];
		if(file_exists($filename)){
			unlink($filename);
		}
		$mes="添加失败!<br/><a href='arrUser.php'>重新添加</a>|<a href='listUser.php'>查看列表</a>";
	}
	return $mes;
}
/**
 * 删除用户的操作
 * @param int $id
 * @return string
 */
function delUser($id){
	$sql="select face from imooc_user where id=".$id;
	$row=fetchOne($sql);
	$face=$row['face'];
	if(file_exists("../uploads/".$face)){
		unlink("../uploads/".$face);
	}
	if(delete("imooc_user","id={$id}")){
		$mes="删除成功!<br/><a href='listUser.php'>查看用户列表</a>";
	}else{
		$mes="删除失败!<br/><a href='listUser.php'>请重新删除</a>";
	}
	return $mes;
}
/**
 * 编辑用户的操作
 * @param int $id
 * @return string
 */
function editUser($id){
	$arr=$_POST;
	$arr['password']=md5($_POST['password']);
	if(update("imooc_user", $arr,"id={$id}")){
		$mes="编辑成功!<br/><a href='listUser.php'>查看用户列表</a>";
	}else{
		$mes="编辑失败!<br/><a href='listUser.php'>请重新修改</a>";
	}
	return $mes;
}