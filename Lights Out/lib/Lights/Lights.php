<?php


namespace Lights;


class Lights{
    /**
     * Lights constructor.  Creates game classes for all the games available and keeps track of the current running game
     * @param string $dir directory with the games folder
     */
    public function __construct($dir = __DIR__ . '/../..'){
        $this->load($dir);
    }

    /**
     * Sets the current game
     * @param $file game file
     */
    public function setGame($file){
        $this->current = $this->games[$file];
    }

    /**
     * Sets the name
     * @param $n name
     */
    public function setName($n){
        $this->name = $n;
    }

    /**
     * @return string stored name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param bool $got_name is there a name?
     */
    public function setGotName($got_name)
    {
        $this->got_name = $got_name;
    }

    /**
     * @return bool is there a name set?
     */
    public function isGotName()
    {
        return $this->got_name;
    }

    /**
     * @return Game returns current game
     */
    public function getCurrent()
    {
        return $this->current;
    }

    /**
     * @param bool $clearQuestion sets if board is to be cleared
     */
    public function setClearQuestion($clearQuestion)
    {
        $this->clearQuestion = $clearQuestion;
    }

    /**
     * @return bool checks if board is to be cleared
     */
    public function isClearQuestion()
    {
        return $this->clearQuestion;
    }

    /**
     * @param bool $solveQuestion sets if board is to be solved
     */
    public function setSolveQuestion($solveQuestion)
    {
        $this->solveQuestion = $solveQuestion;
    }

    /**
     * @return bool checks if board is to be solved
     */
    public function isSolveQuestion()
    {
        return $this->solveQuestion;
    }

    /**
     * @param bool $check sets check to true or false
     */
    public function setCheck($check)
    {
        $this->check = $check;
    }

    /**
     * @param bool $lighted sets if the game is in lighted mode
     */
    public function setLighted($lighted)
    {
        $this->lighted = $lighted;
    }

    /**
     * @return bool checks if the game is lighted
     */
    public function isLighted()
    {
        return $this->lighted;
    }

    /**
     * @param bool $clues toggles clues completion
     */
    public function setClues($clues)
    {
        $this->clues = $clues;
    }

    /**
     * @return bool checks if clue completion
     */
    public function isClues()
    {
        return $this->clues;
    }

    /**
     * @return bool checks if check is true or false
     */
    public function isCheck()
    {
        return $this->check;
    }

    /**
     * Load the games from disk.
     * @param string $dir Root directory for the site.
     */
    private function load($dir) {
        $this->games = [];

        $files = scandir($dir . '/games');
        foreach($files as $file) {
            $len = strlen($file);
            if(substr($file, $len-5) === '.json') {
                // We have found a file!
                $this->games[$file] = new Game($this, $dir . '/games/', $file);
            }
        }
    }

    private $clearQuestion = false;
    private $solveQuestion = false;
    private $lighted = false;
    private $clues = false;
    private $check = false;
    private $current = null;
    private $games;
    private $got_name = true;
    private $name;
}