<?php

/**
 * @link https://humanized.it
 * @copyright Copyright (c) 2018 Humanized
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\contact\controllers;

use Yii;
use humhub\modules\contact\models\ConfigureForm;
use humhub\models\Setting;

/**
 * ConfigController handles the configuration requests.
 *
 * @package Humhub Contact Form Module
 * @since 1.2.4
 * @author Jeffrey Geyssens <jeffrey@humanized.it>
 */
class ConfigController extends \humhub\modules\admin\components\Controller
{

    /**
     * Configuration action for super admins.
     */
    public function actionIndex()
    {
        $form = new ConfigureForm();

        if ($form->load(Yii::$app->request->post()) && $form->save()) {
            $this->view->saved();
        }

        return $this->render('index', ['model' => $form]);
    }

}
