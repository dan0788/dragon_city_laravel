<?php

namespace App\Http\Controllers;

use App\Models\Elements;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ElementsController extends Controller
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
        $elements = Elements::all('id','name');
        if($elements->isEmpty()){
            return $this->successResponse(['error' => 'Empty']);
        };
        return $this->successResponse($elements);
    }

    public function show($id)
    {
        $elements = DB::table('elements')->get()->where("id",$id);
        if($elements->isEmpty()){
            return $this->successResponse(['error' => 'Empty']);
        };
        return $this->successResponse($elements);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:100',
            'created_by' => 'required|integer'
        ];
        $this->validate($request,$rules);
        //$elements = DB::table('dragon_list')->insert($request->all());//no crea auto ceated_by y updated_by
        $elements = Elements::create($request->all());//sí crea auto ceated_by y updated_by
        return $this->successResponse($elements);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|max:100',
            'updated_by' => 'required|integer'
        ];
        $this->validate($request,$rules);
        $elements = Elements::findOrFail($id);
        $elements->fill($request->all());
        if ($elements->isClean()) {
            return $this->errorResponse('Al least one value must be changed', Response::HTTP_UNPROCESSABLE_ENTITY);
        };
        $elements->save();
        return $this->successResponse($elements);
    }

    public function destroy(Request $request, $id)
    {
        $rules = [
            'deleted_by' => 'required|integer'
        ];
        $this->validate($request,$rules);
        $elements = Elements::findOrFail($id);
        $elements->deleted_by = $request->deleted_by;
        $elements->save();
        $elements->delete();
        return $this->successResponse($elements);
    }

    public function destroyAll(Request $request)
    {
        $rules = [
            'deleted_by' => 'required|integer'
        ];
        $this->validate($request,$rules);
        $count = Elements::all()->count()+1;
        for ($i=1; $i <= $count; $i++) {
            $elements = Elements::all()->first();
            $elements->deleted_by = $request->deleted_by;
            $elements->save();
            $elements->delete();
        }
        return $this->successResponse(200);
    }

}

/*
1	"Tierra"
2	"Natura"
3	"Viento"
4	"Primario"
5	"Fuego"
6	"Puro"
7	"Agua"
8	"Luz"
9	"Hielo"
10	"Bélico"
11	"Eléctrico"
12	"Leyenda"
13	"Metal"
14	"Oscuro"
15	"Belleza"
16	"Magia"
17	"Caos"
18	"Felicidad"
19	"Sueño"
20	"Alma"
21	"Tiempo"
*/

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
