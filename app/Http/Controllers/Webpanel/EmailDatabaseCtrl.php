<?php

namespace App\Http\Controllers\Webpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmailDatabaseCtrl extends Controller
{
    public function __construct()
    {
        $this->prefix = 'webpanel';
    }
    public function index(Request $request)
    {
        $source = $request->source;
        $date = $request->date ? $request->date : date('Y-m-01') . ' - ' . date('Y-m-t');

        // $query->whereDate('created','>=',explode(' - ',$date)[0])
        //     ->whereDate('created','<=',explode(' - ',$date)[1]);
        $count1 = \App\Models\ContactEmailMd::select('id')->groupBy('email')->get()->count();
        $count2 = \App\Models\SendToMd::select('id')->groupBy('email')->get()->count();
        $count3 = \App\Models\ContactMd::select('id')->groupBy('email')->get()->count();
        $count4 = \App\Models\MemberMd::select('id')->groupBy('email')->get()->count();

        switch ($source) {
            case 'ma':
                $get = \App\Models\ContactEmailMd::select('email', 'customer_name as name', 'company_name as company')->groupBy('email');
                break;
            case 'cpProfile+blogCt+formCat':
                $get = \App\Models\SendToMd::select('email', 'name', 'company')->groupBy('email');
                break;
            case 'blogMk+1ceProfile+package+contact+basicCp':
                $get = \App\Models\ContactMd::select('email', 'name', 'company')->groupBy('email');
                break;
            case 'all':
                $all = $this->allType();
                break;
            default:
                $get = \App\Models\MemberMd::select('members.email', 'c.created_by as name', 'members.name_th as company')
                    ->rightJoin('company as c','c._id','members.id');
                break;
        }
        if ($source != 'all') {
            $rows = $get->paginate(20)->withQueryString();
        } else {
            $rows = $all;
        }

        return view("back-end.modules.email_database.index", [
            'js' => ["back-end/jquery-3.5.1/jquery-3.5.1.min.js"],
            'prefix' => $this->prefix,
            'folder' => 'email_database',
            'page' => 'index',
            'rows' => $rows,
            'count' => [$count4, $count3, $count2, $count1],
            'total' => $count1 + $count2 + $count3 + $count4
        ]);
    }

    public function allType()
    {
        $get1 = \App\Models\ContactEmailMd::select('email', 'customer_name as name', 'company_name as company')->groupBy('email')->get();
        $get1->map(function($item){ $item->type = 'MA.'; });
        $get1 = $get1->toArray();

        $get2 = \App\Models\SendToMd::select('email', 'name', 'company')->groupBy('email')->get();
        $get2->map(function($item){ $item->type = 'Company Profile Page'; });
        $get2 = $get2->toArray();

        $get3 = \App\Models\ContactMd::select('email', 'name', 'company')->groupBy('email')->get();
        $get3->map(function($item){ $item->type = 'Users to company'; });
        $get3 = $get3->toArray();

        $get4 = \App\Models\MemberMd::select('members.email', 'c.created_by as name', 'members.name_th as company')
            ->rightJoin('company as c','c._id','members.id')->get();
        $get4->map(function($item){ $item->type = 'Company or users to us'; });
        $get4 = $get4->toArray();

        $all = array_merge($get1, $get2, $get3, $get4);
        return $all;
    }
}
