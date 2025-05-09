<?php

namespace App\Http\Controllers;

use App\DataTables\PermissionDataTable;
use App\Http\Requests\Permission\CreatePermissionRequest;
use App\Http\Requests\Permission\UpdatePermissionRequest;
use App\Interfaces\PermissionRepositoryInterface;
use App\Models\Permission;
use App\Repositories\PermissionRepository;
use Illuminate\Http\Request;
use DB;
use Exception;

use function Termwind\render;

class PermissionController extends Controller
{
    public $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
        $this->middleware(['permission:permission-list'], ['only' => ['index']]);
        $this->middleware(['permission:permission-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:permission-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:permission-delete'], ['only' => ['destroy']]);
        $this->middleware(['permission:permission-show'], ['only' => ['show']]);
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
        $childPermissions = $this->permissionRepository->getAllData();
        $parentPermissions = $childPermissions->whereNull('parent_id');
        $permissions =  [
            'parents' => $parentPermissions,
            // 'children' => $childPermissions,
        ];
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
            $permission =  $this->permissionRepository->addData(
                [
                    'guard_name' => 'web',
                    'name' => $requestData['name']
                ]
            );

            if (isset($requestData['parent']) && $requestData['parent'] != 'none') {
                 $parent = $this->permissionRepository->getDataById($requestData['parent']);
                if ($parent) {
                    $parent->appendNode($permission);
                }
            }


            // if (isset($requestData['children']) && is_array($requestData['children'])) {
            //     dd($requestData['children']);
            //     foreach ($requestData['children'] as $childId) {
            //         $child = $this->permissionRepository->getDataById($childId);
            //         if ($child) {
            //             $permission->appendNode($child);
            //         }
            //     }
            // }
 
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
        $permission = $this->permissionRepository->getDataById(decrypt($id));
        $childPermissions = $this->permissionRepository->getAllData();
        $parentPermissions = $childPermissions->whereNull('parent_id');
        $permissions =  [
            'parents' => $parentPermissions,
            // 'children' => $childPermissions,
        ];
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
            $permission = $this->permissionRepository->updateData(decrypt($id), $requestData);
            $permission->name = $requestData['name'];
            if ($requestData['parent'] ?? 'none' !== 'none') {
                $parent = $this->permissionRepository->getDataById($requestData['parent']);
                if ($parent) {
                    $parent->appendNode($permission);
                }
            } else {
                $permission->makeRoot();
            }
            $permission->save();

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
        try{
            DB::beginTransaction();
            $this->permissionRepository->deleteData(decrypt($id));
            DB::Commit();
            return redirect()->route('permissions.index')->with('message',trans('app.permissions    .deleted'));

        } catch (Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage())->withInput();
        }
    }
}
