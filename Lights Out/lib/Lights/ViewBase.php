<?php

namespace Lights;

class ViewBase{
    public function __construct(Lights $l){
        $this->lights = $l;
    }
    public function present(){
        return $this->present_header() .
            $this->present_body() .
            $this->present_footer();
    }
    public function present_header(){
        ;
    }
    public function present_body(){
        ;
    }
    public function present_footer(){
        return <<<HTML
<footer>
    <div class="hf">
        <p><img src="lightemup1-800.png" width="800" height="93" alt="Light em up"></p>
    </div>
</footer>
HTML;
    }

    protected $lights;
}