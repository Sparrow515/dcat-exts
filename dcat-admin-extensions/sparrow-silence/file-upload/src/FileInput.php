<?php

namespace SparrowSilence\FileUpload;

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
            'name' =>
        ]
    }
}
