<?php

namespace app\controllers;

use Yii;
use app\models\StudentLesson;
use app\models\StudentLessonSearch;
use app\models\Student;
use app\models\Lesson;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StudentLessonController implements the CRUD actions for StudentLesson model.
 */
class StudentLessonController extends Controller
{
	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [ 'delete' => [ 'post' ] ],
			],
		];
	}

	/**
	 * Lists all StudentLesson models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		// find current lesson and redirect
		$student = Yii::$app->user;//Student::find()->where( [ 'studentId' => Yii::$app->user->id ] )->one();
		
		if ( $student !== null )
		{
			$studentLesson = StudentLesson::find()->where( [ 'studentId' => $student->id, 'status' => 0 ] )->one();

			if ( $studentLesson !== null )
			{
				return $this->redirect( [ 'view', 'id' => $studentLesson->id ] );
			}
		}
		
		throw new NotFoundHttpException( 'The requested page does not exist.' );
	}

	/**
	 * Displays a single StudentLesson model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView( $id )
	{
		$model = $this->findModel( $id );
		return $this->render( 'view', [ 'model' => $model ] );
	}
	
	protected function gradeQuestions( $questions, $post )
	{
		$totalQuestions = count( $questions );
		$correct = 0;

		foreach ( $questions as $question )
		{
			if ( $question->type < 4 )
			{
				$answer = $post[ 'question' . $question->id ];
				
				if ( $question->type < 2 )
				{
					if ( $answer == $question->answerId )
					{
						$correct++;
					}
				}
				else
				{
					if ( strlen( $answer ) > 0 && strpos( $question->answers[ 0 ]->text, $answer ) !== false )
					{
						$correct++;
					}
				}
			}
			else if ( $question->type == 4 )
			{
				$answersCount = count( $question->answers );

				// we the first answer would already be in the count so we need to add answerscount - 1
				$totalQuestions += $answersCount - 1;
				for ( $i = 0; $i < $answersCount; $i++ )
				{
					$answer = $post[ 'question' . $question->id . '_' . $i ];

					if ( strlen( $answer ) > 0 && $question->canFindAmongMultipleAnswers( $answer ) )
					{
						$correct++;
					}
				}
			}
		}
		
		return $correct / $totalQuestions * 100;
	}
	
	public function actionReview( $id )
	{
		$model = $this->findModel( $id );
		$post = Yii::$app->request->post();
		
		if ( !empty( $post ) )
		{
			$model->grade = $this->gradeQuestions( $model->lesson->questions, $post );
			$model->status = $model->grade >= 70 ? 2 : 1;
			
			if ( $model->save() )
			{
				if ( $model->status == 2 )
				{
					// find ( or create ) and go to next lesson
					$nextStudentLesson = $model->student->findNextStudentLesson();

					if ( $nextStudentLesson !== null )
					{
						return $this->redirect( [ 'view', 'id' => $nextStudentLesson->id ] );
					}
					
					$model->student->sendCompletedEmails();
					return $this->redirect( [ 'view', 'id' => $id ] );
				}
			}
		}

		return $this->render( 'review', [ 'model' => $model ] );
	}

	/**
	 * Creates a new StudentLesson model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new StudentLesson();

		if ( $model->load( Yii::$app->request->post() ) && $model->save() )
		{
			return $this->redirect( [ 'view', 'id' => $model->id ] );
		}
		else
		{
			return $this->render( 'create', [ 'model' => $model ] );
		}
	}

	/**
	 * Updates an existing StudentLesson model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate( $id )
	{
		$model = $this->findModel( $id );

		if ( $model->load( Yii::$app->request->post() ) && $model->save() )
		{
			return $this->redirect( [ 'view', 'id' => $model->id ] );
		}
		else
		{
			return $this->render( 'update', [ 'model' => $model ] );
		}
	}

	/**
	 * Deletes an existing StudentLesson model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete( $id )
	{
		$this->findModel( $id )->delete();

		return $this->redirect( [ 'index' ] );
	}

	/**
	* Finds the StudentLesson model based on its primary key value.
	* If the model is not found, a 404 HTTP exception will be thrown.
	* @param integer $id
	* @return StudentLesson the loaded model
	* @throws NotFoundHttpException if the model cannot be found
	*/
	protected function findModel( $id )
	{
		if ( ( $model = StudentLesson::findOne( $id ) ) !== null )
		{
			return $model;
		}
		else
		{
			throw new NotFoundHttpException( 'The requested page does not exist.' );
		}
	}
}
