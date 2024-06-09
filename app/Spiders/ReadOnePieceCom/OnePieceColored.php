<?php

namespace App\Spiders\ReadOnePieceCom;

class OnePieceColored extends BaseReadOnePieceCom
{
    public array $startUrls = [
        'https://ww10.readonepiece.com/manga/one-piece-digital-colored-comics/'
    ];

    protected string $name = 'one_piece_colored';
}
