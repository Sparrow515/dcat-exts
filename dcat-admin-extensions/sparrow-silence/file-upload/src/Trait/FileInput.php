<?php

namespace SparrowSilence\FileUpload\Trait;

use Dcat\Admin\Form;

/**
 * @property Form $form
 */
trait FileInput
{

    protected function setUpDefaultOptions()
    {
        $key = optional($this->form)->getKey();

        $defaultOptions = [
            'language'             => 'zh',
            'bytesToKB'            => 1024,
            'showCaption'          => true,
            'showBrowse'           => true,
            'showPreview'          => true,
            'showRemove'           => true,
            'showUploadStats'      => true,
            'showCancel'           => null,
            'showPause'            => null,
            'showClose'            => true,
            'showUploadThumbs'     => true,
            'showConsoleLogs'      => false,
            'browseOnZoneClick'    => false,
            'autoReplace'          => false,
            'showDescriptionClose' => true,
        ];

        $this->options($defaultOptions);
    }
}
