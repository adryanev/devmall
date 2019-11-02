<?php
/**
 * Project: devmall.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 20/09/19
 * Time: 20.17
 */

namespace frontend\models\forms\search;


use yii\base\Model;

class SearchProductIndexForm extends Model
{

    public $produk;
    public $kategori;

    public function rules()
    {
        return [
            [['produk', 'kategori'], 'required'],
            ['produk', 'string', 'max' => 100],
            ['kategori', 'integer'],
        ];
    }


}