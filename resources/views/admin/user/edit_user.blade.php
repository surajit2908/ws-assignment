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
                <h2>Edit User</h2>
                <h3 class="create-cat">
                    <a href="{{ route('admin.user') }}">Back</a>
                </h3>
            </div>

            <div class="category-list-area">
                <form action="{{ route('admin.user.update', $dataArr['userArr']->id) }}" method="POST" id="user_form"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="midform">

                        <div class="form-group">
                            <label>User Name</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ $dataArr['userArr']->name }}" required="">
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="tel" name="phone" class="form-control" value="{{ $dataArr['userArr']->phone }}" required="">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $dataArr['userArr']->email }}"
                                required="">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option value="">Select Status</option>
                                <option value="1" {{ $dataArr['userArr']->status == '1' ? "selected" : "" }}>Active</option>
                                <option value="0" {{ $dataArr['userArr']->status == '0' ? "selected" : "" }}>Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Select Role</label>
                            <select class="form-control" name="role_id">
                                <option value="">Select Role</option>
                                @foreach ($dataArr['roleArr'] as $role)
                                    <option value="{{ $role->id }}" {{ $dataArr['userArr']->role_id == $role->id ? "selected" : "" }}>{{ $role->role_name }}</option>
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
    <script src="{{ asset('public/choosen-multiselect/docsupport/jquery-3.2.1.min.js') }}" type="text/javascript">
    </script>
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
        $("#user_form").validate({
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
