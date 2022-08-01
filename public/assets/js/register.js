$(document).ready(function (){
    $('#date').change(filterRegister)
    $('#role').change(filterRegister)
    $('#log').change(filterRegister)
    $('#remove').click(remove)



})
function remove(e){
    e.preventDefault()

    $('#role').val(0)
    $('#log').val(0)
    $('#date').val(null)
    filterRegister()

}
function filterRegister(){
let date=$('#date').val()
    let role=$('#role').val()
    let log=$('#log').val()


    // console.log(date)
    $.ajax({
        url: "/listLogInOutFilter",
        method: "GET",
        data: {date:date,role:role,log:log},
        dataType: "json",
        success: function(data){
            console.log(data)
            table(data)
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

function table(data){
    let html=``

    if(data=="No results." || data==null){
        html="No results."
    }
    else{
    for(d of data){
        html+=`
                                <tr>
                                    <td></td>
                                    <td class="col-xs-3 col-sm-1"><img class="img img-thumbnail " src="assets/images/users/${d[0]}"></td>
                                    <td>${d[2]}</td>
                                    <td>${d[3]}</td>
                                    <td>${d[1]}</td>`
                                    if(d[4]=="Logged in"){
            html+=` <td class="table-success">${d[4]}</td>
                                        <td></td>`
        }


else{
html+=` <td></td>
                                        <td class="table-danger">${d[4]}</td>`
}
    html+=`
         <td>${d[5]}</td>

                                </tr>
    `
    }
    }
$('#tableHtml').html(html)
    }
