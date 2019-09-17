
<table style="margin-top:50px;">
 
        <tr>
            <td colspan="5" style="text-align:center;">Tax Invoice</td>
        </tr>
        <tr>
            <td colspan="5" style="text-align:center;">{{isset($bill_setting['company_name'])?$bill_setting['company_name']:''}}</td>
        </tr>
        <tr>
            <td colspan="5" style="text-align:center;">{{isset($bill_setting['company_address'])?$bill_setting['company_address']:''}}</td>
        </tr>
        <tr>
            <td colspan="5" style="text-align:center;">Phone: {{isset($bill_setting['company_phone'])?$bill_setting['company_phone']:''}}</td>
        </tr>
        <tr>
            <td colspan="5" style="text-align:center;">Reg no: {{isset($bill_setting['company_reg_no'])?$bill_setting['company_reg_no']:''}}</td>
        </tr>
        <tr>
            <td colspan="5"></td>
        </tr>
        <tr>
            <td colspan="5">Bill no: {{$created_bill->bill_no}}</td>
        </tr>
        <tr>
            <td colspan="5">Date: {{$created_bill->created_at->format('Y/m/d g:i A')}}</td>
        </tr>
      
        @if($bill_setting['show_customer_name'] && isset($created_bill->customer_name) && $created_bill->customer_name!='')
            <tr>
                <td colspan="5">Name:{{$created_bill->customer_name}}</td>
            </tr>
        @endif
        
        @if($bill_setting['show_customer_pan'] && isset($created_bill->customer_pan) && $created_bill->customer_pan!='')
            <tr>
                <td colspan="5">Pan:{{$created_bill->customer_pan}}</td>
            </tr>
        @endif
        @if($bill_setting['show_customer_address'] && isset($created_bill->customer_address) && $created_bill->customer_address!='')
            <tr>
                <td colspan="5">Address: {{$created_bill->customer_address}}</td>
            </tr>
        @endif
        @if($bill_setting['show_customer_phone'] && isset($created_bill->customer_phone) && $created_bill->customer_phone!='')
            <tr>
                <td colspan="5">Phone: {{$created_bill->customer_phone}}</td>
            </tr>
        @endif
        <tr>
            <td colspan="5">Payment Type: @if($created_bill->payment_type==1) Cash @elseif($created_bill->payment_type==2) Bank @else Credit @endif</td>
        </tr>

        <tr style="border-top:1px dashed #000;border-bottom:1px dashed #000;">
            <th>Sn</th>
            <th>Particular</th>
            <th>Rate</th>
            <th>Qty</th>
            <th>Amount</th>
        </tr>
        @foreach($created_bill->items as $item)
            <tr>
                <td style="width:5%;">{{$loop->iteration}}</td>
                <td style="width:60%;">{{$item->item->name}} @if($item->item->is_special)(Special)@endif</td>
                <td style="width:10%;">{{$item->item->price}}</td>
                <td style="width:5%;">{{$item->quantity}}</td>
                <td style="width:20%;text-align:right;">{{$item->quantity*$item->item->price}}</td>
            </tr>
        @endforeach
        
        <tr style="border-top:1px dashed #000;">
            <td colspan=4 style="text-align:right;">Gross Total</td>
            <td style="text-align:right;">{{$created_bill->sub_total}}</td>
        </tr>
        @if($created_bill->is_discount)
            @if($created_bill->discount_type==1)
                <tr>
                    <td colspan=4 style="text-align:right;">Discount({{$created_bill->discount_percent}}%)</td>
                    <td style="text-align:right;">{{$created_bill->discount_amount}}</td>
                </tr>
            @elseif($created_bill->discount_type==2 || $created_bill->discount_type==3)
                <tr>
                    <td colspan=4 style="text-align:right;">Discount</td>
                    <td style="text-align:right;">{{$created_bill->discount_amount}}</td>
                </tr>
            @endif
        @endif
        @if($created_bill->is_service_charge)
            <tr>
                <td colspan=4 style="text-align:right;">Service Charge({{$created_bill->service_charge_percent}}%)</td>
                <td style="text-align:right;">{{$created_bill->service_charge_amount}}</td>
            </tr>
        @endif
        <tr>
            <td colspan=4 style="text-align:right;">Net Total</td>
            <td style="text-align:right;">{{$created_bill->total}}</td>
        </tr>
        @if($created_bill->received>0)
            <tr>
                <td colspan=4 style="text-align:right;">Tender</td>
                <td style="text-align:right;">{{$created_bill->received}}</td>
            </tr>
        @endif
        @if($created_bill->tip>0)
            <tr>
                <td colspan=4 style="text-align:right;">Tip</td>
                <td style="text-align:right;">{{$created_bill->tip}}</td>
            </tr>
        @endif
        @if((isset($created_bill->received) && $created_bill->received>0)|| $created_bill->return>0)
            <tr>
                <td colspan=4 style="text-align:right;">Change</td>
                <td style="text-align:right;">{{$created_bill->return}}</td>
            </tr>
        @endif
        
        @if(isset($bill_setting['show_amount_in_word'])&&$bill_setting['show_amount_in_word'])
            <tr style="border-top:1px dashed #000;border-bottom:1px dashed #000;">
                <td colspan=5 >{{$created_bill->total_in_word}} only</td>
            </tr>
        @endif
        @if(isset($bill_setting['show_greeting'])&&$bill_setting['show_greeting'])
            <tr style="border-top:1px dashed #000;border-bottom:1px dashed #000;">
                <td colspan=5 >{{$bill_setting['greeting_note']}}</td>
            </tr>
        @endif
        @if(isset($bill_setting['show_sales_by'])&&$bill_setting['show_sales_by'])
            <tr style="border-top:1px dashed #000;border-bottom:1px dashed #000;">
                <td colspan=5 >Sales by {{$created_bill->user->name}}</td>
            </tr>
        @endif
</table>