@if($bills['is_foc'])
    <div class="tab-pane-content">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>Name</th>
                    <th>Price (NPR)</th>
                    <th>Quantity</th>
                    <th>Total (NPR)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bills['detail'] as $bill)
                    <tr>
                        <td>{{$bill['name']}} @if($bill['is_special'])(Special)@endif</td>
                        <td>{{$bill['price']}}</td>
                        <td>{{$bill['quantity']}}</td>
                        <td>{{$bill['total']}}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan=3 style="text-align:right;">Sub Total</td>               
                    <td>{{$bills['sub_total']}}</td>
                    <input type="hidden" id="subtotal" value="{{$bills['sub_total']}}">
                </tr>
               
            </tbody>
        </table>
    </div>
    <h4 class="total-order-sum">
        Total : <span class="kt-font-brand">NPR</span> <span class="kt-font-brand net-total">{{$bills['total']}}</span>
    </h4>
    <a href="javascript:void(0)" id="remove-foc">Remove FOC</a>
@else
    <div class="tab-pane-content">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>Name</th>
                    <th>Price (NPR)</th>
                    <th>Quantity</th>
                    <th>Total (NPR)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bills['detail'] as $bill)
                    <tr>
                        <td>{{$bill['name']}} @if($bill['is_special'])(Special)@endif</td>
                        <td>{{$bill['price']}}</td>
                        <td>{{$bill['quantity']}}</td>
                        <td>{{$bill['total']}}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan=3 style="text-align:right;">Sub Total</td>               
                    <td>{{$bills['sub_total']}}</td>
                    <input type="hidden" id="subtotal" value="{{$bills['sub_total']}}">
                </tr>
                @if(isset($bills['is_discount']) &&  $bills['is_discount'])
                    @isset($bills['discount_type'])
                        @if($bills['discount_type']==1)
                            <tr>
                                <td colspan=3 style="text-align:right;"> 
                                <span><button class="btn btn-sm btn-danger remove-discount">x</button></span>
                                <span>Discount</span> 
                                <span class="discount-input"><input type="number" class="form-control-sm input-spinner discount" value="{{$bills['discount_rate']}}" min=0 max="{{$bills['max_disount']}}" placeholder="Discount Percent" step="5"></span> 
                                </td> 
                                <td class="discount-amount">{{$bills['discount']}}</td>
                            </tr>
                        @elseif($bills['discount_type']==2 || $bills['discount_type']==3)
                            <tr>
                                <td colspan=3 style="text-align:right;"> 
                                <span><button class="btn btn-sm btn-danger remove-discount">x</button></span>
                                <span>Discount(@if($bills['discount_type']==2)Item Wise @else Category Wise @endif )</span>
                                </td> 
                                <td class="discount-amount">{{$bills['discount']}}</td>
                            </tr>
                        
                        @endif
                    @else
                        @if(isset($bills['is_member']) && $bills['is_member'])
                            <tr>
                                <td colspan=3 style="text-align:right;"> 
                                <span><button class="btn btn-sm btn-danger remove-member-discount">x</button></span>
                                <span>Discount(Member)</span>
                                </td> 
                                <td class="discount-amount">{{$bills['discount']}}</td>
                            </tr>
                        @endif
                    @endisset
                @endif
                @if(isset($bills['is_service_charge']) &&  $bills['is_service_charge'])
                    <input type="hidden" id="is_service_charge" value=true>
                    <input type="hidden" id="service_charge_rate" value="{{$bills['service_charge_rate']}}">

                    <tr>
                        <td colspan=3 style="text-align:right;">Service Charge({{$bills['service_charge_rate']}}%)</td>               
                        <td class="service-charge-amount">{{$bills['service_charge']}}</td>
                    </tr>
                @endif
                <tr>
                    <td colspan=3 style="text-align:right;">Round</td>               
                    <td class="round">{{$bills['round']}}</td>
                </tr>
                <tr>
                    <td colspan=3 style="text-align:right;">Net Total</td>               
                    <td class="net-total">{{$bills['total']}}</td>
                </tr>                
                @if(isset($bills['is_advance']) &&  $bills['is_advance'])
                    <input type="hidden" id="is_advance" value=true>
                    <input type="hidden" id="advance-amount" value="{{$bills['advance']}}">
                    <tr>
                        <td colspan=3 style="text-align:right;">Advance</td>               
                        <td class="advance-amount">{{$bills['advance']}}</td>
                    </tr>
                    @if($bills['advance']-$bills['total']>=1)
                        <tr>
                            <td colspan=3 style="text-align:right;">Return Amount</td>               
                            <td class="return-amount">{{$bills['advance']-$bills['total']}}</td>
                        </tr>
                    @else 
                        <tr>
                            <td colspan=3 style="text-align:right;">Payable Amount</td>               
                            <td class="payable-amount">{{abs($bills['advance']-$bills['total'])}}</td>
                        </tr>
                    @endif
                    
                   
                @endif
            </tbody>
        </table>
    </div>
    <h4 class="total-order-sum">
        Total : <span class="kt-font-brand">NPR</span> <span class="kt-font-brand net-total">{{$bills['total']}}</span>
    </h4>
    @if(isset($bills['is_advance']) &&  $bills['is_advance'])
        <a href="javascript:void(0)" id="remove-advance">Remove Advance</a>
    @endif
@endif