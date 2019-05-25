<?php

use yii\db\Migration;

class m190525_095647_main_migrate extends Migration
{
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'username' => $this->string(255)->notNull(),
            'email' => $this->string(255)->notNull(),
            'password' => $this->string(255)->notNull(),
            'role' => $this->string(255)->defaultValue('user'),
            'authKey' => $this->string(255),
        ]);
        $this->createTable('recipes', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'description' => $this->text()->notNull(),
            'user_id' => $this->integer()->notNull(),
        ]);
        $this->createTable('ingredients', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'amount' => $this->double()->notNull(),
            'measure_id' => $this->integer()->defaultValue(1),
        ]);
        $this->createTable('measures', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
        ]);
        $this->createTable('recipes_to_ingredients', [
            'recipe_id' => $this->integer()->notNull(),
            'ingredient_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-recipes-user_id',
            'recipes',
            'user_id'
        );
        $this->addForeignKey(
            'fk-recipes-user_id',
            'recipes',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            'idx-recipes_to_ingredients-recipe_id',
            'recipes_to_ingredients',
            'recipe_id'
        );
        $this->addForeignKey(
            'fk-recipes_to_ingredients-recipe_id',
            'recipes_to_ingredients',
            'recipe_id',
            'recipes',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            'idx-recipes_to_ingredients-ingredient_id',
            'recipes_to_ingredients',
            'ingredient_id'
        );
        $this->addForeignKey(
            'fk-recipes_to_ingredients-ingredient_id',
            'recipes_to_ingredients',
            'ingredient_id',
            'ingredients',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-recipes-user_id',
            'recipes'
        );
        $this->dropIndex(
            'idx-recipes-user_id',
            'recipes'
        );
        $this->dropForeignKey(
            'fk-recipes_to_ingredients-recipe_id',
            'recipes_to_ingredients'
        );
        $this->dropIndex(
            'idx-recipes_to_ingredients-recipe_id',
            'recipes_to_ingredients'
        );
        $this->dropForeignKey(
            'fk-recipes_to_ingredients-ingredient_id',
            'recipes_to_ingredients'
        );
        $this->dropIndex(
            'idx-recipes_to_ingredients-ingredient_id',
            'recipes_to_ingredients'
        );

        $this->dropTable('users');
        $this->dropTable('recipes');
        $this->dropTable('ingredients');
        $this->dropTable('measures');
        $this->dropTable('recipes_to_ingredients');
    }
}
