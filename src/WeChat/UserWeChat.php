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

class UserWeChat
{
    public function __construct(protected Application $wx)
    {
    }

    public function infoByUserid(string $userid): array
    {
        return $this->wx->getClient()->get('/cgi-bin/user/get', [
            RequestOptions::QUERY => [
                'userid' => $userid,
            ],
        ])->toArray();
    }

    public function listByDepartmentId(int $departmentId, bool $fetchChild = false): array
    {
        return $this->wx->getClient()->get('/cgi-bin/user/list', [
            RequestOptions::QUERY => [
                'department_id' => $departmentId,
                'fetch_child' => (int) $fetchChild,
            ],
        ])->toArray();
    }

    public function getUserInfo(string $code): array
    {
        $user = $this->wx->getOAuth()->userFromCode($code);

        return $this->infoByUserid($user->getId());
    }
}
