<?php

namespace App\Livewire\Blogs;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Http\Request;
use App\Mail\NewBlogNotification;

use Illuminate\Support\Facades\Mail;
use App\Models\{ Category, Marque, blogs, Blog, Subscriber, User};

class AddBlogs extends Component
{

    use WithFileUploads;

    public $title,$slug, $seo_title, $category_id,$image, $images,  $image2, $images2, $blogs,$blog, $description,$reference ;

    public $free, $body, $excerpt, $meta_description, $meta_keywords, $active ,$user_id;


    public function mount($blog)
    {
        if ($blog) {
            $this->blog = $blog;
            $this->title = $blog->title;
           
            $this->category_id = $blog->category_id;
         
          //  $this->reference = $blogs->reference;
          
            $this->image2 = $blog->image;
            $this->images2 = $blog->images;
            $this->description = $blog->description;
          
            $this->excerpt =$blog->excerpt;
            $this->meta_description =$blog->meta_description;
            $this->meta_keywords =$blog->meta_keywords;

        

        }
    }


    public function create()
    {
        $data =  $this->validate([
            'title' => 'required|string',
            'description' => 'required|string|max:5000060',
         //   'tags' => 'nullable|string|max:260',
       //     'reference' => 'required|string|unique:blogs,reference',
           
           'image' =>  'sometimes|nullable|file|mimetypes:image/*',
         
            'category_id' => 'required|integer|exists:categories,id',
            
          
       
        ]);
        ;[
           // 'reference.required' => ' La reference',
            'title.required' => 'Veuillez entrer votre nom',
          
           
      
          ];


        $categories = Category::findOrFail($data[('category_id')]);

        $blog = new Blog();
        $blog->title = $this->title;

     //   $blogs->tags = $this->tags;
                $blog->description = $this->description;
                $blog->meta_description = $this->meta_description;
   //     $blogs->reference = $this->reference;
       

        $blog->category_id = $this->category_id;
    


        $blog->image = $this->image->store('blogs', 'public');
        /* if ($this->images) {
            $imagesPaths = [];
            foreach ($this->images as $image) {
                $imagesPaths[] = $image->store('blogs', 'public');
            }
            $blogs->images = json_encode($imagesPaths);
        } */
        // $blogs->save();

        $categories->blogs()->save($blog);
      //  $users = User::where('role', 'client')->get();;
    $users = Subscriber:: all();

foreach ($users as $user) {
    Mail::to($user->email)->queue(new NewBlogNotification($blog));
}

        //reset input
        $this->reset();

        //flash message
        session()->flash('success', 'blogs ajouté avec succès');
    }


    public function update_blogs()
    {
        if ($this->blog) {
            $this->validate([
                'title' => 'required|string',
            'description' => 'required|string|max:5000060',
         //   'tags' => 'nullable|string|max:260',
       //     'reference' => 'required|string|unique:blogs,reference',
           
          //  'image' =>  'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
         
            'category_id' => 'required|integer|exists:categories,id',
            
          
       
        ]);
        ;[
           // 'reference.required' => ' La reference',
            'title.required' => 'Veuillez entrer votre nom',
          
           
      
          ];



            $this->blog->title = $this->title;
            $this->blog->description = $this->description;
            $this->blog->meta_description = $this->meta_description;
        
          
            $this->blog->category_id = $this->category_id;
          
        

            if ($this->image) {
                //delete old image
                if ($this->blog->image) {
                    Storage::disk('public')->delete($this->blog->image);
                }
                $this->blog->image = $this->image->store('blogs', 'public');
            }

          /*   if ($this->images) {
                $imagesPaths = [];
                foreach ($this->images as $image) {
                    $imagesPaths[] = $image->store('blogs', 'public');
                }
                $this->blogs->images = json_encode($imagesPaths);
            } */
            $this->blog->save();


            $this->resetInput();

            return redirect()->route('blogs')->with('succes', "blogs modifié avec succès");
        }
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.blogs.add-blogs', compact('categories'));
    }

    
    public function resetInput()
    {
        $this->title = '';
       
      
    }


}
