@extends('site.layouts.layout')
@section("title", "Sign up")
@section("page", "Sign up")
@section("content")
{{--    {{dd($menu)}}--}}
    <section class="ftco-section bg-light">
        <div class="container">

                                <div class="contact-wrap w-100 p-md-8 p-4 ">
                                    <h3 class="mb-4">Sign up</h3>
                                    <form method="POST" id="contactForm" name="contactForm" enctype="multipart/form-data" class="contactForm">
                                        @csrf
                                        <meta name="csrf-token" content="{{ csrf_token() }}">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label" for="name">First name</label>
                                                    <input type="text" class="form-control p-2" name="name" id="fname" placeholder="First name">
                                                    <small class="border-bottom border-danger text-danger d-none fname"></small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label" for="lname">Last name</label>
                                                    <input type="text" class="form-control p-2" name="lname" id="lname" placeholder="Last name">
                                                    <small class="border-bottom border-danger text-danger d-none lname"></small>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label" for="email">Email</label>
                                                    <input type="email" class="form-control p-2" name="email" id="email" placeholder="Email">
                                                    <small class="border-bottom border-danger text-danger d-none email"></small>
                                                </div>
                                            </div> <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label" for="password">Password</label>
                                                    <input type="password" class="form-control p-2" name="password" id="password" placeholder="Password">
                                                    <small class="border-bottom border-danger text-danger d-none pass"></small>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group search-form">
                                                    <label class="label" for="zip">Zip code</label>
                                                    <select class="js-example-basic-single form-control" name="zipCode" id="zipCode">

                                                    </select>
{{--                                                    <input type="search" class="form-control" name="zip" id="zipCode" placeholder="Zip code">--}}
                                                    <small class="border-bottom border-danger text-danger d-none zip"></small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label" for="city">City</label>
                                                    <select class="js-example-basic-single form-control" name="city" id="name" placeholder="City">

                                                    </select>
{{--                                                    <input type="search" class="form-control" name="city" id="name" placeholder="City">--}}
                                                    <small class="border-bottom border-danger text-danger d-none city"></small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label" for="street">Street</label>
                                                    <input type="text" class="form-control p-2" name="street" id="street" placeholder="Street">
                                                    <small class="border-bottom border-danger text-danger d-none street"></small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label" for="phone">Phone</label>
                                                    <input type="text" class="form-control p-2" name="phone" id="phone" value="+" placeholder="Phone">
                                                    <small class="border-bottom border-danger text-danger d-none phone"></small>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="label" for="subject">Your picture</label>
                                                    <input type="file" class="" name="picture" id="picture" placeholder="Picture"> </br>
                                                    <small class="border-bottom border-danger text-danger d-none pic"></small>
                                                </div>
                                            </div>


                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input id="signup" type="submit" value="Sign up" class="btn btn-primary">
                                                    <div class="submitting"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
{{--                            </div>--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </section>
    @endsection
@section("script")
    <script src="{{asset("assets/js/auth.js")}}"></script>
    @endsection
