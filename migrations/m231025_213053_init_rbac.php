<?php

use yii\db\Migration;

/**
 * Class m231025_213053_init_rbac
 */
class m231025_213053_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        // add "createPost" permission
        $categoryIndex = $auth->createPermission('categoryIndex');
        $categoryIndex->description = 'Index Categories';
        $auth->add($categoryIndex);

        // add "updatePost" permission
        $categoryCreate = $auth->createPermission('categoryCreate');
        $categoryCreate->description = 'Create Categories';
        $auth->add($categoryCreate);

        // add "categoryCreate" permission
        $categoryView = $auth->createPermission('categoryView');
        $categoryView->description = 'View Categories';
        $auth->add($categoryView);

        // add "categoryCreate" permission
        $categoryUpdate = $auth->createPermission('categoryUpdate');
        $categoryUpdate->description = 'Update Categories';
        $auth->add($categoryUpdate);

        $categoryDelete = $auth->createPermission('categoryDelete');
        $categoryDelete->description = 'Delete Categories';
        $auth->add($categoryDelete);

        // add "author" role and give this role the "createPost" permission
        $author = $auth->createRole('author');
        $auth->add($author);
        $auth->addChild($author, $categoryIndex);
        $auth->addChild($author, $categoryCreate);
        $auth->addChild($author, $categoryView);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $manpreet = $auth->createRole('manpreet');
        $auth->add($manpreet);
        $auth->addChild($manpreet, $categoryUpdate);
        $auth->addChild($manpreet, $categoryDelete);
        $auth->addChild($manpreet, $author);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // // usually implemented in your User model.

        // $authorRole = $auth->getRole('author');
        // $auth->assign($authorRole, 1);
        // $manpreetRole = $auth->getRole('manpreet');
        // $auth->assign($manpreetRole, 2);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231025_213053_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
