<?php

namespace app\models\entities;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\service\Statuses;

/**
 * TaskSearch represents the model behind the search form of `app\models\Task`.
 */
class TaskSearch extends Task
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'project_id',
                    'status',
                    'id',
                ],
                'integer'
            ],
            [
                'status',
                'in',
                'range' => Statuses::getStatuses(),
            ],
            [
                [
                    'name',
                    'branch',
                    'content',
                ],
                'string'
            ],

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
        $query = Task::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $project_id = Yii::$app->request->get('project_id');
        $project_id = !empty($project_id) ? $project_id : $this->project_id;

        // grid filtering conditions
        $query->andFilterWhere(['=', 'project_id', $project_id]);
        $query->andFilterWhere(['=', 'status', $this->status]);
        $query->andFilterWhere(['like', 'content', $this->content]);
        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['like', 'branch', $this->branch]);
        $query->orderBy('id DESC');

        return $dataProvider;
    }
}
