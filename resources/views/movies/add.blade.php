@extends("layouts.app")

@section("content")
<div class="content-wrapper">

<section class="content">
   <div class="container-fluid">
       <div class="row mb-0 mt-5">
          <div class="col-sm-6">
            <h1>{{ __("Movie") }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{ __("Create Movie") }}</li>
            </ol>
          </div>
        </div>
      <div class="row">
         <div class="col-lg-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                           <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

         @if ($message = Session::get("error"))
              <div class="alert alert-danger">
                  <p>{{ $message }}</p>
              </div>
          @endif

          <form action="{{ route("movies.store") }}" method="POST" id="createMovieForm" enctype="multipart/form-data">
             @csrf
            <div class="card">
               <div class="form-new-outer">
                  <!-- /.card-header -->
                  <div class="card-body">
                     <div class="form-section-main">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="first_name">{{ __("Title") }} :</label>
                                 <input type="text" class="form-control" name="title" id="title" value="">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="last_name">{{ __("Parental Rating") }} :</label>
                                 <span class="asterisk">*</span>
                                 <select class="form-control" name="parental_rating" id="parental_rating">
                                    <option value="1">{{ __("G") }}</option>
                                    <option value="2">{{ __("PG") }}</option>
                                    <option value="3">{{ __("M") }}</option>
                                    <option value="4">{{ __("MA 15+") }}</option>
                                    <option value="5">{{ __("R 18+") }}</option>
                                    <option value="6">{{ __("X 18+") }}</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="first_name">{{ __("Movie length (minutes)") }} :</label>
                                 <input type="text" class="form-control" name="movie_length" id="movie_length" value="">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <label for="first_name">{{ __("Poster") }} :</label>
                                <div class="input-group">
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="poster" name="poster">
                                    <label class="custom-file-label" for="poster">Choose file</label>
                                  </div>
                                </div>
                            </div>
                           </div>
                        </div>
                     <div class="row">
                       <div class="col-12">
                         <button type="submit" name="submit" class="btn btn-success">{{ __("Create Movie") }}</button>
                         <a href="{{ route("movies.index") }}" class="btn btn-secondary">{{ __("Cancel") }}</a>
                       </div>
                     </div>
                  </div>
               </div>
            </div>
          </form>
         </div>
      </div>
   </div>
</section>
</div>
@endsection

@section("script")
   <script>
      $(document).ready(function() {
         $("#createMovieForm").validate({
            rules: {
               title: {
                  required: true
               },
               parental_rating: {
                  required: true
               },
               movie_length: {
                  required: true,
                  number: true,
                  min:1,
                  max:999,
               },
               poster: {
                  required: true
               }
            }
         });
      });
   </script>
@endsection