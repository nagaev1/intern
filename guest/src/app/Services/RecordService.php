<?php

namespace App\Services;

use App\Models\Record;

class RecordService
{
    public function store(string $fullName, string $comment): Record
    {
        $record = Record::create([
            "full_name" => $fullName,
            "comment" => $comment,
        ]);
        return $record;
    }

    public function all()
    {
        return Record::all();
    }

}