<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

use \Mockery\Adapter\Phpunit\MockeryTestCase;
use iut\GestionEauService;
use iut\CiterneVideException;

require __DIR__ . '/../vendor/autoload.php';

class GestionEauServiceTest extends MockeryTestCase
{
    public function test_restrictionEau()
    {
        //GIVEN
        $iss = \Mockery::mock('InfoSecheresseService');
        $iss->shouldReceive('previsionDureeSecheresse')->andReturn(12);
        $es = \Mockery::mock('EtatService');
        $ms = \Mockery::spy('MunicipalServices');
        $ges = new GestionEauService($iss, $es, $ms);
        
        //WHEN
        $ges->checkEtatSecheresse();

        //THEN
        $ms->shouldHaveReceived()->sendRestrictionEauInformation();

    }

    public function test_livraisonEau()
    {
        //GIVEN
        $iss = \Mockery::mock('InfoSecheresseService');
        $iss->shouldReceive('previsionDureeSecheresse')->andReturn(21);
        $iss->shouldReceive('reserveEauMunicipale')->andReturn(27.0);
        $es = \Mockery::mock('EtatService');
        $ms = \Mockery::spy('MunicipalServices');
        $ges = new GestionEauService($iss, $es, $ms);
        
        //WHEN
        $ges->checkEtatSecheresse();

        //THEN
        $ms->shouldHaveReceived()->callLivraisonCiterneEau();

    }

    /*public function test_alertEtat()
    {
        //GIVEN
        $iss = \Mockery::mock('InfoSecheresseService');
        $iss->shouldReceive('previsionDureeSecheresse')->times(3)->andReturn(21, 24, 27);
        $iss->shouldReceive('reserveEauMunicipale')->times(3)->andReturn(27, 49, 26);
        $es = \Mockery::spy('EtatService');
        $ms = \Mockery::mock('MunicipalServices');
        $ms->shouldReceive('callLivraisonCiterneEau')->andThrow(new CiterneVideException());
        $ges = new GestionEauService($iss, $es, $ms);
        
        //WHEN
        $ges->checkEtatSecheresse();

        //THEN
        $this->assertTrue($es->shouldHaveReceived()->sendAlerteEau());

    }*/
}
