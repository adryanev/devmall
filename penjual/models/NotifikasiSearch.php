<?php


namespace penjual\models;

use common\models\Notifikasi;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class NotifikasiSearch extends Notifikasi
{

    public $user;
    /**
     * @inheritDoc
     */
    public function rules()
    {
        return [
            [['id', 'id_data'], 'integer'],
            [['sender', 'receiver','context', 'jenis_data', 'status'], 'string'],
        ];
    }

    /**
     * @inheritDoc
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param  array  $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {

        $query = Notifikasi::find();    

        $query->joinWith(['user']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ]            
        ]);

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like','user.username', $this->sender])
                ->andFilterWhere(['like','notifikasi.receiver', Yii::$app->user->identity->id])
                ->andFilterWhere(['like','notifikasi.context', $this->context])
                ->andFilterWhere(['like','notifikasi.status', $this->status])
                ->addOrderBy('id', 'DESC');


        return $dataProvider;
    }
}
