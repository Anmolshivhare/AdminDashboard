<?php

namespace App\Http\Controllers;

use App\DataTables\RolesDataTables;
use App\Interfaces\PermissionRepositoryInterface;
use App\Interfaces\RoleRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{

    public $permissionRepository;
    public $roleRepository;
    public function __construct(PermissionRepositoryInterface $permissionRepository,RoleRepositoryInterface $roleRepository)
    {
        $this->permissionRepository = $permissionRepository;
        $this->roleRepository = $roleRepository;
        $this->middleware(['permission:role-list'], ['only' => ['index']]);
        $this->middleware(['permission:role-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:role-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:role-delete'], ['only' => ['destroy']]);
        $this->middleware(['permission:role-show'], ['only' => ['show']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(RolesDataTables $dataTable)
    {
        return $dataTable->render('role.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = $this->permissionRepository->getAllPermissions();
        return view('role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $roleDetails = $request->only([
            'name',
        ]);
        try {
            $permissions = $this->permissionRepository->getAllPermisionFromRequest($request);
            DB::beginTransaction();
            $this->roleRepository->createRole($roleDetails, $permissions);
            DB::commit();

            return redirect()
                ->route('roles.index')
                ->with('message', trans('app.roles.created'));
        } catch (Exception $exception) {
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage())->withInput();
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
        $role = $this->roleRepository->getRoleById(decrypt($id));
        $permissions = $this->permissionRepository->getAllPermissions();
        $rolePermissionIds = $role->permissions->pluck('id')->toArray();
        return view('role.edit', compact('role', 'permissions', 'rolePermissionIds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $roleDetails = $request->only([
            'name'
        ]);

        try {
            $permissions = $this->permissionRepository->getAllPermisionFromRequest($request);
            DB::beginTransaction();
            $this->roleRepository->updateRole($id, $roleDetails, $permissions);
            DB::commit();

            return redirect()
                ->route('roles.index')
                ->with('message', trans('app.roles.updated'));
        } catch (Exception $exception) {
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage())->withInput();
        }
    }   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            DB::beginTransaction();
           $this->roleRepository->deleteRoleById(decrypt($id));
           DB::Commit();
           
           return redirect()->route('roles.index')->with('message',trans('app.roles.deleted'));
        }catch(Exception $exception){
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage())->withInput();

        }
    }
}
