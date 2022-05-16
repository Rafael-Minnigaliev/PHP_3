<?php
interface ISend{
    public function send() : string;
}

class BaseSend implements ISend{
    public function send() : string{
        return "send";
    }
}

class Decorator implements ISend{
    protected $component;
    /**
    * @var ISend
    */
    public function __construct(ISend $component){
        $this->component = $component;
    }

    public function send() : string{
        return $this->component->send();
    }
}

class Sms extends Decorator{
    public function send() : string{
        return "Sms - ".parent::send();
    }
}

class Email extends Decorator{
    public function send() : string{
        return "Email - ".parent::send();
    }
}

class ChromeNotification extends Decorator{
    public function send() : string{
        return "ChromeNotification - ".parent::send();
    }
}

function clientCode(ISend $component){
    echo "RESULT: ".$component->send();
}


$x = new BaseSend();

$dSms = new Sms($x);
$dEmsil = new Email($dSms);

clientCode($dEmsil);