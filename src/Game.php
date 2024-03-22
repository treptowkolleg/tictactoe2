<?php

namespace Btinet\Tictactoe;

class Game
{

    private string $baseTemplate = TEMPLATES . 'index.html.php';

    public function __construct()
    {
        $content = TEMPLATES . 'gameboard.html.php';
        include $this->baseTemplate;
    }

}