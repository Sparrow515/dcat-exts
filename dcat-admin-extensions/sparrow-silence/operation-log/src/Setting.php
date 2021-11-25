<?php

namespace SparrowSilence\OperationLog;

use Dcat\Admin\Extend\Setting as Form;
use Dcat\Admin\Support\Helper;
use SparrowSilence\OperationLog\Models\OperationLog;

class Setting extends Form
{
    public function title(): array|string|null
    {
        return $this->trans('log.title');
    }

    protected function formatInput(array $input): array
    {
        $input['except'] = Helper::array($input['except']);
        $input['allowed_methods'] = Helper::array($input['allowed_methods']);

        return $input;
    }

    public function form()
    {
        $this->tags('except');
        $this->multipleSelect('allowed_methods')
            ->options(array_combine(OperationLog::$methods, OperationLog::$methods));
        $this->tags('secret_fields');
    }

}
