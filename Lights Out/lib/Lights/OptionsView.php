<?php

namespace Lights;

class OptionsView extends ViewBase {
    /**
     * Creates body for the options page, changes if the tiles are lit or if clues are being shown
     * @return string|void HTML
     */
    public function present_body(){
        $present = <<<HTML
<div class="index">
    <form method="post" action="options-post.php">
HTML;
        if($this->lights->isLighted()){
            $present .= "<p><input type=\"checkbox\" name=\"lighted\" id=\"lighted\" checked='checked'><label for=\"lighted\">Show lighted squares</label></p>";
        }
        else{
            $present .= "<p><input type=\"checkbox\" name=\"lighted\" id=\"lighted\"><label for=\"lighted\">Show lighted squares</label></p>";
        }
        if($this->lights->isClues()){
            $present .= "<p><input type=\"checkbox\" name=\"hints\" id=\"hints\" checked='checked'><label for=\"hints\">Show completed clues</label></p>";
        }
        else{
            $present .= "<p><input type=\"checkbox\" name=\"hints\" id=\"hints\"><label for=\"hints\">Show completed clues</label></p>";
        }
        $present .= <<<HTML
        <p><input type="submit" name="submit" value="Submit"></p>
    </form>
</div>
HTML;
        return $present;
    }

    /**
     * Creates header
     * @return string|void HTML
     */
    public function present_header(){
        return <<<HTML
<header>
    <div class="hf">
        <p><img src="lightemup-800.png" width="800" height="140" alt="Light em up"></p>
        <nav><p><a href="./">NEW GAME</a> <a href="game.php">RETURN TO GAME</a></p></nav>
        <h1>Light Em Up! Options</h1>
    </div>
</header>
HTML;
    }

}