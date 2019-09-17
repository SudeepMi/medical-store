<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;
use App\Models\BookedTable;
use App\Http\Resources\OccupiedTableResource;
use App\Http\Resources\EmptyTableResource;
class TableController extends Controller
{
    public function getOccupiedTable() {
        $tables=OccupiedTableResource::collection(Table::where('is_occupied',1)->get());
        return $tables;
    }
    public function getEmptyTable() {
        $tables=EmptyTableResource::collection(Table::where('is_occupied',0)->get());
        return $tables;
    }
    public function getTodayBookedTable() {
        $todayBookings = Table::with('today_booked_table')->get();
        return response()->json(['status' => 'success', 'todayBookings' => $todayBookings]); die;
    }

    public function bookingHistory() {
        $bookHistory = Table::with('booking_history', 'floor')->get();
 
        return view('workplace.table-booking-history', compact('bookHistory'));
    }

    public function editBooking(Request $request) {
        if($request->ajax()) {
            $booking = BookedTable::find($request->id);
            $view = view('workplace.table-booking-detail-modal')
                ->with('booking', $booking)
                ->render();

            return response()->json([
                'status' => "success",
                'view' => $view,
                'message' => 'done'
            ]);
        }
        return response()->json([
            'status' => "failed"
        ]);
    }

    public function changeStatusBooking(Request $request) {
        if($request->ajax()){
            $model = BookedTable::find(htmlspecialchars($request->id, ENT_QUOTES));
            $model->status = ($model->status == 0) ? 1 : 0;
            if($model->update()){
                $this->create_log ('change-status','Table Booking');
                return response()->json(['status' => 'success', 'successMsg' => 'Successfully Updated Booking Status!']); die;
            }
            return response()->json(['status' => 'failed', 'errorMsg' => 'Something went wrong. Please try again!']);
        }
    }
    public function checkStatus(Request $request){
        $table= Table::find($request->table_id);
        $res['is_occupied']=false;
        
        if($table->is_occupied){
            $res['is_occupied']=true;
            $res['table']=new OccupiedTableResource($table);
        }else{
            $res['table']=new EmptyTableResource($table);
        }
        
        return json_encode($res);
    }
    public function move(Request $request){
        //Validate HEre
        $res['status']=false;
        $res['msg']='';

        if($request->has('from') && $request->has('to')){
            $from_table=Table::find($request->from);
            $to_table=Table::find($request->to);
            if($from_table!==null && $to_table!==null){
                if($from_table->is_occupied && !$to_table->is_occupied){
                    
                    if($from_table->order!==null){
                        //Update Table
                        $to_table->order_id=$from_table->order_id;
                        $to_table->is_occupied=true;
                        $to_table->start_time=$from_table->start_time;
                        $to_table->update();

                        $from_table->is_occupied=false;
                        $from_table->order_id==null;
                        $from_table->start_time==null;
                        $from_table->update();
                        $res['status']=true;
                        $res['msg']=''; 
                    }else{
                        $res['status']=false;
                        $res['msg']='Order Does not Exist'; 
                    }
                           
                }else{
                    $res['status']=false;
                    $res['msg']='Table not empty';                
                }
            }else{
                $res['status']=false;
                $res['msg']='Table not found';
            }
            
        }
        return json_encode($res);
    }
}
