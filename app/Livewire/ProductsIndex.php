<?php

namespace App\Livewire;

use App\Models\Product;
use App\Services\CartServices;
use Livewire\Component;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\DB;
use Filament\Tables\Actions\Action as Actions;
use Filament\Tables\Actions\EditAction as Edit;
use Filament\Tables\Actions\DeleteAction as Delete;
use Filament\Forms\Components\Actions\Modal\ModalAction;
use Filament\Forms\Components\Grid;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Enums\FiltersLayout;

class ProductsIndex extends Component implements HasActions, HasForms, HasTable
{
    use InteractsWithActions;
    use InteractsWithForms;
    use InteractsWithTable;

    public $quantity = 1;

    public function render()
    {
        return view('livewire.products-index');
    }


    public function increment()
    {
        $this->quantity++;
    }

    public function table(Table $table):Table
    {
        return $table
            ->heading('Product List')
            ->description('This is your product list')
            ->query(
                Product::query()
            )
            ->filters([
                Filter::make('price_range')
                    ->label('Price Range')
                    ->form([
                        Grid::make(2)->schema([
                            TextInput::make('min_price')
                                ->label('Min Price')
                                ->numeric()
                                ->placeholder('0'),
                            TextInput::make('max_price')
                                ->label('Max Price')
                                ->numeric()
                                ->placeholder('1000'),
                        ]),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        if (! empty($data['min_price'])) {
                            $query->where('price', '>=', $data['min_price']);
                        }

                        if (! empty($data['max_price'])) {
                            $query->where('price', '<=', $data['max_price']);
                        }

                        return $query;
                    }),

            ], layout: FiltersLayout::AboveContent)
            ->columns([
                TextColumn::make('index')
                    ->label('No.')
                    ->rowIndex(),
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable(),
                TextColumn::make('code')
                    ->label('Code')
                    ->searchable(),
                TextColumn::make('price')
                    ->label('Price')
                    ->money('myr', locale: 'en_MY')
                    ->searchable(),
                TextColumn::make('stock_quantity')
                    ->label('Quantity')
                    ->searchable(),
            ])
            ->defaultSort('id', 'desc')
            ->actions([
                Actions::make('view')
                    ->label('Add to Cart') 
                    ->icon('heroicon-m-shopping-cart') 
                    ->button() 
                    ->color('success')
                    ->action(function (Product $record) {
                        $cartService = new CartServices;
                        $cartService->addToCart($record, $this->quantity);
                    })
            ])
            ->selectCurrentPageOnly(true);
    }

}
