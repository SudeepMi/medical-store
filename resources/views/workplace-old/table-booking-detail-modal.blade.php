<input type="hidden" name="booking_id" id="booking-id" value="{{$booking->id}}">
<div class="row">
    <div class="col-12">
        <label for="">Customer Name</label>
        <input type="text" class="form-control" name="name" placeholder="Full Name" value="{{$booking->customer_name}}" required>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <label for="">Customer Phone</label>
        <input type="text" class="form-control" name="phone" placeholder="Phone Number" value="{{$booking->phone}}" required>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <label for="">PAX</label>
        <input type="text" class="form-control" name="pax" value="{{$booking->pax}}" required>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <label for="">Customer Address</label>
        <input type="text" class="form-control" name="address" value="{{$booking->customer_address}}" required>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <label for="">Table Name</label>
        <?php $table = App\Models\Table::where('id', $booking->table_id)->first(); ?>
        <input type="text" id="booking-table-name" class="form-control" name="table_name" value="{{$table->name}}" readonly>
        <input type="hidden" id="booking-table-id" class="form-control" name="table_id" value="{{$booking->table_id}}">
        <input type="hidden" id="booking-table-floor-id" class="form-control" name="floor_id" value="{{$booking->floor_id}}">
    </div>
</div>    
<div class="row">
    <div class="col-12">
        <label for="">Booking Date</label>
        <input type="date" class="form-control" id="booking-table-date" name="booking_date" value="{{date('Y-m-d', strtotime($booking->booking_date))}}" min="{{date('Y-m-d')}}" required>
    </div>
</div>                    
<div class="row">
    <div class="col-12">
        <label for="">Booking From</label>
        <input type="time" class="form-control" id="booking-time-start" name="from" value="{{date('H:i', strtotime($booking->start_time))}}" min="" required>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <label for="">Booking To</label>
        <input type="time" class="form-control" id="booking-time-to" name="to" value="{{date('H:i', strtotime($booking->end_time))}}" min="" required>
    </div>
</div>