<?php

namespace App\Console\Commands;

use App\SMSMessage;
use Illuminate\Console\Command;

class SendSMS extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:sms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $username = "";
    protected $password = "";
    protected $src = "";
    protected $dr = "";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->username = env('SMS_USERNAME');
        $this->password = env('SMS_PASSWORD');
        $this->src = env('SMS_SRC');
        $this->dr = env('SMS_DR');
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $sms_messages = SMSMessage::where('status', 0)->get();
        foreach($sms_messages as $message){
            $params = array(
                'username' => $this->username,
                'password' => $this->password,
                'src' => $this->src,
                'dst' => $message->number,
                'msg' => $message->message,
                'dr' => $this->dr
            );
            
            $param = "";
            foreach($params as $key => $value){
                $param .= $key."=".urlencode($value)."&";
            }
            $param = substr($param, 0, strlen($param)-1);
            $length =strlen($param);
            $headers = array(
                "Content-type" => "application/x-www-form-urlencoded",
                "Content-length" => $length
            );
            
            $url = "http://sms.textware.lk:5000/sms/send_sms.php?".$param;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            SMSMessage::where('id', $message->id)
                        ->update([
                            'status' => 1,
                            'develery_status' => $response
                        ]);
        }
    }
}
