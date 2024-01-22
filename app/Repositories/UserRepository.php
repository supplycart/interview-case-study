<?php

namespace App\Repositories;

use Illuminate\Container\Container as Application;
use Illuminate\Support\Str;
use App\Models\User;

class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    // protected $fieldSearchable = [
    //     'name',
    //     'parent_id'
    // ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    // public function getFieldsSearchable()
    // {
    //     return $this->fieldSearchable;
    // }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }

    public function getBannedUser($username){
        return User::where('username', $username)
            ->where('status', -1)
            ->first();
    }

    public function getActiveUser($username){
        return User::where('username', $username)
            ->where('status', 1)
            ->first();
    }

    public function getInactiveUserByUsername($username){
        return User::where('username', $username)
            ->where('status', 0)
            ->first();
    }

    public function updateSessionIDByUserID($user_id){
        $new_session_id = (string) Str::uuid();

        $user = User::find($user_id);
        $user->session_id = $new_session_id;
        if ($user->save()) {
            return $new_session_id;
        }
        return false;
    }
}
