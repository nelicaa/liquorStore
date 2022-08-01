@extends("admin.layouts.layout")
@section("title", "Categories")
@section("page", "Categories")
@section("content")

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Categories</h3>
                    </div><!-- /.box-header -->
                    @if(session("mess"))
                        <p class="{{session("alert")}} alert">{{session("mess")}}</p>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="table-responsive-lg p-1">

                        <a href="/category/create" class="text-info text-bold "><p>INSERT NEW CATEGORY</p></a>

                        <table id="example2" class="table table-bordered p-5">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th></th>
                                <th></th>

                            </thead>
                            <tbody id="tableHtml">
                            @foreach($categories as $c)
                                <tr>
                                    <td>{{$c->id}}</td>
                                    <form method="post" action="/category/{{$c->id}}">
                                        @csrf
                                        @method("put")
<td>
                                        <input type="text" name="value" class="form-control"  value="{{$c->name}}"/>

                                        </td>


                                        <td>
                                            <input type="submit" value="UPDATE" name="update" class="text-info btn"/>
                                        </td>
                                    </form>


                                    <td>
                                        <form action="category/{{$c->id}}" method="post">
                                            @csrf
                                            @method("delete")
                                            <input type="submit" class="btn btn-danger delete" value="DELETE"/>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                @for($i=1;$i<=$categories->lastPage();$i++)
                                    <li class="page-item"><a class="page-link" href="{{$categories->url($i)}}">{{$i}}</a></li>

                                @endfor

                            </ul>
                        </nav>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div></div></section>


@endsection
