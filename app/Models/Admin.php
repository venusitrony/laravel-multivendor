<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use DB;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

    protected $guard_name = 'admin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];




    public static function getGroupPermission(){
        $GetGroup_permissions=DB::table('permissions')
            ->select('group_name as name')
            ->groupBy('group_name')
            ->orderByRaw("FIELD(group_name, 'dashboard', 'user', 'role', 'profile', 'blog')")
            ->get();
        return $GetGroup_permissions;

    }
    public static function getPermissionGroupName($group_name){
        $Permissions_Name=DB::table('permissions')
            ->select('name','id')
            ->where('group_name',$group_name)
            ->get();
        return $Permissions_Name;

    }

    public static function roleHasPermissions($role,$permission){

        $HasPermissions=true;
        foreach ($permission as  $permissions) {
            if(!$role->hasPermissionTo($permissions->name)){
                $HasPermissions=false;
                return $HasPermissions;
            }
        };
        return $HasPermissions;

    }
}
