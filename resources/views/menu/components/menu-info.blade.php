<h5 class="modal-title" >Menu Info</h5>
<table class="table table-striped">
    <tbody>
        <tr>
        <td>Name</td>
        <td>{{$item->name}}</td>
        </tr>
        <tr>
        <td>Category</td>
        <td>{{$item->category->name}}</td>
        </tr>
        <tr>
        <td>Status</td>
        <td>@if($item->status) Active @else Inactive @endif</td>
        </tr>
        <tr>
            <td>Is Discountable</td>
            <td>@if($item->is_discountable) yes @else no @endif</td>
        </tr>
        <tr>
            <td>Discount(%)</td>
            <td>@if($item->is_discountable) {{ $item->discount }} @else N/A @endif</td>
        </tr>
  </tbody>
</table>
<hr>

    <h5 class="modal-title" >Menu Stocks</h5>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Unit</th>
            <th>Amount</th>


        </tr>
    </thead>
    <tbody>
        @foreach($stocks as $stock)
            <tr>
                <td>{{$stock->name}}</td>
                <td>{{$stock->unit}}</td>
                <td>{{$stock->pivot->quantity}}</td>

            </tr>
           
        @endforeach
  </tbody>
</table>
<hr>

<h5 class="modal-title" >Menu Stock History</h5>
<hr>

