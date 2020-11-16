<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id')->withTimestamps();
    }

    public function checkPermissionAccess($keyCodePermissionCheck)
    {
        //B1: lấy tất cả quyền của user login vào 
        //B2: so sánh giá trị đưa vào của route hiện tại xem có tồn tại trong các quyền mình lấy đc hay ko?
        $roles = auth()->user()->roles; //lấy vai trò của user login
        foreach ($roles as $role) {
            $permissions = $role->permissions; //lấy quyền của từng vai trò
            if ($permissions->contains('key_code', $keyCodePermissionCheck)) //check xem có đc quyền truy cập vào permission này ko
            {
                return true; //đc phép truy cập
            }
        }
        return false; //ko đc phép truy cập
    }
}
