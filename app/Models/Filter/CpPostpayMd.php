<?php
namespace App\Models\Filter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CpPostpayMd extends Model
{
    use HasFactory;
    protected $table ='cp_postpay';
    protected $primaryKey = 'id';
    protected $fillable = ['_id','postpay','created'];
    public $timestamps = false;
}
