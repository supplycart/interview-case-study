<?php

namespace App\Livewire;

use App\Models\OrderItems;
use App\Models\Orders;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Livewire\Component;
use Filament\Forms\Components\Grid;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Forms\Components\TextInput;


class OrderList extends Component implements HasActions, HasForms, HasTable
{
    use InteractsWithActions;
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table):Table
    {
        return $table
            ->heading('Order List')
            ->description('Here’s a list of your previous orders.')
            ->query(
                Orders::query()
                    ->where('user_id', auth()->user()->id)
                    ->Orderby('updated_at', 'desc')
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
                TextColumn::make('id')
                    ->label('Order ID')
                    ->getStateUsing(function (Orders $record): string {
                        return '#'.$record->id;
                    }),
                TextColumn::make('created_at')
                    ->label('Date')
                    ->searchable(),
                TextColumn::make('quantity')
                    ->label('Quantity')
                    ->getStateUsing(function ($record) {
                        return $record->items()->sum('quantity');
                    }),
                TextColumn::make('total')
                    ->label('Total')
                    ->getStateUsing(function ($record) {
                        return 'RM '.$record->total;
                    })
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending'   => 'warning',
                        'paid'      => 'success',
                        'processing'=> 'info',
                        default     => 'gray',
                    })
                    ->searchable(),
            ])
            ->defaultSort('id', 'desc')
            ->actionsColumnLabel('Action')
            ->actions([
                Action::make('view')
                    ->label('')
                    ->icon('heroicon-o-eye')
                    ->color('secondary')
                    ->extraAttributes(['title' => 'View Product'])
                    ->action(function ($record) {
                        return redirect()->to("order/view/{$record->id}");
                    }),
            ])
            ->selectCurrentPageOnly(true);

    }

    public function render()
    {
        return view('livewire.order-list');
    }
}
