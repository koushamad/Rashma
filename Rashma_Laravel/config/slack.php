<?php

return [
    'general' => env(env('APP_ENV').'_SLACK_WEBHOOK_URL'),
    'exception' => env(env('APP_ENV').'_SLACK_WEBHOOK_EXCEPTION_URL'),
    'request' => env(env('APP_ENV').'_SLACK_WEBHOOK_REQUEST_URL'),
    'log' => env(env('APP_ENV').'_SLACK_WEBHOOK_LOG_URL'),
];
