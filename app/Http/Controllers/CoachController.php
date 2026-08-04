<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use App\Http\Requests\StoreCoachRequest;
use App\Http\Requests\UpdateCoachRequest;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CoachController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     
    public function coachs()
    {
        $coachs = Coach::all();
        return view('admin.coachs.list', compact('coachs') );
    }
    public function coach_update($id){

        $coach = Coach::find($id);
       if (!$coach) {
            $message = "Coach non disponible !";
            abort(404, $message);
        } 
        
       // dd($coach);
        return view('admin.coachs.update', compact('coach'));
    }

    public function update(Request $request, $id)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:coaches,email,'.$id,
            'phone' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Trouver le coach
        $coach = Coach::findOrFail($id);
    
        // Traitement de la photo
        if ($request->hasFile('photo')) {
            // Supprimer l'ancienne photo si nécessaire
            if ($coach->photo) {
                Storage::delete($coach->photo);
            }
    
            // Stocker la nouvelle photo
            $path = $request->file('photo')->store('coachs', 'public');
            $coach->photo = $path;
        }
    
        // Mise à jour des autres champs
        $coach->nom = $request->input('nom');
        $coach->prenom = $request->input('prenom');
        $coach->email = $request->input('email');
        $coach->phone = $request->input('phone');
        $coach->adresse = $request->input('adresse');
        $coach->save();
    
        return redirect()->back()->with('success', 'Coach mis à jour avec succès !');
    }
    



  
   
    public function destroy($id)
    {
       $coach = Coach::find($id);

       if ($coach) {
           // Supprimer l'photo si elle existe
           if($coach->photo ?? ''){
               Storage::disk('public')->delete($coach->photo ??' '); 
           }

           // Supprimer le coach
           $coach->delete();

        
       return redirect()->back()
       ->with('success', 'coach supprimé avec succès, ainsi que son photo.');
       } else {
           return redirect()->back()('error', 'coach non trouvé.');
       }
    }
}
