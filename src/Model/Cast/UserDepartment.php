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
namespace KY\WorkWxUser\Model\Cast;

use Hyperf\Contract\Arrayable;
use Hyperf\Utils\Codec\Json;
use Hyperf\Utils\Contracts\Jsonable;

class UserDepartment implements Arrayable, \Stringable, Jsonable, \JsonSerializable
{
    public function __construct(public int $id, public bool $isLeader = false)
    {
    }

    public function __toString(): string
    {
        return Json::encode($this->toArray());
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'is_leader' => $this->isLeader,
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public static function makeFromArray(array $item): ?UserDepartment
    {
        try {
            return new UserDepartment($item['id'], $item['is_leader']);
        } catch (\Throwable) {
            return null;
        }
    }

    /**
     * @return UserDepartment[]
     */
    public static function makeListFromArray(array $items): array
    {
        $result = [];
        foreach ($items as $item) {
            if ($department = self::makeFromArray($item)) {
                $result[] = $department;
            }
        }

        return $result;
    }
}
