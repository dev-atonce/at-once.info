<?php
namespace App\Models\Filter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CpPeriodMd extends Model
{
    use HasFactory;
    protected $table = 'cp_period';
    protected $primaryKey = 'id';
    protected $fillable = ['id','type','_id','period','created'];
    public $timestamps = false;
}
