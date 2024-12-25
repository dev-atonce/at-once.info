<?php
namespace App\Models\Filter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CpHardwareMd extends Model
{
    use HasFactory;
    protected $table = 'cp_hardware';
    protected $primaryKey = 'id';
    protected $fillable = ['id','_id','hardware','created'];
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
    public $timestamps = true;
}
