@extends('Layout.app')
@section('content')

<div id="MainDiv" class="container d-none">
	<div class="row">
		<div class="col-md-12 p-5">

		<button id="addNewBtnId" class="btn my-3 btn-sm btn-danger">Add New </button>

			<table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th class="th-sm">Image</th>
						<th class="th-sm">Name</th>
						<th class="th-sm">Description</th>
						<th class="th-sm">Edit</th>
						<th class="th-sm">Delete</th>
					</tr>
				</thead>
				<tbody id="service_table">

				</tbody>
			</table>
		</div>
	</div>
</div>

<div id="loaderDiv" class="container">
	<div class="row">
		<div class="col-md-12 p-5 text-center">
			<img class="loading-icon m-5" src="{{asset('images/loader.svg')}}" alt="">
		</div>
	</div>
</div>

<div id="WrongDiv" class="container d-none">
	<div class="row">
		<div class="col-md-12 p-5 text-center">
			<h3>Somewhing Went Wrong !</h3>
		</div>
	</div>
</div>







<!-- Modal -->
<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-body text-center p-3">
				<h5 class="mt-4">Do you want to delete?</h5>
				<h5 id="ServiceDeleteId" class="mt-4"></h5>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
				<button id="ServiceDeleteConfirmBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
			</div>
		</div>
	</div>
</div>


<!-- update Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-body text-center p-5">
				<h5 id="ServiceEditId" class="mt-4"></h5>
				<div id="ServiceEditForm" class="d-none w-100">
				<input type="text" id="ServiceNameId" class="form-control mb-4" placeholder="Service Name">
				<input type="text" id="ServiceDesId" class="form-control mb-4" placeholder="Service Description">
				<input type="text" id="ServiceImgId" class="form-control mb-4" placeholder="Service Image Link">
				</div>
                <img id="ServiceEditLoader" class="loading-icon m-5" src="{{asset('images/loader.svg')}}" alt="">
                 <h5 id="ServiceEditWrong" class="d-none">Somewhing Went Wrong !</h5>
				
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
				<button id="ServiceeditConfirmBtn" type="button" class="btn btn-sm btn-danger">Save</button>
			</div>
		</div>
	</div>
</div>

<!-- Add Service  Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-body text-center p-5">
				<h6 class="mb-4">Add New Services</h6>
				<div id="ServiceaddForm" class=" w-100">
				<input type="text" id="ServiceNameAddId" class="form-control mb-4" placeholder="Service Name">
				<input type="text" id="ServiceDesAddId" class="form-control mb-4" placeholder="Service Description">
				<input type="text" id="ServiceImgAddId" class="form-control mb-4" placeholder="Service Image Link">
				</div>
               
                 
				
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
				<button id="ServiceaddConfirmBtn" type="button" class="btn btn-sm btn-danger">save</button>
			</div>
		</div>
	</div>
</div>

@endsection


@section('script')
<script type="text/javascript">
getServicesData();


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
                        "<td><a class='ServiceEditBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-edit'></i></a></td>" +
                        "<td><a class='ServiceDeleteBtn'  data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a></td>"

                    ).appendTo('#service_table');
                });

                //Servies Table Delete from Icon
                $('.ServiceDeleteBtn').click(function() {
                    var id = $(this).data('id');

                    $('#ServiceDeleteId').html(id);
                    $('#basicExampleModal').modal('show');
                })



                //Service Table Edit Icon Click
                $('.ServiceEditBtn').click(function() {
                    var id = $(this).data('id');

                    $('#ServiceEditId').html(id);
                    ServiceUpdatDetails(id);
                    $('#editModal').modal('show');
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


//Services Delete Modal Yes Btn
$('#ServiceDeleteConfirmBtn').click(function() {
    var id = $('#ServiceDeleteId').html();
    ServiceDelete(id);

})



//Service Delete
function ServiceDelete(DeleteId) {

    $('#ServiceDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")

    axios.post('/servicedelete', {
            id: DeleteId
        })
        .then(function(response) {
            $('#ServiceDeleteConfirmBtn').html('Yes')
            if (response.status == 200) {
                if (response.data == 1) {
                    $('#basicExampleModal').modal('hide');
                    toastr.success('Delete Success.');
                    getServicesData();
                } else {
                    $('#basicExampleModal').modal('hide');
                    toastr.error('Delete  Faill.');
                    getServicesData();
                }
            } else {
                $('#basicExampleModal').modal('hide');
                toastr.error('Something went Wrong !');
            }

        }).catch(function(error) {
            $('#basicExampleModal').modal('hide');
            toastr.error('Something went Wrong !');
        });
}

//Each Services Update Details
function ServiceUpdatDetails(DetailsId) {
    axios.post('/servicedetails', {
            id: DetailsId

        })
        .then(function(response) {
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

        }).catch(function(error) {
            $('#ServiceEditLoader').addClass('d-none');
            $('#ServiceEditWrong').removeClass('d-none');
        });
}


//Services  Modal Save Btn
$('#ServiceeditConfirmBtn').click(function() {

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
        $('#ServiceeditConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
        axios.post('/serviceupdate', {
                id: serviceId,
                name: serviceName,
                des: serviceDes,
                img: serviceImg,

            })
            .then(function(response) {
                $('#ServiceeditConfirmBtn').html("Save");
                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#editModal').modal('hide');
                        toastr.success('Update Success.');
                        getServicesData();
                    } else {
                        $('#editModal').modal('hide');
                        toastr.error('Update  Faill !');
                        getServicesData();
                    }

                } else {
                    $('#editModal').modal('hide');
                    toastr.error('Something went Wrong !');
                }
            }).catch(function(error) {
                $('#editModal').modal('hide');
                toastr.error('Something went Wrong !');
            });
    }


}

//Service Add new Btn Click
$('#addNewBtnId').click(function() {
    $('#addModal').modal('show');
})

//Services Add  Modal Save Btn
$('#ServiceaddConfirmBtn').click(function() {


    var name = $('#ServiceNameAddId').val();
    var des = $('#ServiceDesAddId').val();
    var img = $('#ServiceImgAddId').val();

    ServiceAdd(name, des, img);

})



//Service Add method
function ServiceAdd(serviceName, serviceDes, serviceImg) {
    if (serviceName.length == 0) {
        toastr.error('Service Name is Empty !');
    } else if (serviceDes.length == 0) {
        toastr.error('Service Description is Empty !');
    } else if (serviceImg.length == 0) {
        toastr.error('Service Image is Empty !');
    } else {
        $('#ServiceaddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
        axios.post('/serviceadd', {

                name: serviceName,
                des: serviceDes,
                img: serviceImg,

            })
            .then(function(response) {
                $('#ServiceaddConfirmBtn').html("Save");
                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#addModal').modal('hide');
                        toastr.success('Add Success.');
                        getServicesData();
                    } else {
                        $('#addModal').modal('hide');
                        toastr.error('Add  Faill !');
                        getServicesData();
                    }

                } else {
                    $('#addModal').modal('hide');
                    toastr.error('Something went Wrong !');
                }
            }).catch(function(error) {
                $('#addModal').modal('hide');
                toastr.error('Something went Wrong !');
            });
    }


}
</script>
@endsection