<!DOCTYPE html>
<html>
<head>
	<title>Try out</title>
</head>
<body>

<?php
	/*
		sample data (json): [{"id":5,"identifier":"6.632661_3.341303_08\/07\/2016 11:25:59","pic_names":null},{"id":6,"identifier":"9.085198_7.497654_08\/07\/2016 11:25:59","pic_names":null},{"id":7,"identifier":"6.386812_7.492579_08\/07\/2016 11:25:59","pic_names":null},{"id":8,"identifier":"6.422827_3.412559_08\/07\/2016 11:25:59","pic_names":null}] 
	*/
		
	$first_mrker = $markers->first()->toArray();
	$first_mker_arr = explode("_", $first_mrker['identifier'], -1);
	//print_r(json_encode($first_mker_arr));


	$iden_new_arr = array();
	$markers = $markers->each(function($item, $key){
		//echo 'item : '. $item .' - Key : ' . $key;
		$item_arr = $item->toArray();
		$identifier_arr = explode("_", $item_arr['identifier'], -1);
		//echo '<pre>' . var_dump($identifier_arr) . '</pre>';
		$location = array('lat' => $identifier_arr[0], 'lng' => $identifier_arr[1]);

		$iden_new_arr[] = $location;
		echo '<pre>' .print_r( $iden_new_arr) . '</pre>';

		//print_r('<pre>'. $identifier_arr .'</pre>');
		
		//this is to create the new array
		/*
		
		for($i = 0; $i < count($identifier_arr); $i++)
		{
			//print_r($identifier_arr[$i]);

			//array_push($iden_new_arr, $location);
		}*/
		//echo json_encode($iden_new_arr);
			
	});
?>
</body>
</html>