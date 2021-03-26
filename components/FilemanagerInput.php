<?php
namespace app\components;

use Yii;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\InputWidget;
use yii\bootstrap\Modal;
use xvs32x\tinymce\TinymceAsset;

class FilemanagerInput extends InputWidget
{
    public $preview = true, $data, $attr;
    
    public $configPath = [
        'upload_dir' => '/images/uploads/source/',
        'current_path' => '../../../images/uploads/source/',
        'thumbs_base_path' => '../../../images/uploads/thumbs/'
    ];
    
    public function init()
    {
        parent::init();
        
        $this->attr = str_replace(['[', ']'], '', $this->attribute);
        
        $this->view->registerJs("
            $('#modal_filemanager-$this->attr .modal-dialog').css('width', document.body.clientWidth - 60 + 'px');
            $('#modal_filemanager-$this->attr .modal-body').css('height', document.body.clientHeight - 120 + 'px');
        ");
        Modal::begin([
            'header' => '<b style="font-size: 20px">Файловый менеджер</b>',
            'id' => 'modal_filemanager-' . $this->attr,
            'toggleButton' => ['label' => 'Выбрать', 'class' => 'btn btn-default']
        ]);
        echo '<iframe src="' . $this->setUrl() . '" frameborder="0" width="100%" height="100%"></iframe>';

        Modal::end();
    }

    public function run()
    {
        if ($this->hasModel()) {
            $attribute = $this->data ?: $this->model->{$this->attribute};
            
            echo '<div class="form-group"' . (empty($attribute) ? ' style="display:none"' : '') . '>
                <div class="' . $this->attr . ' control-label col-sm-3">' . ($this->preview ? Html::img(SiteHelper::resized_image($attribute, 120, 100)) : $attribute) . '</div>
            </div>';
            
            if (!ArrayHelper::getValue($this->options, 'id')) {
                $this->options['id'] = Html::getInputId($this->model, $this->attribute);
            }
            echo Html::activeHiddenInput($this->model, $this->attribute, $this->options + [
                'value' => $attribute,
                'onchange' => 'js:$(".' . $this->attr . ' img").attr("src", "/images/uploads/thumbs/" + this.value);if($(".' . $this->attr . '").parent(".form-group").is(":hidden")){$(".' . $this->attr . '").parent(".form-group").show();}'
            ]);
        } else {
            if (!ArrayHelper::getValue($this->options, 'id')) {
                $this->options['id'] = Html::getAttributeName($this->name . rand(1, 9999));
            }
            echo Html::hiddenField($this->name, $this->value, $this->options);
        }
    }
    
    /**
     * @return string
     */
    public function setUrl()
    {
        return Yii::$app->request->hostInfo . TinymceAsset::register($this->view)->baseUrl . '/filemanager/dialog.php?type=2&field_id=' .
            $this->options['id'] . '&relative_url=1&descending=false&lang=ru&akey=' . urlencode(serialize($this->configPath));
    }
}
?>