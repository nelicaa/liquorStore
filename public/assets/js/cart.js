$(document).ready(function (){
    $('.products').click(products)
    $('#remove').click(remove)
    $('#date').change(filter)
})
function remove(e){
    e.preventDefault()
    $('#date').val(null)
    filter()
}
function filter(){
    let date= $('#date').val()
    $.ajax({
        url: "/showCart",
        method: "get",
        data: {date:date},
        dataType: "json",
        success: function(data){
            console.log(data)
            showCart(data)
        },
        error: function(xhr, data) {
            console.error(xhr.responseText);
            console.error(xhr.status)
            if (xhr.status == 404) {
                console.log("404")
            }
            alert(xhr.responseText)
        }
    })
}


function showCart(data){
let html=``
    if(data.length!=0){
    for(d of data){
        html+=`
                        <tr>
                            <td>${d.id}</td>
                            <td class="col-xs-3 col-sm-1"><img class="img img-thumbnail " src="assets/images/users/${d.user.picture}"></td>
                            <td>${d.user.email}</td>
                            <td>${d.created_at}</td>
    <td>        <button type="button" class="btn btn-primary products" data-id="${d.id}" data-toggle="modal" data-target="#exampleModal">
            Click to see all bought products for this cart
        </button></td>
                        </tr>`
    }
    $('#html').html(html)
    $('.products').click(products)}
    else{
        $('#html').html("<tr><td>No cart for that date.</td></tr>")

    }

}
function products(){
    let idCart=this.dataset.id

    $.ajax({
        url: "/showCartProducts",
        method: "get",
        data: {idCart:idCart},
        dataType: "json",
        success: function(data){
            console.log(data)
            showProducts(data)
        },
        error: function(xhr, data) {
            console.error(xhr.responseText);
            console.error(xhr.status)
            if (xhr.status == 404) {
                console.log("404")
            }
            alert(xhr.responseText)
        }
    })
}

function showProducts(data){
    console.log(data)
    let fullPrice=0
    let discount=0
    let bill=0
    let html=`
        <table class="table-responsive">
            <thead className="thead-primary">
            <tr>
                <th></th>
                <th>Product</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Quantity</th>
                <th>total</th>
                <th></th>
            </tr>
            </thead>
            <tbody>`
    for(d of data){
        console.log(d)
        fullPrice+=d.product.price[0].price*d.quantity
        discount+=(d.product.price[0].price*d.product.price[0].discount/100)*d.quantity
        bill+=(d.product.price[0].price-(d.product.price[0].price*d.product.price[0].discount/100))*d.quantity
html+=` <tr className="alert" role="alert">
                    <td class="col-xs-3">
                    <img class="img img-thumbnail " src="assets/images/products/${d.product.image}"></td>
                    <td>
                    <div class="email">
                    <span>${d.product.product.name}</span>
                    <span>${d.product.product.desc}</span>
                    </div>
                    </td>
                    <td>$ ${d.product.price[0].price}</td>
                    <td>${d.product.price[0].discount} %</td>

                    <td class="quantity">


<!--                    @foreach(session()->get("cart")["products"] as $c)-->
<!--                    @if($c["price_id"]==$p->price[0]->id)-->
                    <p> ${d.quantity}</p>
                    </td>
                    <td>
                $  ${(d.product.price[0].price-(d.product.price[0].price*d.product.price[0].discount/100))*d.quantity}
                    </td>

                    </tr>`




    }
      html+=`</tbody> <tfoot class="border">
                                                      <tr class="">
                                                  <th>Full price</th>
                                                     <th>Discount</th>
                                                                                                           <th></th>

                                                        <th>Bill with discount</th>

                                                      </tr>
<tr>
<td>$ ${fullPrice}</td>
<td>$ ${discount}</td>
<td></td>
<td>$ ${bill}</td>
</tr>
                                      </tfoot>
    </table>`
    $('#showProducts').html(html)
}
