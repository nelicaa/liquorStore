$(document).ready(function (){
    $('.update').change(updateRole)
    $('#date').change(filter)



})
const token = $('meta[name="csrf-token"]').attr('content');

function filter(){
    let date=this.value
    $.ajax({
        url: "/registerDateFilter/"+date,
        method: "GET",
        data: {date:date},
        dataType: "json",
        success: function(data){
            html(data)

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


function html(data){
    let html=""
    let date;
    for(let d of data.users){
        date=new Date(d.created_at)
        html+=`<tr> <td>${d.id}</td>
     <td class="col-xs-3 col-sm-1">
     <img class="img img-thumbnail " src="assets/images/users/${d.picture}"></td>
                                        <td>${d.first_n}</td>
                                        <td>${d.last_n}</td>
                                        <td>${d.street}</td>
                                        <td>
                                           ${d.phone}
                                        </td>
                                        <td>
                                         ${d.email}
                                        </td>

                                        <td>
                                           ${d.city.name}
                                        </td>
                                        <td>
                                            ${d.city.zipCode}
                                        </td>

                                        <td>
                                            <form>

                                                <select data-id="${d.id}" class="form-control-lg update" name="role" aria-label="Default select example">`
        for(r of data.roles){
            if(r.id==d.role.id){
                html+=`<option value="${r.id}" selected>${r.name}</option>`
            }
            else{
                html+=`<option value="${r.id}">${r.name}</option>`
            }

        }
        html+=`
                                            </select>
                                            </form>

                                        </td>

                                        <td>

                                        </td>
                                    </tr>
                                <tr class="border border-3">
                                    <th colspan="3">Registred at: </th>
                                    <th colspan="8" class="text-start">${date}</th>
                                </tr>`
    }
    $("#tableHtml").html(html)
    $('.update').change(updateRole)

}


function updateRole(){
    let idP=this.dataset.id
    let id=this.value
    let url="/user/"+id
$.ajax({
    headers: {'X-CSRF-TOKEN': token},
    url: url,
    method: "patch",
    data: {"idP":idP},
    dataType: "json",
    success: function(data){
        alert(data)
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
