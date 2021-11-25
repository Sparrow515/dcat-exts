<?php

namespace SparrowSilence\OperationLog;

use Dcat\Admin\Extend\ServiceProvider;
use Dcat\Admin\Admin;
use SparrowSilence\OperationLog\Http\Middleware\LogOperation;

class OperationLogServiceProvider extends ServiceProvider
{

    protected $middleware = [
        'middle' => [
            LogOperation::class,
        ]
    ];

    protected $menu = [
        [
            'title' => 'Operation Log',
            'uri' => 'auth/operation-logs'
        ],
    ];

    public function settingForm(): Setting
    {
		return new Setting($this);
	}
}
