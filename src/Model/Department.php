<?php

declare(strict_types=1);
/**
 * This file is part of KnowYourself.
 *
 * @link     https://www.zhiwotansuo.com
 * @document https://github.com/kydever/work-wx-user/blob/main/README.md
 * @contact  l@hyperf.io
 * @license  https://github.com/kydever/work-wx-user/blob/main/LICENSE
 */
namespace KY\WorkWxUser\Model;

/**
 * @property int $id
 * @property string $name
 * @property int $parent_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Department extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'departments';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['id', 'name', 'parent_id', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'parent_id' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
