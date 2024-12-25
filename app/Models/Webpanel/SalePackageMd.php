<?php

namespace App\Models\Webpanel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalePackageMd extends Model
{
    use HasFactory;
    protected $table = 'sale_package';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
