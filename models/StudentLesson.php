<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "studentLesson".
 *
 * @property integer $id
 * @property integer $studentId
 * @property integer $lessonId
 * @property integer $status
 * @property integer $grade
 */
class StudentLesson extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'studentLesson';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[ [ 'studentId', 'lessonId' ], 'required' ],
			[ [ 'studentId', 'lessonId', 'status', 'grade' ], 'integer' ]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t( 'app', 'ID' ),
			'studentId' => Yii::t( 'app', 'Student ID' ),
			'lessonId' => Yii::t( 'app', 'Lesson ID' ),
			'status' => Yii::t( 'app', 'Status' ),
			'grade' => Yii::t( 'app', 'Grade' ),
		];
	}
	
	public function getLesson()
	{
		return $this->hasOne( Lesson::className(), [ 'id' => 'lessonId' ] );
	}
	
	public function getStudent()
	{
		return $this->hasOne( Student::className(), [ 'id' => 'studentId' ] );
	}
	
	public function findPrevious()
	{
		$lesson = Lesson::find()->where( [ 'number' => $this->lesson->number - 1, 'language' => $this->student->language ] )->one();
		return $this->find()->where( [ 'lessonId' => $lesson->id, 'studentId' => $this->student->id ] )->one();
	}
	
	public function findNext()
	{
		$lesson = Lesson::find()->where( [ 'number' => $this->lesson->number + 1, 'language' => $this->student->language ] )->one();
		return static::find()->where( [ 'lessonId' => $lesson->id, 'studentId' => $this->student->id ] )->one();
	}
}
