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
namespace KY\WorkWxUser\Testing;

use KY\WorkWxUser\UserAuth;

class UserAuthMockery
{
    public static function mockToken(int $id): string
    {
        $userAuth = new UserAuth($id, $id . '_unit');
        $userAuth->save();

        return $userAuth->getToken();
    }
}
