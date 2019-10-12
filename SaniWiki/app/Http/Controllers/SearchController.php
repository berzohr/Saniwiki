<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SectionsPosts;

class SearchController extends Controller
{
    public function search (Request $request) {
        if ($request->has('search')) {
            $sectionsposts = SectionsPosts::where('body', 'like', '%' . $request->get('search') . '%')->get();
        } else {
            $sectionsposts = SectionsPosts::get();
        }
        return view ('search', compact('sectionsposts'));
    }
}
