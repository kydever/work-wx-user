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
namespace KY\WorkWxUser;

use Han\Utils\Service;
use KY\WorkWxUser\Dao\DepartmentDao;
use KY\WorkWxUser\Dao\UserDao;
use KY\WorkWxUser\Model\Department;
use KY\WorkWxUser\Translator\UserTranslator;
use KY\WorkWxUser\WeChat\DepartmentWeChat;
use KY\WorkWxUser\WeChat\UserWeChat;

class UserService extends Service
{
    public function syncToDatabase(): void
    {
        $res = di()->get(DepartmentWeChat::class)->departments(0);
        $departmentIds = [];
        foreach ($res['department'] ?? [] as $item) {
            $id = $item['id'];
            $name = $item['name'];
            $parentId = $item['parentid'];

            $department = di()->get(DepartmentDao::class)->first($id);
            if (! $department) {
                $department = new Department();
                $department->id = $id;
            }

            $department->name = $name;
            $department->parent_id = $parentId;
            $department->save();

            $departmentIds[] = $id;
            if (in_array($parentId, $departmentIds)) {
                continue;
            }

            $result = di()->get(UserWeChat::class)->listByDepartmentId($id, true);
            foreach ($result['userlist'] ?? [] as $info) {
                $user = di()->get(UserDao::class)->firstByUserid($info['userid']);
                $user = di()->get(UserTranslator::class)->translate($info, $user);
                $user->save();
            }
        }
    }

    public function login(string $code): UserAuth
    {
        $info = di()->get(UserWeChat::class)->getUserInfo($code);

        $user = di()->get(UserDao::class)->firstByUserid($info['userid']);

        $user = di()->get(UserTranslator::class)->translate($info, $user);

        $user->save();

        $token = sprintf('%d_%s', $user->id, md5(uniqid()));

        $userAuth = new UserAuth($user->id, $token);

        $userAuth->save();

        return $userAuth->setUser($user);
    }
}
