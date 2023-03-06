<?php

namespace App\Services;

use App\Models\PasswordReset;

class PasswordService
{
    private $passwordResetModel;

    public function __construct(PasswordReset $passwordResetModel)
    {
        $this->passwordResetModel = $passwordResetModel;
    }

    public function verifyIfExistsToken($token) 
    {
        $verify = $this->passwordResetModel->where('token', $token)->get()->count();

        if ($verify > 0) {
            return true;
        }

        return false;
    }

    public function verifyEmailExistsToken($email)
    {
        $verify = $this->passwordResetModel->where('email', $email)->get()->count();

        if ($verify > 0) {
            return true;
        }

        return false;
    }

    public function registerTokenTable($token, $email)
    {
        $create = $this->passwordResetModel->create(
            [
                'token' => $token,
                'email' => $email
            ]
        );

        return $create;
    }

    public function clearToken($token)
    {
        $this->passwordResetModel->where('token', $token)->delete();
    }

    public function getRowByToken($token) 
    {
        $verify = $this->passwordResetModel->where('token', $token)->get();
        return $verify;
    }
}
