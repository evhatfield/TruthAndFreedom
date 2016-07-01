<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Cookie;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\EntryForm;
use app\models\RegisterForm;
use app\models\Student;
use app\models\StudentLesson;
use app\models\Lesson;

class SiteController extends Controller
{
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only' => [ 'logout' ],
				'rules' => [
					[
						'allow' => true,
						'actions' => [ 'login', 'register' ],
						'roles' => [ '?' ],
					],
					[
						'actions' => [ 'logout' ],
						'allow' => true,
						'roles' => [ '@' ],
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [ 'logout' => [ 'post' ] ],
			],
		];
	}

	public function actions()
	{
		return [
			'error' => [ 'class' => 'yii\web\ErrorAction' ],
			'captcha' => [
				'class' => 'yii\captcha\CaptchaAction',
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			],
		];
	}
	
	public function actionIndex()
	{
		if ( !Yii::$app->user->isGuest )
		{
			$student = Student::findByUsername( Yii::$app->user->identity->username );

			if ( $student !== null )
			{
				return $this->redirect( [ 'student-lesson/view', 'id' => $student->getStudentLessons()->min( 'id' ) ] );
			}
		}

		return $this->render( 'index' );
	}
	
	public function actionIntro()
	{
		return $this->render( 'intro' );
	}

	public function actionLogin( $username = null )
	{
		if ( !Yii::$app->user->isGuest )
		{
			return $this->render( 'login', [ 'model' => $model ] );
		}
		
		$model = new LoginForm();
		
		if ( $model->load( Yii::$app->request->post() ) )
		{
			if ( $model->login() )
			{
				if ( $model->username === 'admin' )
				{
					Yii::$app->language = 'en-US';
					Yii::$app->response->cookies->add( new Cookie( [ 'name' => 'language', 'value' => $student->language ] ) );
					return $this->redirect( [ 'lesson/index' ] );
				}

				$student = Student::findByUsername( $model->username );

				if ( $student !== null )
				{
					Yii::$app->language = $student->language;
					Yii::$app->response->cookies->add( new Cookie( [ 'name' => 'language', 'value' => $student->language ] ) );
					$studentLesson = $student->findNextStudentLesson();
					return $this->redirect( [ 'student-lesson/view', 'id' => $studentLesson->id ] );
				}
				else
				{
					$model->logout();
				}
			}
		}

		$model->username = $username;
		return $this->render( 'login', [ 'model' => $model ] );
	}

	public function actionLogout()
	{
		Yii::$app->user->logout();
		return $this->goHome();
	}

	public function actionContact()
	{
		$model = new ContactForm();
		
		if ( $model->load( Yii::$app->request->post() ) && $model->contact( Yii::$app->params[ 'adminEmail' ] ) )
		{
			Yii::$app->session->setFlash( 'contactFormSubmitted' );

			return $this->refresh();
		}
		else
		{
			return $this->render('contact', [ 'model' => $model ] );
		}
	}

	public function actionAbout()
	{
		return $this->render( 'about' );
	}

	public function actionRegister()
	{
		$model = new RegisterForm();

		if ( $model->load( Yii::$app->request->post() ) && $model->validate() )
		{
			$trans = Yii::$app->db->beginTransaction();
			$student = new Student();

			$student->surname = $model->surname;
			$student->givenName  = $model->givenName;
			$student->language = $model->language;
			$student->address1 = $model->address1;
			$student->address2 = $model->address2;
			$student->city = $model->city;
			$student->stateOrProvince = $model->stateOrProvince;
			$student->postalCode = $model->postalCode;
			$student->country = $model->country;
			$student->homePhone = $model->homePhone;
			$student->mobilePhone = $model->mobilePhone;
			$student->email = $model->email;
			$student->username = $model->username;
			$student->password = $student->getHashedPassword( $model->password );
			$student->registeredDate = date_create()->format( 'Y-m-d' /*'Y-m-d H:i:s'*/ );
			$student->profession = $model->profession;
			$student->dateOfBirth = $model->dateOfBirth;
			$student->religion = $model->religion;
			$student->education = $model->education;
			$student->howReferred = $model->howReferred;
			$student->isSaved = $model->isSaved;

			if ( $student->save() )
			{
				$studentLesson = new StudentLesson();
				
				$studentLesson->studentId = $student->id;
				$studentLesson->lessonId = 1; //TODO: Lesson::find()->where( [ 'number' => 1, 'language' => 'en-US' ] )->one()->id;
				
				if ( $studentLesson->lessonId != null )
				{
					if ( $studentLesson->save() )
					{
						$trans->commit();
						Yii::$app->language = $student->language;
						Yii::$app->response->cookies->add( new Cookie( [ 'name' => 'language', 'value' => $student->language ] ) );
						return $this->redirect( [ 'login', 'username' => $model->username ] );						
					}
				}

				$trans->rollBack();
			}
		}

		// either the page is initially displayed or there is some validation error
		return $this->render( 'register', [ 'model' => $model ] );
	}
}
