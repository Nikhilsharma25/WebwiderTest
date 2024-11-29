<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;


class DashboardController extends Controller
{

    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $postData =  Post::with(['user', 'category'])->where('status', 1)->get();
        return view('dashboard', compact('postData'));
    }



    public function getPostsData(Request $request)
    {
        $postsData = Post::with(['user', 'category'])->where('status', 1) 
            ->where(function ($query) use ($request) {
                if ($request->search) {
                    $query->where('name', 'LIKE', "%{$request->search}%")
                        ->orWhereHas('user', function ($q) use ($request) {
                            $q->where('name', 'LIKE', "%{$request->search}%");
                        })
                        ->orWhereHas('category', function ($q) use ($request) {
                            $q->where('name', 'LIKE', "%{$request->search}%");
                        });
                }
            })
            ->get();  
        return response()->json($postsData);
    }
}
