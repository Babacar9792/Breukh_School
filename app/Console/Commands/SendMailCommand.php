<?php

// namespace App\Console\Commands;

// use App\Mail\SendMail;
// use Illuminate\Console\Command;
// use Illuminate\Support\Facades\Mail;

// class SendMailCommand extends Command
// {
//     /**
//      * The name and signature of the console command.
//      *
//      * @var string
//      */
//     protected $signature = 'app:send-mail-command';

//     /**
//      * The console command description.
//      *
//      * @var string
//      */
//     protected $description = 'Command description';

//     /**
//      * Execute the console command.
//      */
//     public function handle($tab)
//     {
//         //
//         // $this->line("bonsoir medames ");
//         // return ["message" =>"bonjour"];
//         for ($i = 0; $i < count($tab); $i++) {
//             # code...
//             $details = [
//                 'title' => 'Doucouré',
//                 'body' => 'Ehh ki dou ,
//                 boy moussa sou mail bii nieuwé nga def ma signe',
//                 'nom' => $tab[$i]->prenom
//             ];

//             // Mail::to($tab[$i]->email)->send(new SendMail($details));
//             Mail::to('sagnam481@gmail.com')->send(new SendMail($details));
//         }
//     }
// }




namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Eleve;
use App\Models\Event;
use App\Mail\EnvoiMail;
use App\Mail\SendMail;
use App\Models\Inscription;
use App\Models\Participant;
use App\Models\AnneScolaire;
use App\Models\ClasseEvenement;
use App\Models\Evenement;
use App\Models\Initiateur;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-mail-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */




public function handle()
{
    $tomorrow = Carbon::now()->addDay();
    $events = ClasseEvenement::whereDate('date_evenement', $tomorrow)->get();

    foreach ($events as $event) {
        $this->info($event);
        $user = Initiateur::where('id', $event->initiateur_id)->select('email', 'nom_initiateur')->first();
        $subject = 'Rappels d\'evenements';
        // $user_email = $user->email;
        $user_name = $user->nom_initiateur;
        // $this->info($user_email);
        $this->info($user_name);

        $classeId = $event->participants()->select('classe_id')->first();
        $this->info($classeId);
        $inscriptions = Inscription::where('classe_id', $classeId->classe_id)->get();
        $this->info($inscriptions);
        $id_eleve = $inscriptions->pluck('eleve_id');
        $this->info($id_eleve);
        foreach ($id_eleve as $el){
            $this->info($el);
            $student = Eleve::where('id', $el)->select('email', 'nom', 'prenom', 'sexe')->first();
            $this->info($student->email);
            $sexe = "Mme";
            if($student->sexe = "masculin"){   $sexe = "Mr";}
        
            $message = "Bonjour {$sexe} {$student->prenom} {$student->nom} nous teneons à vous rappeler que demain aura lieu un(e) {$event->libelle} qui concerne toute votre classe. Merci de contacter l'initiateur de cet événenment {$user_name}";
            Mail::to("pisupniang.com")->send(new SendMail($subject, $message));
        }
        $mes = "Bonjour <br> {$user_name} nous tenons à vous informer de l'événement {$event->libelle} que vous aviez plannifié aura lieu demain inshaAllah.";
        Mail::to("pisupniang.com")->send(new SendMail($subject, $mes));
    }
  }

}
