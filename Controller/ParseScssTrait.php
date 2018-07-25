<?php

namespace Massive\Bundle\StyleguideBundle\Controller;

use Doctrine\Common\Inflector\Inflector;

trait ParseScssTrait
{
    public function parseScss($filePath, &$elements = [])
    {
        $fileContent = file_get_contents($filePath);

        preg_match_all('/@styleguide\(["\'](.*)["\'](, ({(.*)}))?\)\n.(.*) /', $fileContent, $matches);
        
        foreach ($matches[5] as $key => $class) {
            $text = $this->createName($class);
            $group = $this->createName($matches[1][$key], true);
            if (!isset($elements[$group])) {
                $elements[$group] = [];
            }

            $data = json_decode($matches[3][$key], true) ?: [];

            if (!isset($data['tag'])) {
                $data['tag'] = 'div';
            }

            if(false !== strpos($class, 'button')) {
                $data['tag'] = 'button';
            }

            if (false !== strpos($class, '--')) {
                $class = explode('--', $class)[0] . ' ' . $class;
            }

            if (isset($data['text'])) {
                $data['description'] = $text;
            }

            $elements[$group][] = array_merge([
                'class' => $class,
                'text' => $text,
            ], $data);
        }

        preg_match_all('/@import ["\'](.*)["\'];/', $fileContent, $fileMatches);

        foreach ($fileMatches[1] as $fileMatch) {
            $importPath = $this->getScssImportPath($fileMatch, $filePath);

            if (false === strpos($importPath, 'node_modules')) {
                $this->parseScss($importPath, $elements);
            }
        }

        return $elements;
    }

    private function createName($text, $pluralize = false)
    {
        $text = Inflector::ucwords(str_replace(['--', '-', '__', '_'], ' ', $text));

        if ($pluralize) {
            $text = Inflector::pluralize($text);
        }

        return $text;
    }

    private function getScssImportPath($fileMatch, $filePath)
    {
        $pathInfo = pathinfo($fileMatch);
        $folder = dirname($filePath) . '/' . $pathInfo['dirname'] . '/';

        $filename = $pathInfo['basename'];

        if (!isset($pathInfo['extension'])) {
            $filename = $pathInfo['filename'] . '.scss';
        }

        $filePathUnderline = $folder . '_' . $filename;

        if (file_exists($filePathUnderline)) {
            return $filePathUnderline;
        }

        return $folder . $filename;;
    }
}
