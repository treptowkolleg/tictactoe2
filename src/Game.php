<?php

namespace Btinet\Tictactoe;


class Game
{

    private string $baseTemplate = TEMPLATES . 'index.html.php';
    private array $winSet;

    public function __construct()
    {
        $this->init();
        $this->makeTurn();

        if(array_key_exists('reset',$_GET)) {
            $this->resetGame();
        }

        $content = TEMPLATES . 'gameboard.html.php';
        include $this->baseTemplate;
    }

    private function init()
    {
        // Wenn Session nicht gestartet ist, Session starten.
        if(session_status() != PHP_SESSION_ACTIVE) {
            session_start();

            // Wenn Spieler nicht gesetzt, Spieler 'Kreis' setzen.
            if( ! array_key_exists('player', $_SESSION) ) {
                $_SESSION['player'] = 'Kreis';
            }
            if( ! array_key_exists('winner', $_SESSION) ) {
                $_SESSION['winner'] = null;
            }
            if( ! array_key_exists('played_fields', $_SESSION) ) {
                $_SESSION['played_fields'] = [];
            }

        }
        $this->initWinSet();
    }

    /**
     * Diese Methode wechselt den <b>aktuellen</b> Spieler.
     * @return void
     */
    private function makeTurn()
    {
        $x = $_GET['x'] ?? null;
        $y = $_GET['y'] ?? null;

        if($x != null and $y != null) {
            if ($_SESSION['winner'] != null) {
                unset($_SESSION['winner']);
            }
            $hit = false;
            if ($_SESSION['played_fields']) {
                foreach ($_SESSION['played_fields'] as $field) {
                    if ($x == $field['x'] and $y == $field['y']) {
                        $hit = true;
                        break;
                    }
                }
            }
            if (!$hit) {
                $_SESSION['played_fields'][] = [
                    'x' => $x,
                    'y' => $y,
                    'player' => $_SESSION['player'],
                ];

                // TODO: $_SESSION['played_fields'] mit $this->>winSet vergleichen.
                $winner = $this->checkForWinner();

                switch ($winner) {
                    case 'Kreis':
                        $this->endGameWithWinner('Kreis');
                        break;
                    case 'Kreuz':
                        $this->endGameWithWinner('Kreuz');
                        break;
                    default:
                        $this->nextPlayer();
                }

            }

        }

    }

    private function nextPlayer()
    {
        if( $_SESSION['player'] == 'Kreis' ) {
            $_SESSION['player'] = 'Kreuz';
        } else {
            $_SESSION['player'] = 'Kreis';
        }
    }

    private function initWinSet()
    {
        $this->winSet = [
            // Vertikal
            [
                ['x' => 1, 'y' => 1],
                ['x' => 1, 'y' => 2],
                ['x' => 1, 'y' => 3]
            ],



            [['x' => 2, 'y' => 1], ['x' => 2, 'y' => 2], ['x' => 2, 'y' => 3]],
            [['x' => 3, 'y' => 1], ['x' => 3, 'y' => 2], ['x' => 3, 'y' => 3]],
            // Horizontal
            [['x' => 1, 'y' => 1], ['x' => 2, 'y' => 1], ['x' => 3, 'y' => 1]],
            [['x' => 1, 'y' => 2], ['x' => 2, 'y' => 2], ['x' => 3, 'y' => 2]],
            [['x' => 1, 'y' => 3], ['x' => 2, 'y' => 3], ['x' => 3, 'y' => 3]],
            // Diagonal
            [['x' => 1, 'y' => 1], ['x' => 2, 'y' => 2], ['x' => 3, 'y' => 3]],
            [['x' => 1, 'y' => 3], ['x' => 2, 'y' => 2], ['x' => 3, 'y' => 1]],
        ];
    }

    private function checkForWinner()
    {

        foreach($this->winSet as $row) {

            $hitsKreis = 0;
            $hitsKreuz = 0;

            foreach($row as $col) {
                foreach($_SESSION['played_fields'] as $playedField) {

                    if($playedField['player'] == 'Kreis') {

                        if($playedField['x'] == $col['x'] & $playedField['y'] == $col['y']) {
                            $hitsKreis++;
                        }
                    }

                    if($playedField['player'] == 'Kreuz') {

                        if($playedField['x'] == $col['x'] & $playedField['y'] == $col['y']) {
                            $hitsKreuz++;
                        }
                    }

                    if($hitsKreis == 3) return $_SESSION['Kreis'];
                    if($hitsKreuz == 3) return $_SESSION['Kreuz'];

                }
            }
        }
        return null;
    }

    private function endGameWithWinner($winner)
    {
        // Nur eine Runde
        //$_SESSION['winner'] = $winner;

        // mehrere Runden
        $_SESSION['winner'] = $winner;

        $this->resetGame();
    }

    private function resetGame()
    {
        unset($_SESSION['player']);
        unset($_SESSION['played_fields']);
        $host = $_SERVER['HTTP_HOST'];
        $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';
        header("Location: $protocol$host", true, 301);
    }

}