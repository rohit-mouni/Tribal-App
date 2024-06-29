@extends ('admin/index')
@section('title', 'Edit-List')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- <h1 class="m-0">Add Subadmin</h1> -->
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
                            <h3 class="card-title">Edit User</h3>
                        </div>
                        <!-- /.card-header -->
                        <form action="{{ route('user.update', $TrendsData->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="Inputusername">Brand Name</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ $TrendsData->name }}" placeholder="Enter name">
                                    @error('name')
                                        <div class="form-valid-error text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="Inputusername">Email Address</label>
                                    <input type="text" name="email" class="form-control"
                                        value="{{ $TrendsData->email }}" placeholder="Enter email">
                                    @error('email')
                                        <div class="form-valid-error text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="Inputusername">User Type</label>
                                    <select class="form-control" name="user_type">
                                        {{-- <option value="">Select User</option> --}}
                                        <option value="brand" {{ $TrendsData->user_type == 'brand' ? 'selected' : '' }}>
                                            Brand</option>
                                        {{-- <option value="creator" {{ $TrendsData->user_type == 'creator' ? 'selected' : '' }}> --}}
                                            {{-- Creator</option> --}}
                                    </select>
                                    @error('status')
                                        <div class="form-valid-error text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- -------image code---------- -->
                                {{-- <div class="form-group">
                                    @if ($TrendsData->profile_image)
                                        <td>
                                            <img id="output" src="{{ url('admin-assets/uploads/profileimages/' . $TrendsData->profile_image) }}"
                                                alt="image" width="100">
                                        </td>
                                    @else
                                        <td>
                                            <img src="{{ url('admin-assets/uploads/placeholderImage/' . 'admin.jpg') }}"
                                                alt="image" width="100">
                                        </td>
                                    @endif
                                </div> --}}

                                {{-- ------- --}}
                                {{-- <img id="output" width="100px" /> --}}
                                {{-- <div class="form-group">
                                    <label for="new_image">Profile Image</label>
                                    <input type="file" class="form-control-file" id="image" name="image"
                                        onchange="loadFile(event)"><br>
                                    @error('image')
                                        <div class="form-valid-error text-danger">{{ $message }}</div>
                                    @enderror
                                </div> --}}

                                <div class="form-group">
                                    <label for="Inputusername">Status</label>
                                    <select class="form-control" name="status">
                                        <option value="active" {{ $TrendsData->status == 'active' ? 'selected' : '' }}>
                                            Active</option>
                                        <option value="inactive" {{ $TrendsData->status == 'inactive' ? 'selected' : '' }}>
                                            Inactive</option>
                                    </select>
                                    @error('status')
                                        <div class="form-valid-error text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- ---------------image------------ -->
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
