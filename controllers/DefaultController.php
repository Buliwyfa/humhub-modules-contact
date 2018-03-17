<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\contact\controllers;

use Yii;
use humhub\modules\contact\models\ContactForm;

/**
 * ConfigController handles the configuration requests.
 *
 * @package Humhub Contact Page Module 
 * @since 1.2.4
 * @author Jeffrey 
 */
class DefaultController extends \humhub\modules\content\controllers\ContentController
{
    /**
     * Configuration action for super admins.
     */
    public function actionIndex()
    {
        $form = new ContactForm();

        if ($form->load(Yii::$app->request->post()) && $form->send()) {
            $this->view->saved();
            return $this->redirect(Yii::$app->getHomeUrl());
        }
        return $this->render('index', ['model' => $form]);
    }

}
