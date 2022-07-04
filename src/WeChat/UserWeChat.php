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
use Han\Utils\Service;
use Hyperf\Di\Annotation\Inject;

class UserWeChat extends Service
{
    #[Inject]
    protected Application $wx;

    public function infoByUserid(string $userid): array
    {
        $res = $this->wx->getClient()->get('/cgi-bin/user/get', [
            RequestOptions::QUERY => [
                'userid' => $userid,
            ],
        ])->toArray();

        return [
            'name' => $res['name'],
            'userid' => $res['userid'],
            'mobile' => $res['mobile'],
            'email' => $res['biz_mail'],
            'avatar_url' => $res['thumb_avatar'],
        ];
    }

    public function getUserInfo(string $code): array
    {
        $user = $this->wx->getOAuth()->userFromCode($code);

        return $this->infoByUserid($user->getId());
    }
}
