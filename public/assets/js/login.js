$(document).ready(function (){
    $("#login").click(login)

})
const token = $('meta[name="csrf-token"]').attr('content');

function login(e){
    e.preventDefault();
    let email = $('#email');
    let pass = $('#password');
    let regEmail = /^[\w\d\.\-]+@[a-z]{2,}(\.[a-z]{2,3})+$/
    let regPass = /^.{5,}$/
    let erorrs=[]
    if (regEmail.test(email.val())){
        email.removeClass("bg-danger text-white")
        $('.email').addClass("d-none");
        email.addClass("border border-success");
    }
    else{
        email.removeClass("border border-success")
        email.addClass(" bg-danger text-white");
        $('.email').removeClass("d-none").text("some.paramteras@email.com");

        erorrs.push("some.paramteras@email.com")
    }

    if (regPass.test(pass.val())){
        pass.removeClass("bg-danger text-white")
        $('.pass').addClass("d-none");
        pass.addClass("border border-success");
    }
    else{
        pass.removeClass("border border-success")
        pass.addClass(" bg-danger text-white");
        $('.pass').removeClass("d-none").text("Password must contain at least 5 caracters.");

         erorrs.push("Password must contain at least 5 caracters.")
    }
    if(erorrs.length==0){
        $.ajax({
            headers: {'X-CSRF-TOKEN': token},
            url: "/login",
            method: "post",
            data: {"email":email.val(), "password":pass.val()},
            dataType: "json",
            success: function (data){
              if(data.status==false){
                  alert(data.mess)
              }
              else{
                  window.location=data.url;
              }
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
}}
