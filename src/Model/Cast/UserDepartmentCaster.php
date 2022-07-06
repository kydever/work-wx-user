<?php

declare(strict_types=1);
/**
 * This file is part of KnowYourself.
 *
 * @link     https://www.zhiwotansuo.cn
 * @document https://github.com/kydever/work-wx-user/blob/main/README.md
 * @contact  l@hyperf.io
 * @license  https://github.com/kydever/work-wx-user/blob/main/LICENSE
 */
namespace KY\WorkWxUser\Model\Cast;

use Hyperf\Contract\CastsAttributes;
use Hyperf\Utils\Codec\Json;

class UserDepartmentCaster implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes): UserDepartments
    {
        $items = Json::decode($value);

        return new UserDepartments(UserDepartment::makeListFromArray($items));
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return Json::encode($value);
    }
}
