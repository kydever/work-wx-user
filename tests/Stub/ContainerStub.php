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
namespace HyperfTest\Stub;

use EasyWeChat\Work\Application;
use Hyperf\Config\Config;
use Hyperf\Contract\ConfigInterface;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Utils\ApplicationContext;
use Hyperf\Utils\Codec\Json;
use KY\WorkWxUser\WeChat\WeChatFactory;
use Psr\Container\ContainerInterface;

class ContainerStub
{
    public static function mockContainer(): ContainerInterface
    {
        $container = \Mockery::mock(ContainerInterface::class);
        $container->shouldReceive('get')->with(ConfigInterface::class)->andReturnUsing(function () {
            $file = BASE_PATH . '/.env.json';
            if (file_exists($file)) {
                $data = Json::decode(file_get_contents($file));
                return new Config([
                    'work_wx_user' => $data,
                ]);
            }

            return new Config([]);
        });

        $container->shouldReceive('get')->with(RequestInterface::class)->andReturn(\Mockery::mock(RequestInterface::class));
        $container->shouldReceive('get')->with(Application::class)->andReturn((new WeChatFactory())($container));

        ApplicationContext::setContainer($container);

        return $container;
    }
}
