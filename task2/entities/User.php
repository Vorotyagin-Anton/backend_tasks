<?php

// Сущность пользователя.

namespace app\entities;

class User extends Entity
{
    public $id;
    public $firstname;
    public $lastname;
	public $patronymic;
}