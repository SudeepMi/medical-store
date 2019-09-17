<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Models
use App\Models\Floor;
use App\Models\Table;
use App\Models\Obstacle;
use App\Models\BookedTable;

class WorkplaceController extends Controller
{
    public function index()
    {
        $floors = Floor::orderBy('display_order')->with('active_tables.booked_table')->get();
        return view('workplace.index',compact('floors'));
    }

    public function edit()
    {
        $floors = Floor::orderBy('display_order')->with('active_tables', 'active_objects')->get();
        return view('workplace.edit',compact('floors'));
    }
    public function update(Request $request)
    {
        $tables= json_decode($request->tables);
        $objects = json_decode($request->objects);
        foreach($tables as $table){
            $floor=Floor::where('slug',$table->floor)->first();
            if(1==2){
                if($table->is_new){
                    $floor=Floor::where('slug',$table->floor)->first();
                    if($floor){
                        $data['uuid']=$table->uuid;
                        $data['name']=$table->name;
                        $data['x_pos']=$table->pos_x;
                        $data['y_pos']=$table->pos_y;
                        $data['is_occupied']=0;
                        $data['floor_id']=$floor->id;
                        $table=Table::create($data);
                    }

                }else{

                }

            }
            $data['uuid']=$table->uuid;
            $data['name']=$table->name;
            $data['x_pos']=$table->pos_x;
            $data['y_pos']=$table->pos_y;

            $data['width']=$table->width;
            $data['height']=$table->height;
            $data['floor_id']=$floor->id;
            Table::updateOrCreate(
                ['uuid' => $table->uuid],
                $data
            );
        }
        foreach($objects as $object){
            $floor=Floor::where('slug',$object->floor)->first();
            if(1==2){
                if($object->is_new){
                    $floor=Floor::where('slug',$object->floor)->first();
                    if($floor){
                        $data1['uuid']=$object->uuid;
                        $data1['name']=$object->name;
                        $data1['x_pos']=$object->pos_x;
                        $data1['y_pos']=$object->pos_y;
                        $data1['width']=$object->width;
                        $data1['height']=$object->height;
                        $data1['floor_id']=$floor->id;
                        $object=Obstacle::create($data1);
                    }

                }else{

                }

            }
            // dd($object);
            $data1['uuid']=$object->uuid;
            $data1['name']=$object->name;
            $data1['x_pos']=$object->pos_x;
            $data1['y_pos']=$object->pos_y;
            $data1['width']=$object->width;
            $data1['height']=$object->height;
            $data1['floor_id']=$floor->id;
            Obstacle::updateOrCreate(
                ['uuid' => $object->uuid],
                $data1
            );
        }
        return $request;
    }

    public function deleteTable(Request $request)
    {
        if($request->ajax()) {
           $model = Table::where('uuid', $request->uuid)->first();
            if($model->delete()){
                return response()->json(['status' => 'success', 'successMsg' => 'Successfully Deleted Table From Floor!']); die;
            }
        }
        return response()->json(['status' => 'failed', 'errorMsg' => 'Something went wrong. Please try again!']);
    }

    public function deleteObject(Request $request)
    {
        if($request->ajax()) {
           $model = Obstacle::where('uuid', $request->uuid)->first();
            if($model->delete()){
                return response()->json(['status' => 'success', 'successMsg' => 'Successfully Deleted Object From Floor!']); die;
            }
        }
        return response()->json(['status' => 'failed', 'errorMsg' => 'Something went wrong. Please try again!']);
    }

    public function mergeTable(Request $request)
    {
        if ($request->isMethod('post')) {
            $baseTable = Table::where('uuid', $request->uuid)->first();
            if($baseTable) {
                if($request->merged_to != null) {
                    $merged_tables = '';
                    foreach($request->merged_to as $otherTable) {
                        $mergedTable = Table::where('uuid', $otherTable)->first();
                        if($mergedTable) {
                            if($merged_tables == '') {
                                $merged_tables = $mergedTable->id;
                            } else {
                                $merged_tables = $merged_tables .', '. $mergedTable->id;
                            }
                            $mergedTable->merged_with   = $baseTable->id;
                            $mergedTable->is_base       = 0;
                            $mergedTable->update();
                        }
                    }
                    $baseTable->merged_with = $merged_tables;
                    if($baseTable->update()) {
                        return redirect()->back();
                    }
                }
            }
        }
    }

    public function unmergeTable(Request $request)
    {
        if($request->ajax()) {

            $model = Table::where('uuid', $request->uuid)->first();
            $base = Table::where('id', $model->merged_with)->first();

            $merged_tables= explode(', ', $base->merged_with);
            $new_merged_tables = '';
            foreach($merged_tables as $merge) {
                if($model->merged_with != $merge) {
                    if($new_merged_tables != '') {
                        $new_merged_tables = $merge;
                    } else {
                        $new_merged_tables = $new_merged_tables .', '. $merge;
                    }
                }
            }
            // update base merged-table
            if($new_merged_tables != '') {
                $base->merged_with = $new_merged_tables;
            } else {
                $base->merged_with = 0;
            }
            $base->update();
            //updated base merged-table

            // update child merged-table
            $model->merged_with = 0;
            $model->is_base     = 1;
            if($model->update()){
                return response()->json(['status' => 'success', 'successMsg' => 'Successfully Unmerged Table From '.ucwords($base->name).'!']); die;
            }
        }
        return response()->json(['status' => 'failed', 'errorMsg' => 'Something went wrong. Please try again!']);
    }

    public function bookingStartCheck(Request $request)
    {
        if($request->isMethod("post")) {
            $already = BookedTable::where(['table_id'=>$request->table_id, 'floor_id'=>$request->floor_id, 'booking_date'=>date('Y-m-d', strtotime($request->booking_date))])->whereDate('start_time', '<=', date('H:i:s', strtotime($request->from)))->whereDate('end_time', '>=', date('H:i:s', strtotime($request->from)))->first();
            // dd($already);
            if(isset($already) && $already != null) {
                return response()->json(false); die;
            } else {
                return response()->json(true); die;
            }
        }
    }

    public function bookingEndCheck(Request $request)
    {
        if($request->isMethod("post")) {
            $already = BookedTable::where(['table_id'=>$request->table_id, 'floor_id'=>$request->floor_id, 'booking_date'=>date('Y-m-d', strtotime($request->booking_date))])->whereDate('start_time', '<=', date('H:i:s', strtotime($request->to)))->whereDate('end_time', '>=', date('H:i:s', strtotime($request->to)))->first();
            // dd($already);
            if(isset($already) && $already != null) {
                return response()->json(false); die;
            } else {
                return response()->json(true); die;
            }
        }
    }

    public function booking(Request $request)
    {
        if($request->isMethod('post')) {
            $already = BookedTable::where(['table_id'=>$request->table_id, 'floor_id'=>$request->floor_id, 'booking_date'=>date('Y-m-d', strtotime($request->booking_date))])->first();
            if($already) {
                if($request->from >=  $already->start_time && $request->from <= $already->end_time) {

                    return response()->json(['status' => 'failed', 'errorMsg' => 'Start time Overlapped. Please try again!']);
                }
                if($request->to >=  $already->start_time && $request->to <= $already->end_time) {
                    return response()->json(['status' => 'failed', 'errorMsg' => 'End time Overlapped. Please try again!']);
                }

            }

            $model = new BookedTable;
            $model->customer_name = $request->name;
            $model->phone = $request->phone;
            $model->customer_address = $request->address;
            $model->pax = $request->pax;
            $model->table_id = $request->table_id;
            $model->floor_id = $request->floor_id;
            $model->booking_date = date('Y-m-d', strtotime($request->booking_date));
            $model->start_time = $request->from;
            $model->end_time = $request->to;
            $model->status = 1;
            $model->booked_by = auth()->user()->id;
            if($model->save()){
                $this->create_log('create','table booking');
                return response()->json(['status' => 'success', 'successMsg' => 'Successfully created Booking.']); die;
            }
            return response()->json(['status' => 'failed', 'errorMsg' => 'Something went wrong. Please try again!']);
        }
    }

    public function bookingUpdate(Request $request)
    {
        if($request->isMethod('post')) {

            $model = BookedTable::where('id', $request->booking_id)->first();
            if($model) {
                $model->customer_name = $request->name;
                $model->phone = $request->phone;
                $model->customer_address = $request->address;
                $model->pax = $request->pax;
                $model->table_id = $request->table_id;
                $model->floor_id = $request->floor_id;
                $model->booking_date = date('Y-m-d', strtotime($request->booking_date));
                $model->start_time = $request->from;
                $model->end_time = $request->to;
                $model->status = 1;
                $model->booked_by = auth()->user()->id;
                if($model->update()){
                    return response()->json(['status' => 'success', 'successMsg' => 'Successfully updated Booking.']); die;
                }
            }
            return response()->json(['status' => 'failed', 'errorMsg' => 'Something went wrong. Please try again!']);
        }
    }
}
