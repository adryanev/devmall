<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "coin".
 *
 * @property int $id
 * @property int|null $id_booth
 * @property int|null $saldo
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Booth $booth
 * @property CoinLedger $ledger
 */
class Coin extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coin';
    }

    public function behaviors()
    {
        return [TimestampBehavior::class];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_booth', 'saldo', 'status', 'created_at', 'updated_at'], 'integer'],
            [['id_booth'], 'exist', 'skipOnError' => true, 'targetClass' => Booth::className(), 'targetAttribute' => ['id_booth' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_booth' => 'Id Booth',
            'saldo' => 'Saldo',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Booth]].
     *
     * @return ActiveQuery
     */
    public function getBooth()
    {
        return $this->hasOne(Booth::className(), ['id' => 'id_booth']);
    }

    /**
     * @return ActiveQuery
     */
    public function getLedger(){
        return $this->hasMany(CoinLedger::class,['id_coin'=>'id']);
    }
}
