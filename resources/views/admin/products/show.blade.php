@extends('Admin.layouts.header')

<style>
    .product-container {
        display: flex;
        flex-wrap: nowrap;
        overflow-x: auto;
        padding: 10px 0;
    }

    .product-card {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
        text-align: left;
        margin-right: 20px;
        flex: 0 0 auto;
        width: 300px;
        background-color: #fff;
        position: relative;
        overflow: hidden;
    }

    .product-card:hover {
        transform: translateY(-10px);
    }

    .product-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-bottom: 1px solid #e0e0e0;
    }

    .product-card .card-body {
        padding: 1rem;
    }

    .product-card .card-title {
        font-size: 1rem;
        margin-bottom: 0.5rem;
    }

    .product-card .price-range {
        font-size: 1rem;
        color: #555;
        margin-bottom: 0.5rem;
    }

    .product-card .original-price {
        text-decoration: line-through;
        color: #ccc;
        margin-right: 10px;
    }

    .product-card .discounted-price {
        color: #e60000;
        font-weight: bold;
    }

    .product-card .discount-percentage {
        color: #e60000;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }

    .product-card .card-text {
        font-size: 0.9rem;
        color: #555;
        margin-bottom: 1rem;
    }

    .product-card .quick-shop-btn {
        background-color: #000;
        color: #fff;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .product-card .quick-shop-btn:hover {
        background-color: #555;
    }

    .filter-sort-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .filter-sort-container select,
    .filter-sort-container .filter-icon {
        margin-right: 1rem;
    }

    .see-more {
        color: #007bff;
        cursor: pointer;
        text-decoration: underline;
    }

    .discount-timer {
        position: absolute;
        top: 40px;
        left: 10px;
        background-color: rgba(0, 0, 0, 0.7);
        color: #fff;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 0.9rem;
    }

    .countdown {
        font-size: 1rem;
        color: white;
        font-weight: bold;
    }

    .discount-banner {
        position: absolute;
        top: 0;
        right: 0;
        width: 50px;
        height: 100%;
        background-color: #e60000;
        color: #fff;
        padding: 5px;
        text-align: center;
        font-size: 0.8rem;
        font-weight: bold;
        writing-mode: vertical-rl;
        transform: rotate(180deg);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        z-index: 10;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .discount-banner::after {
        content: '';
        position: absolute;
        top: 100%;
        left: 0;
        width: 0;
        height: 0;
        border-left: 15px solid transparent;
        border-right: 15px solid transparent;
        border-top: 15px solid #e60000;
    }

    .upcoming-discount {
        background-color: #ffcc00;
        color: #000;
        padding: 5px 10px;
        font-weight: bold;
    }
</style>

@section('content')
<div class="content">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Products List</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="product-container">
                @foreach($products as $product)
                <div class="product-card">
                    @php
                    $hasDiscount = $product->discounts()->exists();
                    $discount = $hasDiscount ? $product->discounts()->first() : null;
                    $startDate = $discount ? \Carbon\Carbon::parse($discount->start_date) : null;
                    $endDate = $discount ? \Carbon\Carbon::parse($discount->end_date) : null;
                    $currentDate = \Carbon\Carbon::now();
                    $isUpcoming = $startDate && $startDate > $currentDate;
                    $isOngoing = !$isUpcoming && $endDate && $currentDate <= $endDate;
                        @endphp

                        @if($isUpcoming)
                        <div class="upcoming-discount">
                        Discount Starts Soon
                </div>
                @endif

                @if($hasDiscount && !$isUpcoming) <!-- Only show discount banner if the discount is ongoing -->
                <div class="discount-banner">
                    {{ $discount->event_name }}
                </div>
                <div class="discount-timer" id="countdown-{{ $product->product_id }}">
                    @if($isOngoing)
                    <span class="countdown" data-start-date="{{ $startDate->toDateTimeString() }}" data-end-date="{{ $endDate->toDateTimeString() }}"></span>
                    @else
                    <span class="countdown">Coming Soon</span>
                    @endif
                </div>
                @endif

                <img src="{{ $product->image_url }}" alt="{{ $product->product_name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->product_name }}</h5>
                    <p class="price-range">
                        @if($isOngoing)
                        @php
                        $discountedPrice = $product->price * (1 - $discount->discount_amount / 100);
                        @endphp
                        <span class="original-price">₱{{ $product->price }}</span>
                        <span class="discounted-price">₱{{ $discountedPrice }}</span>
                        <span class="discount-percentage">({{ $discount->discount_amount }}% off)</span>
                        @else
                        ₱{{ $product->price }}
                        @endif
                    </p>
                    <p class="card-text">
                        @if(strlen($product->description) > 100)
                        {{ substr($product->description, 0, 100) }}...
                        <span class="see-more" onclick="toggleDescription(this, '{{ $product->description }}')">See More</span>
                        @else
                        {{ $product->description }}
                        @endif
                    </p>
                    <button class="quick-shop-btn">Description</button>
                </div>
            </div>
            @endforeach
        </div>
</div>
</section>
</div>
@endsection

<script>
    function toggleDescription(element, fullDescription) {
        if (element.innerText === 'See More') {
            element.innerText = 'See Less';
            element.previousSibling.nodeValue = fullDescription;
        } else {
            element.innerText = 'See More';
            element.previousSibling.nodeValue = fullDescription.substring(0, 100) + '...';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const countdownElements = document.querySelectorAll('.countdown');

        countdownElements.forEach(function(countdownElement) {
            const startDate = new Date(countdownElement.getAttribute('data-start-date'));
            const endDate = new Date(countdownElement.getAttribute('data-end-date'));

            function updateCountdown() {
                const now = new Date();
                let distance = endDate - now;

                if (now < startDate) {
                    distance = startDate - now;
                    countdownElement.innerHTML = 'Starts in: ' + formatCountdown(distance);
                    countdownElement.classList.add('discount-upcoming');
                    countdownElement.classList.remove('discount-ongoing');
                } else if (now >= startDate && now <= endDate) {
                    countdownElement.innerHTML = formatCountdown(distance);
                    countdownElement.classList.add('discount-ongoing');
                    countdownElement.classList.remove('discount-upcoming');
                }
            }

            function formatCountdown(distance) {
                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                return `${days}d ${hours}h ${minutes}m ${seconds}s`;
            }

            // Initial countdown update and setup interval
            updateCountdown(); // Update immediately
            const x = setInterval(updateCountdown, 1000); // Update every second
        });
    });
</script>