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
namespace KY\WorkWxUser\WeChat;

use EasyWeChat\Work\Application;
use GuzzleHttp\RequestOptions;

class DepartmentWeChat
{
    public function __construct(protected Application $wx)
    {
    }

    public function departments(int $id): array
    {
        return $this->wx->getClient()->get('/cgi-bin/department/list', [
            RequestOptions::QUERY => [
                'id' => $id,
            ],
        ])->toArray();
    }
}
