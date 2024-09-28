<?php

namespace App\Http\Controllers;

use App\Models\Newsuser;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Illuminate\Support\Facades\App;

class AdminController extends Controller
{
    public function index ()
    {
        return view('dachboard.index');
    }
    public function users ()
    {
        $users = Newsuser::get();
        return view('dachboard.pages.Newsletter.index', compact('users'));
    }

    public function careersEmail(Request $request)
    {
        require base_path("vendor/autoload.php");
        $body = '<html>
					<head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                        <title></title>
                    </head>
                    <body style="direction:rtl;text-align:right;">
                        <div id="email-wrap">
                        <p>الاسم: '.$request->name.'</p><br>
                        <p>البريد الالكتروني: '.$request->email.'</p><br>
                        <p>رقم الجوال: '.$request->phone.'</p><br>
                        <p>نوع الوظيفة: <b>'.$request->positionname.'</b></p><br><br>
                        </div>
                    </body>
                </html>
                        ';
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();                                            //Send using SMTP
            $mail->CharSet = 'UTF-8';
            $mail->Host       = 'mail.sitksa-eg.com';                    //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'sales@sitksa-eg.com';                  //SMTP username
            $mail->Password   = 'Sit@sales@ksa1234';                    //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
           //Recipients
            $mail->setFrom($request->email);
            // $mail->addAddress('sales@sitksa-eg.com');
            $mail->addAddress('mohamed.qutp2101@gmail.com');
            $mail->isHTML(true);
            $mail->Subject = $request->contactreason;
            $mail->Body    = $body;

            $mail = new PHPMailer(true);     // Passing `true` enables exceptions
            // Email server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'mail.sitksa.com';             //  smtp host
            $mail->SMTPAuth = true;
            $mail->Username = 'info@sitksa-eg.com';   //  sender username
            $mail->Password = 'M01008281513';       // sender password
            $mail->SMTPSecure = 'ssl';                  // encryption - ssl/tls
            $mail->Port = 465;                          // port - 587/465
            $mail->CharSet = 'UTF-8';
            $mail->setFrom('info@sitksa-eg.com', $request->name);
            // $mail->addAddress('info@sitksa-eg.com');
            $mail->addAddress('mh5849506@gmail.com');
            // $mail->addCC($request->emailCc);
            // $mail->addBCC($request->emailBcc);
            // $mail->addReplyTo('sender@example.com', 'SenderReplyName');
            if(isset($_FILES['cv'])) {
                $mail->addAttachment($_FILES['cv']['tmp_name'], $_FILES['cv']['name']);
            }


            $mail->isHTML(true);                // Set email content format to HTML

            $mail->Subject = "طلب وظيفة";
            $mail->Body    = $body;


            // $mail->AltBody = plain text version of email body;

            if( !$mail->send() ) {
                toastr()->error('Email not sent..',' ');
                return back();
            }

            else
            {
                if (App::getLocale() =='en') {
                    toastr()->success('Your message has been sent successfully.',' ');
                    return back();
                }
                else
                {
                    toastr()->success('تم إرسال الرسالة بنجاح ',' ');
                    return back();
                }
            }

        } catch (Exception $e) {
            toastr()->error('Message could not be sent',' ');
            return back();
            }
    }

    public function contactEmail(Request $request)
    {
        require base_path("vendor/autoload.php");

        $body = '<html>
					<head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                        <title></title>
                    </head>
                    <body style="direction:rtl;text-align:right;">
                        <div id="email-wrap">
                        <p>اسم العميل: '.$request->name.'</p><br>
                        <p>البريد الالكتروني: '.$request->email.'</p><br>
                        <p>الرسالة: '.$request->message.'</p><br>
                        </div>
                    </body>
                </html>
                        ';
        try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();                                            //Send using SMTP
        $mail->CharSet = 'UTF-8';
        $mail->Host       = 'mail.pmskw.com';                    //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'pmswebsite@pmskw.com';                  //SMTP username
        $mail->Password   = '-E3S=;r+srV.';                    //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
       //Recipients
        $mail->setFrom($request->email);
        // $mail->addAddress('sales@sitksa-eg.com');
        $mail->addAddress('mohamed.qutp2101@gmail.com');
        $mail->isHTML(true);
        $mail->Subject = $request->contactreason;
        $mail->Body    = $body;

        if( !$mail->send() ) {
            toastr()->error('Email not sent..',' ');

                return back();
            }
            else
            {
            if (App::getLocale() =='en') {
                toastr()->success('Your message has been sent successfully.',' ');
                return back();
            }
            else
            {
                toastr()->success('تم إرسال الرسالة بنجاح ',' ');
                return back();
            }
            }

        } catch (Exception $e) {
            toastr()->error('Message could not be sent',' ');
            return back();
        }

    }
}
