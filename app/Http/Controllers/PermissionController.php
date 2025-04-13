<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use DB;
use Exception;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('permission');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $childPermissions = Permission::all();
        $parentPermissions = $childPermissions->whereNull('parent_id');
        $permissions =  [
            'parents' => $parentPermissions,
            'children' => $childPermissions,
        ];

        return view('permission.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $permissionName = $request->validate([
            'name' => 'required|unique:permissions,name',
            'parent'=>'nullable',
        ]);
        try {
            DB::beginTransaction();
            
            $permission = Permission::create([
                'guard_name' => 'web',
                'name' => $permissionName['name']
            ]);
            if (isset($permissionName['parent']) && $permissionName['parent'] != 'none') {
                $parent = Permission::find($permissionName['parent']);
                if ($parent) {
                    $parent->appendNode($permission);
                }
            }
            if (isset($permissionName['children']) && is_array($permissionName['children'])) {
                foreach ($permissionName['children'] as $childId) {
                    $child = Permission::find($childId);
                    if ($child) {
                        $permission->appendNode($child);
                    }
                }
            }
            DB::commit();

            return redirect()
                ->route('permissions.index')
                ->with('message', trans('app.permissions.created'));
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
        
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
