<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "answer".
 *
 * @property integer $id
 * @property integer $questionId
 * @property integer $text
 */
class Answer extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'answer';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[ [ 'text' ], 'required' ],
			[ [ 'questionId' ], 'integer' ],
			[ [ 'questionId' ], 'string', 'max' => 256 ]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t( 'app', 'ID' ),
			'questionId' => Yii::t( 'app', 'Question ID' ),
			'text' => Yii::t( 'app', 'Text' ),
		];
	}
}
