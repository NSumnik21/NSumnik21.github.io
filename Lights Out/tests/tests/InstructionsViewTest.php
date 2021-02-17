<?php

use Lights\InstructionsView as InstructionsView;
use Lights\Lights as Lights;

class InstructionsViewTest extends \PHPUnit\Framework\TestCase {
    public function testPresent(){
        $l = new Lights();
        $v = new InstructionsView($l);

        $this->assertContains("Light Em Up! Instructions", $v->present());
    }
    public function testReturn(){
        $l = new Lights();
        $v = new InstructionsView($l);

        $this->assertNotContains("RETURN TO GAME", $v->present());

        $l->setGame('5x5easy-1.json');
        $this->assertContains("RETURN TO GAME", $v->present());
    }
}