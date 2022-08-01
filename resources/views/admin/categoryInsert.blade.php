@extends("admin.layouts.layout")
@section("title", "Insert categories")
@section("page", "Categories")
@section("content")
    <section class="content">
        <div class="row">
            <!-- left column -->
            <form role="form"  action="/category" method="POST">
                @csrf
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name category</label>
                        <input type="text" class="form-control" id="name" name="value" placeholder="Name category">
{{--                        <small class="border-bottom border-danger text-danger d-none nameError"></small>--}}
                    </div>

                    <div class="col-lg-12">
                        <button type="submit" id="insert"  class="btn btn-primary col-6 m-auto">INSERT</button>
                    </div>

                </div>
            </form>

            <div class="p-5">
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


    </section><!-- /.content -->
@endsection
