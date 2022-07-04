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
namespace KY\WorkWxUser\WeChat;

use Hyperf\Contract\ConfigInterface;
use function KY\WorkWxUser\di;

function get_agent_id(): int
{
    return (int) di()->get(ConfigInterface::class)->get('work_wx_user.agent_id', 0);
}
