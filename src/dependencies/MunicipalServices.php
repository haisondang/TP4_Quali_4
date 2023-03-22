<?php

namespace iut;

interface MunicipalServices
{
    /**
     * Envoie un message d'alerte aux habitants
     * pour indiquer les restrictions d'eau en cours
     */
    public function sendRestrictionEauInformation();

    /**
     * Appelle un service de livraison d'eau par camion citernes
     * @throws CiterneVideException lorsque les citernes ne peuvent plus livrer d'eau
     */
    public function callLivraisonCiterneEau();
}

?>