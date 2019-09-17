<?php

namespace App\Http\Controllers;
use App\Http\Requests\MenuCategory\CreateMenuCategoryRequest;
use App\Models\MenuCategory as MCategory;
use Sudeep\LogReader\LogReader;
use Illuminate\Http\Request;

class MenuCategoryController extends Controller
{
    private $category;
    public function __construct(LogReader $reader, MCategory $category)
    {
        $this->category = $category;
        parent::__construct ( $reader );
    }

    public function index(){
        $categories=$this->category->all();
        return view('menu.category.index',compact('categories'));

    }
    public function create(){
        return view('menu.category.create');
    }
    public function store(CreateMenuCategoryRequest $request){
        //Store
        if ($this->category->create($request->all())) {
            $this->create_log ( 'create', 'menu category');
        }
        return redirect()->back();
    }
    public function update(Request $request){

       $cat = MCategory::find($request->id);
       $cat->name = $request->name;
       if($cat->save()){
           $this->create_log('update','menu category');
           $data['status'] = 'ok';
            $data['name']  = $request->name;
            return $data;
       }

    }

    public function changeStatus(Request $request){

            $model = MCategory::find($request->id);
            $model->status = ($model->status == 0) ? 1 : 0;
            if($model->update()){
                $this->create_log ('changed status','menu category');
                return response()->json(['status' => 'success', 'successMsg' => 'Successfully Updated Menu Category Status!']); die;
            }
            return response()->json(['status' => 'failed', 'errorMsg' => 'Something went wrong. Please try again!']);
        }


}
