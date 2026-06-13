<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Department;
use App\Models\Doctor;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'departments' => Department::orderBy('sort_order')->get(),
            'doctors'     => Doctor::with('department')->orderBy('name')->get(),
            'articles'    => Article::latest('published_at')->take(3)->get(),
        ]);
    }
}
