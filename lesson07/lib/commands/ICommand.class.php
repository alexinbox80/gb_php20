<?php

namespace App\Lib;

interface ICommand
{
    public function exec($arguments);
}
