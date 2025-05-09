<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductsDataTable extends DataTable
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
                $editRoute = route('products.edit', $row->id);
                $deleteRoute = route('products.destroy', $row->id);
                return view('layouts.datatable-action-button', compact('editRoute', 'deleteRoute'));
            })
            ->addColumn('checkbox', function ($row) {
                return '<input type="checkbox" class="select-row" value="' . $row->id . '">';
            })
            ->addColumn('image', function ($row) {
                return '<img src="' . asset('uploads/products/' . $row->product_pic) . '" width="50" height="50" class="img-thumbnail rounded-circle">';
            })
            ->addColumn('created_at', function ($row) {
                return $row->created_at->format('d-M-Y h:ia');
            })
            ->addColumn('updated_at', function ($row) {
                return $row->updated_at->format('d-M-Y h:ia');
            })
            // ->addColumn('shop', function ($row) {
            //     return $row->shops->pluck('shop_name') ?? 'N/A';
            // })
          
            ->rawColumns(['image', 'checkbox'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->newQuery()->orderBy('id', 'desc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('products-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('<"d-flex  my-3" B>frtip') // Place button in the toolbar
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reload'),
                // [
                //     'extend' => 'add',
                //     'text'   => 'Create',
                //     'className' => 'btn btn-dark',
                //     'exportOptions' => [
                //      'modifier' => ['selected' => true] // Export only selected rows
                //     ]
                // ],
                // 'excel', // Default export all rows button
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            // Column::computed('checkbox')->title('<input type="checkbox" id="select-all">')->exportable(false)->printable(false)->orderable(false)->searchable(false),
            Column::computed('DT_RowIndex')
                ->title('id')
                ->width(50)
                ->addClass('text-center'),
            Column::make('name')->addClass('text-center'),
            // Column::make('shop'),
            Column::make('image')->addClass('text-center'),
            Column::make('created_at')->addClass('text-center'),
            Column::make('updated_at')->addClass('text-center'),
            Column::make('action')
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
        return 'Products_' . date('YmdHis');
    }
}
