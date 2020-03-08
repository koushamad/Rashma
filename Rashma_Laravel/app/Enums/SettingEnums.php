<?php

namespace App\Enums;

class SettingEnums
{
    const LANGS = ['fa','tr','en'];

    const DEFAULT_LANG = 'en';
    const DEFAULT_WALLET_UNIT_ID = 1;

    const WALLET_UNITS = [
        1 => 'toman',
        2 => 'lire',
        3 => 'dolar'
    ];

    const DEFAULT_IS_NOTIFY = true;
    const DEFAULT_IS_PUBLIC = false;

    const PHONE_CODE_LANG = [
        '98' => 'fa',
        '90' => 'tr'
    ];
}
