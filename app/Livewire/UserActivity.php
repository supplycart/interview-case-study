<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use OwenIt\Auditing\Models\Audit;
use Illuminate\Support\HtmlString;

class UserActivity extends Component implements HasActions, HasForms, HasTable
{
    use InteractsWithActions;
    use InteractsWithForms;
    use InteractsWithTable;

    public $name;

    public function mount()
    {
        $this->name = auth()->user()->name;
    }

    public function render()
    {
        return view('livewire.user-activity');
    }

    public function table(Table $table):Table
    {
        return $table
            ->heading(fn () => new HtmlString("<span class='text-lg font-semibold'>Log for $this->name</span>"))
            ->description('Here’s a list of user activity for CRUD process.')
            ->query(Audit::query()->where('user_id', auth()->user()->id) )
            ->columns([
                TextColumn::make('created_at')
                    ->label('Date')
                    ->getStateUsing(function ($record) {
                        $date = date('d M Y', strtotime($record->updated_at));

                        return $date;
                    })
                    ->searchable(),
                TextColumn::make('updated_at')
                    ->label('Time')
                    ->getStateUsing(function ($record) {
                        $time = date('g.i A', strtotime($record->updated_at));

                        return $time;
                    })
                    ->searchable(),
                TextColumn::make('event')
                    ->label('Description')
                    ->getStateUsing(function ($record) {
                        if (!empty($record->old_values)) {

                                $allKeys = array_keys($record->new_values);

                                // Join keys into a string
                                $keysString = implode(', ', $allKeys);

                                // Get the class name
                                $modelClassName = class_basename($record->auditable_type);

                                $description = sprintf(
                                    '%s [%d] has %s existing record in %s: %s',
                                    $this->name,
                                    $record->user_id,
                                    $record->event,
                                    $modelClassName,
                                    $keysString,
                                );

                        } else {

                                // Get the first key and value
                                $firstAttributeKey = array_key_first($record->new_values);

                                $firstAttributeValue = $record->new_values[$firstAttributeKey];

                                // Get the class name
                                $modelClassName = class_basename($record->auditable_type);

                                // Set the action type based on event
                                $actionType = ($record->event === 'created') ? 'new' : 'existing';

                                // Restructure the description
                                $description = sprintf(
                                    '%s [%d] has %s a %s %s with %s: %s',
                                    $this->name,
                                    $record->user_id,
                                    $record->event,
                                    $actionType,
                                    $modelClassName,
                                    $firstAttributeKey,
                                    $firstAttributeValue
                                );
                        }

                        return $description;
                    })
                    ->searchable(),

            ])
            ->defaultSort('id', 'desc')
            ->selectCurrentPageOnly(true);
    }
}
