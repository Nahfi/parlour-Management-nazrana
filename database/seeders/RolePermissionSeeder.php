<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create roles
        $roleSuperAdmin = Role::create(['name' => 'SuperAdmin','guard_name' => 'admin']);
        //permission list for admin  as array
        $permissions = [

            [
                //dashboard permission
                'group_name' => 'dashboard',
                'permissions' => [
                    'dashboard.index',
                    'dashboard.report.index',
                ]
            ],
            [
                //admin permission
                'group_name' => 'admin',
                'permissions' => [
                    'admin.index',
                    'admin.create',
                    'admin.store',
                    'admin.edit',
                    'admin.update',
                    'admin.destroy',
                ]
            ],
            [
                //role permission
                'group_name' => 'role',
                'permissions' => [
                    'role.index',
                    'role.create',
                    'role.store',
                    'role.edit',
                    'role.update',
                    'role.destroy',
                ]
            ],

            [
                //general settings permission
                'group_name' => 'settings',
                'permissions' => [
                    'generalSettings.index',
                    'generalSettings.update',
                ]
            ],

            [
                //config settings permission
                'group_name' => 'settings',
                'permissions' => [
                    'configSettings.index',
                    'configSettings.optimizeClear',
                    'configSettings.optimize',
                ]
            ],


            [
                //profile permission
                'group_name' => 'profile',
                'permissions' => [
                    'profile.edit',
                    'profile.update',
                    'profile.passwordChange'
                ]
            ],

            [
                //expense category settings permission
                'group_name' => 'expenseCategory',
                'permissions' => [
                    'expense.category.index',
                    'expense.category.store',
                    'expense.category.edit',
                    'expense.category.delete',
                    'expense.category.parmanentDelete',
                ]
            ],
            [
                //expense  settings permission
                'group_name' => 'expense',
                'permissions' => [
                    'expense.index',
                    'expense.store',
                    'expense.edit',
                    'expense.delete',
                    'expense.parmanentDelete',
                ]
            ],
            [
                //customer  permission
                'group_name' => 'customer',
                'permissions' => [
                    'customer.index',
                    'customer.store',
                    'customer.edit',
                    'customer.delete',
                    'customer.parmanentDelete',
                ]

            ],
            [
                //package permission
                'group_name' => 'employee',
                'permissions' => [
                    'employee.index',
                    'employee.store',
                    'employee.edit',
                    'employee.delete',
                    'employee.parmanentDelete',
                ]

            ],
            [
                //product brand settings permission
                'group_name' => 'productBrand',
                'permissions' => [
                    'product.brand.index',
                    'product.brand.store',
                    'product.brand.edit',
                    'product.brand.delete',
                    'product.brand.parmanentDelete',
                ]
            ],

            [
                //product category settings permission
                'group_name' => 'productCategory',
                'permissions' => [
                    'product.category.index',
                    'product.category.store',
                    'product.category.edit',
                    'product.category.delete',
                    'product.category.parmanentDelete',
                ]
            ],
            [
                //product  settings permission
                'group_name' => 'product',
                'permissions' => [
                    'product.index',
                    'product.store',
                    'product.edit',
                    'product.delete',
                    'product.parmanentDelete',
                ]
            ] ,
            [
                //package permission
                'group_name' => 'package',
                'permissions' => [
                    'package.index',
                    'package.store',
                    'package.edit',
                    'package.delete',
                    'package.parmanentDelete',
                ]

            ],
            [
                //working day permission
                'group_name' => 'workingDay',
                'permissions' =>[
                    'workingDay.index',
                    'workingDay.create',
                    'workingDay.update',
                    'workingDay.delete'
                ]
            ]
            ,
            [
                //Attendance Request permission
                'group_name' => 'attendanceRequest',
                'permissions' => [
                    'attendanceRequest.index',
                    'attendanceRequest.update',
                ]
            ],
            [
                //invoice permission
                'group_name' => 'invoice',
                'permissions' => [
                    'invoice.index',
                    'invoice.create',
                    'invoice.showAll',
                    'invoice.editInformation',
                    'invoice.editRatings',
                    'invoice.update',
                    'invoice.delete',
                    'invoice.parmanentDelete',
                ]
            ],
            [
                //stock  permission
                'group_name' => 'report',
                'permissions' => [
                    'report.index',
                ]
            ],
            [
                //sallary permission
                'group_name' => 'sallary',
                'permissions' => [
                    'salary.index',
                    'salary.update',
                ]
            ],

            [
                //bookng permission
                'group_name' => 'booking',
                'permissions' => [
                    'booking.index',
                    'booking.create',
                    'booking.edit',
                    'booking.delete',

                ]
            ]
        ];

        //asign permisions
        for($i = 0; $i<count($permissions); $i++){
            $permissionGroup = $permissions[$i]['group_name'];

            for($j = 0; $j<count($permissions[$i]['permissions']); $j++){
                //create permission
                $permission = Permission::create([
                    'name' => $permissions[$i]['permissions'][$j],
                    'group_name' => $permissionGroup,
                    'guard_name' => 'admin'
                ]);

                //assign permission to role
                $roleSuperAdmin->givePermissionTo($permission);
                $permission->assignRole($roleSuperAdmin);
            }
        }

    }
}