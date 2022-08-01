@extends('site.layouts.layout')
@section("title", "Log in")
@section("page", "Log in")
@section("content")
    {{--    {{dd($menu)}}--}}
    <section class="ftco-section bg-light m-auto">
        <div class="container">
            <div class="contact-wrap w-100 p-md-8 p-4 ">
                <h3 class="mb-4 text-center">Log in</h3>
                <form method="post" id="contactForm" name="contactForm" class="contactForm">
                    @csrf
                    <meta name="csrf-token" content="{{ csrf_token() }}">

                        <div class="col-md-6 m-auto">
                            <div class="form-group">
                                <label class="label" for="email">Email</label>
                                <input type="email" class="form-control p-2" name="email" id="email" placeholder="Email">
                                <small class="border-bottom border-danger text-danger d-none email"></small>
                            </div>
                        </div> <div class="col-md-6  m-auto">
                            <div class="form-group">
                                <label class="label" for="password">Password</label>
                                <input type="password" class="form-control p-2" name="password" id="password" placeholder="Password">
                                <small class="border-bottom border-danger text-danger d-none pass"></small>
                            </div>
                        </div>



                        <div class="col-md-6 m-auto">
                            <div class="form-group d-flex">
                                <input id="login" type="submit" value="Log in" class="btn btn-primary">
                                <div class="submitting"></div>
                            </div>
                        </div>
{{--                    </div>--}}
                </form>
            </div>

        </div>
    </section>
@endsection
@section("script")
    <script src="{{asset("assets/js/login.js")}}"></script>
@endsection
