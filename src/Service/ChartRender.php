<?php

namespace App\Service;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\Material\BarChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\Material\ColumnChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;

class ChartRender
{
    public function pieChart(array $data, $title)
    {
        $pieChart = new PieChart();

        $pieChart->getData()->setArrayToDataTable($data);
        $pieChart->getOptions()->setTitle($title);
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(700);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);

        return $pieChart;
    }

    public function barChart(array $data, string $title, string $subtitle, string $xValueLabel, string $xQuantityLabel)
    {

        $barChart = new BarChart();
        $barChart->getData()->setArrayToDataTable($data);
        $barChart->getOptions()->getChart()
            ->setTitle($title)
            ->setSubtitle($subtitle);
        $barChart->getOptions()
            ->setHeight(500)
            ->setWidth(800)
            ->setSeries([['axis' => 'value'], ['axis' => 'quantity']])
            ->setAxes(['x' => [
                'value' => ['label' => $xValueLabel],
                'quantity' => ['side' => 'top', 'label' => $xQuantityLabel]]
            ]);
        return $barChart;
    }

    public function columnChart(array $data, string $title, string $subtitle = null)
    {
        $columnChart = new ColumnChart();
        $columnChart->getData()->setArrayToDataTable($data);
        $columnChart->getOptions()->getChart()
            ->setTitle($title)
            ->setSubtitle($subtitle);
        $columnChart->getOptions()
            ->setBars('vertical')
            ->setHeight(400)
            ->setWidth(900)
            ->setColors(['#1b9e77', '#d95f02', '#7570b3'])
            ->getVAxis()
            ->setFormat('decimal');

        return $columnChart;
    }
}
