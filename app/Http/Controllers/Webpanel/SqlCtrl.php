<?php

namespace App\Http\Controllers\Webpanel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Query\JoinClause;
use App\Http\Resources\CompanyCollection;
use Intervention\Image\ImageManagerStatic as Image;

class SqlCtrl extends Controller
{
    function curl_get_contents($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
    function converseToJson($data)
    {

        if ($data != null) {

            $geoIp = str_replace('geoip', '', $data);
            $geoIp = str_replace('(', '', $geoIp);
            $geoIp = str_replace(')', '', $geoIp);
            $geoIp = json_decode($geoIp, true);
            return $geoIp;
        } else {
            return null;
        }
    }
    function array()
    {
        return [482, 283, 282, 281, 278, 277, 276, 275, 273, 272, 271, 270, 269, 268, 267, 266, 265, 264];
    }

    public function filter()
    {
        $select = ["key", "name_th as name"];
        $title = ['ประเภทรถและยานยนต์', 'ระยะเวลาของสัญญา', 'สถานที่ตั้ง'];
        $filter[0] = \App\Models\ChoiceMd::where('type', 'car')->select($select)->get();
        $filter[1] = \App\Models\ChoiceMd::where('type', 'contract-period')->select($select)->get();
        $filter[2] = \App\Models\ProvinceMd::select("province_id as key", "province_name_th as name")->orderBy('name')->get();

        $html = '';
        $html .= '<style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        table tr td{
            padding:5px;
        }
        </style>';
        $skip = [30, 60, 90];
        $html .= '<div class="container"><div class="row">';
        for ($i = 0; $i < count($filter); $i++) {
            $html .= "<div class='col-lg-4'><strong>$title[$i]</strong>";
            if (gettype($filter[$i]) != 'array') {
                $html .= '<table class="table table-bordered"><thead><tr><td></td><td>Filter</td><td>Check</td></tr></thead><tbody>';
                foreach ($filter[$i] as $j => $v) {
                    $no = $j + 1;
                    $html .= "<tr><td>$no</td><td>$v->name</td><td></td><tr>";
                }
                $html .= '</tbody></table><br>';
            }
            $html .= '</div>';
        }
        $html .= '</div></div>';
        echo $html;
    }

    public function csRowToBasicCompany()
    {
        $user = Auth::user();
        $data = \App\Models\CompanyMd::join('job_progress', 'job_progress.company', 'company.id')
            ->where(db::raw('DATE(company.created)'), '2024-05-10')
            ->where(['type' => 'basic', 'resource' => 'import'])
            ->select('company.id', 'job_progress.id as jobProgressId', 'company.name_th', 'company.name_en', 'company.created', 'company.created_by', 'company.type', 'company.resource')
            ->get();
        echo '<pre>';
        // print_r($data->toArray());
        // foreach ($data as $v) {
        //     $job = \App\Models\JobCsMd::where('company', $v->id)->first();
        //     $job->created = '2024-05-10 17:14:44';
        //     echo $job->save() . '<br>';
        // }

        // foreach ($data as $k => $v) {
        //     $now = $v->created;
        //     $company = new \App\Models\CompanyMd;
        //     $company->name_th = $v->name_th;
        //     $company->name_en = $v->name_en;
        //     $company->category = $v->category;
        //     $company->email = $v->email;
        //     $company->phone = $v->telephone;
        //     $company->type = 'basic';
        //     $company->public = 1;
        //     $company->public_by = $user->name;
        //     $company->published_on = $now;
        //     $company->created = $now;
        //     $company->created_by = $user->name;
        //     $company->resource = 'import';
        //     if ($company->save()) {

        //         $jobProgress = new \App\Models\JobProgressMd;
        //         $jobProgress->company = $company->id;
        //         $jobProgress->step1 = 1;
        //         $jobProgress->step1_by = $user->id;
        //         $jobProgress->step1_on = $now;
        //         $jobProgress->created = $now;
        //         $jobProgress->save();

        //         $jobCs = new \App\Models\JobCsMd;
        //         $jobCs->company = $company->id;
        //         $jobCs->created = $now;
        //         $jobCs->save();
        //     }
        // }
    }
    function idDuplicate()
    {
        return \App\Models\CompanyMd::select('id', 'name_th', 'category', 'created')
            ->where('category', 67)
            ->where('created', 'like', "%2024-09-17%")
            ->get();
    }
    function deleteImportDataDuplicate()
    {
        $data = self::idDuplicate();
        print_r($data);
        // foreach ($data as $v) {
        //     echo "delete job_progress: ".\App\Models\JobProgressMd::where('company', $v->id)->delete()."<br>";
        //     echo "delete job_cs: ".\App\Models\JobCsMd::where('company', $v->id)->delete()."<br>";
        //     echo "delete member :".\App\Models\CompanyMd::find($v->id)->forceDelete()."<br>";
        //     echo "delete company :".\App\Models\CompanyMd::find($v->id)->forceDelete()."<br>";
        //     echo "<br>";
        // }
    }
    function custom()
    {
        try {
            $data = \App\Models\CompanyMd::select('category.name_th as categoryName', 'company.id', 'company.name_th', 'company.name_en', 'company.phone', 'company.mobile', 'company.email', 'company.address_th')
                ->leftJoin('job_progress', 'company.id', 'job_progress.company')
                ->leftJoin('job_cs', 'company.id', 'job_cs.company')
                ->leftJoin('category', 'company.category', 'category.id')
                ->whereNotNull('company.category')
                ->whereIn('company.category', [67, 73, 177])
                ->groupBy('company.name_th')
                ->orderBy('category.name_th')
                ->get();
            $fileName = "onprocess-company_" . date('d-m-Y') . ".csv";

            $headers = array(
                "Charset" => "utf-8",
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );

            $columns = array('No.', 'Category', 'Name TH', 'Name EN', 'Telephone', 'Mobile', 'Email', 'Address TH');

            $callback = function () use ($data, $columns) {
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF))); // set ภาษาไทย
                fputcsv($file, $columns);
                foreach ($data as $k => $rs) {
                    fputcsv($file, [
                        $k + 1,
                        $rs->categoryName,
                        $rs->name_th,
                        $rs->name_en,
                        $rs->phone,
                        $rs->mobile,
                        $rs->email,
                        $rs->address_th,
                    ]);
                }
            };

            return response()->stream($callback, 200, $headers)->send();
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        // for ($i=0; $i < 45; $i++) { 
        //     $st = new \App\Models\BlogStMd;
        //     $st->blog = "";
        //     $st->company = 4897;
        //     $st->ip = "127.0.0.1";
        //     $st->created = "2024-09-15 12:00:00";
        //     $st->save();
        //     echo $i."<br>";
        // }
    }

    public function by($name)
    {
        $data = \App\Models\User::where('name', 'like', "%$name")->first();
        if (@$data->id) {
            return $data->id;
        } else {
            return NULL;
        }
    }

    public function readCSV()
    {
        $students = [];
        if (($open = fopen(url("upload/logistic.csv"), "r")) !== FALSE) {

            fputs($open, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
            while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
                $students[] = $data;
            }

            fclose($open);
        }
        return $students;
    }

    public function companyInCategory()
    {
        // $data = \App\Models\CompanyMd::select([
        //     db::raw('DISTINCT(company.name_th)'),
        //     'company.id',
        //     'in.name_en as category'
        // ])
        // ->leftJoin('category as in','in.id','=','company.category')
        // ->where('company.public',1)
        // ->orderBy('company.name_th')
        // ->get();


        $all = \App\Models\CompanyMd::select([
            'company.id',
            'company.name_th',
            'in.name_en as category'
        ])
            ->leftJoin('category as in', 'in.id', '=', 'company.category')
            ->where('company.public', 1)
            ->get();


        $all->map(function ($val, $key) use ($all) {
            // $all->where('name_th',$val['name_th']);
            $all->filter(function ($v, $k) use ($val) {
                return $v['name_th'] == $val->name_th;
            });
        });
        echo "<pre>";
        print_r($all);
    }

    public function newCategory()
    {
        return (object) [
            [
                'no' => 1,
                'name_th' => 'วิซ่า',
                'name_en' => 'Visa',
                'name_jp' => 'Visa',
                'name_ch' => 'Visa',
                'key' => 'visa-support',
                'status' => 1,
                'coming_soon' => 0,
                'category_sub' => 1,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 2,
                'name_th' => 'รับจัดตั้งบริษัท',
                'name_en' => 'Company Registration',
                'name_jp' => 'Company Registration',
                'name_ch' => 'Company Registration',
                'key' => 'company-registration',
                'status' => 1,
                'coming_soon' => 0,
                'category_sub' => 1,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 3,
                'name_th' => 'สำนักงานทางกฎหมาย',
                'name_en' => 'Law Firm',
                'name_jp' => 'Law Firm',
                'name_ch' => 'Law Firm',
                'key' => 'law-firm',
                'status' => 1,
                'coming_soon' => 0,
                'category_sub' => 1,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 4,
                'name_th' => 'ที่ปรึกษาทางธุรกิจ',
                'name_en' => 'Business Consulting',
                'name_jp' => 'Business Consulting',
                'name_ch' => 'Business Consulting',
                'key' => 'business-consulting',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 1,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 5,
                'name_th' => 'รับจัดทำบัญชี',
                'name_en' => 'Accounting',
                'name_jp' => 'Accounting',
                'name_ch' => 'Accounting',
                'key' => 'accounting',
                'status' => 1,
                'coming_soon' => 0,
                'category_sub' => 1,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 6,
                'name_th' => 'แปลภาษา และล่าม',
                'name_en' => 'Translation & Interpreter',
                'name_jp' => 'Translation & Interpreter',
                'name_ch' => 'Translation & Interpreter',
                'key' => 'translation-interpreter',
                'status' => 1,
                'coming_soon' => 0,
                'category_sub' => 1,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 7,
                'name_th' => 'ตัวแทนที่ดิน',
                'name_en' => 'Agent for land',
                'name_jp' => 'Agent for land',
                'name_ch' => 'Agent for land',
                'key' => 'agent-for-land',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 1,
                'created' => '2023-11-10 18:35:29',
            ],


            [
                'no' => 8,
                'name_th' => 'บริษัทจัดหางาน',
                'name_en' => 'Recruitment Agency',
                'name_jp' => 'Recruitment Agency',
                'name_ch' => 'Recruitment Agency',
                'key' => 'recruitment-agency',
                'status' => 1,
                'coming_soon' => 0,
                'category_sub' => 2,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 9,
                'name_th' => 'บริษัทรักษาความปลอดภัย',
                'name_en' => 'Security Service',
                'name_jp' => 'Security Service',
                'name_ch' => 'Security Service',
                'key' => 'security-service',
                'status' => 1,
                'coming_soon' => 0,
                'category_sub' => 2,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 10,
                'name_th' => 'โลจิสติกส์ คลังสินค้า และการจัดส่ง',
                'name_en' => 'Logistics, Warehouse & Delivery',
                'name_jp' => 'Logistics, Warehouse & Delivery',
                'name_ch' => 'Logistics, Warehouse & Delivery',
                'key' => 'logistics-warehouse-delivery',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 2,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 11,
                'name_th' => 'บริการสื่อพิมพ์',
                'name_en' => 'Printing Service',
                'name_jp' => 'Printing Service',
                'name_ch' => 'Printing Service',
                'key' => 'printing-service',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 2,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 12,
                'name_th' => 'ทำสวน',
                'name_en' => 'Gardening',
                'name_jp' => 'Gardening',
                'name_ch' => 'Gardening',
                'key' => 'gardening',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 2,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 13,
                'name_th' => 'การออกแบบและปรับปรุงสำนักงาน',
                'name_en' => 'Office design & Renovation',
                'name_jp' => 'Office design & Renovation',
                'name_ch' => 'Office design & Renovation',
                'key' => 'office-design-and-renovation',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 2,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 14,
                'name_th' => 'เครื่องใช้สำนักงาน',
                'name_en' => 'Office Appliance',
                'name_jp' => 'Office Appliance',
                'name_ch' => 'Office Appliance',
                'key' => 'office-appliance',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 2,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 15,
                'name_th' => 'อุปกรณ์โอเอ',
                'name_en' => 'OA Equipment',
                'name_jp' => 'OA Equipment',
                'name_ch' => 'OA Equipment',
                'key' => 'oa-machine',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 2,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 16,
                'name_th' => 'การบำรุงรักษาอุปกรณ์สำนักงาน',
                'name_en' => 'Office Equipment Maintenance',
                'name_jp' => 'Office Equipment Maintenance',
                'name_ch' => 'Office Equipment Maintenance',
                'key' => 'office-automation-machine',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 2,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 17,
                'name_th' => 'การพัฒนาเว็บไซต์',
                'name_en' => 'Website Development',
                'name_jp' => 'Website Development',
                'name_ch' => 'Website Development',
                'key' => 'website-development',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 2,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 18,
                'name_th' => 'System IOT & DX',
                'name_en' => 'System IOT & DX',
                'name_jp' => 'System IOT & DX',
                'name_ch' => 'System IOT & DX',
                'key' => 'system-iot-dx',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 2,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 19,
                'name_th' => 'บริการรถเช่าและลีสซิ่ง',
                'name_en' => 'Car rental & Leasing',
                'name_jp' => 'Car rental & Leasing',
                'name_ch' => 'Car rental & Leasing',
                'key' => 'car-rental-leasing',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 2,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 20,
                'name_th' => 'ไอที, ฮาร์ดแวร์คอมพิวเตอร์',
                'name_en' => 'IT, Computer Hardware',
                'name_jp' => 'IT, Computer Hardware',
                'name_ch' => 'IT, Computer Hardware',
                'key' => 'it-computer-hardware',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 2,
                'created' => '2023-11-10 18:35:29',
            ],


            [
                'no' => 21,
                'name_th' => 'ศูนย์รับแจ้ง',
                'name_en' => 'Call Center',
                'name_jp' => 'Call Center',
                'name_ch' => 'Call Center',
                'key' => 'call-center',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 3,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 22,
                'name_th' => 'การโฆษณาและการเผยแพร่',
                'name_en' => 'Advertising & Publishing',
                'name_jp' => 'Advertising & Publishing',
                'name_ch' => 'Advertising & Publishing',
                'key' => 'advertising-publisment',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 3,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 23,
                'name_th' => 'การตลาดผ่านเว็บไซต์',
                'name_en' => 'Web Marketing',
                'name_jp' => 'Web Marketing',
                'name_ch' => 'Web Marketing',
                'key' => 'web-marketing',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 3,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 24,
                'name_th' => 'นิทรรศการ',
                'name_en' => 'Exhibition',
                'name_jp' => 'Exhibition',
                'name_ch' => 'Exhibition',
                'key' => 'exhibition',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 3,
                'created' => '2023-11-10 18:35:29',
            ],


            [
                'no' => 25,
                'name_th' => 'ธนาคาร',
                'name_en' => 'Bank',
                'name_jp' => 'Bank',
                'name_ch' => 'Bank',
                'key' => 'bank',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 4,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 26,
                'name_th' => 'ลีสซิ่ง',
                'name_en' => 'Leasing',
                'name_jp' => 'Leasing',
                'name_ch' => 'Leasing',
                'key' => 'leasing',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 4,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 27,
                'name_th' => 'ประกันภัย',
                'name_en' => 'Insurance',
                'name_jp' => 'Insurance',
                'name_ch' => 'Insurance',
                'key' => 'insurance',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 4,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 28,
                'name_th' => 'แฟคตอริ่ง',
                'name_en' => 'Factoring',
                'name_jp' => 'Factoring',
                'name_ch' => 'Factoring',
                'key' => 'factoring',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 4,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 29,
                'name_th' => 'บัตรเครดิต',
                'name_en' => 'Credit Cards',
                'name_jp' => 'Credit Cards',
                'name_ch' => 'Credit Cards',
                'key' => 'credit-cards',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 4,
                'created' => '2023-11-10 18:35:29',
            ],


            [
                'no' => 30,
                'name_th' => 'ตัวแทนการท่องเที่ยว',
                'name_en' => 'Travel Agency',
                'name_jp' => 'Travel Agency',
                'name_ch' => 'Travel Agency',
                'key' => 'travel-agency',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 5,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 31,
                'name_th' => 'โรงแรมและที่พัก',
                'name_en' => 'Hotel & Accommodation',
                'name_jp' => 'Hotel & Accommodation',
                'name_ch' => 'Hotel & Accommodation',
                'key' => 'hotel-accommodation',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 5,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 32,
                'name_th' => 'ผู้จัดงาน',
                'name_en' => 'Event Organizer',
                'name_jp' => 'Event Organizer',
                'name_ch' => 'Event Organizer',
                'key' => 'event-organizer',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 5,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 33,
                'name_th' => 'ของขวัญและผู้รอดชีวิต',
                'name_en' => 'Gift & Survenior',
                'name_jp' => 'Gift & Survenior',
                'name_ch' => 'Gift & Survenior',
                'key' => 'gift-survenior',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 5,
                'created' => '2023-11-10 18:35:29',
            ],


            [
                'no' => 34,
                'name_th' => 'เครื่องกด',
                'name_en' => 'Press Machine',
                'name_jp' => 'Press Machine',
                'name_ch' => 'Press Machine',
                'key' => 'press-machine',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 6,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 35,
                'name_th' => 'เครื่องกลึง CNC และเครื่องกลึงธรรมดา',
                'name_en' => 'CNC Lathe & Manual Late',
                'name_jp' => 'CNC Lathe & Manual Late',
                'name_ch' => 'CNC Lathe & Manual Late',
                'key' => 'cnc-lathe-manual-late',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 6,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 36,
                'name_th' => 'แมชชีนเซ็นเตอร์และเครื่องกัด',
                'name_en' => 'Machine Center & Milling Machine',
                'name_jp' => 'Machine Center & Milling Machine',
                'name_ch' => 'Machine Center & Milling Machine',
                'key' => 'machine-center-milling-machine',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 6,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 37,
                'name_th' => 'เครื่องไดคาสติ้ง',
                'name_en' => 'Die Casting Machine',
                'name_jp' => 'Die Casting Machine',
                'name_ch' => 'Die Casting Machine',
                'key' => 'die-casting-machine',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 6,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 38,
                'name_th' => 'เครื่องฉีดพลาสติก',
                'name_en' => 'Plastic Injection',
                'name_jp' => 'Plastic Injection',
                'name_ch' => 'Plastic Injection',
                'key' => 'plastic-injection',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 6,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 39,
                'name_th' => 'เครื่องเชื่อม',
                'name_en' => 'Welding Machine',
                'name_jp' => 'Welding Machine',
                'name_ch' => 'Welding Machine',
                'key' => 'welding-machine',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 6,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 40,
                'name_th' => 'หุ่นยนต์และระบบอัตโนมัติ',
                'name_en' => 'Robot & Automation',
                'name_jp' => 'Robot & Automation',
                'name_ch' => 'Robot & Automation',
                'key' => 'robot-automation',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 6,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 41,
                'name_th' => 'การบำรุงรักษาเครื่องจักรและอะไหล่',
                'name_en' => 'Machine Maintenance & Spare part',
                'name_jp' => 'Machine Maintenance & Spare part',
                'name_ch' => 'Machine Maintenance & Spare part',
                'key' => 'machine-maintennance-spare-part',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 6,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 42,
                'name_th' => 'เครื่องจักรมือสอง',
                'name_en' => 'Second Hand Machine',
                'name_jp' => 'Second Hand Machine',
                'name_ch' => 'Second Hand Machine',
                'key' => 'second-hand-machine',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 6,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 43,
                'name_th' => 'เครื่องเคลือบ, พ่นสี, เครื่องบำบัดความร้อน',
                'name_en' => 'Coating, Painting, Heating treatment machine',
                'name_jp' => 'Coating, Painting, Heating treatment machine',
                'name_ch' => 'Coating, Painting, Heating treatment machine',
                'key' => 'coating-painting-heating-treatment-machine',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 6,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 44,
                'name_th' => 'เครื่องเจียร & EDM, เครื่องตัดลวด',
                'name_en' => 'Griding & EDM, Wire cut machine',
                'name_jp' => 'Griding & EDM, Wire cut machine',
                'name_ch' => 'Griding & EDM, Wire cut machine',
                'key' => 'grinding-edm-wire-cut-machine',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 6,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 45,
                'name_th' => 'อุปกรณ์ควบคุมคุณภาพ',
                'name_en' => 'QC Equipment',
                'name_jp' => 'QC Equipment',
                'name_ch' => 'QC Equipment',
                'key' => 'qc-equipment',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 6,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 46,
                'name_th' => 'เครื่องตัดและผสม',
                'name_en' => 'Cutting & Blending machine',
                'name_jp' => 'Cutting & Blending machine',
                'name_ch' => 'Cutting & Blending machine',
                'key' => 'cutting-blending-machine',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 6,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 47,
                'name_th' => 'เครื่องมือช่าง',
                'name_en' => 'Hand tools',
                'name_jp' => 'Hand tools',
                'name_ch' => 'Hand tools',
                'key' => 'hand-tools',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 6,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 48,
                'name_th' => 'เครื่องซักผ้า',
                'name_en' => 'Washing machine',
                'name_jp' => 'Washing machine',
                'name_ch' => 'Washing machine',
                'key' => 'washing-machine',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 6,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 49,
                'name_th' => 'อุปกรณ์พ่นสี',
                'name_en' => 'Painting equipment',
                'name_jp' => 'Painting equipment',
                'name_ch' => 'Painting equipment',
                'key' => 'painting-equipment',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 6,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 50,
                'name_th' => 'เครื่องจักรพิเศษและสายการออกแบบผลิตภัณฑ์',
                'name_en' => 'Special machine & Product designed line',
                'name_jp' => 'Special machine & Product designed line',
                'name_ch' => 'Special machine & Product designed line',
                'key' => 'special-machine-product-designed-line',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 6,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 51,
                'name_th' => 'เครื่องจักรและอุปกรณ์อื่นๆ',
                'name_en' => 'Other machine & Equipment',
                'name_jp' => 'Other machine & Equipment',
                'name_ch' => 'Other machine & Equipment',
                'key' => 'other-machine-equipment',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 6,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 52,
                'name_th' => 'ห้องสะอาดและการควบคุมอุณหภูมิ',
                'name_en' => 'Clean Room & Temperature control',
                'name_jp' => 'Clean Room & Temperature control',
                'name_ch' => 'Clean Room & Temperature control',
                'key' => 'clean-room-temperature-control',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 6,
                'created' => '2023-11-10 18:35:29',
            ],



            [
                'no' => 53,
                'name_th' => 'อุตสาหกรรมยานยนต์และรถจักรยานยนต์',
                'name_en' => 'Automotive & Motorcycle industrial',
                'name_jp' => 'Automotive & Motorcycle industrial',
                'name_ch' => 'Automotive & Motorcycle industrial',
                'key' => 'automotive-motorcycle-industrial',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 7,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 54,
                'name_th' => 'อุตสาหกรรมเคมี',
                'name_en' => 'Chemical Industrial',
                'name_jp' => 'Chemical Industrial',
                'name_ch' => 'Chemical Industrial',
                'key' => 'chemical-industrial',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 7,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 55,
                'name_th' => 'อุตสาหกรรมอัญมณีและเครื่องสำอาง',
                'name_en' => 'Jewely & Cosmetic industrial',
                'name_jp' => 'Jewely & Cosmetic industrial',
                'name_ch' => 'Jewely & Cosmetic industrial',
                'key' => 'jewely-cosmetic-industrial',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 7,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 56,
                'name_th' => 'อุตสาหกรรมอาหารและเครื่องดื่ม',
                'name_en' => 'Food & Drinks industrial',
                'name_jp' => 'Food & Drinks industrial',
                'name_ch' => 'Food & Drinks industrial',
                'key' => 'food-drinks-industrial',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 7,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 57,
                'name_th' => 'แม่พิมพ์',
                'name_en' => 'Mold',
                'name_jp' => 'Mold',
                'name_ch' => 'Mold',
                'key' => 'mold',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 7,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 58,
                'name_th' => 'สินค้าไฟฟ้าและชิ้นส่วนอุตสาหกรรม',
                'name_en' => 'Electric product & Parts industrial',
                'name_jp' => 'Electric product & Parts industrial',
                'name_ch' => 'Electric product & Parts industrial',
                'key' => 'electric-product-part-industrial',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 7,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 59,
                'name_th' => 'อุตสาหกรรมเครื่องใช้ในบ้าน',
                'name_en' => 'Home appliance industrial',
                'name_jp' => 'Home appliance industrial',
                'name_ch' => 'Home appliance industrial',
                'key' => 'home-appliance-industrial',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 7,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 60,
                'name_th' => 'อุตสาหกรรมการเกษตร',
                'name_en' => 'Agriculture industrial',
                'name_jp' => 'Agriculture industrial',
                'name_ch' => 'Agriculture industrial',
                'key' => 'agriculture-industrial',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 7,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 61,
                'name_th' => 'อุตสาหกรรมเครื่องจักรกลหนัก',
                'name_en' => 'Heavy Machine industrial',
                'name_jp' => 'Heavy Machine industrial',
                'name_ch' => 'Heavy Machine industrial',
                'key' => 'heavy-machine-industrial',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 7,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 62,
                'name_th' => 'Job shops',
                'name_en' => 'Job shops',
                'name_jp' => 'Job shops',
                'name_ch' => 'Job shops',
                'key' => 'job-shops',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 7,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 63,
                'name_th' => 'สิ่งทอและเครื่องนุ่งห่ม',
                'name_en' => 'Textile & Garment',
                'name_jp' => 'Textile & Garment',
                'name_ch' => 'Textile & Garment',
                'key' => 'textile-garment',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 7,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 64,
                'name_th' => 'รองเท้าและกระเป๋า',
                'name_en' => 'Shoes & Bags',
                'name_jp' => 'Shoes & Bags',
                'name_ch' => 'Shoes & Bags',
                'key' => 'shoes-bags',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 7,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 65,
                'name_th' => 'อุตสาหกรรมการแพทย์',
                'name_en' => 'Medical industrial',
                'name_jp' => 'Medical industrial',
                'name_ch' => 'Medical industrial',
                'key' => 'medical-industrial',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 7,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 66,
                'name_th' => 'แก้ว กระจก เลนส์',
                'name_en' => 'Glass, Mirror, lens',
                'name_jp' => 'Glass, Mirror, lens',
                'name_ch' => 'Glass, Mirror, lens',
                'key' => 'glass-mirror,lens',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 7,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 67,
                'name_th' => 'อุตสาหกรรมอื่นๆ',
                'name_en' => 'Other industrial',
                'name_jp' => 'Other industrial',
                'name_ch' => 'Other industrial',
                'key' => 'other-industrial',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 7,
                'created' => '2023-11-10 18:35:29',
            ],



            [
                'no' => 68,
                'name_th' => 'เครื่องมือตัดและหินเจียร',
                'name_en' => 'Cutting tool & Grinding stone',
                'name_jp' => 'Cutting tool & Grinding stone',
                'name_ch' => 'Cutting tool & Grinding stone',
                'key' => 'cutting-tool-grinding-stone',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 8,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 69,
                'name_th' => 'น้ำยาหล่อเย็นและน้ำมัน',
                'name_en' => 'Coolant & Oil',
                'name_jp' => 'Coolant & Oil',
                'name_ch' => 'Coolant & Oil',
                'key' => 'coolant-oil',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 8,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 70,
                'name_th' => 'เคมี',
                'name_en' => 'Chemical',
                'name_jp' => 'Chemical',
                'name_ch' => 'Chemical',
                'key' => 'chemical',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 8,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 71,
                'name_th' => 'กรอง',
                'name_en' => 'Filter',
                'name_jp' => 'Filter',
                'name_ch' => 'Filter',
                'key' => 'filter',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 8,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 72,
                'name_th' => 'ก๊าซและเชื้อเพลิง',
                'name_en' => 'Fuel & Gas',
                'name_jp' => 'Fuel & Gas',
                'name_ch' => 'Fuel & Gas',
                'key' => 'fuel-gas',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 8,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 73,
                'name_th' => 'สี',
                'name_en' => 'Paint',
                'name_jp' => 'Paint',
                'name_ch' => 'Paint',
                'key' => 'paint',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 8,
                'created' => '2023-11-10 18:35:29',
            ],




            [
                'no' => 74,
                'name_th' => 'สิ่งทอและผ้าไหม',
                'name_en' => 'Textile & Silk',
                'name_jp' => 'Textile & Silk',
                'name_ch' => 'Textile & Silk',
                'key' => 'textile-silk',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 9,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 75,
                'name_th' => 'ยาง',
                'name_en' => 'Rubber',
                'name_jp' => 'Rubber',
                'name_ch' => 'Rubber',
                'key' => 'rubber',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 9,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 76,
                'name_th' => 'พลาสติกและเรซิน',
                'name_en' => 'Plastic & Resin',
                'name_jp' => 'Plastic & Resin',
                'name_ch' => 'Plastic & Resin',
                'key' => 'plasitc-resin',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 9,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 77,
                'name_th' => 'ท่อ',
                'name_en' => 'Pipe',
                'name_jp' => 'Pipe',
                'name_ch' => 'Pipe',
                'key' => 'pipe',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 9,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 78,
                'name_th' => 'เยื่อกระดาษ',
                'name_en' => 'Pulp',
                'name_jp' => 'Pulp',
                'name_ch' => 'Pulp',
                'key' => 'pulp',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 9,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 79,
                'name_th' => 'เยื่อกระดาษ',
                'name_en' => 'Steel & Metal',
                'name_jp' => 'Steel & Metal',
                'name_ch' => 'Steel & Metal',
                'key' => 'steel-metal',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 9,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 80,
                'name_th' => 'ไม้',
                'name_en' => 'Woods',
                'name_jp' => 'Woods',
                'name_ch' => 'Woods',
                'key' => 'woods',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 9,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 81,
                'name_th' => 'เซรามิค',
                'name_en' => 'Ceramic',
                'name_jp' => 'Ceramic',
                'name_ch' => 'Ceramic',
                'key' => 'ceramic',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 9,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 82,
                'name_th' => 'หนัง',
                'name_en' => 'Leather',
                'name_jp' => 'Leather',
                'name_ch' => 'Leather',
                'key' => 'leather',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 9,
                'created' => '2023-11-10 18:35:29',
            ],




            [
                'no' => 83,
                'name_th' => 'คอมเพรสเซอร์',
                'name_en' => 'Compressor',
                'name_jp' => 'Compressor',
                'name_ch' => 'Compressor',
                'key' => 'compressor',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 10,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 84,
                'name_th' => 'พลังงานแสงอาทิตย์และกังหันลม',
                'name_en' => 'Solar & Windmilling',
                'name_jp' => 'Solar & Windmilling',
                'name_ch' => 'Solar & Windmilling',
                'key' => 'solar-windmilling',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 10,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 85,
                'name_th' => 'หม้อไอน้ำ',
                'name_en' => 'Boiler',
                'name_jp' => 'Boiler',
                'name_ch' => 'Boiler',
                'key' => 'boiler',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 10,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 86,
                'name_th' => 'สายพานลำเลียง เครื่องบด และแร็ค',
                'name_en' => 'Conveyor, Shatter & Rack',
                'name_jp' => 'Conveyor, Shatter & Rack',
                'name_ch' => 'Conveyor, Shatter & Rack',
                'key' => 'conveyor-shatter-rack',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 10,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 87,
                'name_th' => 'เครื่องกำเนิดไฟฟ้า',
                'name_en' => 'Generator',
                'name_jp' => 'Generator',
                'name_ch' => 'Generator',
                'key' => 'genrator',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 10,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 88,
                'name_th' => 'เครนและรอก',
                'name_en' => 'Crane & Hoist',
                'name_jp' => 'Crane & Hoist',
                'name_ch' => 'Crane & Hoist',
                'key' => 'crane-hoist',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 10,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 89,
                'name_th' => 'ผู้รับเหมา บำรุงรักษาและซ่อมแซม',
                'name_en' => 'Contractor, Maintenance & Renovation',
                'name_jp' => 'Contractor, Maintenance & Renovation',
                'name_ch' => 'Contractor, Maintenance & Renovation',
                'key' => 'contractor-maintenance-renovation',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 10,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 90,
                'name_th' => 'รถยกและสต๊อกเกอร์',
                'name_en' => 'Forklift & Stocker',
                'name_jp' => 'Forklift & Stocker',
                'name_ch' => 'Forklift & Stocker',
                'key' => 'forklift-stocker',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 10,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 91,
                'name_th' => 'สินค้าเพื่อความปลอดภัย',
                'name_en' => 'Safety goods',
                'name_jp' => 'Safety goods',
                'name_ch' => 'Safety goods',
                'key' => 'safety-goods',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 10,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 92,
                'name_th' => 'ปั๊มและมอเตอร์',
                'name_en' => 'Pump & Motor',
                'name_jp' => 'Pump & Motor',
                'name_ch' => 'Pump & Motor',
                'key' => 'pump-motor',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 10,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 93,
                'name_th' => 'ท่อและวิศวกรรมไฟฟ้า',
                'name_en' => 'Pipe & Electrical engineering',
                'name_jp' => 'Pipe & Electrical engineering',
                'name_ch' => 'Pipe & Electrical engineering',
                'key' => 'pipe-electric-engineering',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 10,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 94,
                'name_th' => 'การทำสวน',
                'name_en' => 'Gardening',
                'name_jp' => 'Gardening',
                'name_ch' => 'Gardening',
                'key' => 'gardening',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 10,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 95,
                'name_th' => 'บำรุงรักษาสิ่งอำนวยความสะดวก, ปั๊ม, มอเตอร์',
                'name_en' => 'Maintenance for facility & Pump, Motor',
                'name_jp' => 'Maintenance for facility & Pump, Motor',
                'name_ch' => 'Maintenance for facility & Pump, Motor',
                'key' => 'maintenance-for-facility-pump-motor',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 10,
                'created' => '2023-11-10 18:35:29',
            ],




            [
                'no' => 96,
                'name_th' => 'ความปลอดภัย',
                'name_en' => 'Security',
                'name_jp' => 'Security',
                'name_ch' => 'Security',
                'key' => 'security',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 11,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 97,
                'name_th' => 'ระบบ IOT และ DX',
                'name_en' => 'System IOT & DX',
                'name_jp' => 'System IOT & DX',
                'name_ch' => 'System IOT & DX',
                'key' => 'system-iot-dx',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 11,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 98,
                'name_th' => 'ให้คำปรึกษา',
                'name_en' => 'Consulting',
                'name_jp' => 'Consulting',
                'name_ch' => 'Consulting',
                'key' => 'consulting',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 11,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 99,
                'name_th' => 'โรงอาหาร',
                'name_en' => 'Canteen',
                'name_jp' => 'Canteen',
                'name_ch' => 'Canteen',
                'key' => 'canteen',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 11,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 100,
                'name_th' => 'บริษัทการค้า',
                'name_en' => 'Trading company',
                'name_jp' => 'Trading company',
                'name_ch' => 'Trading company',
                'key' => 'trading-company',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 11,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 101,
                'name_th' => 'บริษัทจัดหางาน',
                'name_en' => 'Recruitment',
                'name_jp' => 'Recruitment',
                'name_ch' => 'Recruitment',
                'key' => 'recruitment',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 11,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 102,
                'name_th' => 'โลจิสติกส์ คลังสินค้า และการจัดส่ง',
                'name_en' => 'Logistics, Warehouse & Delivery',
                'name_jp' => 'Logistics, Warehouse & Delivery',
                'name_ch' => 'Logistics, Warehouse & Delivery',
                'key' => 'logistics-warehouse-delivery',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 11,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 103,
                'name_th' => 'บริการอื่นๆ',
                'name_en' => 'Other service',
                'name_jp' => 'Other service',
                'name_ch' => 'Other service',
                'key' => 'other-service',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 11,
                'created' => '2023-11-10 18:35:29',
            ],



            [
                'no' => 104,
                'name_th' => 'AMATA',
                'name_en' => 'AMATA',
                'name_jp' => 'AMATA',
                'name_ch' => 'AMATA',
                'key' => 'amata',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 12,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 105,
                'name_th' => 'PINTONG',
                'name_en' => 'PINTONG',
                'name_jp' => 'PINTONG',
                'name_ch' => 'PINTONG',
                'key' => 'pintong',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 12,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 106,
                'name_th' => NULL,
                'name_en' => NULL,
                'name_jp' => NULL,
                'name_ch' => NULL,
                'key' => NULL,
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 12,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 107,
                'name_th' => NULL,
                'name_en' => NULL,
                'name_jp' => NULL,
                'name_ch' => NULL,
                'key' => NULL,
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 12,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 108,
                'name_th' => NULL,
                'name_en' => NULL,
                'name_jp' => NULL,
                'name_ch' => NULL,
                'key' => NULL,
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 12,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 109,
                'name_th' => NULL,
                'name_en' => NULL,
                'name_jp' => NULL,
                'name_ch' => NULL,
                'key' => NULL,
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 12,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 110,
                'name_th' => 'ตัวแทนอสังหาฯ',
                'name_en' => 'Agent for land',
                'name_jp' => 'Agent for land',
                'name_ch' => 'Agent for land',
                'key' => 'agent-for-land',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 12,
                'created' => '2023-11-10 18:35:29',
            ],




            [
                'no' => 111,
                'name_th' => 'นักพัฒนา',
                'name_en' => 'Developer',
                'name_jp' => 'Developer',
                'name_ch' => 'Developer',
                'key' => 'developer',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 13,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 112,
                'name_th' => 'ผู้รับเหมา',
                'name_en' => 'Contractor',
                'name_jp' => 'Contractor',
                'name_ch' => 'Contractor',
                'key' => 'contractor',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 13,
                'created' => '2023-11-10 18:35:29',
            ],




            [
                'no' => 113,
                'name_th' => 'คอมเพรสเซอร์',
                'name_en' => 'Compressor',
                'name_jp' => 'Compressor',
                'name_ch' => 'Compressor',
                'key' => 'compressor',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 14,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 114,
                'name_th' => 'เครื่องกำเนิดไฟฟ้า',
                'name_en' => 'Generator',
                'name_jp' => 'Generator',
                'name_ch' => 'Generator',
                'key' => 'generator',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 14,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 115,
                'name_th' => 'การบำรุงรักษาสิ่งอำนวยความสะดวก',
                'name_en' => 'Maintenance for facility',
                'name_jp' => 'Maintenance for facility',
                'name_ch' => 'Maintenance for facility',
                'key' => 'maintenance-for-facility',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 14,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 116,
                'name_th' => 'พลังงานแสงอาทิตย์และกังหันลม',
                'name_en' => 'solar & Windmilling',
                'name_jp' => 'solar & Windmilling',
                'name_ch' => 'solar & Windmilling',
                'key' => 'solar-windmilling',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 14,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 117,
                'name_th' => 'สายพานลำเลียง เครื่องบด และแร็ค',
                'name_en' => 'Conveyor, Shatter & Rack',
                'name_jp' => 'Conveyor, Shatter & Rack',
                'name_ch' => 'Conveyor, Shatter & Rack',
                'key' => 'conveyor-shatter-rack',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 14,
                'created' => '2023-11-10 18:35:29',
            ],




            [
                'no' => 118,
                'name_th' => 'เครื่องจักรกลหนัก',
                'name_en' => 'Heavy machinery',
                'name_jp' => 'Heavy machinery',
                'name_ch' => 'Heavy machinery',
                'key' => 'heavy-machinery',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 15,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 119,
                'name_th' => 'เครื่องจักรก่อสร้าง',
                'name_en' => 'Construction machine',
                'name_jp' => 'Construction machine',
                'name_ch' => 'Construction machine',
                'key' => 'construction-machine',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 15,
                'created' => '2023-11-10 18:35:29',
            ],




            [
                'no' => 120,
                'name_th' => 'ประตูและหน้าต่าง',
                'name_en' => 'Door & Window',
                'name_jp' => 'Door & Window',
                'name_ch' => 'Door & Window',
                'key' => 'door-window',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 16,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 121,
                'name_th' => 'ก๊าซและเชื้อเพลิง',
                'name_en' => 'Fuel & Gas',
                'name_jp' => 'Fuel & Gas',
                'name_ch' => 'Fuel & Gas',
                'key' => 'fuel-gas',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 16,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 122,
                'name_th' => 'อุปกรณ์ไฟฟ้า',
                'name_en' => 'Electrical equipment',
                'name_jp' => 'Electrical equipment',
                'name_ch' => 'Electrical equipment',
                'key' => 'electrical-equipment',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 16,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 123,
                'name_th' => 'หนัง',
                'name_en' => 'Leather',
                'name_jp' => 'Leather',
                'name_ch' => 'Leather',
                'key' => 'leather',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 16,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 124,
                'name_th' => 'ยาง',
                'name_en' => 'Rubber',
                'name_jp' => 'Rubber',
                'name_ch' => 'Rubber',
                'key' => 'rubber',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 16,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 125,
                'name_th' => 'หิน',
                'name_en' => 'Rock',
                'name_jp' => 'Rock',
                'name_ch' => 'Rock',
                'key' => 'rock',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 16,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 126,
                'name_th' => 'อิฐและกระเบื้อง',
                'name_en' => 'Brick & Tile',
                'name_jp' => 'Brick & Tile',
                'name_ch' => 'Brick & Tile',
                'key' => 'brick-tile',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 16,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 127,
                'name_th' => 'เสียง',
                'name_en' => 'Sound',
                'name_jp' => 'Sound',
                'name_ch' => 'Sound',
                'key' => 'sound',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 16,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 128,
                'name_th' => 'เหล็กและโลหะ',
                'name_en' => 'Steel & Metal',
                'name_jp' => 'Steel & Metal',
                'name_ch' => 'Steel & Metal',
                'key' => 'steel-metal',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 16,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 129,
                'name_th' => 'ท่อ',
                'name_en' => 'Pipe',
                'name_jp' => 'Pipe',
                'name_ch' => 'Pipe',
                'key' => 'pipe',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 16,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 130,
                'name_th' => 'วาล์ว',
                'name_en' => 'Valve',
                'name_jp' => 'Valve',
                'name_ch' => 'Valve',
                'key' => 'valve',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 16,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 131,
                'name_th' => 'แก้ว',
                'name_en' => 'Glass',
                'name_jp' => 'Glass',
                'name_ch' => 'Glass',
                'key' => 'glass',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 16,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 132,
                'name_th' => 'เคมี',
                'name_en' => 'Chemical',
                'name_jp' => 'Chemical',
                'name_ch' => 'Chemical',
                'key' => 'chemical',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 16,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 133,
                'name_th' => 'เซรามิค',
                'name_en' => 'Ceramic',
                'name_jp' => 'Ceramic',
                'name_ch' => 'Ceramic',
                'key' => 'ceramic',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 16,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 134,
                'name_th' => 'เยื่อกระดาษ',
                'name_en' => 'Pulp',
                'name_jp' => 'Pulp',
                'name_ch' => 'Pulp',
                'key' => 'pulp',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 16,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 135,
                'name_th' => 'รายการผสม',
                'name_en' => 'Blending item',
                'name_jp' => 'Blending item',
                'name_ch' => 'Blending item',
                'key' => 'blending-item',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 16,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 136,
                'name_th' => 'แสงไฟ',
                'name_en' => 'Light',
                'name_jp' => 'Light',
                'name_ch' => 'Light',
                'key' => 'light',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 16,
                'created' => '2023-11-10 18:35:29',
            ],




            [
                'no' => 137,
                'name_th' => 'รสบัส',
                'name_en' => 'Bus',
                'name_jp' => 'Bus',
                'name_ch' => 'Bus',
                'key' => 'bus',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 17,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 138,
                'name_th' => 'แท็กซี่',
                'name_en' => 'Taxi',
                'name_jp' => 'Taxi',
                'name_ch' => 'Taxi',
                'key' => 'taxi',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 17,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 139,
                'name_th' => 'รถไฟฟ้า',
                'name_en' => 'BTS',
                'name_jp' => 'BTS',
                'name_ch' => 'BTS',
                'key' => 'bts',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 17,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 140,
                'name_th' => 'เครื่องบิน',
                'name_en' => 'Air plane',
                'name_jp' => 'Air plane',
                'name_ch' => 'Air plane',
                'key' => 'air-plane',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 17,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 141,
                'name_th' => 'รถไฟ',
                'name_en' => 'Train',
                'name_jp' => 'Train',
                'name_ch' => 'Train',
                'key' => 'train',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 17,
                'created' => '2023-11-10 18:35:29',
            ],




            [
                'no' => 142,
                'name_th' => 'เชื้อเพลิง',
                'name_en' => 'Fuel',
                'name_jp' => 'Fuel',
                'name_ch' => 'Fuel',
                'key' => 'fuel',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 18,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 143,
                'name_th' => 'แก๊ส',
                'name_en' => 'Gas',
                'name_jp' => 'Gas',
                'name_ch' => 'Gas',
                'key' => 'gas',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 18,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 144,
                'name_th' => 'ไฟฟ้า',
                'name_en' => 'Electric',
                'name_jp' => 'Electric',
                'name_ch' => 'Electric',
                'key' => 'electric',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 18,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 145,
                'name_th' => 'กังหันลม',
                'name_en' => 'Windmilling',
                'name_jp' => 'Windmilling',
                'name_ch' => 'Windmilling',
                'key' => 'windmilling',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 18,
                'created' => '2023-11-10 18:35:29',
            ],




            [
                'no' => 146,
                'name_th' => 'สนามบิน',
                'name_en' => 'Airport',
                'name_jp' => 'Airport',
                'name_ch' => 'Airport',
                'key' => 'airport',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 19,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 147,
                'name_th' => 'ท่าเรือ',
                'name_en' => 'Sea port',
                'name_jp' => 'Sea port',
                'name_ch' => 'Sea port',
                'key' => 'sea-port',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 19,
                'created' => '2023-11-10 18:35:29',
            ],




            [
                'no' => 148,
                'name_th' => 'โรงเรียนอนุบาล',
                'name_en' => 'Kindergarten',
                'name_jp' => 'Kindergarten',
                'name_ch' => 'Kindergarten',
                'key' => 'kindergarten',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 20,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 149,
                'name_th' => 'โรงเรียนประถม',
                'name_en' => 'Primary school',
                'name_jp' => 'Primary school',
                'name_ch' => 'Primary school',
                'key' => 'primary-school',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 20,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 150,
                'name_th' => 'มัธยมต้น',
                'name_en' => 'Junior high school',
                'name_jp' => 'Junior high school',
                'name_ch' => 'Junior high school',
                'key' => 'junior-high-school',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 20,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 151,
                'name_th' => 'มัธยมปลาย',
                'name_en' => 'High school',
                'name_jp' => 'High school',
                'name_ch' => 'High school',
                'key' => 'high-school',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 20,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 152,
                'name_th' => 'มหาวิทยาลัย',
                'name_en' => 'University',
                'name_jp' => 'University',
                'name_ch' => 'University',
                'key' => 'university',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 20,
                'created' => '2023-11-10 18:35:29',
            ],




            [
                'no' => 153,
                'name_th' => 'สถานทูต',
                'name_en' => 'Emblessy',
                'name_jp' => 'Emblessy',
                'name_ch' => 'Emblessy',
                'key' => 'university',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 21,
                'created' => '2023-11-10 18:35:29',
            ],




            [
                'no' => 154,
                'name_th' => 'การเชื่อมต่อโครงข่าย',
                'name_en' => 'Interconnection',
                'name_jp' => 'Interconnection',
                'name_ch' => 'Interconnection',
                'key' => 'interconnection',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 22,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 155,
                'name_th' => 'การสื่อสารทางวิทยุ',
                'name_en' => 'Radio communication',
                'name_jp' => 'Radio communication',
                'name_ch' => 'Radio communication',
                'key' => 'radio-communication',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 22,
                'created' => '2023-11-10 18:35:29',
            ],




            [
                'no' => 156,
                'name_th' => 'ธนาคาร',
                'name_en' => 'Bank',
                'name_jp' => 'Bank',
                'name_ch' => 'Bank',
                'key' => 'bank',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 23,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 157,
                'name_th' => 'ประกันภัย',
                'name_en' => 'Insurance',
                'name_jp' => 'Insurance',
                'name_ch' => 'Insurance',
                'key' => 'insurance',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 23,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 158,
                'name_th' => 'ลีสซิ่ง',
                'name_en' => 'Leasing',
                'name_jp' => 'Leasing',
                'name_ch' => 'Leasing',
                'key' => 'insurance',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 23,
                'created' => '2023-11-10 18:35:29',
            ],




            [
                'no' => 159,
                'name_th' => 'มนุษย์',
                'name_en' => 'Human',
                'name_jp' => 'Human',
                'name_ch' => 'Human',
                'key' => 'human',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 24,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 160,
                'name_th' => 'สัตว์',
                'name_en' => 'Animal',
                'name_jp' => 'Animal',
                'name_ch' => 'Animal',
                'key' => 'animal',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 24,
                'created' => '2023-11-10 18:35:29',
            ],




            [
                'no' => 161,
                'name_th' => 'ตัวแทนทัวร์',
                'name_en' => 'Travel agency',
                'name_jp' => 'Travel agency',
                'name_ch' => 'Travel agency',
                'key' => 'travel-agency',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 25,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 162,
                'name_th' => 'โรงแรม',
                'name_en' => 'Hotel',
                'name_jp' => 'Hotel',
                'name_ch' => 'Hotel',
                'key' => 'hotel',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 25,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 163,
                'name_th' => 'รถเช่า',
                'name_en' => 'Car for rent',
                'name_jp' => 'Car for rent',
                'name_ch' => 'Car for rent',
                'key' => 'car-for-rent',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 25,
                'created' => '2023-11-10 18:35:29',
            ],




            [
                'no' => 164,
                'name_th' => 'ครัว',
                'name_en' => 'Kitchen',
                'name_jp' => 'Kitchen',
                'name_ch' => 'Kitchen',
                'key' => 'kitchen',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 26,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 165,
                'name_th' => 'อิเล็กทรอนิกส์',
                'name_en' => 'Electronic',
                'name_jp' => 'Electronic',
                'name_ch' => 'Electronic',
                'key' => 'electronic',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 26,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 166,
                'name_th' => 'รีโนเวท',
                'name_en' => 'Renovation',
                'name_jp' => 'Renovation',
                'name_ch' => 'Renovation',
                'key' => 'renovation',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 26,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 167,
                'name_th' => 'การทำสวน',
                'name_en' => 'Gardening',
                'name_jp' => 'Gardening',
                'name_ch' => 'Gardening',
                'key' => 'gardening',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 26,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 168,
                'name_th' => 'ร้านค้า',
                'name_en' => 'Store',
                'name_jp' => 'Store',
                'name_ch' => 'Store',
                'key' => 'store',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 26,
                'created' => '2023-11-10 18:35:29',
            ],




            [
                'no' => 169,
                'name_th' => 'รีโนเวท',
                'name_en' => 'Renovation',
                'name_jp' => 'Renovation',
                'name_ch' => 'Renovation',
                'key' => 'renovation',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 27,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 170,
                'name_th' => 'ห้องสต๊อก',
                'name_en' => 'Stock room',
                'name_jp' => 'Stock room',
                'name_ch' => 'Stock room',
                'key' => 'stock-room',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 27,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 171,
                'name_th' => 'วิศวกรรมและการบำรุงรักษา',
                'name_en' => 'Engineering & Maintenance',
                'name_jp' => 'Engineering & Maintenance',
                'name_ch' => 'Engineering & Maintenance',
                'key' => 'engineering-maintenance',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 27,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 172,
                'name_th' => 'ร้านขายยา',
                'name_en' => 'Drug store',
                'name_jp' => 'Drug store',
                'name_ch' => 'Drug store',
                'key' => 'drug-store',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 27,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 173,
                'name_th' => 'เครื่องสำอาง',
                'name_en' => 'Cosmetic',
                'name_jp' => 'Cosmetic',
                'name_ch' => 'Cosmetic',
                'key' => 'cosmetic',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 27,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 174,
                'name_th' => 'สัตว์เลี้ยง',
                'name_en' => 'Pet',
                'name_jp' => 'Pet',
                'name_ch' => 'Pet',
                'key' => 'pet',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 27,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 175,
                'name_th' => 'กีฬาและความบันเทิง',
                'name_en' => 'Sport & Entertainment',
                'name_jp' => 'Sport & Entertainment',
                'name_ch' => 'Sport & Entertainment',
                'key' => 'sport-entertainment',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 27,
                'created' => '2023-11-10 18:35:29',
            ],
            [
                'no' => 176,
                'name_th' => 'อื่นๆ',
                'name_en' => 'Other',
                'name_jp' => 'Other',
                'name_ch' => 'Other',
                'key' => 'other',
                'status' => 0,
                'coming_soon' => 1,
                'category_sub' => 27,
                'created' => '2023-11-10 18:35:29',
            ]
        ];
    }
}
