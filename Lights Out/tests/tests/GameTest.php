<?php

use Lights\Lights as Lights;
use Lights\Game as Game;

class GameTest extends \PHPUnit\Framework\TestCase {
    public function testConstruct(){
        $l = new Lights();
        $g = new Game($l, __DIR__ . '/../..' . '/games/', "5x5easy-1.json");
        $sol = array(1=>array(1=>'l', 2=>'m', 3=>'m', 4=>'m', 5=>0),
            2=>array(1=>null, 2=>'m', 3=>1, 4=>'l', 5=>'m'),
            3=>array(1=>2, 2=>'l', 3=>'m', 4=>'m', 5=>'m'),
            4=>array(1=>'l', 2=>'m', 3=>'m', 4=>'m', 5=>'m'),
            5=>array(1=>'m', 2=>'m', 3=>'l', 4=>null, 5=>'l'));
        $this->assertEquals($sol, $g->getSol());
        $board = array(1=>array(1=>'e', 2=>'e', 3=>'e', 4=>'e', 5=>0),
            2=>array(1=>null, 2=>'e', 3=>1, 4=>'e', 5=>'e'),
            3=>array(1=>2, 2=>'e', 3=>'e', 4=>'e', 5=>'e'),
            4=>array(1=>'e', 2=>'e', 3=>'e', 4=>'e', 5=>'e'),
            5=>array(1=>'e', 2=>'e', 3=>'e', 4=>null, 5=>'e'));
        $this->assertEquals($board, $g->getBoard());
    }

    public function testClick(){
        $l = new Lights();
        $g = new Game($l, __DIR__ . '/../..' . '/games/', "5x5easy-1.json");
        $board = array(1=>array(1=>'l', 2=>'m', 3=>'e', 4=>'e', 5=>0),
            2=>array(1=>null, 2=>'e', 3=>1, 4=>'e', 5=>'e'),
            3=>array(1=>2, 2=>'e', 3=>'e', 4=>'e', 5=>'e'),
            4=>array(1=>'e', 2=>'e', 3=>'e', 4=>'e', 5=>'e'),
            5=>array(1=>'e', 2=>'e', 3=>'e', 4=>null, 5=>'e'));
        $g->click(1,1);
        $g->click(1,2);
        $g->click(1,2);
        $g->click(1,3);
        $g->click(1,3);
        $g->click(1,3);
        $g->click(2,1);
        $this->assertEquals($board, $g->getBoard());
        $g->click(0,3);
        $g->click(1,0);
        $this->assertEquals($board, $g->getBoard());
    }

    public function testCheckDone(){
        $l = new Lights();
        $g = new Game($l, __DIR__ . '/../..' . '/games/', "5x5easy-1.json");
        $this->assertFalse($g->checkDone());
        $g->click(1,1);
        $g->click(2,4);
        $g->click(3,2);
        $g->click(4,1);
        $g->click(5,3);
        $g->click(5,5);
        $this->assertTrue($g->checkDone());
    }

    public function testCheckMoves(){
        $l = new Lights();
        $g = new Game($l, __DIR__ . '/../..' . '/games/', "5x5easy-1.json");
        $this->assertEquals(array(), $g->checkMoves());
        $g->click(1,1);
        $g->click(1,1);
        $g->click(2,2);
        $g->click(2,4);
        $wrong = array('1,1', '2,2');
        $this->assertEquals($wrong, $g->checkMoves());
    }

    public function testMisc(){
        $l = new Lights();
        $g = new Game($l, __DIR__ . '/../..' . '/games/', "5x5easy-1.json");
        $sol = array(1=>array(1=>'l', 2=>'m', 3=>'m', 4=>'m', 5=>0),
            2=>array(1=>null, 2=>'m', 3=>1, 4=>'l', 5=>'m'),
            3=>array(1=>2, 2=>'l', 3=>'m', 4=>'m', 5=>'m'),
            4=>array(1=>'l', 2=>'m', 3=>'m', 4=>'m', 5=>'m'),
            5=>array(1=>'m', 2=>'m', 3=>'l', 4=>null, 5=>'l'));
        $g->solve();
        $this->assertEquals($sol, $g->getBoard());

        $board = array(1=>array(1=>'e', 2=>'e', 3=>'e', 4=>'e', 5=>0),
            2=>array(1=>null, 2=>'e', 3=>1, 4=>'e', 5=>'e'),
            3=>array(1=>2, 2=>'e', 3=>'e', 4=>'e', 5=>'e'),
            4=>array(1=>'e', 2=>'e', 3=>'e', 4=>'e', 5=>'e'),
            5=>array(1=>'e', 2=>'e', 3=>'e', 4=>null, 5=>'e'));
        $g->clear();
        $this->assertEquals($board, $g->getBoard());

        $g->click(3, 2);
        $g->click(4, 1);
        $this->assertEquals(array('1,5', '3,1'), $g->checkClues());

        $g->clear();
        $g->click(1,1);
        $this->assertEquals(array('1,1','1,2','1,3','1,4'), $g->getLighted());
        $g->clear();
        $g->click(3,2);
        $this->assertEquals(array('3,2','4,2','5,2','2,2','1,2','3,3','3,4','3,5'), $g->getLighted());
    }
}