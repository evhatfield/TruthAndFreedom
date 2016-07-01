<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lesson".
 *
 * @property integer $id
 * @property integer $number
 * @property string $language
 * @property string $title
 * @property string $text
 */
class Lesson extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'lesson';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[ [ 'number', 'language', 'title', 'text' ], 'required' ],
			[ [ 'number' ], 'integer' ],
			[ [ 'text' ], 'string' ],
			[ [ 'language' ], 'string', 'max' => 5 ],
			[ [ 'title' ], 'string', 'max' => 50 ],
			[ [ 'number', 'language' ], 'unique', 'targetAttribute' => [ 'number', 'language' ], 'message' => 'The combination of Number and Language has already been taken.' ]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t( 'app', 'ID' ),
			'number' => Yii::t( 'app', 'Number' ),
			'language' => Yii::t( 'app', 'Language' ),
			'title' => Yii::t( 'app', 'Title' ),
			'text' => Yii::t( 'app', 'Text' ),
		];
	}

	public function getQuestions()
	{
		return $this->hasMany( Question::className(), [ 'lessonId' => 'id' ] );
	}

	public function findNextLesson()
	{
		return static::find()->where( [ 'language' => $this->language, 'number' => $this->number + 1 ] );
	}

	public static function findLesson( $num, $lang )
	{
		return static::findOne( [ 'number' => $num, 'language' => $lang ] );
	}

	public static function findById( $id )
	{
		return static::findOne( [ 'id' => $id ] );
	}

	public static function getLanguageName( $lang )
	{
		switch ( $lang )
		{
			case 'en-US':
				return 'English';

			case 'zh-Hans':
				return '中文（简体）';

			case 'ta':
				return 'தமிழ்';

			case 'ml':
				return 'മലയാളം';
		}
	}
}
