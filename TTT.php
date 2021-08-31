<?php
$Game = new TTT();
final class TTT
{
    private $WelcomeMessage = "Welcome to Tic-Tac-Toe \n";
    private $PlayVSBot = "Would you like to play the bot? (1)Yes (2)No : \n";
    private $NewGameStartedMessage = "----- New Game Started ---- \n";
    private $PlayerOneGetRowMessage = "Player 1 (X) - Enter Row Number: ";
    private $PlayerOneColumnMessage = "Player 1 (X) - Enter Column Number: ";
    private $PlayerTwoGetRowMessage = "Player 2 (0) - Enter Row Number: ";
    private $PlayerTwoColumnMessage = "Player 2 (0) - Enter Column Number: ";

    private $PlayerOneWon = "Player 1 has WON!\n";
    private $PlayerTwoWon = "Player 2 has WON!\n";
    private $ComputerWon = "Computer has WON!\n";

    private $InvalidMove = "Invalid Move \n";

    private $GameBoard = array(array('-', '-', '-'),
                               array('-', '-', '-'),
                               array('-', '-', '-'));

    private $turn = 0; //0 will be Player 1, 1 will be Player 2
    private $GameWon = false;
    private $Winner = 9;

    private $player = 'O'; private $opponent = 'X';
    private $isBot = 0;

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
        $this->isBot = (int)readline($this->PlayVSBot);
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
            if($this->isBot != 1)
            {
                $row = (int)readline($this->PlayerTwoGetRowMessage);
                $column = (int)readline($this->PlayerTwoColumnMessage);
                if($this->isMoveGood($row, $column)) { $this->GameBoard[$row-1][$column-1] = 'O'; }
                else { $this->PlayerMove(); }
            }
            else if($this->isBot == 1)
            {
                $this->findBestMove();
            }
            $this->turn = 0; //Switch turns
        }
    }
    private function isMoveGood($row, $column) {
        if($row == 9 || $column == 9) die;
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

        else if($this->GameBoard[2][0] == 'X' && $this->GameBoard[1][1] == 'X' && $this->GameBoard[0][3] == 'X'){$this->GameWon = true; $this->Winner = 0;}
        else if($this->GameBoard[2][0] == 'O' && $this->GameBoard[1][1] == 'O' && $this->GameBoard[0][3] == 'O'){$this->GameWon = true; $this->Winner = 1;}

        if($this->GameWon == true) {
            if($this->isBot = 1)
            {
                echo $this->ComputerWon;
            }
            else if($this->Winner == 0)
            {
                echo $this->PlayerOneWon;
            }
            else if($this->Winner == 1) {
                echo $this->PlayerTwoWon;
            }
        }
    }
    private function findBestMove() {
        $bestVal = -1000;
        $row = -1;
        $col = -1;
    // Traverse all cells, evaluate minimax function
    // for all empty cells. And return the cell
    // with optimal value.
    for ($i = 0; $i < 3; $i++)
    {
        for ($j = 0; $j < 3; $j++)
        {
            // Check if cell is empty
            if ($this->GameBoard[$i][$j] == '-')
            {
                // Make the move
                $this->GameBoard[$i][$j] = 'O';

                // compute evaluation function for this
                // move.
                $moveVal = $this->minimax(0, false);
                // Undo the move
                $this->GameBoard[$i][$j] = '-';

                // If the value of the current move is
                // more than the best value, then update
                // best/
                if ($moveVal > $bestVal)
                {
                    $row = $i;
                    $col = $j;
                    $bestVal = $moveVal;
                }
            }
        }
    }
        $this->GameBoard[$row][$col] = 'O';
        echo "Computer moves {$row},{$col}\n";
    }
    private function minimax($depth, $isMax)
    {
        $score = $this->evaluate();

    // If Maximizer has won the game
    // return his/her evaluated score
    if ($score == 10)
        return $score;

    // If Minimizer has won the game
    // return his/her evaluated score
    if ($score == -10)
        return $score;

    // If there are no more moves and
    // no winner then it is a tie
    if ($this->isMovesLeft() == false)
        return 0;

    // If this maximizer's move
    if ($isMax)
    {
        $best = -1000;
        // Traverse all cells
        for ($i = 0; $i < 3; $i++)
        {
            for ($j = 0; $j < 3; $j++)
            {
                // Check if cell is empty
                if ($this->GameBoard[$i][$j] == '-')
                {
                    // Make the move
                    $this->GameBoard[$i][$j] = $this->player;

                    // Call minimax recursively and choose
                    // the maximum value
                    $best = Math.Max($best, $this->minimax($depth + 1, !$isMax));

                    // Undo the move
                    $this->GameBoard[$i][$j] = '-';
                }
            }
        }
        return best;
    }

    // If this minimizer's move
    else
    {
        $best = 1000;
        // Traverse all cells
        for ($i = 0; $i < 3; $i++)
        {
            for ($j = 0; $j < 3; $j++)
            {
                // Check if cell is empty
                if ($this->GameBoard[$i][$j] == '-')
                {
                    // Make the move
                    $this->GameBoard[$i][$j] = $this->opponent;

                    // Call minimax recursively and choose
                    // the minimum value
                    $best = Math.Min($best, $this->minimax($depth + 1, !$isMax));
                    // Undo the move
                    $this->GameBoard[$i][$j] = '-';
                }
            }
        }
        return $best;
    }
}
    private function evaluate() {
        // Checking for Rows for X or O victory.
        for($row = 0; $row < 3; $row++)
        {
            if($this->GameBoard[$row][0] == $this->GameBoard[$row][1] && $this->GameBoard[$row][1] == $this->GameBoard[$row][2])
            {
            if ($this->GameBoard[$row][0] == $this->player)
                return +10;
            else if ($this->GameBoard[$row][0] == $this->opponent)
                return -10;
            }
        }

        // Checking for Columns for X or O victory.
        for ($col = 0; $col < 3; $col++)
        {
            if ($this->GameBoard[0][$col] == $this->GameBoard[1][$col] && $this->GameBoard[1][$col] == $this->GameBoard[2][$col])
            {
                if ($this->GameBoard[0][$col] == $this->player)
                    return +10;

                else if ($this->GameBoard[0][$col] == $this->opponent)
                    return -10;
            }
        }

        // Checking for Diagonals for X or O victory.
        if ($this->GameBoard[0][0] == $this->GameBoard[1][1] && $this->GameBoard[1][1] == $this->GameBoard[2][2])
        {
            if ($this->GameBoard[0][0] == $this->player)
                return +10;
            else if ($this->GameBoard[0][0] == $this->opponent)
                return -10;
        }

    if ($this->GameBoard[0][2] == $this->GameBoard[1][1] && $this->GameBoard[1][1] == $this->GameBoard[2][0])
    {
        if ($this->GameBoard[0][2] == $this->player)
            return +10;
        else if ($this->GameBoard[0][2] == $this->opponent)
            return -10;
    }

    // Else if none of them have won then return 0

    return 0;
    }
    private function isMovesLeft() {
        for ($i = 0; $i < 3; $i++)
        {
            for ($j = 0; $j < 3; $j++)
            {
                if ($this->GameBoard[$i][$j] == '-') { return true; }
            }
        }
        return false;
    }
}