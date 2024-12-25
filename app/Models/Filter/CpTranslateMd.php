<?php
namespace App\Models\Filter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CpTranslateMd extends Model
{
    use HasFactory;
    protected $table ='cp_translate';
    protected $primaryKey = 'id';
    protected $fillable = ['_id','translate','created'];
    public $timestamps = false;
}
