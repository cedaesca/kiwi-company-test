<?php

namespace App\Interfaces\Core;

use PDO;

interface DatabaseManagerInterface
{
    public function getConnection(): PDO;
}
