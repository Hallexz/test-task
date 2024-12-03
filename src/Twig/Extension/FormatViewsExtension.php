<?php

namespace App\Twig\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class FormatViewsExtension extends AbstractExtension
{
    /**
     * Возвращает массив фильтров, доступных в Twig
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('format_views', [$this, 'formatViews']),
        ];
    }

    /**
     * Метод для форматирования числа просмотров
     */
    public function formatViews(int $views): string
    {
        if ($views >= 1000000) {
            return number_format($views / 1000000, 1) . 'M';  // 1.0M, 2.5M и т.д.
        } elseif ($views >= 1000) {
            return number_format($views / 1000, 1) . 'K';  // 1.0K, 2.5K и т.д.
        } else {
            return (string)$views;  // просто число, если меньше 1000
        }
    }
}
