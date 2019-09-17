
<form action="{{route('order.pay')}}" id="bill-form" method="POST">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bill</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
    </div>
    <div class="modal-body">
        <div class="">
            <table class="">
                <thead>
                    <tr>
                        <td>Customer Phone</td>
                        <td><input type="number" name="customer_phone" placeholder="Customer Phone"></td>
                    </tr>
                    <tr>
                        <td>Customer Name</td>
                        <td><input type="text" name="customer_name" placeholder="Customer Name"></td>
                    </tr>
                    <tr>
                        <td>Customer Pan</td>
                        <td><input type="number" name="customer_pan" placeholder="Customer Pan"></td>
                    </tr>
                    <tr>
                        <td>Pax</td>
                        <td><input type="number" name="pax" placeholder="Pax" value="{{$bills['pax']}}" min=1 max=50 required></td>
                    </tr>
                    <tr>
                        <td>Date</td>
                        <td>2019/06/02 1:30pm</td>
                    </tr>
                </thead>
            </table>
            <table class="table table-striped payable-bill">
                <thead>
                    <tr>
                        <th style="width:10%;">Sn</th>
                        <th style="width:50%;">Name</th>
                        <th style="width:10%;">Rate</th>
                        <th style="width:10%;">Quantity</th>
                        <th style="width:20%;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bills['detail'] as $bill)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$bill['name']}} @if($bill['is_special'])(Special)@endif</td>
                            <td>{{$bill['price']}}</td>
                            <td>{{$bill['quantity']}}</td>
                            <td>{{$bill['total']}}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot data-total="{{$bills['total']}}" data-advance="{{$bills['advance']}}">
                    <tr>
                        <td colspan=4 style="text-align:right;">Sub Total</td>
                        <td>{{$bills['sub_total']}}</td>
                    </tr>
                    @if(!$bills['is_foc'])

                        @if(isset($bills['is_discount']) &&  $bills['is_discount'])
                            @isset($bills['discount_type'])
                                @if($bills['discount_type']==1)
                                    <tr>
                                        <td colspan=4 style="text-align:right;">Discount({{$bills['discount_rate']}}%)</td>
                                        <td>{{$bills['discount']}}</td>
                                    </tr>
                                @elseif($bills['discount_type']==2 || $bills['discount_type']==3)
                                    <tr>
                                        <td colspan=4 style="text-align:right;">Discount</td>
                                        <td>{{$bills['discount']}}</td>
                                    </tr>
                                @endif
                            @else 
                                @if(isset($bills['is_member']) && $bills['is_member'])
                                    <tr>
                                        <td colspan=4 style="text-align:right;">Discount</td>
                                        <td>{{$bills['discount']}}</td>
                                    </tr>
                                @endif
                            @endisset
                        @endif

                        @if(isset($bills['is_service_charge']) &&  $bills['is_service_charge'])
                            <tr>
                                <td colspan=4 style="text-align:right;">Service Charge({{$bills['service_charge_rate']}}%)</td>
                                <td>{{$bills['service_charge']}}</td>
                            </tr>
                        @endif
                        <tr>
                            <td colspan=4 style="text-align:right;">Round</td>
                            <td>{{$bills['round']}}</td>
                        </tr>
                        <tr>
                            <td colspan=4 style="text-align:right;">Net Total</td>
                            <td>{{$bills['total']}}</td>
                        </tr>
                        @if(isset($bills['is_advance']) &&  $bills['is_advance'])
                            <input type="hidden" name="advance" value="{{$bills['advance']}}"> 
                            <tr>
                                <td colspan=4 style="text-align:right;">Advance</td>
                                <td>{{$bills['advance']}}</td>
                            </tr>
                            @if($bills['advance']-$bills['total']>=1)
                                <tr>
                                    <td colspan=4 style="text-align:right;">Returnable Amount</td>               
                                    <td class="service-charge-amount">{{$bills['advance']-$bills['total']}}</td>
                                </tr>
                                
                            @else 
                                <tr>
                                    <td colspan=4 style="text-align:right;">Payable Amount</td>               
                                    <td class="service-charge-amount">{{abs($bills['advance']-$bills['total'])}}</td>
                                </tr>
                                <tr class="in_cash">
                                    <td colspan=4 style="text-align:right;">Received</td>
                                    <td>
                                        <input class="form-control form-control-sm payable-bill-change" type="number"  placeholder="Received" name="received" min="{{abs($bills['advance']-$bills['total'])}}"  autofocus>
                                    </td>
                                </tr>
                            @endif
                        @else
                            <tr class="in_cash">
                                <td colspan=4 style="text-align:right;">Received</td>
                                <td>
                                    <input class="form-control form-control-sm payable-bill-change" type="number"  placeholder="Received" name="received" min="{{$bills['total']}}"  autofocus>
                                </td>
                            </tr>
                            
                            <tr>
                                <td colspan=5>
                                    <div class="row">
                                                                            
                                        <div class="col-lg-4">
                                            <label class="kt-option" >
                                                    <span class="kt-option__control">
                                                        <span class="kt-radio kt-radio--check-bold kt-radio--dark">
                                                            <input type="radio" name="payment_type" value="1"  checked>
                                                            <span></span>
                                                        </span>
                                                        </span>
                                                <span class="kt-option__label">
                                                    <span class="kt-option__head">
                                                        <span class="kt-option__title">Cash</span>

                                                        </span>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="kt-option" id="">
                                                <span class="kt-option__control">
                                                    <span class="kt-radio kt-radio--check-bold kt-radio--dark">
                                                        <input type="radio" name="payment_type" value="2">
                                                            <span></span>
                                                    </span>
                                                    </span>
                                                <span class="kt-option__label">
                                                <span class="kt-option__head">
                                                    <span class="kt-option__title">Bank</span>

                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="kt-option" id="">
                                                <span class="kt-option__control">
                                                    <span class="kt-radio kt-radio--check-bold kt-radio--dark">
                                                        <input type="radio" name="payment_type" value="3">
                                                            <span></span>
                                                    </span>
                                                    </span>
                                                <span class="kt-option__label">
                                                <span class="kt-option__head">
                                                    <span class="kt-option__title">Credit</span>

                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="in_credit" style="display:none;">
                                <td style="text-align:right;">Creditor</td>

                                <td colspan=4>
                                    <div class="input-group">
                                        <select name="debitor" id="debitor-select" class="form-control" data-live-search="true">
                                        </select>
                                       <div class="input-group-append">
                                            <button class="btn btn-success btn-add-debitor"  type="button">Add</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        @endif
                        
                        <tr>
                            <td colspan=4 style="text-align:right;">Tip</td>
                            <td>
                                <input class="form-control form-control-sm payable-bill-change" type="number" placeholder="Tip" name="tip" min=1 >
                            </td>
                        </tr>
                        <tr class="in_cash">
                            <td colspan=4 style="text-align:right;">Return</td>
                            <td class="return">0</td>
                        </tr>
                    @endif

                </tfoot>
                <input type="hidden" name="total" value="{{$bills['total']}}">
            </table>
        
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-sm btn-success" >
            @if($bills['is_foc'])
                Save
            @else
                Pay 
            @endif
        </button>
    </div>
</form>