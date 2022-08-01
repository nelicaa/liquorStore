@extends("site.layouts.layout")
@section("title","ContactController - Liquor")
@section("page","ContactController")
@section("content")
{{--    <div class="row ">--}}
        <div class="col-md-7 m-auto">
            <div class="contact-wrap w-100 p-md-5 p-4 ">
                <h3 class="mb-4">Contact admin</h3>
                @if(isset($message))
                    <p class="alert-info alert">{{$message}}</p>
                    @endif
                <form action="sendMail" method="POST" id="contactForm" name="contactForm" class="contactForm ">
                    @csrf
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="label" for="email">Email Address</label>
                                @if(session()->has("user"))
                                    <input type="text" value="{{session()->get("user")->email}}" class="form-control" name="email" id="email" placeholder="Email">

                                @else
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                                    @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="label" for="subject">Subject</label>
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="label" for="#">Message</label>
                                <textarea name="message" class="form-control" id="message" cols="30" rows="4" placeholder="Message"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="submit" value="Send Message" class="btn btn-primary">
                                <div class="submitting"></div>
                            </div>
                        </div>
                    </div>
                </form>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>

        </div>
{{--    </div>--}}
@endsection
