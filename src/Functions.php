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
use KY\WorkWxUser\Model\User;

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

/**
 * 读取用户模型.
 * 需要提前使用 UserAuth::get()->check() 进行模型赋值.
 */
function get_user(): ?User
{
    return UserAuth::get()->getUser();
}
