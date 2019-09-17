@foreach($best_sellers as $best_seller)
<div class="kt-widget5__item">
        <div class="kt-widget5__content">
            <div class="kt-widget5__section">
                <a href="#" class="kt-widget5__title">
                   {{ $best_seller['name']}}
                </a>
                <p class="kt-widget4__text">
                    Menu Category
                </p>
            </div>
        </div>
        <div class="kt-widget5__content">
            <div class="kt-widget5__stats">
                <span class="kt-widget5__number">
                    {{ $best_seller['quantity']}}
                </span>
                <span class="kt-widget5__sales">Sales</span>
            </div>
        </div>
    </div>
@endforeach
