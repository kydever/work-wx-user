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
namespace KY\WorkWxUser;

use EasyWeChat\Work\Application;
use KY\WorkWxUser\WeChat\WeChatFactory;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                Application::class => WeChatFactory::class,
            ],
            'annotations' => [
                'scan' => [
                    'paths' => [
                        __DIR__,
                    ],
                ],
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => '企业微信用户系统的配置',
                    'source' => __DIR__ . '/../publish/work_wx_user.php',
                    'destination' => BASE_PATH . '/config/autoload/work_wx_user.php',
                ],
            ],
        ];
    }
}
