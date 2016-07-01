<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Question;

/**
 * QuestionSearch represents the model behind the search form about `app\models\Question`.
 */
class QuestionSearch extends Question
{
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[ [ 'id', 'lessonId', 'number', 'type', 'answerId' ], 'integer' ],
			[ [ 'text' ], 'safe' ],
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
		$query = Question::find();

		$dataProvider = new ActiveDataProvider( [ 'query' => $query	] );

		$this->load( $params );

		if ( !$this->validate() )
		{
			// we do not want to return any records when validation fails
			$query->where( '0 = 1' );
			return $dataProvider;
		}

		$query->andFilterWhere( [
			'id' => $this->id,
			'lessonId' => $this->lessonId,
			'number' => $this->number,
			'type' => $this->type,
			'answerId' => $this->answerId,
		] );

		$query->andFilterWhere( [ 'like', 'text', $this->text ] );

		return $dataProvider;
	}
}
