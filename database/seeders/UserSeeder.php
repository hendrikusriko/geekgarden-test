<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // reset cahced roles and permission
         app()[PermissionRegistrar::class]->forgetCachedPermissions();

         // create permissions
         Permission::create(['name' => 'index product']);
         Permission::create(['name' => 'create product']);
         Permission::create(['name' => 'update product']);
         Permission::create(['name' => 'delete product']);

         Permission::create(['name' => 'listCart cart']);
         Permission::create(['name' => 'addToCart cart']);

         Permission::create(['name' => 'checkout order']);
         Permission::create(['name' => 'index order']);
         Permission::create(['name' => 'myOrder order']);
 
         //create roles and assign existing permissions
         $userRole = Role::create(['name' => 'user']);
         $userRole->givePermissionTo('index product');
         $userRole->givePermissionTo('listCart cart');
         $userRole->givePermissionTo('addToCart cart');
         $userRole->givePermissionTo('checkout order');
         $userRole->givePermissionTo('myOrder order');
 
         $adminRole = Role::create(['name' => 'admin']);
         $adminRole->givePermissionTo('index product');
         $adminRole->givePermissionTo('create product');
         $adminRole->givePermissionTo('update product');
         $adminRole->givePermissionTo('delete product');
         $adminRole->givePermissionTo('index order');
 
 
         // create demo users
         $user = User::factory()->create([
             'name' => 'Example user',
             'email' => 'user@user.user',
             'password' => bcrypt('user123')
         ]);
         $user->assignRole($userRole);
 
         $user = User::factory()->create([
             'name' => 'Example admin user',
             'email' => 'admin@admin.admin',
             'password' => bcrypt('admin123')
         ]);
         $user->assignRole($adminRole);
 
    }
}
