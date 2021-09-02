@extends('layouts.admin-dashboard')
@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec category-list-sec">
            <div class="category-list-hdn">
                <h2>Role Management</h2>
                <h3 class="create-cat">
                    <a href="{{ route('admin.role.add') }}">Add new Role</a>
                </h3>
            </div>

            <div class="category-list-area" id="showFilter">

                <!-- User List Area -->
                <div class="datatable">
                    <div class="card-body">
                        <table class="table" id="bootstrap-data-table">

                            <thead>
                                <tr>
                                    <th>Role Name</th>
                                    <th>Permissions</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($dataArr['roleArr'] as $role)
                                    <tr>
                                        <td title="Role Name">
                                            {{ $role->role_name }}
                                        </td>
                                        <td title="Permissions">
                                            @foreach ($role->getRolePermission as $rolePermission)
                                                {{$rolePermission->getPermission->module_name}},
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.role.edit', $role->id) }}" title="Edit">
                                                <i class="fa fa-edit listing"></i>
                                            </a>

                                            @if ($role->getCity)
                                            <a href="#" class="infoselect">
                                                <i class="fa fa-info-circle views" ></i>
                                                <div class="info">
                                                    <p>
                                                        Cities are inserted for this role. Delete those cities to delete this role.
                                                    </p>
                                                </div>
                                            </a>
                                            @else
                                                <a href="{{ route('admin.role.remove', $role->id) }}" title="Delete"
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
