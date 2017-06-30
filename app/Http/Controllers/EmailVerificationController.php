<?php

namespace CodeFlix\Http\Controllers;

use CodeFlix\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Jrean\UserVerification\Traits\VerifiesUsers;

class EmailVerificationController extends Controller
{
    use VerifiesUsers;
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * EmailVerificationController constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function redirectAfterVerification()
    {
        $this->loginUser();
        return url('admin/dashboard');
    }

    protected function loginUser()
    {
        $email = \Request::get('email');
        $user = $this->repository->findByField('email', $email);
    }
}
