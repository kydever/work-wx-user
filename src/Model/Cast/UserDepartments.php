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
