<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChecklistMd extends Model
{
    use HasFactory;
    protected $table = 'checklist';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function items()
    {
        return $this->belongsTo('App\Models\CheclistItemMd','checklist','id');
    }
}
