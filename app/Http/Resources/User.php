<?php

namespace App\Http\Resources\Resources;

use App\Http\Resources\Role as RoleResurce;
use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    public function toArray($request) {
        return [
            'nama' => $this->nama,
            'role' => RoleResource::make($this->role)
        ];
    }
}
