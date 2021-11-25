<?php

namespace App\Admin\Repositories;

use App\Models\FileStorage as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class FileStorage extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
