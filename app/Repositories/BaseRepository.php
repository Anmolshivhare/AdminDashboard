<?php
namespace App\Repositories;

use App\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function addData(array $data)
    {
        return $this->model::create($data);
    }

    public function updateData(string $id, array $updatedData)
    {
        $data = $this->model::findOrFail($id);
        $data->update($updatedData);
        return $data;
    }

    public function getDataById(string $id)
    {
        return $this->model::find($id);
    }

    public function getAllData()
    {
        return $this->model::all();
    }

    public function deleteData(string $id)
    {
        $record = $this->getDataById($id);
        if ($record) {
            return $record->delete();
        }
        return null;
    }

    public function getDataFromRequest(Request $request)
    {
        return $request->only([]);
    }

    
}
?>