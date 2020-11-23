<?php

// Контроллер, отвечающий за операции с пользователями.

namespace app\controllers;

use app\entities\User;
use app\entities\Phone;

class UserController extends Controller
{
    // Получить всех пользователей.
    public function getAllUsersAction()
    {
        $users = $this->container->userRepository->getAll();
        foreach ($users as $user) {
            $phones = $this->container->phoneRepository->getAllWhere('userID', $user->id);
            foreach ($phones as $phone) {
                $user->phones[] = $phone->phone;
            }
        }
        return $this->container->renderer
            ->render(
                'userAll',
                ['users' => $users]
            );
    }

    // Получить одного пользователя.
    public function getOneUserAction()
    {
        $id = $this->container->request->getId();
        $user = $this->container->userRepository->getOneWhere('id', $id);
        $phones = $this->container->phoneRepository->getAllWhere('userID', $id);
        foreach ($phones as $phone) {
            $user->phones[] = $phone->phone;
        }
        return $this->container->renderer
            ->render(
                'userOne',
                [
                    'user' => $user,
                    'title' => "Пользователь: " . $user->id
                ]
            );
    }

    // Удалить пользователя.
    public function delUserAction()
    {
        $id = $this->container->request->getId();
        $this->container->userRepository->delete($id);
        header('Location: /user/getAllUsers');
        return '';
    }

    // Добавить пользователя.
    public function addUserAction()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return $this->container->renderer->render('userAdd');
        }

        $user = new User();
        foreach ($user as $fieldName => $value) {
            if ($fieldName == 'id') {
                continue;
            }

            if (empty($this->container->request->getFromPost($fieldName))) {
                continue;
            }

            $user->$fieldName = $this->container->request->getFromPost($fieldName);
        }

        $userID = $this->container->userRepository->save($user)->id;

        $numbers = [
            $this->container->request->getFromPost('phone1'),
            $this->container->request->getFromPost('phone2'),
            $this->container->request->getFromPost('phone3'),
            $this->container->request->getFromPost('phone4'),
        ];

        foreach ($numbers as $number) {
            if (empty($number)) {
                continue;
            }
            $phone = new Phone();
            $phone->userID = $userID;
            if (!preg_match('/^\d{11}$/', $number)) {
                continue;
            }
            $phone->phone = $number;
            $this->container->phoneRepository->save($phone);
        }

        header('Location: /user/getAllUsers');
        return '';
    }

    // Обновить данные пользователя.
    public function updUserAction()
    {
        $id = $this->container->request->getId();
        $user = $this->container->userRepository->getOneWhere('id', $id);
        $phones = $this->container->phoneRepository->getAllWhere('userID', $id);

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return $this->container->renderer->render(
                'userUpd',
                [
                    'user' => $user,
                    'phones' => $phones,
                    'title' => "Изменить пользователя: " . $user->id
                ]
            );
        }

        $user = new User();
        foreach ($user as $fieldName => $value) {
            if ($fieldName == 'id') {
                $user->$fieldName = $id;
                continue;
            }
            if (empty($this->container->request->getFromPost($fieldName))) {
                continue;
            }
            $user->$fieldName = $this->container->request->getFromPost($fieldName);
        }

        $this->container->userRepository->save($user);

        $numbers = [
            $this->container->request->getFromPost('phone1'),
            $this->container->request->getFromPost('phone2'),
            $this->container->request->getFromPost('phone3'),
            $this->container->request->getFromPost('phone4'),
        ];

        foreach ($numbers as $index => $number) {
            if (empty($number)) {
                continue;
            }
            if (!preg_match('/^\d{11}$/', $number)) {
                continue;
            }
            if (!empty($phones[$index])) {
                $phone = new Phone();
                $phone->id = $phones[$index]->id;
                $phone->userID = $id;
                $phone->phone = $number;
                $this->container->phoneRepository->save($phone);
                continue;
            }
            $phone = new Phone();
            $phone->userID = $id;
            $phone->phone = $number;
            $this->container->phoneRepository->save($phone);
        }

        header('Location: /user/getAllUsers');
        return '';
    }
}

        