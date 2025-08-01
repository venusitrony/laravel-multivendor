@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>{{ __('New User Create') }}</h3></div>
                <div class="col-md-12 m-auto">
                    <div class="card" style="padding: 30px;margin-top:50px">
                        @if(session('status'))
                          <p class="alert alert-success">{{ session('status') }}</p>
                        @endif
                        <form action="{{ route('user.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">UserName</label>
                                <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Role Name">
                              <br>
                            </div>
                            
                            <div class="form-group">
                              <label for="exampleInputEmail1">Email address</label>
                              <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                              <br>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" aria-describedby="password" placeholder="Enter password">
                                <br>
                            </div>

                            <div class="form-group">
                                <label for="role_id">Select Role</label>
                                   <select name="role_name[]" id="role_name" class="form-control select2" multiple>
                                   @foreach ($roles as $role)
                                       <option value="{{ $role->name }}"> {{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@section('javacontent')
   
<script>
     <!-- Initialize Select2 -->
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection