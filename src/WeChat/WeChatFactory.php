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
use EasyWeChat\Work\Message;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Utils\Codec\Json;
use Psr\Container\ContainerInterface;

class WeChatFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get(ConfigInterface::class)->get('work_wx_user', []);

        return tap(new Application($config), static function (Application $application) use ($container) {
            $application->setRequest($container->get(RequestInterface::class));
            $application->getServer()->with(function (Message $message, \Closure $next) use ($container) {
                $container->get(StdoutLoggerInterface::class)->info(Json::encode($message->toArray()));
                return $next($message);
            });
        });
    }
}
