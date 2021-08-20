@extends('layouts.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">

          @if ($message = Session::get('success'))
              <div class="alert alert-success">

                  <p>{{ $message }}</p>

              </div>
          @endif
            </div>
          </div>
      </div>
  </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="row mb-0 mt-5">
          <div class="col-sm-6">
            <h1>{{ __('Movie Shows At ') }} {{ $cinema->name }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('cinemas.index')}}" >Home</a></li>
              <li class="breadcrumb-item active">{{ __('Movie') }}</li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="card-new">
              <div class="datatable-new-top">
                <div class="row">
                  <div class="col-sm-12 col-md-6">

                  </div>
                  <div class="col-sm-12 col-md-6 text-right">
                    <a href="{{ route('session_time.create', $cinema->id) }}" class="red-button">{{ __('Add Movie') }}</a>
                  </div>
                </div>
              </div>
              <div class="datatable-new-outer">
                <div class="card">
                  <!-- /.card-header -->
                  <table id="news_list" class="table">
                    <thead>
                      <tr>
                        <th>{{ __('#') }}</th>
                        <th>{{ __('Movie') }}</th>
                        <th>{{ __('Date') }}</th>
                        <th>{{ __('Action') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $i=1; @endphp
                      @if(!empty($movies) && $movies->count())
                        @foreach($movies as $key => $movie)
                          <tr>
                          @if( request()->page )
                            <td>{{ $movies->currentPage() * $movies->perPage() - $movies->perPage() + $i++ }}</td>
                          @else
                            <td>{{ $i++}}</td>
                          @endif
                            <td>{{ $movie->title }}</td>
                            <td>{{ $movie->date_time }}</td>
                            <td>
                             <form action="{{ route('session_time.destroy',$movie->id) }}" method="POST">  
                                <a class="btn btn-info btn-sm" href="{{ route('session_time.edit',['session_id'=> $movie->id, 'cinema_id'=> $cinema->id]) }}"><i class="fas fa-pencil-alt">
                                </i>Edit</a>
                                @csrf 
                                @method('DELETE')
                                <input type="hidden" value="{{ $cinema->id }}" name="cinema_id" id="cinema_id">
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>Delete</button>
                              </form>
                            </td>
                          </tr>
                        @endforeach
                      @else
                        <tr>
                          <td colspan="10">There are no data.</td>
                        </tr>
                      @endif
                    </tbody>
                  </table>

                  <!-- /.card-body -->
                </div>
                  {{-- Pagination --}}
                  <div class="row">
                    <div class="col-12">
                    {{ $movies->links('pagination::bootstrap-4') }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @endsection