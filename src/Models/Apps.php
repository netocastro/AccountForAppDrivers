<?php

namespace Source\Models;

use Stonks\DataLayer\DataLayer;

class Apps extends DataLayer
{
    public function __construct()
    {
        parent::__construct('apps', ['name'], 'id');
    }
}
