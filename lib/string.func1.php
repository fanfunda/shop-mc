<?php 
/**
 * 生成验证码
 * @param int $type
 * @param int $length
 * @return string
 */
function buildRandomString($type=1,$length=4){
	if ($type == 1) {
		// 类型一 随机生成纯数字字符串
		$chars = join ( "", range ( 0, 9 ) );
	} elseif ($type == 2) {
		// 类型二 随机生成纯字母字符串
		$chars = join ( "", array_merge ( range ( "a", "z" ), range ( "A", "Z" ) ) );
	} elseif ($type == 3) {
		// 类型三 随机生成字母和数字字符串
		$chars = join ( "", array_merge ( range ( "a", "z" ), range ( "A", "Z" ), range ( 0, 9 ) ) );
	}

	// 如果验证码长度大于随机生成的字符串长度
	if ($length > strlen ( $chars )) {
		exit ( "字符串长度不够" );
	}
	// 打乱随机生成的字符串
	$chars = str_shuffle ( $chars );
	// 截取指定位数的字符串，形成初始验证码
	return substr ( $chars, 0, $length );
}

/**
 * 生成唯一字符串
 * @return string
 */
function getUniName(){
	return md5(uniqid(microtime(true),true));
}

/**
 * 得到文件的扩展名
 * @param string $filename
 * @return string
 */
function getExt($filename){
	return strtolower(end(explode(".",$filename)));
}
