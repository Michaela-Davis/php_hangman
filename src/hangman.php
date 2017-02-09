<?php
    class Hang {

        private $guess;
        private $winCheck;
        private $loseCheck;
        private $previousGuess;
        private $answer;
        private $answerArray;
        private $remainingGuesses;
        private $imageState;
        private $message;

        function __construct($guess, $winCheck, $loseCheck, $previousGuess, $answer, $answerArray, $remainingGuesses, $imageState, $message) {
            $this->guess = $guess;
            $this->winCheck = $winCheck;
            $this->loseCheck = $loseCheck;
            $this->previousGuess = $previousGuess;
            $this->answer = $answer;
            $this->answerArray = $answerArray;
            $this->remainingGuesses = $remainingGuesses;
            $this->imageState = $imageState;
            $this->message = $message;
        }

        function getGuess(){
            return $this->guess;
        }

        function setGuess($guess){
            $this->guess = (string) $guess;
        }

        function getWinCheck(){
            return $this->winCheck;
        }

        function setWinCheck($winCheck){
            $this->winCheck = $winCheck;
        }

        function getLoseCheck(){
            return $this->loseCheck;
        }

        function setLoseCheck($loseCheck){
            $this->loseCheck = $loseCheck;
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

        function setAnswerArray($answerArray){
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

        function getMessage(){
            return $this->message;
        }

        function setMessage($message){
            $this->message = $message;
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
                    $_SESSION['hang'][0]->setMessage("That was a wrong letter");

                    if ($_SESSION['hang'][0]->getRemainingGuesses() === 0) {
                        $_SESSION['hang'][0]->setLoseCheck("true");
                        $_SESSION['hang'][0]->setMessage("You lost...");
                    }

                } else {
                    $correctAnswer = $_SESSION['hang'][0]->getAnswerArray();
                    array_splice($correctAnswer, $answerValue, 1, $guess);
                    $_SESSION['hang'][0]->setAnswerArray($correctAnswer);

                    $winCheck = join("", $correctAnswer);
                    if ($winCheck === $_SESSION['hang'][0]->getAnswer()) {
                        $_SESSION['hang'][0]->setWinCheck("true");
                        $_SESSION['hang'][0]->setMessage("You won!");
                    } else {
                        $_SESSION['hang'][0]->setMessage("That was a correct letter");
                    }
                }

            } else {
                $_SESSION['hang'][0]->setMessage("You have already entered that letter");

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
