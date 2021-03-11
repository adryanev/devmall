<?php


namespace common\models;


use Carbon\Carbon;
use yii\db\ActiveRecord;
use yii\db\Exception;

/**
 * Class Transaksi
 * @package common\models
 *
 * @property string $code
 * @property int $order_date
 * @property int $payment_due
 * @property int $payment_status
 * @property string $payment_token
 * @property string $payment_url
 * @property int $base_total_price
 * @property int $tax_amount
 * @property double $tax_percent
 * @property int $discount_amount
 * @property double $discount_percent
 * @property int $grand_total
 * @property string $note
 * @property int $cancelled_by
 * @property int $cancelled_at
 * @property string cancellation_note
 * @property int $status
 * @property string $paymentStatus
 */
abstract class Transaksi extends ActiveRecord
{
    const STATUS_COMPLETE = 1;
    const STATUS_INVOICE = 0;
    const STATUS_CONFIRMED = 2;
    const STATUS_CANCELED = 3;

    const PAYMENT_STATUS_PAID = 1;
    const PAYMENT_STATUS_UNPAID = 0;

    public const TRANSAKSI_FORMAT = '{transaction_code}/devmall/{transaction_date}/{transaction_type}/';
    public const TRANSAKSI_CODE = 'TRP';

    abstract public function getCode();
    abstract public function isPaid();

    public function getPaymentStatus(){
        $status = [self::PAYMENT_STATUS_UNPAID => 'Belum Dibayar',
            self::PAYMENT_STATUS_PAID=>'Dibayar'];
        return $status[$this->payment_status];
    }
    public function getStatusTransaksi(){
        $status = [self::STATUS_INVOICE => 'Invoice',
            self::STATUS_COMPLETE => 'Complete',
            self::STATUS_CONFIRMED=>'Confirmed',
            self::STATUS_CANCELED => 'Canceled'
            ];
        return $status[$this->status];
    }
    public function genereateTransactionCode($type = null){
        $now = Carbon::now();

        $code = strtr(self::TRANSAKSI_FORMAT, [
            '{transaction_code}'=>self::TRANSAKSI_CODE,
            '{transaction_date}'=> $now->isoFormat('YYYYMMDD'),
            '{transaction_type}'=>$type
        ]);
        $lastOrder = self::find()->where(['like','code',$code])->orderBy('id DESC')->one();
        $lastOrderCode = $lastOrder->code ?? null;
        $transactionCode = $code . '00001';
        if ($lastOrderCode) {
            $lastOrderNumber = str_replace($code, '', $lastOrderCode);
            $nextOrderNumber = sprintf('%05d', (int) $lastOrderNumber +1);
            $transactionCode = $code . $nextOrderNumber;
        }
        if (self::isOrderCodeExist($transactionCode)) {
            throw new Exception('kode transaksi exists: '.$transactionCode);
        }

        return $transactionCode;
    }
    /**
     * Check if the generated order code is exists
     *
     * @param string $orderCode order code
     *
     * @return boolean
     */
    protected static function isOrderCodeExist($orderCode)
    {
        return self::find()->where(['code'=>$orderCode])->exists();
    }

}
