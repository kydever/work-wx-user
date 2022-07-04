<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace KY\WorkWxUser\Model;

use KY\WorkWxUser\Model\Cast\UserDepartmentCaster;

/**
 * @property int $id
 * @property string $userid 企业微信用户ID
 * @property string $name 用户昵称
 * @property string $alias 用户别名
 * @property string $position 职位
 * @property string $mobile 手机号
 * @property string $email 邮箱
 * @property string $avatar 头像
 * @property int $status 状态
 * @property int $enable 是否可用
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \KY\WorkWxUser\Model\Cast\UserDepartments $departments 部门列表
 */
class User extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'users';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['id', 'userid', 'name', 'alias', 'position', 'departments', 'mobile', 'email', 'avatar', 'status', 'enable', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['departments' => UserDepartmentCaster::class, 'id' => 'integer', 'status' => 'integer', 'enable' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
