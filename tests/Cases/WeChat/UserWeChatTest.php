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
namespace HyperfTest\Cases\WeChat;

use EasyWeChat\Work\Application;
use HyperfTest\Cases\AbstractTestCase;
use HyperfTest\Stub\ContainerStub;
use KY\WorkWxUser\Translator\UserTranslator;
use KY\WorkWxUser\WeChat\UserWeChat;

/**
 * @internal
 * @coversNothing
 */
class UserWeChatTest extends AbstractTestCase
{
    public function testInfoByUserid()
    {
        $service = $this->getService();

        $res = $service->infoByUserid($this->getStub()['userid']);

        $this->assertSame('ok', $res['errmsg']);
    }

    public function testTranslateToUser()
    {
        $service = $this->getService();

        $res = $service->infoByUserid($this->getStub()['userid']);

        $user = (new UserTranslator())->translate($res);

        $this->assertSame(true, $user->departments->list[0]->isLeader);
    }

    protected function getService()
    {
        $container = ContainerStub::mockContainer();

        return new UserWeChat($container->get(Application::class));
    }
}
