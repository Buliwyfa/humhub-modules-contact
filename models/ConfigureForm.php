<?php

namespace humhub\modules\contact\models;

use Yii;
use humhub\modules\contact\Module;

/**
 * ConfigureForm defines the configurable fields.
 *
 * @package humhub\modules\models
 * @author Jeffrey Geyssens
 */
class ConfigureForm extends \yii\base\Model
{

    /**
     * @var boolean  
     */
    public $guestOnly = true;

    /**
     *
     * @var integer 
     */
    public $sender;

    /**
     *
     * @var integer 
     */
    public $receipient;

    /**
     *
     * @var type 
     */
    public $beforeContactFormRender;

    /**
     *
     * @var type 
     */
    public $afterContactFormRender;

    public function init()
    {
        parent::init();
        $module = $this->getModule();
        $this->guestOnly = $module->settings->get('guestOnly');
        $this->sender = $module->settings->get('sender');
        $this->receipient = $module->settings->get('receipient');
        $this->beforeContactFormRender = $module->settings->get('beforeContactFormRender');
        $this->afterContactFormRender = $module->settings->get('afterContactFormRender');
    }

    /**
     * @return Module
     */
    public function getModule()
    {
        return Yii::$app->getModule('contact');
    }

    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return [
            [['receipient', 'sender'], 'required'],
            ['guestOnly', 'boolean'],
            [['receipient', 'sender'], 'integer'],
            [['beforeContactFormRender', 'afterContactFormRender'], 'string'],
        ];
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels()
    {
        return [
            'guestOnly' => 'Guest Visibility Only',
            'receipient' => 'Space',
            'beforeContactFormRender' => 'Display content before rendering contact form',
            'afterContactFormRender' => 'Display content after rendering contact form',
        ];
    }

    public function attributeHints()
    {
        return [
            'guestOnly' => 'Contact form is visible to guests only',
            'receipient' => 'The submitted '
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }

        $module = $this->getModule();
        $module->settings->set('guestOnly', $this->guestOnly);
        $module->settings->set('receipient', $this->receipient);
        $module->settings->set('beforeContactFormRender', $this->beforeContactFormRender);
        $module->settings->set('afterContactFormRender', $this->afterContactFormRender);
        return true;
    }

}
