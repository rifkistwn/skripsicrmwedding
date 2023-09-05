<?php

namespace App\Services;

use App\Models\Code;
use App\Models\QrcodeTemporary;
use Carbon\Carbon;

class GenerateService
{
    // public function create($code)
    public function create($code, $name, $phone, $email)
    {
        return Code::insert([
            'code' => $code,
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id
        ]);
    }

    public function createTemporary($code)
    {
        QrcodeTemporary::insert([
            'code' => $code
        ]);
    }

    public function deleteTemporary()
    {
        QrcodeTemporary::query()->delete();
    }
}
