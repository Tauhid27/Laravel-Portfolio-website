@extends('Layout.app')
@section('content')

<div id="MainDiv" class="container d-none">
	<div class="row">
		<div class="col-md-12 p-5">
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

@endsection


@section('script')
<script type="text/javascript">
	getServicesData();
</script>
@endsection