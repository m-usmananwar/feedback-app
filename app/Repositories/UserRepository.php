<?php
namespace App\Repositories;

use App\Models\User;
use App\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function getUser($data)
    {
        $user = $this->model::where('email', $data['email'])->first();
        return $user;
    }

    public function isEmailExists($email)
    {
        return $this->model::where('email', $email)->exists();
    }

    public function signInValidation($data)
    {
        return Validator::make($data, [
            'email' => 'required',
            'password' => 'required',
        ]);
    }

    public function storeValidation($data)
    {
        return Validator::make($data, [
            'name' => 'required',
            'email' => ['required', 'unique:users,email'],
            'password' => 'required',
        ]);
    }
}

