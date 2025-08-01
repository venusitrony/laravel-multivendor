@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header"><h3>{{ __('Add New Admin Create') }}</h3></div>
                    <a type="button" class="btn btn-primary" href="{{ route('admin.create') }}">{{ __('Admin Create') }}</a>
                    @include('backend.partials.message.success')
                    @if(session('status'))
                        <p class="alert alert-danger">{{ session('status') }}</p>
                    @endif
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Roles</th>
                        <th scope="col">Created</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $admin)
                            <tr>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>
                                    @if($admin->roles->count() > 0)
                                        @foreach ($admin->roles as $role)
                                            <span class="badge bg-info">{{ $role->name }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-danger">No Role Assigned</span>
                                    @endif
                                </td>
                                <td>{{ $admin->created_at }}</td>
                                <td>
                                    <a type="button" class="btn btn-success" href="{{ route('admin.edit',$admin->id) }}">{{ __('Edit') }}</a>
                                   
                                    <a class="btn btn-danger text-white"
                                          href="{{ route('admin.destroy', $admin->id) }}"
                                          onclick="event.preventDefault(); document.getElementById('delete-form-{{ $admin->id }}').submit();">
                                          Delete
                                    </a>
                                       
                                    <form id="delete-form-{{ $admin->id }}" 
                                             action="{{ route('admin.destroy', $admin->id) }}" 
                                             method="POST">
                                           @method('DELETE')
                                           @csrf
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $('#dataTable').DataTable();
    $(document).ready(function(){
          $(".alert").delay(5000).slideUp(300);
    });
    $(document).ready(function() {
        jQuery('.alert-auto-hide').fadeTo(7500, 500, function() {
            $(this).slideUp('slow', function() {
                $(this).remove();
            });
        });
    });
</script>
@endsection
