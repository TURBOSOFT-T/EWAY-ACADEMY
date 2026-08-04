<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{

    public function events()
{
    $events = Event::all();
    return view('admin.evenements.list', compact('events') );
}

public function evenements(){
    $events = Event::all();
    $lastevents = Event::latest()->take(8)->get();
    return view('front.evenements.evenement', compact('events', 'lastevents') );
}

public function calendar(){
    $events = Event::all();
    return view('admin.evenements.calendar', compact('events') );
}
   
    public function destroy($id)
    {
     $event=   Event::find($id);

     if ($event) {
        // Supprimer l'image si elle existe
        if($event->image ?? ' '){
            Storage::disk('public')->delete($event->image ?? ' '); 
        }

        // Supprimer le event
        $event->delete();

     
    return redirect()->back()
    ->with('success', 'Event supprimé avec succès, ainsi que son image.');
    } else {
        return redirect()->back()('error', 'event non trouvé.');
    }
    }

    
    public function event_update($id){

        $event = Event::find($id);
       if (!$event) {
            $message = "Evènement non disponible !";
            abort(404, $message);
        } 
        $categories = Category::all();
 
        return view('admin.evenements.update', compact('event','categories'));
    }
    public function update(UpdateEventRequest $request, $id)
    {
        // Validation personnalisée
        $validator = Validator::make($request->all(), [
          //  'image' => 'sometimes|file|image|max:2048', // max en kilooctets (2MB)
            'image' => 'sometimes|required|file|mimetypes:image/*',
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|integer|exists:categories,id',
        ], [
            'image.max' => 'La taille de l\'image ne doit pas dépasser 2MB.',
            'titre.required' => 'Le titre est requis.',
            'titre.max' => 'Le titre ne doit pas dépasser 255 caractères.',
        ]);
     //   $categories = Category::findOrFail($validator[('category_id')]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Récupération de l'événement
        $event = Event::findOrFail($id);
        $event->titre = $request->titre;
        $event->description = $request->description;
        $event->category_id = $request->category_id; 
    
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image s'il y en a une
            if ($event->image && Storage::disk('public')->exists($event->image)) {
                Storage::disk('public')->delete($event->image);
            }
    
            // Enregistrer la nouvelle image
            $path = $request->file('image')->store('events', 'public');
            $event->image = $path;
        }
    
      //  $event->save();
      $event->save(); //
     //   $categories->events()->save($event);
    
        return redirect()->back()->with('success', 'Évènement mis à jour avec succès !');
    }
    

}
