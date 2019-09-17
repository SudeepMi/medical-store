
<table class="table table-striped">
    <tbody>
    <tr>
        <td>Item Code</td>
        <td>{{$stock->item_code}}</td>
    </tr>
    <tr>
        <td>Item Name</td>
        <td>{{$stock->name}}</td>
    </tr>
    <tr>
        <td>Standard Price</td>
        <td>{{$stock->price}}</td>
    </tr>


    </tbody>
</table>

<hr>

@isset($stock->purchases)
<div class="accordion accordion-solid accordion-toggle-arrow" id="accordionExample8">
    <div class="card">
        <div class="card-header" id="headingOne8">
            <div class="card-title" data-toggle="collapse" data-target="#collapseOne8" aria-expanded="true" aria-controls="collapseOne8">
                <h6>Purchased Detail</h6>
            </div>
        </div>
        <div id="collapseOne8" class="collapse show" aria-labelledby="headingOne8" data-parent="#accordionExample8">
            <div class="card-body">
                <table class="table table-striped- table-bordered table-hover table-checkable dataTable-init">
                    <tbody>
                        <tr>
                            <td>Invoice No</td>
                            <td>Date</td>
                            <td>Vendor</td>
                            <td>Rate</td>
                            <td>Quantity</td>
                        </tr>
                            @foreach ($stock->purchases as $item)
                            <tr>
                                <td><a href="#" data-invoice="{{ $item->purchase->invoice }}" class="purchase-info kt-link kt-link--brand kt-font-bolder invoice-no">{{ $item->purchase->invoice }}</a></td>
                                <td>{{$item->created_at->format('Y/m/d')  }}</td>
                                <td>{{$item->purchase->debitor->name}}</td>
                                <td>{{$item->rate}}</td>
                                <td>{{$item->stock_in}}</td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingOne8">
            <div class="card-title" data-toggle="collapse" data-target="#collapseOne8" aria-expanded="true" aria-controls="collapseOne8">
                <h6>Adjustment Detail</h6>
            </div>
        </div>
        <div id="collapseOne8" class="collapse" aria-labelledby="headingOne8" data-parent="#accordionExample8">
            <div class="card-body">
                <table class="table table-striped- table-bordered table-hover table-checkable dataTable-init">
                    <tbody>
                        <tr>
                            <td>SN</td>
                            <td>Date</td>
                            <td>Stock In</td>
                            <td>Stock Out</td>
                            <td>Remarks</td>
                        </tr>
                            @foreach ($stock->adjustment as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$item->created_at->format('Y/m/d')  }}</td>
                                <td>{{$item->stock_in}}</td>
                                <td>{{$item->stock_out}}</td>
                                <td>{{$item->remarks}}</td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endisset


