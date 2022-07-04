<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace HyperfTest\Cases\Model\Cast;

use KY\WorkWxUser\Model\Cast\UserDepartment;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
class UserDepartmentTest extends TestCase
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
