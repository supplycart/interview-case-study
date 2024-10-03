<?php

namespace App\Repositories;

use Illuminate\Container\Container as Application;
use Illuminate\Support\Str;
use App\Models\Friend;

class FriendRepository extends BaseRepository
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
        return Friend::class;
    }

    public function getList(){
        $friends = Friend::all();
    
        $friends->transform(function ($friend) {
            switch ($friend->following_status) {
                case 1:
                    $friend->follow_status = 'normal';
                    break;
                case 2:
                    $friend->follow_status = 'message';
                    break;
                default:
                    $friend->follow_status = 'no';
                    break;
            }
            return $friend;
        });
    
        return $friends;
    }
}