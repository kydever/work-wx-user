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
namespace KY\WorkWxUser\WeChat;

use KY\WorkWxUser\Exception\ApiException;

abstract class Api
{
    public function format(array $result): array
    {
        if ($result['errcode'] > 0) {
            throw new ApiException($result['errmsg'], $result['errcode']);
        }

        return $result;
    }
}
