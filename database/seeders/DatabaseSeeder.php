<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\{User, config, Marque, Service, Category};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */

  private $permissions = [
    'dashboard',
    'clients_view',
    'clients_delete',

    'category_view',
    'category_add',
    'category_edit',
    'category_delete',

    'marque_view',
    'marque_add',
    'marque_edit',
    'marque_delete',

    'service_view',
    'service_add',
    'service_edit',
    'service_delete',

    'product_view',
    'product_add',
    'product_edit',
    'product_delete',

    'order_view',
    'order_add',
    'order_edit',
    'order_delete',

    'setting_view',
    'gestion_stock',

    'sponsor_view',
    'sponsor_add',
    'sponsor_edit',
    'sponsor_delete',

    'video_view',
    'video_add',
    'video_edit',
    'video_delete',

    'image_view',
    'image_add',
    'image_edit',
    'image_delete',

    'event_view',
    'event_add',
    'event_edit',
    'event_delete',

    'formation_view',
    'formation_add',
    'formation_edit',
    'formation_delete',

    'inscription_view',
    'inscription_add',
    'inscription_edit',
    'inscription_delete',

    'blog_view',
    'blog_add',
    'blog_edit',
    'blog_delete',


    'certification_view',
    'certification_add',
    'certification_edit',
    'certification_delete',

    'exam_view',
    'exam_add',
    'exam_edit',
    'exam_delete',


    'question_view',
    'question_add',
    'question_edit',
    'question_delete',

    'meet_view',
    'meet_add',
    'meet_edit',
    'meet_delete',

    'results_view',
    'results_add',
    'results_edit',
    'results_delete',

    'contact_view',
    'contact_add',
    'contact_edit',
    'contact_delete',

    'document_view',
    'document_add',
    'document_edit',
    'document_delete',

    'comment_view',
    'comment_add',
    'comment_edit',
    'comment_delete',







  ];


  public function run(): void
  {

    foreach ($this->permissions as $permission) {
      Permission::create(['name' => $permission]);
    }


        $this->call(CountrySeeder::class);
        $this->call(StateSeeder::class);
     //   $this->call(CitySeeder::class);


    // Créer un administrateur directement après la création de la table
    $user = new User();
    $user->nom = ' EWAY-ACADEMY';
    $user->prenom = 'Admin';
    $user->email = 'loiceway@gmail.com';
    $user->role = "admin";
    $user->adresse = 'Douala, Cameroun';
    $user->phone = '672553378';
    $user->code_postal = '75000';
    $user->password = Hash::make('672553378');
    $user->save();

    $user1 = new User();
    $user1->nom = ' Tuemo';
    $user1->prenom = 'Thomas';
    $user1->email = 'tuemothomas@gmail.com';
    $user1->role = "admin";
    $user1->adresse = '123 rue de la paix Douala';
    $user1->phone = '672959424';
    $user1->code_postal = '75000';
    $user1->password = Hash::make('123456789');
    $user1->save();

    $user12 = new User();
    $user12->nom = ' Tuemo';
    $user12->prenom = 'Thomas';
    $user12->email = 'thomastuemo@gmail.com';
    $user12->role = "admin";
    $user12->adresse = '123 rue de la paix Douala';
    $user12->phone = '672959424';
    $user12->code_postal = '75000';
    $user12->password = Hash::make('123456789');
    $user12->save();


    //creer un profil developpers
    $dev = new User();
    $dev->nom = "Client";
    $dev->prenom = 'Client';
    $dev->email = 'dev@yahoo.fr';
    $dev->role = "client";
    $dev->adresse = '123 rue du code';
    $dev->phone = '0612345678';
    $dev->code_postal = '75000';
    $dev->password = Hash::make('123456789');
    $dev->save();


    $permissions = Permission::pluck('id', 'id')->all();

    $role = Role::create(['name' => 'admin']);
    $role->syncPermissions($permissions);
    $user->assignRole([$role->id]);

    $role2 = Role::create(['name' => 'developper']);
    $dev->assignRole([$role2->id]);
    $role2->syncPermissions($permissions);


    $role = Role::create(['name' => 'personnel']);


    $cat = new config();
    //  $cat->frais = '15';
    $cat->description = 'Bienvenue à EWAY-ACADEMY, votre passerelle linguistique vers l\'intégration au Canada.';
    $cat->telephone = '672553378';
    $cat->email = 'contact@eway-academy.com';
    $cat->addresse = '168 boul. Saint-Jean Douala Cameroun';

    $cat->save();
  }
}
