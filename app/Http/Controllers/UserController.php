<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $userArray = $this->userService->getAllUsers();
        return view('task_1.index', compact('userArray'));
    }

    public function create()
    {
        return view('task_1.create');
    }

    public function store(UserStoreRequest $request)
    {
        return $this->userService->store($request);
    }

    public function edit($id)
    {
        $userArray = $this->userService->getUserById($id);
        if (!$userArray) {
            abort(404);
        }
        return view('task_1.edit', compact('userArray'));
    }

    public function update(UserUpdateRequest $request, $id)
    {
        return $this->userService->updateUser($request, $id);
    }

    public function delete($id)
    {
        return $this->userService->deleteUser($id);  
    }

    public function finalSubmission()
    {
        return $this->userService->finalSubmit();
    }
}
