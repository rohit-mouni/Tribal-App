@extends ('admin/index')
@section('title', 'Plan-List')
@section('content')
<style>
    .img-preview {
        max-width: 150px%;
        max-height: 150px;
        /* display: none; */
        margin-top: 10px;
    }
    /* for multiple select options */
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
    color: #0e0e0e;
}
</style>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Plan-list</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Add plan</li>
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
                            {{-- <a href="" class="">Add plan</a> --}}
                            <button type="button" id="plan_add_btn" class="btn btn-primary float-left" data-toggle="modal" data-target="#plan_modal">
                                Add Plan
                              </button>
                        </div>
                        <div class="card-body">
                            <table id="subadminlisting" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Arriving</th>
                                        <th>Departing</th>
                                        <th>Private</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($plans as $plan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img class="img_size" src="{{ $plan->image!=null ? asset('admin-assets/uploads/travel_post_plan/plan'.'/'.$plan->image) : "image"}}"
                                                    alt="image">
                                            </td>
                                            <td>{{ ucwords($plan->name) }}</td>
                                            <td> {{ $plan->arriving }}</td>
                                            <td> {{ $plan->departing }}</td>
                                            <td> {{ $plan->is_private == "1" ? "yes" : "no" }}</td>
                                            <td>
                                                <a href="" id="plan-edit-btn" data-id="{{ $plan->id }}" data-name="{{ $plan->name }}" data-arriving="{{ $plan->arriving }}" data-link="{{ $plan->link }}" data-image="{{ $plan->image }}" data-img_path="{{ asset('admin-assets/uploads/travel_post_plan/plan/') }}" data-departing="{{ $plan->departing }}" data-about_trip="{{ $plan->about_trip }}" data-verticals="{{ $plan->verticals }}" data-destinations="{{ $plan->destinations }}"data-is_private="{{ $plan->is_private }}"
                                                    class="btn btn-warning btn-sm edit_plan">Edit</a>
                                                <a href="{{ route('delete.plan', $plan->id) }}"
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
  <div class="modal fade" id="plan_modal" tabindex="-1" role="dialog" aria-labelledby="plan_modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title plan_model_title" id="plan_model_title" >Add Plan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('add.plan') }}" method="post" enctype="multipart/form-data" id="add_plan_form">
                @csrf
                <div class="form-group">
                    <label for="imageInput">Image</label>
                    <input type="file" class="form-control-file" id="imageInput" accept="image/*" name="image">
                    <img id="imgPreview" class="img-preview" src="plan" alt="Image Preview">
                    @error('image')
                    <div class="text-danger">{{ $message }}</div>
                     @enderror
                </div>
                <div class="form-group">
                    <label for="titleInput">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter plan name" name="name">
                    @error('name')
                   <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="titleInput">arriving Date</label>
                    <input type="date" class="form-control" id="arriving" placeholder="Enter arriving date" name="arriving">
                    @error('arriving')
                   <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="titleInput">Departing Date</label>
                    <input type="date" class="form-control" id="departing" placeholder="Enter departing date" name="departing">
                    @error('departing')
                   <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="titleInput">About Trip</label>
                    <textarea cols="30" rows="3" class="form-control" id="about_trip" placeholder="Enter about trip" name="about_trip"></textarea>
                    @error('about_trip')
                   <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="titleInput">Private Plan</label>
                    <div class="form-check">
                        <div class="form-check form-switch">
                            <input name="is_private" class="form-check-input" type="checkbox" role="switch" id="is_private" >
                            <label class="form-check-label" for="is_private">Private</label>
                          </div>
                    @error('is_private')
                   <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="titleInput">Link</label>
                    <textarea cols="30" rows="3" class="form-control" id="link" placeholder="Enter about trip" name="link"></textarea>
                    @error('link')
                   <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="destinations">Destinations</label>
                    <select style="width: 100%;" name="destinations[]" class="form-control select_multiple" id="destinations" multiple>
                        {{-- <option value="">Select Multiple Destinations</option> --}}
                        <option value="one">One</option>
                        <option value="two">Two</option>
                        <option value="three">Three</option>
                        <option value="four">four</option>
                        <option value="five">five</option>
                        <option value="six">six</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="duratioverticalsnInput">Verticals</label>
                    <select style="width: 100%;" name="verticals[]" class="form-control select_multiple" id="verticals" multiple>
                        {{-- <option value="">Select Multiple Verticals</option> --}}
                        @foreach ($verticals as $vertical)
                        <option value="{{ $vertical->vertical_name }}">{{ $vertical->vertical_name }}</option>
                        @endforeach
                        {{-- <option value="two">Two</option>
                        <option value="three">Three</option>
                        <option value="four">four</option>
                        <option value="five">five</option>
                        <option value="six">six</option> --}}
                    </select>
                </div>
                {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                <button type="submit" class="btn btn-primary" id="plan_submit_btn">Submit</button>
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
