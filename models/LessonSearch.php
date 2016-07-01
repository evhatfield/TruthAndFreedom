<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Lesson;

/**
 * LessonSearch represents the model behind the search form about `app\models\Lesson`.
 */
class LessonSearch extends Lesson
{
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[ [ 'id', 'number' ], 'integer' ],
			[ [ 'language', 'title', 'text' ], 'safe' ],
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
		$query = Lesson::find();
	
		$dataProvider = new ActiveDataProvider( [ 'query' => $query ] );
	
		$this->load( $params );
	
		if ( !$this->validate() )
		{
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}

		$query->andFilterWhere( [ 'id' => $this->id, 'number' => $this->number ] );

		$query->andFilterWhere( [ 'like', 'language', $this->language ] )
			->andFilterWhere( [ 'like', 'title', $this->title ] )
			->andFilterWhere( [ 'like', 'text', $this->text ] );

		return $dataProvider;
	}
}
