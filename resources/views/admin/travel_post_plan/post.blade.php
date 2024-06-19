@extends ('admin/index')
@section('title', 'Post-List')
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
                    <h1 class="m-0">Post-list</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Add Post</li>
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
                            {{-- <a href="" class="">Add post</a> --}}
                            <button type="button" id="post_add_btn" class="btn btn-primary float-left" data-toggle="modal" data-target="#post_modal">
                                Add Post
                              </button>
                        </div>
                        <div class="card-body">
                            <table id="subadminlisting" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ $post->image!=null ? asset('admin-assets/uploads/travel_post_plan/post'.'/'.$post->image) : "image"}}"
                                                    alt="image" width="100">
                                            </td>
                                            <td>{{ ucwords($post->title) }}</td>
                                            <td> {{ $post->description }}</td>
                                            <td>
                                                <a href="" id="post-edit-btn" data-id="{{ $post->id }}" data-title="{{ $post->title }}" data-description="{{ $post->description }}" data-image="{{ $post->image }}" data-img_path="{{ asset('admin-assets/uploads/travel_post_plan/post/') }}"  data-instagram_post_link="{{ $post->instagram_post_link }}"
                                                    class="btn btn-warning btn-sm edit_post">Edit</a>
                                                <a href="{{ route('delete.post', $post->id) }}"
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
  <div class="modal fade" id="post_modal" tabindex="-1" role="dialog" aria-labelledby="post_modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title post_model_title" id="post_model_title" >Add post</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('add.post') }}" method="post" enctype="multipart/form-data" id="add_post_form">
                @csrf
                <div class="form-group">
                    <label for="imageInput">Image</label>
                    <input type="file" class="form-control-file" id="imageInput" accept="image/*" name="image">
                    <img id="imgPreview" class="img-preview" src="post" alt="Image Preview">
                    @error('image')
                    <div class="text-danger">{{ $message }}</div>
                     @enderror
                </div>
                <div class="form-group">
                    <label for="titleInput">Title</label>
                    <input type="text" class="form-control" id="title" placeholder="Enter title" name="title">
                    {{-- <input type="hidden" class="form-control" id="post_id" name="post_id"> --}}
                    @error('title')
                   <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                   <textarea class="form-control" name="description" id="description" cols="30" rows="3" id=description placeholder="Enter description"></textarea>
                    @error('description')
                   <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="instagram_post_link">Instagram Post Link</label>
                    <input type="text" class="form-control" id="instagram_post_link" placeholder="Enter instagram post link" name="instagram_post_link" >
                    @error('instagram_post_link')
                   <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                <button type="submit" class="btn btn-primary" id="post_submit_btn">Submit</button>
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
