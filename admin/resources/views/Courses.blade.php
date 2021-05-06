@extends('Layout.app')
@section('title','Course')
@section('content')

<div id="MainDivCourse" class="container d-none">
    <div class="row">
        <div class="col-md-12 p-5">

            <button id="addNewCourseBtnId" class="btn my-3 btn-sm btn-danger">Add New </button>

            <table id="courseDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm">Name</th>
                        <th class="th-sm">Fee</th>
                        <th class="th-sm">Class</th>
                        <th class="th-sm">Enroll</th>
                       
                        <th class="th-sm">Edit</th>
                        <th class="th-sm">Delete</th>
                    </tr>
                </thead>
                <tbody id="course_table">
                </tbody>
            </table>

        </div>
    </div>
</div>


<div id="loaderDivCourse" class="container">
    <div class="row">
        <div class="col-md-12 p-5 text-center">
            <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}" alt="">
        </div>
    </div>
</div>


<div id="WrongDivCourse" class="container d-none">
    <div class="row">
        <div class="col-md-12 p-5 text-center">
            <h3>Somewhing Went Wrong !</h3>
        </div>
    </div>
</div>



<!-- add new course  -->
<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body  text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <input id="CourseNameId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
                            <input id="CourseDesId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
                            <input id="CourseFeeId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
                            <input id="CourseEnrollId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
                        </div>
                        <div class="col-md-6">
                            <input id="CourseClassId" type="text" id="" class="form-control mb-3" placeholder="Total Class">
                            <input id="CourseLinkId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
                            <input id="CourseImgId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                <button id="CourseAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- delete Modal -->
<div class="modal fade" id="deleteCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-body text-center p-3">
				<h5 class="mt-4">Do you want to delete?</h5>
				<h5 id="CourseDeleteId" class="mt-4 d-none"></h5>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
				<button id="CourseDeleteConfirmBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
			</div>
		</div>
	</div>
</div>

<!-- update course  -->
<div class="modal fade" id="updateCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body  text-center">
            <h5 id="CourseEditId" class="mt-4 d-none"></h5>
                <div id="CourseEditForm" class="container d-none">
                    <div class="row">
                        <div class="col-md-6">
                            <input id="CourseNameupdateId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
                            <input id="CourseDesupdateId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
                            <input id="CourseFeeupdateId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
                            <input id="CourseEnrollupdateId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
                        </div>
                        <div class="col-md-6">
                            <input id="CourseClassupdateId" type="text" id="" class="form-control mb-3" placeholder="Total Class">
                            <input id="CourseLinkupdateId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
                            <input id="CourseImgupdateId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
                        </div>
                    </div>
                </div>
                <img id="CourseEditLoader" class="loading-icon m-5" src="{{asset('images/loader.svg')}}" alt="">
                 <h5 id="CourseEditWrong" class="d-none">Somewhing Went Wrong !</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                <button id="CourseEditConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
            </div>
        </div>
    </div>
</div>

@endsection



@section('script')
<script type="text/javascript">
    getCourcesData();

//for Servicess Table
function getCourcesData() {
    axios.get('/Coursesget')
        .then(function (response) {
            if (response.status == 200) {
                $('#MainDivCourse').removeClass('d-none');
                $('#loaderDivCourse').addClass('d-none');
                
                $('#courseDataTable').DataTable().destroy();
                $('#course_table').empty();
              

                var jsonData = response.data;
                $.each(jsonData, function (i, item) {
                    $('<tr>').html(

                        "<td>" + jsonData[i].course_name + "</td>" +
                        "<td>" + jsonData[i].course_fee + "</td>" +
                        "<td>" + jsonData[i].course_totalclass + "</td>" +
                        "<td>" + jsonData[i].course_totalenroll + "</td>" +
                     
                        "<td><a class='courseEditBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-edit'></i></a></td>" +
                        "<td><a class='courseDeleteBtn'  data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a></td>"

                    ).appendTo('#course_table');
                });
                //Course Table Delete from Icon
                $('.courseDeleteBtn').click(function () {
                    var id = $(this).data('id');
                    $('#CourseDeleteId').html(id);
                    $('#deleteCourseModal').modal('show');
                })

                
                //Course Table Edit Icon Click
                $('.courseEditBtn').click(function() {
                 
                    var id = $(this).data('id');
                    courseUpdatDetails(id);
                    $('#CourseEditId').html(id);
                    $('#updateCourseModal').modal('show');
                })
               
                   //pagination search set
                   $('#courseDataTable').DataTable({"order":false});
                   $('.dataTables_length').addClass('bs-select');


            } else {
                $('#loaderDivCourse').addClass('d-none');
                $('#WrongDivCourse').removeClass('d-none');
            }
        }).catch(function (error) {
            $('#loaderDivCourse').addClass('d-none');
            $('#WrongDivCourse').removeClass('d-none');
        });
}



//Course Add new Btn Click
$('#addNewCourseBtnId').click(function () {
    $('#addCourseModal').modal('show');
});

//Course Add  Modal Save Btn
$('#CourseAddConfirmBtn').click(function () {
    var CourseName = $('#CourseNameId').val();
    var CourseDes = $('#CourseDesId').val();
    var CourseFee = $('#CourseFeeId').val();
    var CourseEnroll = $('#CourseEnrollId').val();
    var CourseClass = $('#CourseClassId').val();
    var CourseLink = $('#CourseLinkId').val();
    var CourseImg = $('#CourseImgId').val();
    CourseAdd(CourseName, CourseDes, CourseFee, CourseEnroll, CourseClass, CourseLink, CourseImg);
})
//Course Add method
function CourseAdd(CourseName, CourseDes, CourseFee, CourseEnroll, CourseClass, CourseLink, CourseImg) {
    if (CourseName.length == 0) {
        toastr.error('Course Name is Empty !');
    }
    else if (CourseDes.length == 0) {
        toastr.error('Course Description is Empty !');
    }
    else if (CourseDes.length == 0) {
        toastr.error('Course Description is Empty !');
    } else if (CourseFee.length == 0) {
        toastr.error('Course Fee is Empty !');
    }
    else if (CourseEnroll.length == 0) {
        toastr.error('Course Enroll is Empty !');
    }
    else if (CourseClass.length == 0) {
        toastr.error('Course Class is Empty !');
    }
    else if (CourseLink.length == 0) {
        toastr.error('Course Link is Empty !');
    }

    else if (CourseImg.length == 0) {
        toastr.error('Course Image is Empty !');
    } else {
        $('#CourseAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
        axios.post('/Coursesadd', {

            course_name: CourseName,
            course_des: CourseDes,
            course_fee: CourseFee,
            course_totalenroll: CourseEnroll,
            course_totalclass: CourseClass,
            course_link: CourseLink,
            course_img: CourseImg,

        })
            .then(function (response) {
                $('#CourseAddConfirmBtn').html("Save");
                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#addCourseModal').modal('hide');
                        toastr.success('Add Success.');
                        getCourcesData();
                    } else {
                        $('#addCourseModal').modal('hide');
                        toastr.error('Add  Faill !');
                        getCourcesData();
                    }
                } else {
                    $('#addCourseModal').modal('hide');
                    toastr.error('Something went Wrong !');
                }
            }).catch(function (error) {
                $('#addCourseModal').modal('hide');
                toastr.error('Something went Wrong !');
            });
    }
}



//Course Delete Modal Yes Btn
$('#CourseDeleteConfirmBtn').click(function() {
    var id = $('#CourseDeleteId').html();
    CourseDelete(id);

})

//Course Delete
function CourseDelete(DeleteId) {

    $('#CourseDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")

    axios.post('/Coursesdelete', {
            id: DeleteId
        })
        .then(function(response) {
            $('#CourseDeleteConfirmBtn').html('Yes')
            if (response.status == 200) {
                if (response.data == 1) {
                    $('#deleteCourseModal').modal('hide');
                    toastr.success('Delete Success.');
                    getCourcesData();
                } else {
                    $('#deleteCourseModal').modal('hide');
                    toastr.error('Delete  Faill.');
                    getCourcesData();
                }
            } else {
                $('#deleteCourseModal').modal('hide');
                toastr.error('Something went Wrong !');
            }

        }).catch(function(error) {
            $('#deleteCourseModal').modal('hide');
            toastr.error('Something went Wrong !');
        });
}

//Each Course Update Details
function courseUpdatDetails(DetailsId) {
    axios.post('/Coursesdetails', {
            id: DetailsId

        })
        .then(function(response) {
            if (response.status == 200) {
                $('#CourseEditForm').removeClass('d-none');
                $('#CourseEditLoader').addClass('d-none');

                var jsonData = response.data;
                $('#CourseNameupdateId').val(jsonData[0].course_name);
                $('#CourseDesupdateId').val(jsonData[0].course_des);
                $('#CourseFeeupdateId').val(jsonData[0].course_fee);
                $('#CourseEnrollupdateId').val(jsonData[0].course_totalenroll);
                $('#CourseClassupdateId').val(jsonData[0].course_totalclass);
                $('#CourseLinkupdateId').val(jsonData[0].course_link);
                $('#CourseImgupdateId').val(jsonData[0].course_img);

            } else {
                $('#CourseEditLoader').addClass('d-none');
                $('#CourseEditWrong').removeClass('d-none');
            }

        }).catch(function(error) {
            $('#CourseEditLoader').addClass('d-none');
            $('#CourseEditWrong').removeClass('d-none');
        });
}

//Course Edit  Modal Save Btn
$('#CourseEditConfirmBtn').click(function() {

    var id = $('#CourseEditId').html();
    var CourseName = $('#CourseNameupdateId').val();
    var CourseDes = $('#CourseDesupdateId').val();
    var CourseFee = $('#CourseFeeupdateId').val();
    var CourseEnroll = $('#CourseEnrollupdateId').val();
    var CourseClass = $('#CourseClassupdateId').val();
    var CourseLink = $('#CourseLinkupdateId').val();
    var CourseImg = $('#CourseImgupdateId').val();
    CourseUpdate(id,CourseName, CourseDes, CourseFee, CourseEnroll, CourseClass, CourseLink, CourseImg);


})


function CourseUpdate(CourseId,CourseName, CourseDes, CourseFee, CourseEnroll, CourseClass, CourseLink, CourseImg) {
    if (CourseName.length == 0) {
        toastr.error('Course Name is Empty !');
    }
    else if (CourseDes.length == 0) {
        toastr.error('Course Description is Empty !');
    }
    else if (CourseDes.length == 0) {
        toastr.error('Course Description is Empty !');
    } else if (CourseFee.length == 0) {
        toastr.error('Course Fee is Empty !');
    }
    else if (CourseEnroll.length == 0) {
        toastr.error('Course Enroll is Empty !');
    }
    else if (CourseClass.length == 0) {
        toastr.error('Course Class is Empty !');
    }
    else if (CourseLink.length == 0) {
        toastr.error('Course Link is Empty !');
    }

    else if (CourseImg.length == 0) {
        toastr.error('Course Image is Empty !');
    }  else {
        $('#CourseEditConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
        axios.post('/Coursesupdate', {
                id: CourseId,
                course_name: CourseName,
                course_des: CourseDes,
                course_fee: CourseFee,
                course_totalenroll: CourseEnroll,
                course_totalclass: CourseClass,
                course_link: CourseLink,
                course_img: CourseImg,
            })
            .then(function(response) {
                $('#CourseEditConfirmBtn').html("Save");
                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#updateCourseModal').modal('hide');
                        toastr.success('Update Success.');
                        getCourcesData();
                    } else {
                        $('#updateCourseModal').modal('hide');
                        toastr.error('Update  Faill !');
                        getCourcesData();
                    }

                } else {
                    $('#updateCourseModal').modal('hide');
                    toastr.error('Something went Wrong !');
                }
            }).catch(function(error) {
                $('#updateCourseModal').modal('hide');
                toastr.error('Something went Wrong !');
            });
    }


}



</script>
@endsection