<?php

namespace App\Actions\Models\User;

use App\Models\User;

class StandardActions
{
    public static function index($request)
    {
        if (!isset($request))
        {
            return User::paginate();
        }

        $search = $request['search'];
        $filters = $request['filters'];

        $users = User::model();

        if (isset($filters) && !empty($filters))
        {
            $users->query()
                ->when(isset($filters['name']), function($subquery) use ($filters) { $subquery->where('name', 'like', $filters['name']); })
                ->when(isset($filters['email']), function($subquery) use ($filters) { $subquery->where('email', 'like', $filters['email']); })
                ->when(isset($filters['phone_no']), function($subquery) use ($filters) { $subquery->where('name', 'like', $filters['phone_no']); })
                ;
        }

        if (isset($search))
        {
            $users->query()
                ->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('phone_no', 'like', "%{$search}%")
                ;
        }

        return $users->paginate();
    }

    public static function show($id)
    {
        $user = User::findOrFail($id);

        return $user;
    }

    public static function store($request)
    {
        $user = User::create($request);

        return $user;
    }

    public static function update($id, $request)
    {
        $user = User::findOrFail($id);
        $user = $user->update($request);

        return $user;
    }

    public static function delete($id)
    {
        $user = User::findOrFail($id);
        $user = $user->delete();

        return $user;
    }
}
