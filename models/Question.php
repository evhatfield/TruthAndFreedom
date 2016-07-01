<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "question".
 *
 * @property integer $id
 * @property integer $lessonId
 * @property integer $number
 * @property integer $type
 * @property string $text
 * @property integer $answerId
 */
class Question extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'question';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[ [ 'lessonId', 'number', 'type', 'text' ], 'required' ],
			[ [ 'lessonId', 'number', 'type', 'answerId' ], 'integer' ],
			[ [ 'text' ], 'string', 'max' => 256 ]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t( 'app', 'ID' ),
			'lessonId' => Yii::t( 'app', 'Lesson ID' ),
			'number' => Yii::t( 'app', 'Number' ),
			'type' => Yii::t( 'app', 'Type' ),
			'text' => Yii::t( 'app', 'Text' ),
			'answerId' => Yii::t( 'app', 'Answer ID' ),
		];
	}
	
	public function getAnswers()
	{
		return $this->hasMany( Answer::className(), [ 'questionId' => 'id' ] );
	}
	
	public static function getTypeName( $type )
	{
		switch ( $type )
		{
			case 0:
				return 'True/False';
			
			case 1:
				return 'Multiple Choice';
			
			case 2:
				return 'Number';
			
			case 3:
				return 'Short Answer';
			
			case 4:
				return 'Multiple Answers';
			
			default:
				return 'Unknown Type';
		}
	}
	
	public function canFindAmongMultipleAnswers( $answer )
	{
		if ( $this->type != 4 )
		{
			throw new Exception( 'Question must be a Multiple Answer question.' );
		}

		return $this->getAnswers()->where( 'text like "%'.$answer.'%"' )->exists();
	}
}
