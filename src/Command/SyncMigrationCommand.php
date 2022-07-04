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
namespace KY\WorkWxUser\Command;

use Hyperf\Command\Annotation\Command;
use Hyperf\Command\Command as BaseCommand;

#[Command]
class SyncMigrationCommand extends BaseCommand
{
    public function __construct()
    {
        parent::__construct('sync:work-wx-migrations');
        $this->setDescription('同步所需的迁移文件到项目中');
    }

    public function handle()
    {
        
    }
}
