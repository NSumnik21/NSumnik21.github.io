<?php

use Lights\OptionsView as OptionsView;
use Lights\Lights as Lights;

class OptionsViewTest extends \PHPUnit\Framework\TestCase {
    public function testPresent(){
        $l = new Lights();
        $v = new OptionsView($l);

        $this->assertContains("Light Em Up! Options", $v->present());
    }
    public function testButtons(){
        $l = new Lights();
        $v = new OptionsView($l);

        $l->setLighted(true);
        $l->setClues(true);
        $this->assertContains("id=\"lighted\" checked='checked'", $v->present());
        $this->assertContains("id=\"hints\" checked='checked'", $v->present());
    }
}