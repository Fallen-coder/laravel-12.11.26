<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function search(Request $request)
{
    return Tag::where('name', 'like', $request->q . '%')->pluck('name');
}
}
