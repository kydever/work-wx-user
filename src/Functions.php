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
namespace KY\WorkWxUser;

use Hyperf\Utils\ApplicationContext;

function di(?string $id = null)
{
    $container = ApplicationContext::getContainer();
    if ($id) {
        return $container->get($id);
    }

    return $container;
}

/**
 * 读取用户ID.
 */
function get_user_id(bool $build = true): int
{
    $userAuth = UserAuth::get();
    if ($build) {
        $userAuth->build();
    }
    return $userAuth->getId();
}
