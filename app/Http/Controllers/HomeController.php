<?php

namespace App\Http\Controllers;

//require './vendor/autoload.php';


use App\Models\{Blog, BlogView, commandes,config,Coach, User,produits, Category, Service,Marque, Video,Event, Formation, Sponsor,Image};
use App\Models\Banners;
use App\Models\templates;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Front\SearchRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{

    

    public function home(Request $request)
    {
        $key = $request->input("key", null);
        $produits = produits::select('*')->latest()->take(20)->get();
        if(!is_null($key)){
            $produits->where('nom', 'like', '%'.$key.'%')
            ->Orwhere('description', 'like', '%'.$key.'%');
        }
     //  $produits = produits::select('*')->latest()->take(20)->get();

       $videos = Video::select('*')->latest()->take(20)->get();
       $events = Event::select('*')->latest()->take(20)->get();
       $images = Image::select('*')->latest()->take(20)->get();
       $sponsors =Sponsor::select('*')->latest()->take(20)->get();
       $coachs = Coach::select('*')->latest()->take(20)->get();

       $latestVideos = Video::orderBy('created_at', 'desc')
       ->take(20)
       ->get();

       $lastVideo = Video::latest()->take(1)->first();
 
       $configs= config::all();
       $banners = Banners::select("titre","sous_titre","image")->get();

       $services = Service::all();
       $latestVideo = \App\Models\Video::latest()->first();
         $config = \App\Models\Config::first(); // ou find(), selon vos besoins
    //$photos = $config->photos;
    $photos = json_decode($config->photos, true); 
      return view('front.index', compact('photos','latestVideo','coachs','latestVideos','lastVideo','produits','configs','banners','services','key','videos','images','sponsors','events'));

    }
     
      public function detailsServices($id, $slug){
        $service =Service:: findOrFail($id);
        $configs= config::all();
        $services = Service::all();
        return view('front.services.details', compact('service','services','configs'));
      }


    public function shop(Request $request){
        $key = $request->input("key", null);
        $id_categorie = $request->get("id_categorie", null);
        $price_range = $request->input("price_range", null);
        $ordre_affichage = $request->input("ordre_affichage", null);
        
        $produits = produits::query();

        if(!is_null($key)){
            $produits->where('nom', 'like', '%'.$key.'%')
            ->Orwhere('description', 'like', '%'.$key.'%');
        }
        if(!is_null($id_categorie)){
            $produits->where('category_id', $id_categorie);
        }
        if(!is_null($price_range)){
            $produits->whereBetween('prix', explode('-', $price_range));
        }

        if($request->sort_by == 'lowest_price'){
            $$produits = produits::orderBy('prix','asc')->get();
        }
        if($request->sort_by == 'highest_price'){
            $$produits = produits::orderBy('prix','desc')->get();
        }
        if(!is_null($ordre_affichage)){
            //if is not null will be Asc or Desc
            $produits->orderBy('prix', $ordre_affichage ? 'asc' : 'desc');
        }
        

        $produits = $produits->paginate(24);
        
        $total_produit = produits::count();
        $max_prix = produits::max('prix');
      // $categories = Category::with('produits')->get();
      $categories =Category::has('produits')->get();
    
   
        $configs= config::all();
        return view('front.shop.index',compact('produits', 'categories', 'configs','key','total_produit','max_prix','ordre_affichage'));
    }

    public function search_products(Request $request)
    {
        $all_products = produits::whereBetween('prix',[$request->left_value, $request->right_value])->get();
        return view('front.shop.index',compact('all_products'))->render();
    }

    public function sort_by(Request $request)
    {
      
        //$produits = produits::query();

       
        if($request->sort_by == 'lowest_price'){
            $$produits = produits::orderBy('prix','asc')->get();
        }
        if($request->sort_by == 'highest_price'){
            $$produits = produits::orderBy('prix','desc')->get();
        }
        
       // $produits = $produits->paginate(24);
       $categories =Category::has('produits')->get();
    
   
       $configs= config::all();
        $total_produit = produits::count();
        $max_prix = produits::max('prix');
      // $categories = Category::with('produits')->get();
      $categories =Category::has('produits')->get();
        return view('front.shop.index',compact('produits','categories', 'configs'))->render();

    }


    public function decroissant(){
        $produits= produits:: select('*')
        ->orderBy('prix','DESC')
        ->get();
      //  $categories = Category::with('produits')->get();
      $categories =Category::has('produits')->get();
        $configs= config::all();
        return view('front.shop.index',compact('produits', 'categories','configs'));
    }


    public function croissant(){
        $produits= produits:: select('*')
        ->orderBy('prix','ASC')
        ->get();
      //  $categories = Category::with('produits')->get();
      $categories =Category::has('produits')->get();
        $configs= config::all();
        return view('front.shop.index',compact('produits', 'categories','configs'));
    }
    







    public function produits($id)
    {
        $categories = Category::with('produits')->get();
        $current_category = Category::with('produits')->findOrFail($id);
        $produits = $current_category->produits;

        $marques = Marque::with('produits')->get();
        $current_marque = Marque::with('produits')->findOrFail($id);
        $produits = $current_marque->produits;
        $users = User::all();

        //dd($produits);
        return view('front.shop.index', compact('current_category','current_marque','marques', 'users', 'categories', 'produits'));
    }

    public function details($id){
        $produit =produits:: findOrFail($id);
        $configs= config::all();
        return view('front.shop.details', compact('produit','configs'));
    }
    
    public function products($id)
    {
        $categories = Category::with('produits')->get();
        $current_category = Category::with('produits')->findOrFail($id);
        $produits = $current_category->produits;
        $users = User::all();  
        return view('front.shop.index', compact('current_category','marques', 'users', 'categories', 'produits'));
    }

//////////////////Formations/////////////////////////////////////////
    public function formations($id)
    {
        $categories = Category::withCount('formations')->has('formations')->get();
        $current_category = Category::with('formations')->findOrFail($id);
        $formations = $current_category->formations()->paginate(10);

    

        //dd($produits);
        return view('front.formations.index', compact('current_category', 'categories', 'formations'));
    }

    
    public function details_formations($id){
        $formation =Formation:: findOrFail($id);
        $lasts = Formation::select('*')->latest()->take(5)->get();
        $categories = Category::withCount('formations')
        ->has('formations')->get();
        $configs= config::all();
        $formations = Formation :: all();
        return view('front.formations.details', compact('formation','configs', 'lasts', 'categories','formations'));
    }

    public function searchformation(SearchRequest $request)
    {
        $search = $request->search;
        $categories = Category::has('formations')->get();
        $formations = Formation::where('titre', 'like', '%'.$search.'%')
            ->orWhere('description', 'like', '%'.$search.'%')
            ->paginate(10);
        $title = __('Formations nont trouvée avec la recherche: ') . '<strong>' . $search . '</strong>';
     
        return view('front.formations.index', compact('formations', 'title','categories'));
    }


    /////////////////////////Actualités////////////////////////////
    public function blogs($id)
    {
        $categories = Category::withCount('blogs')
        ->has('blogs')
        ->get();
       // $categories = Category::with('blogs')->get();
       $lasts = Blog::select('*')->latest()->take(5)->get();
        $current_category = Category::has('blogs')->findOrFail($id);
        $blogs = $current_category->blogs()
        ->paginate(10);
        return view('front.blogs.index', compact('current_category', 'categories', 'blogs','lasts'));
    }

    
    public function details_blogs($id){
        $blog =Blog::with('comments')-> findOrFail($id);
        $lasts = Blog::select('*')->latest()->take(5)->get();
       // $categories = Category::with('blogs')->get();
      // $comments = $blog->comments()->with('user')->paginate(10);
       $comments = $blog->comments()->with('user')->where('active', true)->latest()->paginate(10);
        $categories = Category::withCount('blogs')
        ->has('blogs')
        ->get();
        $configs= config::all();
 $ip = request()->ip();

   /*  $alreadyViewed = BlogView::where('blog_id', $blog->id)
        ->where('ip_address', $ip)
        ->exists();

    if (!$alreadyViewed) {
        BlogView::create([
            'blog_id' => $blog->id,
            'ip_address' => $ip,
        ]);
        $blog->increment('views');
    } */


        return view('front.blogs.details', compact('blog','configs', 'lasts', 'categories','comments'));
    }

    public function searchblog(SearchRequest $request)
    {
        $search = $request->search;
        $lasts = Blog::select('*')->latest()->take(5)->get();
        $categories = Category::has('blogs')->get();
        $blogs = Blog::where('title', 'like', '%'.$search.'%')
            ->orWhere('description', 'like', '%'.$search.'%')
            ->paginate(10);
        $title = __('Actualité nont trouvée avec la recherche: ') . '<strong>' . $search . '</strong>';
     
        return view('front.blogs.index', compact('blogs', 'title','categories', 'lasts'));
    }

////////////////////////Evènements///////////////////////////////////

public function events($id)
{
    $categories = Category::withCount('events')
    ->has('events')
    ->get();
 
   // $categories = Category::with('blogs')->get();
   $lasts = Event::select('*')->latest()->take(5)->get();
    $current_category = Category::has('events')
    ->findOrFail($id);
    $events = $current_category->events()
    
   
    ->paginate(10);
    return view('front.events.index', compact('current_category', 'categories', 'events','lasts'));
}


public function details_events($id){
    $event =Event:: findOrFail($id);
    $lasts = Event::select('*')->latest()->take(5)->get();
   // $categories = Category::with('blogs')->get();
    $categories = Category::withCount('events')
    ->has('events')
    ->get();
    $configs= config::all();
    return view('front.events.details', compact('event','configs', 'lasts', 'categories'));
}

public function searchevent(SearchRequest $request)
{
    $search = $request->search;
    $lasts = Event::select('*')->latest()->take(5)->get();
    $categories = Category::has('events')->get();
    $blogs = Event::where('titre', 'like', '%'.$search.'%')
        ->orWhere('description', 'like', '%'.$search.'%')
        ->paginate(10);
    $title = __('Eévènement non trouvé avec la recherche: ') . '<strong>' . $search . '</strong>';
 
    return view('front.events.index', compact('blogs', 'title','categories', 'lasts'));
}

///////////////Services////////////////////////////////////////////

public function servicess()
{
  
 
   // $categories = Category::with('blogs')->get();
   $services = Service::select('*')->latest()
  
    ->paginate(10);
    return view('front.services.index', compact('services'));
}


public function details_services($id){
    $service =Service:: findOrFail($id);

    $configs= config::all();
    return view('front.services.details', compact('service','configs'));
}

    ///////////Login///////////////////////////////////////////////////
    public function login()
    {
        return view('auth.login');
    }


     public function verify()
    {
        return view('auth.verify-2fa');
    }

       public function registerverify()
    {
        return view('auth.verify-register-2fa');
    }
   

    public function Not_Autorized(){
        $template = templates::where('meta_error',true)->first();
        $meta = $template->meta ?? "";
        return view("front.Not_Autorized", compact("meta"));
    }

    public function voir_template($slug)
    {
        $template = templates::where('reference', $slug)->first();
        if ($template) {
            $code = Storage::get($template->code);
            return view("front.template", compact("template","code"));
        } else {
            abort(404, "template introuvable");
        }
    }

    public function print_commande($id)
    {
        $commande = commandes::find($id);
        if (!$commande) {
            abort('404');
        }

        $pdf = PDF::loadView('pdf.commande', compact('commande'));
        return $pdf->download("Facture-#" . $commande->id . ".pdf");
    }


    public function print_bordereau(Request $request)
    {
        $ids = json_decode($request->get('ids'));
        $pdf = PDF::loadView('pdf.bordereau', compact("ids"));
        return $pdf->download("bordereau.pdf");
    }



    public function logout()
    {
        auth()->logout();
        return redirect()->route('home');
    }


    public function inscription()
    {
        return view('front.inscription');
    }


    public function confirmation(Request $request){
        $produit = null;
        if ($request->session()->has('produit')) {
            $produit = Session::get('produit');
        }
        return view('front.confirmation',compact("produit"));
    }


}
