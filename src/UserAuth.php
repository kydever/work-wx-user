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
namespace KY\WorkWxUser;

use Hyperf\Redis\Redis;
use Hyperf\Utils\Codec\Json;
use KY\WorkWxUser\Exception\TokenInvalidException;

class UserAuth implements \JsonSerializable
{
    public const AUTH_TOKEN = 'work-wx-token';

    public function __construct(protected int $id, protected string $token)
    {
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function build(): static
    {
        if ($this->id > 0) {
            return $this;
        }

        throw new TokenInvalidException();
    }

    public static function load(string $token): static
    {
        $json = di()->get(Redis::class)->get(self::token($token));
        if (! $json) {
            return new static(0, '');
        }

        $data = Json::decode($json);

        try {
            return new static($data['id'], $token);
        } catch (\Throwable) {
            return new static(0, '');
        }
    }

    public function save(): bool
    {
        $json = Json::encode($this);
        $token = $this->id . '_' . md5(uniqid());

        return di()->get(Redis::class)->set(self::token($token), $json, 86400 * 2);
    }

    private static function token(string $token): string
    {
        return 'token:' . $token;
    }
}
