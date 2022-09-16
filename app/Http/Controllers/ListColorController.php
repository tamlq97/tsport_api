<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ListColorController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Collection
     */
    public function __invoke(Request $request): Collection
    {
        return Color::all();
    }
}
