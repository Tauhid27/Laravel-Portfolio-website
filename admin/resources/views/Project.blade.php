@extends('Layout.app')
@section('content')

<div id="mainDivProject"  class="container  d-none">
<div class="row">
<div class="col-md-12 p-3">
<button id="addNewProjectBtnId" class="btn my-3 btn-sm btn-danger">Add New </button>
<table id="ProjectDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
    <th class="th-sm">Name</th>
    <th class="th-sm">Description</th>
    <th class="th-sm">Edit</th>
    <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="Project_table">

  </tbody>
</table>
</div>
</div>
</div>


<div id="loaderDivProject" class="container">
<div class="row">
<div class="col-md-12 text-center p-5">
    <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
</div>
</div>
</div>


<div id="WrongDivProject" class="container d-none">
<div class="row">
<div class="col-md-12 text-center p-5">
    <h3>Something Went Wrong !</h3>
</div>
</div>
</div>




<div class="modal fade" id="updateProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Update Project</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
      
      <h5 id="ProjectEditId" class="mt-4 d-none">  </h5>

       <div id="ProjectEditForm" class="container d-none">

        <div class="row">
          <div class="col-md-12">
          <input id="ProjectNameUpdateId" type="text" id="" class="form-control mb-3" placeholder="Project Name">
          <input id="ProjectDesUpdateId" type="text" id="" class="form-control mb-3" placeholder="Project Description">  
          <input id="ProjectLinkUpdateId" type="text" id="" class="form-control mb-3" placeholder="Project Link">
          <input id="ProjectImgUpdateId" type="text" id="" class="form-control mb-3" placeholder="Project Image">
         </div>
       </div>

          <img id="ProjectEditLoader" class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
          <h5 id="ProjectEditWrong" class="d-none">Something Went Wrong !</h5>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="ProjectUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>
</div>



<div class="modal fade" id="deleteProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body p-3 text-center">
        <h5 class="mt-4">Do You Want To Delete?</h5>
        <h5 id="ProjectDeleteId" class="mt-4 d-none">   </h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button  id="ProjectDeleteConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="addProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add New Project</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
        <div class="row">
          <div class="col-md-12">
              <input id="ProjectNameId" type="text" id="" class="form-control mb-3" placeholder="Project Name">
              <input id="ProjectDesId" type="text" id="" class="form-control mb-3" placeholder="Project Description">
              <input id="ProjectLinkId" type="text" id="" class="form-control mb-3" placeholder="Project Link">
              <input id="ProjectImgId" type="text" id="" class="form-control mb-3" placeholder="Project Image">
        </div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="ProjectAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
getProjectData();

function getProjectData() {
    axios.get('/getProjectData')
        .then(function(response) {

            if (response.status == 200) {
                $('#mainDivProject').removeClass('d-none');
                $('#loaderDivProject').addClass('d-none');

                $('#ProjectDataTable').DataTable().destroy();
                $('#Project_table').empty();

                var jsonData = response.data;
                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
                        "<td>" + jsonData[i].project_name + "</td>" +
                        "<td>" + jsonData[i].project_desc + "</td>" +

                        "<td><a class='ProjectEditBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-edit'></i></a></td>" +
                        "<td><a class='ServiceDeleteBtn'  data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a></td>"

                    ).appendTo('#Project_table');
                });


                //Project Table Edit Icon Click
                $('.ProjectEditBtn').click(function() {
                    var id = $(this).data('id');
                    $('#ProjectEditId').html(id);
                    ProjectUpdateDetails(id);
                    $('#updateProjectModal').modal('show');
                })

                //Project Table Delete Icon Click
                $('.ServiceDeleteBtn').click(function() {
                    var id = $(this).data('id');
                    $('#ProjectDeleteId').html(id);
                    ProjectUpdateDetails(id);
                    $('#deleteProjectModal').modal('show');
                })

                //pagination search set
                $('#ProjectDataTable').DataTable({
                    "order": false
                });
                $('.dataTables_length').addClass('bs-select');

            } else {
                $('#loaderDivProject').addClass('d-none');
                $('#WrongDivProject').removeClass('d-none');
            }
        }).catch(function(error) {
            $('#loaderDivProject').addClass('d-none');
            $('#WrongDivProject').removeClass('d-none');
        });
}

//Each Project Update Details
function ProjectUpdateDetails(DetailsId) {
    axios.post('/ProjectDetails', {
            id: DetailsId

        })
        .then(function(response) {
            if (response.status == 200) {
                $('#ProjectEditForm').removeClass('d-none');
                $('#ProjectEditLoader').addClass('d-none');

                var jsonData = response.data;
                $('#ProjectNameUpdateId').val(jsonData[0].project_name);
                $('#ProjectDesUpdateId').val(jsonData[0].project_desc);
                $('#ProjectLinkUpdateId').val(jsonData[0].project_link);
                $('#ProjectImgUpdateId').val(jsonData[0].project_img);

            } else {
                $('#ProjectEditLoader').addClass('d-none');
                $('#ProjectEditWrong').removeClass('d-none');
            }

        }).catch(function(error) {
            $('#ProjectEditLoader').addClass('d-none');
            $('#ProjectEditWrong').removeClass('d-none');
        });
}

//Project Edit  Modal Save Btn
$('#ProjectUpdateConfirmBtn').click(function() {

    var projectId = $('#ProjectEditId').html();
    var ProjectName = $('#ProjectNameUpdateId').val();
    var ProjectDes = $('#ProjectDesUpdateId').val();
    var ProjectLink = $('#ProjectLinkUpdateId').val();
    var ProjectImg = $('#ProjectImgUpdateId').val();

    ProjectUpdate(projectId, ProjectName, ProjectDes, ProjectLink, ProjectImg);

})

//project update confirm
function ProjectUpdate(projectId, ProjectName, ProjectDes, ProjectLink, ProjectImg) {
    if (ProjectName.length == 0) {
        toastr.error('Project Name is Empty !');
    } else if (ProjectDes.length == 0) {
        toastr.error('Project Description is Empty !');
    } else if (ProjectLink.length == 0) {
        toastr.error('Project Link is Empty !');
    } else if (ProjectImg.length == 0) {
        toastr.error('Project Image is Empty !');
    } else {
        $('#ProjectUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>"); //animation add.......
        axios.post('/ProjectUpdate', {
                id: projectId,
                project_name: ProjectName,
                project_desc: ProjectDes,
                project_link: ProjectLink,
                project_img: ProjectImg,

            })
            .then(function(response) {
                $('#ProjectUpdateConfirmBtn').html("Save");
                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#updateProjectModal').modal('hide');
                        toastr.success('Update Success.');
                        getProjectData();
                    } else {
                        $('#updateProjectModal').modal('hide');
                        toastr.error('Update  Faill !');
                        getProjectData();
                    }

                } else {
                    $('#updateProjectModal').modal('hide');
                    toastr.error('Something went Wrong !');
                }
            }).catch(function(error) {
                $('#updateProjectModal').modal('hide');
                toastr.error('Something went Wrong !');
            });
    }


}

// Project Delete Confirm 
$('#ProjectDeleteConfirmBtn').click(function() {
    var id = $('#ProjectDeleteId').html();
    ProjectDelete(id);
})
// Project Delete
function ProjectDelete(deleteID) {
    $('#ProjectDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>") //Animation....
    axios.post('/ProjectDelete', {
            id: deleteID
        })
        .then(function(response) {
            $('#ProjectDeleteConfirmBtn').html("Yes");
            if (response.status == 200) {
                if (response.data == 1) {
                    $('#deleteProjectModal').modal('hide');
                    toastr.success('Delete Success');
                    getProjectData();
                } else {
                    $('#deleteProjectModal').modal('hide');
                    toastr.error('Delete Fail');
                    getProjectData();
                }
            } else {
                $('#ProjectDeleteConfirmBtn').html("Yes");
                $('#deleteProjectModal').modal('hide');
                toastr.error('Something Went Wrong !');
            }
        })
        .catch(function(error) {
            $('#ProjectDeleteConfirmBtn').html("Yes");
            $('#deleteProjectModal').modal('hide');
            toastr.error('Something Went Wrong !');
        });
}

//Project Add new Btn Click
$('#addNewProjectBtnId').click(function() {
    $('#addProjectModal').modal('show');
})

//Project Add  Modal Save Btn
$('#ProjectAddConfirmBtn').click(function() {
    var ProjectName = $('#ProjectNameId').val();
    var ProjectDes = $('#ProjectDesId').val();
    var ProjectLink = $('#ProjectLinkId').val();
    var ProjectImg = $('#ProjectImgId').val();
    ProjectAdd(ProjectName, ProjectDes, ProjectLink, ProjectImg);
})


//project Add method
function ProjectAdd(ProjectName, ProjectDes, ProjectLink, ProjectImg) {

    if (ProjectName.length == 0) {
        toastr.error('Project Name is Empty !');
    } else if (ProjectDes.length == 0) {
        toastr.error('Project Description is Empty !');
    } else if (ProjectLink.length == 0) {
        toastr.error('Project Link is Empty !');
    } else if (ProjectImg.length == 0) {
        toastr.error('Project Image is Empty !');
    } else {
        $('#ProjectAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>") //Animation....
        axios.post('/ProjectAdd', {
                project_name: ProjectName,
                project_desc: ProjectDes,
                project_link: ProjectLink,
                project_img: ProjectImg,
            })
            .then(function(response) {
                $('#ProjectAddConfirmBtn').html("Save");
                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#addProjectModal').modal('hide');
                        toastr.success('Add Success');
                        getProjectData();
                    } else {
                        $('#addProjectModal').modal('hide');
                        toastr.error('Add Fail');
                        getProjectData();
                    }
                } else {
                    $('#addProjectModal').modal('hide');
                    toastr.error('Something Went Wrong !');
                }
            })
            .catch(function(error) {
                $('#addProjectModal').modal('hide');
                toastr.error('Something Went Wrong !');
            });
    }
}
</script>
@endsection