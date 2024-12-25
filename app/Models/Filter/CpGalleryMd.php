<?php
namespace App\Models\Filter;

use Illuminate\Database\Eloquent\Model;

class CpGalleryMd extends Model
{
    protected $table = 'cp_gallery';
    protected $primaryKey = 'id';
    protected $fillable = ['id','_id','image'];
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
    public $timestamps = true;
}