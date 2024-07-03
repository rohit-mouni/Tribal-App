@extends ('admin/index')
@section('title', 'Brand-List')
@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Brand-list</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Add Brand</li>
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
                            <button type="button" id="user_add_btn" class="btn btn-primary float-left" data-toggle="modal" data-target="#user_modal">
                                Add Brand
                              </button>
                        </div>
                        <div class="card-body">
                            <table id="subadminlisting" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        {{-- <th>Profile image</th> --}}
                                        <th>Brand Name</th>
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

                                            <td>{{ ucwords($user->brand_name) }}</td>
                                            <td>{{ ($user->email) }}</td>
                                            <td>{{ ucwords($user->user_type) }}</td>
                                            <td>
                                                @if ($user->status == 'active')
                                                    <div class="btn btn-success btn-sm">{{ ucwords($user->status) }}</div>
                                                @else
                                                    <div class="btn btn-danger btn-sm">{{ ucwords($user->status) }}</div>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="" id="edit_user_btn" data-status="{{ $user->status }}" data-brand_name="{{ $user->brand_name }}" data-email="{{ $user->email }}" data-password="{{ $user->password }}" data-id="{{ $user->id }}"
                                                    class="btn btn-warning btn-sm edit_user_btn">Edit</a>
                                                <a href="{{ route('user.delete', $user->id) }}"
                                                    class="btn btn-danger btn-sm">Delete</a>
                                                    <a href="{{ route('user.profile.update.view', $user->id) }}"
                                                        class="btn btn-primary btn-sm">Complete-User-Profile</a>
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
          <!-- Modal -->
  <div class="modal fade" id="user_modal" tabindex="-1" role="dialog" aria-labelledby="user_modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title user_modal_title" id="user_modal_title" >Add brand</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data" id="add_brand_form">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="Inputusername">Brand Name</label>
                        <input type="text" name="brand_name" class="form-control" value="" id="brand_name"
                            placeholder="Enter brand name">
                        @error('brand_name')
                            <div class="form-valid-error text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="Inputusername">Email Address</label>
                        <input type="text" name="email" class="form-control" value="" id="email"
                            placeholder="Enter Email">
                        @error('email')
                            <div class="form-valid-error text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group password_div">
                        <label for="Inputusername">Password</label>
                        <input type="password" name="password" class="form-control" id="password"
                            value="" placeholder="Enter Password">
                        @error('password')
                            <div class="form-valid-error text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- <div class="form-group">
                        <label for="Inputusername">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                            value="" placeholder="Enter Confirm Password">
                        @error('password_confirmation')
                            <div class="form-valid-error text-danger">{{ $message }}</div>
                        @enderror
                    </div> --}}

                    <div class="form-group">
                        <label for="Inputusername">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="active">
                                Active</option>
                            <option value="inactive">
                                Inactive</option>
                        </select>
                        @error('status')
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
                    <button type="submit" id="user_submit_btn" class="btn btn-primary">Submit</button>
                </div>
            </form>
    </div>
  </div>

    <script>
        $(document).ready(function() {
            var table = $('#subadminlisting').DataTable();
        });
    </script>

@endsection
