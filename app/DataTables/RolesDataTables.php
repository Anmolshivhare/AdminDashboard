<?php

namespace App\DataTables;

use App\Models\RolesDataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RolesDataTables extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $user = auth()->user();
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', function ($row) use ($user){
                $id = encrypt($row->id);
                $editRoute = route('roles.edit', $id);
                $deleteRoute = route('roles.destroy', $id);
                return view('layouts.datatable-action-button', compact('editRoute', 'deleteRoute'));
            })
            ->addColumn('created_at', function ($row) {
                return $row->created_at->format('Y-m-d');
            })
            ->addColumn('updated_at', function ($row) {
                return $row->updated_at->format('Y-m-d');
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Role $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        $createRole = auth()->user()->can('role-create');

        return $this->builder()
            ->setTableId('roles')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters([
                'processing' => true,
                'serverSide' => true,
                'language' => [
                    'searchPlaceholder' =>'Search..', 
                ],
                'buttons' => array_merge(
                    $createRole ? [
                        [
                            'extend' => 'add',
                            'text' => __('buttons.create_role'),
                            'attr' => ['class' => 'btn btn-primary'],
                        ]
                    ] : [], 
                    []
                ),
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')
            ->title(__('labels.id'))
            ->width(50)
            ->addClass('text-center'),
            Column::make('name')->title(__('labels.role_name')),
            Column::make('created_at')->title(__('labels.created_at')),
            Column::make('updated_at')->title(__('labels.updated_at')),
            Column::computed('action')->title(__('labels.action'))
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'RolesDataTables_' . date('YmdHis');
    }
}
