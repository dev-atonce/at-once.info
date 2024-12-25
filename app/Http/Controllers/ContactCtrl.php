<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;
use App\Mail\ContactToMe;
use Illuminate\Support\Facades\Auth;

class ContactCtrl extends Controller
{
    public function __construct()
    {
    }

    public function arraySearch($data)
    {
        $status = array_search(false, $data);
        return ($status === false) ? true : false;
    }

    public function Approve(request $request)
    {
        $subject = __('phrase.form.subject', ['company' => $request->company]);
        $type = $request->type;
        $cid = explode(',', $request->cid);
        $data = \App\Models\CompanyMd::select("id", "name_th", 'email', 'phone', 'mobile')->whereIn('id', $cid)->get();
        $emails = [];
        $names = [];
        $phone = [];
        foreach ($data as $v) {
            $comId[] = $v->id;
            $emails[] = $v->email;
            $names[] = $v->name_th;
            if ($v->phone) {
                $phone[] = $v->phone;
            } elseif ($v->mobile) {
                $phone[] = $v->mobile;
            } else {
                $phone[] = '';
            }
        }

        for ($i = 0; $i < count($emails); $i++) {
            $store = new \App\Models\SendToMd;
            // $store->type = 'category';
            $store->to = $emails[$i];
            $store->to_company = $names[$i];
            $store->company_tel = @$phone[$i];
            $store->subject = $subject;
            $store->cid = $cid[$i];
            $store->company = $request->company;
            $store->telephone = $request->telephone;
            $store->department = $request->department;
            $store->name = $request->name;
            $store->email = @$request->email;
            $store->content = $request->content;
            $store->status = 'waiting';
            if ($request->cc) {
                $store->cc = $request->cc;
            }
            if (!empty($request->attachment)) {
                $file = $request->attachment;
                // $ext = '.' . $file->getClientOriginalExtension();
                $filename = $file->getClientOriginalName();
                $newfile = $filename;
                $fullpath = 'upload/email/attachment/' . $newfile;
                $file->storeAs('', $fullpath, env('disk', 'ftp'));
                $store->attachment = $fullpath;
            }
            if ($store->save()) {
                if(\App\Models\OurCustomerMd::where('company', $comId[$i])->first()){
                    $msg = "Form Email $request->page\n=========================\nผู้รับ: $names[$i]\nอีเมล: $emails[$i]\n=========================\nผู้ส่ง: $request->name\nบริษัท: $request->company\nแผนก: $request->department\nโทรศัพท์: $request->telephone\nอีเมลตอบกลับ: $request->email\nรายละเอียดการติดต่อ: $request->content";
                    \App\Http\Controllers\Api\LineNotiCtrl::lineNoti($msg, '', 'client');
                } else {
                    $msg = "Form Email $request->page\n=========================\nผู้รับ: $names[$i]\nอีเมล: $emails[$i]\n=========================\nผู้ส่ง: $request->name\nบริษัท: $request->company\nแผนก: $request->department\nโทรศัพท์: $request->telephone\nอีเมลตอบกลับ: $request->email\nรายละเอียดการติดต่อ: $request->content";
                    \App\Http\Controllers\Api\LineNotiCtrl::lineNoti($msg, '', $type);
                }
            }
        }

        return response()->json(true);
    }

    public function SendtoCustomer(Request $request)
    {
        $data = array(
            'to' => trim($request->to, " "),
            'subject' => $request->subject,
            'company' => $request->company,
            'to_company' => $request->to_company,
            'telephone' => $request->telephone,
            'department' => $request->department,
            'name' => $request->name,
            'email' => trim($request->email, " "),
            'content' => $request->content,
            'attachment' => $request->attachment
        );

        if ($request->cc != '' && $request->cc != '-') {
            $data['cc'] = $request->cc;
        }

        try {
            Mail::send(new Contact($data));
            if (!Mail::failures()) {
                $updated = \App\Models\SendToMd::find($request->id);
                $updated->status = 'send';
                $updated->cs_id = $request->to_id;
                $updated->approve_by = $request->from_id;

                if ($updated->save()) {
                    return response()->json([
                        'status' => true,
                        'data' => $data
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'msg' => 'Failed to updated status !'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'msg' => 'Failed to send mail !'
                ]);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function rejectEmail(request $request)
    {
        $updated = \App\Models\SendToMd::find($request->id);
        $updated->status = 'reject';
        $updated->reject_by = $request->rejectby;
        $updated->message_reject = $request->message;
        $updated->cs_reject = $request->to_id;
        if ($updated->save()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    public function rejectAllEmail(request $request)
    {
        $mail = explode(',', $request->mail);
        $res = [];
        for ($i = 0; $i < count($mail); $i++) {
            $updated = \App\Models\SendToMd::find($mail[$i]);
            $updated->status = 'reject';
            $updated->reject_by = $request->user;
            $updated->message_reject = 'Reject Checkbox';
            if ($updated->save()) {
                $res[] = ['id' => $mail[$i], 'status' => true];
            } else {
                $res[] = ['id' => $mail[$i], 'status' => false];
            }
        }
        $status = $this->arraySearch($res);
        $response = [
            'statusCode' => 200,
            'status' => $status,
            'icon' => $status == true ? 'success' : 'error',
            'title' => $status == true ? 'Good job!' : 'Oops!',
            'text' => $status == true ? 'Your request has been success.' : 'Failed To Reject',
            'data' => $res
        ];
        return response()->json($response);
    }

    public function statusEmail(request $request)
    {
        $updated = \App\Models\SendToMd::find($request->_id);
        $updated->status = $request->status;
        if ($updated->save()) {
            $status_mail = new \App\Models\CustomerMailLogMd;
            $status_mail->uid = $request->uid;
            $status_mail->remark = $request->remark;
            $status_mail->_id = $request->_id;
            if ($status_mail->save()) {
                return response()->json(true);
            } else {
                return response()->json(false);
            }
        } else {
            return response()->json(false);
        }
    }

    public function getRemarkEmail(request $request)
    {
        $data = \App\Models\CustomerMailLogMd::where('_id', $request->_id)
            ->leftJoin('users', 'customer_mail_log.uid', 'users.id')
            ->get();
        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(false);
        }
    }

    public function getDetailRevise(request $request)
    {
        $data = \App\Models\SendToMd::find($request->_id);
        return response()->json($data);
    }

    public function sendmailFromPackage(request $request)
    {
        if (!empty($_SERVER['HTTP_X_REAL_IP'])) {
            $ip = "HTTP_X_REAL_IP: " . $_SERVER['HTTP_X_REAL_IP'];
        } else if (!empty($_SERVER["REMOTE_ADDR"])) {
            $ip = "REMOTE_ADDR: " . $_SERVER['REMOTE_ADDR'];
        } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = "HTTP_X_FORWARDED_FOR: " . $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = "HTTP_CLIENT_IP: " . $_SERVER['HTTP_CLIENT_IP'];
        }

        $secretKey = env('RECAPTCHA');
        $res = [
            'status' => false,
            'statusCode' => 500,
            'title' => 'error',
            'message' => 'reCAPTCHA ไม่ถูกต้อง'
        ];

        if ($request->get('g-recaptcha-response')) {

            $verify = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secretKey . '&response=' . $request->get('g-recaptcha-response'));
            $response = json_decode($verify);
            if (!$response) {
            } else if ($response->success) {

                $data = array(
                    'to' => 'marketing@at-once.info',
                    'subject' => 'ติดต่อเรา',
                    'company' => $request->company,
                    'name' => $request->name,
                    'telephone' => $request->telephone,
                    'department' => $request->category,
                    'email' => $request->email,
                    'detail' => $request->detail
                );
                Mail::send(new ContactToMe($data));
                if (!Mail::failures()) {
                    //NOTIFICATION TO LINE
                    if ($request->package) {
                        $text = "$ip\n$request->page : \nคุณ : $request->name\nบริษัท : $request->company\nแผนก : $request->department\nหมายเลขโทรศัพท์ : $request->telephone\nอีเมล : $request->email\nรายละเอียดการติดต่อ : $request->detail\nแพคเกจ : $request->package";
                    } else {
                        $text = "$ip\n$request->page : \nคุณ : $request->name\nบริษัท : $request->company\nแผนก : $request->department\nหมายเลขโทรศัพท์ : $request->telephone\nอีเมล : $request->email\nรายละเอียดการติดต่อ : $request->detail";
                    }
                    $noti = \App\Http\Controllers\Api\LineNotiCtrl::lineNoti($text, '', $request->type);

                    if ($noti->status == 200) {
                        //Store in DB
                        $store = new \App\Models\ContactMd;
                        $store->type = 'promotion-package';
                        $store->company = $request->company;
                        $store->name = $request->name;
                        $store->telephone = $request->telephone;
                        $store->department = $request->department;
                        $store->email = $request->email;
                        $store->detail = $request->detail;
                        $store->package = @$request->package;
                        $store->type = 'package';

                        if ($store->save()) {
                            return response()->json([
                                'status' => true,
                                'data' => $data
                            ]);
                        } else {
                            return response()->json([
                                'status' => false,
                                'msg' => 'Failed to updated status !'
                            ]);
                        }
                    } else {
                        return response()->json([
                            'status' => false,
                            'msg' => $noti->message,
                            'statusCode' => $noti->status
                        ]);
                    }
                } else {
                    return response()->json([
                        'status' => false,
                        'msg' => 'Failed to send mail !'
                    ]);
                }
            }
            return response()->json($res);
        }
        return response()->json($res);
    }

    public function storeContactFormBasic(Request $request)
    {
        if (!empty($_SERVER['HTTP_X_REAL_IP'])) {
            $ip = $_SERVER['HTTP_X_REAL_IP'];
        } else if (!empty($_SERVER["REMOTE_ADDR"])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }

        $store = new \App\Models\ContactMd;
        $store->type = 'basic';
        $store->company = $request->company;
        $store->name = $request->name;
        $store->telephone = $request->telephone;
        $store->email = $request->email;
        $store->detail = $request->detail;
        $store->ip = $ip;
        $store->created = date('Y-m-d H:i:s');
        if ($store->save()) {
            $data = array(
                'to' => 'marketing@at-once.info',
                'subject' => 'ติดต่อเรา',
                'company' => $request->company,
                'name' => $request->name,
                'telephone' => $request->telephone,
                'email' => $request->email,
                'detail' => $request->detail,
            );
            Mail::send(new ContactToMe($data));
            if (!Mail::failures()) {
                $text = "Basic Profile Page: \nคุณ : $request->name\nหมายเลขโทรศัพท์ : $request->telephone\nอีเมล : $request->email\nบริษัท : $request->company\nรายละเอียดการติดต่อ : $request->detail";
                $noti = \App\Http\Controllers\Api\LineNotiCtrl::lineNoti($text, '', 'atonce');
            }

            $res = [
                'status' => 'success',
                'statusCode' => 200,
                'title' => 'สำเร็จ!',
                'message' => 'ได้รับข้อมูลแล้ว เราจะติดต่อกลับหาคุณ'
            ];
        } else {

            $res = [
                'status' => 'error',
                'statusCode' => 500,
                'title' => 'ผิดพลาด!',
                'message' => 'กรุณาทำรายการใหม่ภายหลัง'
            ];
        }
        return response()->json($res);
    }


    public function ReviseMail(request $request)
    {
        $data = new \App\Models\ReviseMailMd;
        $data->message = $request->message;
        $data->from_id = $request->from_id;
        $data->to_id = $request->to_id;
        $data->_id = $request->_id;
        $data->status = 'process';
        if ($data->save()) {
            $updated = \App\Models\SendToMd::find($request->_id);
            $updated->status = 'revise';
            if ($updated->save()) {
                return response()->json(true);
            } else {
                return response()->json(false);
            }
        } else {
            return response()->json(false);
        }
    }

    public function UpdateReviseMail(request $request)
    {
        $updated = \App\Models\ReviseMailMd::find($request->id);
        $updated->status = 'success';
        if ($updated->save()) {
            $contact = \App\Models\SendToMd::find($request->_id);
            $contact->status = 'waiting';
            $contact->company = $request->company;
            $contact->telephone = $request->telephone;
            $contact->department = $request->department;
            $contact->name = $request->name;
            $contact->email = @$request->email;
            $contact->content = $request->content;
            if ($contact->save()) {
                return response()->json(true);
            } else {
                return response()->json(false);
            }
        } else {
            return response()->json(false);
        }
    }

    public function RestoreMail(request $request)
    {
        $restore = \App\Models\SendToMd::find($request->id);
        $restore->status = 'waiting';
        if ($restore->save()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
}
