$(document).ready(function (){
    $('#filter').click(getValues)
    $('#search').keyup(getValues)
    $('#sort').change(getValues)
    $('.cat').change(getValues)
    $('.liter').change(getValues)
})
function getValues(pag){
    if($.isNumeric( pag )){
        pag=pag
    }
    else{
        pag=1
    }
    let liter=$('.liter')
    let arrayLiter=[]
        liter=liter.map(function (i){
            if($(this).is(":checked")){
                arrayLiter.push(liter[i].value);

            }})
    let cat=$('.cat')
    let arrayCat=[]
        cat.map(function (i){
            if($(this).is(":checked")){
                arrayCat.push(cat[i].value);

            }})
    let search=$('#search').val()
    let sort=$('#sort').val()
    paginateSortFilterSearch(pag,sort,arrayCat,arrayLiter,search)
}

function paginateSortFilterSearch(pag,sort,cat,liter,search){

    $.ajax({
        url: "/filterSort/pag",
        method: "get",
        data: {"page":pag,"sort":sort,"cat":cat,"liter":liter,"search":search},
        dataType: "json",
        success: function(data){
            console.log(data)
            products(data)
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


function products(products){
    let html="<div class='border-3 d-flex flex-row flex-wrap border mb-2 p-1'>"
    for(p of products.data){

        console.log(p)
        html+=`
<div class="col-md-3 d-flex">

   <div class="product">
     <a href="product/${p.price[0].product_liter_id}">
  <div class="img d-flex align-items-center justify-content-center">
<img class="img-fluid" src="assets/images/products/${p.image}" alt="${p.product.name}"/>
    </div>

      </a>
      <h2>${p.product.name}</h2>
    <div class="text text-center">
          `
        if(p.price[0].discount==0){
            html+=`
        <span class="price">$ ${p.price[0].price}</span>
              <br/> <span class="category">${p.liter.liter} liter</span>`
        }
        else{
            html+=`<span class="sale">Sale ${p.price[0].discount} %</span> <span class="price price-sale">$ ${p.price[0].price}</span>

              <span class="price">$ ${p.price[0].price-(p.price[0].price*p.price[0].discount/100)}</span>
             <br/> <span class="category">${p.liter.liter} liter</span>`
        }
       html+=`
      </div>
      </div>
      </div>`
//
    }
    html+=`         </div>`

$('#products').html(html)
    console.log(products)
    html=""
    for(let i=1;i<=products.last_page;i++){
        html+=` <li><a id="${i}" class="filterPaginacija"  href="/filterSort/page=${i}">${i}</a></li>`
    }
    $('#pag').html(html)
    $('.filterPaginacija').click(filterPaginacija)

}
function filterPaginacija(e){
    e.preventDefault();
    let id=this.id
    getValues(id)
}



