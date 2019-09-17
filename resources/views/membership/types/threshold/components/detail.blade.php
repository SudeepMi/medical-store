<table class="table table-striped">
        <tbody>
        <tr>
            <td>Threshold Name : </td>
            <td>{{$data->name}}</td>
        </tr>
        <tr>
            <td>Created At :</td>
            <td>{{$data->created_at}}</td>
        </tr>
        </tbody>
    </table>

    <div class="accordion accordion-solid accordion-toggle-arrow" id="accordionExample8">
            <div class="card">
                <div class="card-header" id="headingOne8">
                    <div class="card-title" data-toggle="collapse" data-target="#collapseOne8" aria-expanded="true" aria-controls="collapseOne8">
                        <h6> Details</h6>
                    </div>
                </div>
                <div id="collapseOne8" class="collapse show" aria-labelledby="headingOne8" data-parent="#accordionExample8">
                    <div class="card-body">
                        <table class="table table-striped- table-bordered table-hover table-checkable dataTable-init">
                            <tbody>
                                <tr>
                                    <td>S.N</td>
                                    <td>Amount</td>
                                    <td>Discount(%)</td>
                                </tr>
                                    @foreach ($data->details as $key)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $key[0] }}</a></td>
                                        <td>{{ $key[1] }}</td>

                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
