<?php

namespace app\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

class LanguageSwitcher extends Widget
{
	public $cookieName = 'language';

	public function init()
	{
		parent::init();
		$cookies = Yii::$app->response->cookies;
		$languageNew = Yii::$app->request->get( 'sysLanguage' );

		if ( $languageNew )
		{
			Yii::$app->language = $languageNew;
			$cookies->add( new \yii\web\Cookie( [ 'name' => $this->cookieName, 'value' => $languageNew ] ) );
		}

		elseif( $cookies->has( $this->cookieName ) )
		{
			Yii::$app->language = $cookies->getValue( $this->cookieName );
		}
	}

	public function run()
	{
		return '<form method="get">' . Html::dropDownList( 'sysLanguage', Yii::$app->language, Yii::$app->params[ 'languages' ], [ 'onchange' => 'this.form.submit()' ] ) . '</form>';

/*
		echo ButtonDropdown::widget( [ 'label' => $current, 'dropdown' => [ 'items' => $items ] ] );
*/
	}
}