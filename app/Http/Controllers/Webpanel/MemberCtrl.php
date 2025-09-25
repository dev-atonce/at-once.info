<?php

namespace App\Http\Controllers\Webpanel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class MemberCtrl extends Controller
{


    public function __construct()
    {
        $this->path = 'back-end';
        $this->prefix = 'webpanel';
    }
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $view = (!empty($request->view)) ? $request->view : 40;
        $data = \App\Models\MemberMd::select('*');
        $data->when($request->keyword, function ($query) use ($keyword) {
            return $query->where(function ($query) use ($keyword) {
                return $query->whereRaw('REPLACE(members.name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                    ->orWhereRaw('REPLACE(members.name_jp," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                    ->orWhereRaw('REPLACE(members.email," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"]);
            });
        });

        $get = $data->orderBy('created', 'asc')->paginate($view);

        $get->appends(['keyword' => $request->keyword, 'page' => $request->page]);

        return view("$this->path.modules.member.index", [
            'css' => [
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/jQuery.filer-1.3.0/css/jquery.filer.css"
            ],
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
            ],
            'path' => $this->path,
            'prefix' => 'webpanel',
            'folder' => 'member',
            'page' => 'index',
            'segment' => "/members",
            'category' => request()->segment(3),
            'rows' => $get,
        ]);
    }
    public function showCompany(Request $request, $id = null)
    {
        $company = \App\Models\CompanyMd::select([
            'company.id as id', 'company._id', 'company.name_th as name_th', 'company.logo',
            'category.name_th as category', 'company.email', 'company.public', 'company.created',
            'company.allow', 'company.allow_date', 'company.allow_comment', 'company.ct_refuse_date'
        ])
            ->where('_id', $id)
            ->leftJoin('category', 'category.id', '=', 'company.category')

            ->paginate(12);
        return view("$this->path.modules.member.index", [
            'css' => [
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/jQuery.filer-1.3.0/css/jquery.filer.css"
            ],
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
                "back-end/jquery-ui-1.12.1/jquery-ui.min.js",
            ],
            'path' => $this->path,
            'prefix' => 'webpanel',
            'folder' => 'member',
            'page' => 'showCompany',
            'segment' => "/members",
            'company' => $company,
            'category' => request()->segment(2),
            'member_id' => $id
        ]);
    }
    public function add(Request $request)
    {
        return view("$this->path.modules.member.index", [
            'css' => [
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/css/validate.css"
            ],
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/jquery-ui-1.12.1/jquery-ui.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
                "back-end/jquery-validation-1.19.1/dist/jquery.validate.min.js"
            ],
            'path' => $this->path,
            'prefix' => 'webpanel',
            'folder' => 'member',
            'page' => 'add',
            'segment' => "/members"
        ]);
    }

    public function translate($memberId = null, $companyId = null)
    {

        $data = \App\Models\CompanyMd::find($companyId);
        return view("$this->path.modules.member.page-translate", [
            'css' => [
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/css/validate.css"
            ],
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
                "back-end/jquery-validation-1.19.1/dist/jquery.validate.min.js"
            ],
            'row' => $data
        ]);
    }


    public function addCompany(Request $request, $id)
    {
        //-- Query Company
        $get = \App\Models\CompanyMd::find($id);
        $select['country'] = \App\Models\CountryMd::select('id', 'nationality', 'alpha2')->get();

        switch (@$get->id) {
            case 1: ///////------- Logistic -------///////
                $select['international'] = \App\Models\ChoiceMd::where('type', 'transport')->get();
                $select['method'] = \App\Models\ChoiceMd::where('type', 'methods')->get();
                $select['item'] = \App\Models\ChoiceMd::where('type', 'warehouse')->get();
                $select['service'] = \App\Models\ChoiceMd::where('type', 'services')->get();
                break;
            case 2: ///////------- Solar cell -------///////
                $select['condition'] = \App\Models\ChoiceMd::where('type', 'solar-cell-condition')->select('key', "name_th")->get();
                $select['language'] = \App\Models\TranslateMd::select('id', "name_th")->get();
                $select['status'] = \App\Models\StatusMd::select('id', "name_th")->get();
                break;
            case 3: ///////------- Translater -------///////
                $select['language'] = \App\Models\TranslateMd::select('id', "name_th")->get();
                $select['speciality'] = \App\Models\SpecialityMd::select('id', "name_th")->get();
                $select['status'] = \App\Models\StatusMd::select('id', "name_th")->get();
                break;
            case 4: ///////------- Car Rental -------///////
                $select['car'] = \App\Models\ChoiceMd::where('type', 'car')->select('id', 'key', "name_th")->get();
                $select['contract'] = \App\Models\ChoiceMd::where('type', 'contract-period')->select('id', 'key', "name_th")->get();
                $select['other'] = \App\Models\ChoiceMd::where('type', 'other-conditions')->select('id', 'key', "name_th")->get();
                break;
            case 5: ///////------- Visa Support -------///////
                $select['visa'] = \App\Models\VisaTypeMd::select('id', 'name_th')->orderBy('name_th', 'asc')->get();
                break;
            case 6: ///////------- Company Register -------///////
                $select['consulting'] = \App\Models\ConsultingMd::select('id', "name_th")->orderBy('name_th', 'asc')->get();
                break;
            case 7: ///////------- Warehouse -------///////
                $select['stock'] = \App\Models\ChoiceMd::where('type', 'stock')->get();
                break;
            case 8: ///////------- Printing -------///////
                $select['printing'] = \App\Models\ChoiceMd::select('key', "name_th")->where('type', 'type-printing')->get();
                $select['minimum'] = \App\Models\ChoiceMd::select('key', "name_th")->where('type', 'service-minimum')->get();
                $select['serviceOther'] = \App\Models\ChoiceMd::select('key', "name_th")->where('type', 'service-other')->get();
                break;
            case 9: ///////------- Account -------///////
                $select['accService'] = \App\Models\ChoiceMd::select('key', "name_th")->where('type', 'account-service')->get();
                $select['accOther'] = \App\Models\ChoiceMd::select('key', "name_th")->where('type', 'account-other')->get();
                $select['accNationality'] = \App\Models\ChoiceMd::select('key', "name_th")->where('type', 'account-nationality')->get();
                break;
            case 10: ///////------- Law Firm ------//////
                $select['lawService'] = \App\Models\ChoiceMd::select('key', "name_th")->where('type', 'law-firm-service')->get();
                $select['lawOther'] = \App\Models\ChoiceMd::select('key', "name_th")->where('type', 'law-firm-other')->get();
                $select['lawLanguage'] = \App\Models\ChoiceMd::select('key', "name_th")->where('type', 'law-firm-language')->get();
                break;
            case 11: ///////------- Web Marketing -------///////
                $select['markService'] = \App\Models\ChoiceMd::select('key', "name_th")->where('type', 'marketing-service')->get();
                $select['markOther'] = \App\Models\ChoiceMd::select('key', "name_th")->where('type', 'marketing-other')->get();
                $select['markLanguage'] = \App\Models\ChoiceMd::select('key', "name_th")->where('type', 'marketing-language')->get();
                break;
            case 12: ///////------- Recruitment -------///////
                $select['recruitPosition'] = \App\Models\TypePositionMd::select('id', "position_th")->get();
                $select['recruitNationality'] = \App\Models\ChoiceMd::select('key', "name_th")->where('type', 'recruitment-nationality')->get();
                $select['recruitType'] = \App\Models\ChoiceMd::select('key', "name_th")->where('type', 'type-recruitment')->get();
                break;
            case 13: ///////------- Web System -------///////
                $select['webService'] = \App\Models\ChoiceMd::select('key', "name_th")->where('type', 'web-service')->get();
                $select['webOther'] = \App\Models\ChoiceMd::select('key', "name_th")->where('type', 'web-other-service')->get();
                $select['webLanguage'] = \App\Models\ChoiceMd::select('key', "name_th")->where('type', 'web-language')->get();
                break;
            case 14: ///////------- Co-Working -------///////
                $select['coService'] = \App\Models\ChoiceMd::select('key', "name_th")->where('type', 'co-working-service')->get();
                $select['coType'] = \App\Models\ChoiceMd::select('key', "name_th")->where('type', 'co-working-type')->get();
                $select['coSeat'] = \App\Models\ChoiceMd::select('key', "name_th")->where('type', 'co-working-seat')->get();
            case 15: ///////------- Office Rent -------///////
                $select['offService'] = \App\Models\ChoiceMd::select('key', "name_th")->where('type', 'office-rent-service')->get();
                $select['offContract'] = \App\Models\ChoiceMd::select('key', "name_th")->where('type', 'office-rent-contract')->get();
                break;
            case 16: ///////------- Construction Machine Leasing -------///////
                $select['consType']  = \App\Models\ChoiceMd::select('key', "name_th")->where('type', 'construction-type')->get();
                $select['consService']  = \App\Models\ChoiceMd::select('key', "name_th")->where('type', 'construction-service')->get();
                $select['consRental']  = \App\Models\ChoiceMd::select('key', "name_th")->where('type', 'construction-rental')->get();
                break;
            case 17: ///////------- Forklift
                $select['forkService'] = \App\Models\ChoiceMd::select('key', "name_th")->where('type', 'forklift-service')->get();
                $select['forkType'] = \App\Models\ChoiceMd::select('key', "name_th")->where('type', 'forklift-type')->get();
                $select['forkFuel'] = \App\Models\ChoiceMd::select('key', "name_th")->where('type', 'fuel-system')->get();
                break;
            case 18: ///////------- Interior Design -------///////
                $select['intService'] = \App\Models\ChoiceMd::select('key', "name_th")->where('type', 'interior-design-service')->get();
                break;
            case 19: ///////------- Security System -------///////
                $select['secService'] = \App\Models\ChoiceMd::select('key', "name_th")->where('type', 'security-system-service')->get();
                break;
            case 20: ///////------- Real Estate Agent -------///////
                $select['realService'] = \App\Models\ChoiceMd::select('key', "name_th")->where('type', 'real-estate-service')->get();
                $select['realType'] = \App\Models\ChoiceMd::select('key', "name_th")->where('type', 'real-estate-type')->get();
                break;
            case 21: ///////------- Package -------///////
                $select['packService'] = \App\Models\ChoiceMd::select('key', "name_th")->where('type', 'package-service')->get();
                $select['packOther'] = \App\Models\ChoiceMd::select('key', "name_th")->where('type', 'package-other')->get();
                break;
            case 22: ///////------- Insurance -------///////

                $select['insPersonal'] = \App\Models\ChoiceMd::select('key', "name_th")->where('type', 'insurance-personal')->get();
                $select['insBusiness'] = \App\Models\ChoiceMd::select('key', "name_th")->where('type', 'insurance-business')->get();
                break;
            case 24: ///////------- Leasing -------///////
                $select['lesService'] = \App\Models\ChoiceMd::select('key', "name_th")->where('type', 'leasing-type')->get();
                break;
            case 28: ///////======= Chemicals =======///////
                $data['chemiType'] = \App\Models\ChoiceMd::select('key', 'name_th')->where('type', 'chemicals-type')->get();
                $data['chemiService'] = \App\Models\ChoiceMd::select('key', 'name_th')->where('type', 'chemicals-service')->get();
                break;
            case 30: ///////======= Food, Agricultural & Marine Products =======///////
                $data['foodType'] = \App\Models\ChoiceMd::select('key', 'name_th')->where('type', 'food-type')->get();
                break;
            case 31: ///////======= Computer & information technology =======///////
                $data['itService'] = \App\Models\ChoiceMd::select('key', 'name_th')->where('type', 'it-service')->get();
                $data['itSoftware'] = \App\Models\ChoiceMd::select('key', 'name_th')->where('type', 'it-software')->get();
                $data['itHardware'] = \App\Models\ChoiceMd::select('key', 'name_th')->where('type', 'it-hardware')->get();
                $data['itSolution'] = \App\Models\ChoiceMd::select('key', 'name_th')->where('type', 'it-solution')->get();
                break;
            case 36: ///////======= textiles & Garments =======///////
                $data['tgService'] = \App\Models\ChoiceMd::select('key', 'name_th')->where('type', 'textiles-garments-service')->get();
                break;
            case 42: ///////======= Contractors =======///////
                $data['tgService'] = \App\Models\ChoiceMd::select('key', 'name_th')->where('type', 'contractor-service')->get();
                $data['tgOther'] = \App\Models\ChoiceMd::select('key', 'name_th')->where('type', 'contractor-other')->get();
                break;
            case 43:
                $data['babyType'] = \App\Models\ChoiceMd::select('key', 'name_th')->where('type', 'baby-supplies-type')->get();
                break;
            default:
                # code...
                break;
        }


        return view("$this->path.modules.member.index", $select, [
            'css' => [
                "back-end/slimselectjs/slimselect.min.css",
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/jQuery.filer-1.3.0/css/jquery.filer.css"
            ],
            'js' => [
                "back-end/slimselectjs/slimselect.min.js",
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
                "js/build/addressAutoComplete.js?v=001",
                "back-end/jQuery.filer-1.3.0/js/jquery.filer.min.js"
            ],
            'path' => $this->path,
            'prefix' => 'webpanel',
            'folder' => 'member',
            'page' => 'addCompany',
            'segment' => "/members/$id",
            'member_id' => $id
        ]);
    }
    public function insert(Request $request)
    {
        $data = new \App\Models\MemberMd;
        $data->name_th = $request->name_th;
        $data->name_en = $request->name_en;
        $data->name_jp = $request->name_jp;
        $data->name_zh = $request->name_zh;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $filename = 'member_' . date('dmY-Hism');
        $logo_image = $request->image;
        if ($logo_image) {
            $image = Image::make($logo_image->getRealPath())->encode('webp', 100);
            $ext = '.' . explode("/", $image->mime())[1]; // File extension
            $width = $image->width(); // The width of the upload image
            $height = $image->height(); // The height of the upload image
            $image->fit(500, 500, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize('center');
            })->stream();
            $newfile = 'image/member/' . $filename . $ext;
            $put = Storage::disk(env('disk', 'ftp'))->put($newfile, $image);
            $data->images = $newfile;
        }
        if ($data->save()) {
            ///////
            $act = new \App\Models\TaskMd;
            $act->user = Auth::id();
            $act->action = 'Create member';
            $act->description =  "Member: $data->id, $data->name_th";
            $act->re = $data->id;
            $act->save();
            ///////
            if ($request->insert) {

                $com = new \App\Models\CompanyMd;
                $com->_id = $data->id;
                $com->name_th = $request->company_th;
                if ($request->company_en) $com->name_en = $request->company_en;
                if ($request->company_jp) $com->name_jp = $request->company_jp;
                if ($request->company_zh) $com->name_zh = $request->company_zh;
                $com->category = $request->category;
                $com->email = $request->email;
                $com->created = date('Y-m-d H:i:s');
                $com->created_by = Auth::user()->name;

                if ($com->save()) {
                    @Storage::disk(env('disk', 'ftp'))->makeDirectory("/images/company/$data->id/$com->id/profile-image/");
                    $get = \App\Models\CompanyMd::find($com->id);
                    if (@$get->id) {
                        /// Job Progress ///
                        $newStep = new \App\Models\JobProgressMd;
                        $newStep->company = $get->id;
                        $newStep->step1 = 1;
                        $newStep->step1_by = Auth::user()->id;
                        $newStep->step1_on = date('Y-m-d H:i:s');
                        $newStep->created = date('Y-m-d H:i:s');
                        $newStep->save();

                        /// Task ///
                        $task = new \App\Models\TaskMd;
                        $task->user = Auth::id();
                        $task->action = 'Create company';
                        $task->description =  "Company: $get->id, $get->name_th";
                        $task->re = $get->id;
                        $task->save();

                        /// Job CS ///
                        $JobCs = new \App\Models\JobCsMd;
                        $JobCs->company = $get->id;
                        $JobCs->user = Auth::id();
                        $JobCs->created = date('Y-m-d H:i:s');
                        $JobCs->save();
                    }
                    return view($this->path . '.alert.sweet.success', ['url' => url("$this->prefix/members/$data->id/$com->id")]);
                }
            }
            return view($this->path . '.alert.sweet.success', ['url' => url("$this->prefix/members/edit/$data->id")]);
        } else {
            return view($this->path . '.alert.sweet.error', ['url' => url($this->prefix . '/members/add')]);
        }
    }

    public function addMemberCompany(Request $request)
    {
        $com = new \App\Models\CompanyMd;
        $com->_id = $request->memberId;
        $com->name_th = $request->name_th;
        $com->name_en = $request->name_en;
        $com->name_jp = $request->name_jp;
        $com->name_zh = $request->name_zh;
        $com->category = $request->category;
        $com->email = $request->email;
        $com->created = date('Y-m-d H:i:s');
        $com->created_by = Auth::user()->name;
        if ($com->save()) {
            @Storage::disk(env('disk', 'ftp'))->makeDirectory("/images/company/$request->memberId/$com->id/profile-image/");
            $get = \App\Models\CompanyMd::find($com->id);
            if (@$get->id) {
                /// Job Progress ///
                $newStep = new \App\Models\JobProgressMd;
                $newStep->company = $get->id;
                $newStep->step1 = 1;
                $newStep->step1_by = Auth::user()->id;
                $newStep->step1_on = date('Y-m-d H:i:s');
                $newStep->created = date('Y-m-d H:i:s');
                $newStep->save();

                /// Task ///
                $task = new \App\Models\TaskMd;
                $task->user = Auth::id();
                $task->action = 'Create company';
                $task->description =  "Company: $get->id, $get->name_th";
                $task->re = $get->id;
                $task->save();

                /// Job CS ///
                $JobCs = new \App\Models\JobCsMd;
                $JobCs->company = $get->id;
                $JobCs->user = Auth::id();
                $JobCs->created = date('Y-m-d H:i:s');
                $JobCs->save();
            }
            return response()->json(['status' => 'success', 'url' => url("$this->prefix/members/$request->memberId/$com->id")]);
        } else {
            return response()->json(['status' => 'error', 'url' => url($this->prefix . '/members/add')]);
        }
    }

    public function editMember($id)
    {
        $data =  \App\Models\MemberMd::find($id);
        return view("$this->path.modules.member.index", [
            'css' => [
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/css/validate.css"
            ],
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/jquery-ui-1.12.1/jquery-ui.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
                "back-end/jquery-validation-1.19.1/dist/jquery.validate.min.js"
            ],
            'path' => $this->path,
            'prefix' => 'webpanel',
            'folder' => 'member',
            'page' => 'editMember',
            'segment' => "/members",
            'row' => $data
        ]);
    }
    public function updateMember(Request $request)
    {
        $data = \App\Models\MemberMd::find($request->id);
        $data->name_th = $request->name_th;
        $data->name_jp = $request->name_jp;
        $data->email = $request->email;
        if (!empty($request->password)) {
            $data->password = bcrypt($request->password);
        }
        $filename = 'member_' . date('dmY-Hism');
        $logo_image = $request->image;
        if ($logo_image) {
            $image = Image::make($logo_image->getRealPath())->encode('webp', 100);
            $ext = '.' . explode("/", $image->mime())[1]; // File extension
            $width = $image->width(); // The width of the upload image
            $height = $image->height(); // The height of the upload image
            $image->fit(500, 500, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize('center');
            })->stream();

            $newfile = 'image/member/' . $filename . $ext;
            $put = Storage::disk(env('disk', 'ftp'))->put($newfile, $image);
            @Storage::disk(env('disk', 'ftp'))->delete($data->images);
            $data->images = $newfile;
        }
        if ($data->save()) {
            ///////
            $act = new \App\Models\TaskMd;
            $act->user = Auth::id();
            $act->action = 'Update member';
            $act->description =  "Member: $data->id, $data->name_th";
            $act->re = $data->id;
            $act->save();
            ///////
            return view($this->path . '.alert.sweet.success', ['url' => url($this->prefix . '/members/edit/' . $data->id)]);
        } else {
            return view($this->path . '.alert.sweet.error', ['url' => url($this->prefix . '/members/add')]);
        }
    }
    public function insertCompany(Request $request, $id = null)
    {

        $data = new \App\Models\CompanyMd;
        $data->_id = $id;
        $data->profile_url = $request->profile_url;
        $data->name_th = $request->name_th;
        $data->name_en = $request->name_en;
        $data->name_jp = $request->name_jp;
        $data->name_zh = $request->name_zh;
        $data->category = $request->category;
        $data->country = $request->country;
        $data->description_th = $request->description_th;
        $data->description_en = $request->description_en;
        $data->description_jp = $request->description_jp;
        $data->description_zh = $request->description_zh;
        $data->detail_th = $request->detail_th;
        $data->detail_en = $request->detail_en;
        $data->detail_jp = $request->detail_jp;
        $data->detail_zh = $request->detail_zh;
        $data->more_th = $request->more_th;
        $data->more_en = $request->more_en;
        $data->more_jp = $request->more_jp;
        $data->more_zh = $request->more_zh;
        $data->phone = $request->phone;
        $data->mobile = $request->mobile;
        $data->email = $request->email;
        $data->website = $request->website;
        $data->facebook = $request->facebook;
        $data->facebook = $request->facebook;
        $data->line = $request->line;
        $data->address_th = $request->address_th;
        $data->address_en = $request->address_en;
        $data->address_jp = $request->address_jp;
        $data->address_zh = $request->address_zh;
        $data->postcode = $request->postcode;
        $data->subdistrict = $request->subdistrict;
        $data->district = $request->district;
        $data->province = $request->province;
        $data->gmap = $request->gmap;
        $data->created = date('Y-m-d H:i:s');
        $data->created_by = Auth::user()->name;
        $data->seo_keyword_th = $request->seo_keyword_th;
        $data->seo_keyword_en = $request->seo_keyword_en;
        $data->seo_keyword_jp = $request->seo_keyword_jp;
        $data->seo_keyword_zh = $request->seo_keyword_zh;
        // $data->seo_description = $request->seo_description;
        // $data->updated_by = Auth::user()->name;

        $filename = 'logo_' . date('dmY-Hism');
        $logo_image = $request->image;
        if ($logo_image) {

            $image = Image::make($logo_image->getRealPath())->encode('webp', 100);
            $imageXs = Image::make($logo_image->getRealPath())->encode('webp', 100);
            $imageSm = Image::make($logo_image->getRealPath())->encode('webp', 100);
            $ext = '.' . explode("/", $image->mime())[1]; // File extension

            $width = $image->width(); // The width of the upload image
            $height = $image->height(); // The height of the upload image

            $image->fit(500, 500, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize('center');
            })->stream();
            $imageXs->fit(250, 250, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize('center');
            })->stream();
            $imageSm->fit(70, 70, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize('center');
            })->stream();

            $newfile = 'images/company/' . $filename . $ext;

            Storage::disk(env('disk', 'ftp'))->put($newfile, $image);
            Storage::disk(env('disk', 'ftp'))->put(str_replace('.', "-xs$ext", $newfile), $imageXs);
            Storage::disk(env('disk', 'ftp'))->put(str_replace('.', "-sm$ext", $newfile), $imageSm);

            Storage::disk(env('disk', 'ftp'))->delete($data->logo);
            Storage::disk(env('disk', 'ftp'))->delete(str_replace('.', '-xs.', $data->logo));
            Storage::disk(env('disk', 'ftp'))->delete(str_replace('.', '-sm.', $data->logo));
            $data->logo = $newfile;
        }
        $filename_banner = 'banner_' . date('dmY-Hism');
        $cover = $request->bg_image;
        if ($cover) {
            $image = Image::make($cover->getRealPath())->encode('webp', 100);
            $ext = '.' . explode("/", $image->mime())[1]; // File extension
            $width = $image->width(); // The width of the upload image
            $height = $image->height(); // The height of the upload image
            $image->fit(1920, 500, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize('center');
            })->stream();
            $newfile = 'images/company/' . $filename_banner . $ext;
            $put = Storage::disk(env('disk', 'ftp'))->put($newfile, $image);
            $data->cover = $newfile;
        }
        if ($data->save()) {
            /////// Job Progress //////
            $newStep = new \App\Models\JobProgressMd;
            $newStep->company = $data->id;
            $newStep->step1 = 1;
            $newStep->step1_on = date('Y-m-d H:i:s');
            $newStep->created = date('Y-m-d H:i:s');
            if ($newStep->save()) {
                $jf = new \App\Models\JobForwardMd;
                $jf->job_progress = $newStep->id;
                $jf->created = $newStep->created;
                $jf->save();
            }
            /////// Job Progress //////

            //-- Gallery
            $gal_image = $request->gallery;
            if (!empty($gal_image)) {
                foreach ($gal_image as $k => $gal) {
                    $filename_gallery = 'gallery_' . date('dmY-Hism');
                    $image = Image::make($gal->getRealPath())->encode('webp', 100);
                    $image_xs = Image::make($gal->getRealPath())->encode('webp', 100);
                    $image_sm = Image::make($gal->getRealPath())->encode('webp', 100);
                    $ext = '.' . explode("/", $image->mime())[1]; // File extension
                    $width = $image->width(); // The width of the upload image
                    $height = $image->height(); // The height of the upload image
                    $image->stream();
                    $image_xs->fit(200, 200, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->updsize('center');
                    })->stream();
                    $image_sm->fit(70, 70, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize('center');
                    })->stream();
                    $newfile = 'image/' . $data->id . '/gallery/' . $filename_gallery . $ext;
                    $put = Storage::disk(env('disk', 'ftp'))->put($newfile, $image);
                    $put_xs = Storage::disk(env('disk', 'ftp'))->put(str_replace(".", "-xs.", $newfile), $image_xs);
                    $put_sm = Storage::disk(env('disk', 'ftp'))->put(str_replace(".", "-sm.", $newfile), $image_sm);
                    $data_gall = array(
                        'image' => $newfile,
                        '_id' => $data->id,
                        'created' => date('Y-m-d H:i:s'),
                        'createby' => Auth::user()->name
                    );
                    DB::table('cp_gallery')->insert($data_gall);
                }
            }
            $internal = (!empty($request->internal)) ? $request->internal : 0;
            DB::table('domestic')->insert(['_id' => $data->id, 'transport' => $internal]);

            //-- WorkTime Add
            if (!empty($request->cp_working_day_add)) {
                foreach ($request->cp_working_day_add as $k => $day) {
                    DB::table('cp_working_hours')->insert(['_id' => $data->id, 'day' => $day, 'time' => $request->cp_working_time_add[$k]]);
                }
            }
            ///////
            $act = new \App\Models\TaskMd;
            $act->user = Auth::id();
            $act->action = 'Create company';
            $act->description =  "Company: $data->id, $data->name_th";
            $act->re = $data->id;
            $act->save();
            ///////
            return view($this->path . '.alert.sweet.success', ['url' => url($this->prefix . '/members/' . $request->member_id . '/' . $request->cp_id)]);
        } else {
            return view($this->path . '.alert.sweet.error', ['url' => url($this->prefix . '/members/' . $request->member_id . '/add')]);
        }
    }
    public function edit(Request $request, $id = null, $company = null)
    {

        $data = \App\Models\MemberMd::find($id);
        //-- Query Company
        $get_company = \App\Models\CompanyMd::select([
            '*', 'company.id as id',
            'mb.id as mb_id',
            'company.profile_url',
            'dmt.transport as dmtInternal',
            'pac.packaging as pac',
            'company.category',
            'company.name_th',
            'company.name_en',
            'company.name_jp',
            'company.name_zh',
            'company.detail_th',
            'company.detail_en',
            'company.detail_jp',
            'company.detail_zh',
            'company.more_th',
            'company.more_en',
            'company.more_jp',
            'company.more_zh',
            'company.updated',
            'company.email as comp_email',
            'company.public',
            'company.reason',
            'pv.province_name_th as province',
            'dist.district_name_th as district',
            'subdist.subdist_name_th as subdistrict',
            "category.key",
            'category.id as categoryID',
            'company.seo_description_th',
            'company.seo_description_en',
            'company.seo_description_jp',
            'company.seo_description_zh',
            'company.seo_keyword_th',
            'company.seo_keyword_en',
            'company.seo_keyword_jp',
            'company.seo_keyword_zh',
            'company.title_th',
            'company.title_en',
            'company.title_jp',
            'company.title_zh',
            'company.add_by_number',
        ])
            ->leftJoin('members as mb', 'mb.id', '=', 'company._id')
            ->leftJoin('domestic as dmt', 'dmt.id', '=', 'company._id')
            ->leftJoin('cp_packaging as pac', 'pac.id', '=', 'company._id')
            ->leftJoin('provinces as pv', 'pv.province_id', '=', 'company.province')
            ->leftJoin('district as dist', 'dist.district_id', '=', 'company.district')
            ->leftJoin('sub-district as subdist', 'subdist.subdist_id', '=', 'company.subdistrict')
            ->leftJoin('category', 'company.category', '=', 'category.id')
            ->where('mb.id', @$data->id)
            ->where('company.id', $company)->first();

        //-- Choice
        $select['country'] = \App\Models\CountryMd::select('id', 'nationality', 'alpha2')->get();
        $select['warehouse'] = \App\Models\ProvinceMd::orderBy('province_name_th', 'asc')->get();

        $seo = \App\Models\CategoryMd::where('id', $get_company->categoryID)->get();

        return view("$this->path.modules.member.index", $select, [
            'css' => [
                "back-end/slimselectjs/slimselect.min.css",
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/jQuery.filer-1.3.0/css/jquery.filer.css"
            ],
            'js' => [
                "back-end/slimselectjs/slimselect.min.js",
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/jquery-ui-1.12.1/jquery-ui.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
                "js/build/addressAutoComplete.js?v=001",
                "back-end/jQuery.filer-1.3.0/js/jquery.filer.min.js"
            ],
            'path' => $this->path,
            'prefix' => 'webpanel',
            'folder' => 'member',
            'page' => 'edit',
            'segment' => "/members/$id",
            'row' => $data,
            'comp' => $get_company,
            'filters' => \App\Http\Controllers\CenterCtrl::filterOfCategory($get_company->key),
            'myFilter' => \App\Http\Controllers\CenterCtrl::myFilter($get_company->key, $get_company->id),
            'seo' => $seo,
        ]);
    }
    public function updateCompany(Request $request)
    {
        // echo($request->all());
        // die();

        $data = \App\Models\CompanyMd::find($request->cp_id);
        $data->profile_url = $request->profile_url;
        $data->name_th = $request->name_th;
        $data->name_en = $request->name_en;
        $data->name_jp = $request->name_jp;
        $data->name_zh = $request->name_zh;
        if ($request->get('my-category')) $data->category = $request->get('my-category');
        $data->country = $request->country;
        $data->video_profile = $request->video_profile;
        $data->video_position = $request->video_position;
        $data->description_th = $request->description_th;
        $data->description_en = $request->description_en;
        $data->description_jp = $request->description_jp;
        $data->description_zh = $request->description_zh;
        $data->detail_th = $request->detail_th;
        $data->detail_jp = $request->detail_jp;
        $data->detail_en = $request->detail_en;
        $data->detail_jp = $request->detail_jp;
        $data->more_th = $request->more_th;
        $data->more_en = $request->more_en;
        $data->more_jp = $request->more_jp;
        $data->more_zh = $request->more_zh;
        $data->phone = $request->phone;
        $data->mobile = $request->mobile;
        $data->email = $request->email;
        $data->website = $request->website;
        $data->facebook = $request->facebook;
        $data->line = $request->line;
        $data->address_th = $request->address_th;
        $data->address_en = $request->address_en;
        $data->address_jp = $request->address_jp;
        $data->address_zh = $request->address_zh;
        $data->postcode = $request->postcode;
        $data->subdistrict = $request->subdistrict;
        $data->district = $request->district;
        $data->province = $request->province;
        $data->gmap = $request->gmap;
        $data->reason = $request->reason;
        $data->type = $request->c_type;

        // seo optimize
        $data->title_th = $request->title_th;
        $data->title_en = $request->title_en;
        $data->title_jp = $request->title_jp;
        $data->title_zh = $request->title_zh;
        $data->seo_keyword_th = $request->seo_keyword_th;
        $data->seo_keyword_en = $request->seo_keyword_en;
        $data->seo_keyword_jp = $request->seo_keyword_jp;
        $data->seo_keyword_zh = $request->seo_keyword_zh;
        $data->seo_description_th = $request->seo_description_th;
        $data->seo_description_en = $request->seo_description_en;
        $data->seo_description_jp = $request->seo_description_jp;
        $data->seo_description_zh = $request->seo_description_zh;
        // seo optimize

        $data->add_by_number = $request->addbynumber;

        if ($request->edited == '') {
            if ($request->more_th != '' || $request->more_jp != '') {
                $data->edited = date('Y-m-d H:i:s');
                $data->edited_by = Auth::user()->name;
            }
        }
        $data->updated = date('Y-m-d H:i:s');
        $data->updated_by = Auth::user()->name;

        $logoImage = $request->image;
        if ($logoImage) {

            $filename = 'logo_' . date('dmY-Hism');
            $image = Image::make($logoImage->getRealPath())->encode('webp', 100);
            $image_xs = Image::make($logoImage->getRealPath())->encode('webp', 100);
            $image_sm = Image::make($logoImage->getRealPath())->encode('webp', 100);
            $ext = '.' . explode("/", $image->mime())[1];
            $newfile = 'images/company/' . $request->cp_id . '/' . $filename . $ext;

            $image->fit(500, 500, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize('center');
            })->stream();
            $image_xs->fit(250, 250, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize('center');
            })->stream();
            $image_sm->fit(70, 70, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize('center');
            })->stream();

            $put = Storage::disk(env('disk', 'ftp'))->put($newfile, $image);
            Storage::disk(env('disk', 'ftp'))->put(str_replace(".", "-xs.", $newfile), $image_xs);
            Storage::disk(env('disk', 'ftp'))->put(str_replace(".", "-sm.", $newfile), $image_sm);

            // ลบรูปเดิม
            if ($put) {
                @Storage::disk(env('disk', 'ftp'))->delete($data->logo);
                @Storage::disk(env('disk', 'ftp'))->delete(str_replace(".", "-xs.", $data->logo));
                @Storage::disk(env('disk', 'ftp'))->delete(str_replace(".", "-sm.", $data->logo));
                $data->logo = $newfile;
            }
        }

        $coverImage = $request->bg_image;
        if ($coverImage) {

            $filename = 'cover_' . date('dmY-Hism');
            $image = Image::make($coverImage->getRealPath())->encode('webp', 100);

            $ext = '.' . explode("/", $image->mime())[1];
            $newfile = 'images/company/' . $filename . $ext;

            $image->fit(1920, 500, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize('center');
            })->stream();


            $put = Storage::disk(env('disk', 'ftp'))->put($newfile, $image);

            if ($put) {
                @Storage::disk(env('disk', 'ftp'))->delete($data->cover);
                $data->cover = $newfile;
            }
        }

        //-- Gallery --//
        $gallerys = $request->gallery;
        if ($gallerys) {
            foreach ($request->gallery as $k => $gal) {

                $filename = 'gallery_' . date('dmY-His') . $this->milliseconds();
                $_id = $data->id;

                $image = Image::make($gal->getRealPath())->encode('webp', 100);
                $image_xs = Image::make($gal->getRealPath())->encode('webp', 100);
                $image_sm = Image::make($gal->getRealPath())->encode('webp', 100);
                $ext = '.' . explode("/", $image->mime())[1];
                $newfile = 'images/company/' . $_id . '/' . $filename . $ext;

                $width = $image->width(); // The width of the upload image
                $height = $image->height(); // The height of the upload image
                $mime = $image->mime();

                $image->stream();
                $image_xs->fit(200, 200, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize('center');
                })->stream();
                $image_sm->fit(70, 70, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize('center');
                })->stream();

                $put = Storage::disk(env('disk', 'ftp'))->put($newfile, $image);
                $put_xs = Storage::disk(env('disk', 'ftp'))->put(str_replace(".", "-xs.", $newfile), $image_xs);
                $put_sm = Storage::disk(env('disk', 'ftp'))->put(str_replace(".", "-sm.", $newfile), $image_sm);
                $size = Storage::disk(env('disk', 'ftp'))->size($newfile);

                $data_gall = new \App\Models\Filter\CpGalleryMd;
                $data_gall->_id = $data->id;
                $data_gall->category = $request->category;
                $data_gall->image = $newfile;
                $data_gall->type = $mime;
                $data_gall->dimension = "$width x $height";
                $data_gall->size = $size;
                $data_gall->created = date('Y-m-d H:i:s');
                $data_gall->createby = Auth::user()->name;
                $data_gall->save();

                // DB::table('cp_gallery')->insert($data_gall);

            }
        }
        //-- Gallery --//

        if ($data->save()) {

            if (@$request->modified) {
                $modified = implode(", ", $request->modified);
                $log = new \App\Models\LogOfModifiedMd;
                $log->company = $data->id;
                $log->user = Auth::user()->id;
                $log->action = $modified;
                $log->created = date('Y-m-d H:i:s');
                $log->save();
            }
            if (@$request->revise) {
                $revise = implode(", ", $request->revise);
                $log = new \App\Models\LogOfModifiedMd;
                $log->company = $data->id;
                $log->user = Auth::user()->id;
                $log->action = $revise;
                $log->type = 'revise';
                $log->status = 0;
                $log->created = date('Y-m-d H:i:s');
                $log->save();
            }
            $step = \App\Models\JobProgressMd::where('company', $request->cp_id)->first();
            if (@$step->id == '') {
                $newStep = new \App\Models\JobProgressMd;
                $newStep->company = $request->cp_id;
                $newStep->step1 = 1;
                $newStep->step1_by = 1;
                $newStep->step1_on = $data->created;
                if (@$request->step2) {
                    $newStep->step2 = 1;
                    $newStep->step2_by = Auth::user()->id;
                    $newStep->step2_on = $data->edited;
                }
                if (@$request->step3) {
                    $newStep->step3 = $request->step3;
                    $newStep->step3_by = Auth::user()->id;
                    $newStep->step3_on = date('Y-m-d H:i:s');
                }
                $newStep->created = '2022-03-01 09:09:09';
                $newStep->save();
            } else {
                if (@$request->step2) {
                    $step->step2 = 1;
                    $step->step2_by = Auth::user()->id;
                    $step->step2_on = date('Y-m-d H:i:s');
                    $step->save();

                    $act = new \App\Models\TaskMd;
                    $act->user = Auth::user()->id;
                    $act->action = 'Edit booking';
                    $act->description = "Step 2 from job progress: $data->id, $data->name_th";
                    $act->re = $data->id;
                    $act->created = date('Y-m-d H:i:s');
                    $act->save();
                }
                if (@$request->step3) {
                    $step->step3 = 1;
                    $step->step3_by = Auth::user()->id;
                    $step->step3_on = date('Y-m-d H:i:s');
                    $step->save();
                }
            }


            $data['_id'] = $data->id;
            $filter = [];
            $cat = \App\Models\CategoryMd::find($data->category);

            switch ($cat->key) {
                case 'visa-support': // 1.1.1
                    $filter['data'] = [
                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                        (object)['field' => 'visa', 'request' => $request->type, 'model' => \App\Models\Filter\CpVisaMd::class]
                    ];
                    break;
                case 'company-registration': // 1.1.2
                    $filter['data'] = [
                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                        (object)['field' => 'consulting', 'request' => $request->consulting, 'model' => \App\Models\Filter\CpConsultingMd::class],
                        (object)['field' => 'service', 'request' => $request->service, 'model' => \App\Models\Filter\CpServiceMd::class],
                    ];
                    break;
                case 'law-firm': // 1.1.3
                    $filter['data'] = [
                        (object)['field' => '_type', 'request' => $request->type, 'model' => \App\Models\Filter\CpTypeMd::class],
                        (object)['field' => 'service', 'request' => $request->service, 'model' => \App\Models\Filter\CpServiceMd::class],
                        (object)['field' => 'language', 'request' => $request->language, 'model' => \App\Models\Filter\CpLanguageMd::class],
                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'business-consulting': // 1.1.4
                    $filter['data'] = [
                        (object)['field' => 'service', 'request' => $request->service, 'model' => \App\Models\Filter\CpServiceMd::class],
                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'accounting': // 1.1.5
                    $filter['data'] = [
                        (object)['field' => 'service', 'request' => $request->service, 'model' => \App\Models\Filter\CpServiceMd::class],
                        (object)['field' => 'other', 'request' => $request->other, 'model' => \App\Models\Filter\CpOtherMd::class],
                        (object)['field' => 'nationality', 'request' => $request->nationality, 'model' => \App\Models\Filter\CpNationalityMd::class],
                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'translation-interpreter': // 1.1.6
                    $filter['data'] = [
                        (object)['field' => 'urgent', 'request' => $request->urgent, 'model' => \App\Models\Filter\CpUrgentMd::class],
                        (object)['field' => 'service', 'request' => $request->service, 'model' => \App\Models\Filter\CpServiceMd::class],
                        (object)['field' => 'translate', 'request' => $request->translate, 'model' => \App\Models\Filter\CpTranslateMd::class],
                        (object)['field' => 'speciality', 'request' => $request->speciality, 'model' => \App\Models\Filter\CpSpecialityMd::class],
                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'agent-for-land': // 1.1.7
                    $filter['data'] = [
                        (object)['field' => 'service', 'request' => $request->service, 'model' => \App\Models\Filter\CpServiceMd::class],
                        (object)['field' => '_type', 'request' => $request->type, 'model' => \App\Models\Filter\CpTypeMd::class],
                        (object)['field' => 'nationality', 'request' => $request->nationality, 'model' => \App\Models\Filter\CpNationalityMd::class],
                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class]
                    ];
                    break;

                case 'recruitment-agency': // 1.2.1
                    $filter['data'] = [
                        (object)['field' => 'position', 'request' => $request->position, 'model' => \App\Models\Filter\CpPositionMd::class],
                        (object)['field' => 'nationality', 'request' => $request->nationality, 'model' => \App\Models\Filter\CpNationalityMd::class],
                        (object)['field' => '_type', 'request' => $request->employment, 'model' => \App\Models\Filter\CpTypeMd::class],
                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'security': // 1.2.2
                    $filter['data'] = [
                        (object)['field' => 'service', 'request' => $request->service, 'model' => \App\Models\Filter\CpServiceMd::class],
                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'logistics-warehouse-delivery': // 1.2.3
                    $filter['data'] = [
                        (object)['field' => 'transport', 'request' => $request->domestic, 'model' => \App\Models\Filter\CpDomesticMd::class],
                        (object)['field' => 'transport', 'request' => $request->international, 'model' => \App\Models\Filter\CpInternationalMd::class],
                        (object)['field' => 'method', 'request' => $request->method, 'model' => \App\Models\Filter\CpMethodMd::class],
                        (object)['field' => 'item', 'request' => $request->item, 'model' => \App\Models\Filter\CpItemMd::class],
                        (object)['field' => 'warehouse', 'request' => $request->type, 'model' => \App\Models\Filter\CpWarehouseMd::class, 'where' => 'type-warehouse'],
                        (object)['field' => 'warehouse', 'request' => $request->warehouse, 'model' => \App\Models\Filter\CpWarehouseMd::class, 'where' => 'location-warehouse'],
                        (object)['field' => 'service', 'request' => $request->service, 'model' => \App\Models\Filter\CpServiceMd::class],
                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class,],
                    ];
                    break;
                case 'printing': // 1.2.4
                    $filter['data'] = [
                        (object)['field' => 'printing', 'request' => $request->type, 'model' => \App\Models\Filter\CpPrintingMd::class],
                        (object)['field' => 'minimum', 'request' => $request->minimum, 'model' => \App\Models\Filter\CpMinimumMd::class],
                        (object)['field' => 'other', 'request' => $request->other, 'model' => \App\Models\Filter\CpOtherMd::class],
                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'gardening': // 1.2.5
                    $filter['data'] = [
                        (object)['field' => 'service', 'request' => $request->service, 'model' => \App\Models\Filter\CpServiceMd::class],
                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'office-design-and-renovation': // 1.2.6
                    $filter['data'] = [
                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                        (object)['field' => 'renovation', 'request' => $request->renovation, 'model' => \App\Models\Filter\CpRenovationMd::class],
                        (object)['field' => 'service', 'request' => $request->service, 'model' => \App\Models\Filter\CpServiceMd::class]
                    ];
                    break;
                case 'office-appliance': // 1.2.7
                    $filter['data'] = [
                        (object)['field' => '_type', 'request' => $request->type, 'model' => \App\Models\Filter\CpTypeMd::class],
                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'oa-machine': // 1.2.8
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'office-equipment-maintenance': // 1.2.9
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'website-development': // 1.2.10
                    $filter['data'] = [
                        (object)['field' => 'service', 'request' => $request->service, 'model' => \App\Models\Filter\CpServiceMd::class],
                        (object)['field' => 'other', 'request' => $request->other, 'model' => \App\Models\Filter\CpOtherMd::class],
                        (object)['field' => 'language', 'request' => $request->language, 'model' => \App\Models\Filter\CpLanguageMd::class],
                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'system-iot-dx': // 1.2.11
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'car-rental': // 1.2.12
                    $filter['data'] = [
                        (object)['field' => 'type', 'request' => $request->type, 'model' => \App\Models\Filter\CpCarTypeMd::class],
                        (object)['field' => 'period', 'request' => $request->period, 'model' => \App\Models\Filter\CpPeriodMd::class],
                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'it-computer-hardware': // 1.2.13
                    $filter['data'] = [
                        (object)['field' => 'service', 'request' => $request->service, 'model' => \App\Models\Filter\CpServiceMd::class],
                        (object)['field' => 'software', 'request' => $request->software, 'model' => \App\Models\Filter\CpSoftwareMd::class],
                        (object)['field' => 'hardware', 'request' => $request->hardware, 'model' => \App\Models\Filter\CpHardwareMd::class],
                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'call-center': // 1.3.1
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'advertising-publisment': // 1.3.2
                    $filter['data'] = [
                        (object)['field' => 'service', 'request' => $request->service, 'model' => \App\Models\Filter\CpServiceMd::class],
                        (object)['field' => 'other', 'request' => $request->other, 'model' => \App\Models\Filter\CpOtherMd::class],
                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'web-marketing': // 1.3.3
                    $filter['data'] = [
                        (object)['field' => 'service', 'request' => $request->service, 'model' => \App\Models\Filter\CpServiceMd::class],
                        (object)['field' => 'language', 'request' => $request->language, 'model' => \App\Models\Filter\CpLanguageMd::class],
                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'exhibition': // 1.3.4
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'bank': // 1.4.1
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'leasing': // 1.4.2
                    $filter['data'] = [
                        (object)['field' => '_type', 'request' => $request->type, 'model' => \App\Models\Filter\CpTypeMd::class],
                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'insurance': // 1.4.3
                    $filter['data'] = [
                        (object)['field' => 'service', 'request' => $request->personality, 'model' => \App\Models\Filter\CpServiceMd::class, 'where' => 'personal-insurance'],
                        (object)['field' => 'service', 'request' => $request->property, 'model' => \App\Models\Filter\CpServiceMd::class, 'where' => 'property-insurance'],
                        (object)['field' => 'service', 'request' => $request->business, 'model' => \App\Models\Filter\CpServiceMd::class, 'where' => 'insurance-business'],
                        (object)['field' => '_type', 'request' => $request->pets, 'model' => \App\Models\Filter\CpTypeMd::class, 'where' => 'pets'],
                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'factoring': // 1.4.4
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'credit-cards': // 1.4.5
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'travel-agency': // 1.5.1
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'hotel-accommodation': // 1.5.2
                    $filter['data'] = [
                        (object)['field' => 'other', 'request' => $request['accommodates-pets'], 'model' => \App\Models\Filter\CpOtherMd::class, 'where' => 'accommodates-pets'],
                        (object)['field' => '_type', 'request' => $request->type, 'model' => \App\Models\Filter\CpTypeMd::class],
                        (object)['field' => 'service', 'request' => $request->facility, 'model' => \App\Models\Filter\CpServiceMd::class],
                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'event-organizer-exhibition': // 1.5.3
                    $filter['data'] = [
                        (object)['field' => '_type', 'request' => $request->type, 'model' => \App\Models\Filter\CpTypeMd::class],
                        (object)['field' => 'service', 'request' => $request->service, 'model' => \App\Models\Filter\CpServiceMd::class],
                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'gift-survenior': // 1.5.4
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                    ///////////////////////////////////////////////////////
                case 'press-machine': // 2.1.1
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'cnc-lathe-manual-late': // 2.1.2
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'machine-center-milling-machine': // 2.1.3
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'die-casting-machine': // 2.1.4
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'plastic-injection': // 2.1.5
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'welding-machine': // 2.1.6
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'robot-automation': // 2.1.7
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'machine-maintennance-spare-part': // 2.1.8
                    $filter['data'] = [
                        (object)['field' => '_type', 'request' => $request['machine-type'], 'model' => \App\Models\Filter\CpTypeMd::class, 'where' => 'machine-type'],
                        (object)['field' => '_type', 'request' => $request['machine-working-pattern'], 'model' => \App\Models\Filter\CpTypeMd::class, 'where' => 'machine-working-pattern'],
                        (object)['field' => 'overhaul', 'request' => $request->overhaul, 'model' => \App\Models\Filter\CpOverhaulMd::class],
                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'second-hand-machine': // 2.1.9
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'coating-painting-heating-treatment-machine': // 2.1.10
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'grinding-edm-wire-cut-machine': // 2.1.11
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'qc-equipment': // 2.1.12
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'cutting-blending-machine': // 2.1.13
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'hand-tools': // 2.1.14
                    $filter['data'] = [
                        (object)['field' => '_type', 'request' => $request->type, 'model' => \App\Models\Filter\CpTypeMd::class],
                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'washing-machine': // 2.1.15
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'painting-equipment': // 2.1.16
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'special-machine-product-designed-line': // 2.1.17
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'other-machine-equipment': // 2.1.18
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'clean-room-temperature-control': // 2.1.19
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'automotive-motorcycle-industrial': // 2.2.1
                    $filter['data'] = [
                        (object)['field' => '_type', 'request' => $request->type, 'model' => \App\Models\Filter\CpTypeMd::class, 'where' => 'sales-type'],
                        (object)['field' => '_type', 'request' => $request->automotive, 'model' => \App\Models\Filter\CpTypeMd::class, 'where' => 'automotive-type'],
                        (object)['field' => 'product', 'request' => $request['spare-parts'], 'model' => \App\Models\Filter\CpProductMd::class],
                        (object)['field' => 'brand', 'request' => $request->brand, 'model' => \App\Models\Filter\CpBrandMd::class],
                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'chemical-industrial': // 2.2.2
                    $filter['data'] = [
                        (object)['field' => '_type', 'request' => $request->type, 'model' => \App\Models\Filter\CpTypeMd::class],
                        // ['field'=>'service','request'=>$request->service,'model'=>\App\Models\ServiceMd::class],
                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'jewely-cosmetic-industrial': // 2.2.3
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'food-drinks-industrial': // 2.2.4
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'mold': // 2.2.5
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'electric-product-part-industrial': // 2.2.6
                    $filter['data'] = [
                        (object)['field' => 'appliance', 'request' => $request->type, 'model' => \App\Models\Filter\CpApplianceMd::class],
                        (object)['field' => 'brand', 'request' => $request->brand, 'model' => \App\Models\Filter\CpBrandMd::class],
                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'electric-product-part-industrial-service': // 2.2.6 ***************
                    $filter['data'] = [
                        (object)['field' => 'appliance', 'request' => $request->type, 'model' => \App\Models\Filter\CpApplianceMd::class],
                        (object)['field' => 'brand', 'request' => $request->brand, 'model' => \App\Models\Filter\CpBrandMd::class],
                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'home-appliance-industrial': // 2.2.7
                    $filter['data'] = [
                        (object)['field' => 'product', 'request' => $request->product, 'model' => \App\Models\Filter\CpProductMd::class],
                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'agriculture-industrial': // 2.2.8
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'heavy-machine-industrial': // 2.2.9
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'job-shops': // 2.2.10
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'textile-garment': // 2.2.11
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'shoes-bags': // 2.2.12
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'edical-industrial': // 2.2.13
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'glass-mirror-lens': // 2.2.14
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'packaging': // 2.1.15
                    $filter['data'] = [
                        (object)['field' => 'packaging', 'request' => $request->packaging, 'model' => \App\Models\Filter\CpPackagingMd::class],
                        (object)['field' => '_type', 'request' => $request->type, 'model' => \App\Models\Filter\CpTypeMd::class],
                        (object)['field' => 'service', 'request' => $request->service, 'model' => \App\Models\Filter\CpServiceMd::class],
                        (object)['field' => 'material', 'request' => $request->material, 'model' => \App\Models\Filter\CpMaterialMd::class],
                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'other-industrial': // 2.2.16
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'cutting-tool-grinding-stone': // 2.3.1
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'coolant-oil': // 2.3.2
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'chemical': // 2.3.3
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'filter': // 2.3.4
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'fuel-gas': // 2.3.5
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'paint': // 2.3.6
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'textile-silk': // 2.4.1
                    $filter['data'] = [
                        (object)['field' => 'product', 'request' => $request->product, 'model' => \App\Models\Filter\CpProductMd::class],
                        (object)['field' => 'service', 'request' => $request->service, 'model' => \App\Models\Filter\CpServiceMd::class],
                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'rubber': // 2.4.2
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'plastic-resin': // 2.4.3
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'pipe': // 2.4.4
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'pulp': // 2.4.5
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'woods': // 2.4.6
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'ceramic': // 2.4.7
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'leather': // 2.4.8
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'compressor': // 2.5.1
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'solar-windmilling': // 2.5.2
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'boiler': // 2.5.3
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'conveyor-shelter-rack': // 2.5.4
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'generator': // 2.5.5
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'crane-hoist': // 2.5.6
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'contractor-maintenance-renovation': // 2.5.7
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'forklift-stocker': // 2.5.8
                    $filter['data'] = [
                        (object)['field' => '_type', 'request' => $request->type, 'model' => \App\Models\Filter\CpTypeMd::class],
                        (object)['field' => 'fuel', 'request' => $request->fuel, 'model' => \App\Models\Filter\CpFuelMd::class],
                        (object)['field' => 'service', 'request' => $request->service, 'model' => \App\Models\Filter\CpServiceMd::class],
                        (object)['field' => 'rental', 'request' => $request->rental, 'model' => \App\Models\Filter\CpRentalMd::class],
                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'safety-goods': // 2.5.9
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'pump-motor': // 2.5.10
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'pipe-electrical-engineering': // 2.5.11
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'factory-gardening': // 2.5.12
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'maintenance-for-facility-pump-motor': // 2.5.13
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'general-security': // 2.6.1
                    $filter['data'] = [
                        (object)['field' => 'service', 'request' => $request->service, 'model' => \App\Models\Filter\CpServiceMd::class],
                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'system-iot-dx-factory': // 2.6.2
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'consulting': // 2.6.3
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'canteen': // 2.6.4
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'trading-company': // 2.6.5
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'recruitment': // 2.6.6
                    $filter['data'] = [
                        (object)['field' => 'position', 'request' => $request->position, 'model' => \App\Models\Filter\CpPositionMd::class],
                        (object)['field' => 'nationality', 'request' => $request->nationality, 'model' => \App\Models\Filter\CpNationalityMd::class],
                        (object)['field' => '_type', 'request' => $request->employment, 'model' => \App\Models\Filter\CpTypeMd::class],
                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'logistics-warehouse-delivery-factory': // 2.6.7
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'other-service': // 2.6.8
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'amata': // 2.7.1
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'pintong': // 2.7.2
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case '': // 2.7.3
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                    // case '': // 2.7.4
                    //     $filter['data'] = [

                    //     ];
                    //     break;
                    // case '': // 2.7.5
                    //     $filter['data'] = [

                    //     ];
                    //     break;
                    // case '': // 2.7.6
                    //     $filter['data'] = [

                    //     ];
                    //     break;
                case 'agent-for-land-industrial': // 2.7.7
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                    ///////////////////////////////////////////////////////
                case 'developer': // 3.1.1
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'contractor': // 3.1.2
                    $filter['data'] = [
                        (object)[
                            'field' => 'construction',
                            'request' => $request->utilities,
                            'model' => \App\Models\Filter\CpConstructionMd::class,
                            'where' => 'utilities-construction'
                        ],
                        (object)[
                            'field' => 'construction',
                            'request' => $request->building,
                            'model' => \App\Models\Filter\CpConstructionMd::class,
                            'where' => 'building-system-construction'
                        ],
                        (object)[
                            'field' => 'construction',
                            'request' => $request->energy,
                            'model' => \App\Models\Filter\CpConstructionMd::class,
                            'where' => 'energy-system-construction'
                        ],
                        (object)[
                            'field' => 'construction',
                            'request' => $request->industrial,
                            'model' => \App\Models\Filter\CpConstructionMd::class,
                            'where' => 'contractor-of-industrial-systems'
                        ],
                        (object)[
                            'field' => 'construction',
                            'request' => $request->environmental,
                            'model' => \App\Models\Filter\CpConstructionMd::class,
                            'where' => 'contractor-of-environmental-system'
                        ],
                        (object)[
                            'field' => 'service',
                            'request' => $request->service,
                            'model' => \App\Models\Filter\CpServiceMd::class
                        ],
                        (object)[
                            'field' => 'other',
                            'request' => $request->small,
                            'model' => \App\Models\Filter\CpOtherMd::class
                        ],
                        (object)[
                            'field' => 'location',
                            'request' => $request->location,
                            'model' => \App\Models\Filter\CpLocationMd::class
                        ]
                    ];
                    break;
                case 'contractor-service': // 3.1.2 ********************
                    $filter['data'] = [
                        (object)[
                            'field' => 'construction',
                            'request' => $request->utilities,
                            'model' => \App\Models\Filter\CpConstructionMd::class,
                            'where' => 'utilities-construction'
                        ],
                        (object)[
                            'field' => 'construction',
                            'request' => $request->building,
                            'model' => \App\Models\Filter\CpConstructionMd::class,
                            'where' => 'building-system-construction'
                        ],
                        (object)[
                            'field' => 'construction',
                            'request' => $request->energy,
                            'model' => \App\Models\Filter\CpConstructionMd::class,
                            'where' => 'energy-system-construction'
                        ],
                        (object)[
                            'field' => 'construction',
                            'request' => $request->industrial,
                            'model' => \App\Models\Filter\CpConstructionMd::class,
                            'where' => 'contractor-of-industrial-systems'
                        ],
                        (object)[
                            'field' => 'construction',
                            'request' => $request->environmental,
                            'model' => \App\Models\Filter\CpConstructionMd::class,
                            'where' => 'contractor-of-environmental-system'
                        ],
                        (object)[
                            'field' => 'service',
                            'request' => $request->service,
                            'model' => \App\Models\Filter\CpServiceMd::class
                        ],
                        (object)[
                            'field' => 'other',
                            'request' => $request->small,
                            'model' => \App\Models\Filter\CpOtherMd::class
                        ],
                        (object)[
                            'field' => 'location',
                            'request' => $request->location,
                            'model' => \App\Models\Filter\CpLocationMd::class
                        ]
                    ];
                    break;

                case 'compressor-construction': // 3.2.1
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'generator-construction': // 3.2.2
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'maintenance-for-facility-construction': // 3.2.3
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'solar-windmilling-construction': // 3.2.4
                    $filter['data'] = [
                        (object)['field' => 'product', 'request' => $request->product, 'model' => \App\Models\Filter\CpProductMd::class],
                        (object)['field' => 'service', 'request' => $request->other, 'model' => \App\Models\Filter\CpServiceMd::class],
                        (object)['field' => 'condition', 'request' => $request->condition, 'model' => \App\Models\Filter\CpConditionMd::class],
                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'solar-windmilling-service': // 3.2.4 **************************
                    $filter['data'] = [
                        (object)['field' => 'product', 'request' => $request->product, 'model' => \App\Models\Filter\CpProductMd::class],
                        (object)['field' => 'service', 'request' => $request->other, 'model' => \App\Models\Filter\CpServiceMd::class],
                        (object)['field' => 'condition', 'request' => $request->condition, 'model' => \App\Models\Filter\CpConditionMd::class],
                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'conveyor-shelter-rack-construction': // 3.2.5
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'heavy-machinery': // 3.3.1
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'construction-machine': // 3.3.2
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'door-window': // 3.4.1
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'fuel-gas-construction': // 3.4.2
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'electrical-equipment': // 3.4.3
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'leather-construction': // 3.4.4
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'rubber-construction': // 3.4.5
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'rock': // 3.4.6
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'brick-tile': // 3.4.7
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'sound': // 3.4.8
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'steel-metal': // 3.4.9
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'pipe-construction': // 3.4.10
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'valve': // 3.4.11
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'glass': // 3.4.12
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'chemical-construction': // 3.4.13
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'ceramic-construction': // 3.4.14
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'pulp-construction': // 3.4.15
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'blending-item': // 3.4.16
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'light': // 3.4.17
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                    ///////////////////////////////////////////////////////
                case 'bus': // 4.1.1
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'taxi': // 4.1.2
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'bts': // 4.1.3
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'air-plane': // 4.1.4
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'train': // 4.1.5
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'fuel': // 4.2.1
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'gas': // 4.2.2
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'electric': // 4.2.3
                    $filter['data'] = [];
                    break;
                case 'windmilling': // 4.2.4
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'airport': // 4.3.1
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'sea-port': // 4.3.2
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'kindergarten': // 4.4.1
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'primary-school': // 4.4.2
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'junior-high-school': // 4.4.3
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'high-school': // 4.4.4
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'university': // 4.4.5
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'embassy': // 4.5.1
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'interconnection': // 4.6.1
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'radio-communication': // 4.6.2
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                    ///////////////////////////////////////////////////////
                case 'retail-bank': // 5.1.1
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'retail-insurance': // 5.1.2
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'retail-leasing': // 5.1.3
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'human': // 5.2.1
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'animal': // 5.2.2
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'retail-travel-agency': // 5.3.1
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'hotel': // 5.3.2
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'car-for-rent': // 5.3.3
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'kitchen': // 5.4.1
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'electronic': // 5.4.2
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'home-renovation': // 5.4.3
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'gardening-appliance': // 5.4.4
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'store': // 5.4.5
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'daily-renovation': // 5.5.1
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'stock-room': // 5.5.2
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'engineering-maintenance': // 5.5.3
                    $filter['data'] = [
                        (object)['field' => '_type', 'request' => $request['sales-type'], 'model' => \App\Models\Filter\CpTypeMd::class, 'where' => 'sales-type-automotive'],
                        (object)['field' => '_type', 'request' => $request['automotive-type'], 'model' => \App\Models\Filter\CpTypeMd::class, 'where' => 'automotive-type'],
                        (object)['field' => 'product', 'request' => $request['spare-parts'], 'model' => \App\Models\Filter\CpProductMd::class],
                        (object)['field' => 'brand', 'request' => $request->brand, 'model' => \App\Models\Filter\CpBrandMd::class],
                        (object)['field' => 'service', 'request' => $request['towing-service'], 'model' => \App\Models\Filter\CpServiceMd::class],
                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'drug-store': // 5.5.4
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'cosmetic': // 5.5.5
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'pet': // 5.5.6
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'sport-entertainment': // 5.5.7
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'retail-other': // 5.5.8
                    $filter['data'] = [

                        (object)['field' => 'location', 'request' => $request->location, 'model' => \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
            }

            // switch ($cat->key)
            // {
            //     case 'electrical-appliance': // 1.1.1 = 1
            //         $filter['data'] = [
            //             (object)['field'=>'appliance','request'=>$request->type,'model'=>\App\Models\Filter\CpApplianceMd::class],
            //             (object)['field'=>'brand','request'=>$request->brand,'model'=>\App\Models\Filter\CpBrandMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'office-appliance': // 1.1.2 = 2
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'home-appliance': // 1.1.3 = 3
            //         $filter['data'] = [
            //             (object)['field'=>'product','request'=>$request->product,'model'=>\App\Models\Filter\CpProductMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'ceremony-appliance': // 1.1.4 = 4
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'baby-appliance': // 1.1.5 = 5
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'home-decoration': // 1.1.6 = 6
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->installation,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'type-by-installation'],
            //             (object)['field'=>'_type','request'=>$request->furniture,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'type-of-furniture'],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'costume-and-beauty':  // 1.1.7 = 7
            //         $filter['data'] = [
            //             (object)['field'=>'product','request'=>$request->costume,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'costume'],
            //             (object)['field'=>'product','request'=>$request->accessories,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'accessories'],
            //             (object)['field'=>'product','request'=>$request->beauty,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'beauty'],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'automotive-spareparts': // 1.1.8 = 8
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'sales-type'],
            //             (object)['field'=>'_type','request'=>$request->automotive,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'automotive-type'],
            //             (object)['field'=>'product','request'=>$request['spare-parts'],'model'=>\App\Models\Filter\CpProductMd::class],
            //             (object)['field'=>'brand','request'=>$request->brand,'model'=>\App\Models\Filter\CpBrandMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'music-audio': // 1.1.9 = 9
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request['thai-music'],'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'thai-music'],
            //             (object)['field'=>'_type','request'=>$request['universal-music'],'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'universal-music'],
            //             (object)['field'=>'other','request'=>$request['other-music-device'],'model'=>\App\Models\Filter\CpOtherMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'sport': // 1.1.10 = 10
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->sport,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'equipment','request'=>$request->equipment,'model'=>\App\Models\Filter\CpEquipmentMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'construction-materials': // 1.1.11 = 11
            //         $filter['data'] = [
            //             (object)['field'=>'product','request'=>$request['construction-materials'],'model'=>\App\Models\Filter\CpProductMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'chemicals': // 1.1.12 = 12
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             // ['field'=>'service','request'=>$request->service,'model'=>\App\Models\ServiceMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'packaging': // 1.1.13 = 13
            //         $filter['data'] = [
            //             (object)['field'=>'packaging','request'=>$request->packaging,'model'=>\App\Models\Filter\CpPackagingMd::class],
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'material','request'=>$request->material,'model'=>\App\Models\Filter\CpMaterialMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'other-product': // 1.1.14 = 14
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'food': // 2.7.1 = 84
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'drinks':  // 1.2.2 = 16
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'factory-equipment': // 1.3.1 = 17
            //         $filter['data'] = [
            //             (object)['field'=>'product','request'=>$request['products-for-factories'],'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'products-for-factories'],
            //             (object)['field'=>'product','request'=>$request['electric-tools-and-accessories'],'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'electric-tools-and-accessories'],
            //             (object)['field'=>'product','request'=>$request['warehouse-equipment'],'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'warehouse-equipment'],
            //             (object)['field'=>'product','request'=>$request['general-equipment-for-factory'],'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'general-equipment-for-factory'],
            //             (object)['field'=>'product','request'=>$request['accessories-factory'],'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'accessories-factory'],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'hand-tool': // 1.3.2 = 18
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'machine-parts': // 1.3.3 = 19
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request['machine-type'],'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'machine-type'],
            //             (object)['field'=>'_type','request'=>$request['machine-working-pattern'],'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'machine-working-pattern'],
            //             (object)['field'=>'overhaul','request'=>$request->overhaul,'model'=>\App\Models\Filter\CpOverhaulMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'medicines': // 1.4.1 = 20
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'type-of-medication'],
            //             (object)['field'=>'product','request'=>$request->supplementary,'model'=>\App\Models\Filter\CpProductMd::class],
            //             (object)['field'=>'_type','request'=>$request['drug-utilization'],'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'drug-utilization'],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'medical-equipment': // 1.4.2 = 21
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'visa-support': // 1.5.1 = 22
            //         $filter['data'] = [
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
            //             (object)['field'=>'visa','request'=>$request->type,'model'=>\App\Models\Filter\CpVisaMd::class]
            //         ];
            //         break;
            //     case 'company-register': // 1.5.2 = 23
            //         $filter['data'] = [
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
            //             (object)['field'=>'consulting','request'=>$request->consulting,'model'=>\App\Models\Filter\CpConsultingMd::class],
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //         ];
            //         break;
            //     case 'law-firm': // 1.5.3 = 24
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'language','request'=>$request->language,'model'=>\App\Models\Filter\CpLanguageMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
            //         ];
            //         break;
            //     case 'space-for-rent': // 1.5.4 = 25
            //         $filter['data'] = [
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'seat','request'=>$request->seat,'model'=>\App\Models\Filter\CpSeatMd::class],
            //             (object)['field'=>'period','request'=>$request->period,'model'=>\App\Models\Filter\CpPeriodMd::class],
            //         ];
            //         break;
            //     case 'consultant':// 1.5.5 = 26
            //         $filter['data'] = [
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
            //         ];
            //         break;
            //     case 'translater': // 1.5.6 = 27
            //         $filter['data'] = [
            //             (object)['field'=>'urgent','request'=>$request->urgent,'model'=> \App\Models\Filter\CpUrgentMd::class],
            //             (object)['field'=>'service','request'=>$request->service,'model'=> \App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'translate','request'=>$request->translate,'model'=> \App\Models\Filter\CpTranslateMd::class],
            //             (object)['field'=>'speciality','request'=>$request->speciality,'model'=> \App\Models\Filter\CpSpecialityMd::class],
            //             // (object)['field'=>'postpay','request'=>$request->postpay,'model'=> \App\Models\Filter\CpPostpayMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=> \App\Models\Filter\CpLocationMd::class],
            //         ];
            //         break;
            //     case 'accounting': // 1.5.7 = 28
            //         $filter['data'] = [
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'other','request'=>$request->other,'model'=>\App\Models\Filter\CpOtherMd::class],
            //             (object)['field'=>'nationality','request'=>$request->nationality,'model'=>\App\Models\Filter\CpNationalityMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
            //         ];
            //         break;
            //     case 'prefabricated-office': // 1.5.8 = 29
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'seat','request'=>$request->seat,'model'=>\App\Models\Filter\CpSeatMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
            //             // (object)['field'=>'contract','request'=>$request->contract,'model'=>\App\Models\Filter\CpContractMd::class]
            //         ];
            //         break;
            //     case 'logistics': // 1.6.1 = 30
            //         $filter['data'] = [
            //             (object)['field'=>'transport','name'=>'domestic','request'=>$request->domestic,'model'=>\App\Models\Filter\CpDomesticMd::class],
            //             (object)['field'=>'transport','name'=>'international','request'=>$request->international,'model'=>\App\Models\Filter\CpInternationalMd::class],
            //             (object)['field'=>'packaging','name'=>'packing','request'=>$request->packing,'model' => \App\Models\Filter\CpPackagingMd::class],
            //             (object)['field'=>'method','name'=>'method','request'=>$request->method,'model'=>\App\Models\Filter\CpMethodMd::class],
            //             (object)['field'=>'item','name'=>'item','request'=>$request->item,'model'=>\App\Models\Filter\CpItemMd::class],
            //             (object)['field'=>'warehouse','name'=>'warehouse','request'=>$request->warehouse,'model'=>\App\Models\Filter\CpWarehouseMd::class],
            //             (object)['field'=>'service','name'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'location','name'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class,],
            //         ];
            //         break;
            //     case 'warehouse': /*= 1.6.2 - 31 =*/
            //         $filter['data'] = [
            //             (object)['field'=>'warehouse','request'=>$request->type,'model'=>\App\Models\Filter\CpWarehouseMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
            //         ];
            //         break;
            //     case 'forklift': // 1.6.3 = 32
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'fuel','request'=>$request->fuel,'model'=>\App\Models\Filter\CpFuelMd::class],
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'rental','request'=>$request->rental,'model'=>\App\Models\Filter\CpRentalMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
            //         ];
            //         break;
            //     case 'heavy-machinery': // 1.6.4 = 33
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'fuel','request'=>$request->fuel,'model'=>\App\Models\Filter\CpFuelMd::class],
            //             (object)['field'=>'rental','request'=>$request->rental,'model'=>\App\Models\Filter\CpRentalMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'transportation-warehouse-equipment': // 1.6.5 = 34
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'credit-loan': // 1.7.1 = 35
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'insurance': // 1.7.2 = 36
            //         $model = \App\Models\Filter\CpServiceMd::class;
            //         $filter['data'] = [
            //             (object)['field'=>'service','request'=>$request->personality,'model'=>$model,'where'=>'personal-insurance'],
            //             (object)['field'=>'service','request'=>$request->property,'model'=>$model,'where'=>'property-insurance'],
            //             (object)['field'=>'service','request'=>$request->business,'model'=>$model,'where'=>'insurance-business'],
            //             (object)['field'=>'_type','request'=>$request->pets,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'pets'],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'financial': // 1.7.3 = 37
            //         $filter['data'] = [
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'online-marketing': // 1.8.1 = 38
            //         $filter['data'] = [
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'language','request'=>$request->language,'model'=>\App\Models\Filter\CpLanguageMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
            //         ];
            //         break;
            //     case 'it-hardware': // 1.8.2 = 39
            //         $filter['data'] = [
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'software','request'=>$request->software,'model'=>\App\Models\Filter\CpSoftwareMd::class],
            //             (object)['field'=>'hardware','request'=>$request->hardware,'model'=>\App\Models\Filter\CpHardwareMd::class],
            //             (object)['field'=>'solution','request'=>$request->solution,'model'=>\App\Models\Filter\CpSolutionMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'web-system': // 1.8.3 = 40
            //         $filter['data'] = [
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'other','request'=>$request->other,'model'=>\App\Models\Filter\CpOtherMd::class],
            //             (object)['field'=>'language','request'=>$request->language,'model'=>\App\Models\Filter\CpLanguageMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
            //         ];
            //         break;
            //     case 'software-development': // 1.8.4 = 41
            //         $filter['data'] = [
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'software','request'=>$request->software,'model'=>\App\Models\Filter\CpSoftwareMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
            //         ];
            //         break;
            //     case 'printing': // 1.9.1 = 42
            //         $filter['data'] = [
            //             (object)['field'=>'printing','request'=>$request->type,'model'=>\App\Models\Filter\CpPrintingMd::class],
            //             (object)['field'=>'minimum','request'=>$request->minimum,'model'=>\App\Models\Filter\CpMinimumMd::class],
            //             (object)['field'=>'other','request'=>$request->other,'model'=>\App\Models\Filter\CpOtherMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
            //         ];
            //         break;
            //     case 'advertising': // 1.9.2 = 43
            //         $filter['data'] = [
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'other','request'=>$request->other,'model'=>\App\Models\Filter\CpOtherMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
            //         ];
            //         break;
            //     case 'car-rental': // 1.10.1 = 44
            //         $filter['data'] = [
            //             (object)['field'=>'type','request'=>$request->type,'model'=>\App\Models\Filter\CpCarTypeMd::class],
            //             (object)['field'=>'period','request'=>$request->period,'model'=>\App\Models\Filter\CpPeriodMd::class],
            //             // (object)['field'=>'other','request'=>$request->condition,'model'=>\App\Models\Filter\CpConditionMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=> \App\Models\Filter\CpLocationMd::class],
            //         ];
            //         break;
            //     case 'public-transportation': // 1.10.2 = 45
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'location','request'=>$request['pick-up-point'],'model'=>\App\Models\Filter\CpLocationMd::class,'where'=>'pick-up-point'],
            //             (object)['field'=>'location','request'=>$request->destination,'model'=>\App\Models\Filter\CpLocationMd::class,'where'=>'destination'],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class,'where'=>'location'],
            //         ];
            //         break;
            //     case 'security-system': // 1.11.1 = 46
            //         $filter['data'] = [
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'recruitment': // 1.11.2 = 47
            //         $filter['data'] =[
            //             (object)['field'=>'position','request'=>$request->position,'model'=>\App\Models\Filter\CpPositionMd::class],
            //             (object)['field'=>'nationality','request'=>$request->nationality,'model'=>\App\Models\Filter\CpNationalityMd::class],
            //             (object)['field'=>'_type','request'=>$request->employment,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
            //         ];
            //         break;
            //     case 'organizer': // 1.12.1 = 48
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'land-survey': // 1.12.2 = 49
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'gardening': // 1.12.3 = 50
            //         $filter['data'] = [
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'studio': // 1.12.4 = 51
            //         $filter['data'] = [
            //             (object)['field'=>'service','request'=>$request->model,'model'=>\App\Models\Filter\CpServiceMd::class,'where'=>'photography-studio-type-service'],
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class,'where'=>'photography-studio-service'],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'cleaning': // 1.12.5 = 52
            //         $filter['data'] = [
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'insecticide': // 1.12.6 = 53
            //         $filter['data'] = [
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class,'where'=>'insecticide-service'],
            //             (object)['field'=>'service','request'=>$request['service-location'],'model'=>\App\Models\Filter\CpServiceMd::class,'where'=>'insecticide-site'],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'other-general': // 1.12.7 = 54
            //         $filter['data'] = [
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'machinery-repair': // 1.13.1 = 55
            //         $filter['data'] = [
            //             (object)['field'=>'product','request'=>$request->type,'model'=>\App\Models\Filter\CpProductMd::class],
            //             (object)['field'=>'_type','request'=>$request['work-pattern'],'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'overhaul','request'=>$request->overhaul,'model'=>\App\Models\Filter\CpOverhaulMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'electronics-repair': // 1.13.2 = 56
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request['electrical-appliance'],'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'brand','request'=>$request->brand,'model'=>\App\Models\Filter\CpBrandMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'automotive-repair': // 1.13.3 = 57
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request['sales-type'],'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'sales-type-automotive'],
            //             (object)['field'=>'_type','request'=>$request['automotive-type'],'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'automotive-type'],
            //             (object)['field'=>'product','request'=>$request['spare-parts'],'model'=>\App\Models\Filter\CpProductMd::class],
            //             (object)['field'=>'brand','request'=>$request->brand,'model'=>\App\Models\Filter\CpBrandMd::class],
            //             (object)['field'=>'service','request'=>$request['towing-service'],'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'textiles-repair': // 1.13.4 = 58
            //         $filter['data'] = [
            //             (object)['field'=>'product','request'=>$request->costume,'model'=>\App\Models\Filter\CpProductMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'accessories-repair': // 1.13.5 = 59
            //         $filter['data'] = [
            //             (object)['field'=>'product','request'=>$request->accessories,'model'=>\App\Models\Filter\CpProductMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'watersupply-repair': // 1.13.6 = 60
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'furniture-repair': // 1.13.7 = 61
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'type-by-installation'],
            //             (object)['field'=>'_type','request'=>$request->usage,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'type-according-to-use'],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'machines-for-stamping': // 2.1.1 = 62
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->usage,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'material','request'=>$request->material,'model'=>\App\Models\Filter\CpMaterialMd::class],
            //             (object)['field'=>'service','request'=>$request->compression,'model'=>\App\Models\Filter\CpServiceMd::class,'where'=>'compression'],
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class,'where'=>'stamping-service'],
            //             (object)['field'=>'distribute','request'=>$request->distribute,'model'=>\App\Models\Filter\CpDistributeMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'machines-for-folding': // 2.1.2 = 63
            //         $filter['data'] = [
            //             (object)['field'=>'product','request'=>$request["bending-machine"],'model'=>\App\Models\Filter\CpProductMd::class,"where"=>"bending-machine"],
            //             (object)['field'=>'product','request'=>$request["folding-machine"],'model'=>\App\Models\Filter\CpProductMd::class,"where"=>"folding-machine"],
            //             (object)['field'=>'material','request'=>$request->materials,'model'=>\App\Models\Filter\CpMaterialMd::class],
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'distribute','request'=>$request->distribute,'model'=>\App\Models\Filter\CpDistributeMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'machines-for-casting': // 2.1.3 = 64
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'material','request'=>$request->material,'model'=>\App\Models\Filter\CpMaterialMd::class],
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'distribute','request'=>$request->distribute,'model'=>\App\Models\Filter\CpDistributeMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'machines-for-dressing': // 2.1.4 = 65
            //         $filter['data'] = [
            //             (object)['field'=>'product','request'=>$request->cutter,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'type-of-cutter'],
            //             (object)['field'=>'product','request'=>$request->drilling,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'type-of-drilling-machine'],
            //             (object)['field'=>'product','request'=>$request->lathe,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'type-of-lathe'],
            //             (object)['field'=>'product','request'=>$request->grinding,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'type-of-grinding-machine'],
            //             (object)['field'=>'material','request'=>$request->material,'model'=>\App\Models\Filter\CpMaterialMd::class,'where'=>'materials-for-cutting/drilling/lathe/grinding'],
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'distribute','request'=>$request->distribute,'model'=>\App\Models\Filter\CpDistributeMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'machines-for-compression': // 2.1.5 = 66
            //         $filter['data'] = [
            //             (object)['field'=>'product','request'=>$request->compactor,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'type-of-compactor'],
            //             (object)['field'=>'product','request'=>$request->injection,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'type-of-injection-machine'],
            //             (object)['field'=>'material','request'=>$request->material,'model'=>\App\Models\Filter\CpMaterialMd::class],
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'distribute','request'=>$request->distribute,'model'=>\App\Models\Filter\CpDistributeMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'machines-for-rolling': // 2.1.6 = 67
            //         $filter['data'] = [
            //             (object)['field'=>'product','request'=>$request->type,'model'=>\App\Models\Filter\CpProductMd::class],
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'distribute','request'=>$request->distribute,'model'=>\App\Models\Filter\CpDistributeMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'machines-for-welding': // 2.1.7 = 68
            //         $filter['data'] = [
            //             (object)['field'=>'product','request'=>$request->type,'model'=>\App\Models\Filter\CpProductMd::class],
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'distribute','request'=>$request->distribute,'model'=>\App\Models\Filter\CpDistributeMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'other-machinery': // 2.1.8 = 69
            //         $filter['data'] = [];
            //         break;
            //     case 'forklift-industry': // 2.2.1 = 70
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'fuel','request'=>$request['fuel-system'],'model'=>\App\Models\Filter\CpFuelMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'heavy-machinery-industry': // 2.2.2 = 71
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'fuel','request'=>$request['fuel-system'],'model'=>\App\Models\Filter\CpFuelMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'automotive': // 2.2.3 = 72
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'product','request'=>$request['spare-parts'],'model'=>\App\Models\Filter\CpProductMd::class],
            //             (object)['field'=>'brand','request'=>$request->brand,'model'=>\App\Models\Filter\CpBrandMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'mold': // 2.3.1 = 73
            //         $filter['data'] = [
            //             (object)['field'=>'product','request'=>$request->usage,'model'=>\App\Models\Filter\CpProductMd::class],
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'machine-tools': // 2.4.1 = 74
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'measuring-tools': // 2.4.2 = 75
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->kind,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'kind-of-measuring-tool'],
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'type-of-measuring-tool'],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'hand-tool-industry': // 2.4.3 = 76
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'improve-texture': // 2.5.1 = 77
            //         $filter['data'] = [
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'product','request'=>$request->products,'model'=>\App\Models\Filter\CpProductMd::class],
            //             (object)['field'=>'_type','request'=>$request['production-model'],'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'baby-appliance-industry': // 2.6.1 = 78
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'ceremony-appliance-industry': // 2.6.2 = 79
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'jewelry-beauty-industry': // 2.6.3 = 80
            //         $filter['data'] = [
            //             (object)['field'=>'product','request'=>$request->accessories,'model'=>\App\Models\Filter\CpProductMd::class],
            //             (object)['field'=>'_type','request'=>$request->beauty,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'kitchen-appliance-industry': // 2.6.4 = 81
            //         $filter['data'] = [
            //             (object)['field'=>'product','request'=>$request->category,'model'=>\App\Models\Filter\CpProductMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'music-audio-industry': // 2.6.5 = 82
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request['thai-music'],'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'thai-music'],
            //             (object)['field'=>'_type','request'=>$request['universal-music'],'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'universal-music'],
            //             (object)['field'=>'other','request'=>$request['other-music-device'],'model'=>\App\Models\Filter\CpOtherMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'sport-industry': // 2.6.6 = 83
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'product','request'=>$request->products,'model'=>\App\Models\Filter\CpProductMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'foods-industry': // 2.7.1 = 84
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'drinks-industry': // 2.7.2 = 54
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'home-decoration-industry': // 2.8.1 = 86
            //         $filter['data'] = [
            //             (object)['field'=>'minimum','request'=>$request->minimum,'model'=>\App\Models\Filter\CpMinimumMd::class],
            //             (object)['field'=>'order','request'=>$request['made-to-order'],'model'=>\App\Models\Filter\CpOrderMd::class],
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'material','request'=>$request->materials,'model'=>\App\Models\Filter\CpMaterialMd::class],
            //             (object)['field'=>'_type','request'=>$request->installation,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'type-by-installation'],
            //             (object)['field'=>'_type','request'=>$request->product,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'furniture-decorations-product-type'],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'office-appliance-industry': // 2.9.1 = 87
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'electric-kitchen-appliance': // 2.10.1 = 88
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'factory-electrical-appliance': // 2.10.2 = 89
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'power-generation': // 2.11.1 = 90
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'manufactor','request'=>$request->turbine,'model'=>\App\Models\Filter\CpManufactorMd::class],
            //             (object)['field'=>'condition','request'=>$request->agreement,'model'=>\App\Models\Filter\CpConditionMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'electrical-appliance-industry': // 2.12.1 = 91
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->electrical,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'type-of-electrical-equipment'],
            //             (object)['field'=>'_type','request'=>$request->electronic,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'electronic-device-type'],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'steel-metal-material': // 2.13.1 = 92
            //         $filter['data'] = [
            //             (object)['field'=>'material','request'=>$request->material,'model'=>\App\Models\Filter\CpMaterialMd::class],
            //             (object)['field'=>'product','request'=>$request->product,'model'=>\App\Models\Filter\CpProductMd::class],
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'wood': // 2.13.2 = 93
            //         $filter['data'] = [
            //             (object)['field'=>'material','request'=>$request->wood,'model'=>\App\Models\Filter\CpMaterialMd::class],
            //             (object)['field'=>'product','request'=>$request->product,'model'=>\App\Models\Filter\CpProductMd::class],
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'rubber': // 2.13.3 = 94
            //         $filter['data'] = [
            //             (object)['field'=>'material','request'=>$request->type,'model'=>\App\Models\Filter\CpMaterialMd::class],
            //             (object)['field'=>'product','request'=>$request->product,'model'=>\App\Models\Filter\CpProductMd::class],
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'plastic': // 2.13.4 = 95
            //         $filter['data'] = [
            //             (object)['field'=>'material','request'=>$request->type,'model'=>\App\Models\Filter\CpMaterialMd::class],
            //             (object)['field'=>'product','request'=>$request->product,'model'=>\App\Models\Filter\CpProductMd::class],
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'glass': // 2.13.5 = 96
            //         $filter['data'] = [
            //             (object)['field'=>'material','request'=>$request->type,'model'=>\App\Models\Filter\CpMaterialMd::class],
            //             (object)['field'=>'product','request'=>$request->product,'model'=>\App\Models\Filter\CpProductMd::class],
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'chemicals-industry': // 2.14.1 = 97
            //         $filter['data'] = [
            //             (object)['field'=>'product','request'=>$request['for-car'],'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'chemical-for-car'],
            //             (object)['field'=>'product','request'=>$request->cleaning,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'chemical-cleaning'],
            //             (object)['field'=>'product','request'=>$request->cosmetic,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'cosmetic-chemistry'],
            //             (object)['field'=>'product','request'=>$request->chemistry,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'color-chemistry'],
            //             (object)['field'=>'product','request'=>$request->food,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'food-chemistry'],
            //             (object)['field'=>'_type','request'=>$request->industry,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'industry'],
            //             (object)['field'=>'_type','request'=>$request->general,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'general'],
            //             (object)['field'=>'order','request'=>$request['made-to-order'],'model'=>\App\Models\Filter\CpOrderMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'medical-equipment-industry': // 2.15.1 = 98
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'medicines-industry': // 2.15.2 = 99
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'type-of-medication'],
            //             (object)['field'=>'product','request'=>$request->supplements,'model'=>\App\Models\Filter\CpProductMd::class],
            //             (object)['field'=>'_type','request'=>$request->usage,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'drug-utilization'],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'agricultural-equipment': // 2.16.1 = 100
            //         $filter['data'] = [
            //             (object)['field'=>'product','request'=>$request['for-earth-work'],'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'tools-for-earth-work'],
            //             (object)['field'=>'product','request'=>$request['for-plant'],'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'tool-for-plant'],
            //             (object)['field'=>'product','request'=>$request['for-moving'],'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'tools-for-moving-providing-water'],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'agricultural-chemicals': // 2.16.2 = 101
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->organic,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'organic-type'],
            //             (object)['field'=>'_type','request'=>$request->chemical,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'chemical-type'],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'laboratory-instruments': // 2.17.1 = 102
            //         $filter['data'] = [
            //             (object)['field'=>'product','request'=>$request->instruments,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'types-of-scientific-instruments'],
            //             (object)['field'=>'product','request'=>$request->glassware,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'type-of-glassware'],
            //             (object)['field'=>'product','request'=>$request->plastic,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'plastic-product-type'],
            //             (object)['field'=>'product','request'=>$request->consumables,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'consumables'],
            //             (object)['field'=>'product','request'=>$request->ceramic,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'ceramic-products'],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'petroleum-fuel': // 2.18.1 = 103
            //         $filter['data'] = [
            //             (object)['field'=>'material','request'=>$request->material,'model'=>\App\Models\Filter\CpMaterialMd::class],
            //             (object)['field'=>'service','request'=>$request->process,'model'=>\App\Models\Filter\CpServiceMd::class,'where'=>'petroleum-fuel-production-process'],
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class,'where'=>'petroleum-fuel-product-service'],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'rock': // 2.19.1 = 104
            //         $filter['data'] = [
            //             (object)['field'=>'product','request'=>$request->rock,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'type-of-rock'],
            //             (object)['field'=>'product','request'=>$request->sand,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'type-of-sand'],
            //             (object)['field'=>'product','request'=>$request->soil,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'type-of-soil'],
            //             (object)['field'=>'service','request'=>$request->other,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'brick-and-tile': // 2.19.2 = 105
            //         $filter['data'] = [
            //             (object)['field'=>'product','request'=>$request->type,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'type-of-brick'],
            //             (object)['field'=>'product','request'=>$request->tile,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'type-of-tile'],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'cement': // 2.19.3 = 106
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'pole': // 2.19.4 = 107
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'type-of-mast'],
            //             (object)['field'=>'_type','request'=>$request->cross,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'cross-type'],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'door-windows': // 2.19.5 = 108
            //         $filter['data'] = [
            //             (object)['field'=>'product','request'=>$request->window,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'type-of-window'],
            //             (object)['field'=>'product','request'=>$request->door,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'type-of-door'],
            //             (object)['field'=>'material','request'=>$request->material,'model'=>\App\Models\Filter\CpMaterialMd::class],
            //             (object)['field'=>'other','request'=>$request->other,'model'=>\App\Models\Filter\CpOtherMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'pipe': // 2.19.6 = 109
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'other-construction-materials': // 2.19.7 = 110
            //         $filter['data'] = [
            //             (object)['field'=>'product','request'=>$request->product,'model'=>\App\Models\Filter\CpProductMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'textiles-clothing': // 2.20.1 = 111
            //         $filter['data'] = [
            //             (object)['field'=>'product','request'=>$request->product,'model'=>\App\Models\Filter\CpProductMd::class],
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'costume-industry': // 2.20.2 = 112
            //         $filter['data'] = [
            //             (object)['field'=>'product','request'=>$request->product,'model'=>\App\Models\Filter\CpProductMd::class],
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'leather': // 2.20.3 = 113
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'product','request'=>$request->product,'model'=>\App\Models\Filter\CpProductMd::class],
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'canvas': // 2.20.4 = 114
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'product','request'=>$request->product,'model'=>\App\Models\Filter\CpProductMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'silk': // 2.20.5 = 115
            //         $filter['data'] = [
            //             (object)['field'=>'product','request'=>$request->product,'model'=>\App\Models\Filter\CpProductMd::class],
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'zipper-button': // 2.20.6 = 116
            //         $filter['data'] = [
            //             (object)['field'=>'material','request'=>$request->type,'model'=>\App\Models\Filter\CpMaterialMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'packaging-industry': // 2.21.1 = 117
            //         $filter['data'] = [
            //             (object)['field'=>'packaging','request'=>$request->packaging,'model'=>\App\Models\Filter\CpPackagingMd::class],
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'material','request'=>$request->material,'model'=>\App\Models\Filter\CpMaterialMd::class],
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'interior-decoration': // 3.1.1 = 118
            //         $filter['data'] = [
            //             (object)['field'=>'renovation','request'=>$request->renovation,'model'=>\App\Models\Filter\CpRenovationMd::class],
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
            //         ];
            //         break;
            //     case 'broker': // 3.2.1 = 119
            //         $filter['data'] = [
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'nationality','request'=>$request->nationality,'model'=>\App\Models\Filter\CpNationalityMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'contractor': //3.3.1 = 120
            //         $filter['data'] = [
            //             (object)[
            //                 'field' => 'construction',
            //                 'request' => $request->utilities,
            //                 'model'=> \App\Models\Filter\CpConstructionMd::class,
            //                 'where' => 'utilities-construction'
            //             ],
            //             (object)[
            //                 'field' => 'construction',
            //                 'request' => $request->building,
            //                 'model' => \App\Models\Filter\CpConstructionMd::class,
            //                 'where' => 'building-system-construction'
            //             ],
            //             (object)[
            //                 'field' => 'construction',
            //                 'request' => $request->energy,
            //                 'model' => \App\Models\Filter\CpConstructionMd::class,
            //                 'where' => 'energy-system-construction'
            //             ],
            //             (object)[
            //                 'field' => 'construction',
            //                 'request' => $request->industrial,
            //                 'model' => \App\Models\Filter\CpConstructionMd::class,
            //                 'where' => 'contractor-of-industrial-systems'
            //             ],
            //             (object)[
            //                 'field' => 'construction',
            //                 'request' => $request->environmental,
            //                 'model' => \App\Models\Filter\CpConstructionMd::class,
            //                 'where' => 'contractor-of-environmental-system'
            //             ],
            //             (object)[
            //                 'field' => 'service',
            //                 'request' => $request->service,
            //                 'model' => \App\Models\Filter\CpServiceMd::class
            //             ],
            //             (object)[
            //                 'field' => 'other',
            //                 'request' => $request->small,
            //                 'model' => \App\Models\Filter\CpOtherMd::class
            //             ],
            //             (object)[
            //                 'field' => 'location',
            //                 'request' => $request->location,
            //                 'model' => \App\Models\Filter\CpLocationMd::class
            //             ]
            //         ];
            //         break;
            //     case 'solar-cell': // 3.4.1 = 121
            //         $filter['data'] = [
            //             (object)['field'=>'product','request'=>$request->product,'model'=>\App\Models\Filter\CpProductMd::class],
            //             (object)['field'=>'service','request'=>$request->other,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'condition','request'=>$request->condition,'model'=>\App\Models\Filter\CpConditionMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'insurance-lifestyle': // 4.1.1 = 122
            //         $filter['data'] = [
            //             (object)['field'=>'service','request'=>$request->personality,'model'=>\App\Models\Filter\CpServiceMd::class,'where'=>'personal-insurance'],
            //             (object)['field'=>'service','request'=>$request->property,'model'=>\App\Models\Filter\CpServiceMd::class,'where'=>'property-insurance'],
            //             (object)['field'=>'service','request'=>$request->business,'model'=>\App\Models\Filter\CpServiceMd::class,'where'=>'business-insurance'],
            //             (object)['field'=>'_type','request'=>$request->pets,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'pets'],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'institution': // 4.2.1 = 123
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'organization': // 4.2.2 = 124
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'farm': // 4.2.3 = 125
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->aquatic,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'aquatic-animals'],
            //             (object)['field'=>'_type','request'=>$request->terrestrial,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'terrestrial-animal'],
            //             (object)['field'=>'_type','request'=>$request->poultry,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'poultry'],
            //             (object)['field'=>'_type','request'=>$request->reptile,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'reptile'],
            //             (object)['field'=>'_type','request'=>$request['arachnid-insect'],'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'arachnid-insect'],
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'space-for-rent-lifestyle': // 4.2.4 = 126
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'animal-hospital': // 4.3.1 = 127 pass
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'other','request'=>$request->other,'model'=>\App\Models\Filter\CpOtherMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'beauty-clinic': // 4.3.2 = 128 pass
            //         $filter['data'] = [
            //             (object)['field'=>'service','request'=>$request->beauty,'model'=>\App\Models\Filter\CpServiceMd::class,'where'=>'beauty-clinic'],
            //             (object)['field'=>'service','request'=>$request->disease,'model'=>\App\Models\Filter\CpServiceMd::class,'where'=>'hospital'],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'tourist': // 4.4.1 = 129
            //         $filter['data'] = [
            //             (object)['field'=>'_type','request'=>$request->attractions,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'other','request'=>$request['hiking-camping'],'model'=>\App\Models\Filter\CpOtherMd::class,'where'=>'hiking-camping'],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;
            //     case 'accommodation': // 4.4.2 = 130
            //         $filter['data'] = [
            //             (object)['field'=>'other','request'=>$request['accommodates-pets'],'model'=>\App\Models\Filter\CpOtherMd::class,'where'=>'accommodates-pets'],
            //             (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
            //             (object)['field'=>'service','request'=>$request->facility,'model'=>\App\Models\Filter\CpServiceMd::class],
            //             (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
            //         ];
            //         break;

            // }

            $updateFilter = \App\Http\Controllers\Webpanel\FilterCtrl::update($filter, $data->id);
            // die();



            ///////-- WorkTime Update --///////
            if (@$request->time != '') {
                $WorkingHoursMd = \App\Models\Filter\CpWorkingHoursMd::class;
                foreach ($request->day as $i => $d) {
                    $wh = $WorkingHoursMd::where(['_id' => $data->id, 'day' => $d])->first();
                    if (@$wh->id) {
                        $wh->time = @$request->time[$i];
                        $wh->save();
                    } else {
                        $new_wh = new $WorkingHoursMd;
                        $new_wh->_id = $data->id;
                        $new_wh->day = $d;
                        $new_wh->time = @$request->time[$i];
                        $new_wh->save();
                    }
                }
                $WorkingHoursMd::where('_id', $data->id)->whereNotIn('day', $request->day)->delete();
            } else {
                \App\Models\Filter\CpWorkingHoursMd::where('_id', $data->id)->delete();
            }


            ///////
            $act = new \App\Models\TaskMd;
            $act->user = Auth::user()->id;
            $act->action = 'Updated company';
            $act->description =  "Company: $data->id, $data->name_th";
            $act->re = $data->id;
            $act->save();
            ///////

            // return view($this->path.'.alert.sweet.success',['url'=>$request->fullUrl()]);
            return redirect($request->fullUrl(), 301)->with(['status' => 'success', 'restored' => true]);
        } else {
            return redirect($request->fullUrl(), 301)->with(['status' => 'error']);
        }
    }
    public function statusCompany(Request $request)
    {
        $get = \App\Models\CompanyMd::where('id', $request->id)->first();

        if ($get->public == 0) {
            $public = 1;
            \App\Models\CompanyMd::where('id', $request->id)->update(['public' => 1, 'public_by' => Auth::user()->name, 'published_on' => date('Y-m-d H:i:s')]);
            \App\Models\JobProgressMd::where('company', $request->id)->update(['step4' => 1, 'step4_by' => Auth::user()->id, 'step4_on' => date('Y-m-d H:i:s')]);
            $log =  new \App\Models\LogOfModifiedMd;
            $log->company = $request->id;
            $log->user = Auth::user()->id;
            $log->action = 'Updated status to Online';
            $log->created = date('Y-m-d H:i:s');
            $log->save();
        } else {
            $public = 0;
            \App\Models\CompanyMd::where('id', $request->id)->update(['public' => 0, 'public_by' => NULL, 'published_on' => NULL]);
            \App\Models\JobProgressMd::where('company', $request->id)->update(['step4' => NULL, 'step4_by' => NULL, 'step4_on' => NULL]);
            $log =  new \App\Models\LogOfModifiedMd;
            $log->company = $request->id;
            $log->user = Auth::user()->id;
            $log->action = 'Updated status to Offline';
            $log->created = date('Y-m-d H:i:s');
            $log->save();
        }

        // $step = \App\Models\JobProgressMd::where('company', $request->id)->first();
        // if ($step->step4 == '') {
        //     $step->step4 = 1;
        //     $step->step4_by = Auth::user()->id;
        //     $step->step4_on = date('Y-m-d H:i:s');
        //     $step->save();

        //     $act = new \App\Models\TaskMd;
        //     $act->user = Auth::user()->id;
        //     $act->action = 'Step 4 from job progress';
        //     $act->description =  "Company: $get->id, $get->name_th";
        //     $act->re = $get->id;
        //     $act->save();
        // }

        return response()->json(true);
    }

    public function refuseCompanyHandle(Request $request)
    {
        $get = \App\Models\CompanyMd::where('id', $request->id)->first();
        $now = date('Y-m-d H:i:s');
        if ($get->allow == 'allow' || $get->allow == NULL) {
            $allow = 'changetorefuse';
            \App\Models\JobCsMd::where('company', $request->id)->update(['refuse' => $now]);
            $changeTo = $now;
        } else {
            $allow = NULL;
            \App\Models\JobCsMd::where('company', $request->id)->update(['refuse' => NULL]);
            $changeTo = NULL;
        }
        $get->allow = $allow;
        $get->ct_refuse_date = $changeTo;
        if ($get->save()) {

            $status = ($allow == 'changetorefuse') ? 'change to refuse' : 'cancel refuse';
            $log = new \App\Models\LogOfModifiedMd;
            $log->company = $request->id;
            $log->user = Auth::user()->id;
            $log->action = $status . ', ' . $get->name_jp;
            $log->created = date('Y-m-d H:i:s');
            $log->type = $status;

            $response = true;
        } else {
            $response = false;
        }
        return response()->json($response);
    }

    public function statusCompanyBasic(Request $request)
    {
        $get = \App\Models\CompanyMd::where('id', $request->id)->first();
        if ($get->type == 'full') {
            \App\Models\CompanyMd::where('id', $request->id)->update(['type' => 'basic']);
            $log =  new \App\Models\LogOfModifiedMd;
            $log->company = $request->id;
            $log->user = Auth::user()->id;
            $log->action = 'Updated type to Basic';
            $log->created = date('Y-m-d H:i:s');
            $log->save();
            return response()->json(true);
        } else {
            \App\Models\CompanyMd::where('id', $request->id)->update(['type' => 'full']);
            $log =  new \App\Models\LogOfModifiedMd;
            $log->company = $request->id;
            $log->user = Auth::user()->id;
            $log->action = 'Updated type to Full';
            $log->created = date('Y-m-d H:i:s');
            $log->save();
            return response()->json(true);
        }
    }

    public function ChangeToRefuse(Request $request)
    {
        $get = \App\Models\CompanyMd::where('id', $request->id)->first();

        if ($get->allow == 'allow') {
            $allow = 'changetorefuse';
            \App\Models\CompanyMd::where('id', $request->id)->update(['allow' => 'changetorefuse']);
            \App\Models\JobCsMd::where('company', $request->id)->update(['refuse' => date('Y-m-d H:i:s')]);
        } else {
            $allow = 'allow';
            \App\Models\CompanyMd::where('id', $request->id)->update(['allow' => 'allow']);
            \App\Models\JobCsMd::where('company', $request->id)->update(['refuse' => NULL]);
        }

        if (@$allow == 'changetorefuse') {
            $get->ct_refuse_date = date('Y-m-d H:i:s');
        } else {
            $get->ct_refuse_date = NULL;
        }

        if ($get->save()) {
            ///////
            $status = ($allow == 'changetorefuse') ? 'change to refuse' : 'cancel refuse';
            $log = new \App\Models\LogOfModifiedMd;
            $log->company = $request->id;
            $log->user = Auth::user()->id;
            $log->action = $status . ', ' . $get->name_jp;
            $log->created = date('Y-m-d H:i:s');
            $log->type = $status;
            $log->save();
            ///////
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    public function refuse(Request $request)
    {
        $get = \App\Models\JobCsMd::select('company.id', 'company.name_jp', 'job_cs.refuse')
            ->leftJoin('company', 'job_cs.company', 'company.id')
            ->where('company', $request->id)
            ->first();
        if (!$get->refuse) {
            $allow = 'refuse';
            \App\Models\JobCsMd::where('company', $request->id)->update(['refuse' => date('Y-m-d H:i:s')]);
            \App\Models\CompanyMd::where('id', $request->id)->update(['mail' => $request->mail]);
        } else {
            $allow = 'cancel refuse';
            \App\Models\JobCsMd::where('company', $request->id)->update(['refuse' => NULL]);
            \App\Models\CompanyMd::where('id', $request->id)->update(['mail' => NULL]);
        }

        $status = ($allow == 'refuse') ? 'refuse' : 'cancel refuse';

        $log = new \App\Models\LogOfModifiedMd;
        $log->company = $request->id;
        $log->user = ($request->uid) ? $request->uid : Auth::user()->id;
        $log->action = ($request->msg) ? $request->msg : $status;
        $log->created = date('Y-m-d H:i:s');
        $log->type = $status;

        if ($log->save()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    public function deleteItemTime(Request $request)
    {
        try {
            DB::table('cp_working_hours')->where(['_id' => $request->cp_id, 'id' => $request->id])->delete();
            echo 'true';
        } catch (\Exception $e) {
            echo 'false';
        }
    }
    public function deleteItemGallery(Request $request)
    {
        try {
            $get = DB::table('cp_gallery')->where('id', $request->id)->first();
            @Storage::disk(env('disk', 'ftp'))->delete($get->image);
            @Storage::disk(env('disk', 'ftp'))->delete(str_replace(".", ".xs", $get->image));
            @Storage::disk(env('disk', 'ftp'))->delete(str_replace(".", ".sm", $get->image));
            DB::table('cp_gallery')->where('id', $get->id)->delete();
            echo 'true';
        } catch (\Exception $e) {
            echo 'false';
        }
    }
    public function SoftdeleteCompany(Request $request)
    {
        try {
            $data = \App\Models\CompanyMd::find($request->id);
            if ($data) {
                $data->delisted_by = Auth::user()->id;
                $data->reason = @$request->msg;
                if ($data->save()) {
                    $data->delete();
                    $log = new \App\Models\LogOfModifiedMd;
                    $log->company = $request->id;
                    $log->user = Auth::user()->id;
                    $log->action = $request->msg;
                    $log->created = date('Y-m-d H:i:s');
                    $log->type = 'delisted';
                    $log->save();
                }
            }
            echo 'true';
        } catch (\Exception $e) {
            echo 'false';
        }
    }
    public function delete(Request $request)
    {
        try {
            $data = \App\Models\MemberMd::find($request->id);
            if ($data) {
                $cp = \App\Models\CompanyMd::where('_id', $request->id);
                if ($cp) {
                    foreach ($cp as $c) {
                        @Storage::disk(env('disk', 'ftp'))->delete($c->cover);
                        @Storage::disk(env('disk', 'ftp'))->delete($c->logo);
                        @Storage::disk(env('disk', 'ftp'))->delete(str_replace('.', '-xs.', $c->logo));
                        @Storage::disk(env('disk', 'ftp'))->delete(str_replace('.', '-sm.', $c->logo));
                        $get_gallery = DB::table('cp_gallery')->where('id', $c->id)->first();
                        if ($get_gallery) {
                            foreach ($get_gallery as $gallery)
                                @Storage::disk(env('disk', 'ftp'))->delete($get_gallery->image);
                            @Storage::disk(env('disk', 'ftp'))->delete(str_replace('.', '-xs.', $get_gallery->image));
                            @Storage::disk(env('disk', 'ftp'))->delete(str_replace('.', '-sm.', $get_gallery->image));
                            DB::table('cp_gallery')->where('id', $get_gallery->id)->delete();
                        }
                        DB::table('domestic')->where('_id', $c->id)->delete();
                        //-- International
                        DB::table('inaternational')->where('_id', $c->id)->delete();
                        //-- Method
                        DB::table('cp_method')->where('_id', $c->id)->delete();
                        //-- Warehouse
                        DB::table('cp_warehouse')->where('_id', $c->id)->delete();
                        //-- Item+++++++++++
                        DB::table('cp_item')->where('_id', $c->id)->delete();
                        //-- Service
                        DB::table('cp_service')->where('_id', $c->id)->delete();
                        //-- Packing
                        DB::table('packing')->where('_id', $c->id)->delete();
                        //-- cp_location Solar Seting Auto
                        DB::table('cp_location')->where('_id', $data->id)->delete();
                        //-- cp_condition
                        DB::table('cp_condition')->where('_id', $data->id)->delete();
                        //-- cp_Consulting
                        DB::table('cp_consulting')->where('_id', $data->id)->delete();
                        //-- cp_language
                        DB::table('cp_translate')->where('_id', $data->id)->delete();
                        //-- cp_speciality
                        DB::table('cp_speciality')->where('_id', $data->id)->delete();
                        //-- cp_urgent
                        DB::table('cp_urgent')->where('_id', $data->id)->delete();
                        //-- cp_postpay
                        DB::table('cp_postpay')->where('_id', $data->id)->delete();
                        //-- cp_status
                        DB::table('cp_status')->where('_id', $data->id)->delete();
                        //-- cp_cartype
                        DB::table('cp_cartype')->where('_id', $data->id)->delete();
                        //-- cp_period
                        DB::table('cp_period')->where('_id', $data->id)->delete();
                        //-- cp_location_visa
                        DB::table('cp_location')->where('_id', $data->id)->delete();
                        //-- cp_visa
                        DB::table('cp_visa')->where('_id', $data->id)->delete();
                        //-- WorkTime Update
                        DB::table('cp_working_hours')->where('_id', $c->id)->delete();
                        // Job progress
                        DB::table('job_progress')->where('company', $c->id)->delete();
                        $c->delete();
                    }
                }
                @Storage::disk(env('disk', 'ftp'))->delete($data->images);
                $data->delete();
            }

            echo 'true';
        } catch (\Exception $e) {
            echo 'false';
        }
    }
    public function uploadImage(Request $request)
    {
        $_id = $request->_id;
        $filename = 'image_' . date('dmY-His') . $this->milliseconds();
        $glImage = $request->image;
        if ($glImage) {

            $image = Image::make($glImage->getRealPath())->encode('webp', 100);
            $image_xs = Image::make($glImage->getRealPath())->encode('webp', 100);
            $ext = '.' . explode("/", $image->mime())[1];
            $newfile = 'images/company/' . $_id . '/profile-image/' . $filename . $ext;

            // $height = $image->height();
            // $width = $image->width();
            // $mime = $image->mime();
            // $size = $image->filesize();
            $image->stream();
            $image_xs->fit(200, 200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize('center');
            })->stream();

            $put = Storage::disk(env('disk', 'ftp'))->put($newfile, $image);
            $size = Storage::disk(env('disk', 'ftp'))->size($newfile);

            if ($put) {
                return response()->json([
                    'status' => 'success',
                    'image' => [
                        'name' => $newfile,
                    ]
                ]);
            } else {
                return response()->json(['status' => 'error']);
            }
        }
    }
    public function deleteImage(Request $request)
    {
        foreach ($request->u as $v) {
            $delete[] = Storage::disk(env('disk', 'ftp'))->delete($v);
            Storage::disk(env('disk', 'ftp'))->delete(str_replace('.', '-xs.', $v));
        }
        return response()->json(true);
    }
    public function profileImages(Request $request)
    {
        $_id = $request->cp;
        $path = "images/company/$_id/profile-image";
        $filenameArray = [];

        $handle = Storage::disk(env('disk', 'ftp'))->allFiles($path);
        foreach ($handle as $file) {
            if ($file !== '.' && $file !== '..') {
                array_push($filenameArray, $file);
            }
        }

        return response()->json($filenameArray);
    }
    public function profileVideos(Request $request)
    {
        $_id = $request->cp;
        $path = "videos/company/$_id";
        $filenameArray = [];
        $handle = Storage::disk(env('disk', 'ftp'))->allFiles($path);
        foreach ($handle as $file) {
            if ($file !== '.' && $file !== '..') {
                array_push($filenameArray, $file);
            }
        }

        return response()->json($filenameArray);
    }
    public function uploadVideos(Request $request)
    {
        // $video = $request->file('videos');
        // return $request->file('videos');
        $path = [];
        if ($request->hasFile('videos')) {

            foreach ($request->file('videos') as $file) {
                // $ext = '.'.$file->getClientOriginalExtension();
                $newfile = $file->getClientOriginalName();
                $fullpath = "videos/company/$request->_id/$newfile";
                // $video->storeAs('',$fullpath, env('disk','ftp'));
                $file->storeAs('', "$fullpath", env('disk', 'ftp'));

                $check = Storage::disk(env('disk', 'ftp'))->exists($fullpath);
            }
            if ($check) {
                $path[] = $fullpath;
                return $path;
            } else {
                return 'no file 1.';
            }
        } else {
            return 'no file 2.';
        }
    }

    public function license(Request $req)
    {
        $data = \App\Models\CompanyMd::find($req->id);
        $data->license = ($data->license == false) ? true : false;
        $jcs = \App\Models\JobCsMd::where('company', $data->id)->first();
        if ($data->license == true) {
            $data->license_by = Auth::user()->id;

            $jcs->license = date('Y-m-d H:i:s');
            $jcs->save();
        } else {
            $data->license_by = NULL;

            $jcs->license = NULL;
            $jcs->save();
        }

        if ($data->save()) {
            return response()->json(['status' => 200, 'message' => 'updated license status', 'by' => \App\Models\UsersMd::find($data->license_by)]);
        } else {
            return response()->json(['status' => 200, 'message' => 'something went wrong please try againt.']);
        }
    }

    public function semi(Request $req)
    {
        $data = \App\Models\CompanyMd::find($req->id);
        $data->semi = ($data->semi == false) ? true : false;

        if ($data->save()) {
            return response()->json(['status' => 200, 'message' => 'updated semi status', 'by' => "NOT"]);
        } else {
            return response()->json(['status' => 200, 'message' => 'something went wrong please try againt.']);
        }
    }

    public function email_duplicate(Request $request)
    {
        if ($request->id) {
            $query = \App\Models\MemberMd::where('id', '!=', $request->id)->where('email', $request->email)->count();
        } else {
            $query = \App\Models\MemberMd::where('email', $request->email)->count();
        }
        $query = ($query == 0) ? true : false;
        return response()->json($query);
    }

    public function name_duplicate(Request $request)
    {

        if ($request->name_th) {
            $get = \App\Models\MemberMd::where('name_th', $request->name_th)->count();
            return response()->json($get == 0 ? true : false);
        }
        if ($request->name_jp) {
            $get = \App\Models\MemberMd::where('name_jp', $request->name_jp)->count();
            return response()->json($get == 0 ? true : false);
        }
        // return response()->json(false);
    }
    public function profileUrlDuplicate(Request $request)
    {
        if ($request->id) {
            $query = \App\Models\CompanyMd::where('id', '!=', $request->id)->where('profile_url', $request->profile_url)->count();
        } else {
            $query = \App\Models\CompanyMd::where('profile_url', $request->profile_url)->count();
        }
        $query = ($query == 0) ? true : false;
        return response()->json($query);
    }

    public function nameCheck(Request $request)
    {
        $data = [];
        $name_th = $request->name_th;
        $name_jp = $request->name_jp;

        if ($name_th || $name_jp) {
            $get = \App\Models\MemberMd::when($request->name_th, function ($query) use ($name_th) {
                $query->whereRaw('REPLACE(name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $name_th) . "%"]);
            })
                ->when($request->name_jp, function ($query) use ($name_jp) {
                    $query->orWhereRaw('REPLACE(name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $name_jp) . "%"]);
                })
                ->get();
            foreach ($get as $k => $v) {
                $data[] = [
                    'id' => $v->id,
                    'name_th' => $v->name_th,
                    'name_jp' => $v->name_jp,
                    'email' => $v->email,
                    'deleted' => $v->deleted,
                    'created' => $v->created
                ];
            }
            return response()->json($data);
        } else {
            return response()->json($data);
        }
    }

    public function emailCheck(Request $request)
    {
        $data = [];
        $email = $request->email;
        if ($email) {
            $get = \App\Models\MemberMd::select([
                'members.id',
                'members.name_th as memberNameth',
                'members.name_jp as memberNamejp',
                'members.email as memberEmail',
                'company.name_th as companyNameth',
                'company.name_jp as companyNamejp',
                'company.logo as logo',
                'company.created_by',
                'company.deleted',
                'category.name_jp as categoryName'
            ])
                ->join('company', 'members.id', 'company._id')
                ->leftJoin('category', 'company.category', 'category.id')
                ->whereRaw('REPLACE(members.email," ","") LIKE ?', ["%" . str_replace(' ', '', $email) . "%"])
                ->get();

            foreach ($get as $k => $v) {
                $data[] = [
                    'id' => $v->id,
                    'memberNameth' => $v->memberNameth,
                    'memberNameth' => $v->memberNamejp,
                    'memberEmail' => $v->memberEmail,
                    'companyNameth' => $v->companyNameth,
                    'companyNamejp' => $v->companyNamejp,
                    'logo' => $v->logo,
                    'created_by' => $v->created_by,
                    'deleted' => $v->deleted,
                    'categoryName' => $v->categoryName,
                ];
            }
            return response()->json($data);
        } else {
            return response()->json($data);
        }
    }

    public function companyNameDuplicate(Request $request)
    {
        $data = [];
        $name_th = $request->name_th;
        $name_jp = $request->name_jp;

        $get = \App\Models\CompanyMd::select([
            "company.name_th",
            "company.name_jp",
            'company.email',
            'company.deleted',
            'category.name_jp as category',
            'category_sub.name_jp as category_sub',
            'category_main.name_jp as category_main',
        ])
            ->leftJoin('category', 'company.category', '=', 'category.id')
            ->leftJoin('category_sub', 'category.category_sub', '=', 'category_sub.id')
            ->leftJoin('category_main', 'category_sub.category_main', '=', 'category_main.id')
            ->when($request->name_th, function ($query) use ($name_th) {
                $query->whereRaw('REPLACE(company.name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $name_th) . "%"]);
            })
            ->when($request->name_jp, function ($query) use ($name_jp) {
                $query->orWhereRaw('REPLACE(company.name_jp," ","") LIKE ?', ["%" . str_replace(' ', '', $name_jp) . "%"]);
            })
            ->withTrashed()
            ->get();

        foreach ($get as $i => $v) {
            $data[] = [
                'name' => [
                    'th' => $v->name_th,
                    'jp' => $v->name_jp
                ],
                'email' => $v->email,
                'deleted' => $v->deleted,
                'category' => $v->category,
                'category_sub' => $v->category_sub,
                'category_main' => $v->category_main
            ];
        }

        return response()->json($data);
    }

    public function makeDirectory(Request $request)
    {
        Storage::disk(env('disk', 'ftp'))->makeDirectory($request->path);

        Storage::disk('public')->makeDirectory($request->path);


        return Storage::disk(env('disk', 'ftp'))->directories($request->path);
    }

    public function milliseconds()
    {
        $mt = explode(' ', microtime());
        return ((int)$mt[1]) * 1000 + ((int)round($mt[0] * 1000));
    }

    public function filter(Request $request)
    {
        $get = \App\Models\CategoryMd::find($request->category);
        $data = \App\Http\Controllers\CenterCtrl::filterOfCategory($get->key);
        return response()->json($data);
    }

    public function getOptionCategorySub(Request $request)
    {
        $data = \App\Models\CategorySubMd::where('category_main', $request->main)->get();
        return response()->json($data);
    }

    public function getOptionCategory(Request $request)
    {
        $data = \App\Models\CategoryMd::where('category_sub', $request->sub)->get();
        return response()->json($data);
    }
}
