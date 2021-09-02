@extends('layouts.admin-dashboard')
@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec category-list-sec">
            <div class="category-list-hdn">
                <h2>Add User</h2>
                <h3 class="create-cat">
                    <a href="{{ route('admin.user') }}">Back</a>
                </h3>
            </div>


            <div class="category-list-area">
                <form action="{{ route('admin.user.insert') }}" method="POST" id="user_form"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="midform">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                required="">
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="tel" name="phone" class="form-control" value="{{ old('phone') }}"
                                required="">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                required="">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" value="{{ old('password') }}"
                                required="">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Select Role</label>
                            <select class="form-control" name="role_id">
                                <option value="">Select Role</option>
                                @foreach ($dataArr['roleArr'] as $role)
                                    <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="submit-btn subbtn" type="submit">Submit</button>
                    </div>



                </form>

            </div>
        </div>

    </div>
@stop

@push('script')
    <script>
        $("#user_form").validate({
            rules: {
                name: {
                    required: true
                },
                phone: {
                    required: true
                },
                email: {
                    required: true
                },
                password: {
                    required: true
                },
                status: {
                    required: true
                },
                role_id: {
                    required: true
                },
            },
            messages: {
                name: "Please enter name",
                phone: "Please enter phone",
                email: "Please enter email",
                password: "Please enter password",
                status: "Please select status",
                role_id: "Please select role",
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    </script>
@endpush
