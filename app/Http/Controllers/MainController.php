<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

//Para hacer consultas a la base de datos.
use Illuminate\Support\Facades\DB;

class MainController extends BaseController
{
	public function entrar(){
		return view('bienvenido');
	}

	public function accion_mantenedor(Request $request){
		//tipo
		$tipo_consulta = $request->input('tipo_query');
		//id_usuario
		$id_user = $request->input('id_usuario');
		//datos generales
		$nombre_user = $request->input('name_user');
		$ape_user = $request->input('apellido_user');
		$fono_user = $request->input('fono_user');

		switch ($tipo_consulta) {
			case '1':
				//VISTA
				$all_user = DB::table('usuario')
				->where('estado', '1')
				->get();

				$count_user = DB::table('usuario')
				->where('estado', '1')
				->count();

				$arreglo = array('usuarios' => $all_user, 'cantidad_usuarios' => $count_user);
				$arr_json = json_encode($arreglo);
				return $arr_json;

				break;

			case '2':
				//BUSQUEDA POR ID DE USUARIO
				$all_id_user = DB::table('usuario')
				->where('id', $id_user)
				->get();

				$arreglo = array('datos_user' => $all_id_user);
				$arr_json = json_encode($arreglo);
				return $arr_json;

				break;

			case '3':
				//CREAR
                $go = DB::table('usuario')
                ->insertGetId([
                'nombre' => $nombre_user,
                'apellido' => $ape_user,
                'fono' => $fono_user,
                'estado' => '1'
                ]);
                return $go;
     
				break;

			case '4':
				//MODIFICAR
                DB::table('usuario')
                ->where('id', $id_user)
                ->update([
                'nombre' => $nombre_user,
                'apellido' => $ape_user,
                'fono' => $fono_user
                ]);
                return "1";

				break;

			case '5':
				//DESHABILITAR
				DB::table('usuario')
                ->where('id', $id_user)
                ->update([
                'estado' => '0'
                ]);
                return "1";

				break;
		}
	}
}
