<?php
$Game = new TTT();

final class TTT
{
// Members
    private $WelcomeMessage = "Welcome to Tic-Tac-Toe \n";
    private $NewGameStartedMessage = "----- New Game Started ---- \n";
    private $PlayerOneGetRowMessage = "Player 1 (X) - Enter Row Number: ";
    private $PlayerOneColumnMessage = "Player 1 (X) - Enter Column Number: ";
    private $PlayerTwoGetRowMessage = "Player 2 (0) - Enter Row Number: ";
    private $PlayerTwoColumnMessage = "Player 2 (0) - Enter Column Number: ";

    private $PlayerOneWon = "Player 1 has WON!\n";
    private $PlayerTwoWon = "Player 2 has WON!\n";

    private $InvalidMove = "Invalid Move \n";

    private $GameBoard = array(array('-', '-', '-'),
                               array('-', '-', '-'),
                               array('-', '-', '-'));


    private $turn = 0; //0 will be Player 1, 1 will be Player 2
    private $GameWon = false;
    private $Winner = 9;
// Methods
    final public function __construct()
    {
        $this->Start();
    }

    final public function __destruct()
    {
        $Game = new TTT();
    }

    private function Start() {
        echo $this->WelcomeMessage . PHP_EOL;
        echo $this->NewGameStartedMessage . PHP_EOL;
        $this->PrintGameBoard();
        $this->GameLoop();
    }

    private function PrintGameBoard() {
        for($i = 0; $i < 3; $i++)
        {
            for($j = 0; $j < 3; $j++)
            {
                echo $this->GameBoard[$i][$j] . " ";
            }
            echo "\n";
        }
    }

    private function GameLoop() {
        while(!$this->GameWon)
        {
            $this->PlayerMove();
            $this->PrintGameBoard();
            $this->CheckWin();
        }
    }

    private function PlayerMove() {
        if($this->turn == 0) { //Player 1
            $row = (int)readline($this->PlayerOneGetRowMessage);
            $column = (int)readline($this->PlayerOneColumnMessage);
            if($this->isMoveGood($row, $column)) { $this->GameBoard[$row-1][$column-1] = 'X'; }
            else { $this->PlayerMove(); }
            $this->turn = 1; //Switch turns

        }
        else { //Player 2
            $row = (int)readline($this->PlayerTwoGetRowMessage);
            $column = (int)readline($this->PlayerTwoColumnMessage);
            if($this->isMoveGood($row, $column)) { $this->GameBoard[$row-1][$column-1] = 'O'; }
            else { $this->PlayerMove(); }
            $this->turn = 0; //Switch turns
        }
    }

    private function isMoveGood($row, $column) {
        if(($row >= 1) && ($row <= 3)) {
            if(($column >= 1) && ($column <= 3)) {
                if($this->GameBoard[$row-1][$column-1] == '-') { return true; }
                else { echo $this->InvalidMove; return false;}
            }
            else { echo $this->InvalidMove; return false;}
        }
        else { echo $this->InvalidMove; return false;}
    }

    private function CheckWin()
    {
        //Rows
        if($this->GameBoard[0][0] == 'X' && $this->GameBoard[0][1] == 'X' && $this->GameBoard[0][2] == 'X'){$this->GameWon = true; $this->Winner = 0;}
        else if($this->GameBoard[1][0] == 'X' && $this->GameBoard[1][1] == 'X' && $this->GameBoard[1][2] == 'X'){$this->GameWon = true; $this->Winner = 0;}
        else if($this->GameBoard[2][0] == 'X' && $this->GameBoard[2][1] == 'X' && $this->GameBoard[2][2] == 'X'){$this->GameWon = true; $this->Winner = 0;}

        else if($this->GameBoard[0][0] == 'O' && $this->GameBoard[0][1] == 'O' && $this->GameBoard[0][2] == 'O'){$this->GameWon = true; $this->Winner = 1;}
        else if($this->GameBoard[1][0] == 'O' && $this->GameBoard[1][1] == 'O' && $this->GameBoard[1][2] == 'O'){$this->GameWon = true; $this->Winner = 1;}
        else if($this->GameBoard[2][0] == 'O' && $this->GameBoard[2][1] == 'O' && $this->GameBoard[2][2] == 'O'){$this->GameWon = true; $this->Winner = 1;}

        //Columns
        else if($this->GameBoard[0][0] == 'X' && $this->GameBoard[1][0] == 'X' && $this->GameBoard[2][0] == 'X'){$this->GameWon = true; $this->Winner = 0;}
        else if($this->GameBoard[0][1] == 'X' && $this->GameBoard[1][1] == 'X' && $this->GameBoard[2][1] == 'X'){$this->GameWon = true; $this->Winner = 0;}
        else if($this->GameBoard[0][2] == 'X' && $this->GameBoard[1][2] == 'X' && $this->GameBoard[2][2] == 'X'){$this->GameWon = true; $this->Winner = 0;}

        else if($this->GameBoard[0][0] == 'O' && $this->GameBoard[1][0] == 'O' && $this->GameBoard[2][0] == 'O'){$this->GameWon = true; $this->Winner = 1;}
        else if($this->GameBoard[0][1] == 'O' && $this->GameBoard[1][1] == 'O' && $this->GameBoard[2][1] == 'O'){$this->GameWon = true; $this->Winner = 1;}
        else if($this->GameBoard[0][2] == 'O' && $this->GameBoard[1][2] == 'O' && $this->GameBoard[2][2] == 'O'){$this->GameWon = true; $this->Winner = 1;}

        //Crosses
        else if($this->GameBoard[0][0] == 'X' && $this->GameBoard[1][1] == 'X' && $this->GameBoard[2][2] == 'X'){$this->GameWon = true; $this->Winner = 0;}
        else if($this->GameBoard[0][0] == 'O' && $this->GameBoard[1][1] == 'O' && $this->GameBoard[2][2] == 'O'){$this->GameWon = true; $this->Winner = 1;}

        else if($this->GameBoard[0][2] == 'X' && $this->GameBoard[1][1] == 'X' && $this->GameBoard[3][0] == 'X'){$this->GameWon = true; $this->Winner = 0;}
        else if($this->GameBoard[0][2] == 'O' && $this->GameBoard[1][1] == 'O' && $this->GameBoard[3][0] == 'O'){$this->GameWon = true; $this->Winner = 1;}

        if($this->GameWon == true) {
            if($this->Winner == 0)
            {
                echo $this->PlayerOneWon;
            }
            else if($this->Winner == 1) {
                echo $this->PlayerTwoWon;
            }
            sleep(2);
        }
    }
}
