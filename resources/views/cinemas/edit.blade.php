@extends('layouts.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-0 mt-5">
          <div class="col-sm-6">
            <h1>{{ __('Cinema') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('cinemas.index') }}" >Home</a></li>
              <li class="breadcrumb-item active">{{ __('Update Cinema') }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Update Cinema</h3>

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
                <form method="POST" action="{{ route('cinemas.update', $cinema->id) }}" id="updateCinemaForm">
                  @method('PUT')
                  @csrf
                  <div class="card">
                    <div class="form-new-outer">
                      <!-- /.card-header -->
                      <div class="card-body">
                        <div class="form-section-main">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="name">{{ __('Name') }} :</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $cinema->name }}">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="address">{{ __('Address') }} :</label>
                                <!-- <textarea class="form-control" name="address" id="address">{{ $cinema->address }}</textarea> -->
                                <input type="text" class="form-control" name="address" id="address" value="{{ $cinema->address }}">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="geo_lat_long">{{ __('Geo Location') }} :</label>
                                <input type="text" class="form-control" name="geo_lat_long" id="geo_lat_long" value="{{ $cinema->geo_lat_long }}">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="seating_capacity">{{ __('Seating Capacity') }} :</label>
                                <input type="text" class="form-control" name="seating_capacity" id="seating_capacity" value="{{ $cinema->seating_capacity }}" maxlength="3">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12">
                            <button type="submit" name="submit" class="btn btn-success">{{ __('Update Cinema') }}</button>
                            <a href="{{ route('cinemas.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
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
  <script>
    $(document).ready(function() {
      $("#updateCinemaForm").validate({
        rules: {
          name: {
            required: true
          },
          address: {
            required: true
          },
          geo_lat_long: {
            required: true
          },
          seating_capacity: {
            required: true,
            number: true
          }
        }
      });
    });
  </script>
@endsection