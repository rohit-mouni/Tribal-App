@extends ('admin/index')
@section('title', 'Vertical-List')
@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Vertical-list</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Add Vertical</li>
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
                            <button type="button" id="vertical_add_btn" class="btn btn-primary float-left" data-toggle="modal" data-target="#vertical_modal">
                                Add Vertical
                              </button>
                        </div>
                        <div class="card-body">
                            <table id="subadminlisting" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allUsers as $category)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ ucwords($category->vertical_name) }}</td>
                                            <td>
                                                @if ($category->status == 'active')
                                                    <div class="btn btn-success btn-sm">{{ ucwords($category->status) }}
                                                    </div>
                                                @else
                                                    <div class="btn btn-danger btn-sm">{{ ucwords($category->status) }}
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="" id="edit_vertical_btn" data-id="{{ $category->id }}" data-vertical_name="{{ $category->vertical_name }}" data-status="{{ $category->status }}"
                                                    class="btn btn-warning btn-sm edit_post edit_vertical_btn">Edit</a>
                                                <a href="{{ route('vertical.delete', $category->id) }}"
                                                    class="btn btn-danger btn-sm">Delete</a>
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
  <div class="modal fade" id="vertical_modal" tabindex="-1" role="dialog" aria-labelledby="vertical_modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title vertical_modal_title" id="vertical_modal_title" >Add Vertical</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('vertical.store') }}" method="post" enctype="multipart/form-data" id="vertical_store">
                @csrf
                <div class="form-group">
                    <label for="vertical_name">Vertical Name</label>
                    <input type="text" class="form-control" id="vertical_name" placeholder="Enter vertical name" name="vertical_name">
                    @error('vertical_name')
                   <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="Inputusername">Status</label>
                    <select class="form-control" name="status" id="status">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    @error('status')
                        <div class="form-valid-error text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="vertical_submit_btn">Submit</button>
            </div>
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
