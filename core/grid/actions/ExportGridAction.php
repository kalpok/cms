<?php

namespace core\grid\actions;

use Yii;
use moonland\phpexcel\Excel;
use yii\base\InvalidConfigException;

class ExportGridAction extends \yii\base\Action
{
    public $searchClass;
    public $dataProvider;
    public $columns;
    public $fileName = 'export';
    public $extraParams = [];

    public function init()
    {
        if (empty($this->searchClass) && empty($this->dataProvider)) {
            throw new InvalidConfigException('
                searchClass or dataProvider property must be set.
            ');
        }
        if (empty($this->columns)) {
            throw new InvalidConfigException('columns property must be set.');
        }
        parent::init();
    }

    public function run()
    {
        $dataProvider = $this->prepareDataProvider();
        $dataProvider->setPagination(['pageSize' => 10000]);
        header("Content-disposition: attachment; filename={$this->fileName}.xlsx");
        echo Excel::export([
            'models' => $dataProvider->getModels(),
            'columns' => $this->columns,
            'fileName' => "{$this->fileName}.xlsx",
            'formatter' => [
                'class' => 'extensions\i18n\Formatter',
                'dateFormat' => 'php:d F Y',
                'datetimeFormat' => 'php:d F Y | H:i',
                'nullDisplay' => ''
            ]
        ]);
    }

    public function prepareDataProvider()
    {
        if ($this->dataProvider) {
            return $this->dataProvider;
        }
        $searchModel = new $this->searchClass;
        $params = $this->prepareParams($searchModel->formName());
        return $searchModel->search($params);
    }

    private function prepareParams($formName)
    {
        $params = $this->makeQueryParametersReadyForSearchClass(
            Yii::$app->request->queryParams
        );
        foreach ($this->extraParams as $extraParamTitle => $extraParamValue) {
            $params[$formName][$extraParamTitle] = $extraParamValue;
        }
        return $params;
    }

    private function makeQueryParametersReadyForSearchClass($params)
    {
        return empty($params) ? [] : array_slice(reset($params), 0, 1, true);
    }
}
