<?php

// Сущность пользователя.

namespace app\entities;

class Phone extends Entity
{
    public $id;
    public $userID;
    public $phone;
}