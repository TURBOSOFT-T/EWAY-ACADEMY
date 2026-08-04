<?php

namespace App\Livewire\Examens;

use App\Models\Formation;
use App\Models\Oex_category;
use App\Models\Oex_exam_master;
use Livewire\Component;

class AddExamen extends Component
{

      public $nom,$tags, $prix, $category_id,$photo, $photos, $prix_achat, $photo2, $photos2, $examen, $reference, $description,$marque_id ;


    public function mount($examen)
    {
        if ($examen) {
            $this->examen = $examen;
            $this->nom = $examen->nom;
            $this->tags = $examen->tags;
            $this->category_id = $examen->category_id;
            $this->marque_id = $examen->marque_id;
            $this->reference = $examen->reference;
            $this->prix = $examen->prix;
            $this->prix_achat = $examen->prix_achat;
            $this->photo2 = $examen->photo;
            $this->photos2 = $examen->photos;
            $this->description = $examen->description;
         //   $this->tags = $examen->tags;

        }
    }
    public function render()
    {

         $user = auth()->user();
        $data['category']=Oex_category::where('status','1')->get()->toArray();
        $data['formation'] = $user->isAdmin()
        ? Formation::orderBy('titre')->get()
        : Formation::where('user_id', $user->id)->orderBy('titre')->get();
        $data['exams']=Oex_exam_master::select(['oex_exam_masters.*','oex_categories.name as cat_name'])->join('oex_categories','oex_exam_masters.category','=','oex_categories.id')->get()->toArray();
   
        return view('livewire.examens.add-examen',$data);
    }
}
