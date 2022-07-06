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

use Hyperf\Contract\ConfigInterface;
use function KY\WorkWxUser\di;

function get_agent_id(): int
{
    return (int) di()->get(ConfigInterface::class)->get('work_wx_user.agent_id', 0);
}
