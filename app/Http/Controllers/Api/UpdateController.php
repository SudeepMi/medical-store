<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\KotItem;
use App\Models\MenuItem as MItem;

class UpdateController extends ApiController
{
    public function updateMenuWeight(){
        $items= KotItem::where('is_return',0)
                ->select('item_id')
                ->selectRaw('sum(quantity) as weight')
                ->groupBy('item_id')
                ->get()
                ->toArray();
        $item_returns= KotItem::where('is_return',0)
                ->select('item_id')
                ->selectRaw('sum(quantity) as weight')
                ->groupBy('item_id')
                ->get()
                ->toArray();
        foreach($items as $item){
            $i[$item['item_id']]=$item['weight'];
        }
        foreach($item_returns as $item){
            $i_return[$item['item_id']]=$item['weight'];
        }
        foreach($i as $key=>$item){
            $i[$key]-=$i_return[$key]-$item;
        }
        $total_quantity= KotItem::where('is_return',0)
                ->selectRaw('sum(quantity) as total')
                ->first()
                ->toArray();
        foreach($i as $key=>$total){
            $weight=($total*100)/$total_quantity['total'];
            $item =MItem::find($key);
            $item->weight=$weight;
            $item->update();
        }
        return json_encode(true); 
    }
}
