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
namespace KY\WorkWxUser\Dao;

use Han\Utils\Service;
use KY\WorkWxUser\Model\User;

class UserDao extends Service
{
    public function firstByUserid(string $userid): ?User
    {
        return User::query()->where('userid', $userid)->first();
    }
}
