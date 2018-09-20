<? 
const HOST = "http://50.bn.ru/sale/";
const SORTBY = "price";
const SORTORDER = "DESC";
include 'functions.php';
$table= "";
$type = "";

if (isset($_GET['form'])) 
{
	$type = 		htmlspecialchars($_GET["type"] );
	$price_from = 	filterNumber($_GET['price_from']);
	$price_to = 	filterNumber($_GET['price_to']);
	$rooms=			isset($_GET['rooms']) ? $_GET['rooms'] : null;
	$only_photo=	isset($_GET['photo']);
	
	if	(($price_to!=0) && ($price_from > $price_to)) 
	{   
		$price_from=0;
	}
			
	$data = array('rooms' => $rooms,
				  'only_photo'=> $only_photo,
				  'price' => array ('from' => $price_from,
									'to' => $price_to)
				  );

	$query = HOST.$type."/?sort=".SORTBY."&sortorder=".SORTORDER."&". http_build_query($data);
	
	$content=getUrlContent($query);
	$content = mb_convert_encoding($content, 'utf-8', 'CP1251');
	if ($content) 
	{		
		$table= get_table($content, "result");
	}
	else 
		$table= "Не удалось подключится к сайту";
}
?>