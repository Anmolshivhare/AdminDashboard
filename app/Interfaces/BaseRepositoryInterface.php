<?php 
namespace App\Interfaces;

use Illuminate\Http\Request;

Interface BaseRepositoryInterface
{
     /**
     * function to add the data
     *
     * @param array $data
     * @return mixed
     */
    public function addData(array $data);

    /**
     * function to update the data
     *
     * @param string $id
     * @param array $updatedData
     * @return mixed
     */
    public function updateData(string $id, array $updatedData);

    /**
     * function to get the data by Id
     *
     * @param string $id
     * @return mixed
     */
    public function getDataById(string $id);

    /**
     * function to get all the data
     *
     * @return mixed
     */
    public function getAllData();

    /**
     * function to get the delete the data
     *
     * @param string $id
     * @return mixed
     */
    public function deleteData(string $id);

    /**
     * function to get the data from the request
     *
     * @param Request $request
     * @return mixed
     */
    public function getDataFromRequest(Request $request);

    /**
     * function to get the data on the basis of filter provided
     *
     * @param array $filters
     * @return mixed
     */
    // public function getDataOnBasisOfFilter(array $filters);
}

?>