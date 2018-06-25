<?php

namespace L91\Bundle\StyleguideBundle\Controller;

trait ParseIconTrait
{
    public function parseIcons($filePath)
    {
        $fileContent = file_get_contents($filePath);

        preg_match_all('/(\$icon-)([a-z-]+)(:)/', $fileContent, $matches);

        return $matches[2];
    }
}
