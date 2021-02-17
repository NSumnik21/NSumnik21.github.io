<?php

use Lights\IndexView as IndexView;
use Lights\Lights as Lights;

class IndexViewTest extends \PHPUnit\Framework\TestCase {
    public function testPresent(){
        $l = new Lights();
        $v = new IndexView($l);
        $this->assertContains("Welcome to Nikolas Sumnik's Light Em Up!", $v->present());
    }
    public function testName(){
        $l = new Lights();
        $v = new IndexView($l);
        $this->assertContains("value='Player'", $v->present());
        $l->setName("Jeff");
        $this->assertContains("value='Jeff'", $v->present());
    }
}