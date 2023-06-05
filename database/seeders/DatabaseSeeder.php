<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Admin\Entities\Admin;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
       $admin =  Admin::create([
            'name'=>'حذيفة',
            'password'=>'$2y$10$wThpDjhfnw74Z5qXUXCQxe9bwQS/gbX.dRVk0upn6V5WGS426hJLa',
            'email'=>"creola73@example.org",
            'last_login_at'=>now(),
        ]);

        foreach(config('admin_permissions') as $key=>$permissions)
        {
            foreach($permissions as $permission){


                Permission::create([
                    'name'=>$permission." ".$key,
                    'guard_name'=>'admin'

                ]);
            }
        }
        $admin->givePermissionTo('جميع الصلاحيات super_admin');
    }

}
