<table class="table table-striped- table-bordered table-hover table-checkable dataTable-init">

<thead>
    <tr>
        <th>Date</th>
        <th>In</th>
        <th>Out</th>
        <th>Remarks</th>
    </tr>
</thead>
<tbody>
@isset($details)
@foreach ($details->opening_count as $i)
    <tr>
        <td>{{ \Carbon\Carbon::parse ($i->created_at)->format ('Y-m-d') }}</td>
        <td>{{ $i->stock_in ?? $utensil->quantity }}</td>
        <td>{{ $i->stock_out }}</td>
        <td>{{ $i->remarks }}</td>
    </tr>
    @foreach ($details->adjustment as $d)
    <tr>
        <td>{{ \Carbon\Carbon::parse ($d->created_at)->format ('Y-m-d') }}</td>
        <td>{{ $d->stock_in ?? $utensil->quantity }}</td>
        <td>{{ $d->stock_out }}</td>
        <td>{{ $d->remarks }}</td>
    </tr>
    @endforeach
  @endforeach
@endisset
</tbody>
</table>

