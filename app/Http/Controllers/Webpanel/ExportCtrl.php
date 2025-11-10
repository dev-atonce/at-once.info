<?php

namespace App\Http\Controllers\Webpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ExportCtrl extends Controller
{

    public function index()
    {
        // \DB::enableQueryLog();
        // $link1 = url('webpanel/export/jp-online-license');
        // $link2 = url('webpanel/export/basic-company-no-refuse');

        // echo ('<style>*{font-family:Arial, Helvetica, sans-serif; font-size:14px;}</style>');
        // echo ("<p>1. Japanese Company, Online, License >> <a href='$link1' target='_blank'>Export</a></p>");
        // $allCount = \App\Models\CompanyMd::select('company.name_th')
        //     ->join('job_cs as jcs', 'company.id', 'jcs.company')
        //     ->where('company.type', 'basic')
        //     ->whereNull('jcs.refuse')
        //     ->get()
        //     ->count();
        // $allCount = number_format($allCount);
        // echo ("<p style='margin-bottom: 5px'>2. Basic Company, No refuse <small style='font-size:12px;'>(All basic company <strong>$allCount</strong>)</small></p>");


        // $sql = \App\Models\CompanyMd::select('company.name_th')
        //     ->join('job_cs as jcs', 'company.id', 'jcs.company')
        //     ->where('company.type', 'basic')
        //     ->whereNull('jcs.refuse')
        //     ->groupBy('company.name_th')
        //     ->get();

        // $all = $sql->count();
        // $no = ceil($all / 1000);
        // $url = url('webpanel/export');
        // for ($i = 0; $i < $no; $i++) {
        //     $start = $i == 0 ? 1 : ($i * 1000) + 1;
        //     $end = $i == 0 ? 1000 : ($i + 1) * 1000;
        //     echo '<a style="margin-left:15px;" href="' . $url . '/basic-company-no-refuse/' . $start . '-' . $end . '" target="_blank">ไฟล์ ' . ($i + 1) . '. จาก ' . $start . ' ~ ' . $end . '</a><br>';
        // }
        // dd(\DB::getQueryLog());

        // new function
        echo ('<style>*{font-family:Arial, Helvetica, sans-serif; font-size:14px;}</style>');
        $allCount = \App\Models\CompanyMd::count();
        echo ("<p style='margin-bottom: 5px'>All company <small style='font-size:12px;'>(All company <strong>$allCount</strong>)</small></p>");

        $no = ceil($allCount / 1000);
        $url = url('webpanel/export');
        for ($i = 0; $i < $no; $i++) {
            $start = $i == 0 ? 1 : ($i * 1000) + 1;
            $end = $i == 0 ? 1000 : ($i + 1) * 1000;
            $end = $end > $allCount ? $allCount : $end;
            echo '<a style="margin-left:15px;" href="' . $url . '/company-all/' . $start . '-' . $end . '" target="_blank">ไฟล์ ' . ($i + 1) . '. จาก ' . $start . ' ~ ' . $end . '</a><br>';
        }
    }
    public function allCompany(Request $request)
    {
        $models = \App\Models\CompanyMd::class;
        $data = $models::select(['company.name_th', 'company.name_jp', 'company.phone', 'company.email', 'company.address_th', 'company.address_jp', 'company.profile_url', 'category.key as category', 'category.name_jp as category_name'])
            ->leftJoin('category', 'company.category', '=', 'category.id')
            ->where('public', 1)
            ->orderBy('category.id')
            ->get();

        $fileName = "all-company_" . date('d-m-Y') . ".csv";

        $headers = array(
            "Charset" => "utf-8",
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('Category', 'Name TH', 'Name JP', 'Telephone', 'Email', 'Address TH', 'Address JP', 'Website');

        $callback = function () use ($data, $columns) {
            $file = fopen('php://output', 'w');
            fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF))); // set ภาษาไทย
            fputcsv($file, $columns);
            foreach ($data as $task) {
                $row['category'] = $task->category_name;
                $row['Name TH'] = $task->name_th;
                $row['Name JP'] = $task->name_jp;
                $row['Telephone'] = $task->phone;
                $row['Email'] = $task->email;
                $row['Address TH'] = $task->address_th;
                $row['Address JP'] = $task->address_jp;
                $row['Website'] = url("/th/$task->category/cp/$task->profile_url");
                fputcsv($file, [$row['Category'], $row['Name TH'], $row['Name JP'], $row['Telephone'], $row['Email'], $row['Address TH'], $row['Address JP'], $row['Website']]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers)->send();
    }

    public function allCategory()
    {
        try {
            $data = \App\Models\CompanyMd::select([
                'company.name_th',
                'company.name_jp',
                'company.address_th',
                'company.address_jp',
                'company.phone',
                'company.mobile',
                'company.email',
                'company.website',
                'category.name_jp as categoryName'
            ])
                ->leftJoin('category', 'company.category', 'category.id')
                ->where('company.type', 'full')
                ->orderBy('company.name_th', 'ASC')
                ->get();

            $fileName = "All-Company-" . date('d-m-Y') . ".csv";

            $headers = array(
                "Charset" => "utf-8",
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );

            $columns = array('No.', 'Category', 'Name TH', 'Name JP', 'Telephone', 'Mobile', 'Email', 'Address TH', 'Address JP', 'Website');

            $callback = function () use ($data, $columns) {
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF))); // set ภาษาไทย
                fputcsv($file, $columns);
                foreach ($data as $k => $rs) {
                    fputcsv($file, [
                        $k + 1,
                        $rs->categoryName,
                        $rs->name_th,
                        $rs->name_jp,
                        $rs->phone,
                        $rs->mobile,
                        $rs->email,
                        $rs->address_th,
                        $rs->address_jp,
                        $rs->website,
                    ]);
                }
            };
            return response()->stream($callback, 200, $headers)->send();
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
        } catch (\ErrorException $e) {
            dd($e->getMessage());
        }
    }

    public function category(Request $request, $id = null)
    {
        try {
            $data = \App\Models\CompanyMd::leftJoin('job_cs', 'company.id', '=', 'job_cs.company')
                ->leftJoin('category', 'company.category', '=', 'category.id')
                ->where([
                    'company.category' => $id,
                    // 'company.type' => 'basic',
                    // 'company.public' => 1,
                ])
                // ->whereNull('job_cs.refuse')
                // ->whereNotNull(['company.more_th', 'job_progress.step3', 'company.checked'])
                ->select([
                    'company.id',
                    'company.name_th',
                    'company.name_jp',
                    'company.address_th',
                    'company.address_jp',
                    'company.phone',
                    'company.email',
                    'company.license_attachfile',
                    'category.key as category',
                    'company.profile_url'
                ])
                ->orderBy('company.name_th', 'desc')
                ->get();

            // $category = \App\Models\CategoryMd::find($id);
            $fileName = "Real-Basic" . date('d-m-Y') . ".csv";

            $headers = array(
                "Charset" => "utf-8",
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );

            $columns = array('No.', 'Name TH', 'Name JP', 'Telephone', 'Email', 'Address TH', 'Address JP', 'full_profile_url' , 'license_attachfile');

            $callback = function () use ($data, $columns) {
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF))); // set ภาษาไทย
                fputcsv($file, $columns);
                foreach ($data as $k => $rs) {
                    fputcsv($file, [
                        $k + 1,
                        $rs->name_th,
                        $rs->name_jp,
                        $rs->phone,
                        $rs->email,
                        $rs->address_th,
                        $rs->address_jp,
                        $rs->profile_url ? url("/th/$rs->category/cp/$rs->profile_url") : '',
                        $rs->license_attachfile ? url($rs->license_attachfile) : ''
                    ]);
                }
            };
            return response()->stream($callback, 200, $headers)->send();
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
        } catch (\ErrorException $e) {
            dd($e->getMessage());
        }
    }

    public function copyright(Request $request, $id = null)
    {
        try {
            $data = \App\Models\CompanyMd::where([
                'company.category' => $id,
                'company.type' => 'full',
                // 'company.public' => 0
            ])
                ->leftJoin('job_cs', 'company.id', 'job_cs.company')
                // ->leftJoin('job_progress', 'company.id', 'job_progress.company')
                ->whereNotNull('company.license_attachfile')
                // ->whereNotNull(['company.more_th', 'job_progress.step3', 'company.checked'])
                ->whereNull('job_cs.refuse')
                // ->whereMonth('job_cs.attachfile','7')
                ->select([
                    'company.name_th',
                    'company.name_jp',
                    'company.address_th',
                    'company.address_jp',
                    'company.phone',
                    'company.mobile',
                    'company.email',
                    'company.license',
                ])
                ->orderBy('company.created', 'desc')
                ->get();

            $category = \App\Models\CategoryMd::find($id);
            $fileName = "$category->name_jp-copyright-" . date('d-m-Y') . ".csv";

            $headers = array(
                "Charset" => "utf-8",
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );

            $columns = array('No.', 'Name TH', 'Name JP', 'Telephone', 'Mobile', 'Email', 'License', 'Address TH', 'Address JP');

            $callback = function () use ($data, $columns) {
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF))); // set ภาษาไทย
                fputcsv($file, $columns);
                foreach ($data as $k => $rs) {
                    fputcsv($file, [
                        $k + 1,
                        $rs->name_th,
                        $rs->name_jp,
                        $rs->phone,
                        $rs->mobile,
                        $rs->email,
                        $rs->license,
                        $rs->address_th,
                        $rs->address_jp,
                    ]);
                }
            };
            return response()->stream($callback, 200, $headers)->send();
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
        } catch (\ErrorException $e) {
            dd($e->getMessage());
        }
    }

    public function refuseOnly(Request $request, $id = null)
    {
        try {
            $data = \App\Models\CompanyMd::where([
                'company.category' => $id,
                'company.type' => 'full',
                // 'company.public' => 0
            ])
                ->leftJoin('job_cs', 'company.id', 'job_cs.company')
                ->leftJoin('job_progress', 'company.id', 'job_progress.company')
                ->whereNotNull('job_cs.refuse')
                ->whereNotNull(['company.more_th', 'job_progress.step3', 'company.checked'])
                // ->whereNull('company.license_attachfile')
                ->select([
                    'company.name_th',
                    'company.name_jp',
                    'company.address_th',
                    'company.address_jp',
                    'company.phone',
                    'company.mobile',
                    'company.email',
                    'company.license',
                ])
                ->orderBy('company.created', 'desc')
                ->get();

            $category = \App\Models\CategoryMd::find($id);
            $fileName = "$category->name_jp-refuse-" . date('d-m-Y') . ".csv";

            $headers = array(
                "Charset" => "utf-8",
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );

            $columns = array('No.', 'Name TH', 'Name JP', 'Telephone', 'Mobile', 'Email', 'License', 'Address TH', 'Address JP');

            $callback = function () use ($data, $columns) {
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF))); // set ภาษาไทย
                fputcsv($file, $columns);
                foreach ($data as $k => $rs) {
                    fputcsv($file, [
                        $k + 1,
                        $rs->name_th,
                        $rs->name_jp,
                        $rs->phone,
                        $rs->mobile,
                        $rs->email,
                        $rs->license,
                        $rs->address_th,
                        $rs->address_jp,
                    ]);
                }
            };
            return response()->stream($callback, 200, $headers)->send();
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
        } catch (\ErrorException $e) {
            dd($e->getMessage());
        }
    }

    public function companyToTxt($id)
    {
        $data = \App\Models\CompanyMd::find($id);
        $text = '';
        if ($data->id) {

            $fileName = "export/company/$data->id-$data->name_jp.txt";

            $headers = array(
                "Charset" => "utf-8",
                "Content-type" => "text/plain",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );

            $text .= "id => $data->id\r\category => $data->category\r\nname_th => $data->name_th\r\nname_jp => $data->name_jp\r\nprofile_url => $data->profile_url\r\nname_th => $data->name_th\r\nname_jp => $data->name_jp\r\ncountry => $data->country\r\nemail => $data->country\r\naddress_th => $data->address_th\r\naddress_jp => $data->address_jp\r\nprovince => $data->province\r\ndistrict => $data->district\r\nsubdistrict => $data->subdistrict\r\npostcode => $data->postcode\r\nphone => $data->phone\r\nmobile => $data->mobile\r\nfax => $data->fax\r\ncover => $data->cover\r\nlogo => $data->logo\r\nservice => $data->service\r\nfacebook => $data->facebook\r\nline => $data->line\r\nwetsite => $data->wetsite\r\ngmap => $data->gmap\r\n
description_th => $data->description_th\r\ndescription_jp => $data->description_jp\r\ndetail_th => $data->detail_th\r\ndetail_jp => $data->detail_jp\r\nmore_th => $data->more_th\r\nmore_jp => $data->more_jp\r\nreason => $data->reason\r\nvideo_profile => $data->video_profile\r\nvideo_position => $data->video_position\r\nlicense => $data->license\r\nlicense_by => $data->license_by\r\nedited => $data->edited\r\nedited_by => $data->edited_by\r\ndesign => $data->design\r\ndesign_by => $data->design_by\r\npublic => $data->public\r\npublic_by => $data->public_by\r\npublished_on => $data->published_on\r\ncreated => $data->created\r\ncreated_by => $data->created_by\r\nupdated => $data->updated\r\nupdated_by => $data->updated_by\r\n";


            Storage::disk(env('disk', 'ftp'))->put($fileName, $text);
            // return Storage::disk(env('disk','ftp'))->download($fileName);
            return Response()->download($fileName, "$data->id-$data->name_jp.txt", $headers);
        }
    }

    public function CompanyInCategory()
    {
        try {

            $all = \App\Models\CompanyMd::select('name_th')
                ->leftJoin('job_progress as jp', 'company.id', '=', 'jp.company')
                ->leftJoin('job_cs as jc', 'company.id', '=', 'jc.company')
                ->whereNull(['company.license_attachfile', 'jc.refuse'])
                ->whereNotNull(['company.more_th', 'jp.step3', 'company.checked'])
                ->where([
                    'company.type' => 'full',
                    'company.public' => 0
                ])
                ->where('company.id', '!=', 64) // this test company
                ->groupBy('name_th')
                ->get()->count();
            $no = ceil($all / 1000);
            for ($i = 0; $i < $no; $i++) {
                $start = $i == 0 ? 1 : ($i * 1000) + 1;
                $end = $i == 0 ? 1000 : ($i + 1) * 1000;
                echo '<a href="company-in-category/' . $start . '-' . $end . '" target="_blank">ไฟล์ ' . ($i + 1) . ' - จาก ' . $start . ' ~ ' . $end . '</a><br>';
            }
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
        } catch (\ErrorException $e) {
            dd($e->getMessage());
        }
    }

    public function ExportCompanyInCategory($request)
    {
        try {
            $request = explode('-', $request);

            $data = \App\Models\CompanyMd::select(['company.id', 'company.name_th', 'company.phone', 'company.email', 'company.address_th'])
                ->leftJoin('job_progress as jp', 'company.id', '=', 'jp.company')
                ->leftJoin('job_cs as jc', 'company.id', '=', 'jc.company')
                ->whereNull(['company.license_attachfile', 'jc.refuse'])
                ->whereNotNull(['company.more_th', 'jp.step3', 'company.checked'])
                ->where([
                    'company.type' => 'full',
                    'company.public' => 0
                ])
                ->where('company.id', '!=', 64) // this test company
                ->groupBy('company.name_th')
                ->orderBy('company.name_th')
                ->skip($request[0])
                ->take(1000)
                ->get();

            $industry = [];
            foreach ($data as $k => $v) {
                $ind = \App\Models\CompanyMd::where('company.name_th', $v->name_th)
                    ->select(['in.name_jp as k'])
                    ->leftJoin('industry as in', 'company.industry', '=', 'in.id')
                    ->get();
                $industry[] = (object) [
                    'no' => $request[0] + $k,
                    'id' => $v->id,
                    'name' => $v->name_th,
                    'phone' => $v->phone,
                    'email' => $v->email,
                    'industry' => $ind,
                    'address' => $v->address_th
                ];
            }

            $fileName = "export/company-in-category/company($request[0]-$request[1]).csv";
            $headers = array(
                "Charset" => "utf-8",
                "Content-type" => "text/plain",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );
            $columns = array('No.', 'Company name', 'Sum Category', 'List Category', 'Tel.', 'Email', 'Address');


            $callback = function () use ($industry, $columns) {
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF))); // set ภาษาไทย
                fputcsv($file, $columns);
                $sumCategory = [];
                $listCategory = [];
                for ($i = 0; $i < count($industry); $i++) {
                    $arr = [];
                    foreach ($industry[$i]->industry as $k => $v) {
                        $arr[] = $v->k;
                        $sumCategory[$i] = count($arr);
                        $listCategory[$i] = implode(",\n ", $arr);
                        fputcsv($file, [
                            $industry[$i]->no,
                            $industry[$i]->name,
                            $sumCategory[$i],
                            $listCategory[$i],
                            $industry[$i]->phone,
                            $industry[$i]->email,
                            $industry[$i]->address
                        ]);
                    }
                }
            };
            return response()->stream($callback, 200, $headers)->send();
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
        } catch (\ErrorException $e) {
            dd($e->getMessage());
        }
    }

    public function exportCategory()
    {
        try {
            $data = \App\Models\CategoryMd::select([
                'name_jp',
                'name_th',
                'status',
                'coming_soon'
            ])
                ->get();

            $fileName = "All_category.csv";

            $headers = array(
                "Charset" => "utf-8",
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );

            $columns = array('No.', 'Name TH', 'Name EN', 'Status');

            $callback = function () use ($data, $columns) {
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF))); // set ภาษาไทย
                fputcsv($file, $columns);
                foreach ($data as $k => $rs) {
                    if ($rs->coming_soon == 1) {
                        $status = '';
                    } else {
                        $status = 'on';
                    }
                    fputcsv($file, [
                        $k + 1,
                        $rs->name_th,
                        $rs->name_jp,
                        $status,
                    ]);
                }
            };
            return response()->stream($callback, 200, $headers)->send();
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
        } catch (\ErrorException $e) {
            dd($e->getMessage());
        }
    }
    public function exportOnlineCategory()
    {

        try {
            $data = \App\Models\CategoryMd::select(['id', 'name_jp', 'name_th', 'status', 'coming_soon', 'key'])->get();
            $fileName = "company-in-website-" . date('d-m-Y') . ".csv";

            $headers = array(
                "Charset" => "utf-8",
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );

            $columns = array('NO.', 'CATEGORY', 'TOTAL', 'ONLINE FULL', 'NO ATTACHFILE', 'COPYRIGHT', 'OFFLINE', 'TOTAL BASIC', 'BAISC YP', 'REFUSE', 'ON PROCESS');

            $callback = function () use ($data, $columns) {
                $CompanyMd = \App\Models\CompanyMd::class;
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF))); // set ภาษาไทย
                fputcsv($file, $columns);
                foreach ($data as $k => $row) {
                    $total = $CompanyMd::where('category', $row->id)->count();

                    $onlineFull = $CompanyMd
                        ::where(['type' => 'full', 'public' => 1, 'category' => $row->id])
                        ->count();

                    $no_attachfile = $CompanyMd::where(['type' => 'full', 'license_attachfile' => null, 'category' => $row->id])->count();

                    $copyright = $CompanyMd
                        ::join('job_cs', 'company.id', 'job_cs.company')
                        ->where(['type' => 'full', 'category' => $row->id])
                        ->whereNotNull('license_attachfile')
                        ->count();

                    $offline = $CompanyMd::where(['type' => 'full', 'public' => 0, 'category' => $row->id])->count();

                    $basicYp = $CompanyMd
                        ::join('job_progress', 'company.id', 'job_progress.company')
                        ->where([
                            'company.type' => 'basic',
                            'company.resource' => 'import',
                            'category' => $row->id,
                        ])
                        ->count();

                    $refuse = $CompanyMd
                        ::join('job_cs', 'company.id', 'job_cs.company')
                        ->where([
                            'category' => $row->id,
                        ])
                        ->whereNotNull('job_cs.refuse')
                        ->count();

                    $onprocess = $CompanyMd
                        ::join('job_progress', 'company.id', 'job_progress.company')
                        ->join('job_cs', 'company.id', 'job_cs.company')
                        ->where([
                            'company.type' => 'basic',
                            'category' => $row->id,
                        ])
                        ->whereNull(['job_cs.refuse', 'resource'])
                        ->count();
                    $status = ($row->status == 1 && $row->coming_soon == 0) ? '-Online' : '';
                    fputcsv($file, [
                        $k + 1,
                        $row->name_jp . $status,
                        $total,
                        $onlineFull,
                        $no_attachfile,
                        $copyright,
                        $offline,
                        $basicYp + $refuse,
                        $basicYp,
                        $refuse,
                        $onprocess,
                    ]);
                }
            };
            return response()->stream($callback, 200, $headers)->send();
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
        } catch (\ErrorException $e) {
            dd($e->getMessage());
        }
    }

    public function exportOnSiteCategory()
    {

        try {
            $data = \App\Models\CategoryMd::select(['id', 'name_jp', 'name_th', 'status', 'coming_soon', 'key'])->where('status', 1)->get();
            $fileName = "company-in-website-" . date('d-m-Y') . ".csv";

            $headers = array(
                "Charset" => "utf-8",
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );

            $columns = array('NO.', 'CATEGORY', 'TOTAL', 'ONLINE FULL', 'NO ATTACHFILE', 'COPYRIGHT', 'OFFLINE', 'TOTAL BASIC', 'BAISC YP', 'REFUSE', 'ON PROCESS');

            $callback = function () use ($data, $columns) {
                $CompanyMd = \App\Models\CompanyMd::class;
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF))); // set ภาษาไทย
                fputcsv($file, $columns);
                foreach ($data as $k => $row) {
                    $total = $CompanyMd::where('category', $row->id)->count();

                    $onlineFull = $CompanyMd
                        ::where(['type' => 'full', 'public' => 1, 'category' => $row->id])
                        ->count();

                    $no_attachfile = $CompanyMd::where(['type' => 'full', 'license_attachfile' => null, 'category' => $row->id])->count();

                    $copyright = $CompanyMd
                        ::join('job_cs', 'company.id', 'job_cs.company')
                        ->where(['type' => 'full', 'category' => $row->id])
                        ->whereNotNull('license_attachfile')
                        ->count();

                    $offline = $CompanyMd::where(['type' => 'full', 'public' => 0, 'category' => $row->id])->count();

                    $basicYp = $CompanyMd
                        ::join('job_progress', 'company.id', 'job_progress.company')
                        ->where([
                            'company.type' => 'basic',
                            'company.resource' => 'import',
                            'category' => $row->id,
                        ])
                        ->count();

                    $refuse = $CompanyMd
                        ::join('job_cs', 'company.id', 'job_cs.company')
                        ->where([
                            'category' => $row->id,
                        ])
                        ->whereNotNull('job_cs.refuse')
                        ->count();

                    $onprocess = $CompanyMd
                        ::join('job_progress', 'company.id', 'job_progress.company')
                        ->join('job_cs', 'company.id', 'job_cs.company')
                        ->where([
                            'company.type' => 'basic',
                            'category' => $row->id,
                        ])
                        ->whereNull(['job_cs.refuse', 'resource'])
                        ->count();
                    $status = ($row->status == 1 && $row->coming_soon == 0) ? '-Online' : '';
                    fputcsv($file, [
                        $k + 1,
                        $row->name_jp . $status,
                        $total,
                        $onlineFull,
                        $no_attachfile,
                        $copyright,
                        $offline,
                        $basicYp + $refuse,
                        $basicYp,
                        $refuse,
                        $onprocess,
                    ]);
                }
            };
            return response()->stream($callback, 200, $headers)->send();
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
        } catch (\ErrorException $e) {
            dd($e->getMessage());
        }
    }

    public function emailDatabase(Request $request)
    {
        try {

            $source = $request->source;
            $date = $request->date ? $request->date : date('Y-m-01') . ' - ' . date('Y-m-t');

            $fileName = "export/email-database.csv";
            $headers = array(
                "Charset" => "utf-8",
                "Content-type" => "text/plain",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );
            $columns = array('No.', 'Email', 'Name', 'Company', 'Type');


            switch ($source) {
                case 'ma':
                    $data = \App\Models\ContactEmailMd::select('email', 'customer_name as name', 'company_name as company')
                        ->get();
                    $type = 'MA of customer';
                    break;
                case 'cpProfile+blogCt+formCat':
                    $data = \App\Models\SendToMd::select('email', 'name', 'company')
                        ->get();
                    $type = 'User to company';
                    break;
                case 'blogMk+1ceProfile+package+contact+basicCp':
                    $data = \App\Models\ContactMd::select('email', 'name', 'company')
                        ->get();
                    $type = 'Company or users to us';
                    break;
                default:
                    $data = \App\Models\CompanyMd::where('type', 'full')->select('email', 'created_by as name', 'name_th as company')
                        ->get();
                    $type = 'Company profile page';
                    break;
            }


            $callback = function () use ($data, $columns, $type) {
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF))); // set ภาษาไทย
                fputcsv($file, $columns);
                $sumCategory = [];
                $listCategory = [];
                for ($i = 0; $i < count($data); $i++) {
                    $arr = [];
                    foreach ($data[$i]->industry as $k => $v) {
                        fputcsv($file, [
                            $k + 1,
                            $v->name,
                            $v->phone,
                            $v->email,
                            $v->address
                        ]);
                    }
                }
            };
            return response()->stream($callback, 200, $headers)->send();
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
        } catch (\ErrorException $e) {
            dd($e->getMessage());
        }
    }

    public function exportRealBasic()
    {
        try {
            $data = \App\Models\CompanyMd::select([
                'company.name_jp',
                'company.name_th',
                'company.email',
                'category.name_th as categoryName',
            ])
                ->join('category', 'company.category', 'category.id')
                ->leftJoin('job_cs', 'company.id', 'job_cs.company')
                ->leftJoin('job_progress', 'company.id', 'job_progress.company')
                ->where('company.type', 'basic')
                ->whereNull(['job_progress.step3', 'job_cs.refuse'])
                ->orderBy('category.id', 'ASC')
                ->get();

            $fileName = "Basic-Company.csv";

            $headers = array(
                "Charset" => "utf-8",
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );

            $columns = array('No.', 'NameTH', 'NameEN', 'Email', 'Category');

            $callback = function () use ($data, $columns) {
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF))); // set ภาษาไทย
                fputcsv($file, $columns);
                foreach ($data as $k => $rs) {
                    fputcsv($file, [
                        $k + 1,
                        $rs->name_th,
                        $rs->name_jp,
                        $rs->email,
                        $rs->categoryName,
                    ]);
                }
            };
            return response()->stream($callback, 200, $headers)->send();
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
        } catch (\ErrorException $e) {
            dd($e->getMessage());
        }
    }

    /*
        1. รายชื่อ เบอร์โทร Email ของบริษัทสัญชาติ ญี่ปุ่น 
        2. ออนไลน์แล้ว 
        3. ได้Copy right แล้ว
        4. ทุกแคท
    */
    public function jpOnlineAndLicense()
    {
        try {
            $data = \App\Models\CompanyMd::leftJoin('countries as ct', 'company.country', 'ct.alpha2')
                ->where('company.public', 1)
                ->where('ct.alpha2', 'JP')
                ->whereNotNull('company.license_attachfile')
                ->select('company.name_th', 'company.name_en', 'company.email', 'company.phone', 'company.license_attachfile')
                ->get();

            $fileName = "jp-online-license.csv";
            $headers = array(
                "Charset" => "utf-8",
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );
            $columns = array('No.', 'NameTH', 'NameEN', 'Email', 'Telephone number', 'license');

            $callback = function () use ($data, $columns) {
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF))); // set ภาษาไทย
                fputcsv($file, $columns);
                foreach ($data as $k => $rs) {
                    fputcsv($file, [
                        $k + 1,
                        $rs->name_th,
                        $rs->name_en,
                        $rs->email,
                        $rs->phone,
                        url($rs->license_attachfile)
                    ]);
                }
            };
            return response()->stream($callback, 200, $headers)->send();
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
        } catch (\ErrorException $e) {
            dd($e->getMessage());
        }
    }
    /*
        1. ชื่อ เบอร์โทร Email ของเบสิค 
        2. No Reruse 
        3. ทุกแคท
    */

    public function companyAll($request)
    {
        try {
            $request = explode('-', $request);

            $data = \App\Models\CompanyMd::leftJoin('category', 'company.category', '=', 'category.id')
                ->select([
                    'company.id',
                    'company.name_th',
                    'company.name_jp',
                    'company.address_th',
                    'company.address_jp',
                    'company.phone',
                    'company.email',
                    'company.license_attachfile',
                    'category.key as category',
                    'company.profile_url'
                ])
                ->orderBy('company.id', 'desc')
                ->skip($request[0]-1)
                ->take(1000)
                ->get();

            $fileName = "all company ($request[0]-$request[1]).csv";
            $headers = array(
                "Charset" => "utf-8",
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );
            $columns = array('No.', 'Name TH', 'Name JP', 'Telephone', 'Email', 'Address TH', 'Address JP', 'full_profile_url' , 'license_attachfile');

            $callback = function () use ($data, $columns , $request) {
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF))); // set ภาษาไทย
                fputcsv($file, $columns);
                foreach ($data as $k => $rs) {
                    fputcsv($file, [
                        $k + $request[0],
                        $rs->name_th,
                        $rs->name_jp,
                        $rs->phone,
                        $rs->email,
                        $rs->address_th,
                        $rs->address_jp,
                        $rs->profile_url ? url("/th/$rs->category/cp/$rs->profile_url") : '',
                        $rs->license_attachfile ? url($rs->license_attachfile) : ''
                    ]);
                }
            };
            return response()->stream($callback, 200, $headers)->send();
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
        } catch (\ErrorException $e) {
            dd($e->getMessage());
        }
    }

    public function basicNoRefuse($request)
    {
        try {
            $request = explode('-', $request);

            $data = \App\Models\CompanyMd::leftJoin('job_cs as jcs', 'company.id', 'jcs.company')
                ->where('company.type', 'basic')
                ->whereNull('jcs.refuse')
                ->select('company.name_th', 'company.email', 'company.phone', 'company.category')
                ->groupBy('company.name_th')
                ->skip($request[0])
                ->take(1000)
                ->get();

            $fileName = "Basic - No Refuse ($request[0]-$request[1]).csv";
            $headers = array(
                "Charset" => "utf-8",
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );
            $columns = array('No.', 'Company name', 'Sum Category', 'List Category', 'Email', 'Telephone number');

            $category = [];
            foreach ($data as $k => $v) {
                $ind = \App\Models\CompanyMd::where('company.name_th', $v->name_th)
                    ->join('category as in', 'company.category', 'in.id')
                    ->select(['in.name_jp as k'])
                    ->get()
                    ->toArray();
                $category[] = (object) [
                    'no' => $k + 1,
                    'name' => $v->name_th,
                    'phone' => $v->phone,
                    'email' => $v->email,
                    'count' => count($ind),
                    'category' => implode(', ', array_column($ind, 'k'))
                ];
            }

            $callback = function () use ($category, $columns) {
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF))); // set ภาษาไทย
                fputcsv($file, $columns);

                for ($i = 0; $i < count($category); $i++) {
                    fputcsv($file, [
                        $category[$i]->no,
                        $category[$i]->name,
                        $category[$i]->count,
                        $category[$i]->category,
                        $category[$i]->email,
                        $category[$i]->phone
                    ]);
                }
            };
            return response()->stream($callback, 200, $headers)->send();
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
        } catch (\ErrorException $e) {
            dd($e->getMessage());
        }
    }

    public function exportSmsPopup(request $request)
    {
        $date = $request->date;
        if ($date)
            $date = explode('-', $date);
        try {
            $data = \App\Models\SMSHistoryMd::where('company', NULL)
                ->when($request->date, function ($query) use ($date) {
                    $query->where(DB::raw('DATE(created)'), '>=', date('Y-m-d', strtotime($date[0])))
                        ->where(DB::raw('DATE(created)'), '<=', date('Y-m-d', strtotime($date[1])));
                })
                ->orderBy('id', 'desc')
                ->get();

            $fileName = "SMSPopup-Report.csv";
            $headers = array(
                "Charset" => "utf-8",
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );
            $columns = array('No.', 'Date', 'Name', 'Telephone', 'Message');

            $callback = function () use ($data, $columns) {
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF))); // set ภาษาไทย
                fputcsv($file, $columns);
                foreach ($data as $k => $rs) {
                    fputcsv($file, [
                        $k + 1,
                        $rs->created,
                        $rs->name,
                        $rs->telephone,
                        $rs->message,
                    ]);
                }
            };
            return response()->stream($callback, 200, $headers)->send();
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
        } catch (\ErrorException $e) {
            dd($e->getMessage());
        }
    }

    public function exportPackageForm(request $request)
    {
        try {
            $date = $request->date;
            if ($date)
                $date = explode('-', $date);

            $data = \App\Models\ContactMd::where('type', 'package')
                ->when($request->date, function ($query) use ($date) {
                    $query->where(DB::raw('DATE(created)'), '>=', date('Y-m-d', strtotime($date[0])))
                        ->where(DB::raw('DATE(created)'), '<=', date('Y-m-d', strtotime($date[1])));
                })
                ->orderBy('id', 'desc')
                ->get();
            $fileName = "PackageForm-Report.csv";
            $headers = array(
                "Charset" => "utf-8",
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );
            $columns = array('No.', 'Date', 'Package', 'Name', 'telephone', 'email', 'Department', 'Detail');

            $callback = function () use ($data, $columns) {
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF))); // set ภาษาไทย
                fputcsv($file, $columns);
                foreach ($data as $k => $rs) {
                    fputcsv($file, [
                        $k + 1,
                        $rs->created,
                        $rs->package,
                        $rs->name,
                        $rs->telephone,
                        $rs->email,
                        $rs->department,
                        $rs->detail,
                    ]);
                }
            };
            return response()->stream($callback, 200, $headers)->send();
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
        } catch (\ErrorException $e) {
            dd($e->getMessage());
        }
    }

    public function exportContactUsForm(request $request)
    {
        try {
            $date = $request->date;
            if ($date)
                $date = explode('-', $date);

            $data = \App\Models\ContactMd::whereNull('type')
                ->when($request->date, function ($query) use ($date) {
                    $query->where(DB::raw('DATE(created)'), '>=', date('Y-m-d', strtotime($date[0])))
                        ->where(DB::raw('DATE(created)'), '<=', date('Y-m-d', strtotime($date[1])));
                })
                ->orderBy('id', 'desc')
                ->get();
            $fileName = "ContactUsForm-Report.csv";
            $headers = array(
                "Charset" => "utf-8",
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );
            $columns = array('No.', 'Date', 'Package', 'Name', 'telephone', 'email', 'Deaprtment', 'Detail');

            $callback = function () use ($data, $columns) {
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF))); // set ภาษาไทย
                fputcsv($file, $columns);
                foreach ($data as $k => $rs) {
                    fputcsv($file, [
                        $k + 1,
                        $rs->created,
                        $rs->package,
                        $rs->name,
                        $rs->telephone,
                        $rs->email,
                        $rs->department,
                        $rs->detail,
                    ]);
                }
            };
            return response()->stream($callback, 200, $headers)->send();
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
        } catch (\ErrorException $e) {
            dd($e->getMessage());
        }
    }

    public function exportBasicForm(request $request)
    {
        try {
            $date = $request->date;
            if ($date)
                $date = explode('-', $date);

            $data = \App\Models\ContactMd::where('type', 'basic')
                ->when($request->date, function ($query) use ($date) {
                    $query->where(DB::raw('DATE(created)'), '>=', date('Y-m-d', strtotime($date[0])))
                        ->where(DB::raw('DATE(created)'), '<=', date('Y-m-d', strtotime($date[1])));
                })
                ->orderBy('id', 'desc')
                ->get();
            $fileName = "BasicForm-Report.csv";
            $headers = array(
                "Charset" => "utf-8",
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );
            $columns = array('No.', 'Date', 'Package', 'Name', 'telephone', 'email', 'Detail');

            $callback = function () use ($data, $columns) {
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF))); // set ภาษาไทย
                fputcsv($file, $columns);
                foreach ($data as $k => $rs) {
                    fputcsv($file, [
                        $k + 1,
                        $rs->created,
                        $rs->package,
                        $rs->name,
                        $rs->telephone,
                        $rs->email,
                        $rs->detail,
                    ]);
                }
            };
            return response()->stream($callback, 200, $headers)->send();
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
        } catch (\ErrorException $e) {
            dd($e->getMessage());
        }
    }

    public function inquiryPopup()
    {
        try{

            $data = \App\Models\SMSHistoryMd::leftJoin('company as cp','sms_history.company','cp.id')
            ->leftJoin('category', 'cp.category', 'category.id')
            ->select([
                'sms_history.name',
                'sms_history.user_company',
                'sms_history.telephone',
                'sms_history.email',
                'sms_history.message',
                'cp.name_en as company',
                'category.name_en as categoryName',
                'sms_history.created'
            ])
            ->get();
            $fileName = "inquiry-popup.csv";
            $headers = array(
                "Charset" => "utf-8",
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );
            $columns = array('No.', 'Name', 'User company', 'Telephone', 'Email', 'Message', 'To Company', 'Category Name', 'Created');
            $callback = function () use ($data, $columns) {
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF))); // set ภาษาไทย
                fputcsv($file, $columns);
                foreach ($data as $k => $rs) {
                    fputcsv($file, [
                        $k + 1,
                        $rs->name,
                        $rs->user_company,
                        $rs->telephone,
                        $rs->email,
                        $rs->message,
                        $rs->company,
                        $rs->categoryName,
                        $rs->created,
                    ]);
                }
            };
            return response()->stream($callback, 200, $headers)->send();


        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
        } catch (\ErrorException $e) {
            dd($e->getMessage());
        }
    }

    public function inquiryCustomer()
    {
        try{
            $data = \App\Models\SendToMd::
                select([
                    "send_to.to as customerEmail",
                    "send_to.to_company as customerName",
                    "send_to.company_tel as customerTel",
                    "send_to.subject",
                    "send_to.company as userCompany",
                    "send_to.telephone as userTelephone",
                    "send_to.department as userDepartment",
                    "send_to.name as userName",
                    "send_to.email as userEmail",
                    "send_to.content as userDetail",
                    "send_to.created"
                ])
                ->whereNotIn("send_to.status", ['waiting', 'reject', 'revise'])
                ->orderByDesc("send_to.created")
                ->get();
                $fileName = "inquiry-email.csv";
                $headers = array(
                    "Charset" => "utf-8",
                    "Content-type" => "text/csv",
                    "Content-Disposition" => "attachment; filename=$fileName",
                    "Pragma" => "no-cache",
                    "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                    "Expires" => "0"
                );
                $columns = array('No.', 'User Name', 'User Detail', 'Detail of Contact', 'Company Detail', 'Created');
                $callback = function () use ($data, $columns) {
                    $file = fopen('php://output', 'w');
                    fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF))); // set ภาษาไทย
                    fputcsv($file, $columns);
                    foreach ($data as $k => $rs) {
                        fputcsv($file, [
                            $k + 1,
                            $rs->userName,
                            "$rs->userCompany, $rs->userDepartment, $rs->userEmail, $rs->userTelephone",
                            $rs->userDetail,
                            "$rs->customerName, $rs->customerEmail, $rs->customerTel",
                            $rs->created,
                        ]);
                    }
                };
            return response()->stream($callback, 200, $headers)->send();


        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
        } catch (\ErrorException $e) {
            dd($e->getMessage());
        }
    }

    public function mergeCompany()
    {
        try{
            $data = \App\Models\CompanyMd::
                select([
                    "company.id",
                    "company.name_th",
                    "company.name_jp",
                    "company.email",
                    "company.type",
                    "company.license_attachfile",
                ])
                ->where('category', 10)
                ->get();
                $fileName = "duplicate-company.csv";
                $headers = array(
                    "Charset" => "utf-8",
                    "Content-type" => "text/csv",
                    "Content-Disposition" => "attachment; filename=$fileName",
                    "Pragma" => "no-cache",
                    "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                    "Expires" => "0"
                );
                $columns = array('No.', 'Name TH', 'Name EN', 'Email', 'Type', 'License');
                $callback = function () use ($data, $columns) {
                    $file = fopen('php://output', 'w');
                    fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF))); // set ภาษาไทย
                    fputcsv($file, $columns);
                    foreach ($data as $k => $rs) {
                        $license = 0;
                        if ($rs->license_attachfile) {
                            $license = 1;
                        }
                        fputcsv($file, [
                            $k + 1,
                            $rs->name_th,
                            $rs->name_en,
                            $rs->email,
                            $rs->type,
                            $license
                        ]);
                    }
                };
            return response()->stream($callback, 200, $headers)->send();


        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
        } catch (\ErrorException $e) {
            dd($e->getMessage());
        }
    }
}
