<?php

namespace App\Core;

use App\Interfaces\Core\DatabaseManagerInterface;

abstract class BaseRepository
{
    public function __construct(protected DatabaseManagerInterface $dbManager) {}
}
