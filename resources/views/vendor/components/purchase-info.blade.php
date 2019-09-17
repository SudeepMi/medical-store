
<h5 class="modal-title" >Invoice No : {{ $stock->invoice }}</h5>
{{ $stock->debitor->name }}
<table class="table table-striped">
    <tbody>
    <tr>
        <td>Date</td>
        <td>{{  \Carbon\Carbon::parse ($stock->created_at)->toFormattedDateString()  }}</td>
    </tr>


    </tbody>
</table>
<hr>
@isset($stock->stock_item)
<table class="table table-striped">
        <tbody>
          <tr>
            <th>Name</th>
            <th>Stock In</th>
            <th>Rate</th>
            <th>Total</th>
          </tr>
@foreach ($stock->stock_item as $entry)

          <tr>
        <td>{{ $entry->stock->name }}</td>
        <td>{{ $entry->stock_in }}</td>
        <td>{{ $entry->rate }}</td>
        <td>{{$entry->rate * $entry->stock_in }}</td>
    </tr>
@endforeach
<tr>
        <th colspan="3">Total Amount</th>
        <td>{{$stock->total}}</td>
    </tr>
     <tr>
        <th colspan="3"> Amount Paid In Cash</th>
        <td>{{$stock->cash}}</td>
    </tr>
     <tr>
        <th colspan="3">Credit Amount</th>
        <td>{{$stock->credit}}</td>
    </tr>
</tbody>
</table>
@endisset


