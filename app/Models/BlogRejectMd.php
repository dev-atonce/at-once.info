<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogRejectMd extends Model
{
    use HasFactory;

    protected $table = 'blog_reject';
    protected $primaryKey = 'id';
    protected $fillable = [
        'blog',
        'from',
        'to',
        'reject',
        'remark',
        'image',
        'type',
        'status',
        'message',
        'finished',
        'created'
    ];
    public $timestamps = false;

    public function img_reject(){
        return $this->hasMany(\App\Models\RejectImageMd::class,'_id');
    }
}
