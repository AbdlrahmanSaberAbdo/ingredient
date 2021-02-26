<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IngredientResource extends JsonResource
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
            'measure'   => $this->measure,
            'supplier'  => $this->supplier,
            'amount' => $this->when($request->route()->getName() == 'recipes.index' || $request->route()->getName() == 'ordered_ingredients', function (){
                return $this->pivot->amount.$this->measure;
            })
        ];
    }
}
