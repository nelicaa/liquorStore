@extends("site.layouts.layout")
@section("title","Home - Liquor")
@section("page","Home")
@section("content")
{{--    </div>--}}
    <section class="ftco-intro">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-4 d-flex">
                    <div class="intro d-lg-flex w-100 ">
                        <div class="icon">
                            <span class="flaticon-support"></span>
                        </div>
                        <div class="text">
                            <h2>Online Support 24/7</h2>
                            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="intro color-1 d-lg-flex w-100 ">
                        <div class="icon">
                            <span class="flaticon-cashback"></span>
                        </div>
                        <div class="text">
                            <h2>Money Back Guarantee</h2>
                            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="intro color-2 d-lg-flex w-100 ">
                        <div class="icon">
                            <span class="flaticon-free-delivery"></span>
                        </div>
                        <div class="text">
                            <h2>Free Shipping &amp; Return</h2>
                            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section ftco-no-pb">
        <div class="container">
            <div class="row">
                <div class="col-md-6 img img-3 d-flex justify-content-center align-items-center" style="background-image:url({{asset("assets/images/ximage_6.jpg.pagespeed.ic.WVYuhIwmND.jpg")}}">
                </div>
                <div class="col-md-6 wrap-about pl-md-5 py-5">
                    <div class="heading-section">
                        <span class="subheading">Since 1905</span>
                        <h2 class="mb-4">Desire Meets A New Taste</h2>
                        <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                        <p>On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should turn around and return to its own, safe country.</p>
                        <p class="year">
                            <strong class="number" data-number="115">50</strong>
                            <span>Years of Experience In Business</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center pb-5">
            <div class="col-md-7 heading-section text-center">
                <span class="subheading">Our Delightful offerings</span>
                <h2>Tastefully Yours</h2>
            </div>
        </div>
        <div class="row">
{{--            {{dd($products)}}--}}
            @foreach($products as $p)
            <x-product-component :i="0" :product="$p" page="home"></x-product-component>
            @endforeach
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div class="col-md-4">
            <a href="products" class="btn btn-primary d-block ">View All Products <span class="fa fa-long-arrow-right"></span></a>
        </div>
    </div>

</section>

@endsection
