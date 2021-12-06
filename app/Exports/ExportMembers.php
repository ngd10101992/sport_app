<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Models\Member;

class ExportMembers implements FromQuery {

    use Exportable;

    public function __construct($teamId) {
        $this->teamId = $teamId;
    }

    // public function collection() {
    //     return Member::all();
    // }

    public function query() {
        return Member::query()->where('team_id', $this->teamId)->select('name', 'age', 'number', 'position');
    }
}
