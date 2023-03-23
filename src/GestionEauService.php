<?php
namespace iut;
use InfoSecheresseService;
use EtatService;
use MunicipalServices;

class GestionEauService
{

    private InfoSecheresseService $info;
    private EtatService $etat;
    private MunicipalServices $municipal;

    function __construct(InfoSecheresseService $infoSecheresse, EtatService $serviceEtat, MunicipalServices $servicesMunicipaux) {
        $this->info = $infoSecheresse;
        $this->etat = $serviceEtat;
        $this->municipal = $servicesMunicipaux;
    }

    public function checkEtatSecheresse() {
        if($this->info->previsionDureeSecheresse()>20 &&
                $this->info->reserveEauMunicipale()<100.0){
            $this->municipal->callLivraisonCiterneEau();
       }

       if($this->info->previsionDureeSecheresse()>10){
            $this->municipal->sendRestrictionEauInformation();
       }
    }
}
