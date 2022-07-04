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

class UserDepartments implements \JsonSerializable
{
    /**
     * @param UserDepartment[] $list
     */
    public function __construct(public array $list)
    {
    }

    public function jsonSerialize(): mixed
    {
        return $this->list;
    }
}
