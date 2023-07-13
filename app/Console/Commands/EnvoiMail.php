<?php

namespace App\Console\Commands;

use App\Models\ClasseEvenement;
use App\Models\Eleve;
use App\Models\Evenement;
use App\Notifications\EnvoiMail as NotificationsEnvoiMail;
use Illuminate\Console\Command;
use Illuminate\Notifications\Notifiable;

class EnvoiMail extends Command
{
    use Notifiable;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:envoi-mail';

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

        
        $evenement = Evenement::find(1);
        $eleve = Eleve::find(1);
        //
        $eleve->notify(new NotificationsEnvoiMail($evenement, $eleve));
    }
}
