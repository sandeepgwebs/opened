<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Fee;

/**
 * FeesSearch represents the model behind the search form about `common\models\Fee`.
 */
class FeesSearch extends Fee
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'paper_no', 'user_type', 'track_id', 'journal_id', 'no_of_papers', 'status', 'payment_method', 'created_at', 'updated_at'], 'integer'],
            [['qualification', 'institute', 'copyright_form', 'file', 'payment', 'payment_id'], 'safe'],
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
    public function search($params)
    {
        $query = Fee::find()->where(['status'=>[0,1,2,3]])->orderBy(['id'=>SORT_DESC]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination'=> false,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'paper_no' => $this->paper_no,
            'user_type' => $this->user_type,
            'track_id' => $this->track_id,
            'journal_id' => $this->journal_id,
            'no_of_papers' => $this->no_of_papers,
            'status' => $this->status,
            'payment_method' => $this->payment_method,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'qualification', $this->qualification])
            ->andFilterWhere(['like', 'institute', $this->institute])
            ->andFilterWhere(['like', 'copyright_form', $this->copyright_form])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'payment', $this->payment])
            ->andFilterWhere(['like', 'payment_id', $this->payment_id]);

        return $dataProvider;
    }
}
