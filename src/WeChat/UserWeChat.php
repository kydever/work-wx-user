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
