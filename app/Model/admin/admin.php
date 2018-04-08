<?php

namespace App\Model\admin;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class admin extends Authenticatable
{
    use Notifiable;
}
// beste tutorial die ik gevonden heb over de relationships https://hackernoon.com/eloquent-relationships-cheat-sheet-5155498c209