<div class="col-md-3 d-flex">
{{--    {{dd($product->price[]->price)}}--}}
    <div class="product">
        <a href="product/{{$product->price[$i]->product_liter_id}}">

        <div class="img d-flex align-items-center justify-content-center" style="background-image:url({{asset("assets/images/products/".$product->liter[$i]->pivot->image)}})">
            <div class="desc">

            </div>
        </div>        </a>

        <div class="text text-center">
            @if($page=="home")
            <span class="category">{{$product->category->name}}</span>
            <h2>{{$product->name}}</h2>
            @endif
            @if($product->price[$i]->discount==0)
            <span class="price">${{$product->price[$i]->price}}</span>
                <br/> <span class="category">{{$product->liter[$i]->liter}} liter</span>
            @else
                            <span class="sale">Sale {{$product->price[$i]->discount}} %</span>

                <span class="price price-sale">${{$product->price[$i]->price}}</span>
                <span class="price">${{$product->price[$i]->price-($product->price[$i]->price*$product->price[$i]->discount/100)}}</span>
               <br/> <span class="category">{{$product->liter[$i]->liter}} liter</span>
            @endif
        </div>
    </div>
</div>
