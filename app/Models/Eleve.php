<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Eleve extends Model
{
    use Notifiable;
    protected $hidden = [
        'password',
        'remember_token',
        "updated_at",
        "created_at"
    ];
    public function __construct()
    {
        // dd(parent::__construct($profil));


        // $this->numero =8;
        $this->numero = $this->getNumero();
        // $ancien = $this->getLastOut($this->numero);
        // $ancien->update(["etat" => 2]);


    }


    public function Inscriptions(): HasMany
    {
        return $this->hasMany(Inscription::class);
    }
    public function getNumero()
    {
        // les éléves ayant un etat 0 sont considérés comme exclus
        $eleve = DB::table('eleves')->whereRaw('etat = ? AND profil = ?', [0, 1])->get();
        $num = DB::table('eleves')->max("numero");
        if (count($eleve) == 0) {
            // $message = "aucun numero disponible pour une réattribution";

            return $num + 1;
        } else {
            $message = "des numéros sont dispo";
            $tab = [];
            for ($i = 0; $i < count($eleve); $i++) {
                # code...
                if (count($this->verifieIfOnly($eleve[$i]->numero)) == 0) {

                    array_push($tab, $eleve[$i]->numero);
                }
            }
            if(count($tab) != 0)
            {
                return min($tab);
            }
            else 
            {
                return $num + 1;
            }
        }
    }

    public function getLastOut($num)
    {
        // dd($numero);
        return DB::table('eleves')->where('etat', 0)->where('numero', $num)->get();
        // return Eleve::all();
    }


    public function verifieIfOnly($numero)
    {
        return DB::table('eleves')->where('etat', 1)->where('numero', $numero)->get();
    }

    public function getNumeroDoAly()
    {
        $numero = DB::table("eleves")->where("etat", 1)->where("profil", 1)->orderByRaw("numero");
        return $numero;
    }

    protected $fillable = [
        'etat'
    ];


    public function scopeSortie(Builder $builder, array $idEleves , $sens)
    {
        return $builder->whereIn('id', $idEleves)->update(['etqt' => $sens]);
    }
    public function scope(Builder $buider, $profil, $etat)
    {
        return Eleve::whereRaw("etat = ? AND profil = ?", [$etat, $profil])->get();
    }
    use HasFactory;
}
