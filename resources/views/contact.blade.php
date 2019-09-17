@extends('layouts.app')
@section('title', 'Contact')
@section('content')

    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header" >
                    <div class="card-title">
                        Contact Details
                    </div>
                </div>
                <div class="card-body">
                    <ul class="bold">
                            <li class="kt-font-bolder">Address: </li>
                            <li class="kt-font-bolder">Phone: </li>
                            <li class="kt-font-bolder">Email: </li>
                            <li class="kt-font-bolder">other detail: </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title text-center">Send A message</h3>
            </div>
            <form action="{{ route('contact.sendmessage') }}" method="POST">
                @csrf
                <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" placeholder="your name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="your email">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <textarea class="form-control" name="message"rows="10" required placeholder="your message here"></textarea>
                </div>
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-toolbar">
                        <a href="#" class="btn btn-clean" onclick="window.history.back(0);">
                            <i class="la la-arrow-left"></i>
                            <span class="kt-hidden-mobile">Back</span>
                        </a>

                        <div class="btn-group">
                            <button type="submit" class="btn btn-brand">
                                <i class="la la-check"></i>
                                <span class="kt-hidden-mobile">Send</span>
                            </button>
                            <button type="button" class="btn btn-brand dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-reload"></i>
                                            <span class="kt-nav__link-text">Save & continue</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-power"></i>
                                            <span class="kt-nav__link-text">Save & exit</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    @endsection
@section('css')
    <link href="{{ asset('assets/css/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('js')
    <script src="{{ asset('assets/custom/bootstrap-select.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/custom/bootstrap-switch.js') }}" type="text/javascript"></script>
    @endsection