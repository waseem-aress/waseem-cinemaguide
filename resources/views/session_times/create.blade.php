@extends('layouts.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
      <div class="container-fluid">
      <div class="row mb-0 mt-5">
          <div class="col-sm-6">
            <h1>{{ __('Add Movie show') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('cinemas.show',$cinema_id) }}">Home</a></li>
              <li class="breadcrumb-item active">{{ __('Add Movie show') }}</li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Add Movie show</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                @if ($errors->any())
                  <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div><br />
                @endif
                @if ($message = Session::get('error'))
                  <div class="alert alert-danger">
                    <p>{{ $message }}</p>
                  </div>
                @endif
                <form method="POST" action="{{ route('session_time.store') }}" id="createCinemaForm">
                  @csrf
                  <div class="card">
                    <div class="form-new-outer">
                      <!-- /.card-header -->
                      <div class="card-body">
                        <div class="form-section-main">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="name">{{ __('Movie') }} :</label>
                                <select class="form-control" name="movie_id" id="movie_id">
                                  <option value="">{{ __('Select Movie') }}</option> 
                                     @foreach ($movies as $movie)
                                            <option value="{{ $movie->id }}">{{ $movie->title }}</option> 
                                      @endforeach
                                 </select>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="address">{{ __('Date') }} :</label>
                                <input type="text" class="form-control" name="date_time" id="date_time" value="">
                                <input type="hidden" value="{{ $cinema_id }}" name="cinema_id" id="cinema_id">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12">
                            <button type="submit" name="submit" class="btn btn-success">{{ __('Add Movie Show') }}</button>
                            <a href="{{ route('cinemas.show',$cinema_id) }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection


@section('script')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.js"></script>
<script src="{{ asset('js/session_times.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#date_time').datetimepicker('setDate', (new Date()));
  });
</script>
@endsection