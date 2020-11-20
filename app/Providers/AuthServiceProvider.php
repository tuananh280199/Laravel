<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Category
        Gate::define('category-list', 'App\Policies\CategoryPolicy@view');
        Gate::define('category-create', 'App\Policies\CategoryPolicy@create');
        Gate::define('category-edit', 'App\Policies\CategoryPolicy@update');
        Gate::define('category-delete', 'App\Policies\CategoryPolicy@delete');
        //Menu
        Gate::define('menu-list', 'App\Policies\MenuPolicy@view');
        Gate::define('menu-create', 'App\Policies\MenuPolicy@create');
        Gate::define('menu-edit', 'App\Policies\MenuPolicy@update');
        Gate::define('menu-delete', 'App\Policies\MenuPolicy@delete');
        //Slider
        Gate::define('slider-list', 'App\Policies\SliderPolicy@view');
        Gate::define('slider-create', 'App\Policies\SliderPolicy@create');
        Gate::define('slider-edit', 'App\Policies\SliderPolicy@update');
        Gate::define('slider-delete', 'App\Policies\SliderPolicy@delete');
        //Product
        Gate::define('product-list', 'App\Policies\ProductPolicy@view');
        Gate::define('product-create', 'App\Policies\ProductPolicy@create');
        Gate::define('product-edit', 'App\Policies\ProductPolicy@update');
        Gate::define('product-delete', 'App\Policies\ProductPolicy@delete');
        //Setting
        Gate::define('setting-list', 'App\Policies\SettingPolicy@view');
        Gate::define('setting-create', 'App\Policies\SettingPolicy@create');
        Gate::define('setting-edit', 'App\Policies\SettingPolicy@update');
        Gate::define('setting-delete', 'App\Policies\SettingPolicy@delete');
        //User
        Gate::define('user-list', 'App\Policies\UserPolicy@view');
        Gate::define('user-create', 'App\Policies\UserPolicy@create');
        Gate::define('user-edit', 'App\Policies\UserPolicy@update');
        Gate::define('user-delete', 'App\Policies\UserPolicy@delete');
        //Role
        Gate::define('role-list', 'App\Policies\RolePolicy@view');
        Gate::define('role-create', 'App\Policies\RolePolicy@create');
        Gate::define('role-edit', 'App\Policies\RolePolicy@update');
        Gate::define('role-delete', 'App\Policies\RolePolicy@delete');
        //Permission
        Gate::define('permission-list', 'App\Policies\PermissionPolicy@view');
        Gate::define('permission-create', 'App\Policies\PermissionPolicy@create');
        Gate::define('permission-edit', 'App\Policies\PermissionPolicy@update');
        Gate::define('permission-delete', 'App\Policies\PermissionPolicy@delete');
        //Order
        Gate::define('order-list', 'App\Policies\OrderPolicy@view');
        Gate::define('order-detail', 'App\Policies\OrderPolicy@update');
    }
}
