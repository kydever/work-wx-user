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
use HyperfTest\Stub\ContainerStub;
use KY\WorkWxUser\WeChat\OAuth;
use KY\WorkWxUser\WeChat\WeChat;

! defined('BASE_PATH') && define('BASE_PATH', dirname(__DIR__, 1));

require_once dirname(dirname(__FILE__)) . '/vendor/autoload.php';

$container = ContainerStub::mockContainer();
$container->shouldReceive('get')->with(WeChat::class)->andReturn(new WeChat($container));

$oauth = new OAuth($container);

var_dump($code = $oauth->localOAuth());
