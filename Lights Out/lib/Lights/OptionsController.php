<?php

namespace Lights;

class OptionsController extends ControllerBase {
    /**
     * OptionsController constructor.  Checks if tiles are to be lit or if clues are to be shown
     * @param Lights $lights lights class
     * @param $post array post
     */
    public function __construct(Lights $lights, $post){
        $this->redirect = "game.php";
        $this->lights = $lights;
        $this->lights->setClues(false);
        $this->lights->setLighted(false);
        if(isset($post['lighted'])){
            $this->lights->setLighted(true);
        }
        if(isset($post['hints'])){
            $this->lights->setClues(true);
        }
    }
}