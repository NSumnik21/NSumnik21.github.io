<?php

namespace Lights;

use phpDocumentor\Reflection\Types\This;

class Game{
    const CLEAR = 'e';
    const MARK = 'm';
    const LIGHT = 'l';

    /**
     * Game constructor.  Game class keeps track of a single game from a .json file
     * @param $lights lights class
     * @param $dir string directory of the games
     * @param $file string game file
     */
    public function __construct($lights, $dir, $file){
        $this->lights = $lights;
        $this->file = $file;

        $json = file_get_contents($dir . $file);
        $data = json_decode($json, true);

        $this->title = $data['title'];
        $this->width = $data['width'];
        $this->height = $data['height'];
        for($r=1; $r<=$this->height; $r++){
            $this->board[$r] = [];
            $this->sol[$r] = [];
            for($c=1; $c<=$this->width; $c++){
                $this->board[$r][$c] = self::CLEAR;
                $this->sol[$r][$c] = self::MARK;
            }
        }

        foreach($data['walls'] as $wall) {
            $row = $wall['row'];
            $col = $wall['col'];
            $value = $wall['value'];
            $this->board[$row][$col] = $value;
            $this->sol[$row][$col] = $value;
        }
        foreach($data['lights'] as $light) {
            $row = $light['row'];
            $col = $light['col'];
            $this->sol[$row][$col] = self::LIGHT;
        }
    }

    /**
     * Sets the game board to a clear state (removes all lights and marks)
     */
    public function clear(){
        for($r=1; $r<=$this->height; $r++){
            for($c=1; $c<=$this->width; $c++) {
                if(!is_numeric($this->board[$r][$c]) && $this->board[$r][$c] != null){
                    $this->board[$r][$c] = self::CLEAR;
                }
            }
        }
    }

    /**
     * Simulates a click at the given row and column
     * @param $r int row
     * @param $c int col
     */
    public function click($r, $c){
        if(!array_key_exists($r, $this->board)){
            return;
        }
        if(!array_key_exists($c, $this->board[$r])){
            return;
        }

        $val = $this->board[$r][$c];
        if($val == self::CLEAR){
            $this->board[$r][$c] = self::LIGHT;
        }
        else if($val == self::LIGHT){
            $this->board[$r][$c] = self::MARK;
        }
        else if($val == self::MARK){
            $this->board[$r][$c] = self::CLEAR;
        }
    }

    /**
     * Checks if the game is completed, checks to the solution stored but doesn't check marks, only lights
     * @return bool is the game done
     */
    public function checkDone(){
        for($r=1; $r<=$this->height; $r++){
            for($c=1; $c<=$this->width; $c++) {
                if($this->sol[$r][$c] == self::LIGHT){
                    if($this->board[$r][$c] != self::LIGHT){
                        return false;
                    }
                }
            }
        }
        return true;
    }

    /**
     * Checks all the current made moves on the board, keeps track of the wrong moves
     * @return array array of indexes of wrong moves
     */
    public function checkMoves(){
        $wrong = [];
        for($r=1; $r<=$this->height; $r++){
            for($c=1; $c<=$this->width; $c++){
                if($this->board[$r][$c] == self::MARK || $this->board[$r][$c] == self::LIGHT){
                    if($this->board[$r][$c] != $this->sol[$r][$c]){
                        $wrong[] = $r . ',' . $c;
                    }
                }
            }
        }
        return $wrong;
    }

    /**
     * Checks to see what clues have been completed on the board
     * @return array indexes of completed clues
     */
    public function checkClues(){
        $complete = [];
        for($r=1; $r<=$this->height; $r++){
            for($c=1; $c<=$this->width; $c++){
                $count = 0;
                if(is_numeric($this->board[$r][$c])){
                    if($r - 1 > 0 && $this->board[$r-1][$c] == self::LIGHT){
                        $count++;
                    }
                    if($c + 1 <= $this->width && $this->board[$r][$c+1] == self::LIGHT){
                        $count++;
                    }
                    if($r + 1 <= $this->height && $this->board[$r+1][$c] == self::LIGHT){
                        $count++;
                    }
                    if($c - 1 > 0 && $this->board[$r][$c-1] == self::LIGHT){
                        $count++;
                    }
                    if($count == $this->board[$r][$c]){
                        $complete[] = $r . ',' . $c;
                    }
                }
            }
        }
        return $complete;
    }

    /**
     * Finds all tiles that have been lit by placed lights
     * @return array indexes of lit tiles
     */
    public function getLighted(){
        $lighted = [];
        for($r=1; $r<=$this->height; $r++){
            for($c=1; $c<=$this->width; $c++){
                if($this->board[$r][$c] == self::LIGHT && !is_numeric($this->board[$r][$c])){
                    for($i=0; $i + $r<=$this->width; $i++){
                        if(is_numeric($this->board[$r+$i][$c]) || $this->board[$r+$i][$c] == null){
                            break;
                        }
                        $lighted[] = ($r + $i) . ',' . $c;
                    }
                    for($i=1; $r - $i>0; $i++){
                        if(is_numeric($this->board[$r-$i][$c]) || $this->board[$r-$i][$c] == null){
                            break;
                        }
                        $lighted[] = ($r - $i) . ',' . $c;
                    }
                    for($i=1; $i + $c<=$this->height; $i++){
                        if(is_numeric($this->board[$r][$c+$i]) || $this->board[$r][$c+$i] == null){
                            break;
                        }
                        $lighted[] = $r . ',' . ($c + $i);
                    }
                    for($i=1; $c - $i>0; $i++){
                        if(is_numeric($this->board[$r][$c-$i]) || $this->board[$r][$c-$i] == null){
                            break;
                        }
                        $lighted[] = $r . ',' . ($c - $i);
                    }
                }
            }
        }
        return $lighted;
    }

    /**
     * Solves the board
     */
    public function solve(){
        $this->board = $this->sol;
    }

    /**
     * @return array returns solution
     */
    public function getSol()
    {
        return $this->sol;
    }

    /**
     * @return array returns current board
     */
    public function getBoard()
    {
        return $this->board;
    }

    /**
     * @return int gets width
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return int gets height
     */
    public function getHeight()
    {
        return $this->height;
    }

    private $lights;
    private $file;
    private $title;
    private $width;
    private $height;
    private $board = [];
    private $sol = [];
}