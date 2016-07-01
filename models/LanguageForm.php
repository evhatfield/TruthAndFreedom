<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class LanguageForm extends Model
{
	public $sytemLanguage;

	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return [
			// systemLanguage required
			[ [ 'systemLanguage' ], 'required' ],
		];
	}
}
