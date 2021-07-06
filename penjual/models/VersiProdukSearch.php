<?php

namespace penjual\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\VersiProduk;

/**
 * VersiProdukSearch represents the model behind the search form of `common\models\VersiProduk`.
 */
class VersiProdukSearch extends VersiProduk
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_produk', 'created_at', 'updated_at'], 'integer'],
            [['link_lama', 'link_baru', 'catatan_perubahan', 'cara_instalasi'], 'safe'],
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
        $query = VersiProduk::find();

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'link_lama', $this->link_lama])
            ->andFilterWhere(['like', 'link_baru', $this->link_baru])
            ->andFilterWhere(['like', 'catatan_perubahan', $this->catatan_perubahan])
            ->andFilterWhere(['like', 'cara_instalasi', $this->cara_instalasi]);

        return $dataProvider;
    }
}
