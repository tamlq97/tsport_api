<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DeleteManyProductController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $items = $request->validate(['items' => 'array|required']);
        $ids = [];
        foreach ($items['items'] as $key => $i) {
            $ids[] = $i['id'];
        }
        Product::destroy($ids);
        return response()->json(['message' => 'Successfully delete items.']);
    }
}
