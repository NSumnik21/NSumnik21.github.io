<?php

namespace Lights;

class ControllerBase{
    /**
     * gets the redirect page
     * @return string page
     */
    public function getRedirect(){
        return $this->redirect;
    }

    /**
     * Debug option to display the redirect page instead of redirecting to it.
     * @return string HTML
     */
    public function showRedirect() {
        return "<p><a href=\"$this->redirect\">$this->redirect</a>";
    }

    /**
     * @return null
     */
    public function getResult()
    {
        return $this->result;
    }


    protected $lights;
    protected $redirect;
    protected $result = null;
}