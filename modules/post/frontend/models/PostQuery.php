<?php

namespace modules\post\frontend\models;

use extensions\i18n\date\lib\JDateTime;

class PostQuery extends \yii\db\ActiveQuery
{
    public function filterWithinYearAndMonth($year, $month)
    {
        $start = $this->getStartOfGivenDate($year, $month);
        $end = $this->getEndOfGivenDate($year, $month);
        $this->andWhere('createdAt > ' . $start . ' AND createdAt < ' . $end);

        return $this;
    }

    private function getStartOfGivenDate($year, $month)
    {
        return JDateTime::mktime(0, 0, 0, $month, 1, $year, true);
    }

    private function getEndOfGivenDate($year, $month)
    {
        $daysOfMonth = $month > 6 ? 30 : 31;

        return JDateTime::mktime(23, 59, 59, $month, $daysOfMonth, $year, true);
    }
}
