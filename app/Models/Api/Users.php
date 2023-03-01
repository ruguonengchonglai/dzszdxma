<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table='users';
    protected $primaryKey='id';
    protected $fillable = [
        'org_id',
        'user_name',
        'user_phone',
        'password',
        'department',
        'permission',
        'description'
    ];


    /**
     * @Notes: 获取用户详情
     * @Author: DoKi
     * @Date: 2020/1/2
     * @Time: 11:27
     * @Interface getUserInfoById
     * @param $user_id
     */
    public function getUserInfoById($user_id)
    {
        return $this->where('id',$user_id)->first()->toArray();
    }
}
