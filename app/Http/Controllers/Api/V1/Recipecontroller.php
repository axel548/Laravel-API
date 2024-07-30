<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Foundation\Auth\AuthorizeRequests;
use Illuminate\Foundation\Auth\ValidatesRequest;
use Illuminate\Routing\Controller as BaseController;

use App\Http\Resources\RecipeResource;
use App\Models\Recipe;
use Illuminate\Http\Request;

use App\Http\Resources\TagResource;
use Symfony\Component\HttpFoundation\Response;


use App\Http\Requests\StoreRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;

class Recipecontroller extends BaseController
{
    public function index(){
        $recipes = Recipe::with('category', 'tags', 'user')->get();
        return RecipeResource::collection($recipes);
    }

    public function store(StoreRecipeRequest $request) {

        $recipe = $request->user()->recipes()->create($request->all());
        $recipe->tags()->attach(json_decode($request->tags));

        if ($request->file('image')) {
            $recipe->image = $request->file('image')->store('recipes', 'public');
            $recipe->save();
        }


        return response()->json(new RecipeResource($recipe), Response::HTTP_CREATED); // HTTP 201
    }

    public function show(Recipe $recipe){
        return new RecipeResource($recipe->load('category', 'tags', 'user'));
    }

    public function update(UpdateRecipeRequest $request, Recipe $recipe) {

        $this->authorize('update', $recipe);

        $recipe->update($request->all());

        if ($tags = json_decode($request->tags)) {
            $recipe->tags()->sync($tags);
        }

        return response()->json(new RecipeResource($recipe), Response::HTTP_OK); // HTTP 200
    }

    public function destroy(Recipe $recipe) {

        $this->authorize('delete', $recipe);

        $recipe->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT); // HTTP 204
    }
}
