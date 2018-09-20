<?
function getUrlContent($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	$data = curl_exec($ch);
	$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	return ($httpcode>=200 && $httpcode<300) ? $data : false;
}

function filterNumber ($string)
{
	return isset($string) ? (int) preg_replace("/[^0-9]/", '', $string) : 0;
}

function get_table ($content, $table_class)
{
	$begin_str ='class="'.$table_class.'">';  //начало
	$begin_position = stripos($content, $begin_str)+strlen($begin_str);
	
	$end_str = '<div class="pager">'; // конец таблицы
	$end_position   = stripos($content, $end_str) ;
	
	$table = substr($content, $begin_position, $end_position - $begin_position); // Вырежем только таблицу
	$table = preg_replace("#<a href=[^>]*(.*?)<\/a>#is", "\$1", $table); //Удаление ссылок
	
	return $table;
}

?>