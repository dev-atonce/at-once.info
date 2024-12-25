<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PackageMd;
use App\Models\OurCustomerMd as OurCustomer;
use App\Models\OurPackage;
use Facade\Ignition\Support\Packagist\Package;

class PackageCtrl extends Controller
{
    //

    public function this_package($cp, $lang)
    {
        try {
            $hl = ($lang == '') ? 'th' : $lang;
            $package = OurCustomer::select([
                "package as package_id",
                "package_in",
                "popup-contact as popupContact",
                "popup-blog as popupBlog"
            ])
                ->where('company', $cp)
                ->first();
            $res = [];
            if (@$package->package_id) {
                $thisPackage = \App\Models\PackageCategoryMd::select(["name_$hl as name"])->where('id', $package->package_id)->first();

                $res = [
                    "package_id" => $package->package_id,
                    "package_name" => @$thisPackage->name,
                    "popupContact" => $package->popupContact,
                    "popupContact" => $package->popupBlog,
                ];
            }
            if (@$package->package_in) {
                $res = [
                    "package_id" => $package->package_in,
                    "popupContact" => $package->popupContact,
                    "popupContact" => $package->popupBlog,
                ];
                $thisPackage = \App\Models\PackageCategoryMd::select(["name_$hl as name"])->whereIn('id', explode(',', $package->package_in))->get();
                $text = '';
                foreach ($thisPackage as $k => $v) {
                    $text .= ($k > 0) ? "+ $v->name" : "$v->name";
                }
                if ($text != '') {
                    $res["package_name"] = $text;
                }
            }

            return $res;
        } catch (\Exception $e) {
            return false;
        }
    }
    public function getPackage(Request $request)
    {

        $package = $this->this_package($request->cp, $request->lang);
        // $lang = ($request->lang) ? $request->lang : 'th';
        // $options = OurPackage::select([
        //     "p.name_$lang as option",
        //     "p.description_$lang as description"
        // ])
        // ->leftJoin("package_category as p","our_package.sub","=","p.id")
        // ->where(['our_package.package'=>@$package->package_id])
        // ->get();
        // $ops = [];
        // foreach($options as $k => $op){
        //     $ops[$k]['option'] = $op->option;
        //     $ops[$k]['description'] = $op->description;
        // }
        // $package['options'] = $ops;
        if (@$package) {
            return response()->json($package);
        } else {
            return response()->json([]);
        }
    }
}
