<h5 class="modal-title" >{{ $retail->name }}</h5>
<table class="table table-striped">

    <tbody>
        <tr>
        <td>Price</td>
        <td>{{$retail->price}}</td>
        </tr>
        <tr>
                <td>Quantity</td>
                <td>{{$retail->quantity}}</td>
                </tr>
        <tr>
        <td>Description</td>
        <td>{{$retail->description}}</td>
        </tr>
        <tr>
        <td>Added By </td>
        <td>{{ $retail->user->name }}</td>
        </tr>
        <tr>
            <td>Added On: </td>
            <td>{{ \Carbon\Carbon::parse ($retail->created_at)->format ('Y-m-d')}}</td>
        </tr>
  </tbody>
</table>


