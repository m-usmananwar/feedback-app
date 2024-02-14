<?php
namespace App\Contracts;

interface UserRepositoryInterface
{
    public function getUser($data);
    public function store(array $data);
    public function signInValidation($data);
    public function storeValidation($data);
    public function isEmailExists($email);
}

