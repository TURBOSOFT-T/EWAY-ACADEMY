<?php

namespace App\Livewire\Videos;

use Livewire\Component;
use App\Models\Video;;
use Livewire\Livewire;
use Livewire\WithFileUploads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;




class AddVideo extends Component
{

    use WithFileUploads;
    public $titre;
    public $description;
    public $video;
    public $image;

    public function mount($video){
        if($video){
            $this->video = $video;
            $this->titre = $video->titre;
            $this->description = $video->description;
          //  $this->image = Storage::url($video->image);
            $this->video = $video->video;
            $this->image = Storage::url($video->image);
        }

    }


    
    public function save(Request $request)
    {
         $this->validate([
             'titre' => ['required', 'max:255'],
             'description' => ['required', 'max:255'],
           //  'video' => 'required|file|mimetypes:video/mp4',
             'video' => 'required|file|mimetypes:video/mp4|max:501200', // Limite à 50 Mo
          
             'image' => 'sometimes|required|file|mimetypes:image/*',
            
         ]);



         $fileName = $request->video->getClientOriginalName();
         $filePath = 'videos/' . $fileName;
  
         $isFileUploaded = Storage::disk('public')->put($filePath, file_get_contents($request->video));
  
         // File URL to access the video in frontend
         $url = Storage::disk('public')->url($filePath);
  
         if ($isFileUploaded) {
             $video = new Video();
             $video->titre = $request->titre;
             $video->description = $request->description;
           $video->image = $request->image->store('videos', 'public');
             $video->video = $filePath;
             $video->save();
  
             return back()
             ->with('success','Video has been successfully uploaded.');
         }
  
         return back()
             ->with('error','Unexpected error occured');
     }

    public function resetInputFields()
    {
        $this->titre = '';
        $this->description = '';
        $this->video = null;
        $this->image = null;
    }


    public function delete($id)
    {
        $sponsor = Video::find($id);

        if ($sponsor) {
            $sponsor->delete();
            session()->flash('message', 'Sponsor supprimé avec succès.');
        } else {
            session()->flash('error', 'Sponsor non trouvé.');
        }
    }



    public function render()
    {
        
        return view('livewire.videos.add-video');
    }
}
