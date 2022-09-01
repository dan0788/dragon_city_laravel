<?php

namespace App\Http\Controllers;

use App\Models\ListaDragones;
use App\Models\Atributte_1;
use App\Models\Atributte_2;
use App\Models\Atributte_3;
use App\Models\Atributte_4;
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
        $atributte_1 = DB::table('dragon_list')->get()->where("id",$id);
        if($atributte_1->isEmpty()){
            return $this->successResponse(['error' => 'Empty']);
        };
        return $this->successResponse($atributte_1);
    }

    public function store(Request $request)
    {
        $rules = [
            'dragon' => 'required|max:100',
            'first_element' => 'required|integer',
            'second_element' => 'required|integer',
            'third_element' => 'required|integer',
            'fourth_element' => 'required|integer',
            'created_by' => 'required|integer'
        ];
        $this->validate($request,$rules);
        $atributte_1 = Atributte_1::create(['element_id' => $request['first_element']]);
        $atributte_2 = Atributte_2::create(['element_id' => $request['second_element']]);
        $atributte_3 = Atributte_3::create(['element_id' => $request['third_element']]);
        $atributte_4 = Atributte_4::create(['element_id' => $request['fourth_element']]);
        $count_atributte_1 = DB::select("select currval('atributte_1_id_seq')");
        $count_atributte_2 = DB::select("select currval('atributte_2_id_seq')");
        $count_atributte_3 = DB::select("select currval('atributte_3_id_seq')");
        $count_atributte_4 = DB::select("select currval('atributte_4_id_seq')");
        if( $count_atributte_1 == $count_atributte_2 && $count_atributte_1 == $count_atributte_3 &&
            $count_atributte_1 == $count_atributte_4 && $count_atributte_2 == $count_atributte_3 &&
            $count_atributte_2 == $count_atributte_4 && $count_atributte_3 == $count_atributte_4 ){
            $atributte_1 = Atributte_1::findOrFail($count_atributte_1);
            $atributte_2 = Atributte_2::findOrFail($count_atributte_2);
            $atributte_3 = Atributte_3::findOrFail($count_atributte_3);
            $atributte_4 = Atributte_4::findOrFail($count_atributte_4);
            /*$atributte_list = [
                'dragon' => $request['dragon'],
                'first_element' => 'required|integer',
                'second_element' => 'integer',
                'third_element' => 'integer',
                'fourth_element' => 'integer',
                'created_by' => 'required|integer'
            ];*/
        } else {
            return $this->successResponse(['error' => 'empty']);
        }
        //$dragones = ListaDragones::create($request->all());//sí crea auto ceated_by y updated_by
        //return $this->successResponse($dragones);
        return $atributte_1;
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'element_id' => 'required|integer'
        ];
        /*$rules = [
            'dragon' => 'required|max:100',
            'first_element' => 'required|integer',
            'second_element' => 'integer',
            'third_element' => 'integer',
            'fourth_element' => 'integer',
            'updated_by' => 'required|integer'
        ];*/
        $this->validate($request,$rules);
        $atributte_1 = ListaDragones::findOrFail($id);
        $atributte_1->fill($request->all());
        if ($atributte_1->isClean()) {
            return $this->errorResponse('Al least one value must be changed', Response::HTTP_UNPROCESSABLE_ENTITY);
        };
        $atributte_1->save();
        return $this->successResponse($atributte_1);
    }

    public function destroy(Request $request, $id)
    {
        $rules = [
            'deleted_by' => 'required|integer'
        ];
        $this->validate($request,$rules);
        $atributte_1 = ListaDragones::findOrFail($id);
        $atributte_1->deleted_by = $request->deleted_by;
        $atributte_1->save();
        $atributte_1->delete();
        return $this->successResponse($atributte_1);
    }

    public function destroyAll(Request $request)
    {
        $rules = [
            'deleted_by' => 'required|integer'
        ];
        $this->validate($request,$rules);
        $count = ListaDragones::all()->count()+1;
        for ($i=1; $i <= $count; $i++) {
            $atributte_1 = ListaDragones::all()->first();
            $atributte_1->deleted_by = $request->deleted_by;
            $atributte_1->save();
            $atributte_1->delete();
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
