<?php

// Репозиторий пользователей.

namespace app\repositories;

use app\entities\Phone;

class PhoneRepository extends Repository
{
    protected function getTableName(): string
    {
        return  'phones';
    }

    protected function getEntityName(): string
    {
        return Phone::class;
    }
}