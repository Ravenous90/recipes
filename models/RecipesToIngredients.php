<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "recipes_to_ingredients".
 *
 * @property int $recipe_id
 * @property int $ingredient_id
 *
 * @property Ingredients $ingredient
 * @property Recipes $recipe
 */
class RecipesToIngredients extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'recipes_to_ingredients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['recipe_id', 'ingredient_id'], 'required'],
            [['recipe_id', 'ingredient_id'], 'integer'],
            [['ingredient_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ingredients::className(), 'targetAttribute' => ['ingredient_id' => 'id']],
            [['recipe_id'], 'exist', 'skipOnError' => true, 'targetClass' => Recipes::className(), 'targetAttribute' => ['recipe_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'recipe_id' => 'Recipe ID',
            'ingredient_id' => 'Ingredient ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngredient()
    {
        return $this->hasOne(Ingredients::className(), ['id' => 'ingredient_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipe()
    {
        return $this->hasOne(Recipes::className(), ['id' => 'recipe_id']);
    }

    public static function saveIngredient($regId, $ingId)
    {

    }
}
