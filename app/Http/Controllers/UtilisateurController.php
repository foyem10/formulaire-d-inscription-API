<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UtilisateurController extends Controller
{
    public function store(Request $request)
    {
        // Validation côté serveur (obligatoire même si React valide déjà)
        $validator = Validator::make($request->all(), [
            'nom'        => 'required|string|max:255',
            'age'        => 'required|date',
            'lieu'       => 'required|string|max:255',
            'tel'        => 'required|string|max:20',
            'email'      => 'required|email|unique:utilisateurs,email',
            'profession' => 'required|string|max:255',
            'residence'  => 'required|string|max:255',
            'password'   => 'required|string|min:8|confirmed', // "confirmed" attend password_confirmation
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        $utilisateur = Utilisateur::create([
            'nom'        => $request->nom,
            'age'        => $request->age,
            'lieu'       => $request->lieu,
            'tel'        => $request->tel,
            'email'      => $request->email,
            'profession' => $request->profession,
            'residence'  => $request->residence,
            'password'   => Hash::make($request->password), // hashage obligatoire
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Compte créé avec succès',
            'data'    => $utilisateur,
        ], 201);
    }
}


