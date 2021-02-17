<?php

namespace Lights;

class IndexController extends ControllerBase {
    /**
     * IndexController constructor.  Gets the game difficulty and the name, returns to index page if there is no name
     * entered
     * @param Lights $l lights class
     * @param $post post
     */
    public function __construct(Lights $l, $post){
        $this->lights = $l;
        if(isset($post['name']) && !empty($post['name']) && !ctype_space($post['name'])){
            $this->lights->setName(strip_tags($post['name']));
            $this->redirect = 'game.php';
        }
        else{
            $this->lights->setGotName(false);
            $this->redirect = 'index.php';
        }
        $ver = strip_tags($post['difficulty']);
        if($ver === '5x5 Easy'){
            $l->setGame('5x5easy-1.json');
        }
        else if($ver === '5x5 Hard'){
            $l->setGame('5x5hard-1.json');
        }
        else if($ver === '7x7 Easy'){
            $l->setGame('7x7easy-1.json');
        }
        else if($ver === '7x7 Medium'){
            $l->setGame('7x7medium-1.json');
        }
        else if($ver === '10x10 Easy'){
            $l->setGame('10x10easy-1.json');
        }
    }
}