@extends ('admin/index')
@section('title', 'Create-User')
@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
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
                <!-- left column -->
                <div class="col-md-6">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add User</h3>
                        </div>
                        <!-- /.card-header -->
                        <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="Inputusername">Brand Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                        placeholder="Enter name">
                                    @error('name')
                                        <div class="form-valid-error text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="Inputusername">Email Address</label>
                                    <input type="text" name="email" class="form-control" value="{{ old('email') }}"
                                        placeholder="Enter Email">
                                    @error('email')
                                        <div class="form-valid-error text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="Inputusername">User Type</label>
                                    <select class="form-control" name="user_type">
                                        {{-- <option value="">Select User</option> --}}
                                        <option value="brand">Brand</option>
                                        {{-- <option value="creator">Creator</option> --}}
                                    </select>
                                    @error('user_type')
                                        <div class="form-valid-error text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="Inputusername">Password</label>
                                    <input type="password" name="password" class="form-control"
                                        value="{{ old('password') }}" placeholder="Enter Password">
                                    @error('password')
                                        <div class="form-valid-error text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="Inputusername">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control"
                                        value="{{ old('password_confirmation') }}" placeholder="Enter Confirm Password">
                                    @error('password_confirmation')
                                        <div class="form-valid-error text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- <div class="form-group">
                                    <label for="new_image">Profile Image</label>
                                    <input type="file" name="image" class="form-control" value="{{ old('image') }}"
                                        placeholder="Enter image" onchange="loadFile(event)"><br>
                                    <img id="output" width="100px" />
                                    @error('image')
                                        <div class="form-valid-error text-danger">{{ $message }}</div>
                                    @enderror
                                </div> --}}

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">
                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection

<script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src)
        }
    };
</script>
