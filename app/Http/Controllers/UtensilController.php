<?php

namespace App\Http\Controllers;

use App\Http\Requests\Utensil\AdjustUtensilRequest;
use App\Models\Utensil;
use Illuminate\Http\Request;
use App\Http\Requests\Utensil\CreateUtensilRequest;
use App\Http\Requests\Utensil\DeleteUtensilRequest;
use App\Http\Requests\Utensil\UpdateUtensilRequest;
use App\Models\UtensilEntry;
use View;

class UtensilController extends Controller
{
    public function index(){
        $utensil = Utensil::with('user')
                            ->with('adjustment')
                            ->with('opening_count')
                            ->get();

        foreach($utensil as $u){
        $u['opening_count']=$u->opening_count->sum('stock_in');
        $u['in']=$u->adjustment->sum('stock_in');
        $u['out']=$u->adjustment->sum('stock_out');
        $u['net_count']=$u['opening_count']+$u['in']-$u['out'];
        }

        return view('stocks.utensil.index',compact('utensil'));
    }

    public function create(){
        return view('stocks.utensil.create');
    }
    public function store(Request $request){


       $utensil = $this->getArray($request);
    $this->withValidate($utensil, new CreateUtensilRequest());
       if ($ut = Utensil::create($utensil)){
           $data['is_opening_stock'] = 1;
           $data['stock_in'] = $utensil['quantity'];
           $data['utensil_id'] = $ut->id;
           $data['remarks'] = "opening Count";
           if(UtensilEntry::create($data)){
           $this->create_log ('create','utensil');
           return "ok";
           }else{
               return "failed";
           }
         }

    }

    public function edit(Request $request){
        $slug = $request->slug;
        $newuten = Utensil::where('slug',$slug)->first();
        $view= View::make('stocks.utensil.edit', [
            'newuten' =>  $newuten,
        ]);
        return $view;

    }

    public function update(Request $request){
      $bag = $this->getArray($request);
      $this->withValidate($bag, new UpdateUtensilRequest());
      $utensil = Utensil::where('slug',$bag['slug'])->first();
        $utensil->name = $bag['name'];
        $utensil->status = $bag['status'];
        if($utensil->save()){
        $this->create_log ('update','utensil');
        return "ok";
    }else{
        return "failed";
    }
    }

    public function delete(DeleteUtensilRequest $request){
        $utensil = Utensil::where('id',$request->id)->first();
        $utensil->delete();
        $this->create_log ('delete','utensil');
        return redirect()->route('stock.utensil.index');
    }
    public function getDetail(Request $request){
        $utensil = Utensil::where('id',$request->id)->with('opening_count')
        ->with('adjustment')
        ->first();
        $view= View::make('stocks.utensil.components.info', [
            'details' =>  $utensil,
        ]);
        return $view;
    }

    public function adjust(Request $request){
      $total = $this->getArray($request);
      $this->withValidate($total, new AdjustUtensilRequest());
      $datas[$total['type']] = $total['count'];
      $datas['utensil_id'] = $total['id'];
      $datas['is_opening_stock'] = 0;
      $datas['remarks'] = urldecode($total['remarks']);
      if (UtensilEntry::create($datas)) {
          $this->create_log('adjust','utensil');
        return "ok";
      }
      return "operation failed";

    }


}
