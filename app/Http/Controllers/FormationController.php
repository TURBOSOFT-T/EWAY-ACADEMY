<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Http\Requests\StoreFormationRequest;
use App\Http\Requests\UpdateFormationRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Requests\Front\SearchRequest;
use App\Models\Category;
use App\Models\config;
use Illuminate\Support\Facades\Validator;
class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function formations()
    {
       
        $formations = Formation::all();

        return view('admin.formations.list', compact('formations'));
     
    }

    
    public function formation()
    {
       
        $formations = Formation::all();

        return view('front.formations.index', compact('formations'));
     
    }


    public function details($id){
       $formation =Formation:: findOrFail($id);
       if (!$formation) {
            $message = "Formation non disponible !";
            abort(404, $message);
        }
        $configs= config::all();
        return view('front.formations.details', compact('formation', 'configs'));
       
    }
   

    public function formation_update($id){

        $formation = Formation::find($id);
       if (!$formation) {
            $message = "Actualité non disponible !";
            abort(404, $message);
        } 
     
     //  dd($formation);
        return view('admin.formations.update', compact('formation'));
    }

      
    public function update(Request $request, $id)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
          
           'image' => 'sometimes|required|file|mimetypes:image/*',
            'titre' => 'required|string|max:255',
        //    'category_id' => 'required|integer|exists:categories,id',
              'type' => 'required|in:formation,traduction,etudes',
            

            
        ], [
           
           'titre.required' => 'Le titre est requis.',
           'titre.max' => 'Le titre ne doit pas dépasser 255 caractères.',
        
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

       
        $formation = Formation::findOrFail($id);

      
        if ($request->hasFile('image')) {
       
            if($formation->image ?? ' '){
                Storage::disk('public')->delete($formation->image ?? ' '); 
            }

           
            $path = $request->file('image')->store('formations', 'public');
            $formation->image = $path;
        }

        
        $formation->titre = $request->input('titre');
        $formation->description = $request->input('description');
        $formation->category_id = $request->input('category_id');
         $formation->type = $request->input('type');

      
        $formation->save();

        return redirect()->back()->with('success', 'Formation mise à jour avec succès !');
    
    }
 


   
  public function destroy($id)
    {
     $formation=   Formation::find($id);

     if ($formation) {
        // Supprimer l'image si elle existe
        if($formation->image ?? ' '){
            Storage::disk('public')->delete($formation->image ?? ' '); 
        }

        // Supprimer le formation
        $formation->delete();

     
    return redirect()->back()
    ->with('success', 'formation supprimé avec succès, ainsi que son image.');
    } else {
        return redirect()->back()('error', 'formation non trouvé.');
    }
    }
}
