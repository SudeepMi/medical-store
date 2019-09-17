<ul class="kt-sticky-toolbar">
    <li class="kt-sticky-toolbar__item kt-sticky-toolbar__item--brand" data-toggle="kt-tooltip" title="Go To Workplace" data-placement="left">
        <a href="{{ route('workplace.index') }}" ><i class="flaticon2-browser-2"></i></a>
    </li>
    <li class="kt-sticky-toolbar__item kt-sticky-toolbar__item--success" id="show-occupied-tables" data-toggle="kt-tooltip"  title="Show Occupied Tables" data-placement="right">
        <a href="#" class=""><i class="flaticon-layer"></i></a>
    </li>
    <li class="kt-sticky-toolbar__item kt-sticky-toolbar__item--info" id="show-booked-tables" data-toggle="kt-tooltip"  title="Show Booked Tables" data-placement="right">
        <a href="#" class=""><i class="flaticon-layers"></i></a>
    </li>
    <li class="kt-sticky-toolbar__item kt-sticky-toolbar__item--danger" data-toggle="kt-tooltip" title="GO BACK" data-placement="left">
        <a href="javascript:history.go(-1)">
            <i class="flaticon-reply"></i>
        </a>
    </li>
</ul>

@include('layouts.components.occupied_table')
@include('layouts.components.booked_table')

