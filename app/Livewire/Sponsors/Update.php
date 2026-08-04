<?php


namespace App\Livewire\Sponsors;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;
    public $titre, $description, $email, $telephone, $image , $image2,$adresse, $sponsor;

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

    public function render()
    {
       
        return view('livewire.sponsors.update');
    }
    public function edit($id)
    {
        $sponsor = Sponsor::find($id);
        if ($sponsor) {
            $this->sponsorId = $sponsor->id;
            $this->titre = $sponsor->titre;
            $this->description = $sponsor->description;
            $this->email = $sponsor->email;
            $this->telephone = $sponsor->telephone;
        } else {
            session()->flash('error', 'Sponsor not found.');
        }
    }

    public function update()
    {
        $this->validate([
            'titre' => 'required|string|max:50',
            'description' => 'required|string|max:250',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
           
        ], [
           
        ]);

        $Oldsponsor = $this->sponsor;

        if($this->image){
            Storage::disk('public')->delete($Oldsponsor->image); 
            $Oldsponsor->image = $this->photo->store("sponsors", "public");
        }
        $Oldsponsor->titre = $this->titre;
        $Oldsponsor->description = $this->description;
      
        $Oldsponsor->save();

        $this->image = $Oldsponsor->image;

        //flash  success message
        session()->flash('success', 'Le modifications ont été enregistrées.');


    }

}
