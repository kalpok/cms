<?php

namespace core\grid;

use Yii;
use yii\helpers\Html;

class GridView extends \yii\grid\GridView
{
    public $showExportButton = false;
    public $exportIcon = 'download';
    public $exportLinkTitle = 'خروجی اکسل';
    public $exportAction = 'export-grid';

    public function init()
    {
        if ($this->showExportButton) {
            $this->layout = "<div class=\"pull-left\">{export}</div>
                {summary}\n{items}\n{pager}";
        }
        parent::init();
    }

    public function renderSection($name)
    {
        switch ($name) {
            case '{export}':
                return $this->renderExport();
            default:
                return parent::renderSection($name);
        }
    }

    protected function renderExport()
    {
        return Html::a(
            Html::tag('span', '', [
                'class' => " export-grid-btn fa fa-{$this->exportIcon}"
            ]),
            [
                $this->exportAction,
                'params' => Yii::$app->request->get()
            ],
            ['title' => $this->exportLinkTitle, 'data-pjax' => 0]
        );
    }
}
