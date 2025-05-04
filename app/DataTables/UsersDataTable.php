<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $id = encrypt($row->id);
                $editRoute = route('users.edit', $id);
                $deleteRoute = route('users.destroy', $id);
                return view('layouts.datatable-action-button', compact('editRoute', 'deleteRoute'));
            })
            ->editColumn('name', function ($row) {
                return $row->name ?: 'N/A';
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(3,'desc')
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);

        // $createLead = auth()->user()->can('user-create');
        // return $this->builder()
        //     ->setTableId('users')
        //     ->columns($this->getColumns())
        //     ->minifiedAjax()
        //     ->parameters([
        //         'processing' => true,
        //         'serverSide' => true,
        //         'language' => [
        //             'searchPlaceholder' => 'Search..',
        //         ],
        //         'buttons' => array_merge(
        //             $createLead ? [
        //                 [
        //                     'extend' => 'add',
        //                     'text' => __('buttons.create'),
        //                     'attr' => ['class' => 'btn btn-primary'],
        //                 ]
        //             ] : [],
        //             [
        //                 [
        //                     'extend' => 'excel',
        //                     'text' => __('buttons.export_to_excel'),
        //                     'attr' => ['class' => 'btn btn-primary']
        //                 ]
        //             ]
        //         ),
        //     ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')
                ->title('id')
                ->width(50)
                ->addClass('text-center'),
            Column::make('name')->title('User Name'),
            Column::make('email'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::make('action'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
