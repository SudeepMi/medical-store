<table class="table table-striped">
<tr>
    <th>Name</th>
    <td>{{ $debtor->name }}</td>
</tr>
<tr>
    <th>Code</th>
    <td>{{ $debtor->code }}</td>
</tr>
</table>
<table class="table table-bordered table-striped table-responsive-sm">
<tr>
    <th>Type</th>
    <th>Amount</th>
    <th>Date</th>
    <th>Description</th>
</tr>
@foreach ($debtor->creditEntry as $item)
<tr>
    <td>
        @if($item->is_credit_paid == 0)
            credited
        @else
            recieved
        @endif
    </td>
    <td>{{ $item->amount }}</td>
    <td>{{ $item->created_at->format('y-m-d') }}</td>
    <td>{{ $item->description }}</td>
</tr>
@endforeach
</table>
