<?php

use Lights\IndexController as IndexController;
use Lights\Lights as Lights;

class IndexControllerTest extends \PHPUnit\Framework\TestCase {
    public function testName(){
        $l = new Lights();
        $c = new IndexController($l, array('name'=>'Jeff', 'difficulty'=>'5x5 Easy'));

        $this->assertEquals('game.php', $c->getRedirect());
        $this->assertEquals('Jeff', $l->getName());

        $l = new Lights();
        $c = new IndexController($l, array('difficulty'=>'5x5 Easy'));

        $this->assertEquals('index.php', $c->getRedirect());
        $this->assertFalse($l->isGotName());

        $l = new Lights();
        $c = new IndexController($l, array('name'=>'', 'difficulty'=>'5x5 Easy'));

        $this->assertEquals('index.php', $c->getRedirect());
        $this->assertFalse($l->isGotName());

        $l = new Lights();
        $c = new IndexController($l, array('name'=>'  ', 'difficulty'=>'5x5 Easy'));

        $this->assertEquals('index.php', $c->getRedirect());
        $this->assertFalse($l->isGotName());
    }
}