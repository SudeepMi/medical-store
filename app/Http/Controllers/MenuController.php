<?php

namespace App\Http\Controllers;

use App\Http\Requests\Menuitem\ItemDetailRequest;
use Illuminate\Http\Request;
use Sudeep\LogReader\LogReader;
use Validator;
use View;
//Models
use App\Models\MenuItem as MItem;
use App\Models\MenuCategory as MCategory;

class MenuController extends Controller
{
    public function __construct(LogReader $reader)
    {
        parent::__construct ( $reader );
    }

    public function index(){
        $items=MItem::with('category')->where('is_special',0)->get();
        $categories=MCategory::where('status',1)->where('is_special',0)->get();
        return view('menu.index',compact('items','categories'));
    }

    public function getDetail(ItemDetailRequest $request){
        $item=MItem::where('slug',$request->slug)->with('category')->first();
        $stocks= $item->stock_items;
        $view= View::make('menu.components.menu-info', [
            'item' =>  $item,
            'stocks'=> $stocks
        ]);

        return $view;
    }
}
