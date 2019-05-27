<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ingredients".
 *
 * @property int $id
 * @property string $title
 * @property double $amount
 * @property int $measure_id
 *
 * @property Measures $measure
 * @property RecipesToIngredients[] $recipesToIngredients
 */
class Ingredients extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ingredients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'amount'], 'required'],
            [['amount'], 'number'],
            [['measure_id', 'amount'], 'integer'],
            [['measure_id'], 'exist', 'skipOnError' => true, 'targetClass' => Measures::className(), 'targetAttribute' => ['measure_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Name',
            'amount' => 'Amount',
            'measure_id' => 'Type of measure',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeasure()
    {
        return $this->hasOne(Measures::className(), ['id' => 'measure_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getrecipes_to_ingredients()
    {
        return $this->hasMany(RecipesToIngredients::className(), ['ingredient_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return IngredientsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new IngredientsQuery(get_called_class());
    }

    public static function getRusianName()
    {
        return 'Ингредиенты';
    }
}
