<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\UserPill;
use Illuminate\Console\Command;
use PHPMailer\PHPMailer\PHPMailer;

class PillEmailSender extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:pill-email-sender';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send Remember email to all user pill';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->calcNextReminder();
        $userReminders = UserPill::where('status',1)->all();
        foreach ($userReminders as $reminder)
        {
            if($reminder->next_remind_time >time())
            {
                ///send email
                $user = User::find($reminder->user_id);
                $this->sendMail($reminder,$user);
            }
        }
    }

    function calcNextReminder(){
        $userReminders = UserPill::where('status',1)->all();
        foreach ($userReminders as $reminder)
        {
            //check reminder can be removed
            $active_until =$reminder->treatment_start_time + ($reminder->treatment_duration *24*3600);
            if(time() > $active_until)
            {
                //deactive item
                $reminder->status = 0;
                $reminder->save();
                continue;
            }
            $reminder->next_remind_time = $reminder->next_remind_time + ($reminder->consumption_period *3600);
            $reminder->save();
        }

    }

    function sendMail($item,$user){
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Mailer = "smtp";
        $mail->SMTPDebug  = 1;
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port       = 587;
        $mail->Host       = "smtp.gmail.com";
        $mail->Username   = env('SMTP_USERNAME');
        $mail->Password   = env('SMTP_PASSWORD');
        $mail->IsHTML(true);
        $mail->AddAddress($user->email, $user->name);
        $mail->SetFrom("pillreminder@gmail.com", "Pill Reminder");
        $mail->Subject = "Time to Consume Your Pill";
        $content = "<b>Time to Consume Your Pill</b>";
        $mail->MsgHTML($content);
        if(!$mail->Send()) {
            echo "Error while sending Email.";
            var_dump($mail);
        } else {
            echo "Email sent successfully";
        }
    }

}
