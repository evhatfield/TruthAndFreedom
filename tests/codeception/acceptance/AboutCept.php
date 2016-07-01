<?php

use tests\codeception\_pages\AboutPage;

/* @var $scenario Codeception\Scenario */

$I = new AcceptanceTester( $scenario );
$I->wantTo( 'ensure that about works' );
AboutPage::openBy( $I );
$I->see( 'About', 'h1' );
