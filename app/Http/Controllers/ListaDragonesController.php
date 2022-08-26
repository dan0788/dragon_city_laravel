<?php

namespace App\Http\Controllers;

use App\Models\ListaDragones;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ListaDragonesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        $dragones = DB::select("select * from lista_dragones");
        return $this->successResponse($dragones);
    }

    public function show($id)
    {
        # code...
    }

    public function store(Request $request)
    {
        # code...
    }

    public function update(Request $request, $id)
    {
        # code...
    }

    public function destroy(Request $request, $id)
    {
        # code...
    }
}
