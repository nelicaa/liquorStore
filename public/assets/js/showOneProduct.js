$(document).ready(function (){
    $('.showProduct').click(showProduct)


})

function showProduct(e){
    e.preventDefault()
    let idL=this.dataset.liter
    let idP=this.dataset.product
    let url="/products/"+idP
    $.ajax({
        url: url,
        method: "GET",
        data: {idL:idL,idP:idP},
        dataType: "json",
        success: function(data){
            // console.log(data)
            html(data.product,data.productLiter,data.image, data.sold)
            // window.location=data.url;
        },
        error: function(xhr, data) {
            console.error(xhr.responseText);
            console.error(xhr.status)
            if (xhr.status == 404) {
                console.log("404")
                // window.location.href = "404.php"
            }
            alert(xhr.responseText)
        }
    })

}

function html(product,productLiter,image,sold) {
    console.log("klik")
    let html="";
    let img = "/assets/images/products/" + image
    // console.log(productLiter[0])
    // console.log(product)
    $("#image" + product.id).attr("src", img);
    $("#pivot").val(productLiter[0].product_liter_id);
    $("#price").val(productLiter[0].id);
    if(sold[0].order_sum_quantity==null){
        $("#sold").text(" - 0");

    }
    else{
        $("#sold").text(" - "+sold[0].order_sum_quantity);

    }
    if (productLiter[0].discount != 0) {
        html+=`<small class="price text-decoration-line-through">$ ${productLiter[0].price}</small>
    <p class="price "><span class="text-danger">$ ${productLiter[0].price-(productLiter[0].price*productLiter[0].discount/100)}</span>
    </p>
    <small class="">Discount : <span class="text-danger text-bold">${productLiter[0].discount} %</span></small>
        `
    }
else{
    html+=` <p class="price"><span>$ ${productLiter[0].price}</span></p>`

}

$('#priceDiscount').html(html)
    // $('.showProduct').click(showProduct)
}
