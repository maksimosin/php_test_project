<? 
if (isset($_GET['form'])) // If the "Search" button pressed
{
	$type = htmlspecialchars($_GET["type"] );
	
	if (isset($_GET['price_from']))
	{			
		$price_from = (int) preg_replace("/[^0-9]/", '', $_GET['price_from']);
		$price_from_par= "price[from]=".$price_from;
	} 
	else $price_from=0;
	
	if (isset($_GET['price_to']))
	{			
		$price_to = (int) preg_replace("/[^0-9]/", '', $_GET['price_to']);
		$price_to_par= "price[to]=".$price_to;
	} 
	else $price_to=0;
	
	if	(isset($_GET['price_from'])&&isset($_GET['price_to'])&&($price_from>$price_to)) 
		{   //Если "цена от" больше, чем "цена до"
			$price_from_par = ""; 
			$price_from="";
		}
		
	$room1 = isset($_GET['rooms1'])? "rooms[]=1" : "";
	$room2 = isset($_GET['rooms2'])? "rooms[]=2" : "";
	$room3 = isset($_GET['rooms3'])? "rooms[]=3" : "";
	$room4 = isset($_GET['rooms4'])? "rooms[]=4" : "";
	$room5 = isset($_GET['rooms5'])? "rooms[]=5" : "";
	$photo = isset($_GET['photo'])? "only_photo=1" : "";
	
	/*$data = array('foo'=>'bar',
              'baz'=>'boom',
              'cow'=>'milk',
              'php'=>'hypertext processor');
              
echo http_build_query($data);*/
	$content=getUrlContent("http://50.bn.ru/sale/$type/?$price_from_par&$price_to_par&$room1&$room2&$room3&$room4&$room5&$photo");
	
}

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
?>

<html >
<head>
</head>
<body>
<form  >

<label for="type">Тип недвижимости <select name="type" >
	<option disabled="disabled">жилая</option>                                    
	<option <?= ($_GET[type]=='city/flats')? "selected" : "" ?> value="city/flats">квартиры (вторичка)</option>                        
	<option <?= ($_GET[type]=='city/rooms')? "selected" : "" ?> value="city/rooms">комнаты</option>                        
	<option <?= ($_GET[type]=='city/elite')? "selected" : "" ?> value="city/elite">элитная недвижимость</option>                        
	<option <?= ($_GET[type]=='city/newflats')? "selected" : "" ?> value="city/newflats">новостройки</option>                        
	<option disabled="disabled">загородная</option>                                    
	<option <?= ($_GET[type]=='country/houses')? "selected" : "" ?> value="country/houses" >дома</option>                        
	<option <?= ($_GET[type]=='country/cottages')? "selected" : "" ?> value="country/cottages">коттеджи</option>                        
	<option <?= ($_GET[type]=='country/lands')? "selected" : "" ?> value="country/lands">участки</option>                        
	<option disabled="disabled">коммерческая</option>                                    
	<option <?= ($_GET[type]=='commerce/offices')? "selected" : "" ?> value="commerce/offices">офисы</option>                        
	<option <?= ($_GET[type]=='commerce/comm_new')? "selected" : "" ?> value="commerce/comm_new">помещения в строящихся домах</option>                        
	<option <?= ($_GET[type]=='commerce/service')? "selected" : "" ?> value="commerce/service">помещения в сфере услуг</option>                        
	<option <?= ($_GET[type]=='commerce/different')? "selected" : "" ?> value="commerce/different">помещения различного назначения</option>                        
	<option <?= ($_GET[type]=='commerce/freestanding')? "selected" : "" ?> value="commerce/freestanding">отдельно стоящие здания</option>                        
	<option <?= ($_GET[type]=='commerce/storage')? "selected" : "" ?> value="commerce/storage">производственно-складские помещения</option>                        
	<option <?= ($_GET[type]=='commerce/comm_lands')? "selected" : "" ?> value="commerce/comm_lands">земельные участки</option>            		
</select>
<label for="price_from">Цена от</label>
<input type="number" name="price_from" step=50000 min=0 max=10000000 value="<?= $price_from ?>"> до 
<input type="number" name="price_to" step=50000 min=100000 max=10000000 value="<?= $price_to ?>">
<label for="rooms">Комнаты 1<input type="checkbox" name="rooms1" value ="1" <?= isset($_GET[rooms1])? "checked" : "" ?>>
2 <input type="checkbox" name="rooms2" <?= isset($_GET[rooms2])? "checked" : "" ?>>
3 <input type="checkbox" name="rooms3" <?= isset($_GET[rooms3])? "checked" : "" ?>>
4 <input type="checkbox" name="rooms4" <?= isset($_GET[rooms4])? "checked" : "" ?>>
5+ <input type="checkbox" name="rooms5" <?= isset($_GET[rooms5])? "checked" : "" ?>>
только с фото <input type="checkbox" name="photo" <?= isset($_GET[photo])? "checked" : "" ?>>
<input type="hidden" name="form" value="1">
<input type="submit" value="Найти">
</form>

<table align="center">
<tr><td>
<?  // Выведем таблицу
if ($content==false) echo "Не удалось подключится к сайту";
else
{
	$begin = stripos($content, 'class="result"')+15;
	$content = substr($content, $begin, stripos($content, '<div class="pager">')- $begin); // Вырежем только таблицу
	$content = preg_replace("#<a href=[^>]*(.*?)<\/a>#is", "\$1", $content); //Удаление неработающей ссылки
	echo $content;
}
?>
</td></tr>
</table>
</body>
</html>
