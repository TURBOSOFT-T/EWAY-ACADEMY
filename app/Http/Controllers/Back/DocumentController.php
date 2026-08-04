<?php
namespace App\Http\Controllers\Back;
use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
   

public function store(Request $request)
{
    $request->validate([
        'type' => 'required|in:formation,event,certification',
        'titre' => 'required|string',
        'file' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        'formation_id' => 'nullable|exists:formations,id',
        'event_id' => 'nullable|exists:events,id',
        'certification_id' => 'nullable|exists:certifications,id',
    ]);

    $document = new Document();
    $document->user_id = auth()->id();
    $document->titre = $request->titre;
    $document->description = $request->description;
    $document->type = $request->type;
   //  $document->file = $request->file->store('documents', 'public');

    // Gestion des types
    if ($request->type === 'formation') {
        $document->formation_id = $request->formation_id;
        $document->event_id = null;
        $document->certification_id = null;
    } elseif ($request->type === 'event') {
        $document->event_id = $request->event_id;
        $document->formation_id = null;
        $document->certification_id = null;
    } elseif ($request->type === 'certification') {
        $document->certification_id = $request->certification_id;
        $document->formation_id = null;
        $document->event_id = null;
    }

  // ✅ Gestion de l'upload
    if ($request->hasFile('file')) {
        $path = $request->file('file')->store('documents', 'public');
        $document->file = $path; // On stocke le chemin complet
    }
    $document->save();

    return back()->with('ok', __('The Document has been successfully created.'));
}

public function store1(Request $request)
{
    $request->validate([
        'type' => 'required|in:formation,event,certification',
        'titre' => 'required|string',
      //  'filename' =>'nullable|file',
     //  'file' => 'nullable|file|mimes:pdf,doc,docx',
       'file' => 'nullable|file|mimes:pdf,doc,docx|max:5120', // 5120 = 5 Mo

        'formation_id' => 'nullable|exists:formations,id',
        'event_id' => 'nullable|exists:events,id',
        'certification_id' => 'nullable|exists:certifications,id',
    ]);

    

    $document = new Document();
    $document->user_id = auth()->id();
  
    $document->titre = $request->titre;
    $document->description = $request->description;

  // $document->filename = $request->filename;
  
    $document->type = $request->type;

    // Gestion des types
    if ($request->type === 'formation') {
        $document->formation_id = $request->formation_id;
        $document->event_id = null;
        $document->certification_id = null;
    } elseif ($request->type === 'event') {
        $document->event_id = $request->event_id;
        $document->formation_id = null;
        $document->certification_id = null;
    } elseif ($request->type === 'certification') {
        $document->certification_id = $request->certification_id;
        $document->formation_id = null;
        $document->event_id = null;
    }

  
 
    $document->save();

  
    return back()->with('ok', __('The Document has been successfully created.'));
}
    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */


     
public function edit($id)
{
    $document = Document::findOrFail($id);
    return view('documents.edit', compact('document'));
}

public function update(UpdateDocumentRequest $request, $id)
{
    // Validation des données
    $request->validate([
        'titre' => 'required|string|max:255',
        'fichier' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // Validation pour un fichier (optionnel)
        'cours_id' => 'nullable|exists:cours,id', // Validation du cours
    ]);

    // Trouver le document par ID
    $document = Document::findOrFail($id);

    // Si un nouveau fichier a été téléchargé, on le supprime de la storage et on le remplace
    if ($request->hasFile('fichier')) {
        // Supprimer l'ancien fichier si il existe
        if ($document->fichier && Storage::exists($document->fichier)) {
            Storage::delete($document->fichier);
        }

        // Gérer l'upload du fichier
        $fichier = $request->file('fichier');
        $fichierPath = $fichier->store('documents'); // Stockage dans le dossier 'documents'
    } else {
        // Si aucun fichier n'est téléchargé, conserver l'ancien fichier
        $fichierPath = $document->fichier;
    }

    // Mettre à jour le document avec les nouvelles données
    $document->update([
        'titre' => $request->titre,
        'fichier' => $fichierPath,
        'cours_id' => $request->cours_id, // Si applicable
    ]);

    return redirect()->route('documents.index')->with('success', 'Document mis à jour avec succès.');
}
    public function edit1(Document $document)
    {
        //
    }


    
public function destroy($id)
{
    // Trouver le document par ID
    $document = Document::findOrFail($id);

    // Supprimer le fichier du système de fichiers (si le fichier existe)
    if ($document->fichier && Storage::exists($document->fichier)) {
        Storage::delete($document->fichier);
    }

    // Supprimer le document de la base de données
    $document->delete();

    return redirect()->back()->with('success', 'Document supprimé avec succès.');
}



}
