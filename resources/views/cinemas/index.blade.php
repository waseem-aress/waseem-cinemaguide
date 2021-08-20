@extends('layouts.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    

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
              <h1>{{ __('Cinema List') }}</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item active">{{ __('Cinema') }}</li>
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
                    <a href="{{ route('cinemas.create') }}" class="red-button">Add Cinema</a>
                  </div>
                </div>
              </div>
              <div class="datatable-new-outer">
                <div class="card">
                  <!-- /.card-header -->
                  <table id="cinema_list" class="table">
                    <thead>
                      <tr>
                        <th>{{ __('#') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Address') }}</th>
                        <th>{{ __('Geo Location') }}</th>
                        <th>{{ __('Seating Capacity') }}</th>
                        <th>{{ __('Action') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $i=1; @endphp
                      @if(!empty($data) && $data->count())
                        @foreach($data as $key => $cinema)
                          <tr>
                            @if( request()->page )
                              <td>{{ $data->currentPage() * $data->perPage() - $data->perPage() + $i++ }}</td>
                            @else
                              <td>{{ $i++}}</td>
                            @endif
                            <td>{{ $cinema->name }}</td>
                            <td>{{ $cinema->address }}</td>
                            <td>{{ $cinema->geo_lat_long }}</td>
                            <td>{{ $cinema->seating_capacity }}</td>
                            <td>
                              <form action="{{ route('cinemas.destroy',$cinema->id) }}" method="POST">  
                                <a class="btn btn-info btn-sm" href="{{ route('cinemas.show',$cinema->id) }}"><i class="fas fa-eye">
                                </i>Show Movies</a>
                                <a class="btn btn-info btn-sm" href="{{ route('cinemas.edit',$cinema->id) }}"><i class="fas fa-pencil-alt">
                                </i>Edit</a>
                                @csrf
                                @method('DELETE')
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
                </div>
                <!-- /.card-body -->

                {{-- Pagination --}}
                <div class="row">
                  <div class="col-12">
                    {{ $data->links('pagination::bootstrap-4') }}
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <!-- Delete Modal HTML -->
    <div id="deleteModal" class="modal fade">
      <div class="modal-dialog">
        <form method="post">
          @csrf
          @method('DELETE')
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">This action is not reversible.</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Are you sure you want to delete the record?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn bg-white" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger">Delete</button>
            </div>
          </div>
        </form>
        <!-- /.modal-content -->
      </div>
    </div>
  </div>
  <!-- /.content-wrapper -->

  @endsection

@section('script')
  <script>
    $('#deleteModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var action = button.data('action');
      var modal = $(this);
      modal.find('form').attr('action', action);
    });
  </script>
@endsection