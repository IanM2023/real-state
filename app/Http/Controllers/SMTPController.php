<?php

namespace App\Http\Controllers;

use App\Models\SMTP;
use Illuminate\Http\Request;

class SMTPController extends Controller
{
    public function stmp_list(Request $request)
    {
        $data['getRecord'] = Smtp::getSingleFirst();
        return view('admin.smtp.update', $data);
    }

    public function smtp_update(Request $request)
    {

        $save = Smtp::getSingleFirst();
        $save->app_name = trim($request->app_name);
        $save->mail_mailer = trim($request->mail_mailer);
        $save->mail_host = trim($request->mail_host);
        $save->mail_port = trim($request->mail_port);
        $save->mail_username = trim($request->mail_username);
        $save->mail_password = trim($request->mail_password);
        $save->mail_encryption = trim($request->mail_encryption);
        $save->mail_from_address = trim($request->mail_from_address);
        $save->created_at = NOW();
        $save->save();

        return redirect('admin/smtp')->with('success', 'New SMTP updated successfully');
    }
}
