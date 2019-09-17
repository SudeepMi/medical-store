<table class="table" style="width:100%;">
    <input type="hidden" name="table" id="kot-return-table-id" value="{{$table->uuid}}">
    <thead>
        <tr>
            <th>Item</th>
            <th>Quantity</th>
            <th>Return</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bills['detail'] as $key=>$kot)
            <tr>
                <td style="width:40%;">{{$kot['name']}}</td>
                <td style="width:20%;">{{$kot['quantity']}}</td>
                <td style="width:30%;">
                    <input type="number" class="form-control" name="item['{{$kot['slug']}}']" data-type="item" data-slug="{{$kot['slug']}}" min=1 max="{{$kot['quantity']}}" data-max="{{$kot['quantity']}}">
                </td>
            </tr>
        @endforeach
            <tr>
                <td style="width:100%;" colspan=4>
                    <textarea class="form-control" name="reason" id="kot-return-reason" placeholder="Reason" required></textarea>
                </td>
            </tr>
    </tbody>
</table>