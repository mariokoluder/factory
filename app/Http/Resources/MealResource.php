<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MealResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        
        if($request->diff_time){
            if($this->deleted_at){
                $status = 'deleted';
            } elseif(Carbon::create($this->created_at)->eq(Carbon::create($this->updated_at)) ) {
                $status = 'created';
            } else {
                $status = 'modified';
            }
            
        } else {
            $status = 'created';
        }
        app()->setLocale($request->lang);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $status,
            'category' => $this->when(Str::contains($request->with, 'category'), $this->category ? new CategoryResource($this->category) : null),
            'tags' => $this->when(Str::contains($request->with, 'tags'), TagResource::collection($this->tags)),
            'ingredients' => $this->when(Str::contains($request->with, 'ingredients'), IngredientResource::collection($this->ingredients))
        ];
    }
}
