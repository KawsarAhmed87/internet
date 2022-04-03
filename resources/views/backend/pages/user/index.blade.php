@php $admin = Auth::guard()->user(); @endphp
@extends('backend.layouts.master')

@push('css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset("")}}backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset("")}}backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endpush
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>User list</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('user.create')}}">Create user</a></li>
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
        <h3 class="card-title">All user list table</h3>

        <div class="card-tools">
        </div>
      </div>
      <div class="card-body">
        <table id="example1"  class="table table-bordered table-striped">
            <thead class="bg-light text-capitalize">
                <tr>
                    <th width="10%">Sl</th>
                    <th width="20%">Name</th>
                    <th width="20%">Email</th>
                    <th width="30%">Roles</th>
                    <th width="20%">Action</th>
                </tr>
            </thead>
            <tbody>
               @foreach ($users as $user)
               <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @foreach ($user->roles as $role)
                            <span class="badge badge-info mr-1">
                                {{ $role->name }}
                            </span>
                        @endforeach
                    </td>
                    <td>
                      @if ($admin->can('user.edit'))
                        <a class="btn btn-success text-white" href="{{ route('user.edit', $user->id) }}">Edit</a>
                        @endif
                        @if ($admin->can('user.delete'))
                        <button type="button" class="btn btn-danger text-white" href=""
                        onclick="deleteItem({{ $user->id }})">
                            Delete
                        </button>
                        <form id="delete-form-{{ $user->id }}" action="{{ route('user.destroy', $user->id) }}" method="POST" style="display: none;">
                            @method('DELETE')
                            @csrf
                        </form>
                        @endif
                    </td>
                </tr>
               @endforeach
            </tbody>
            <tfoot>
                <tr>
                  <th>Sl</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Roles</th>
                  <th>Action</th>
              </tr>
              </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
@endsection

@push('scripts')
{{-- sweet alert --}}
<script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset("")}}backend/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset("")}}backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset("")}}backend/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset("")}}backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script>
    $(function () {
      $('#example1').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });

    function deleteItem(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-danger',
                cancelButtonClass: 'btn btn-success',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } 
            })
        }

  </script>
@endpush