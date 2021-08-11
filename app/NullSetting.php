<?php

use App\Models\Queue;
use App\Models\Settings;

class NullSetting extends Settings 
{
    protected $attributes = [
            'system_name' => 'CSFP',
            'sub_name' => 'Queue Management System',
            'video' => '',
            'logo' => '',
            'overtime' => 30,
    ];
}

