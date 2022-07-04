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
use Han\Utils\Service;
use Hyperf\Di\Annotation\Inject;

class WeChat extends Service
{
    #[Inject]
    protected Application $wx;

    public function authorize(string $url, string $state): string
    {
        return sprintf(
            'https://open.work.weixin.qq.com/wwopen/sso/qrConnect?appid=%s&agentid=%s&redirect_uri=%s&state=%s',
            $this->wx->getAccount()->getCorpId(),
            get_agent_id(),
            $url,
            $state
        );
    }
}
