@extends('backend.layouts.master')

@push('css')

@endpush
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Create subscriber</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('subscriber.index')}}">Subscriber list</a></li>
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
        <h3 class="card-title">Subscription form</h3>

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
                    
                      <form action="{{ route('subscriber.store') }}" method="POST" autocomplete="off">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Name<span class="required"> *</span></label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email">Email<span class="required"> *</span></label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
                            </div>
                        </div>
      
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="phone1">Phone 1<span class="required"> *</span></label>
                                <input type="text" class="form-control" id="phone1" name="phone1" placeholder="Enter phone 1">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                              <label for="phone2">Phone 2</label>
                              <input type="text" class="form-control" id="phone2" name="phone2" placeholder="Enter phone 2">
                            </div>
                        </div>

                        <div class="form-row">
                          <div class="form-group col-md-6 col-sm-12">
                              <label for="nid">NID</label>
                              <input type="text" class="form-control" id="nid" name="nid" placeholder="Enter NID">
                          </div>
                          <div class="form-group col-md-6 col-sm-12">
                            <label for="address">Address<span class="required"> *</span></label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter address">
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

@endpush