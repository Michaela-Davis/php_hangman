<?php
    class Hang {

        private $guess;
        private $previousGuess;
        private $answer;
        private $remainingGuesses;

        function __construct($guess, $previousGuess, $answer, $remainingGuesses) {
            $this->guess = $guess;
            $this->previousGuess = $previousGuess;
            $this->answer = $answer;
            $this->remainingGuesses = $remainingGuesses;
        }

        function getGuess(){
            return $this->guess;
        }

        function setGuess($guess){
            $this->guess = (string) $guess;
        }

        function getPreviousGuess(){
            return $this->previousGuess;
        }

        function setPreviousGuess($previousGuess){
            $this->previousGuess = $previousGuess;
        }

        function getAnswer(){
            return $this->answer;
        }

        function setAnswer($answer){
            $this->answer = (string) $answer;
        }

        function getRemainingGuesses(){
            return $this->remainingGuesses;
        }

        function setRemainingGuesses($remainingGuesses){
            $this->remainingGuesses = $remainingGuesses;
        }



        function save(){
            $_SESSION['hang']= array($this);
        }

        static function getAll()
        {
            return $_SESSION['hang'];
        }

        static function deleteAll()
        {
            $_SESSION['hang'] = array();
        }
    }

 ?>
