<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Rony
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Rony
        $RonySuperAdmin = Role::create(['name'=>'Superadmin','guard_name'=>'admin']);

        $admin = new Admin();
        $admin->name     = 'Superadmin';
        $admin->username     = 'SuperAdmin';
        $admin->email    = 'superadmin@gmail.com';
        $admin->password = Hash::make('11111111');
        $admin->save();
        $permissions = [

            [
                'group_name'=>'deshbord',
                'permission'=>[
                    'dashboard-view',
                ],
            ],
            [
                'group_name'=>'user',
                'permission'=>[
                    'user-list',
                    'user-create',
                    'user-edit',
                    'user-show',
                    'user-delete',
                ],
            ],
            [
                'group_name'=>'role',
                'permission'=>[
                    'role-list',
                    'role-create',
                    'role-edit',
                    'role-show',
                    'role-delete',
                ],
            ],
            [
                'group_name'=>'profile',
                'permission'=>[
                    'profile-edit',
                    'profile-delete'
                ],
            ],
               [
                'group_name'=>'blog',
                'permission'=>[
                    'blog-edit',
                    'blog-show',
                    'blog-delete'
               
                ],
            ],

            
        ];

        for ($i=0; $i < count($permissions); $i++) {

           $permissionGroupName=$permissions[$i]['group_name'];


           for ($j=0; $j < count($permissions[$i]['permission']); $j++) {

                $permission = Permission::create(['name' => $permissions[$i]['permission'][$j],'group_name' => $permissionGroupName ,'guard_name' => 'admin']);
                $RonySuperAdmin->givePermissionTo($permission);
                $permission->assignRole($RonySuperAdmin);
           }

         
        }
    }
}
