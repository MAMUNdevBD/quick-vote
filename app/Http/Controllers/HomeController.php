<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poll;



class HomeController extends Controller
{
/**
 * Display a listing of the polls.
 */
public function index()
{
    $polls = Poll::where('is_active', true)->get();
    return view('welcome', compact('polls'));
}
}
