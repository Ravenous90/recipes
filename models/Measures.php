<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "measures".
 *
 * @property int $id
 * @property string $title
 *
 * @property Ingredients[] $ingredients
 */
class Measures extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'measures';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Вид измерения',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngredients()
    {
        return $this->hasMany(Ingredients::className(), ['measure_id' => 'id']);
    }
}
