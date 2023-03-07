<?php
namespace App\Services;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;

class UseService extends BaseService
{
    protected $auth;

    /**
     * @return \Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
     */
    public function setAuthGuard()
    {
        $this->auth = Auth::guard('users');
    }

    /**
     * @param $email
     * @param $password
     * @param bool $remember
     * @return bool
     */
    public function login($email, $password, bool $remember = false): bool
    {
        $this->setAuthGuard();
        if ($this->auth->attempt([
            'email' => $email,
            'password' => $password,
        ], $remember)) {
            return true;
        }
        return false;
    }
}