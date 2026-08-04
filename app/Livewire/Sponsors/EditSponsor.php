<?php

namespace App\Livewire\Sponsors;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Sponsor;



class EditSponsor extends Component
{


    use WithFileUploads;

    public $titre, $description, $email, $telephone, $image , $image2,$adresse, $sponsor, $sponsorId;
    public $updateMode = false;

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
    }
    public function render()
    {
        return view('livewire.sponsors.edit-sponsor');
    }
}
