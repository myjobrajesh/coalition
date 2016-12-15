<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Validator;
use Storage;

class ProductController extends Controller
{
    public function viewProductForm(Request $request) {
        return view('layouts.product');
    }
    
    
    /* save product
     */
    public function saveProduct(Request $request) {
        //validate
        $validator = Validator::make($request->all(), array(
                'name' => 'required',
                'qty' => 'required',
                'price' => 'required'
            )
        );
        
        
        if ($validator->fails()) {
            foreach($validator->errors()->getMessages() as $msg) {
                $msgArr[] =  $msg[0];
            }
            return response()->json(["error"=>implode("<br>", $msgArr)]);
        }
        
        try {
                
            $content = ["product"=>$request->get("name"),
                        "qty"=>$request->get("qty"),
                        "price"=>$request->get("price"),
                        "created_at"=>date("Y-m-d H:i:s"),
                        "total_value"=>$request->get("price")*$request->get("qty")
                        ];
            //save to disk
            Storage::disk('product')->append('product.json', json_encode($content));
            
        } catch (Exception $e) {
            echo $e->getMessage();die;
            return response()->json(["error"=>'DB Error']);    
        }
        
        $path = storage_path("product/product.json");
        $dataArr = array_filter(file($path), "trim");
        $total = count($dataArr);
        //sort
        foreach($dataArr as $dt) {
            $dataAll2 [] = json_decode($dt);
        }
        //sort

        usort($dataAll2, [$this, 'my_sort']);
        
        //print_r($dataAll2);
        $dataView = view("layouts.partials.listing",
                             ["dataArr"=>$dataAll2, "total"=>$total])->render();
        
        return response()->json(["success"=>"Product posted successfully", 'dataHtml'=>$dataView]);
        
    }
    public function my_sort($a, $b)
        {
            if ($a->created_at > $b->created_at) {
                return -1;
            } else if ($a->created_at < $b->created_at) {
                return 1;
            } else {
                return 0;
            }
        }
        
    
}
