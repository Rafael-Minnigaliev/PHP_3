<?php

class Payment {
    private $strategy;

    public function __construct(Strategy $strategy) {
        $this->strategy = $strategy;
    }

    public function setStrategy(Strategy $strategy) {
        $this->strategy = $strategy;
    }

    public function makePayment() : string {
        $form = "<form>";
        $form .= "Имя: <input type='text'><br>";
        $form .= "Телефон: <input type='tel'><br>";
        $form .= $this->strategy->getForm();
        $form .= "<input type='submit' value='Отпавить'>";
        $form .= "</form><hr>";
        return $form;
    }
}


interface Strategy {
    public function getForm() : string;
}


class Qiwi implements Strategy {
    public function getForm() : string {
        return "Qiwi кошелек: <input type='text'><br>";;
    }
}

class Yandex implements Strategy {
    public function getForm() : string {
        return "Яндекс деньги: <input type='text'><br>";;
    }
}

class WebMoney implements Strategy {
    public function getForm() : string {
        return "WebMoney: <input type='text'><br>";;
    }
}


$context = new Payment(new Yandex());
echo $context->makePayment();

$context->setStrategy(new Qiwi());
echo $context->makePayment();

$context->setStrategy(new WebMoney());
echo $context->makePayment();
