<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'description'   => $this->description,
            'ingredients' => $this->when($request->route()->getName() == 'recipes.index' || $request->route()->getName() == 'ordered_ingredients', function (){
                return IngredientResource::collection($this->ingredients);
            })
        ];
    }
}
