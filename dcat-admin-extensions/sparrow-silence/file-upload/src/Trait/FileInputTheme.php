<?php

namespace SparrowSilence\FileUpload\Trait;

use Dcat\Admin\Admin;
use Dcat\Admin\Support\JavaScript;

trait FileInputTheme
{
    public string $themeName = 'fa';

    public string $themePrefix = 'feather';

    public array $themeOptions = [
        'fileActionSettings'     => [
            'removeIcon'       => 'icon-trash',
            'uploadIcon'       => 'icon-upload',
            'uploadRetryIcon'  => 'icon-rotate-cw',
            'downloadIcon'     => 'icon-download',
            'zoomIcon'         => 'icon-zoom-in',
            'dragIcon'         => 'icon-move',
            'indicatorNew'     => 'icon-info text-warning',
            'indicatorSuccess' => 'icon-check-circle text-success',
            'indicatorError'   => 'icon-x-circle text-danger',
            'indicatorLoading' => 'icon-loader text-muted',
            'indicatorPaused'  => 'icon-pause text-info'
        ],
        'layoutTemplates'        => [
            'fileIcon' => 'icon-file'
        ],
        'previewZoomButtonIcons' => [
            'prev'         => 'icon-chevron-left',
            'next'         => 'icon-chevron-right',
            'toggleheader' => 'icon-maximize-2',
            'fullscreen'   => 'icon-maximize',
            'borderless'   => 'icon-external-link',
            'close'        => 'icon-x'
        ],
        'previewFileIcon'        => 'icon-file',
        'browseIcon'             => 'icon-folder',
        'removeIcon'             => 'icon-trash',
        'cancelIcon'             => 'icon-slash',
        'pauseIcon'              => 'icon-pause',
        'uploadIcon'             => 'icon-upload',
        'msgValidationErrorIcon' => 'icon-alert-circle'
    ];

    /**
     * @param string $title
     * @return string
     */
    protected function wrapIcon(string $title): string
    {
        $prefix = (config('admin.fileinputThemes.prefix') ?? $this->themePrefix) . ' ';
        return "<i class='" . $prefix . $title . "'></i>";
    }

    /**
     * @param array $options
     * @return array
     */
    protected function formatTheme(array $options): array
    {
        foreach ($options as $key => $item) {
            if (is_array($item)) {
                $options[$key] = $this->formatTheme($item);
            } else {
                $options[$key] = $this->wrapIcon($item);
            }
        }
        return $options;
    }

    /**
     * @return array
     */
    public function getDefaultTheme(): array
    {
        $options = config('admin.fileinputThemes.options') ?? $this->themeOptions;
        return $this->formatTheme($options);
    }

    protected function setDefaultTheme()
    {
        dd(trans('admin.user'));
        $themeConfig = JavaScript::format([
            $this->themeName => $this->getDefaultTheme()
        ]);
        Admin::script(
            <<<JS
$.fn.fileinputThemes = $themeConfig;
JS
        );
        $this->options['theme'] = $this->themeName;
    }
}
