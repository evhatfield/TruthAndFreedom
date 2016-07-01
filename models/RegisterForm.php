<?php

namespace app\models;

use Yii;
use yii\base\Model;

class RegisterForm extends Model
{
	public $surname;
	public $givenName;
	public $language;
	public $address1;
	public $address2;
	public $city;
	public $stateOrProvince;
	public $postalCode;
	public $country;
	public $homePhone;
	public $mobilePhone;
	public $email;
	public $username;
	public $password;
	public $confirmPassword;
	public $registeredDate;
	public $profession;
	public $dateOfBirth;
	public $religion;
	public $education;
	public $howReferred;
	public $isSaved;

	public function rules()
	{
		return [
			[ [ 'surname', 'givenName', 'language', 'email', 'password', 'confirmPassword' ], 'required' ],
			[ [ 'dateOfBirth' ], 'safe' ],
			[ [ 'isSaved' ], 'integer' ],
			[ [ 'surname', 'givenName', 'stateOrProvince' ], 'string', 'max' => 20 ],
			[ [ 'address1', 'address2', 'email', 'education' ], 'string', 'max' => 50 ],
			[ [ 'city', 'country', 'profession', 'religion', 'howReferred' ], 'string', 'max' => 25 ],
			[ [ 'language', 'postalCode' ], 'string', 'max' => 10 ],
			[ [ 'homePhone', 'mobilePhone', 'username' ], 'string', 'max' => 15 ],
			[ [ 'password', 'confirmPassword' ], 'string', 'max' => 25 ],
			[ 'email', 'email' ],
			[ 'confirmPassword', 'compare', 'compareAttribute' => 'password' ],
			[ [ 'password', 'confirmPassword' ], 'safe' ]
		];
	}

	public function attributeLabels()
	{
		return [
			'surname' => Yii::t( 'app', 'Surname' ),
			'givenName' => Yii::t( 'app', 'Given Name' ),
			'language' => Yii::t( 'app', 'Language' ),
			'address1' => Yii::t( 'app', 'Address1' ),
			'address2' => Yii::t( 'app', 'Address2' ),
			'city' => Yii::t( 'app', 'City' ),
			'stateOrProvince' => Yii::t( 'app', 'State Or Province' ),
			'postalCode' => Yii::t( 'app', 'Postal Code' ),
			'country' => Yii::t( 'app', 'Country' ),
			'homePhone' => Yii::t( 'app', 'Home Phone' ),
			'mobilePhone' => Yii::t( 'app', 'Mobile Phone' ),
			'email' => Yii::t( 'app', 'Email' ),
			'username' => Yii::t( 'app', 'Username' ),
			'password' => Yii::t( 'app', 'Password' ),
			'confirmPassword' => Yii::t( 'app', 'Confirm Password' ),
			'profession' => Yii::t( 'app', 'Profession' ),
			'dateOfBirth' => Yii::t( 'app', 'Date Of Birth' ),
			'religion' => Yii::t( 'app', 'Religion' ),
			'education' => Yii::t( 'app', 'Education' ),
			'howReferred' => Yii::t( 'app', 'How Referred' ),
			'isSaved' => Yii::t( 'app', 'Is Saved' ),
		];
	}
}
