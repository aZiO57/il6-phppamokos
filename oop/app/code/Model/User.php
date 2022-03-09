<?php

declare(strict_types=1);

namespace Model;

use Helper\DBHelper;
use Helper\FormHelper;
use Model\City;
use Core\AbstractModel;
use Core\Interfaces\ModelInterface;

class User extends AbstractModel implements ModelInterface
{
    private string $name;

    private string $lastName;

    private string $email;

    private string $password;

    private int $phone;

    private int $cityId;

    private City $city;

    private bool $active;

    private int $roleId;

    protected const TABLE = 'users';

    public function __construct($id = null)
    {
        if ($id !== null) {
            $this->load($id);
        }
    }

    public function assignData(): void
    {
        $this->data = [
            'name' => $this->name,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'password' => $this->password,
            'phone' => $this->phone,
            'city_id' => $this->cityId,
            'active' => $this->active,
            'role_id' => $this->roleId
        ];
    }


    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getPhone(): int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): void
    {
        $this->phone = $phone;
    }

    public function getCityId(): int
    {
        return $this->cityId;
    }

    public function getCity(): City
    {
        return $this->city;
    }


    public function setCityId(int $id): void
    {
        $this->cityId = $id;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(int $active): void
    {
        $this->active = $active;
    }

    public function setRoleId(int $id): void
    {
        $this->roleId = $id;
    }

    public function getRoleId(): int
    {
        return $this->roleId;
    }


    public function load(int $id): User
    {
        $db = new DBHelper();
        $data = $db->select()->from(self::TABLE)->where('id', (string) $id)->getOne();
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->lastName = $data['last_name'];
        $this->phone = $data['phone'];
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->cityId = $data['city_id'];
        $this->active = $data['active'];
        $this->roleId = $data['role_id'];
        $city = new City();
        $this->city = $city->load($this->cityId);
        return $this;
    }

    public static function checkLoginCredentionals(string $email, string $pass): ?int
    {
        $db = new DBHelper();
        $rez = $db
            ->select('id')
            ->from(self::TABLE)
            ->where('email', $email)
            ->andWhere('password', $pass)
            ->andWhere('active', 1)
            ->getOne();

        if (isset($rez['id'])) {
            return $rez['id'];
        } else {
            return null;
        }
    }

    public static function getAllUsers(): array
    {
        $db = new DBHelper();
        $data = $db->select('id')->from(self::TABLE)->get();
        $users = [];
        foreach ($data as $element) {
            $user = new User();
            $user->load($element['id']);
            $users[] = $user;
        }

        return $users;
    }
}
