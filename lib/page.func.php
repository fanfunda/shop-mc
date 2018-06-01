<?php 
//require_once '../include.php';
//$sql="select * from imooc_admin";
//$totalRows=getResultNum($sql);
////echo $totalRows;
//$pageSize=2;
////得到总页码数
//$totalPage=ceil($totalRows/$pageSize);
//$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
//if($page<1||$page==null||!is_numeric($page)){
//	$page=1;
//}
//if($page>=$totalPage)$page=$totalPage;
//$offset=($page-1)*$pageSize;
//$sql="select * from imooc_admin limit {$offset},{$pageSize}";
////echo $sql;
//$rows=fetchAll($sql);
////print_r($rows);
//foreach($rows as $row){
//	echo "编号：".$row['id'],"<br/>";
//	echo "管理员的名称:".$row['username'],"<hr/>";
//}
//echo showPage($page,$totalPage);
//echo "<hr/>";
//echo showPage($page,$totalPage,"cid=5&pid=6");

// 显示页码
function showPage($page,$totalPage,$where=null,$sep="&nbsp;"){
	// 条件限制
	$where=($where==null)?null:"&".$where;
	// 当前设备路径
	$url = $_SERVER ['PHP_SELF'];
	// 如果当前为首页，首页为文字，不可点击，否则为超链接
	$index = ($page == 1) ? "首页" : "<a href='{$url}?page=1{$where}'>首页</a>";
	// 如果当前为尾页，尾页为文字，不可点击，否则为超链接
	$last = ($page == $totalPage) ? "尾页" : "<a href='{$url}?page={$totalPage}{$where}'>尾页</a>";
	$prevPage=($page>=1)?$page-1:1;
	$nextPage=($Page>=$totalPage)?$totalPage:$page+1;
	// 如果当前为首页，上一页为文字，不可点击，否则为超链接
	$prev = ($page == 1) ? "上一页" : "<a href='{$url}?page={$prevPage}{$where}'>上一页</a>";
	// 如果当前为尾页，下一页为文字，不可点击，否则为超链接
	$next = ($page == $totalPage) ? "下一页" : "<a href='{$url}?page={$nextPage}{$where}'>下一页</a>";
	// 总共多少页，当前是第几
	$str = "总共{$totalPage}页/当前是第{$page}页";
	// 循环输出页码
	for($i = 1; $i <= $totalPage; $i ++) {
		//当前页无连接
		if ($page == $i) {
			$p .= "[{$i}]";
		} else {
			$p .= "<a href='{$url}?page={$i}{$where}'>[{$i}]</a>";
		}
	}
	// 
 	$pageStr=$str.$sep . $index .$sep. $prev.$sep . $p.$sep . $next.$sep . $last;
 	return $pageStr;
}


