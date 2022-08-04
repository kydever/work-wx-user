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

use EasyWeChat\Work\Application;
use Han\Utils\Service;
use Psr\Container\ContainerInterface;

class WeChat extends Service
{
    protected Application $wx;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        $this->wx = $container->get(Application::class);
    }

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
