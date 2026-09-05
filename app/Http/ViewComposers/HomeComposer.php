<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\{Blog, Category, config, Event, Formation, PackFormation, Service, Sponsor, Testimonial, User, Video};

class HomeComposer
{

  public function compose(View $view)
  {
    $view->with([
      'categories' => Category::has('formations')->take(6)->get(),
      'catblogs' => Category::has('blogs')->get(),
      'catevents' => Category::has('events')->get(),
      'blogs' => Blog::select('*')->latest()->take(6)->get(), /// Pour le home page
      'events' => Event::select('*')->latest()->take(4)->get(),
      'services' => Service::select('*')->latest()->take(10)->get(),
      'sposors' => Sponsor::select('*')->latest()->take(100)->get(),
      'videos ' => Video::select('*')->latest()->take(10)->get(),
      'formations' => Formation::select('*')->latest()->take(9)->get(),
      'enventfooter' => Event::select('*')->latest()->take(2)->get(),
      'testimonials' => Testimonial::orderBy('created_at', 'desc')
        ->where('active', '1')
        ->limit(100)->get(),
      'configs' => config::all(),
      'config' => config::all(),
      'enseignants' => User::whereIn('role', ['enseignant'])
        ->where('active', true) // Ou 1 selon votre BDD
        ->with('profile')
        ->latest()
        ->take(4)
        ->get(),



      'packs' => PackFormation::where('active', true)
        ->latest()
        ->take(10)
        ->get(),
    ]);
  }
}
