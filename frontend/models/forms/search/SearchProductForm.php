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

class SearchProductForm extends Model
{

    public $product;

    public function rules()
    {
        return [
            ['product','required'],
            ['product','string','max' => 100]
        ];
    }

    public function search(){

    }
}