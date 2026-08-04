<?php
namespace App\Http\Controllers\Back;
use App\Http\Controllers\Controller;
use App\Models\Lecon;
use App\Http\Requests\StoreLeconRequest;
use App\Http\Requests\UpdateLeconRequest;

class LeconController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
   

    public function store(StoreLeconRequest $request)
{
    foreach ($request->lecons as $leconData) {
        Lecon::create([
            'titre' => $leconData['titre'],
            'sous_titre' => $leconData['sous_titre'] ?? null,
            'description' => $leconData['description'] ?? null,
            'cours_id' => $request->cours_id, // si applicable
        ]);
    }

    return redirect()->back()->with('success', 'Les leçons ont été enregistrées.');
}


    /**
     * Display the specified resource.
     */
    public function show(Lecon $lecon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lecon $lecon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLeconRequest $request, Lecon $lecon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy1(Lecon $lecon)
    {
        //
    }

    public function destroy(Lecon $lecon)
{
    $lecon->delete();
    return back()->with('success', 'Leçon supprimée avec succès.');
}

}
