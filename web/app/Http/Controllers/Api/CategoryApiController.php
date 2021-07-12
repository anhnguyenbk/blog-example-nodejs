<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Utils\SlugUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryApiController extends Controller
{
    public function list(Request $request)
    {
        return CategoryResource::collection(Category::orderBy('order', 'asc')
            ->orderBy('id', 'asc')
            ->get());
    }

    public function listHierarchy(Request $request)
    {
        $categoriesGroupBy = Category::orderBy('order', 'asc')
            ->orderBy('id', 'asc')
            ->get()
            ->groupBy('parent_id');
        $parentCategories = $categoriesGroupBy[""];
        foreach ($parentCategories as $c) {
            $this->findHierarchy($categoriesGroupBy, $c);
        }
        return response()->json($parentCategories);

    }

    public function create(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->slug = SlugUtils::toSlug($request->name);
        $category->parent_id = $request->parent_id;
        $category->order = $request->order;
        $category->save();
        return new CategoryResource($category);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->slug = SlugUtils::toSlug($request->name);
        $category->parent_id = $request->parent_id;
        $category->order = $request->order;
        $category->save();
        return new CategoryResource($category);
    }

    public function delete(Request $request, $id)
    {
        Category::where('id', '=', $id)->delete();
        return response()->noContent();
    }

    public function order(Request $request)
    {
        $parent_id = $request->input('id');
        DB::beginTransaction();
        try {
            $ids = [];
            $order = 0;
            foreach ($request->input('children') as $child) {
                $childId = $child['id'];
                Category::where('id', '=', $childId)
                    ->update(['order' => $order, 'parent_id' => $parent_id]);
                $order++;
                array_push($ids, $childId);
            }
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    private function findHierarchy($categoriesGroupBy, $c) {
        $c->children = $categoriesGroupBy[$c->id] ?? [];
        foreach ($c->children as $child) {
            $this->findHierarchy($categoriesGroupBy, $child);
        }
    }
}
