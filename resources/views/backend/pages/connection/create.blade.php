@extends('backend.layouts.master')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Create connection</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('connection.index')}}">connection list</a></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Connection</h3>

        <div class="card-tools">
        </div>
      </div>
      <div class="card-body">
        <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12">
                  
      
                  <div class="card">
            
                    <!-- /.card-header -->
                    <div class="card-body">
                    
                      <form action="{{ route('connection.store') }}" method="POST" autocomplete="off">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="connection_id">Connection ID</label>
                                <input type="text" class="form-control" id="connection_id" name="connection_id" placeholder="Enter connection id">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                              <label for="amount">amount</label>
                              <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter amount">
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6 col-sm-12">
                              <label for="product">Line speed</label>
                              <select name="product_id" id="product" class="form-control">
                                <option value="">Select</option>
                                @foreach ($products as $data)
                                <option value="{{$data->id}}">{{$data->name}}</option>
                                @endforeach
                              </select>
                          </div>
                          <div class="form-group col-md-6 col-sm-12">
                            <label for="subscriber">Subscriber</label>
                            <select name="subscriber_id" id="subscriber" class="form-control">
                              <option value="">Select</option>
                              @foreach ($subscribers as $data)
                              <option value="{{$data->id}}">{{$data->name}}</option>
                              @endforeach
                            </select>
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="form-group col-md-12 col-sm-12">
                            <label for="bill_address">Bill address</label>
                            <input type="text" class="form-control" id="bill_address" name="bill_address" placeholder="Enter bill address">
                        </div>
                    </div>
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4 form-control">Save</button>
                    </form>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
          </section>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: "classic"
        });
    })
</script>

@endpush