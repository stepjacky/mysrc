<?php 
/**
 * PHP4 JSON Encode 函数
 */

/**
 * 用了很多callback,本来想用create_function(lambda style)的,但那种方式内存占用过大
 而且最别扭的是PHP 函数里的static变量不能设为函数返回值,而且函数(包括lambda)
 * 始终是全局访问权限,不能以类似closure的方式读取嵌套在外层的函数里的变量的值
 最好只好多声明几个全局函数了
 针对PHP4的json_encode与json_decode实现,官方有一个pear包 Services_JSON
 * 特地两者进行对比:
 * jsonEncode函数执行速度是 Services_JSON->encode的3倍
 jsonDecode函数执行速度是 Services_JSON->decode的6倍
 唯一不足的是jsonEncode函数内存占用要超过Services_JSON->encode
 * 而jsonDecode内存占用则要比 Services_JSON->decode少得多(少了一位数)
 *
 * jsonDecode函数支持无限层嵌套的数组(只要机器吃得消就行)
 * 主要得益于使用了eval,而且速度也快了许多

 * 可以在PHP5使用下面的方式测试,几乎与内置的函数输出结果一样

 * echo jsonEncode($_SERVER)==json_encode($_SERVER);
 * echo jsonEncode(jsonDecode(json_encode($_SERVER)))==json_encode($_SERVER);
 * echo print_r(jsonDecode(jsonEncode($_SERVER)),true)==print_r($_SERVER,true);
 *
 * 不同的一点是PHP5中json_decode返回一个stdClass,而这里的jsonDecode返回的是数组
 */
function jsonEncode($data){
	//return json_encode($data);
	if (2 == func_num_args()){
		$callee = __FUNCTION__;
		return json_format_scalar(strval(func_get_arg(1))) . ":" . $callee($data);
	}
	is_object($data) && $data = get_object_vars($data);
	if (is_scalar($data)){
		return json_format_scalar($data);
	}
	if (empty($data)){
		return '[]';
	}
	$keys = array_keys($data);
	if (is_numeric(join('', $keys))){
		$data = array_map(__FUNCTION__, $data);
		return '[' . join(',', $data) . ']';
	}else{
		$data = array_map(__FUNCTION__, array_values($data), $keys);
		return '{' . join(',', $data) . '}';
	}
}
function json_format_scalar($value){
	if (is_bool($value)){
		$value = $value?'true':'false';
	}else if (is_int($value)){
		$value = (int)$value;
	}else if (is_float($value)){
		$value = (float)$value;
	}else if (is_string($value)){
		$value = addcslashes($value, "\n\r\"\/\\");
		$value = '"' . preg_replace_callback('|[^\x00-\x7F]+|', 'json_utf_slash_callback', $value) . '"';
	}else{
		$value = 'null';
	}
	return $value;
}
function json_utf_slash_callback($data){
	if (is_array($data)){
		$chars = str_split(iconv("UTF-8", "UCS-2", $data[0]), 2);
		$chars = array_map(__FUNCTION__, $chars);
		return join("", $chars);
	}else{
		$char1 = dechex(ord($data{0}));
		$char2 = dechex(ord($data{1}));
		return sprintf("\u%02s%02s", $char1, $char2);
	}
}
function json_utf_slash_strip($data){
	if (is_array($data)){
		return iconv("UCS-2", "UTF-8", chr(hexdec($data[1])) . chr(hexdec($data[2])));
	}else{
		return preg_replace_callback('/(?<!\\\)\\\u([a-f0-9]{2})([a-f0-9]{2})/', __FUNCTION__, $data);
	}
}
function jsonDecode($data){
	static $strings, $count = 0;
	if (is_string($data)){
		$data = trim($data);
		if ($data{0} != '{' && $data{0} != '[') return json_utf_slash_strip($data);
		$strings = array();
		$data = preg_replace_callback('/"([\s\S]*?(?<!(?<!\\\)\\\))"/', __FUNCTION__, $data);
		// 简单的危险性检测
		$cleanData = str_ireplace(array('true', 'false', 'undefined', 'null', '{', '}', '[', ']', ',', ':', '#'), '', $data);
		if (!is_numeric($cleanData)){
			throw new Exception('Dangerous!The JSONString is dangerous!');
			return NULL;
		}
		$data = str_replace(
		array('{', '[', ']', '}', ':', 'null'),
		array('array(', 'array(', ')', ')', '=>', 'NULL')
		, $data);
		$data = preg_replace_callback('/#\d+/', __FUNCTION__, $data);
		// 抑制错误,诸如{123###}这样错误的JSON是不能转换成PHP数组的
		@$data = eval("return $data;");
		$strings = $count = 0;
		return $data;
	}elseif (count($data) > 1){ // 存储字符串
		$strings[] = json_utf_slash_strip(str_replace(array('$', '\\/'), array('\\$', '/'), $data[0]));
		return '#' . ($count++);
	}else{ // 读取存储的值
		$index = substr($data[0], 1);
		return $strings[$index];
	}
}
?>