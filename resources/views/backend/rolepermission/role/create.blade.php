@extends('backend.layouts.app')

@section('content')
<style>
    label {
	display: inline-block;
	text-transform: capitalize;
}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>{{ __('Role Create') }}</h3></div>
                <div class="col-md-12 m-auto">
                    <div class="card" style="padding: 30px;margin-top:50px">
                        <form action="{{ route('role.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Add New Role</label>
                                <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Role Name">
                                <br>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <br>
                            </div>
                             <div class="row">
                                    <div class="col-lg-3 mb-2">
                                            <h6>Permission</h6>
                                        </div>
                                    <div class="col-lg-9 mb-5">
                                        <div class="form-check">
                                            <input type="checkbox"  class="form-check-input" id="allCheck">
                                            <label class="form-check-label" for="allCheck">All</label>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                 <!-- user model function kore rakhchi ekhon  1st(permissions_group)-->
                                @php 
                                    $i=1;
                                @endphp
                                @foreach ($permissions_group as $group)
                                   <div class="row">
                                        <div class="col-lg-3 mb-2">
                                             <div class="form-check">
                                                <input type="checkbox" value="{{ $group->name}}"  class="form-check-input" id="{{ $i }}-management" onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox',this)">
                                                <label class="form-check-label" for="{{ $i }}-management">{{ $group->name }}</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-9 mb-5 role-{{ $i }}-management-checkbox">
                                        <!-- user model function kore rakhchi ekhon  2st(getPermissionGroupName)-->
                                        @php 
                                            $permission= App\Models\User::getPermissionGroupName($group->name);
                                            $j=1;
                                        @endphp
    
                                             @foreach ($permission as $permissions)
                                                <div class="form-check">
                                                    <input type="checkbox" value="{{ $permissions->name}}" name="permission_name[]" class="form-check-input" id="Checkpermission{{ $permissions->id }}"
                                                    onclick="checkSinglePermission('role-{{ $i }}-management-checkbox', '{{ $i }}-management', {{count($permission)}} )"
                                                    >
                                                    <label class="form-check-label" for="Checkpermission{{ $permissions->id }}">{{ $permissions->name }}</label>
                                                </div>
                                            @php 
                                               $j++;
                                            @endphp
                                            @endforeach
                                        </div>
                                   </div>
                                @php 
                                    $i++;
                                @endphp
                                @endforeach
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
    // All Check
    $("#allCheck").click(function() {
        if ($(this).is(':checked')) {
            $('input[type=checkbox]').prop('checked', true);
        } else {
            $('input[type=checkbox]').prop('checked', false); 
        }
        implementAllPermission();
    });
    // group check UnCheck
    function checkPermissionByGroup(className,CheckThis){
        const GroupIdName = $("#"+CheckThis.id);
        const ClassCheckBox = $("."+className+' input');
        if (GroupIdName.is(':checked')) {
            ClassCheckBox.prop('checked', true);
        } else {
            ClassCheckBox.prop('checked', false); 
        }
        implementAllPermission();
    }
        // group name er under a all permission check korle group name checked hobe auto checked hobe
    function checkSinglePermission(groupClassName,groupID,countAllPermission){
        const classCheckBox = $('.'+groupClassName+ ' input');
        const groupIDCheckBox = $("#"+groupID);

        if($('.'+groupClassName+ ' input:checked').length == countAllPermission){
            groupIDCheckBox.prop('checked', true);
        }else{
             groupIDCheckBox.prop('checked', false);
        }
        implementAllPermission();
        
    }

        function implementAllPermission(){
        // ei 2ta data controller theke pathichi (all_permission--permissions_group)
        const countPermissions = {{ count($all_permission)}};
        const countPermissionGroups = {{ count($permissions_group)}};
        if ($('input[type="checkbox"]:checked').length >= (countPermissions + countPermissionGroups)) {
            $('#allCheck').prop('checked', true);
        } else {
            $('#allCheck').prop('checked', false); 
        }
    }
</script>
@endsection

