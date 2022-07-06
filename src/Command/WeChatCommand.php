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
namespace KY\WorkWxUser\Command;

use Hyperf\Command\Annotation\Command;
use Hyperf\Command\Command as HyperfCommand;
use KY\WorkWxUser\UserService;
use KY\WorkWxUser\WeChat\DepartmentWeChat;
use KY\WorkWxUser\WeChat\UserWeChat;
use Psr\Container\ContainerInterface;

#[Command]
class WeChatCommand extends HyperfCommand
{
    public function __construct(protected ContainerInterface $container)
    {
        parent::__construct('work:wx:exec');
    }

    public function configure()
    {
        parent::configure();
        $this->setDescription('企业微信API命令');
    }

    public function handle()
    {
        while (true) {
            $choice = $this->choice('请选择', [
                '查看所有部门',
                '查看部门下的员工',
                '查看员工信息',
                '同步所有员工信息到数据库',
                '退出',
            ]);

            $isBreak = match ($choice) {
                '查看所有部门' => $this->departments(),
                '查看部门下的员工' => $this->users(),
                '查看员工信息' => $this->userInfo(),
                '同步所有员工信息到数据库' => $this->sync(),
                default => true,
            };

            if ($isBreak) {
                break;
            }
        }
    }

    public function sync(): bool
    {
        $this->container->get(UserService::class)->syncToDatabase();

        $this->output->writeln('用户信息同步完成');

        return false;
    }

    public function userInfo(): bool
    {
        $id = $this->ask('请输入用户 ID', 'n');
        if ($id && $id != 'n') {
            $res = $this->container->get(UserWeChat::class)->infoByUserid($id);
            $result = [
                'ID: ' . $res['userid'],
                '姓名: ' . $res['name'],
                '别名: ' . $res['alias'],
                '职位: ' . $res['position'],
                '手机号: ' . ($res['mobile'] ?? ''),
                '头像: ' . ($res['avatar'] ?? ''),
                '状态: ' . $res['status'],
                '是否可用: ' . $res['enable'],
            ];

            $this->output->listing($result);
        }

        return false;
    }

    public function users(): bool
    {
        $id = $this->ask('请输入部门 ID', 'n');
        if ($id && $id != 'n') {
            $res = $this->container->get(UserWeChat::class)->listByDepartmentId((int) $id, true);
            $columns = [];
            foreach ($res['userlist'] ?? [] as $user) {
                $columns[] = [
                    $user['userid'],
                    $user['name'],
                    $user['position'],
                    $user['alias'],
                    $user['status'],
                    $user['enable'],
                ];
            }

            $this->table(['ID', '姓名', '职位', '别名', '状态', '是否可用'], $columns);
        }

        return false;
    }

    public function departments(): bool
    {
        $res = $this->container->get(DepartmentWeChat::class)->departments(0);

        $columns = [];
        foreach ($res['department'] ?? [] as $item) {
            $columns[] = [$item['id'], $item['name']];
        }

        $this->table(['ID', '部门名'], $columns);

        return false;
    }
}
