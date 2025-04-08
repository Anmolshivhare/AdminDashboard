<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Http\Requests\User\UpdateUSerRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Workbench\App\Models\User as ModelsUser;

class UserController extends Controller
{
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
        $userData = User::find($userId);
        return view('auth.profile', compact('userData'));
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
    public function update(UpdateUSerRequest $request, string $id)
    {
       
        $user = User::findOrFail($id);
        $userDetails = [
            'name' =>  $request->name,
            'email' => $request->email
        ];
         
        if (!empty($request->profile_pic)) {
            $image = $request->profile_pic;
            $destination = 'uploads/profile';
            $userDetails['profile_pic'] = uploadImages($image, $destination);

            // Check if there is an existing profile picture
            if (!empty($user['profile_pic'])) {
                $existingImagePath = public_path($destination . '/' . $user['profile_pic']);
                // Delete the old profile picture if it exists
                if (file_exists($existingImagePath)) {
                    unlink($existingImagePath);
                }
            }
 
        }
 
        $user->update($userDetails);

        return redirect()->back()->with('message', 'Profile Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
