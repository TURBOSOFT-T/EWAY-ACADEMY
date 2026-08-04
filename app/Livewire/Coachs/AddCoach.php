<?php

namespace App\Livewire\Coachs;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Coach;
use Livewire\Livewire;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AddCoach extends Component
{

    use WithFileUploads;

    public $nom, $prenom, $email, $phone, $photo , $photo2,$adresse, $coach;
    public $updateMode = false;
    protected $listeners = ['coachAdded' => 'render'];

    public function mount($coach){
        if($coach){
            $this->coach = $coach;
          
            $this->nom = $coach->nom;
            $this->prenom = $coach->prenom;
            
            $this->email = $coach->email;
            $this->phone = $coach->phone;
            $this->photo = $coach->photo;
            $this->photo2 = $coach->photo;
            $this->adresse = $coach->adresse;
          
          
        }
    }

    
private function resetInputFields(){
    $this->nom = '';
    $this->prenom = '';
    $this->email = '';
    $this->phone = '';
    $this->photo = '';
    $this->photo2 = '';
    $this->adresse = '';


}

   

    
public function create()
{
    $this->validate([
        'nom' =>'required|string',
        'prenom' =>'required|string',
        'email' =>'required|email|unique:coaches,email',
        'phone' =>'required|numeric',
        'adresse' =>'required',
        'photo' =>'nullable|image|mimes:jpeg,png,jpg|max:2048',
        //'photo2' =>'required|image|mimes:jpeg,png,jpg|max:2048',
       
     
    ]);
    ;[
        
      ];
      $coach = new coach();
      $coach->nom = $this->nom;
      $coach->prenom = $this->prenom;
      $coach->email = $this->email;
      $coach->phone = $this->phone;
      $coach->adresse = $this->adresse;
      $coach->photo = $this->photo->store('coachs', 'public');

      
      
     
      
     /// ($coach);
      $coach->save();
    /*   $this->resetInputFields(); */

    session()->flash('success', 'coach ajouté avec succès');
    // reset input
   // $this->reset();
  

     //dispach event
     $this->dispatch('coachAdded');

     return redirect()->route('coachs');

   //  $this->emit('coachAdded');
  
}


public function edit($id)
    {
        $coach = coach::findOrFail($id);

        $this->coachId = $coach->id;
        $this->titre = $coach->titre;
        $this->description = $coach->description;
        $this->email = $coach->email;
        $this->telephone = $coach->telephone;
        $this->adresse = $coach->adresse;
        $this->image = $coach->image;
    }

    public function update()
    {
        $data = $this->validate([
            'titre' => 'required|string',
            'description' => 'required|string|max:260',
            'email' => 'required|email|unique:coachs,email,' . $this->coachId,
            'telephone' => 'required|numeric',
            'adresse' => 'nullable|string|max:260',
            'newImage' => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $coach = coach::findOrFail($this->coachId);
        $coach->titre = $data['titre'];
        $coach->description = $data['description'];
        $coach->email = $data['email'];
        $coach->phone = $data['phone'];
        $coach->adresse = $data['adresse'];
        $coach->image = $this->image->store('coachs', 'public');

        if (isset($data['newImage'])) {
            $coach->image = $data['newImage']->store('coachs', 'public');
        }

        $coach->save();

        session()->flash('success', 'coach mis à jour avec succès');
        $this->reset();

        $this->emit('coachUpdated');
       // return view('livewire.coachs.list'); 
         
   // return view('admin.coachs.list');
    }

public function delete($id)
    {
        $coach = coach::find($id);

        if ($coach) {
            $coach->delete();
            session()->flash('message', 'coach supprimé avec succès.');
        } else {
            session()->flash('error', 'coach non trouvé.');
        }
    }



    public function render()
    {
        return view('livewire.coachs.add-coach');
    }
}
