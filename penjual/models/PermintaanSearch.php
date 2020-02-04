<?php


namespace penjual\models;

use common\helpers\UnixToDateTrait;
use common\models\PermintaanProduk;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class PermintaanSearch extends PermintaanProduk
{
    use UnixToDateTrait;

    public $user;
    public $deadlineText;

    /**
     * @inheritDoc
     */
    public function rules()
    {
        return [
            [['uang_muka', 'harga', 'deadline', 'status'], 'integer'],
            [['nama', 'kriteria', 'keterangan'], 'string'],
            [['progres'], 'double'],
            [['user', 'deadlineText'], 'safe']

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

        $query = PermintaanProduk::find()->joinWith('user');

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);


        $dataProvider->sort->attributes['user'] = [
            'asc' => ['user.username' => SORT_ASC],
            'desc' => ['user.username' => SORT_DESC]
        ];

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'uang_muka' => $this->uang_muka,
            'harga' => $this->harga,
            'progres' => $this->progres,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ]);
        if (!empty($params['PermintaanSearch']['deadline'])) {
            Yii::debug('Memfilter Deadline');
            $date = $this->convertToDate($params['PermintaanSearch']['deadline']);
            $query->andFilterWhere(['between', 'deadline', $date['dateStart'], $date['dateEnd']]);
        }

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'user.username', $this->user]);

        return $dataProvider;
    }
}
