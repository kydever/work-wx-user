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
namespace KY\WorkWxUser\Command;

use Hyperf\Command\Annotation\Command;
use Hyperf\Command\Command as BaseCommand;
use Hyperf\Utils\Filesystem\Filesystem;
use Psr\Container\ContainerInterface;
use Symfony\Component\Finder\Finder;

#[Command]
class SyncMigrationCommand extends BaseCommand
{
    public function __construct(private ContainerInterface $container)
    {
        parent::__construct('sync:work-wx-migrations');
        $this->setDescription('同步所需的迁移文件到项目中');
    }

    public function handle()
    {
        $dir = BASE_PATH . '/vendor/kydev/work-wx-user/migrations';

        $finder = Finder::create()->in($dir)->name('*.php');
        $fs = $this->container->get(Filesystem::class);
        $target = BASE_PATH . '/migrations/';

        $fs->makeDirectory($target, force: true);

        foreach ($finder as $item) {
            $fs->copy(
                $item->getRealPath(),
                $target . '/' . $item->getFilename()
            );
        }
    }
}
