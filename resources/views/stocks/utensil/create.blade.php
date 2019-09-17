@extends('layouts.app')
@section('title', 'stocks')
@section('content')

<
    @endsection

    @section('css')

        <link href="{{ asset('assets/css/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
    <script src="{{ asset('assets/js/datatables.bundle.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/custom/table-init.js') }}" type="text/javascript"></script>
@endsection
