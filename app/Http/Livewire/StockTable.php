<?php

namespace App\Http\Livewire;

use App\Models\Stock;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\Rules\Rule;

final class StockTable extends PowerGridComponent
{
    use ActionButton;

    //Messages informing success/error data is updated.
    public bool $showUpdateMessages = true;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */

    
    public string $sortField = 'stocks.id';

    public string $primaryKey = 'stocks.id';

    public bool $withSortStringNumber = true;

    public function setUp(): void
    {
        $this->showCheckBox()
            ->showPerPage()
            ->showSearchInput()
            ->showExportOption('download', ['excel', 'csv']);
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * PowerGrid datasource.
     *
     * @return  \Illuminate\Database\Eloquent\Builder<\App\Models\Stock>|null
     */
    public function datasource(): ?Builder
    {
        return Stock::query()->join('products', function ($categories) {
            $categories->on('products.id', '=', 'stocks.product_id');
        })
            ->select([
                'stocks.id',
                'stocks.product_id',
                'stocks.sellout',
                'stocks.qty',
                'stocks.date',
                'stocks.created_at',
                'stocks.updated_at',
                'products.title as pname'
            ])->orderBy('stocks.id', 'desc');
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    */
    public function addColumns(): ?PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('sellout')
            ->addColumn('date_formatted', function (Stock $model) {
                return Carbon::parse($model->date)->format('d/m/Y');
            })
            ->addColumn('product_id')
            ->addColumn('created_at_formatted', function (Stock $model) {
                return Carbon::parse($model->created_at)->format('d/m/Y H:i:s');
            })
            ->addColumn('updated_at_formatted', function (Stock $model) {
                return Carbon::parse($model->updated_at)->format('d/m/Y H:i:s');
            });
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::add()
                ->title('ID')
                ->field('id')
                ->sortable(),
            //  ->makeInputRange(),




            Column::add()
                ->title('Product Name')
                ->field('pname')
                ->sortable()
                ->makeInputText(),



            Column::add()
                ->title('SELLOUT')
                ->field('sellout')

                ->withSum('Sell', true, false)
                ->sortable()
                ->searchable()
               // ->editOnClick()
                ->makeInputRange(),
            Column::add()
                ->title('Quantity')
                ->field('qty')
                ->sortable()
                ->searchable()
                ->makeInputRange(),


            Column::add()
                ->title('DATE')
                ->field('date')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker('date'),


            //  Column::add()
            //        ->title('CREATED AT')
            //       ->field('created_at_formatted', 'created_at')
            //       ->searchable()
            //      ->sortable()
            //      ->makeInputDatePicker('created_at'),

            //    Column::add()
            //        ->title('UPDATED AT')
            //        ->field('updated_at_formatted', 'updated_at')
            //        ->searchable()
            //        ->sortable()
            //       ->makeInputDatePicker('updated_at'),

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid Stock Action Buttons.
     *
     * @return array<int, \PowerComponents\LivewirePowerGrid\Button>
     */


    public function actions(): array
    {
        return [
            Button::add('edit')
                ->caption('Edit')
                ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
                ->route('stock.edit', ['id']),

            Button::add('destroy')
                ->caption('Delete')
                ->target('')
                ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
                ->route('stock.destroy', ['id'])
                ->method('delete')
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid Stock Action Rules.
     *
     * @return array<int, \PowerComponents\LivewirePowerGrid\Rules\RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [
           
           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($stock) => $stock->id === 1)
                ->hide(),
        ];
    }
    */

    /*
    |--------------------------------------------------------------------------
    | Edit Method
    |--------------------------------------------------------------------------
    | Enable the method below to use editOnClick() or toggleable() methods.
    | Data must be validated and treated (see "Update Data" in PowerGrid doc).
    |
    */

    /**
     * PowerGrid Stock Update.
     *
     * @param array<string,string> $data
     */


    public function update(array $data): bool
    {
        try {
            if ($data['field'] == 'qty') {
                return    $updated = Stock::query()->findOrFail($data['id'])
                    ->update([
                        "qty" => "hjk",
                    ]);
            } else {
                $updated = Stock::query()->findOrFail($data['id'])
                    ->update([
                        $data['field'] => $data['value'],
                    ]);
            }
        } catch (QueryException $exception) {
            $updated = false;
        }
        return $updated;
    }

    public function updateMessages(string $status = 'error', string $field = '_default_message'): string
    {
        $updateMessages = [
            'success'   => [
                '_default_message' => __('Data has been updated successfully!'),
                //'custom_field'   => __('Custom Field updated successfully!'),
            ],
            'error' => [
                '_default_message' => __('Error updating the data.'),
                //'custom_field'   => __('Error updating custom field.'),
            ]
        ];

        $message = ($updateMessages[$status][$field] ?? $updateMessages[$status]['_default_message']);

        return (is_string($message)) ? $message : 'Error!';
    }
}
