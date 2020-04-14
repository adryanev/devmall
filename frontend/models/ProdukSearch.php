<?php
/**
 * Project: devmall.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 11/2/2019
 * Time: 4:50 PM
 */

namespace frontend\models;


use common\models\Produk;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class ProdukSearch extends Produk
{

    public $kategori;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_booth', 'harga', 'nego', 'created_at', 'updated_at',], 'integer'],
            [['nama', 'deskripsi', 'spesifikasi', 'fitur', 'demo', 'manual', 'kategori'], 'safe'],
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
        $query = Produk::find()->innerJoinWith('kategoriProduk', true);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10
            ],
            'sort' => [
                'defaultOrder' => [
                    'harga' => SORT_ASC,
                ]
            ]
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

        $query->andFilterWhere(['like', 'produk.nama', $this->nama])
            ->andFilterWhere(['like', 'deskripsi', $this->deskripsi])
            ->andFilterWhere(['like', 'spesifikasi', $this->spesifikasi])
            ->andFilterWhere(['like', 'fitur', $this->fitur])
            ->andFilterWhere(['like', 'demo', $this->demo])
            ->andFilterWhere(['like', 'manual', $this->manual])
            ->andFilterWhere(['like', 'kategori.nama', $this->kategori]);

        return $dataProvider;
    }
}
