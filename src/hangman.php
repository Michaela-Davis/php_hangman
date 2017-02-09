<?php
    class Hang {

        private $guess;
        private $guessAgain;
        private $previousGuess;
        private $answer;
        private $answerArray;
        private $remainingGuesses;

        function __construct($guess, $guessAgain, $previousGuess, $answer, $answerArray, $remainingGuesses) {
            $this->guess = $guess;
            $this->guessAgain = $guessAgain;
            $this->previousGuess = $previousGuess;
            $this->answer = $answer;
            $this->answerArray = $answerArray;
            $this->remainingGuesses = $remainingGuesses;
        }

        function getGuess(){
            return $this->guess;
        }

        function setGuess($guess){
            $this->guess = (string) $guess;
        }

        function getGuessAgain(){
            return $this->guessAgain;
        }

        function setGuessAgain($guessAgain){
            $this->guessAgain = (string) $guessAgain;
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

        function getAnswerArray(){
            return $this->answerArray;
        }

        function setAnswerArray(){
            $this->answerArray = $answerArray;
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

        static function submitGuess($guess)
        {
            $_SESSION['hang'][0]->setGuess($guess);
            $guessedBefore = array_search($guess, $searchArray = array_values($_SESSION['hang'][0]->getPreviousGuess()));
            if($guessedBefore === ""){
                $_SESSION['hang'][0]->setGuessAgain("empty");
            }else{
                $_SESSION['hang'][0]->setGuessAgain("broken");

            }
            return $_SESSION['hang'];
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
