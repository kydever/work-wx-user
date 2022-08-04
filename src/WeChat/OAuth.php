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

use Han\Utils\Service;
use Hyperf\Engine\Channel;
use Hyperf\Engine\Http\Server;
use Psr\Http\Message\ServerRequestInterface;

use function KY\WorkWxUser\di;

class OAuth extends Service
{
    public function localOAuth(string $localhost, int $port = 55274): string
    {
        $chan = new Channel(1);
        $server = new Server($this->logger);
        go(function () use ($server, $chan, $localhost, $port) {
            try {
                $server->bind('0.0.0.0', $port);

                $server->handle(static function (ServerRequestInterface $request) use ($chan) {
                    $chan->push($request->getQueryParams()['code'] ?? '');
                });

                $url = di()->get(WeChat::class)->authorize(sprintf('http://%s:%d/', $localhost, $port), '');

                echo 'Please click the url below and login' . PHP_EOL;
                echo $url . PHP_EOL;

                $server->start();
            } catch (\Throwable $exception) {
                echo $exception . PHP_EOL;
                $chan->push('');
            }
        });

        $token = $chan->pop(-1);
        $server->close();

        return $token;
    }
}
