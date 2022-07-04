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
