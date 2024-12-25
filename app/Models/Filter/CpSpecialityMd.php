<?php
namespace App\Models\Filter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CpSpecialityMd extends Model
{
    use HasFactory;
    protected $table ='cp_speciality';
    protected $primaryKey = 'id';
    protected $fillable = ['_id','speciality','created'];
    public $timestamps = false;
}
