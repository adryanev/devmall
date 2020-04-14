<?php

namespace admin\models;

use common\models\VerifikasiUser;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * VerifikasiUserSearch represents the model behind the search form of `common\models\VerifikasiUser`.
 */
class VerifikasiUserSearch extends VerifikasiUser
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_user', 'status', 'created_at', 'updated_at'], 'integer'],
            [['nama_file', 'jenis_verifikasi'], 'safe'],
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
        $query = VerifikasiUser::find()->where(['status' => VerifikasiUser::STATUS_DIKIRIM]);

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
            'id_user' => $this->id_user,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'nama_file', $this->nama_file])
            ->andFilterWhere(['like', 'jenis_verifikasi', $this->jenis_verifikasi]);

        return $dataProvider;
    }
}
