<?php

namespace L91\Bundle\StyleguideBundle\Controller;

trait ParseBreakpointTrait
{
    public function parseBreakpoints($filePath)
    {
        $fileContent = file_get_contents($filePath);

        preg_match_all('/([a-z]+): ([0-9]+)(px)/', $fileContent, $matches);

        $breakpoints = [];
        $biggestValue = 0;

        foreach ($matches[1] as $key => $name) {
            $value = (int) $matches[2][$key];
            if ($biggestValue < $value) {
                $biggestValue = $value;
            }
            $breakpoints[] = [
                'name' => $name,
                'max' => $value,
                'min' => isset($matches[2][$key + 1]) ? $matches[2][$key + 1] + 1 : 0,
            ];
        }

        return array_merge(
            [
                [
                    'name' => 'default',
                    'min' => $biggestValue + 1,
                ],
            ],
            $breakpoints
        );
    }
}
