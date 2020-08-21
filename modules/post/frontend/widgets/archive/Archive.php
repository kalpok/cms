<?php

namespace modules\post\frontend\widgets\archive;

use Yii;

use yii\helpers\Html;
use extensions\i18n\date\DateUtility;
use modules\post\frontend\models\Post;

class Archive extends \yii\base\Widget
{
    public $view = 'archive';

    public function run()
    {
        $archiveStatistic = $this->getArchiveStatistic();
        $list = $this->createLit($archiveStatistic);

        return $this->render('archive', ['list' => $list]);
    }

    private function getArchiveStatistic()
    {
        $statistic = [];
        $posts = Post::find()
            ->select(['id', 'createdAt', 'priority'])
            ->orderBy('createdAt DESC')
            ->distinct()
            ->asArray()
            ->all();

        foreach ($posts as $post) {
            $dateUtility = new DateUtility($post['createdAt']);
            $year = $dateUtility->yearNumber;
            $month = $dateUtility->monthNumber;
            if (!isset($statistic[$year])) {
                $statistic[$year]['count'] = 1;
            } else {
                $statistic[$year]['count']++;
            }
            if (!isset($statistic[$year]['month'][$month])) {
                $statistic[$year]['month'][$month] = 1;
            } else {
                $statistic[$year]['month'][$month]++;
            }
        }

        return $statistic;
    }

    private function createLit($archiveStatistic)
    {
        $formatter = Yii::$app->formatter;
        $currentYear = Yii::$app->request->get('year');
        $currentMonth = Yii::$app->request->get('month');
        foreach ($archiveStatistic as $year => $yearCount) {
            $item = [];
            $item['label'] = $formatter->asFarsiNumber($year . ' (' . $yearCount['count'] . ')');
            $list = '<ul>';
            $isActive = false;
            foreach ($yearCount['month'] as $month => $monthCount) {
                if (
                    isset($currentYear, $currentMonth) &&
                    $currentYear == $year && $currentMonth == $month
                ) {
                    $li = '<li class="active">- ';
                    $item['contentOptions'] = ['class' => 'in'];
                    $isActive = true;
                } else {
                    $li = '<li>- ';
                }
                $route = [
                    'front/archive',
                    'year' => $year,
                    'month' => $month,
                ];
                $list .= $li . Html::a(
                    $this->getMonthName($month) . ' (' . $formatter->asFarsiNumber($monthCount) . ')',
                    $route
                ) . '</li>';
            }
            $list .= '</ul>';
            $item['content'] = $list;
            $item['isActive'] = $isActive;
            $items[] = $item;
        }

        return $items;
    }

    private function getMonthName($monthNumber)
    {
        $map = [
            1 => 'فروردین',
            2 => 'اردیبهشت',
            3 => 'خرداد',
            4 => 'تیر',
            5 => 'مرداد',
            6 => 'شهریور',
            7 => 'مهر',
            8 => 'آبان',
            9 => 'آذر',
            10 => 'دی',
            11 => 'بهمن',
            12 => 'اسفند'
        ];

        return $map[$monthNumber];
    }
}
