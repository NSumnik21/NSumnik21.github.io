<?php

namespace Lights;

class IndexView extends ViewBase {
    /**
     * Creates the body for the index page, changes if there is no name entered
     * @return string|void HTML
     */
    public function present_body(){
        $name = $this->lights->getName();
        $present = <<<HTML
<div class="index">
    <form method="post" action="index-post.php">
        <p><label for="name">Name</label></p>
HTML;
        if($name){
            $present .= "<p><input type='text' name='name' id='name' value='$name'></p>";
        }
        else{
            $present .= "<p><input type='text' name='name' id='name' value='Player'></p>";
        }
        $present .= <<<HTML
        <select name="difficulty" id="difficulty">
            <option>10x10 Easy</option>
            <option>5x5 Easy</option>
            <option>5x5 Hard</option>
            <option>7x7 Easy</option>
            <option>7x7 Medium</option>
        </select>
        <p><input type="submit" name="start" value="Start or Continue Game"></p>
HTML;
        if(!$this->lights->isGotName()){
            $present .= "<p>You must enter a name!</p>";
        }
        $present .= <<<HTML
    </form>
</div>
HTML;
        return $present;
    }

    /**
     * Creates header
     * @return string|void HTML
     */
    public function present_header()
    {
        return <<<HTML
<header>
    <div class="hf">
        <p><img src="lightemup-800.png" width="800" height="140" alt="Light em up"></p>
        <nav><p><a href="instructions.php">INSTRUCTIONS</a></p></nav>
        <h1><em>Welcome to Nikolas Sumnik's Light Em Up!</em></h1>
    </div>
</header>
HTML;
    }

}