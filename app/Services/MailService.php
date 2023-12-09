<?php


namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Mail;

class MailService
{
    public function customerPaymentMail($mail_content = [])
    {
        try {
            if (config('constants.is_smtp_active')) {
                $to_email = $mail_content['to_email'];
                $subject = $mail_content['subject'];

                Mail::send('mail.customer-payment', $mail_content, function ($messages) use ($to_email, $subject) {
                    $messages->from(config('constants.mail_from_email'))
                        ->to($to_email)
                        ->subject($subject);
                });
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function advancePaymentMail($mail_content = [])
    {
        try {
            if (config('constants.is_smtp_active')) {
                $to_email = $mail_content['to_email'];
                $subject = $mail_content['subject'];

                $mail_content = $mail_content['data'];

                Mail::send('mail.advanced-payment', $mail_content, function ($messages) use ($to_email, $subject) {
                    $messages->from(config('constants.mail_from_email'))
                        ->to($to_email)
                        ->subject($subject);
                });
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}