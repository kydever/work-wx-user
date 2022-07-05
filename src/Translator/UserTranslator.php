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
namespace KY\WorkWxUser\Translator;

use KY\WorkWxUser\Model\Cast\UserDepartment;
use KY\WorkWxUser\Model\Cast\UserDepartments;
use KY\WorkWxUser\Model\User;

class UserTranslator
{
    public function translate(array $info, ?User $user = null): User
    {
        if (! $user) {
            $user = new User();
            $user->userid = $info['userid'];
        }
        $user->name = $info['name'];
        $user->position = $info['position'];
        $user->mobile = $info['mobile'] ?? '';
        $user->email = $info['biz_mail'] ?? $info['email'] ?? '';
        $user->avatar = $info['thumb_avatar'] ?? $info['avatar'] ?? '';
        $user->status = $info['status'];
        $user->enable = $info['enable'];
        $user->alias = $info['alias'];
        $user->departments = $this->translateUserDepartments($info['department'], $info['is_leader_in_dept']);
        return $user;
    }

    public function translateUserDepartments(array $department, array $isLeaderInDept): UserDepartments
    {
        $result = [];
        foreach ($department as $i => $item) {
            $result[] = new UserDepartment($item, (bool) $isLeaderInDept[$i]);
        }

        return new UserDepartments($result);
    }
}
