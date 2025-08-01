@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header"><h3>{{ __('Add New User Create') }}</h3></div>
                    <a type="button" class="btn btn-primary" href="{{ route('user.create') }}">{{ __('User Create') }}</a>
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
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->roles->count() > 0)
                                        @foreach ($user->roles as $role)
                                            <span class="badge bg-info">{{ $role->name }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-danger">No Role Assigned</span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at }}</td>
                                <td>
                                    <a type="button" class="btn btn-success" href="{{ route('user.edit',$user->id) }}">{{ __('Edit') }}</a>
                                   
                                    <a class="btn btn-danger text-white"
                                          href="{{ route('user.destroy', $user->id) }}"
                                          onclick="event.preventDefault(); document.getElementById('delete-form-{{ $user->id }}').submit();">
                                          Delete
                                    </a>
                                       
                                    <form id="delete-form-{{ $user->id }}" 
                                             action="{{ route('user.destroy', $user->id) }}" 
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
