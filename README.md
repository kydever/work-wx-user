# 企业微信用户系统组件

## 介绍

基于 Hyperf 框架，快速搭建企业微信用户服务

## 安装

```
composer require kydev/work-wx-user
```

## 使用

### 登录

### 验证登录态

在 `middlewares.php` 配置中，增加对应的中间件。

```php
<?php

declare(strict_types=1);

return [
    'http' => [
        KY\WorkWxUser\Middleware\UserAuthMiddleware::class,
    ],
];

```

使用时，调用 `build()` 方法，即可验证是否已登录，如果没有登录态，则抛出 `KY\WorkWxUser\Exception\TokenInvalidException` 异常。

```php
<?php

$id = UserAuth::get()->build()->getId();
```

最后只需要在我们的异常捕获器中，增加对应的异常捕获，并与前端协商好对应的错误码，即可正常使用，例如以下异常捕获器

```php
<?php

declare(strict_types=1);

namespace App\Exception\Handler;

use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use App\Kernel\Http\Response;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Di\Exception\CircularDependencyException;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Exception\HttpException;
use KY\WorkWxUser\Exception\TokenInvalidException;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Throwable;

class BusinessExceptionHandler extends ExceptionHandler
{
    protected Response $response;

    protected LoggerInterface $logger;

    public function __construct(protected ContainerInterface $container)
    {
        $this->response = $container->get(Response::class);
        $this->logger = $container->get(StdoutLoggerInterface::class);
    }

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        switch (true) {
            case $throwable instanceof HttpException:
                return $this->response->handleException($throwable);
            case $throwable instanceof TokenInvalidException:
                return $this->response->fail(ErrorCode::TOKEN_INVALID, 'Token Invalid.');
            case $throwable instanceof BusinessException:
                $this->logger->warning(format_throwable($throwable));
                return $this->response->fail($throwable->getCode(), $throwable->getMessage());
            case $throwable instanceof CircularDependencyException:
                $this->logger->error($throwable->getMessage());
                return $this->response->fail(ErrorCode::SERVER_ERROR, $throwable->getMessage());
        }

        $this->logger->error(format_throwable($throwable));

        return $this->response->fail(ErrorCode::SERVER_ERROR, 'Server Error');
    }

    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}
```
