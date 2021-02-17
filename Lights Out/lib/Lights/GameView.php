<?php

namespace Lights;

class GameView extends ViewBase {
    /**
     * presents the body of the game, changes based on if the answers are being cleared/solved, also if the game is solved
     * @return string|void HTML
     */
    public function present_body(){
        $present = <<<HTML
<div id="game">
    <form method="post" action="game-post.php">
HTML;
        $present .= $this->makeTable();

    $present .= "<div class='control''>";
    if($this->lights->isClearQuestion()){
            $present .= <<<HTML
<div class="question"><p><button class="clear_yes" name="clear_yes">Yes</button><button class="no" name="no">No</button></p></div>
<p>Are you sure you want to clear?</p>
HTML;
        }
    else if($this->lights->getCurrent()->checkDone()){
        $present .= <<<HTML
<p>Solution is correct!</p>
<p>
                <button class="clear" name="clear">Clear</button>
            </p>
HTML;
    }
    else if($this->lights->isSolveQuestion()){
        $present .= <<<HTML
<div class="question"><p><button class="solve_yes" name="solve_yes">Yes</button><button class="no" name="no">No</button></p></div>
<p>Are you sure you want to solve?</p>
HTML;
    }
    else {
        $present .= <<<HTML
            <p>
                <button class="check" name="check">Check Solution</button>
            </p>
            <p>
                <button class="solve" name="solve">Solve</button>
            <p> 
            <p>
                <button class="clear" name="clear">Clear</button>
            </p>
HTML;
    }
    $present .= <<<HTML
        </div>
    </form>
</div>
HTML;

    return $present;
    }

    /**
     * Creates the game table, including light, wrong, and clue tiles
     * @return string HTML
     */
    public function makeTable(){
        $game = $this->lights->getCurrent();
        $board = $game->getBoard();
        $table = "<table class='board'>";

        $wrong = [];
        if($this->lights->isCheck()){
            $wrong = $game->checkMoves();
        }
        $lighted = [];
        if($this->lights->isLighted()){
            $lighted = $game->getLighted();
        }
        $clues = [];
        if($this->lights->isClues()){
            $clues = $game->checkClues();
        }
        for($r=1; $r<=$game->getHeight(); $r++){
            $table .= "<tr>";
            for($c=1; $c<=$game->getWidth(); $c++){
                $cell = $board[$r][$c];
                if(is_numeric($cell)){
                    if(in_array($r . ',' . $c, $clues)){
                        $table .= "<td class='wall-complete'>$cell</td>";
                    }
                    else {
                        $table .= "<td class='wall'>$cell</td>";
                    }
                }
                else if($cell == $game::CLEAR){
                    if(in_array($r . ',' . $c, $lighted)){
                        $table .= "<td class='lit'><button name='cell' value='$r,$c'>&nbsp;</button></td>";
                    }
                    else {
                        $table .= "<td><button name='cell' value='$r,$c'>&nbsp;</button></td>";
                    }
                }
                else if($cell == $game::LIGHT){
                    if(in_array($r . ',' . $c, $wrong)){
                        $table .= "<td class='wrong'><button name='cell' value='$r,$c'>
                               <img src='light.png' width='43' height='75' alt='light'></button></td>";
                    }
                    else if(in_array($r . ',' . $c, $lighted)){
                        $table .= "<td class='lit'><button name='cell' value='$r,$c'>
                               <img src='light.png' width='43' height='75' alt='light'></button></td>";
                    }
                    else {
                        $table .= "<td><button name='cell' value='$r,$c'>
                                   <img src='light.png' width='43' height='75' alt='light'></button></td>";
                    }
                }
                else if($cell == $game::MARK){
                    if(in_array($r . ',' . $c, $wrong)){
                        $table .= "<td class='wrong'><button name='cell' value='$r,$c'>•</button></td>";
                    }
                    else if(in_array($r . ',' . $c, $lighted)){
                        $table .= "<td class='lit'><button name='cell' value='$r,$c'>•</button></td>";
                    }
                    else {
                        $table .= "<td value='$r,$c'><button name='cell' value='$r,$c'>•</button></td>";
                    }
                }
                else if($cell == null){
                    $table .= "<td class='wall'>&nbsp;</td>";
                }
            }
            $table .= "</tr>";
        }
        $table .= "</table>";

        return $table;
    }

    /**
     * Creates header
     * @return string|void HTML
     */
    public function present_header(){
        $name = $this->lights->getName();
        return <<<HTML
<header>
    <div class="hf">
        <p><img src="lightemup-800.png" width="800" height="140" alt="Light em up"></p>
        <nav><p><a href="./">NEW GAME</a> <a href="options.php">OPTIONS</a> <a href="instructions.php" target="_blank">INSTRUCTIONS</a></p></nav>
        <h1><em>Greetings, $name, and welcome to Light Em Up!</em></h1>
    </div>
</header>
HTML;
    }

}