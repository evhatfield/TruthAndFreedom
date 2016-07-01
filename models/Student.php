<?php

namespace app\models;

use Yii;
use \yii\db\ActiveRecord;
use \yii\web\IdentityInterface;

/**
 * This is the model class for table "student".
 *
 * @property integer $id
 * @property string $surname
 * @property string $givenName
 * @property string $language
 * @property string $address1
 * @property string $address2
 * @property string $city
 * @property string $stateOrProvince
 * @property string $postalCode
 * @property string $country
 * @property string $homePhone
 * @property string $mobilePhone
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $registeredDate
 * @property string $profession
 * @property string $dateOfBirth
 * @property string $religion
 * @property string $education
 * @property string $howReferred
 * @property integer $isSaved
 */
class Student extends ActiveRecord  implements IdentityInterface
{
	const auth_key = 'ABCDefghIJKLmnop';
	public $emails = [
		'en-US' => [ 'vsn2020asia@aol.com', 'jam_esm2003@yahoo.co.in', 'wegurganus@gmail.com', 'heaili@hushmail.com' ],
		'zh-CN' => [ 'vsn2020asia@aol.com', 'jam_esm2003@yahoo.co.in', 'wegurganus@gmail.com', 'heaili@hushmail.com' ]
	];
	
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'student';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[ [ 'surname', 'givenName', 'language', 'email', 'registeredDate', 'password' ], 'required' ],
			[ [ 'registeredDate', 'dateOfBirth' ], 'safe' ],
			[ [ 'isSaved' ], 'integer' ],
			[ [ 'surname', 'givenName', 'stateOrProvince' ], 'string', 'max' => 20 ],
			[ [ 'address1', 'address2', 'email', 'education' ], 'string', 'max' => 50 ],
			[ [ 'city', 'country', 'profession', 'religion', 'howReferred' ], 'string', 'max' => 25 ],
			[ [ 'postalCode', 'language' ], 'string', 'max' => 10 ],
			[ [ 'homePhone', 'mobilePhone', 'username' ], 'string', 'max' => 15 ],
			[ [ 'password' ], 'string', 'max' => 128 ],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t( 'app', 'ID' ),
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
			'registeredDate' => Yii::t( 'app', 'Registered Date' ),
			'profession' => Yii::t( 'app', 'Profession' ),
			'dateOfBirth' => Yii::t( 'app', 'Date Of Birth' ),
			'religion' => Yii::t( 'app', 'Religion' ),
			'education' => Yii::t( 'app', 'Education' ),
			'howReferred' => Yii::t( 'app', 'How Referred' ),
			'isSaved' => Yii::t( 'app', 'Is Saved' ),
		];
	}
	
	public function getStudentLessons()
	{
		return $this->hasMany( StudentLesson::className(), [ 'studentId' => 'id' ] );
	}

	public static function findByUsername( $username )
	{
		return static::findOne( [ 'username' => $username ] );
/*		foreach ( self::$users as $user )
		{
			if ( strcasecmp( $user[ 'username' ], $username ) === 0 )
			{
				return new static( $user );
			}
		}
		
		return null;
*/
	}
	
	public static function findIdentity( $id )
	{
		return static::findOne( $id );
	}
	
	public static function findIdentityByAccessToken( $token, $type = null )
	{
		return static::findOne( [ 'access_token' => $token ] );
	}
	
	public function findNextStudentLesson()
	{
		// if we find a started or failed student lesson return it
		if ( $this->getStudentLessons()->where( [ 'status' => [0, 1 ] ] )->count() > 0 )
		{
			return $this->getStudentLessons()->where( [ 'status' => [ 0, 1 ] ] )->one();
		} // if ( $this->studentLessons->where( [ 'status' => [0, 1 ] ] )->count() > 0 )

		$lessonCount = Lesson::find()->where( [ 'language' => 'en-US' ] )->count();

		// if the user has completed all the lessons, go to the last one
		if ( $this->getStudentLessons()->count() === $lessonCount )
		{
			return $this->getStudentLessons()->orderBy( 'id' )->all()[ $lessonCount - 1 ];
		} // if ( $this->studentLessons->count() === $lessonCount )

		// haven't found one, so we need to create the next one
		$newLesson = Lesson::find()->where( [ 'language' => $this->language, 'number' => $this->getStudentLessons()->count() + 1 ] )->one();
		
		if ( $newLesson != null )
		{
			$studentLesson = new StudentLesson();
			$studentLesson->studentId = $this->id;
			$studentLesson->lessonId = $newLesson->id;
			$studentLesson->save();
			return $studentLesson;
		}

		return null;
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getAuthKey()
	{
		return auth_key;
	}
	
	public function validateAuthKey( $authKey )
	{
		return $this->getAuthKey() === $authKey;
	}
	
	public function getHashedPassword( $password )
	{
		$salt = mcrypt_create_iv( 64, MCRYPT_DEV_URANDOM );
		return password_hash( $password, PASSWORD_BCRYPT, [ 'salt' => $salt ] );
	}
	
	public function validatePassword( $password )
	{
		return password_verify( $password, $this->password );
	}
	
	public function sendCompletedEmails()
	{
		$body = 'The following student has completed all lessons:<br/>' .
					$student->givenName . ' ' . $student->surname . '<br/>' .
					$student->address1 . '<br/>' .
					$student->address2 . '<br/>' .
					$student->city . ', ' . $student->state . ' ' . $student->postalCode . ' ' . $student->country . '<br/>' .
					'Home ' . $student->homePhone . '<br/>' .
					'Mobile ' . $student->mobilePhone . '<br/>' .
					'Email ' . $student->email . '<br/>';
		Yii::$app->mailer->compose()
			->setTo( $this->emails[ $this->language ] )
			->setFrom( Yii::$app->params[ 'adminEmail' ] )
			->setSubject( 'Course Completed' )
			->setTextBody( $body )
			->send();
	}
}
