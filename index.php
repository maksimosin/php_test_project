<? 
const HOST = "http://50.bn.ru/sale/";
const SORTBY = "price";
const SORTORDER = "DESC";
include 'functions.php';

if (isset($_GET['form'])) 
{
	$type = 		htmlspecialchars($_GET["type"] );
	$price_from = 	filterNumber($_GET['price_from']);
	$price_to = 	filterNumber($_GET['price_to']);
	
	if	(($price_to!=0) && ($price_from > $price_to)) 
	{   
		$price_from=0;
	}
			
	$data = array('rooms' => $_GET['rooms'],
				  'only_photo'=> isset($_GET['photo']),
				  'price' => array ('from' => $price_from,
									'to' => $price_to)
				  );

	$query = HOST.$type."/?sort=".SORTBY."&sortorder=".SORTORDER."&". http_build_query($data);
	
	$content=getUrlContent($query);
}
?>
<html >
<head>
</head>
<body>
<form  >

<label for="type">��� ������������ <select name="type" >
	<option disabled="disabled">�����</option>                                    
	<option <?= ($_GET[type]=='city/flats')? "selected" : "" ?> value="city/flats">�������� (��������)</option>                        
	<option <?= ($_GET[type]=='city/rooms')? "selected" : "" ?> value="city/rooms">�������</option>                        
	<option <?= ($_GET[type]=='city/elite')? "selected" : "" ?> value="city/elite">������� ������������</option>                        
	<option <?= ($_GET[type]=='city/newflats')? "selected" : "" ?> value="city/newflats">�����������</option>                        
	<option disabled="disabled">����������</option>                                    
	<option <?= ($_GET[type]=='country/houses')? "selected" : "" ?> value="country/houses" >����</option>                        
	<option <?= ($_GET[type]=='country/cottages')? "selected" : "" ?> value="country/cottages">��������</option>                        
	<option <?= ($_GET[type]=='country/lands')? "selected" : "" ?> value="country/lands">�������</option>                        
	<option disabled="disabled">������������</option>                                    
	<option <?= ($_GET[type]=='commerce/offices')? "selected" : "" ?> value="commerce/offices">�����</option>                        
	<option <?= ($_GET[type]=='commerce/comm_new')? "selected" : "" ?> value="commerce/comm_new">��������� � ���������� �����</option>                        
	<option <?= ($_GET[type]=='commerce/service')? "selected" : "" ?> value="commerce/service">��������� � ����� �����</option>                        
	<option <?= ($_GET[type]=='commerce/different')? "selected" : "" ?> value="commerce/different">��������� ���������� ����������</option>                        
	<option <?= ($_GET[type]=='commerce/freestanding')? "selected" : "" ?> value="commerce/freestanding">�������� ������� ������</option>                        
	<option <?= ($_GET[type]=='commerce/storage')? "selected" : "" ?> value="commerce/storage">���������������-��������� ���������</option>                        
	<option <?= ($_GET[type]=='commerce/comm_lands')? "selected" : "" ?> value="commerce/comm_lands">��������� �������</option>            		
</select>
<label for="price_from">���� ��</label>
<input type="number" name="price_from" step=50000 min=0 value="<?= $price_from ?>"> �� 
<input type="number" name="price_to" step=50000 min=0  value="<?= $price_to ?>">
<label for="rooms">������� 1<input type="checkbox" name="rooms[1]" value ="1" <?= isset($_GET[rooms][1])? "checked" : "" ?>>
2 <input type="checkbox" name="rooms[2]" value="2" <?= isset($_GET[rooms][2])? "checked" : "" ?>>
3 <input type="checkbox" name="rooms[3]" value="3" <?= isset($_GET[rooms][3])? "checked" : "" ?>>
4 <input type="checkbox" name="rooms[4]" value="4" <?= isset($_GET[rooms][4])? "checked" : "" ?>>
5+ <input type="checkbox" name="rooms[5]" value="5" <?= isset($_GET[rooms][5])? "checked" : "" ?>>
������ � ���� <input type="checkbox" name="photo"  <?= isset($_GET[photo])? "checked" : "" ?>>
<input type="hidden" name="form" value="1">
<input type="submit" value="�����">
</form>

<table align="center">
<tr><td>
<?  // ������� �������
if (isset($_GET['form']))
{
	if ($content) 
	{
		$begin = stripos($content, 'class="result"')+15;
		$end   = stripos($content, '<div class="pager">');
		$content = substr($content, $begin, $end - $begin); // ������� ������ �������
		$content = preg_replace("#<a href=[^>]*(.*?)<\/a>#is", "\$1", $content); //�������� ������������ ������
		echo $content;
	}
	else echo "�� ������� ����������� � �����";
}
?>
</td></tr>
</table>
</body>
</html>