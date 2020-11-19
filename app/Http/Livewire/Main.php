<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use App\Models\Product;
use App\Models\OrderProduct;

class Main extends Component
{
    public function render()
    {
        return view('livewire.chart.index');
    }
}
