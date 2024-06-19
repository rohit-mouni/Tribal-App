@extends ('admin/index')
@section('title', 'Vertical-List')
@section('content')
<style>
    .img-preview {
        max-width: 150px%;
        max-height: 150px;
        /* display: none; */
        margin-top: 10px;
    }
</style>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Hangout-list</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Add Hangout</li>
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
                            {{-- <a href="" class="">Add Hangout</a> --}}
                            <button type="button" id="hangout_add_btn" class="btn btn-primary float-left" data-toggle="modal" data-target="#hangout_modal">
                                Add Hangout
                              </button>
                        </div>
                        <div class="card-body">
                            <table id="subadminlisting" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Duration</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hangouts as $hangout)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ $hangout->image!=null ? asset('admin-assets/uploads/travel_post_plan/hangout'.'/'.$hangout->image) : "image"}}"
                                                    alt="image" width="100">
                                            </td>
                                            <td>{{ ucwords($hangout->title) }}</td>
                                            <td> {{ $hangout->duration }}</td>
                                            <td>
                                                <a href="" id="hangout-edit-btn" data-id="{{ $hangout->id }}" data-title="{{ $hangout->title }}" data-duration="{{ $hangout->duration }}" data-image="{{ $hangout->image }}" data-img_path="{{ asset('admin-assets/uploads/travel_post_plan/hangout/') }}"
                                                    class="btn btn-warning btn-sm edit_hangout">Edit</a>
                                                <a href="{{ route('delete.hangout', $hangout->id) }}"
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
    <!-- Model -->
<!-- Button trigger modal -->

  <!-- Modal -->
  <div class="modal fade" id="hangout_modal" tabindex="-1" role="dialog" aria-labelledby="hangout_modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title hangout_model_title" id="hangout_model_title" >Add Hangout</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('add.hangout') }}" method="post" enctype="multipart/form-data" id="add_hangout_form">
                @csrf
                <div class="form-group">
                    <label for="imageInput">Image</label>
                    <input type="file" class="form-control-file" id="imageInput" accept="image/*" name="image">
                    <img id="imgPreview" class="img-preview" src="hangout" alt="Image Preview">
                    @error('image')
                    <div class="text-danger">{{ $message }}</div>
                     @enderror
                </div>
                <div class="form-group">
                    <label for="titleInput">Title</label>
                    <input type="text" class="form-control" id="title" placeholder="Enter title" name="title">
                    {{-- <input type="hidden" class="form-control" id="hangout_id" name="hangout_id"> --}}
                    @error('title')
                   <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="durationInput">Duration</label>
                    <select class="form-control" id="duration" name="duration">
                        <option value="">Select</option>
                        <option value="1 hour">1 Hour</option>
                        <option value="8 hour">8 Hours</option>
                        <option value="24 hour">24 Hours</option>
                    </select>
                    @error('duration')
                   <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                <button type="submit" class="btn btn-primary" id="hangout_submit_btn">Submit</button>
            </div>
        </div>
    </form>
    </div>
  </div>
  <script>
    document.getElementById('imageInput').addEventListener('change', function(event) {
        const [file] = event.target.files;
        if (file) {
            const preview = document.getElementById('imgPreview');
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        }
    });
</script>

    <script>
        $(document).ready(function() {
            var table = $('#subadminlisting').DataTable();
        });
    </script>

@endsection
