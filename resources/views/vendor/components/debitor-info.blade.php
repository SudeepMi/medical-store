<h5 class="modal-title" >{{ $debitor->name }}</h5>
<table class="table table-striped">
    <tbody>
        <tr>
        <td>Debitor PAN No.</td>
        <td>{{$debitor->pan}}</td>
        </tr>
        <tr>
        <td>Email</td>
        <td>{{$debitor->email}}</td>
        </tr>
        <tr>
        <td>Phone </td>
        <td>{{ $debitor->phone }}</td>
        </tr>
        <tr>
            <td>Address </td>
            <td>{{ $debitor->address }}</td>
        </tr>
        <tr>
             <td>Opening Amount </td>
            <td>{{ $debitor->opening_amount }}</td>
        </tr>
        <tr>
            <td>Total Credit </td>
           <td>{{ $debitor->total_credit }}</td>
       </tr>
        <tr>
            <td> Amount Paid </td>
            <td>{{ $debitor->amount_paid ?? "N/A" }}</td>
        </tr>
        <tr>
            <td>Remaining Amount</td>
            <td>{{ $debitor->total_credit - $debitor->amount_paid }}</td>
        </tr>
        <tr>
            <td> By Cash</td>
            <td>{{ $debitor->total_cash }}</td>
        </tr>
  </tbody>
</table>
<a href="{{ route('vendor.payments',$debitor->slug) }}">
    <button class="btn btn-success history" data-slug="{{ $debitor->slug }}">Payments</button>
</a>


