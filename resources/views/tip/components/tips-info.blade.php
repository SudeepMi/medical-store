<h5 class="modal-title" ></h5>
<table class="table table-striped">

    <tbody>
        <tr>
        <td>
          @if($tips->is_distributed == 1)
          Tips Distributed
          @else
          Tips Recieved
          @endif
        </td>
        <td>{{$tips->tip_amount}}</td>
        </tr>
        <tr>
        <td>Remarks</td>
        <td>{{$tips->remarks}}</td>
        </tr>
        <tr>
            <td> @if($tips->is_distributed == 1)
                     Distributed By
                    @else
                     Recieved By
                    @endif </td>
            <td>{{ $tips->user->name }}</td>
        </tr>
        <tr>
                <td> @if($tips->is_distributed == 1)
                         Distributed on
                        @else
                         Recieved on
                        @endif</td>
                <td>{{ \Carbon\Carbon::parse ($tips->created_at)->format ('Y-m-d') }}</td>
            </tr>
  </tbody>
</table>


