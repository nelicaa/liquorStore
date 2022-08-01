@extends('site.layouts.layout')
@section("title", "About me")
@section("page", "About me")
@section("content")
    <section class="ftco-section contact-section">
        <div class="container mt-5">
            <div class="row block-9">
                <div class="col-md-4 contact-info">
                    <img class="img-fluid" src="assets/images/autor.jpg" alt="autor"/>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-6 ">
                    <div class="col-md-12">
                        <div class="">
                            <small>Ime</small>
                            <p  class="">Nelica</p>

                        </div> <div class="">
                            <small>Prezime</small>
                            <p  class="">Stojadinovic</p>

                        </div>
                        <div class="">
                            <small>Datum rodjenja</small>
                            <p class="" >30.06.1999.</p>

                        </div>
                        <div class="">
                            <small>Srednja skola</small>
                            <p   class="">Gimnazija Velika Plana</p>

                        </div>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
