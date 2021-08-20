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
              <li class="breadcrumb-item"><a href="{{ route("movies.index") }}" >Home</a></li>
              <li class="breadcrumb-item active">{{ __("Edit Movie") }}</li>
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

          <form action="{{ route("movies.update",$movie->id ) }}" method="POST" id="updateMovieForm" enctype="multipart/form-data">
             @csrf
            {{ method_field("PUT") }}
            <div class="card">
               <div class="form-new-outer">
                  <!-- /.card-header -->
                  <div class="card-body">
                     <div class="form-section-main">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="first_name">{{ __("Title") }} :</label>
                                 <input type="text" class="form-control" name="title" id="title" value="{{ $movie->title }}">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="last_name">{{ __("Parental Rating") }} :</label>
                                 <span class="asterisk">*</span>
                                 <select class="form-control" name="parental_rating">
                                    <option value="1" {{  $movie->parental_rating == 1 || $movie->parental_rating ==  "G" ? "selected" : "" }}>{{ __("G") }}</option>
                                    <option value="2" {{  $movie->parental_rating == 2 || $movie->parental_rating ==  "PG" ? "selected" : "" }}>{{ __("PG") }}</option>
                                    <option value="3" {{  $movie->parental_rating == 3 || $movie->parental_rating ==  "M" ? "selected" : "" }}>{{ __("M") }}</option>
                                    <option value="4" {{  $movie->parental_rating == 4 || $movie->parental_rating ==  "MA 15+" ? "selected" : "" }}>{{ __("MA 15+") }}</option>
                                    <option value="5" {{  $movie->parental_rating == 5 || $movie->parental_rating ==  "R 18+" ? "selected" : "" }}>{{ __("R 18+") }}</option>
                                    <option value="6" {{  $movie->parental_rating == 6 || $movie->parental_rating ==  "X 18+" ? "selected" : "" }}>{{ __("X 18+") }}</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="first_name">{{ __("Movie length (minutes)") }} :</label>
                                 <input type="text" class="form-control" name="movie_length" id="movie_length" value="{{ $movie->movie_length }}">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="first_name">{{ __("Poster") }} :</label>
                                  <div class="input-group">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="poster" name="poster">
                                      <label class="custom-file-label" for="poster">Choose file</label>
                                    </div>
                                  </div>
                              </div>
                           </div>

                            <div class="col-md-6">

                            </div>
                            <div class="col-md-6">
                              @if(is_file("storage/app/public/movie-images/".$movie->poster))
                                  <img src="{{ url("storage/app/public/movie-images/".$movie->poster) }}" class="img-responsive" height="100" width="100">
                              @else
                                   <img src="{{ asset("images/default.jpg") }}" class="img-responsive" height="100" width="100">
                              @endif
                            </div>
                        </div>
                     </div>
                     <div class="row">
                       <div class="col-12">
                         <button type="submit" name="submit" class="btn btn-success">{{ __("Update Movie") }}</button>
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
         $("#updateMovieForm").validate({
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
            }
         }
         });
      });
   </script>
@endsection