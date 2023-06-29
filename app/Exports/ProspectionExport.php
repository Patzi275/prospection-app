<?php

namespace App\Exports;

use App\Models\Prospection;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProspectionExport implements FromCollection
{
    protected $first_date;
    protected $last_date;

    public function __constructor($first_date, $last_date) {
        $this->first_date = $first_date;
        $this->last_date = $last_date;
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = Prospection::query();
        if ($this->first_date && $this->last_date) {
            $query->whereBetween('date', [$this->first_date, $this->last_date]);
        }

        $query->where('is_sold', '!=', 0);
        $prospections = $query->orderBy('date', 'desc');

        return $prospections->get();
    }
}
