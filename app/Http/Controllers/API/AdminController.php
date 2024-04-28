<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Http\Requests\API\CreateAdminRequest;
use App\Http\Requests\API\AdminPasswordResetRequest;
use App\Http\Requests\API\AdminUpdateRequest;
use App\Http\Requests\API\AdminLoginRequest;
use App\Repositories\AdminRepository;
use Illuminate\Support\Facades\Auth;

class AdminController
{
    public function __construct(AdminRepository $adminRepository) {
        $this->_adminRepository = $adminRepository;
    }

    public function createAdmin(CreateAdminRequest $request){
        $password = bcrypt($request->password);

        Admin::create([
            'role' => $request->role,
            'status' => 1,
            'username' => $request->username,
            'password' => $password
        ]);

        return response()->json(['data' => 'done'], 200);
    }

    public function login(AdminLoginRequest $request){
        $username = $request->username;
        $password = $request->password;

        $token = Auth::guard('admin')->attempt(['username' => $username, 'password' => $password, 'status' => 1]);

        if (!$token) {
            return response()->json(['error' => 'page.incorrect_password'], 401);
        }
        
        $admin = $this->_adminRepository->getActiveUser($username);

        if($admin){
            $admin->token = $token;

            return response()->json(['data' => $admin], 200);
        }
        
        return response()->json(['data' => __("page.no_user")], 404);
    }

    public function getAdmin($id){
        $admin = Admin::find($id);

        return response()->json(['data' => $admin], 200);
    }

    public function updateAdmin(AdminUpdateRequest $request, $id){
        Admin::where('id', $id)
            ->update(
                $request->all()
            );
            
        $admin = Admin::find($id);

        return response()->json(['data' => $admin], 200);
    }

    public function resetAdminPassword(AdminPasswordResetRequest $request, $id){
        $password = bcrypt($request->new_password);

        Admin::where('id', $id)
            ->update([
                'password' => $password,
            ]);

        return response()->json(['data' => 'done'], 200);
    }

    public function logout(){
        Auth::guard('admin')->logout();

        return response()->json(['data' => 'done'], 200);
    }
}
