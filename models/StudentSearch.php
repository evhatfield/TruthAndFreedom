<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Student;

/**
 * StudentSearch represents the model behind the search form about `app\models\Student`.
 */
class StudentSearch extends Student
{
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[ [ 'id', 'isSaved' ], 'integer' ],
			[ [ 'surname', 'givenName', 'language', 'address1', 'address2', 'city', 'stateOrProvince', 'postalCode', 'country', 'homePhone', 'mobilePhone', 'email', 'username', 'password', 'registeredDate', 'profession', 'dateOfBirth', 'religion', 'education', 'howReferred' ], 'safe' ],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function scenarios()
	{
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}

	/**
	* Creates data provider instance with search query applied
	*
	* @param array $params
	*
	* @return ActiveDataProvider
	*/
	public function search( $params )
	{
		$query = Student::find();
		$dataProvider = new ActiveDataProvider( [ 'query' => $query ] );
		$this->load( $params );

		if ( !$this->validate() )
		{
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}

		$query->andFilterWhere( [
			'id' => $this->id,
			'registeredDate' => $this->registeredDate,
			'dateOfBirth' => $this->dateOfBirth,
			'isSaved' => $this->isSaved,
		] );

		$query->andFilterWhere( [ 'like', 'surname', $this->surname ] )
			->andFilterWhere( [ 'like', 'givenName', $this->givenName ] )
			->andFilterWhere( [ 'like', 'language', $this->language ] )
			->andFilterWhere( [ 'like', 'address1', $this->address1 ] )
			->andFilterWhere( [ 'like', 'address2', $this->address2 ] )
			->andFilterWhere( [ 'like', 'city', $this->city ] )
			->andFilterWhere( [ 'like', 'stateOrProvince', $this->stateOrProvince ] )
			->andFilterWhere( [ 'like', 'postalCode', $this->postalCode ] )
			->andFilterWhere( [ 'like', 'country', $this->country ] )
			->andFilterWhere( [ 'like', 'homePhone', $this->homePhone ] )
			->andFilterWhere( [ 'like', 'mobilePhone', $this->mobilePhone ] )
			->andFilterWhere( [ 'like', 'email', $this->email ] )
			->andFilterWhere( [ 'like', 'username', $this->username ] )
			->andFilterWhere( [ 'like', 'password', $this->password ] )
			->andFilterWhere( [ 'like', 'profession', $this->profession ] )
			->andFilterWhere( [ 'like', 'religion', $this->religion ] )
			->andFilterWhere( [ 'like', 'education', $this->education ] )
			->andFilterWhere( [ 'like', 'howReferred', $this->howReferred ] );

		return $dataProvider;
	}
	
	public function getStudentLessons()
	{
		return $this->hasMany( StudentLesson::className(), [ 'studentId' => 'id' ] );
	}
}
