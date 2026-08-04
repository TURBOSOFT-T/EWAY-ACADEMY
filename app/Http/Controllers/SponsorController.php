<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSponsorRequest;
use App\Http\Requests\UpdateSponsorRequest;

use Illuminate\Support\Facades\Validator;

class SponsorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function sponsors()
    {
    
        $sponsors = Sponsor::all();
        return view('admin.sponsors.list' , compact('sponsors') );
    }

 
 


     public function destroy($id)
     {
        $sponsor = Sponsor::find($id);

        if ($sponsor) {
            // Supprimer l'image si elle existe
            if($sponsor->image ?? ''){
                Storage::disk('public')->delete($sponsor->image ??' '); 
            }

            // Supprimer le sponsor
            $sponsor->delete();

         
        return redirect()->back()
        ->with('success', 'Sponsor supprimé avec succès, ainsi que son image.');
        } else {
            return redirect()->back()('error', 'Sponsor non trouvé.');
        }
     }


     public function sponsor_update($id){

          $sponsor = Sponsor::find($id);
         if (!$sponsor) {
              $message = "Sponsor non disponible !";
              abort(404, $message);
          } 
          
         // dd($sponsor);
          return view('admin.sponsors.update', compact('sponsor'));
      }


      
      public function update(Request $request, $id)
      {
          // Validation des données
          $validator = Validator::make($request->all(), [
             
              'image' => 'sometimes|required|file|mimetypes:image/*',
              'titre' => 'required|string|max:255',
              'email' => 'required|email',
              'telephone' => 'nullable|string|max:20',
              'adresse' => 'nullable|string|max:255',
              'description' => 'nullable|string',
          ], [
            
             'titre.required' => 'Le titre est requis.',
             'titre.max' => 'Le titre ne doit pas dépasser 255 caractères.',
             'email.required' => 'L\'email est requis.',
             'email.email' => 'L\'email n\'est pas valide.',
             'telephone.max' => 'Le numéro de téléphone ne doit pas dépasser 20 caract',
          ]);
  
          if ($validator->fails()) {
              return redirect()->back()->withErrors($validator)->withInput();
          }
  
          // Trouver le sponsor
          $sponsor = Sponsor::findOrFail($id);
  
          // Traitement de l'image
          if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe dans le disque public
            if ($sponsor->image && Storage::disk('public')->exists($sponsor->image)) {
                Storage::disk('public')->delete($sponsor->image);
            }
        
            // Enregistrer la nouvelle image
            $path = $request->file('image')->store('sponsors', 'public');
            $sponsor->image = $path;
        }
        
  
          // Mettre à jour les autres champs
          $sponsor->titre = $request->input('titre');
          $sponsor->email = $request->input('email');
          $sponsor->telephone = $request->input('telephone');
          $sponsor->adresse = $request->input('adresse');
          $sponsor->description = $request->input('description');
  
          // Sauvegarder les modifications
          $sponsor->save();
  
          // Rediriger avec un message de succès
          return redirect()->back()->with('success', 'Sponsor mis à jour avec succès !');
       // return redirect()->route('sponsors')->with('success', 'Sponsor mis à jour avec succès!');
      }
  }

