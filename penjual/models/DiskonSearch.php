<?php

namespace penjual\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Diskon;

/**
 * DiskonSearch represents the model behind the search form of `common\models\Diskon`.
 */
class DiskonSearch extends Diskon
{
    /**
     * {@inheritdoc}
     */
    public $produk;
    public $galeri_produk;

    public function rules()
    {
        return [
            [['id', 'id_produk', 'persentase', 'created_at', 'updated_at'], 'integer'],
            [['produk','galeri_produk'], 'safe']
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
        $query = Diskon::find();
        $query->joinWith(['produk']);
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
            'id_produk' => $this->id_produk,
            'persentase' => $this->persentase,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
