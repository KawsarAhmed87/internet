@extends('backend.layouts.master')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Employee</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('employee.index')}}">Employee list</a></li>
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
        <h3 class="card-title">Employee info</h3>

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

                            <div class="form-row">
                              <div class="form-group col-md-6 col-sm-12">
                                  <label for="name">Name<span class="required"> *</span></label>
                                  <input type="text" class="form-control" id="name" name="name" value="{{$employee->name}}" disabled>
                              </div>
                              <div class="form-group col-md-6 col-sm-12">
                                  <label for="email">Email<span class="required"> *</span></label>
                                  <input type="text" class="form-control" id="email" name="email" value="{{$employee->email}}" disabled>
                              </div>
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="office_id">Office ID<span class="required"> *</span></label>
                                <input type="text" class="form-control" id="office_id" name="office_id" value="{{$employee->office_id}}" disabled>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                              <label for="designation">Designation</label>
                              <input type="text" class="form-control" id="designation" name="designation" value="{{$employee->designation}}" disabled>
                            </div>
                        </div>

                          <div class="form-row">
                              <div class="form-group col-md-6 col-sm-12">
                                  <label for="phone1">Phone 1<span class="required"> *</span></label>
                                  <input type="text" class="form-control" id="phone1" name="phone1" value="{{$employee->phone1}}" disabled>
                              </div>
                              <div class="form-group col-md-6 col-sm-12">
                                <label for="phone2">Phone 2</label>
                                <input type="text" class="form-control" id="phone2" name="phone2" value="{{$employee->phone2}}" disabled>
                              </div>
                          </div>
  
                          <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="nid">NID</label>
                                <input type="text" class="form-control" id="nid" name="nid" value="{{$employee->nid}}" disabled>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                              <label for="address">Address<span class="required"> *</span></label>
                              <input type="text" class="form-control" id="address" name="address" value="{{$employee->address}}" disabled>
                            </div>
                        </div>
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