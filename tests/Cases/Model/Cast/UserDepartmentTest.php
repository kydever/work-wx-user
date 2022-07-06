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
namespace HyperfTest\Cases\Model\Cast;

use HyperfTest\Cases\AbstractTestCase;
use KY\WorkWxUser\Model\Cast\UserDepartment;

/**
 * @internal
 * @coversNothing
 */
class UserDepartmentTest extends AbstractTestCase
{
    public function testJsonEncodeAndDecode()
    {
        $list = UserDepartment::makeListFromArray([['id' => 1, 'is_leader' => true], ['id' => 2, 'is_leader' => false]]);

        $this->assertSame(1, $list[0]->id);
        $this->assertSame(true, $list[0]->isLeader);

        $this->assertSame(2, $list[1]->id);
        $this->assertSame(false, $list[1]->isLeader);
    }
}
