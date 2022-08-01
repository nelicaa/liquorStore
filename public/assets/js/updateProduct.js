$(document).ready(function (){
    $('#update').click(updateProduct)


})
const token = $('meta[name="csrf-token"]').attr('content');

function updateProduct(e){
    e.preventDefault()
    let id=this.dataset.id
    let url="/productsAdmin/"+id;
    let name=$('#name').val()
    let desc=$('#desc').val()
    let cat=$('#cat').val()
    let prices=$('.price')
    let priceObj=[];
    let obj = new FormData();
// console.log(name)
    let discount;
    let idLiter;
    let picture;
    let errors=[];
    let regName=/^([A-Z][a-z]{2,})((\s)?[A-z])*$/
    let regDesc=/^([A-Z][a-z])((\s)?[A-z])*$/

    let regNumber=/^[\d]{1,}$/
    let regDiscount=/^[0-9][0-9]?$|^100$/
    // console.log( $('#picture1')[0].files[0])
    // obj.append("image", $('#picture1')[0].files[0]);
    priceObj=jQuery.map(prices,function(i){
        if(i.value!=""){
            idLiter=i.id;
            discount=$(".disc"+idLiter).val()
            picture=$(".picture"+idLiter)[0].files[0];
            if(regNumber.test(i.value)){
                $('.priceError'+idLiter).addClass("d-none");
            }
            else{
                $('.priceError'+idLiter).removeClass("d-none");
                $('.priceError'+idLiter).text("Price must be numeric.");
                errors.push("Price is numeric.")
            }
            if(picture==undefined){
                console.log($('.picture'+idLiter).attr('value'))
                $(".picError"+idLiter).addClass("d-none");
                // if($('#picture'+idLiter).attr('value')){
                    picture=$('.picture'+idLiter).attr('value');
                    console.log(picture)
                // }
            }
            else if(picture["type"]!="image/jpeg" && picture["type"]!="image/png"){
                $(".picError"+idLiter).removeClass("d-none");
                $(".picError"+idLiter).text("Uploaded picture extension: jpg,jpeg,png.")
                errors.push("Uploaded picture for error.");
            }
            else{
                picture=$('.picture'+idLiter)[0].files[0];
                $(".picError"+idLiter).addClass("d-none");

            }
            if(discount==""){
                discount=0
                $(".discError"+idLiter).addClass("d-none");

            }
            else if(!regDiscount.test(discount)){
                $(".discError"+idLiter).removeClass("d-none");
                $(".discError"+idLiter).text("Discount must be number between 1 and 100");
                errors.push("Discount for error.");
            }
            else{
                $(".discError"+idLiter).addClass("d-none");

            }
            console.log(picture)
            obj.append("image"+idLiter, picture)
            return {"idLiter":idLiter, "price":i.value, "discount":discount}

        }})
    // }
    console.log(obj)
    if(priceObj.length==0){
        $('.priceError').removeClass("d-none");
        $('.priceError').text("Product must have at least one mesaure and price for that mesaure. Price is numeric.");
        errors.push("Product must have at least one mesaure and price for that mesaure.")

    }
    else{
        $('.priceError').addClass("d-none");

    }
    if (regName.test(name)){
        $('#name').removeClass("bg-danger text-white")
        $('.nameError').addClass("d-none");
        $('#name').addClass("border border-success");
    }
    else{
        $('#name').removeClass("border border-success")
        $('#name').addClass(" bg-danger text-white");
        $('.nameError').removeClass("d-none");
        $('.nameError').text("Name of product starts with capital letter and contain only letters.")


        errors.push("Name of product starts with capital letter and contain only letters.")
    }
    if (regDesc.test(desc)){
        $('#desc').removeClass("bg-danger text-white")
        $('.descError').addClass("d-none");
        $('#desc').addClass("border border-success");
    }
    else{
        $('#desc').removeClass("border border-success")
        $('#desc').addClass("bg-danger text-white");
        $('.descError').removeClass("d-none");
        $('.descError').text("Description of product starts with capital letter and contain only letters.")
        errors.push("Description of product starts with capital letter and contain only letters.")
    }
    if(!regNumber.test(cat)){
        errors.push("category error")
    }
    console.log(obj)
    if(errors.length==0){
        obj.append('name', name);
        obj.append('desc', desc);
        obj.append('category_id', cat);
        // obj.objPriceLiter=priceObj;

        obj.append('objPriceLiter',  JSON.stringify(priceObj));
        console.log(obj)
    obj.append("_method", "put")
        $.ajax({
            headers: {'X-CSRF-TOKEN': token},
            url: url,
            processData: false,
            contentType: false,
            method: "POST",
            data: obj,
            dataType: "json",
            success: function(data){
                console.log(data)
                window.location=data.url;
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

        //     callBackAjax("/auth", "POST", obj,  function(data) {
        //         window.location=data.url;
        //     }, false)
        // }
    }
}
