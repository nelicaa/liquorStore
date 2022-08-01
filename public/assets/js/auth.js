$(document).ready(function (){
    getZipCity()
    $('.js-example-basic-single').select2();
    $('#signup').click(signup)
    $('#name, #zipCode').change(autofillCityZip)

})
const token = $('meta[name="csrf-token"]').attr('content');

function autofillCityZip(){
    // alert("Sdfs")
    let value=this.value;
    var column=this.id;
    callBackAjax("/searchCityZip", "GET", {value:value, column:column},function (data){
        // console.log(column)
        let zip=data[0].zipCode;
        let city=data[0].name;
        $('#zipCode').val(zip).attr("selected"); //
        $('#select2-zipCode-container').text(zip) //
        $('#name').val(city).attr("selected")
        $('#select2-name-container').text(city);

    }, true)
}

function getZipCity(){
    callBackAjax("/indexJs", "GET", {},function (data){
        let zip="<option selected></option>"
        for( let d of data){
            // console.log(d)
            zip+=`<option id="${d.id}" value="${d.zipCode}">${d.zipCode}</option>`
        }
        $('#zipCode').html(zip)

        let city="<option selected></option>"
        for( let d of data){
            // console.log(d)
            city+=`<option value="${d.name}">${d.name}</option>`
        }
        $('#name').html(city)


    }, true)
}



function signup(e){
    e.preventDefault()
    var firstName = $('#fname');
    var  lastName= $('#lname');
    var email = $('#email');
    var pass = $('#password');
    var city = $('#name')
    var zip = $('#zipCode');
    var address = $('#street');
    var phone = $('#phone');
    var pic = $('#picture')[0].files[0];
    var regName = /^([A-Z][a-z]{2,})((\s)?[A-Z][a-z]{2,})*$/
    var regEmail = /^[\w\d\.\-]+@[a-z]{2,}(\.[a-z]{2,3})+$/
    var regPass = /^.{5,}$/
    var regAddress = /^[\w\s.-]+[\dA-z]+\s*[\w\s.-]+$/
    var regPhone = /^\+([\d]{10,11})+$/
    var regZip = /^([\d]{5})+$/
    var erorrs = []
    regex(regName,firstName,erorrs, "First name must start with capital letter.", $('.fname'))
    regex(regName,lastName,erorrs, "Last name must start with capital letter.", $('.lname'))
    regex(regEmail,email,erorrs, "some.paramteras@email.com", $('.email'))
    regex(regPass,pass,erorrs, "Password must contain at least 5 caracters.", $('.pass'))
    regex(regName,city,erorrs, "City name must start with capital letter, you must choose something from list.", $('.city'))
    regex(regAddress,address,erorrs, "YourAddress AddressNumber", $('.street'))
    regex(regPhone,phone,erorrs, "It must start with + and must contain 10 or 11 numbers.", $('.phone'))
    regex(regZip,zip,erorrs, "Zip is number of 5 digit, , you must choose something from list.", $('.zip'))
    if(pic && (pic["type"]=="image/jpeg" || pic["type"]=="image/png")){
        console.log(pic["type"])
    }
    else{
        erorrs.push("You must upload picture")
        $('.pic').removeClass("d-none");
        $('.pic').text("You must upload picture with extension jpg,jpeg,png.")
    }
    let idCity=$("#zipCode option:selected").attr("id")
if(erorrs.length==0){
    obj = new FormData();
    obj.append('first_n', firstName.val());
    obj.append('last_n', lastName.val());
    obj.append('email', email.val());
    obj.append('password', pass.val());
    obj.append('city_id', idCity);
    obj.append('picture', pic);
    obj.append('street', address.val());
    obj.append('phone', phone.val());
    callBackAjax("/auth", "POST", obj,  function(data) {
        window.location=data.url;
    }, false)
}
}

//function for regex
function regex(reg,input,erorrs, mess, tagMess){
    if (reg.test(input.val())){
        input.removeClass("bg-danger text-white")
        tagMess.addClass("d-none");
        input.addClass("border border-success");
    }
    else{
        input.removeClass("border border-success")
        input.addClass(" bg-danger text-white");
        tagMess.removeClass("d-none");
        tagMess.text(mess)

        return erorrs.push(mess)
    }
}
//callback funkcija ajax

function callBackAjax(url, method, data, success, forImage) {
    $.ajax({
        headers: {'X-CSRF-TOKEN': token},
        url: url,
        processData: forImage,
        contentType: false,
        method: method,
        data: data,
        dataType: "json",
        success: success,
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
