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
return [
    'corp_id' => env('WORK_WX_CORP_ID'),
    'agent_id' => (int) env('WORK_WX_AGENT_ID'),
    'secret' => env('WORK_WX_SECRET'),
    'token' => env('WORK_WX_TOKEN'),
    'aes_key' => env('WORK_WX_AES_KEY'),
    'oauth' => [
        'redirect_url' => '',
    ],
];
