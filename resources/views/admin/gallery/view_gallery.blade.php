@extends('layouts.admin-dashboard')
@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec category-list-sec">
            <div class="category-list-hdn">
                <h2>View Gallery</h2>
                <h3 class="create-cat">
                    <a href="{{ route('admin.gallery') }}">Back</a>
                </h3>
            </div>

            <div class="category-list-area">
                <div class="col-lg-12 col-md-12 room-img">
                    @foreach ($dataArr['galleryArr']->getGalleryImages as $img)
                        <div id="remove_{{ $img->id }}">
                            <img src="{{ asset('public/storage/galler_image/') . '/' . $img->image }}"
                                style="height100px; width:100px;">
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

    </div>
    <!-- Booking Status Section Start -->
@stop
@push('script')

    <script type="text/javascript">
        function removeImg(img_id) {
            $.post('{{ route('admin.gallery.img.remove') }}', {
                "img_id": img_id,
                "_token": "{!! @csrf_token() !!}"
            }, function(response) {
                if (response.status == "success") {
                    console.log(response.check);
                    $('#remove_' + img_id).hide();
                    $('.gallery-msg').show();

                    if (response.check == 0)
                        $('#gallery-photo-add').prop('required', 'true');

                    setTimeout(function() {
                        $('.gallery-msg').fadeOut('slow');
                    }, 4000);
                } else if (response.status == "error") {
                    $('.gallery-msg-err').show();
                    setTimeout(function() {
                        $('.gallery-msg-err').fadeOut('slow');
                    }, 4000);
                }
            });
        }

        $(function() {
            // Multiple images preview in browser
            var imagesPreview = function(input, placeToInsertImagePreview) {

                if (input.files) {
                    var filesAmount = input.files.length;

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            var new_html = '<img src="' + event.target.result + '">';
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

        $(document).ready(function() {
            $('#galleryForm').click(function() {
                tinymce.triggerSave();
            });
        });
    </script>
@endpush
