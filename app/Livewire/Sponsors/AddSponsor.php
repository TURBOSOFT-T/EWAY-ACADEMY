<?php

namespace App\Livewire\Sponsors;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Sponsor;



class AddSponsor extends Component
{
    
    use WithFileUploads;

    public $titre, $description, $email, $telephone, $image , $image2,$adresse, $sponsor;
    public $updateMode = false;
    protected $listeners = ['sponsorAdded' => 'render'];

    public function mount($sponsor){
        if($sponsor){
            $this->sponsor = $sponsor;
            $this->titre = $sponsor->titre;
            $this->description = $sponsor->description;
            $this->email = $sponsor->email;
            $this->telephone = $sponsor->telephone;
            $this->image = $sponsor->image;
            $this->image2 = $sponsor->image;
            $this->adresse = $sponsor->adresse;

          
        }
    }

    
private function resetInputFields(){
    $this->titre= '';
    $this->description = '';
    $this->email = '';
    $this->telephone = '';
    $this->image = '';
    $this->image2 = '';
    $this->adresse = '';

}

   

    
public function create()
{
    $data =  $this->validate([
        'titre' => 'required|string',
       'description' => 'required|string|max:260',
         'email' => 'required|email|unique:sponsors,email',
        'telephone' => 'required|numeric',
        'adresse' => 'nullable|string|max:260',
        //  'image' => 'required|image|mimes:jpg,jpeg,png,webp',
       // 'photos.*' => 'nullable|image|mimes:jpg,jpeg,png,webp',
      //  'image' => 'required|image|mimes:jpg,jpeg,png,webp',
       // 'photos.*' => 'nullable|image|mimes:jpg,jpeg,png,webp',
     
    ]);
    ;[
        'titre.required' => 'Le titre',
        'description.required' => 'Veuillez entrer votre description',
        'email.required' => 'Veuillez entrer votre email',
        'email.email' => 'Veuillez entrer une adresse email valide',
        'email.unique' => 'Cet email est déjà utilisé',
        'telephone.required' => 'Veuillez entrer votre numéro de téléphone',
        'telephone.numeric' => 'Veuillez entrer un numéro de téléphone valide',
        'adresse.max' => 'L\'adresse ne doit pas dépasser 260 caractères',
        //  'image.required' => 'Veuillez choisir une image',
        //  'photos.*.required' => 'Veuillez choisir une image',
        //  'photos.*.mimes' => 'Veuillez choisir une image de type jpg,jpeg,png,webp',
        
       // 'image.mimes' => 'Veuillez choisir une image de type jpg,jpeg,png,webp',
        
  
      ];
      $sponsor = new Sponsor();
     
      $sponsor->titre = $this->titre;
      $sponsor->description = $this->description;
      $sponsor->email = $this->email;
      $sponsor->telephone = $this->telephone;
      $sponsor->adresse = $this->adresse;
        if($this->image){
          $sponsor->image = $this->image->store('sponsors', 'public');
       }

      
      $sponsor->save();
    /*   $this->resetInputFields(); */

    session()->flash('success', 'Sponsor ajouté avec succès');
    // reset input
   // $this->reset();
  

     //dispach event
     $this->dispatch('sponsorAdded');

   //  $this->emit('sponsorAdded');
  
}


public function edit($id)
    {
        $sponsor = Sponsor::findOrFail($id);

        $this->sponsorId = $sponsor->id;
        $this->titre = $sponsor->titre;
        $this->description = $sponsor->description;
        $this->email = $sponsor->email;
        $this->telephone = $sponsor->telephone;
        $this->adresse = $sponsor->adresse;
        $this->image = $sponsor->image;
    }

    public function update()
    {
        $data = $this->validate([
            'titre' => 'required|string',
            'description' => 'required|string|max:260',
            'email' => 'required|email|unique:sponsors,email,' . $this->sponsorId,
            'telephone' => 'required|numeric',
            'adresse' => 'nullable|string|max:260',
            'newImage' => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $sponsor = Sponsor::findOrFail($this->sponsorId);
        $sponsor->titre = $data['titre'];
        $sponsor->description = $data['description'];
        $sponsor->email = $data['email'];
        $sponsor->telephone = $data['telephone'];
        $sponsor->adresse = $data['adresse'];

        if (isset($data['newImage'])) {
            $sponsor->image = $data['newImage']->store('sponsors', 'public');
        }

        $sponsor->save();

        session()->flash('success', 'Sponsor mis à jour avec succès');
        $this->reset();

        $this->emit('sponsorUpdated');
       // return view('livewire.sponsors.list'); 
         
   // return view('admin.sponsors.list');
    }

public function delete($id)
    {
        $sponsor = Sponsor::find($id);

        if ($sponsor) {
            $sponsor->delete();
            session()->flash('message', 'Sponsor supprimé avec succès.');
        } else {
            session()->flash('error', 'Sponsor non trouvé.');
        }
    }


public function render()
{
    return view('livewire.sponsors.add-sponsor');
}


}
