<?include 'process.php';?>
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
<input type="number" name="price_from" step=50000 min=0 value="<?= $price_from ?>"> до 
<input type="number" name="price_to" step=50000 min=0  value="<?= $price_to ?>">
<label for="rooms">Комнаты 1<input type="checkbox" name="rooms[1]" value ="1" <?= isset($_GET[rooms][1])? "checked" : "" ?>>
2 <input type="checkbox" name="rooms[2]" value="2" <?= isset($_GET[rooms][2])? "checked" : "" ?>>
3 <input type="checkbox" name="rooms[3]" value="3" <?= isset($_GET[rooms][3])? "checked" : "" ?>>
4 <input type="checkbox" name="rooms[4]" value="4" <?= isset($_GET[rooms][4])? "checked" : "" ?>>
5+ <input type="checkbox" name="rooms[5]" value="5" <?= isset($_GET[rooms][5])? "checked" : "" ?>>
только с фото <input type="checkbox" name="photo"  <?= isset($_GET[photo])? "checked" : "" ?>>
<input type="hidden" name="form" value="1">
<input type="submit" value="Найти">
</form>
<br><br>
<table align="center">
<tr><td>
<?= $table?>
</td></tr>
</table>
</body>
</html>