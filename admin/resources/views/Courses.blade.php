@extends('Layout.app')
@section('content')

<div id="MainDivCourse" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">
<table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>

	  <th class="th-sm">Name</th>
      <th class="th-sm">Fee</th>
      <th class="th-sm">Class</th>
      <th class="th-sm">Enroll</th>
      <th class="th-sm">Details</th>
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



@endsection



@section('script')
<script type="text/javascript">
getCourcesData();

</script>
@endsection