@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header"><h3>{{ __('Role') }}</h3></div>
                    <a type="button" class="btn btn-primary" href="{{ route('role.create') }}">{{ __('Role Create') }}</a>
                    @include('backend.partials.message.success')
                    @include('backend.partials.message.error')
                    @if(session('status'))
                          <p class="alert alert-danger">{{ session('status') }}</p>
                    @endif
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Permission</th>
                        <th scope="col">Created</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @foreach ($role->permissions as $permission)
                                         <span class="badge bg-info">{{ $permission->name }}</span>
                                    @endforeach
                                </td>
                                <td>{{ $role->created_at }}</td>
                                <td>
                                    @can('role-edit') 
                                    <a type="button" class="btn btn-success" href="{{ route('role.edit',$role->id) }}">{{ __('Edit') }}</a>
                                    @endcan
                                   
                                        <a class="btn btn-danger text-white"
                                              href="{{ route('role.destroy', $role->id) }}"
                                              onclick="event.preventDefault(); document.getElementById('delete-form-{{ $role->id }}').submit();">
                                              Delete
                                        </a>
                                           
                                        <form id="delete-form-{{ $role->id }}" 
                                                 action="{{ route('role.destroy', $role->id) }}" 
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
