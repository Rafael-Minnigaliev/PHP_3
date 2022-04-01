<?php

class Vacancy implements \SplSubject{
    public $state;
    private $observers;

    public function __construct(){
        $this->observers = new \SplObjectStorage();
    }

    public function attach(\SplObserver $observer): void {
        echo "Добавили слушателя.<br>";
        $this->observers->attach($observer);
    }

    public function detach(\SplObserver $observer): void {
        $this->observers->detach($observer);
        echo "Удалили слушателя.<br>";
    }

    public function notify(): void {
        echo "Уведомление отправлено на почту слушателей<br>";
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function addAVacancy(): void {
        echo "Добавили новую вакансию<br>";
        $this->state = rand(0, 10);
        echo "Требуемый опыт работы: {$this->state}<br>";
        $this->notify();
    }
}


class Ivan implements \SplObserver {
    public function update(\SplSubject $subject): void {
        if ($subject->state >= 3) {
            echo "Иван: отреагировал на новую вакансию<br>";
        }
    }
}

class Dima implements \SplObserver {
    public function update(\SplSubject $subject): void {
        if ($subject->state < 3) {
            echo "Дима отреагировал на новую вакансию<br>";
        }
    }
}

class Artem implements \SplObserver {
    public function update(\SplSubject $subject): void {
        if ($subject->state != 0) {
            echo "Артём отреагировал на новую вакансию<br>";
        }
    }
}



$subject = new Vacancy();

$o1 = new Ivan();
$subject->attach($o1);

$o2 = new Dima();
$subject->attach($o2);

$o3 = new Artem();
$subject->attach($o3);

$subject->addAVacancy();
$subject->addAVacancy();

$subject->detach($o2);

$subject->AddAVacancy();
