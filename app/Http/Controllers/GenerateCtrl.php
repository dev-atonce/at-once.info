<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GenerateCtrl extends Controller
{
    public function image()
    {      
        echo '<svg><text y="15" fill="#666" style="font-size:22px; font-family:Sans-serif;">Image</text></svg>';
    }
    public function text()
    {      
        echo '<svg><text y="22" fill="#666" style="font-size:22px; font-family:Sans-serif;">Text</text></svg>';
    }
}
