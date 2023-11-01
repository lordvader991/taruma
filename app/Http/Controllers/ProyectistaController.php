<?php

namespace App\Http\Controllers;
use Kreait\Firebase\Factory;


use Illuminate\Http\Request;

class ProyectistaController extends Controller
{
    public function store(Request $request)
    {
        // Obtén los datos del formulario
        $nombreCompleto = $request->input('nombre_completo');
        $ci = $request->input('ci');
        $email = $request->input('email');
        $telefono = $request->input('telefono');
        $direccion = $request->input('direccion');
        $metrosCuadrados = $request->input('metros_cuadrados');

        // Configura el SDK de Firebase
        $factory = (new Factory)->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')));
        $firestore = $factory->createFirestore();


        // Accede a la colección 'proyectista' y guarda los datos
        $firestore->collection('proyectista')->add([
            'nombre_completo' => $nombreCompleto,
            'ci' => $ci,
            'email' => $email,
            'telefono' => $telefono,
            'direccion' => $direccion,
            'metros_cuadrados' => $metrosCuadrados,
        ]);

        return redirect()->back()->with('success', 'Proyecto creado exitosamente!');
    }
}