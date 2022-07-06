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

use Hyperf\Context\Context;
use Hyperf\Redis\Redis;
use Hyperf\Utils\Codec\Json;
use KY\WorkWxUser\Exception\TokenInvalidException;
use KY\WorkWxUser\Model\User;

class UserAuth implements \JsonSerializable
{
    public const AUTH_TOKEN = 'work-wx-token';

    protected ?User $user = null;

    public function __construct(protected int $id, protected string $token)
    {
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
        ];
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;
        return $this;
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
        $user = new static(0, '');
        $json = di()->get(Redis::class)->get(self::token($token));
        if ($json && $data = Json::decode($json)) {
            $user = new static($data['id'] ?? 0, $token);
        }

        Context::set(UserAuth::class, $user);

        return $user;
    }

    public static function get(): static
    {
        return Context::getOrSet(
            UserAuth::class,
            static function () {
                return new static(0, '');
            }
        );
    }

    public function save(): bool
    {
        $json = Json::encode($this);

        return di()->get(Redis::class)->set(self::token($this->token), $json, 86400 * 2);
    }

    private static function token(string $token): string
    {
        return 'token:' . $token;
    }
}
