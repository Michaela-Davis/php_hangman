<?php
    class Hang {

        private $guess;
        private $guessAgain;
        private $previousGuess;
        private $answer;
        private $answerArray;
        private $remainingGuesses;
        private $imageState;

        function __construct($guess, $guessAgain, $previousGuess, $answer, $answerArray, $remainingGuesses, $imageState) {
            $this->guess = $guess;
            $this->guessAgain = $guessAgain;
            $this->previousGuess = $previousGuess;
            $this->answer = $answer;
            $this->answerArray = $answerArray;
            $this->remainingGuesses = $remainingGuesses;
            $this->imageState = $imageState;
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

        function getImageState(){
            return $this->imageState;
        }

        function setImageState($imageState){
            $this->imageState = $imageState;
        }


        function save(){
            $_SESSION['hang']= array($this);
        }

        static function submitGuess($guess)
        {
            $_SESSION['hang'][0]->setGuess($guess);
            $guessedBefore = array_search($guess, array_values($_SESSION['hang'][0]->getPreviousGuess()));
            if(strlen($guessedBefore) === 0){
                $answerValue = strpos($_SESSION["hang"][0]->getAnswer(),$guess);
                if(strlen($answerValue)===0){
                    //not in the answer
                    $remaining = $_SESSION['hang'][0]->getRemainingGuesses();
                    $remaining = $remaining -1;
                    $_SESSION['hang'][0]->setRemainingGuesses($remaining);
                    $prevArray = $_SESSION['hang'][0]->getPreviousGuess();
                    array_push($prevArray,$guess);
                    $_SESSION['hang'][0]->setPreviousGuess($prevArray);
                    $imageNumber = $_SESSION['hang'][0]->getImageState();
                    $imageNumber = $imageNumber +1;
                    $_SESSION['hang'][0]->setImageState($imageNumber);
                } else {
                    //replace guess in answer array location
                }
                $_SESSION['hang'][0]->setGuessAgain("true");
            } else{
                $_SESSION['hang'][0]->setGuessAgain("false");

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
