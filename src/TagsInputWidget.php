<?php

namespace somov\tagsinput;

use app\components\widgets\base\InputLanguageWidgetTrait;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;


class TagsInputWidget extends \yii\widgets\InputWidget
{

    use InputLanguageWidgetTrait;

    public $placeholder;

    /**
     * @var array
     */
    public $clientOptions = [];

    public function run()
    {

        if ($this->isArrayValue() && empty($this->clientOptions['itemValue'])) {
            throw new InvalidConfigException('itemValue in client options required for array value');
        }

        if (count($this->languages) > 0) {
            echo $this->initOptionLanguageWidget()
                ->renderLanguageWidget();
        } else {
            echo $this->applyOptions()
                ->registerClientScript($this->options['id'], $this->getValue())
                ->renderControl($this->options, $this->isArrayValue() ? '' : $this->getValue());
        }
        parent::run();
    }


    protected function renderLanguageInputHtml($options)
    {
        $options['placeholder'] = $this->placeholder;

        $this->registerClientScript($options['id'], $options['value']);
        return $this->renderControl($options, $options['value']);
    }

    /**
     * @return string|array
     */
    protected function getValue()
    {
        if (isset($this->value)) {
            return $this->value;
        }
        return ($this->hasModel()) ? ArrayHelper::getValue($this->model, $this->attribute) : '';
    }

    /**
     * @return bool
     */
    protected function isArrayValue()
    {
        return is_array($this->getValue());
    }

    /**
     * @return $this
     */
    protected function applyOptions()
    {
        $this->options['style'] = 'display: none';
        if (isset($this->placeholder)) {
            $this->options['placeholder'] = $this->placeholder;
        }
        return $this;
    }


    protected function registerClientScript($id, $value)
    {

        $options = Json::htmlEncode($this->getClientOptions());
        TagsInputAsset::register($this->view);

        $add = '';

        if (is_array($value)) {
            $items = Json::encode($value);
            $add = "jQuery.each($items, function (){t.tagsinput('add', this, {prevent: 'true'})});";
        }

        $this->view->registerJs(
            "(function(){
                var t = jQuery('#$id'); t.tagsinput($options); $add
               })();
            ");
        return $this;
    }

    /**
     * @return array
     */
    protected function getClientOptions()
    {
        return $this->clientOptions;
    }

    /**
     * @param array $options
     * @param mixed $value
     * @return string
     */
    protected function renderControl(array $options, $value)
    {
        if ($this->hasModel()) {

            return Html::activeInput('text', $this->model, $this->attribute, array_merge($options, [
                'value' => $value
            ]));

        }
        return Html::input('text', $this->name, $this->isArrayValue() ? '' : $this->getValue(), $options);

    }

}
