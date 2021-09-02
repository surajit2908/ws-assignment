@extends('layouts.admin-dashboard')
@push('links')
    <link rel="stylesheet" href="{{ asset('public/choosen-multiselect/docsupport/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/choosen-multiselect/docsupport/prism.css') }}">
    <link rel="stylesheet" href="{{ asset('public/choosen-multiselect/chosen.css') }}">
@endpush
@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec category-list-sec">
            <div class="category-list-hdn">
                <h2>Add Role</h2>
                <h3 class="create-cat">
                    <a href="{{ route('admin.role') }}">Back</a>
                </h3>
            </div>


            <div class="category-list-area">
                <form action="{{ route('admin.role.insert') }}" method="POST" id="role_form"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="midform">
                        <div class="form-group">
                            <label>Role Name</label>
                            <input type="text" name="role_name" class="form-control" value="{{ old('role_name') }}"
                                required="">
                        </div>
                        <div class="form-group">
                            <label>Select Permissions</label>
                            <select class="my_select_box" multiple data-placeholder="Select Your Options"
                                name="permissions[]">
                                <option value="" disabled>Select Permissions</option>
                                @foreach ($dataArr['permissionArr'] as $permission)
                                    <option value="{{$permission->id}}">{{$permission->module_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="submit-btn subbtn" type="submit">Submit</button>
                    </div>



                </form>

            </div>
        </div>

    </div>
    <!-- Booking Status Section Start -->
@stop

@push('script')
    <script src="{{ asset('public/choosen-multiselect/docsupport/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/choosen-multiselect/chosen.jquery.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/choosen-multiselect/docsupport/prism.js') }}" type="text/javascript" charset="utf-8">
    </script>
    <script src="{{ asset('public/choosen-multiselect/docsupport/init.js') }}" type="text/javascript" charset="utf-8">
    </script>
    <script>
        $(".my_select_box").chosen({
            disable_search_threshold: 10,
            no_results_text: "Oops, nothing found!",
            width: "95%"
        });
        $("#role_form").validate({
            rules: {
                role_name: {
                    required: true
                }
            },
            messages: {
                role_name: "Please enter role name",
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    </script>
@endpush
