<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\School\CreateSchoolRequest;
use App\Models\School;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return response()->json([
                'status' => true,
                'status_code' => 200,
                'message' => 'Voici la listes de écoles:',
                'data' => School::all()
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'status_code' => 500,
                'message' => 'Erreur interne du serveur',
                'errors' => $e->getMessage()
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateSchoolRequest $request)
    {
        try {
            // $request->validate([
            //     'school_name' => ['required', 'string', 'max:255'],
            //     'phone' => ['required', 'integer', 'max:14'],
            //     'mobile' => ['required', 'integer', 'max:14'],
            //     'email' => ['required', 'string', 'email', 'max:55'],
            //     'address' => ['required', 'string', 'max:255'],
            //     'website' => ['required', 'string', 'max:255'],
            // ]);
            $school = new School;

            $school->school_name = $request->school_name;
            $school->phone = $request->phone;
            $school->mobile = $request->mobile;
            $school->email = $request->email;
            $school->address = $request->address;
            $school->website = $request->website;

            $school->save();

            return response()->json([
                'status' => true,
                'statut_code' => 201,
                'message' => 'Ecole enregistré avec succès.',
                'data' => $school
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'statut_code' => 500,
                'message' => 'Ecole non enregistré.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $school = School::find($id);
            // dd($school);
            return response()->json([
                'status' => true,
                'statut code' => 200,
                'message' => "Voici l'école.",
                'data'  => $school,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'statut_code' => 404,
                'message' => "Cet école n'existe pas."
            ],  404);
            return response()->json([
                "status" => false,
                "status_code" => 500,
                "message" => "Une erreur est survenue.",
                "error"   => $e->getMessage()
            ],   500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $school = School::find($id);
            if ($school === null) {
                return response()->json([
                    "status" => false,
                    "statut_code" => 404,
                    "message" => "Cet école n'existe pas.",
                ],  404);
            } else {

                $school->school_name = $request->school_name;
                $school->phone = $request->phone;
                $school->mobile = $request->mobile;
                $school->email = $request->email;
                $school->address = $request->address;
                $school->website = $request->website;

                $school->update();

                return response()->json([
                    'status' => true,
                    'statut_code' => 200,
                    'statut_message' => 'Informations école modifiées avec succès',
                    'data' => $school,
                ],   200);
            }
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "status_code" => 500,
                "message" => "Une erreur est survenue.",
                "error"   => $e->getMessage()
            ],   500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $school = School::find($id);

            if ($school === null) {
                return response()->json([
                    'status' => false,
                    'statut_code' => 404,
                    'statut_message' => 'Cet école n\'existe pas',
                ],   404);
            } else {

                $school->delete();

                return response()->json([
                    'status' => true,
                    'statut_code' => 200,
                    'statut_message' => 'Cet école a été supprimée avec succès',
                    'data' => $school,
                ],    200);
            }
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "status_code" => 500,
                "message" => "Une erreur est survenue.",
                "error"   => $e->getMessage()
            ],    500);
        }
    }
}
