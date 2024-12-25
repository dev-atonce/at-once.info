<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChecklistItemMd extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $foreignKey = 'checklist';
    protected $table = 'checklist_item';
    public $timestamps = true;

    
}
