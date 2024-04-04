<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Mary\Traits\Toast;

class Welcome extends Component
{
    use Toast;

    public string $search = '';

    public bool $drawer = false;

//    public $contractOne_chart = $this->getChartData();
    public $chartOne = [];
    public $chartTwo = [];
    public $chartThree = [];
    public $chartFour = [];
//    public array $chart =   $this->getChartData();
    /* [
        'type' => 'pie',
        'data' => [
            'labels' => ['Approved', 'Rejected', 'Undefined'],
            'datasets' => [
                [
                    'label' => 'Contracts Status',
                    'data' => [$this->getChartData()],
//                    'data' => [1,4,2],
                ]
            ]
        ]
    ];*/
    public function mount()
    {
        $this->chartOne = $this->getChartData('contract_ones');
        $this->chartTwo = $this->getChartData('contract_twos');
        $this->chartThree = $this->getChartData('contract_threes');
        $this->chartFour = $this->getChartData('contract_fours');
    }
    public function getChartData($table):array
    {
        $contractOne = DB::table($table)
            ->select(DB::raw('SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) as active_count'),
                DB::raw('SUM(CASE WHEN status = 0 THEN 1 ELSE 0 END) as inactive_count'),
                DB::raw('SUM(CASE WHEN status IS NULL THEN 1 ELSE 0 END) as null_count'))
            ->first();

        return ['type' => 'doughnut',
            'data' => [
                'labels' => ['Approved', 'Rejected', 'Undefined'],
                'datasets' => [
                    [
                        'label' => 'Contracts Status',
                        'data' => [(int)$contractOne->active_count,
                            (int)$contractOne->inactive_count,
                            (int)$contractOne->null_count],
                    ]
                ]
            ]
        ];
//        dd($contractOne);
    }


    public array $myChart = [
        'type' => 'pie',
        'data' => [
            'labels' => ['Approved', 'Rejected', 'Undefined'],
            'datasets' => [
                [
                    'label' => 'Contracts Status',
                    'data' => [0, 0, 0],
                ]
            ]
        ]
    ];


    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];

    // Clear filters
    public function clear(): void
    {
        $this->reset();
        $this->success('Filters cleared.', position: 'toast-bottom');
    }

    // Delete action
    public function delete($id): void
    {
        $this->warning("Will delete #$id", 'It is fake.', position: 'toast-bottom');
    }

    // Table headers
    public function headers(): array
    {
        return [
            ['key' => 'id', 'label' => '#', 'class' => 'w-1'],
            ['key' => 'name', 'label' => 'Name', 'class' => 'w-64'],
            ['key' => 'age', 'label' => 'Age', 'class' => 'w-20'],
            ['key' => 'email', 'label' => 'E-mail', 'sortable' => false],
        ];
    }

    /**
     * For demo purpose, this is a static collection.
     *
     * On real projects you do it with Eloquent collections.
     * Please, refer to maryUI docs to see the eloquent examples.
     */
    public function users(): Collection
    {
        return collect([
            ['id' => 1, 'name' => 'Mary', 'email' => 'mary@mary-ui.com', 'age' => 23],
            ['id' => 2, 'name' => 'Giovanna', 'email' => 'giovanna@mary-ui.com', 'age' => 7],
            ['id' => 3, 'name' => 'Marina', 'email' => 'marina@mary-ui.com', 'age' => 5],
        ])
            ->sortBy([[...array_values($this->sortBy)]])
            ->when($this->search, function (Collection $collection) {
                return $collection->filter(fn(array $item) => str($item['name'])->contains($this->search, true));
            });
    }

    public function render()
    {
        return view('livewire.welcome', [
            'users' => $this->users(),
            'headers' => $this->headers()
        ]);
    }
}
