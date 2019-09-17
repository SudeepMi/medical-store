<?php

namespace App\Observers;

use App\Http\Requests\MenuItem\UpdateMenuItemRequest;
use App\Models\MenuItem;
use App\Http\Requests\MenuItem\CreateMenuItemRequest;
use App\Models\MenuItemStock as SItem;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;


class MenuItemObserver
{
    protected $stockItem;
    public function __construct(SItem $stockItem)
    {
        return $this->stockItem = $stockItem;

    }

    /**
     * Handle the menu item "created" event.
     *
     * @param  \App\MenuItem  $menuItem
     * @return void
     */
    public function created(MenuItem $menuItem)
    {
        $request = CreateMenuItemRequest::capture();
        if(isset($request->item)){
            foreach($request->item as $key=>$item){
                    $stock= Stock::where('slug',$key)->first();
                    $data['menu_item_id'] = $menuItem->id;
                    $data['stock_id'] =$stock->id;
                    $data['quantity'] =$item;
                    SItem::create($data);
                }

        }

    }



    /**
     * Handle the menu item "updated" event.
     *
     * @param  \App\MenuItem  $menuItem
     * @return void
     */
    public function updated(MenuItem $menuItem)
    {

        $request = UpdateMenuItemRequest::capture();
        if(isset($request->item)){
            foreach($request->item as $key=>$qty){
                $stock= Stock::where('slug',$key)->first();
                $data['menu_item_id'] =$menuItem->id;
                $data['stock_id'] =$stock->id;
                $data['quantity'] =$qty;
                $this->stockItem->updateOrCreate(['menu_item_id' => $menuItem->id,
                                        'stock_id' => $stock->id], $data
                                        );
            }
        }
    }


    /**
     * Handle the menu item "deleted" event.
     *
     * @param  \App\MenuItem  $menuItem
     * @return void
     */
    public function deleted(MenuItem $menuItem)
    {
        //
    }

    /**
     * Handle the menu item "restored" event.
     *
     * @param  \App\MenuItem  $menuItem
     * @return void
     */
    public function restored(MenuItem $menuItem)
    {
        //
    }

    /**
     * Handle the menu item "force deleted" event.
     *
     * @param  \App\MenuItem  $menuItem
     * @return void
     */
    public function forceDeleted(MenuItem $menuItem)
    {
        //
    }
}
