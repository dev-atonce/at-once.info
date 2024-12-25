<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageListMd extends Model
{
    use HasFactory;
    protected $table = 'package_list';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
