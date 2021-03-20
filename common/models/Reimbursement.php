<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "reimbursement".
 *
 * @property int $id
 * @property int|null $id_booth
 * @property int|null $amount
 * @property string|null $bank
 * @property string|null $nomor_rekening
 * @property string|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property string|null $bukti
 *
 * @property Booth $booth
 */
class Reimbursement extends \yii\db\ActiveRecord
{
    const STATUS_CREATED = 'created';
    const STATUS_PROGRESS = 'in progress';
    const STATUS_COMPLETED = 'completed';


    public function behaviors()
    {
        return [
            TimestampBehavior::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reimbursement';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_booth', 'amount', 'created_at', 'updated_at'], 'integer'],
            [['bank', 'nomor_rekening', 'status','bukti'], 'string', 'max' => 255],
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
            'amount' => 'Amount',
            'bank' => 'Bank',
            'nomor_rekening' => 'Nomor Rekening',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'bukti'=>'Bukti'
        ];
    }

    /**
     * Gets query for [[Booth]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBooth()
    {
        return $this->hasOne(Booth::className(), ['id' => 'id_booth']);
    }
}
