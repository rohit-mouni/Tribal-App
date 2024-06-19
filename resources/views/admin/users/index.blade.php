@extends ('admin/index')
@section('title', 'User-List')
@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users-list</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Add User</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('user.create') }}" class="btn btn-primary float-left">Add User</a>
                        </div>
                        <div class="card-body">
                            <table id="subadminlisting" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        {{-- <th>Profile image</th> --}}
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>User Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allUsers as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            {{-- @if ($user->profile_image)
                                                <td>
                                                    <img src="{{ url('admin-assets/uploads/profileimages/' . $user->profile_image) }}"
                                                        alt="image" width="100">
                                                </td>
                                            @else
                                            <td>
                                                <img src="{{ url('admin-assets/uploads/placeholderImage/' . 'admin.jpg') }}"
                                                    alt="image" width="100">
                                            </td>
                                            @endif --}}

                                            <td>{{ ucwords($user->name) }}</td>
                                            <td>{{ ucwords($user->email) }}</td>
                                            <td>{{ ucwords($user->user_type) }}</td>
                                            <td>
                                                @if ($user->status == 'active')
                                                    <div class="btn btn-success btn-sm">{{ ucwords($user->status) }}</div>
                                                @else
                                                    <div class="btn btn-danger btn-sm">{{ ucwords($user->status) }}</div>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('user.edit', $user->id) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <a href="{{ route('user.delete', $user->id) }}"
                                                    class="btn btn-danger btn-sm">Delete</a>
                                                    <a href="{{ route('user.profile.update.view', $user->id) }}"
                                                        class="btn btn-primary btn-sm">Profile Update</a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        </div>
    </section>
    <!-- /. Main content -->

    <script>
        $(document).ready(function() {
            var table = $('#subadminlisting').DataTable();
        });
    </script>

@endsection
