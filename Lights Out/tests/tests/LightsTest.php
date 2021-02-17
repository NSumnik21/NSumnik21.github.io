<?php
require __DIR__ . "/../../vendor/autoload.php";

use Lights\Lights as Lights;
use Lights\Game as Game;

class LightsTest extends \PHPUnit\Framework\TestCase {
    public function testInit(){
        $l = new Lights();
        $this->assertInstanceOf("Lights\Lights", $l);
    }

    public function testGames(){
        $l = new Lights();
        $l->setGame('5x5easy-1.json');
        $g = new Game($l, __DIR__ . '/../..' . '/games/', '5x5easy-1.json');
        $this->assertEquals($g->getBoard(), $l->getCurrent()->getBoard());
    }
}