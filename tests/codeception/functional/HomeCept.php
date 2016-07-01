<?php

/* @var $scenario Codeception\Scenario */

$I = new FunctionalTester( $scenario );
$I->wantTo( 'ensure that home page works' );
$I->amOnPage( Yii::$app->homeUrl );
$I->see( 'Truth And Freedom' );
$I->seeLink( 'About' );
$I->click( 'About' );
$I->see( 'This is the About page.' );
