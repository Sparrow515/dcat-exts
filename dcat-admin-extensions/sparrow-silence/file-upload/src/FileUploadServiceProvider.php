<?php

namespace SparrowSilence\FileUpload;

use Dcat\Admin\Extend\ServiceProvider;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;

class FileUploadServiceProvider extends ServiceProvider
{
	protected $js = [
        'js/fileinput.min.js',
        'js/locales/zh.js',
    ];
	protected $css = [
		'css/fileinput.min.css',
	];


	public function init()
	{
		parent::init();
        if ($views = $this->getViewPath()) {
            $this->loadViewsFrom($views, 'file-upload');
        }
        Admin::booting(function () {
            Form::extend('img', FileUploadField::class);
        });
	}

	public function settingForm(): Setting
    {
		return new Setting($this);
	}
}
