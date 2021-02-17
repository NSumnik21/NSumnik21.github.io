<?php

use Lights\GameView as GameView;
use Lights\Lights as Lights;

class GameViewTest extends \PHPUnit\Framework\TestCase {
    public function testPresent(){
        $l = new Lights();
        $l->setGame('5x5easy-1.json');
        $v = new GameView($l);
        $this->assertContains("welcome to Light Em Up!", $v->present());
    }
    public function testName(){
        $l = new Lights();
        $l->setGame('5x5easy-1.json');
        $v = new GameView($l);
        $l->setName("Jeff");
        $this->assertContains("Greetings, Jeff", $v->present());
    }

    public function testWrong(){
        $l = new Lights();
        $l->setGame('5x5easy-1.json');
        $l->setCheck(true);
        $v = new GameView($l);

        $l->getCurrent()->click(1, 3);
        $this->assertContains("<td class='wrong'><button name='cell' value='1,3'>
                               <img src='light.png' width='43' height='75' alt='light'></button></td>", $v->present());
    }
}