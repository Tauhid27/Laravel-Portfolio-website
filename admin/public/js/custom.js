//Visitor Page Table
$(document).ready(function () {
    $('#VisitorDt').DataTable();
    $('.dataTables_length').addClass('bs-select');
});

//for Servicess Table

function getServicesData() {
    axios.get('/serviceget')
        .then(function (response) {

            if (response.status == 200) {
                $('#MainDiv').removeClass('d-none');
                $('#loaderDiv').addClass('d-none');

                $('#service_table').empty();


                var jsonData = response.data;
                $.each(jsonData, function (i, item) {
                    $('<tr>').html(
                        "<td><img class='table-img' src=" + jsonData[i].service_img + "></td>" +
                        "<td>" + jsonData[i].service_name + "</td>" +
                        "<td>" + jsonData[i].service_des + "</td>" +
                        "<td><a class='ServiceEditBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-edit'></i></a></td>" +
                        "<td><a class='ServiceDeleteBtn'  data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a></td>"

                    ).appendTo('#service_table');
                });

                //Servies Table Delete from Icon
                $('.ServiceDeleteBtn').click(function () {
                    var id = $(this).data('id');

                    $('#ServiceDeleteId').html(id);
                    $('#basicExampleModal').modal('show');
                })

            

                //Service Table Edit Icon Click
                $('.ServiceEditBtn').click(function () {
                    var id = $(this).data('id');

                    $('#ServiceEditId').html(id);
                    ServiceUpdatDetails(id);
                    $('#editModal').modal('show');
                })

              


            } else {
                $('#loaderDiv').addClass('d-none');
                $('#WrongDiv').removeClass('d-none');
            }




        }).catch(function (error) {
            $('#loaderDiv').addClass('d-none');
            $('#WrongDiv').removeClass('d-none');
        });
}


    //Services Delete Modal Yes Btn
    $('#ServiceDeleteConfirmBtn').click(function () {
        var id = $('#ServiceDeleteId').html();
        ServiceDelete(id);

    })



//Service Delete
function ServiceDelete(DeleteId) {

    $('#ServiceDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")

    axios.post('/servicedelete', {
        id: DeleteId
    })
        .then(function (response) {
            $('#ServiceDeleteConfirmBtn').html('Yes')
           if(response.status==200){
            if (response.data == 1) {
                $('#basicExampleModal').modal('hide');
                toastr.success('Delete Success.');
                getServicesData();
            } else {
                $('#basicExampleModal').modal('hide');
                toastr.error('Delete  Faill.');
                getServicesData();
            }
           }else{
            $('#basicExampleModal').modal('hide');
            toastr.error('Something went Wrong !'); 
           }

        }).catch(function (error) {
            $('#basicExampleModal').modal('hide');
            toastr.error('Something went Wrong !');
        });
}

//Each Services Update Details
function ServiceUpdatDetails(DetailsId) {
    axios.post('/servicedetails', {
        id: DetailsId

    })
        .then(function (response) {
            if (response.status == 200) {
                $('#ServiceEditForm').removeClass('d-none');
                $('#ServiceEditLoader').addClass('d-none');

                var jsonData = response.data;
                $('#ServiceNameId').val(jsonData[0].service_name);
                $('#ServiceDesId').val(jsonData[0].service_des);
                $('#ServiceImgId').val(jsonData[0].service_img);

            } else {
                $('#ServiceEditLoader').addClass('d-none');
                $('#ServiceEditWrong').removeClass('d-none');
            }

        }).catch(function (error) {
            $('#ServiceEditLoader').addClass('d-none');
            $('#ServiceEditWrong').removeClass('d-none');
        });
}


  //Services  Modal Save Btn
  $('#ServiceeditConfirmBtn').click(function () {

    var id = $('#ServiceEditId').html();
    var name = $('#ServiceNameId').val();
    var des = $('#ServiceDesId').val();
    var img = $('#ServiceImgId').val();

    ServiceUpdate(id, name, des, img);

})


function ServiceUpdate(serviceId, serviceName, serviceDes, serviceImg) {
    if (serviceName.length == 0) {
        toastr.error('Service Name is Empty !');
    } else if (serviceDes.length == 0) {
        toastr.error('Service Description is Empty !');
    } else if (serviceImg.length == 0) {
        toastr.error('Service Image is Empty !');
    } else {
        $('#ServiceeditConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
        axios.post('/serviceupdate', {
            id: serviceId,
            name: serviceName,
            des: serviceDes,
            img: serviceImg,

        })
            .then(function (response) {
                $('#ServiceeditConfirmBtn').html("Save")
              if(response.status==200){
                if (response.data == 1) {
                    $('#editModal').modal('hide');
                    toastr.success('Update Success.');
                    getServicesData();
                } else {
                    $('#editModal').modal('hide');
                    toastr.error('Update  Faill !');
                    getServicesData();
                }

              }else{
                $('#editModal').modal('hide');
                toastr.error('Something went Wrong !'); 
              }
            }).catch(function (error) {
                $('#editModal').modal('hide');
                toastr.error('Something went Wrong !'); 
            });
    }


}