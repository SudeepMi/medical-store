@foreach($activities as $log)
<div class="kt-timeline-v2__item">
    <span class="kt-timeline-v2__item-time">{{  \Carbon\Carbon::parse ($log->date)->format ('H:i') }}</span>
    <div class="kt-timeline-v2__item-cricle">
        <i class="fa fa-genderless kt-font-danger"></i>
    </div>
    <div class="kt-timeline-v2__item-text  kt-padding-top-5">
        {{ $log->message }} <a href="#" class="kt-link kt-link--brand kt-font-bolder">{{ $log->user }}</a>
    </div>
</div>
    @endforeach
