<div class="tab-pane-content">
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th>Name</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kots as $kot)
                <div>
                    <tr class="row-group">
                        <td colspan="2">KOT: {{ $kot->display_number }} @if($kot->is_return) (Return)@endif<span class="pull-right">{{$kot->created_at->format('Y/m/d g:i A')}}</span></td>
                    </tr>
                    <tr class="row-group">
                        <td colspan="2">Table: <span class="pull-right">{{$kot->table->name}}</span></td>
                    </tr>
                    @foreach($kot->items as $item)
                        <tr>
                            <th>{{$item->item->name}}</th>
                            <td>{{$item->quantity}}</td>
                        </tr>
                    @endforeach
                </div>
            @endforeach
            
        </tbody>
    </table>
</div>