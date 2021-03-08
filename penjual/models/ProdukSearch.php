<?php

namespace penjual\models;

use common\models\Produk;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ProdukSearch represents the model behind the search form of `common\models\Produk`.
 */
class ProdukSearch extends Produk
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_booth', 'harga', 'nego', 'created_at', 'updated_at'], 'integer'],
            [['nama', 'deskripsi', 'spesifikasi', 'fitur', 'demo', 'manual'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Produk::find()->where(['id_booth' => Yii::$app->user->identity->booth->id]);

        $query->joinWith(['diskon']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'id_booth' => $this->id_booth,
            'harga' => $this->harga,
            'nego' => $this->nego,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'deskripsi', $this->deskripsi])
            ->andFilterWhere(['like', 'spesifikasi', $this->spesifikasi])
            ->andFilterWhere(['like', 'fitur', $this->fitur])
            ->andFilterWhere(['like', 'demo', $this->demo])
            ->andFilterWhere(['like', 'manual', $this->manual]);

        return $dataProvider;
    }
}
