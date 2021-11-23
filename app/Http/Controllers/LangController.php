<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return view('lang');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function change(Request $request)
    {
        // App::setLocale($request->lang);
        // session()->put('locale', $request->lang);
        $user =Auth::user();
        $user->lang = $request->lang;
        $user->save();
        return redirect()->back();
    }
}
