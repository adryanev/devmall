<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "coin_ledger".
 *
 * @property int $id
 * @property int|null $id_coin
 * @property int|null $type
 * @property int|null $amount
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Coin $ledger
 */
class CoinLedger extends ActiveRecord
{
    const TYPE_IN = 1;
    const TYPE_OUT = 0;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coin_ledger';
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
            [['amount', 'id_coin', 'type', 'created_at', 'updated_at'], 'integer'],
            [['id_coin'], 'exist', 'skipOnError' => true, 'targetClass' => Coin::className(), 'targetAttribute' => ['id_coin' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_coin' => 'Id Coin',
            'amount' => 'Amount',
            'type' => 'Type',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getLedger()
    {
        return $this->hasMany(Coin::class, ['id'=>'id_coin']);
    }
}
