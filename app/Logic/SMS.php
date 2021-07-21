<?php


namespace App\Logic;


use SoapClient;

class SMS
{
    private $from;
    private $to;
    private $pattern_code;
    private $username;
    private $password;

    public function __construct($mobile, $pattern_code)
    {
        $this->username = env("SMS_USERNAME", "9106986686");
        $this->password = env("SMS_PASSWORD", "faraz1080087966");
        $this->to = $mobile;
        $this->from = env("SMS_SENDER");
        $this->pattern_code = $pattern_code;
    }

    public function send(array $input_data)
    {
        $client = new \SoapClient("http://ippanel.com/class/sms/wsdlservice/server.php?wsdl");
        $user = $this->username;
        $pass = $this->password;
        $fromNumber = $this->from;
        $toNumber = array($this->to);
        $pattern_code = $this->pattern_code;
//        $input_data = array("tracking-code" => "1054 4-41", "name" => "PAnel");

        return $client->sendPatternSms($fromNumber, $toNumber, $user, $pass, $pattern_code, $input_data);
    }
}