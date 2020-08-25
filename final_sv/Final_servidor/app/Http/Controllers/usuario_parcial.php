<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;


class usuario_parcial extends Controller
{
    public function index()
  {
    // Devolver� todas las monedas
    $usu = usuario::get();

   return response()->json($usu,200); 

  }
/**
   * Muestra la moneda seleccionada por id.
   * @param $IdCurrency 
   * @return Response
   */
   public function show($Idusu)
   {
     // Devuelve la moneda seleccionada por id.
    // $usu = usuario::find($Idusu);
    // return view('usuarios.show')->with('usuario', $usu);

    $usu = usuario::find($Idusu);


return response()->json($usu,200); 


   }


}


