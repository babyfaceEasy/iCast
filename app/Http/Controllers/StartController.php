<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Start;

use App\Http\Requests;

class StartController extends Controller
{

	public function index()
	{
		$markers = Start::all();

		$iden_new_arr = array();
		/*$markers_new = $markers->each(function($item, $key){
			
			$item_arr = $item->toArray();
			$identifier_arr = explode("_", $item_arr['identifier'], -1);
			$location = array('lat' => $identifier_arr[0], 'lng' => $identifier_arr[1]);
			$iden_new_arr[] = $location;
			return $location;


			//echo json_encode($iden_new_arr);
			//return false;
				
		});*/
		
		for($i = 0; $i < count($markers->toArray()); $i++){
			$item_arr = $markers->toArray();
			$identifier_arr = explode("_", $item_arr[$i]['identifier'], -1);
			$location = array('id'=>$item_arr[$i]['id'], 'lat' => $identifier_arr[0], 'lng' => $identifier_arr[1]);
			$iden_new_arr[] = $location;
		}
		
		//print_r(json_encode($iden_new_arr));
		return view('layouts.base', ['markers' => json_encode($iden_new_arr)]);
	}

	public function getCoordinatesImage($id)
	{
		$row = Start::find($id);
		if($row !== null){
			return $row->pic_names;
		}else{
			return "error";
		}
	}

    public function store()
    {
    	$coordiantes = array(
		'9.076479_7.398574',
		'6.465353_3.4511',
		'6.611396_3.345191',
		'6.632661_3.341303',
		'9.085198_7.497654',
		'6.386812_7.492579',
		'6.422827_3.412559',
		'7.792636_4.578552',
		'7.48775_3.919373',
		'6.348056_5.630493',
		'5.025283_8.33313',
		'6.686431_3.43872',
		'10.660608_12.271729',
		'7.406048_11.744385'
		);

		for ($i = 0; $i < count($coordiantes); $i++) {
			$coordiantes[$i] = $coordiantes[$i] . '_' . date('d/m/Y H:i:s');
			$start = new Start;
    		$start->identifier = $coordiantes[$i];
    		$start->save();
		}

		return view('test_far');
    }
}
