@extends('layouts.admin-dashboard')
@section('content')
<div class="admin-body-area">
<!-- Booking Status Section Start -->
<div class="booking-status-sec category-list-sec">
	<div class="category-list-hdn">
		<h2>Add Gallery</h2>
		<h3 class="create-cat">
            <a href="{{route('admin.gallery')}}">Back</a>
		</h3>
	</div>


	<div class="category-list-area">
		<form action="{{route('admin.gallery.insert')}}" method="POST" id="galleryForm" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label>Gallery Name</label>
                        <input type="text" name="gallery_name" class="form-control" value="{{ old('gallery_name') }}"
                            required="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label>Gallery Image <small class="text-danger">*Image size must be less than 2MB</small></label>

                        <div class="custom-file mb-3">
                        <input type="file" class="custom-file-input" id="gallery-photo-add" name="image[]" multiple="" required>
                        <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>

                    </div>
                </div>
                <div class="col-lg-12 col-md-12 show-img gallery">
                </div>
            </div>

           <button class="submit-btn subbtn" type="submit">Submit</button>
        </form>

	</div>
</div>

</div>
<!-- Booking Status Section Start -->
@stop
@push('script')

<script type="text/javascript">
    $(function() {
        // Multiple images preview in browser
        var imagesPreview = function(input, placeToInsertImagePreview) {

            if (input.files) {
                var filesAmount = input.files.length;

                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();

                    reader.onload = function(event) {
                        var new_html = '<img src="'+event.target.result+'">';
                        $('.gallery').append(new_html);
                        // $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                    }

                    reader.readAsDataURL(input.files[i]);
                }
            }

        };

        $('#gallery-photo-add').on('change', function() {
            imagesPreview(this, 'div.gallery');
            $('.gallery').html('');
        });
    });

    $(document).ready(function(){
        $('#galleryForm').click(function() {
            tinymce.triggerSave();
        });
    });

</script>
@endpush
