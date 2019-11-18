<?php

namespace App\Http\Resources;

use App\Http\Resources\User as UserResurce;
use Illuminate\Http\Resources\Json\JsonResource;

class Role extends JsonResource
{
    public function toArray($request) {
        return [
            'jabatan' => $this->jabatan,
        ];
    }
}
