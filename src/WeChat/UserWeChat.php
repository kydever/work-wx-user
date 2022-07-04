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
use JetBrains\PhpStorm\ArrayShape;

class UserWeChat
{
    public function __construct(protected Application $wx)
    {
    }

    #[ArrayShape(['userid' => ''])]
    public function infoByUserid(string $userid): array
    {
        return $this->wx->getClient()->get('/cgi-bin/user/get', [
            RequestOptions::QUERY => [
                'userid' => $userid,
            ],
        ])->toArray();
    }

    public function getUserInfo(string $code): array
    {
        $user = $this->wx->getOAuth()->userFromCode($code);

        return $this->infoByUserid($user->getId());
    }
}
