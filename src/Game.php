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
        $this->initWinSet();

        if(array_key_exists('reset',$_GET)) {
            session_destroy();
            $host = $_SERVER['HTTP_HOST'];
            $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';
            header("Location: $protocol$host", true, 301);
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
            if( ! array_key_exists('played_fields', $_SESSION) ) {
                $_SESSION['played_fields'] = [];
            }

        }
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
            $hit = false;
            if($_SESSION['played_fields']) {
                foreach($_SESSION['played_fields'] as $field) {
                    if($x == $field['x'] and $y == $field['y']) {
                        $hit = true;
                        break;
                    }
                }
            }
            if(!$hit) {
                $_SESSION['played_fields'][] = [
                    'x' => $x,
                    'y' => $y,
                    'player' => $_SESSION['player'],
                ];
            }
        }

        // TODO: $_SESSION['played_fields'] mit $this->>winSet vergleichen.

        $this->nextPlayer();
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
            [['x' => 1, 'y' => 1], ['x' => 1, 'y' => 2], ['x' => 1, 'y' => 3]],
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

}