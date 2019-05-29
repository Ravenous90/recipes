<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "recipes".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $user_id
 *
 * @property User $user
 * @property RecipesToIngredients[] $recipesToIngredients
 */
class Recipes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public static function tableName()
    {
        return 'recipes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'user_id'], 'required'],
            [['description'], 'string'],
            [['user_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'description' => 'Description',
            'user_id' => 'Author',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipesToIngredients()
    {
        return $this->hasMany(RecipesToIngredients::className(), ['recipe_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return RecipesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RecipesQuery(get_called_class());
    }

}
