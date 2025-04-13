<?php

namespace App\Http\Controllers;

use App\DataTables\PermissionDataTable;
use App\Http\Requests\Permission\CreatePermissionRequest;
use App\Http\Requests\Permission\UpdatePermissionRequest;
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
    public function store(CreatePermissionRequest $request)
    {
        $requestData = $this->permissionRepository->getPermissionDataFormRequest($request);
        try {
            DB::beginTransaction();
            $this->permissionRepository->createPermission($requestData);
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
        $permission = $this->permissionRepository->getPermissionById(decrypt($id));
        $permissions = $this->permissionRepository->getAllPermissions();
        return view('permission.edit', compact('permission', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionRequest $request, string $id)
    {
        $requestData = $this->permissionRepository->getPermissionDataFormRequest($request);
        try {
            DB::beginTransaction();
            $this->permissionRepository->updatePermission(decrypt($id), $requestData);
            DB::commit();
            return redirect()
                ->route('permissions.index')
                ->with('message', trans('app.permissions.updated'));
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
