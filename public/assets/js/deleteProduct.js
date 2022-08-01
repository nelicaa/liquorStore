$(document).ready(function (){
    $('.delete').click(deleteProduct)


})
const token = $('meta[name="csrf-token"]').attr('content');

function deleteProduct(e){
    e.preventDefault()
    let id=this.dataset.id
    // alert(id)
    let url='/productsAdmin/'+id
        $.ajax({
            headers: {'X-CSRF-TOKEN': token},
            url:	url ,
            method: "delete",
            data: {id:id},
            dataType: "json",
            success: function (data){
                console.log(data)
                tableHtml(data.products)
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

function tableHtml(products){
    let html;
    for(p of products){
        console.log(p.liter.length)
        for(let i=0;i<p.liter.length;i++){
    html+=`<tr>
     <td>${p.price[i].product_liter_id}</td>
      <td class="col-xs-3 col-sm-1"><img class="img img-thumbnail " src="assets/images/products/${p.liter[i].pivot.image}"></td>
       <td>${p.name}</td>
        <td>${p.desc}</td>
        <td>${p.category.name}</td>
        <td>${p.liter[i].liter} liter</td>
        <td>${p.price[i].price} $</td>
        <td>${p.price[i].discount} $</td>
        <td>${p.price[i].price-(p.price[i].price*p.price[i].discount/100)} $</td>
        <td>
           <a href="/productsAdmin/${p.id}/edit" class="text-info">UPDATE</a>
        </td>   <td>
         <form action="" method="post">
<!--          @csrf-->
         <meta name="csrf-token" content="{{ csrf_token() }}">
             <input type="submit" class="btn btn-danger delete" data-id="${p.price[i].product_liter_id}" value="DELETE"/>

      </form>
     </td></tr>
    `

}}
    html+=`<!--</tr>-->`
    $('#tableHtml').html(html)
    $('.delete').click(deleteProduct)








}
