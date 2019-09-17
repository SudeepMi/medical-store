<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuCategory\CreateMenuCategoryRequest;
use App\Http\Requests\MenuItem\CreateMenuItemRequest;
use App\Http\Requests\MenuItem\UpdateMenuItemRequest;
use App\Models\MenuItem;
use Storage;
use App\Models\MenuItemStock as SItem;
use App\Models\Stock;
use App\Models\MenuCategory as MCategory;
use App\Models\MenuItem as MItem;
use Sudeep\LogReader\LogReader;
use Illuminate\Http\Request;
use App\Http\Resources\SpecialMenuItemResource;
use App\Models\User;

/**
 * @property  menu_item
 */
class MenuItemController extends Controller
{
    private $menu_item;
    private $category;
    /**
     * @var Stock
     */
    private $stock;

    public function __construct(LogReader $reader, MenuItem $item, Stock $stock, MCategory $category)
    {
        parent::__construct ( $reader );
        $this->menu_item = $item;
        $this->category= $category;
        $this->stock = $stock;
    }

    public function create(){
        $categories=MCategory::all();
        $stock_items = Stock::all();
        return view('menu.item.create',compact('categories','stock_items'));
    }
    public function store(CreateMenuItemRequest $request){

        //Store
        $category=MCategory::where('slug',$request->category)->first();
        if($category) {
            $data = $request->only('name', 'price', 'description', 'is_discountable','discount' );
            $data['menu_category_id'] = $category->id;
            if($item = $this->menu_item->create($data)){
                $img = $request->file('image');
                Storage::disk('uploads')->putFileAs('menuitem',$img,$item->slug.'.jpg');
                $this->create_log( 'create', 'menu item');
                return redirect()->route('menu.index');
            }
        }
        return redirect()->back();

    }
    public function storeSpecialItem(Request $request){
        $category=MCategory::where('is_special',1)->first();
        $data= [];
        $data['menu_category_id'] = $category->id;
        $data['is_special'] = 1;

        foreach($request->info as $info){
            $data[$info['name']]=(isset($info['value']) && $info['value']!=='') ?$info['value']:0;
        }
        $item=MenuItem::create($data);
        return $item->toArray();
    }
    public function getSpecialItem(){
        $item=SpecialMenuItemResource::collection(Mitem::where('is_special',1)->get());
        return $item;
    }

    public function edit($slug){
        $item=MItem::where('slug',$slug)->first();
        if($item){
            $categories=MCategory::all();
            $stocks= $item->stock_items;
            $this_stock=[];
            foreach($stocks as $stock){
                $this_stock[]=$stock->slug;
            }
            $exists = Storage::disk('uploads')->exists('menuitem/'.$item->slug.'.jpg');
           $image  =null;
            if ($exists) {
               $image = Storage::disk('uploads')->url('menuitem/'.$item->slug.'.jpg');
            }
            $stock_items = Stock::all();
            return view('menu.item.edit',compact('categories','item','stocks','stock_items','this_stock'))->with('images',$image);
        }
        return redirect()->back();
    }
    public function update(UpdateMenuItemRequest $request){

        $item=MItem::where('slug',$request->item_slug)->first();
        if($item){
            $category=MCategory::where('slug',$request->category)->first();
            if($category){
                $data=$request->except('_token','category','stock_items','item_slug','item');
                $data['menu_category_id']=$category->id;
              if( $updated = $item->update($data)){
               $exists = Storage::disk('uploads')->exists('menuitem/'.$request->item_slug.'.jpg');
                    if ($exists){
                       Storage::disk('uploads')->delete('menuitem/'.$request->item_slug.'.jpg');
                    }
            $img = $request->file('image');
            Storage::disk('uploads')->putFileAs('menuitem',$img,$item->slug.'.jpg');
               $this->create_log ('update','menu item');
                return redirect ()->route ('menu.index');
                //Stock update
            }
        }
            else {
                echo "No Category";
                die;
            }
        }
        else {
            echo "No Items";
            die;
        }
    }

    public function updateStatus(Request $request){
        $menu = MenuItem::find($request->id);
        $menu->status = ($menu->status ==1 ) ? 0 : 1;
       if($menu->update()){
           $this->create_log('change status','menu item');
           return response()->json(['status' => 'success', 'successMsg' => 'Successfully Updated Item Status!']); die;
        }
        return response()->json(['status' => 'failed', 'errorMsg' => 'Something went wrong. Please try again!']);
    }


}
