<?php

namespace App\Http\Resources\Admin;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

/**
 * @property User $resource
 */
class UserResource extends JsonResource
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'email' => $this->resource->email,
            'active' => $this->resource->active,
            'role' => $this->resource->role,
            'last_login_at' => $this->resource->last_login_at,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
            'can_be_updated' => Auth::user()->canUpdate($this->resource),
            'can_be_impersonated' => Auth::user()->canImpersonate($this->resource),
        ];
    }
}
