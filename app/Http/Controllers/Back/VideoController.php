<?php

namespace App\Http\Controllers\Back;
use App\Http\Controllers\Controller;

use App\Models\Video;
use App\Models\VideoView;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;



use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
public function incrementView(Request $request, $id)
    {
        $video = Video::findOrFail($id);

        $ipAddress = $request->ip();

        // Vérifier si cette IP a déjà vu la vidéo
        $alreadyViewed = VideoView::where('video_id', $video->id)
                                ->where('ip_address', $ipAddress)
                                ->exists();

        if (!$alreadyViewed) {
            // Créer l'entrée de vue et incrémenter compteur
            VideoView::create([
                'video_id' => $video->id,
                'ip_address' => $ipAddress,
            ]);

            $video->increment('views');
            $video->refresh();
        }

        return response()->json([
            'success' => true,
            'views' => $video->views,
            'already_viewed' => $alreadyViewed,
        ]);
    
    }

    public function videos()
    {
        $videos = Video::all();
        return view('admin.videos.list', compact('videos'));
    }

    public function video_update($id)
    {

        $video = Video::find($id);
        if (!$video) {
            $message = "video non disponible !";
            abort(404, $message);
        }

        //   dd($video);
        return view('admin.videos.update', compact('video'));
    }

   

    public function play($id)
    {
        $video = Video::find($id);

        VideoView::create([
            'video_id' => $video->id,
            'ip_address' => request()->ip(),
        ]);
        $video->increment('views');

        return view('video.play', compact('video'));
    }


    public function incrementViewCount($id)
    {
        $video = Video::findOrFail($id);
        $video->views += 1;
        $video->save();

        return response()->json(['views' => $video->views]);
    }

public function uploadVideo(Request $request)
{
    // Validation conditionnelle selon le type d'entrée

      ini_set('max_execution_time', 3000); // 50 minutes
    ini_set('memory_limit', '2048M');

    $rules = [
        'titre' => 'required|string|max:255',
        'description' => 'nullable|string|max:255',
        'image' => 'sometimes|required|file|mimetypes:image/*',
        'is_file_upload' => 'required|boolean',
    ];

    if ($request->boolean('is_file_upload')) {
        $rules['video'] = 'required|file|mimetypes:video/*';
    } else {
        $rules['path'] = 'required|url';
    }

    $this->validate($request, $rules);

    // Upload de l'image sur Cloudinary
    $cloudinaryImage = $request->file('image')->storeOnCloudinary('videos');
    $url = $cloudinaryImage->getSecurePath();
    $public_id = $cloudinaryImage->getPublicId();

    $userId = Auth::id();

    $video = new Video();
    $video->titre = $request->titre;
    $video->description = $request->description ?? null;
    $video->image = $public_id;
    $video->user_id = $userId;
    $video->image_url = $url;
    $video->image_public_id = $public_id;
    $video->is_file_upload = $request->boolean('is_file_upload');

    // Cas 1 : upload d'un fichier vidéo
    if ($video->is_file_upload && $request->hasFile('video')) {
        $uploadedVideo = Cloudinary::uploadVideo($request->file('video')->getRealPath(), [
            'resource_type' => 'video',
            'folder' => 'videos',
            'transformation' => [
                'quality' => 'auto',
                'fetch_format' => 'auto',
                'width' => 1280,
                'height' => 720,
                'crop' => 'limit',
                'duration' => 600,
            ]
        ]);

        $video->video = $uploadedVideo->getSecurePath();
        $video->video_public_id = $uploadedVideo->getPublicId();
        $video->path = null;

    // Cas 2 : lien YouTube
    } elseif (!$video->is_file_upload && $request->filled('path')) {
        $videoUrl = $request->input('path');
        $video->path = $this->convertToEmbedUrl($videoUrl);
        $video->video = null;
        $video->video_public_id = null;
    }

    $video->save();

    return back()->with('success', 'Vidéo enregistrée avec succès.');
}
private function convertToEmbedUrl($url)
{
    if (preg_match('/youtu\.be\/([^\?\/]+)/', $url, $matches)) {
        return 'https://www.youtube.com/embed/' . $matches[1];
    } elseif (preg_match('/youtube\.com.*[?&]v=([^&]+)/', $url, $matches)) {
        return 'https://www.youtube.com/embed/' . $matches[1];
    } elseif (preg_match('/youtube\.com\/embed\/([^\?\/]+)/', $url, $matches)) {
        return 'https://www.youtube.com/embed/' . $matches[1];
    }
    return $url; // Fallback si le format n'est pas reconnu
}

    public function uploadVideo2(Request $request)
    {
        $this->validate($request, [
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'image' => 'sometimes|required|file|mimetypes:image/*',
            'is_file_upload' => 'required|boolean',
            'video' => 'nullable|file|mimetypes:video/*',
            'path' => 'nullable|url',
        ]);


        $cloudinaryImage = $request->file('image')->storeOnCloudinary('videos');
        $url = $cloudinaryImage->getSecurePath();
        $public_id = $cloudinaryImage->getPublicId();

        $userId = Auth::id();
        $video = new Video();
        $video->titre = $request->titre;
        $video->description = $request->description ?? null;
        $video->image = $public_id;
        $video->user_id = $userId;

      
        $video->image_url = $url;
        $video->image_public_id = $public_id;
        $video->is_file_upload = $request->boolean('is_file_upload');

        if ($video->is_file_upload && $request->hasFile('video')) {
            // $video->video = $request->file('video')->store('videos', 'public');

            $uploadedVideo =  Cloudinary::uploadVideo($request->file('video')->getRealPath(), [
                'resource_type' => 'video',  // Indique que c'est une vidéo
                'folder' => 'videos',        // Spécifie le dossier sur Cloudinary
                'transformation' => [
                    'quality' => 'auto',    // Compression automatique pour optimiser la taille
                    'fetch_format' => 'auto', // Format automatique (par exemple, WebM ou MP4 en fonction du navigateur)
                    'width' => 1280,          // Réduction de la largeur (ajuste selon tes besoins)
                    'height' => 720,          // Réduction de la hauteur (ajuste selon tes besoins)
                    'crop' => 'limit',        // Limiter la taille sans distorsion
                    'duration' => 300,         // Limiter la durée de la vidéo si nécessaire (en secondes)
                ]
            ])->getSecurePath();  

         
            $video->video = $uploadedVideo->getSecurePath();
            $video->video_public_id = $uploadedVideo->getPublicId();
            $video->path = null;
          //  $video->path = null;
        } elseif (!$video->is_file_upload && $request->filled('path')) {
            $videoUrl = $request->input('path');
            $embedUrl = preg_replace('/^.*v=([^&]*).*$/', 'https://www.youtube.com/embed/$1', $videoUrl);
            $video->path = $embedUrl;
            $video->video = null;
        }

        $video->save();

        return back()->with('success', 'Vidéo enregistrée avec succès.');
    }

    


public function update(Request $request, $id)
{
    // Validation des données
    $this->validate($request, [
        'titre' => 'required|string|max:255',
        'description' => 'nullable|string|max:255',
        'image' => 'nullable|file|mimetypes:image/*',
        'video' => 'nullable|file|mimetypes:video/*',
        'path' => 'nullable|url',
    ]);

    // Récupérer l'objet vidéo
    $video = Video::findOrFail($id);

    // Mise à jour de l'image (si nouvelle image uploadée)
    if ($request->hasFile('image')) {
        // Supprimer l'ancienne image de Cloudinary
        if ($video->image_public_id) {
            Cloudinary::destroy($video->image_public_id);
        }

        // Télécharger la nouvelle image
        $cloudinaryImage = Cloudinary::upload($request->file('image')->getRealPath(), [
            'folder' => 'videos'
        ]);
        
        $video->image_public_id = $cloudinaryImage->getPublicId();
        $video->image_url = $cloudinaryImage->getSecurePath();
    }

    // Mise à jour de la vidéo (si nouveau fichier vidéo uploadé)
    if ($request->hasFile('video')) {
        // Supprimer l'ancienne vidéo de Cloudinary
        if ($video->video_public_id) {
            Cloudinary::destroy($video->video_public_id, ['resource_type' => 'video']);
        }

        // Télécharger la nouvelle vidéo
        $cloudinaryVideo = Cloudinary::uploadVideo($request->file('video')->getRealPath(), [
            'folder' => 'videos'
        ]);

        $video->video_public_id = $cloudinaryVideo->getPublicId();
        $video->video_url = $cloudinaryVideo->getSecurePath();
    }

    // Si un chemin YouTube est fourni, le convertir en lien embed
    if ($request->filled('path')) {
        $videoUrl = $request->input('path');
        $embedUrl = preg_replace('/^.*v=([^&]*).*$/', 'https://www.youtube.com/embed/$1', $videoUrl);
        $video->path = $embedUrl;
        $video->video = null;
    }

    // Mettre à jour les autres informations
    $video->titre = $request->titre;
    $video->description = $request->description ?? $video->description;
    $video->save();

    return back()->with('success', 'Vidéo mise à jour avec succès.');
}

    public function destroy($id)
    {


        $video = Video::findOrFail($id);

    
    
     
      //  $video =  Video::find($id);
        if ($video) {
            // Supprimer l'image si elle existe
            if ($video->image_public_id) {
                Cloudinary::destroy($video->image_public_id);
            }
              // Supprimer la vidéo Cloudinary si c’est un upload
        if ($video->is_file_upload && $video->video_public_id) {
            Cloudinary::destroy($video->video_public_id, ['resource_type' => 'video']);
        }


            // Supprimer le sponsor
            $video->delete();


            return redirect()->back()
                ->with('success', 'Vidéo supprimée avec succès.');
        } else {
            return redirect()->back()('error', 'Gallerie non trouvée.');
        }
    }
}
