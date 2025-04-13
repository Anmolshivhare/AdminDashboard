<?php

namespace App\Http\Controllers;

use App\DataTables\PermissionDataTable;
use App\Interfaces\PermissionRepositoryInterface;
use App\Models\Permission;
use Illuminate\Http\Request;
use DB;
use Exception;

use function Termwind\render;

class PermissionController extends Controller
{
    public $permissionRepository;

    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(PermissionDataTable $dataTable)
    {
        return $dataTable->render('permission.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = $this->permissionRepository->getAllPermissions();
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
