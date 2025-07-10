<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class GraduateThesis implements iRadio
{
    public $work_name;
    public $work_text;
    public $work_link;
    public $identification_number;

    public function __construct($data = [])
    {
        $this->work_name = $data['work_name'] ?? null;
        $this->work_text = $data['work_text'] ?? null;
        $this->work_link = $data['work_link'] ?? null;
        $this->identification_number = $data['identification_number'] ?? null;
    }

    public function create($data)
    {
        return new GraduateThesis($data);
    }

    public function save()
    {
        DB::table('graduate_theses')->insert([
            'work_name' => $this->work_name,
            'work_text' => $this->work_text,
            'work_link' => $this->work_link,
            'identification_number' => $this->identification_number,
        ]);
    }

    public function read()
    {
        return DB::table('graduate_theses')->get();
    }
} 