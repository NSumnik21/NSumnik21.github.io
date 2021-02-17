<?php

namespace Lights;

class GameController extends ControllerBase {
    /**
     * GameController constructor.  Checks if the game is being solved/cleared, also checks if answers are being checked
     * @param $lights Lights lights class
     * @param $post array post
     */
    public function __construct($lights, $post){
        $this->redirect = 'game.php';
        $this->lights = $lights;
        $game = $this->lights->getCurrent();
        $this->lights->setCheck(false);
        $this->lights->setSolveQuestion(false);
        $this->lights->setClearQuestion(false);

        $view = new GameView($lights);
        if(isset($post['cell'])){
            $rc = explode(',', strip_tags($post['cell']));
            $game->click(intval($rc[0]), intval($rc[1]));
            $table = $view->present_body();
            $this->result = json_encode(['table' => $table]);
            return;
        }
        if(isset($post['solve'])){
            $this->lights->setSolveQuestion(true);
            $page = $view->present_body();
            $this->result = json_encode(['page' => $page]);
            return;
        }
        if(isset($post['clear'])){
            $this->lights->setClearQuestion(true);
            $page = $view->present_body();
            $this->result = json_encode(['page' => $page]);
            return;
        }
        if(isset($post['solve_yes'])){
            $game->solve();
            $page = $view->present_body();
            $this->result = json_encode(['page' => $page]);
            return;
        }
        if(isset($post['clear_yes'])){
            $game->clear();
            $page = $view->present_body();
            $this->result = json_encode(['page' => $page]);
            return;
        }
        if(isset($post['check'])){
            $this->lights->setCheck(true);
            $page = $view->present_body();
            $this->result = json_encode(['page' => $page]);
            return;
        }
        if(isset($post['no'])){
            $page = $view->present_body();
            $this->result = json_encode(['page' => $page]);
            return;
        }
    }
}