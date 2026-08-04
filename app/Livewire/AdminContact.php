<?php

namespace App\Livewire;

use App\Models\config;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

use Illuminate\Support\Facades\Validator;

class AdminContact extends Component
{
    use WithFileUploads;
    public $logo, $icon, $logo2, $icon2, $logoHeader, $telephone, $addresse, $email, $description, $fax, $logocontact, $logocontact2, $photos, $photos2, $titre_apropos, $des_apropos,
        $facebook, $twitter, $instagram, $youtube, $linkedin, $tiktok;
    public $imagecontact, $imagecontact2, $imageevent2, $imageformation2, $imageformation, $imageevent, $imageblog, $imageblog2, $imageenteteabout, $imageenteteabout2;

    public   $image_apropos, $image_apropo2,
        $titre_apropos1, $des_apropos1, $image_apropos1, $image_apropos12,
        $titre_apropos2, $des_apropos2, $image_apropos2, $image_apropos22,
         $titre_apropos3, $des_apropos3, $image_apropos3, $image_apropos33;
public $slogan_apropos, $slogan1_apropos;

public $image1_home, $image1_home2, $image2_home, $image2_home2, $titre_home, $sous_titre_home, $des_home;
   
public $biographie, $localisation, $annees_experience;
    public function mount()
    {
        $config = config::first()  ?? new Config;;
        // $this->config = Config::first() ?? new Config;
        $this->logo2 = $config->logo;
        $this->photos2 = $config->photos;
        $this->icon2 = $config->icon;
        $this->titre_apropos = $config->titre_apropos;
        $this->des_apropos = $config->des_apropos;
        $this->imagecontact2 = $config->imagecontact;
        $this->imageevent2 = $config->imageevent;
        $this->imageformation2 = $config->imageformation;
        $this->imageblog2 = $config->imageblog;
        $this->imageenteteabout2 = $config->imageenteteabout;
        $this->image1_home2 = $config->image1_home;
        $this->image2_home2 = $config->image2_home;

        $this->titre_home = $config->titre_home;
        $this->sous_titre_home = $config->sous_titre_home;
        $this->des_home = $config->des_home;



        $this->image_apropo2 = $config->image_apropos;
        $this->image_apropos12 = $config->image_apropos1;
        $this->image_apropos22 = $config->image_apropos2;
         $this->image_apropos33 = $config->image_apropos3;
        $this->titre_apropos2 = $config->titre_apropos2;

        $this->slogan_apropos= $config->slogan_apropos;
        $this->slogan1_apropos= $config->slogan_apropos;


        //$this->logocontact= $config->logocontact;
        $this->logocontact2 = $config->logocontact;
        $this->logoHeader = $config->logoHeader;
        $this->email = $config->email;
        $this->telephone = $config->telephone;
        $this->fax = $config->fax;
        $this->addresse = $config->addresse;
        $this->description = $config->description;
        $this->facebook = $config->facebook;
        $this->twitter = $config->twitter;
        $this->instagram = $config->instagram;
        $this->youtube = $config->youtube;
        $this->linkedin = $config->linkedin;
        $this->tiktok = $config->tiktok;
        
    

        $this->titre_apropos1 = $config->titre_apropos1;
        $this->des_apropos1 = $config->des_apropos1;

        $this->titre_apropos2 = $config->titre_apropos2;
        $this->des_apropos2 = $config->des_apropos2;

          $this->titre_apropos3 = $config->titre_apropos3;
        $this->des_apropos3 = $config->des_apropos3;
        // $this->logoHeader = $config->logoHeader;  // not in the migration table so we commented it here
        $this->biographie = $config->biographie;
        $this->localisation = $config->localisation;
        $this->annees_experience = $config->annees_experience;



    }

    public function render()
    {
        return view('livewire.admin-contact');
    }
    protected $rules = [
        'telephone' => 'required|regex:/^\+\d{6,20}$/',
    ];

    public function update_form()
    {
        // valid all form fields as nulable
        $this->validate([
         'logo' => 'nullable|file|mimetypes:image/*|max:10024',
            'photos.*' => 'sometimes|nullable|file|mimetypes:image/*',
            //  'logoHeader' =>  'image|nullable|max:2024',   // 1MB Max
            'logocontact' => 'nullable', // 1MB Max
            'icon' =>  'image|nullable', //

            'telephone' => 'nullable|numeric',
            'telephone' => 'nullable|regex:/^[0-9\s\-\+\(\)]+$/|min:8|max:20',
            'email' => 'nullable',
            'addresse' => 'nullable|string',
            'description' => 'nullable|string',
            'logoHeader' => 'nullable|image',
            'fax' => 'nullable|numeric',
            'facebook' => 'nullable|string',
            'twitter' => 'nullable|string',
            'instagram' => 'nullable|string',
            'youtube' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'tiktok' => 'nullable|string',
            
        


        ]);

        // update the user
        $config = config::first();
        if ($this->logo) {
            //delete old logo
            if ($this->logo2) {
                Storage::disk('public')->delete($this->logo2);
            }
            $config->logo = $this->logo->store('logo', 'public');
        }
        if ($this->logoHeader) {
            //delete old logo
            if ($this->logoHeader2) {
                Storage::disk('public')->delete($this->logoHeader2);
            }
            $config->logoHeader = $this->logoHeader->store('logoHeader', 'public');
        }

        if ($this->icon) {
            //delete old icon
            if ($this->icon2) {
                Storage::disk('public')->delete($this->icon2);
            }
            $config->icon = $this->icon->store('icon', 'public');
        }

        if ($this->logocontact) {
            //delete old logo
            if ($this->logocontact2) {
                Storage::disk('public')->delete($this->logocontact2);
            }
            $config->logocontact = $this->logocontact->store('logocontact', 'public');
        }

        if ($this->imagecontact) {
            //delete old logo
            if ($this->imagecontact2) {
                Storage::disk('public')->delete($this->imagecontact2);
            }
            $config->imagecontact = $this->imagecontact->store('imagecontact', 'public');
        }


        if ($this->imageevent) {
            //delete old logo
            if ($this->imageevent2) {
                Storage::disk('public')->delete($this->imageevent2);
            }
            $config->imageevent = $this->imageevent->store('imageevent', 'public');
        }



        if ($this->imageenteteabout) {
            //delete old logo
            if ($this->imageenteteabout2) {
                Storage::disk('public')->delete($this->imageenteteabout2);
            }
            $config->imageenteteabout = $this->imageenteteabout->store('imageenteteabout', 'public');
        }


        if ($this->imageblog) {
            //delete old logo
            if ($this->imageblog2) {
                Storage::disk('public')->delete($this->imageblog2);
            }
            $config->imageblog = $this->imageblog->store('imageblog', 'public');
        }


        if ($this->imageformation) {
            //delete old logo
            if ($this->imageformation2) {
                Storage::disk('public')->delete($this->imageformation2);
            }
            $config->imageformation = $this->imageformation->store('imageformation', 'public');
        }


        if ($this->image_apropos) {
            //delete old image
            if ($this->image_apropo2) {
                Storage::disk('public')->delete($this->image_apropo2);
            }
            $config->image_apropos = $this->image_apropos->store('image_apropos', 'public');
        }
        if ($this->image_apropos1) {
            //delete old image
            if ($this->image_apropos12) {
                Storage::disk('public')->delete($this->image_apropos12);
            }
            $config->image_apropos1 = $this->image_apropos1->store('image_apropos', 'public');
        }
        if ($this->image_apropos2) {
            //delete old image
            if ($this->image_apropos22) {
                Storage::disk('public')->delete($this->image_apropos22);
            }
            $config->image_apropos2 = $this->image_apropos2->store('image_apropos', 'public');
        }
 if ($this->image_apropos3) {
            //delete old image
            if ($this->image_apropos33) {
                Storage::disk('public')->delete($this->image_apropos33);
            }
            $config->image_apropos3 = $this->image_apropos3->store('image_apropos', 'public');
        }

        if ($this->image1_home) {
            //delete old image
            if ($this->image1_home2) {
                Storage::disk('public')->delete($this->image1_home2);
            }
            $config->image1_home = $this->image1_home->store('image_home', 'public');
        }

        if ($this->image2_home) {
            //delete old image
            if ($this->image2_home2) {
                Storage::disk('public')->delete($this->image2_home2);
            }
            $config->image2_home = $this->image2_home->store('image_home', 'public');
        }
         
      /*   if ($this->photos) {
            $photosPaths = [];
            foreach ($this->photos as $photo) {
                $photosPaths[] = $photo->store('image_apropos', 'public');
            }
          

            $this->config->photos = json_encode($photosPaths);
        }  
 *//* 
        if ($this->photos) {
            $photosPaths = [];
            foreach ($this->photos as $photo) {
                $photosPaths[] = $photo->store('apropos', 'public');
            }
            $config->photos = json_encode($photosPaths);
        } */

        if (!empty($this->photos)) {
            
            if ($config->photos) {
                $oldPhotos = json_decode($config->photos, true);
                foreach ($oldPhotos as $oldPhoto) {
                    if (Storage::disk('public')->exists($oldPhoto)) {
                        Storage::disk('public')->delete($oldPhoto);
                    }
                }
            }
        
            
            $photosPaths = collect($this->photos)
                ->filter(fn($photo) => $photo !== null)
                ->map(function ($photo) {
                    return $photo->store('apropos', 'public');
                })
                ->toArray();
        
            $config->photos = json_encode($photosPaths);
        }
        

        $config->telephone = $this->telephone;
        $config->fax = $this->fax;
        $config->email = $this->email;
        $config->addresse = $this->addresse;
        $config->description = $this->description;
        $config->facebook = $this->facebook;
        //$config->twitter = $this->twitter;
        $config->instagram = $this->instagram;
        $config->youtube = $this->youtube;
        $config->linkedin = $this->linkedin;
        $config->tiktok = $this->tiktok;
        
      
        $config->titre_apropos = $this->titre_apropos;
        $config->des_apropos = $this->des_apropos;
        // $config->titre_apropos = $this->titre_apropos;
        // $config->des_apropos = $this->des_apropos;

          $config->titre_apropos1 = $this->titre_apropos1;
          $config->des_apropos1 = $this->des_apropos1;

         $config->titre_apropos2 = $this->titre_apropos2;
          $config->des_apropos2 = $this->des_apropos2;

          
         $config->titre_apropos3 = $this->titre_apropos3;
          $config->des_apropos3 = $this->des_apropos3;
          $config->slogan_apropos = $this->slogan_apropos;
          $config->slogan1_apropos = $this->slogan1_apropos;

          $config->des_home = $this->des_home;
          $config->titre_home =$this->titre_home;
          $config->sous_titre_home = $this->sous_titre_home;
          $config->biographie = $this->biographie;
          $config->localisation = $this->localisation;
          $config->annees_experience = $this->annees_experience;


        if ($config->save()) {
            //flash message
            session()->flash('info', 'Vos modifications ont été enregistrées.');
        } else {
            //flash message
            session()->flash('danger', 'Vos modifications n\'ont pas été enregistrées.');
        }
    }
}
