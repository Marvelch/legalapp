<?php

namespace App\DataTables;

use App\Models\LegalEntity;
use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

class LegalEntityDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        // return (new EloquentDataTable($query))
        //     ->addColumn('action', 'legalentity.action')
        //     ->setRowId('id');
        $model = User::all();
         return (new EloquentDataTable($query))
        ->addColumn('divisions', function($model){
            return "ada";
        })
        ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(LegalEntity $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('legalentity-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('name'),
            Column::make('address'),
            Column::make('divisions')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'LegalEntity_' . date('YmdHis');
    }
}
