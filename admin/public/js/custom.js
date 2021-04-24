//Visitor Page Table
$(document).ready(function() {
  $('#VisitorDt').DataTable();
  $('.dataTables_length').addClass('bs-select');
});

//for Servicess Table

function getServicesData() {
  axios.get('/serviceget')
      .then(function(response) {

          if (response.status == 200) {
              $('#MainDiv').removeClass('d-none');
              $('#loaderDiv').addClass('d-none');

              $('#service_table').empty();


              var jsonData = response.data;
              $.each(jsonData, function(i, item) {
                  $('<tr>').html(
                      "<td><img class='table-img' src=" + jsonData[i].service_img + "></td>" +
                      "<td>" + jsonData[i].service_name + "</td>" +
                      "<td>" + jsonData[i].service_des + "</td>" +
                      "<td><a href='' ><i class='fas fa-edit'></i></a></td>" +
                      "<td><a class='ServiceDeleteBtn'  data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a></td>"

                  ).appendTo('#service_table');
              });

              //Servies Table Delete from Icon
              $('.ServiceDeleteBtn').click(function() {
                  var id = $(this).data('id');

                  $('#ServiceDeleteId').html(id);
                  $('#basicExampleModal').modal('show');
              })

              //Services Delete Modal Yes Btn
              $('#ServiceDeleteConfirmBtn').click(function() {
                  var id = $('#ServiceDeleteId').html();
                  ServiceDelete(id);

              })


          } else {
              $('#loaderDiv').addClass('d-none');
              $('#WrongDiv').removeClass('d-none');
          }




      }).catch(function(error) {
          $('#loaderDiv').addClass('d-none');
          $('#WrongDiv').removeClass('d-none');
      });
}

//Service Delete
function ServiceDelete(DeleteId) {
  axios.post('/servicedelete', {
          id: DeleteId
      })
      .then(function(response) {
          if (response.data == 1) {
              $('#basicExampleModal').modal('hide');
              toastr.success('Delete Success.');
              getServicesData();
          } else {
              $('#basicExampleModal').modal('hide');
              toastr.error('Delete  Faill.');
              getServicesData();
          }

      }).catch(function(error) {

      });
}