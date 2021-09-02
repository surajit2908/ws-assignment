@extends('layouts.admin-dashboard')
@section('content')
<div class="admin-body-area">
<!-- Booking Status Section Start -->
<div class="booking-status-sec category-list-sec">
	<div class="category-list-hdn">
		<h2>Gallery Management</h2>
		<h3 class="create-cat">
			<a href="{{route('admin.gallery.add')}}">Add new Gallery Image</a>
		</h3>
	</div>

	<div class="category-list-area" id="showFilter">

		<!-- User List Area -->
		<div class="datatable">
			<div class="card-body">
				<table class="table" id="bootstrap-data-table">

					<thead>
						<tr>
							<th>Name</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody>
						@foreach($dataArr["galleryArr"] as $gallery)
						<tr>
							<td title="Name">
                                {{$gallery->gallery_name}}
							</td>
							<td title="Action">
								<a href="{{ route('admin.gallery.edit',$gallery->id) }}" title="Edit">
									<i class="fa fa-edit listing"></i>
								</a>
								<a href="{{ route('admin.gallery.view',$gallery->id) }}" title="Edit">
									<i class="fa fa-eye listing"></i>
								</a>
								<a href="{{ route('admin.gallery.remove',$gallery->id) }}" title="Delete" onclick="return confirm('Are you sure to delete?');">
									<i class="fa fa-trash chat"></i>
								</a>
							</td>
 						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

</div>
<!-- Booking Status Section Start -->
@stop
