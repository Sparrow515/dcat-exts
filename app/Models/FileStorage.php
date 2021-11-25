<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class FileStorage extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'file_storage';
    
}
