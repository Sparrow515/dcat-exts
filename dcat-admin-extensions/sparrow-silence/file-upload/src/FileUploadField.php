<?php

namespace SparrowSilence\FileUpload;

use Dcat\Admin\Form\Field;
use Dcat\Admin\Support\Helper;
use Dcat\Admin\Support\JavaScript;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use SparrowSilence\FileUpload\Trait\FileInput;
use SparrowSilence\FileUpload\Trait\FileInputTheme;

class FileUploadField extends Field
{

    use FileInput;
    use FileInputTheme;

    protected $options = ['events' => []];

    protected $view = 'file-upload::index';

    public function __construct($column, $arguments = [])
    {
        parent::__construct($column, $arguments);

        $this->setUpDefaultOptions();
    }

    public function render(): Factory|string|View
    {
        $value = $this->value ?? null;

        //init theme
        $this->setDefaultTheme();

        $this->addVariables([
            'options' => JavaScript::format($this->options),
        ]);

        return parent::render();
    }

    protected function formatValue()
    {
        if ($this->value !== null) {
            $this->value = implode(',', Helper::array($this->value));
        }elseif (is_array($this->default)) {
            $this->default = implode(',', $this->default);
        }
    }


}
