<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property User $resource
 */
class AuthResource extends JsonResource
{
    public static $wrap = false;

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return $this->resource
            ->only(['id', 'name', 'email']) + [
                'is_impersonating' => $this->resource->isImpersonating(),
            ];
    }
}
