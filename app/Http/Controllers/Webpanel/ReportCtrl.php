<?php

namespace App\Http\Controllers\Webpanel;

use App\Http\Controllers\Controller;
use App\Models\CategoryMd;
use App\Models\SendToMd;
use App\Models\SMSHistoryMd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ReportCtrl extends Controller
{
    public function __construct()
    {
        $this->prefix = 'webpanel';
        $this->folderPrefix = 'webpanel';
    }

    public function inquiryPopup(Request $request)
    {
        $category = SMSHistoryMd::leftJoin("company","sms_history.company","company.id")
                ->leftJoin("category", "company.category", "category.id")
                ->select(
                    DB::raw("COUNT(sms_history.id) as popupTotal"),
                    "category.name_th as categoryNameTH",
                    "category.name_en as categoryNameEN"
                )
                ->groupBy('category.id')
                ->get();

        $data = SMSHistoryMd::leftJoin('company as cp', 'sms_history.company', 'cp.id')
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
            ]);

        return view('back-end.modules.report.index', [
            'prefix' => $this->prefix,
            'countEmail' => SendToMd::whereNotIn("send_to.status", ['waiting', 'reject', 'revise'])->count(),
            'countPopup' =>  $data->count(),
            'data' => $data->paginate(25),
            'sumReport' => $category 
        ]);
    }

    public function inquiryCustomer(Request $request)
    {
        $category = SendToMd::leftJoin("company", "send_to.cid", "company.id")
                ->leftJoin("category", "company.category", "category.id")
                ->select(
                    DB::raw("COUNT(send_to.id) as emailTotal"),
                    "category.name_th as categoryNameTH",
                    "category.name_en as categoryNameEN"
                )
                ->whereNotIn("send_to.status", ['waiting', 'reject', 'revise'])
                ->groupBy('category.id')
                ->get();

        $data = SendToMd::
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
            ->orderByDesc("send_to.created");

        return view('back-end.modules.report.index', [
            'prefix' => $this->prefix,
            'countEmail' => $data->count(),
            'countPopup' => SMSHistoryMd::count(),
            'rows' => $data->paginate(25),
            'sumReport' => $category 
        ]);
    }
}
