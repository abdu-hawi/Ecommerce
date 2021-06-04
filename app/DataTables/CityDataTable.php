<?php

namespace App\DataTables;

use App\Model\City;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CityDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('checkbox', 'admin.cities.btn.checkbox')
            ->addColumn('edit', 'admin.cities.btn.edit')
            ->addColumn('delete', 'admin.cities.btn.delete')
            ->rawColumns([
                'edit',
                'delete',
                'checkbox',
            ])
            ;
    }

    /**
     * Get query source of dataTable.
     *
     *
     * @return Builder
     */
    public function query()
    {
        return City::query()->with('country_id')->select('Cities.*');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    // أزاز استخراج الجدول كملف اكسل
    public function html()
    {
        return $this->builder()
            ->setTableId('citiesdatatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->lengthMenu([[10,25,50,100],[10,25,50,trans('admin.all_record')]])
            ->language(datatableLang())
            /*
             * this use for search inside columns
            ->initComplete('function () {
                this.api().columns([1,2,3,4,5]).every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    $(input).appendTo($(column.footer()).empty())
                    .on("keyup", function () {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());

                        column.search(val ? val : "", true, false).draw();
                    });
                });
            }')
            */
            ->buttons(
                Button::make('create')
                    ->className('btn btn-success')
                    ->text('<i class="fas fa-plus fa-sm"></i> '.trans("admin.create_new_city")),
                Button::make('export')
                    ->className('btn btn-info')
                    ->text('<i class="fas fa-download fa-sm"></i> '.trans('admin.export')),
                Button::make('print')
                    ->className('btn btn-primary')
                    ->text('<i class="fas fa-print fa-sm"></i> '.trans('admin.print')),
                Button::make('reset')
                    ->className('btn btn-default')
                    ->text('<i class="fas fa-undo fa-sm"></i> '.trans('admin.reset')),
                Button::make('reload')
                    ->className('btn btn-warning')
                    ->text('<i class="fas fa-refresh fa-sm"></i> '.trans('admin.reload')),

                Button::make('pdf')->className('btn btn-dark'),
                Button::make('excel')->className('btn btn-light'),
                Button::make('csv')->className('btn btn-secondary'),
                Button::make('create')->action('www.google.com')
                    ->className('btn btn-danger del-btn')
                    ->text('<i class="fas fa-trash fa-sm"></i> '.trans('admin.delete'))

            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    // أسماء اعمدة الجدول
    protected function getColumns()
    {
        return [
            Column::computed('checkbox')
                ->title('<input type="checkbox" class="check-all" onclick="check_all()">')
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->orderable(false)
                ->addClass('text-center'),
            Column::make('id')->name('id')->title('ID')->width(0),
            Column::make('city_name_ar')->name('city_name_ar')->title(trans('admin.city_name_ar')),
            Column::make('city_name_en')->name('city_name_en')->title(trans('admin.city_name_en')),
            Column::make('country_id.country_name_'.lang())
                ->name('country_id.country_name_'.lang())
                ->title(trans('admin.country_id')),
            Column::computed('edit')
                ->title(trans('admin.edit'))
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->orderable(false)
                ->addClass('text-center'),
            Column::computed('delete')
                ->title(trans('admin.delete'))
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->orderable(false)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'City_' . date('YmdHis');
    }
}
