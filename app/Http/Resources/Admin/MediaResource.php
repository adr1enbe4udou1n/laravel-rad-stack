<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @property Media $resource
 */
class MediaResource extends JsonResource
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
        return $this->resource->only('uuid', 'name', 'custom_properties', 'size') + [
            'order' => $this->resource->order_column,
            'preview_url' => $this->resource->getUrl('preview'),
            'original_url' => $this->resource->getUrl(),
            'extension' => $this->resource->getExtensionAttribute(),
        ];
    }
}
