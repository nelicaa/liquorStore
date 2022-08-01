<body>
<div class="wrap" >
    <div class="container">
        <div class="row">
            <div class="col-md-6 d-flex align-items-center">
                <p class="mb-0 phone pl-md-2">
                    <a href="#" class="mr-2"><span class="fa fa-phone mr-1"></span> +00 1234 567</a>
                    <a href="#"><span class="fa fa-paper-plane mr-1"></span> <span>neka@gmail.com</span></a>
                </p>
            </div>
            <div class="col-md-6 d-flex justify-content-md-end">

                <div class="reg">
                    <p class="mb-0">
{{--                        {{dd($url)}}--}}
                        @if(session()->has("user"))
                            <a href="{{route("logout")}}">Log  out</a></p>
                @else

                        @if(isset($url))
                            @if($url=="registration")
                                <a href="/auth">Log In</a></p>

                @else
                                <a href="auth/create" class="mr-2">Sign Up</a>

                    @endif
                        @else
                            <a href="auth/create" class="mr-2">Sign Up</a>
                            <a href="/auth">Log In</a></p>
                        @endif
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark top-0 ftco-navbar bg-dark ftco-navbar-light " id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{route("home")}}">Liquor <span>store</span></a>
        @if(session()->has("user"))

        <div class="order-lg-last btn-group">
            @if(isset(session()->get("cart")["products"]))
            <a href="/myCart" class="btn-cart dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false">
                <span class="flaticon-shopping-bag text-light"></span>
                <div class="d-flex justify-content-center align-items-center text-light"><small>{{count(session()->get("cart")["products"])}} </small></div>
            </a>
            @else
                <a class="btn-cart dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false">
                    <span class="flaticon-shopping-bag text-light"></span>
                    <div class="d-flex justify-content-center align-items-center text-light"><small>0</small></div>
                </a>
            @endif

        </div>
        @endif
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
{{--                {{dd($menu)}}--}}
                @foreach($menu as $m)
{{--                    {{dd($m->route)}}--}}
                <li class="nav-item active"><a href="/{{$m->route}}" class="nav-link">{{$m->name}}</a></li>
                @endforeach
                @if(session()->has("user") && session()->get("user")->role_id==2)
                    <li class="nav-item active"><a href="{{route("dashboard")}}" class="nav-link">Admin panel</a></li>
                    @endif
            </ul>
        </div>
    </div>
</nav>


<section class="hero-wrap hero-wrap-2" style="background-image:url({{asset("assets/images/xkind-6.jpg.pagespeed.ic.tfFYjdPtI9.jpg")}})" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
            <div class="col-md-9 mb-5 text-center">
                <p class="breadcrumbs mb-0"><span class="mr-2"><a href="/">Home <i class="fa fa-chevron-right"></i></a></span> </p>
                <h2 class="mb-0 bread">@yield("page")</h2>
            </div>
        </div>
    </div>
</section>
