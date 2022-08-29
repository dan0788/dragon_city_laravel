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
        $dragones = ListaDragones::all();
        if($dragones->isEmpty()){
            return $this->successResponse(['error' => 'Empty']);
        };
        return $this->successResponse($dragones);
    }

    public function show($id)
    {
        $dragones = DB::table('dragon_list')->get()->where("id",$id);
        if($dragones->isEmpty()){
            return $this->successResponse(['error' => 'Empty']);
        };
        return $this->successResponse($dragones);
    }

    public function store(Request $request)
    {
        $rules = [
            'dragon' => 'required|max:100',
            'first_element' => 'required|integer',
            'second_element' => 'integer',
            'third_element' => 'integer',
            'fourth_element' => 'integer',
            'created_by' => 'required|integer'
        ];
        $this->validate($request,$rules);
        //$dragones = DB::table('dragon_list')->insert($request->all());//no crea auto ceated_by y updated_by
        $dragones = ListaDragones::create($request->all());//sí crea auto ceated_by y updated_by
        return $this->successResponse($dragones);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'dragon' => 'required|max:100',
            'first_element' => 'required|integer',
            'second_element' => 'integer',
            'third_element' => 'integer',
            'fourth_element' => 'integer',
            'updated_by' => 'required|integer'
        ];
        $this->validate($request,$rules);
        $dragones = ListaDragones::findOrFail($id);
        $dragones->fill($request->all());
        if ($dragones->isClean()) {
            return $this->errorResponse('Al least one value must be changed', Response::HTTP_UNPROCESSABLE_ENTITY);
        };
        $dragones->save();
        return $this->successResponse($dragones);
    }

    public function destroy(Request $request, $id)
    {
        $rules = [
            'deleted_by' => 'required|integer'
        ];
        $this->validate($request,$rules);
        $dragones = ListaDragones::findOrFail($id);
        $dragones->deleted_by = $request->deleted_by;
        $dragones->save();
        $dragones->delete();
        return $this->successResponse($dragones);
    }

    public function destroyAll(Request $request)
    {
        $rules = [
            'deleted_by' => 'required|integer'
        ];
        $this->validate($request,$rules);
        $count = ListaDragones::all()->count()+1;
        for ($i=1; $i <= $count; $i++) {
            $dragones = ListaDragones::all()->first();
            $dragones->deleted_by = $request->deleted_by;
            $dragones->save();
            $dragones->delete();
        }
        return $this->successResponse(200);
    }

}

/*return response()->json([$user],status: 200)
200: correcto
201: recurso creado
401: no autorizado
isJson() verifica si es un archivo Json
$request->json()->all(); obtiene los datos json que le enviamos a laravel, utilizado para post o update
Hash::make($dato); cifra el dato
Hash::check($dato1,$dato2); compara si el dato1 que está cifrado es igual al dato2
str_random(length: 60); genera una cadena de caracteres aleatoria
es común regresar los datos al frontend cuando se acaba de crear el recurso
no se debe guardar datos de sesion en el servidor

$router->group(['middleware' => ['auth']], function() use($router){
    $router->get();//puedo poner todas las rutas que quiera
});
*/
