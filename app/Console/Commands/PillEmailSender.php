<?php

namespace App\Console\Commands;

use App\Models\UserPill;
use Illuminate\Console\Command;

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

}
