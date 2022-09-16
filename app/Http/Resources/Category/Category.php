<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Category extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'parent_id' => $this->parent_id,
            'children' => SubCategory::collection($this->cateChildren),
            'slug' => $this->slug
            // 'descendants' => $this->descendants,
            // 'ancestors' => $this->ancestors,
            // 'ancestorsOf' => Category::ancestorsOf($this->id),
            // 'ancestorsAndSelf' => Category::ancestorsAndSelf($this->id),
            // 'descendantsOf' => Category::descendantsOf($this->id),
            // 'descendantsAndSelf' => Category::descendantsAndSelf($this->id),

        ];
    }
}
