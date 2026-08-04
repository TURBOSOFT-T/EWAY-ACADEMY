<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmationMail;
use Illuminate\Support\Facades\Mail;

use App\Models\Inscription;
use App\Http\Requests\StoreInscriptionRequest;
use App\Http\Requests\UpdateInscriptionRequest;
use App\Models\Event;
use App\Models\notifications;
use Illuminate\Http\Request;

use App\Http\Requests\commandes\CommandesRequest;

use App\Models\{City, commandes, produits, contenu_commande, config, Contenu_Inscription, Country, Formation, State, User};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
//use Illuminate\Support\Facade\Mail;

use Illuminate\Support\Facades\Hash;
use App\Mail\OrderMail;
use App\Mail\FirstOrder;
use App\Mail\InscriptionConfirmationMail;
use Illuminate\Support\Facades\DB;
use App\Notifications\NewOrder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Mail\Mailable;
use App\Services\PayUService\Exception;
use Illuminate\Validation\ValidationException;
use App\Mail\register as MailRegister;
use App\Mail\WelcomeUserMail;

class InscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function event_inscription($id)
    {
        $event = Event::findOrFail($id);
        $countries = Country::select("id", "name")->get();
        // dd($event);
        return view('front.events.inscription', compact('event', 'countries'));
    }

    public function formation_inscription($id)
    {
        $formation = Formation::findOrFail($id);
        $countries = Country::select("id", "name", "phonecode")->get();
        $states = State::select('id', 'name', 'country_id')->get();
         $type = $formation->type;
        // dd($event);
        return view('front.formations.inscription', compact('formation', 'countries', 'states','type'));
    }

    public function fetchState(Request $request)

    {
        $data['states'] = State::where("country_id", $request->country_id)
            ->get(["name", "id"]);
        return response()->json($data);
    }


    public function fetchCity(Request $request)
    {
        $data['cities'] = City::where("state_id", $request->state_id)
            ->get(["name", "id"]);
        return response()->json($data);
    }




    public function confirmFormation(Request $request)
    {
        try {
            $request->validate([
                'formation_id' => 'required|exists:formations,id',
                'country_id' => 'nullable|exists:countries,id',
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'email' => 'required|email',
                'telephone' => 'nullable|string|max:20',
                'addresse' => 'nullable|string|max:255',
                'message' => 'nullable|string',
            ]);
            // Vérifie si l'utilisateur est déjà inscrit à cet événement
            $exists = Inscription::where('email', $request->email)
                ->where('formation_id', $request->formation_id)
                ->exists();

            if ($exists) {
                return response()->json([
                    'status' => 'duplicate',
                    'message' => 'Vous êtes déjà inscrit à cette formation.'
                ]);
            }

            if (Auth::check()) {
                $userId = Auth::id();
            } else {
                $user = User::where('email', $request->email)->first();

                if (!$user) {
                    $temporaryPassword = Str::random(8);
                    $user = User::create([
                        'nom' => $request->input('nom'),
                        'prenom' => $request->input('prenom'),
                        'email' => $request->input('email'),
                        //   'password' => Hash::make($request->input('telephone')),
                        'password' => Hash::make($temporaryPassword),
                        'phone' => $request->input('telephone'),
                    ]);

                    Mail::to($user->email)->send(new WelcomeUserMail($user, $temporaryPassword));
                }

                $userId = $user->id;
            }

            // $userId = Auth::check() ? Auth::id() : null;

            $inscription = new Inscription([
                'user_id' => $userId,
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'whatsapp' => $request->whatsapp,
                'addresse' => $request->addresse,
                'message' => $request->message,
                'formation_id' => $request->formation_id,
                'type' => 'Formation',
                'country_id' => $request->country_id,
                'ville' => $request->ville,
                //   'state_id' => $request->state_id,
                //  'city_id' => $request->city_id,
            ]);

            $inscription->save();

            $this->sendConfirmationMail($inscription);


            return response()->json([
                'message' => 'Inscription enregistrée avec succès.....'
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'line' => $e->getLine()], 500);
        }
    }


    public function sendConfirmationMail($inscription)
    {


        try {
            Mail::to($inscription->email)->send(new InscriptionConfirmationMail($inscription));
        } catch (\Exception $e) {
            \Log::error('Erreur d\'envoi mail: ' . $e->getMessage());
        }
    }




    public function destroy($id)
    {
        $formation =   Inscription::find($id);

        if ($formation) {


            // Supprimer le formation
            $formation->delete();


            return redirect()->back()
                ->with('success', 'Inscription supprimée avec succès.');
        } else {
            return redirect()->back()('error', 'formation non trouvé.');
        }
    }
}
