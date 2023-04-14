<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserService
{
    public function getAllUsers()
    {
        return session()->get('user_session');
    }

    public function store($request)
    {
        try{
            $uniqid = $this->generateUniqueID();
            $userSession = session()->get('user_session', []);
            if ($request->hasFile('profile')) {
                $profileURL = $request->file('profile')->store('uploaded', 'public');
            }

            $userSession[$uniqid] = [
                'id' => $uniqid,
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'number' => $request->input('number'),
                'role' => $request->input('role'),
                'password' => $request->input('password'),
                'profile' => $profileURL,
                'date' => $request->input('date'),
            ];
            session()->put('user_session', $userSession);
            return to_route('user.index')->with('message', 'Data successfully created.');
            return true;
        }catch(\Exception $e){
            return redirect()->route('user.index')->with('errors', 'Something went wrong.');
        } 
    }

    public function getUserById($id)
    {
        $userSession = session()->get('user_session');
        return $userSession[$id] ?? null;
    }

    public function updateUser($request, $id)
    {
        $userSession = session()->get('user_session');
        if (!isset($userSession[$id])) {
            abort(404);
        }
        $userSession[$id]['name'] = $request->input('name');
        $userSession[$id]['email'] = $request->input('email');
        $userSession[$id]['number'] = $request->input('number');
        $userSession[$id]['role'] = $request->input('role');
        $userSession[$id]['password'] = $request->input('password');
        if ($request->hasFile('profile')) {
            $profileURL = $request->file('profile')->store('uploaded', 'public');
            $userSession[$id]['profile'] = $profileURL;
        }
        $userSession[$id]['date'] = $request->input('date');
        session()->put('user_session', $userSession);
        return to_route('user.index')->with('message', 'Data successfully updated.');
    }

    public function deleteUser($id)
    {
        $userSession = session()->get('user_session');
        if (!isset($userSession[$id])) {
            abort(404);
        }
        unset($userSession[$id]);
        session()->put('user_session', $userSession);
        return to_route('user.index')->with('message', 'Data successfully deleted.');
    }

    public function finalSubmit()
    {
        $userArray = session()->get('user_session');
        if (!$userArray) {
            abort(422);
        }
        foreach ($userArray as $userArr) {
            if (User::where('email', $userArr['email'])->exists()) {
                continue;
            }
            User::create([
                "unique_id" => $userArr['id'],
                "name" => $userArr['name'],
                "email" => $userArr['email'],
                "password" => bcrypt($userArr['email']),
                "profile" => $userArr['profile'],
                "role" => $userArr['role'],
                "mobile_number" => $userArr['number'],
                "creation_date" => $userArr['date'],
            ]);
        }
        session()->forget('user_session');
        return to_route('user.index')->with('message', 'Data successfully inserted into the database.');
    }

    private function generateUniqueID()
    {
        return uniqid();
    }
}
