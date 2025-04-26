<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Http\Requests\User\UpdateUserRequest;
use App\Interfaces\RoleRepositoryInterface;
use App\Models\User;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Workbench\App\Models\User as ModelsUser;

class UserController extends Controller
{
    protected $userRepository;

    protected $roleRepository;

    public function __construct(UserRepository $userRepository, RoleRepositoryInterface $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(UsersDataTable $userDataTable)
    {
        return $userDataTable->render('users.index');
    }

    public function userProfile()
    {
        $userId = auth()->user()->id;
        $roles = $this->roleRepository->getAllRoles();
        $userData = User::find($userId);
        return view('auth.profile', compact('roles', 'userData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $requestData = $this->userRepository->getDataFromRequest($request);
        try {
            if (!empty($request->profile_pic)) {
                $user = $this->userRepository->getDataById($id);
                $image = $request->profile_pic;
                $destination = 'uploads/profile';
                $requestData['profile_pic'] = uploadImages($image, $destination);

                // Check if there is an existing profile picture
                if (!empty($user['profile_pic'])) {
                    $existingImagePath = public_path($destination . '/' . $user['profile_pic']);
                    // Delete the old profile picture if it exists
                    if (file_exists($existingImagePath)) {
                        unlink($existingImagePath);
                    }
                }
            }
            
            DB::beginTransaction();
            $user = $this->userRepository->updateData($id, $requestData);
            $userRole = $user->roles->first();
            if (!empty($userRole)) {
                $user->removeRole($userRole);
            }
            $roleId = (int) $requestData['role'];
            $user->assignRole($roleId);

            // $userRole = $user->roles->first();
            // if ($userRole) {
            //     $user->removeRole($userRole);
            // }
            // $user->assignRole($roleId);
            DB::commit();
            return redirect()->back()->with('message', 'Profile Update Successfully');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
