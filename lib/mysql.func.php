<?php 
/**
 * 连接数据库
 * @return resource
 */
function connect(){
	// 输入服务器地址、用户名、密码，连接服务器
	$link=mysql_connect(DB_HOST,DB_USER,DB_PWD) or die("数据库连接失败Error:".mysql_errno().":".mysql_error());
	// 设置字符集
	mysql_set_charset(DB_CHARSET);
	// 打开指定数据库
	mysql_select_db(DB_DBNAME) or die("指定数据库打开失败");
	return $link;
}

/**
 * 完成记录插入的操作
 * @param string $table
 * @param array $array
 * @return number
 */
// 封装数据库插入数据函数
function insert($table,$array){
	// 字段，join返回由数组元素组合成的字符串，第一个参数放置在数组元素之间
	$keys=join(",",array_keys($array));
	// 插入数值
	$vals="'".join("','",array_values($array))."'";
	// 拼合sql语句
	$sql="insert {$table}($keys) values({$vals})";
	// 执行sql语句,返回资源标识符
	mysql_query($sql);
	// 返回上一步 INSERT 操作产生的 ID
	return mysql_insert_id();
}
//update imooc_admin set username='king' where id=1
/**
 * 记录的更新操作
 * @param string $table
 * @param array $array
 * @param string $where
 * @return number
 */
// 封装数据库更新数据函数
function update($table,$array,$where=null){
	foreach($array as $key=>$val){
		if($str==null){
			$sep="";
		}else{
			$sep=",";
		}
		// 需要更改的数据
		$str.=$sep.$key."='".$val."'";
	}
		// 拼合sql语句
		$sql="update {$table} set {$str} ".($where==null?null:" where ".$where);
		// 执行sql语句,返回资源标识符
		$result=mysql_query($sql);
		
		if($result){
			// mysql_affected_rows返回上一次受增删改影响的行数
			return mysql_affected_rows();
		}else{
			return false;
		}
}

/**
 *	删除记录
 * @param string $table
 * @param string $where
 * @return number
 */
// 封装数据库删除数据函数
function delete($table,$where=null){
	// 条件，判断条件是否为空
	$where=$where==null?null:" where ".$where;
	// 拼合sql语句
	$sql="delete from {$table} {$where}";
	// 执行sql语句,返回资源标识符
	mysql_query($sql);
	// mysql_affected_rows返回上一次受增删改影响的行数
	return mysql_affected_rows();
}

/**
 *得到指定一条记录
 * @param string $sql
 * @param string $result_type
 * @return multitype:
 */
// 封装查看指定一条记录函数
function fetchOne($sql,$result_type=MYSQL_ASSOC){
	// 执行sql语句,返回资源标识符
	$result=mysql_query($sql);
	// 默认返回关联数组
	$row=mysql_fetch_array($result,$result_type);
	return $row;
}


/**
 * 得到结果集中所有记录 ...
 * @param string $sql
 * @param string $result_type
 * @return multitype:
 */
// 封装查看所有记录函数
function fetchAll($sql,$result_type=MYSQL_ASSOC){
	$result=mysql_query($sql);
	while(@$row=mysql_fetch_array($result,$result_type)){
		$rows[]=$row;
	}
	return $rows;
}

/**
 * 得到结果集中的记录条数
 * @param unknown_type $sql
 * @return number
 */
function getResultNum($sql){
	$result=mysql_query($sql);
	return mysql_num_rows($result);
}

/**
 * 得到上一步插入记录的ID号
 * @return number
 */
function getInsertId(){
	return mysql_insert_id();
}

