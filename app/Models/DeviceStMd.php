<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceStMd extends Model
{
    use HasFactory;
    protected $table = 'st_device';
    protected $primaryKey = 'id';
    protected $fillable = [
        'company',
        'addroid',
        'blackberry',
        'broserId',
        'browserName',
        'browserVersion',
        'bsd',
        'chrome',
        'desktop',
        'edge',
        'firefox',
        'ie',
        'ieMobile',
        'ios',
        'ipad',
        'iphone',
        'linux',
        'macos',
        'mobile',
        'msie',
        'opera',
        'operaMini',
        'osId',
        'osName',
        'osVersion',
        'osVersionBugfix',
        'osVersionCategories',
        'osVersionMajor',
        'osVersionMajor',
        'osVersionMinor',
        'osVersionString',
        'safari',
        'supported',
        'windows',
        'windowsPhone',
        'json',
        'created'
    ];
    public $timestamps = false;
}
