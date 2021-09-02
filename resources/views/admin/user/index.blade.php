@extends('layouts.admin-dashboard')
@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec category-list-sec">
            <div class="category-list-hdn">
                <h2>User Management</h2>
                <h3 class="create-cat">
                    <a href="{{ route('admin.user.add') }}">Add new User</a>
                </h3>
            </div>

            <div class="category-list-area" id="showFilter">

                <!-- User List Area -->
                <div class="datatable">
                    <div class="card-body">
                        <table class="table" id="bootstrap-data-table">

                            <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($dataArr['userArr'] as $user)
                                    <tr>
                                        <td title="User Name">
                                            {{ $user->name }}
                                        </td>
                                        <td title="Phone">
                                            {{ $user->phone }}
                                        </td>
                                        <td title="Email">
                                            {{ $user->email }}
                                        </td>
                                        <td title="Role">
                                            {{ @$user->getRole->role_name }}
                                        </td>
                                        <td title="Status">
                                            {{ $user->status ? "Active" : "Not Active" }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.user.edit', $user->id) }}" title="Edit">
                                                <i class="fa fa-edit listing"></i>
                                            </a>

                                            @if ($user->getCity)
                                            <a href="#" class="infoselect">
                                                <i class="fa fa-info-circle views" ></i>
                                                <div class="info">
                                                    <p>
                                                        Cities are inserted for this user. Delete those cities to delete this user.
                                                    </p>
                                                </div>
                                            </a>
                                            @else
                                                <a href="{{ route('admin.user.remove', $user->id) }}" title="Delete"
                                                    onclick="return confirm('Are you sure to delete?');">
                                                    <i class="fa fa-trash chat"></i>
                                                </a>
                                            @endif
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
@push('script')
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endpush
