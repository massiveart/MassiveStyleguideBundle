<?php

namespace Massive\Bundle\StyleguideBundle\DataTrait;

trait SuluTrait
{
    use HtmlTrait;

    /**
     * Create dummy teasers.
     *
     * @param string $name
     * @param int $length
     *
     * @return array
     */
    private function createDummyTeasers($name, $length = 4)
    {
        $teasers = [];

        for ($i = 0; $i < $length; ++$i) {
            $teasers[] = $this->createDummyTeaser($name . ' ' . ($i + 1), 0 !== $i % 2);
        }

        return $teasers;
    }

    /**
     * Create dummy teaser.
     *
     * @param string $name
     * @param bool $hasCategory
     *
     * @return array
     */
    private function createDummyTeaser($name, $hasCategory = false)
    {
        return [
            'uuid' => null,
            'title' => $name . ' Title',
            'images' => $this->createDummyImages(2),
            'excerpt' => $this->createDummyExcerpt($name, $hasCategory),
            'description' => '<p>' . $name . ' description ' . $this->createDummyText() . ' </p>',
            'url' => '/_styleguide/detail',
            'routePath' => '/_styleguide/detail',
        ];
    }

    /**
     * Creaty dummy excerpt.
     *
     * @param string $name
     * @param bool $hasCategory
     * @param bool $hasTags
     *
     * @return array
     */
    private function createDummyExcerpt($name, $hasCategory = false, $hasTags = false)
    {
        return [
            'title' => $name . ' excerpt title',
            'description' => $name . ' excerpt description',
            'categories' => $this->createDummyCategories($hasCategory ? 3 : 0),
            'tags' => $this->createDummyTags($hasTags ? 3 : 0),
        ];
    }

    /**
     * Create dummy seo.
     *
     * @param string $name
     *
     * @return array
     */
    private function createDummySeo($name)
    {
        return [
            'title' => $name . ' excerpt title',
            'description' => $name . ' excerpt description',
        ];
    }

    /**
     * Create dummy categories.
     *
     * @param int $length
     *
     * @return array
     */
    private function createDummyTags($length)
    {
        $tags = [];

        for ($i = 0; $i < $length; ++$i) {
            $tags[] = 'Tag ' . $length;
        }

        return $tags;
    }

    /**
     * Create dummy categories.
     *
     * @param int $length
     *
     * @return array
     */
    private function createDummyCategories($length)
    {
        $categories = [];

        for ($i = 0; $i < $length; ++$i) {
            $categories[] = $this->createDummyCategory('Category ' . $length);
        }

        return $categories;
    }

    /**
     * Create dummy category.
     *
     * @param string $name
     *
     * @return array
     */
    private function createDummyCategory($name)
    {
        return [
            'id' => null,
            'name' => $name,
            'key' => null,
        ];
    }

    /**
     * Create dummy images.
     *
     * @param int $length
     *
     * @return array
     */
    private function createDummyImages($length)
    {
        $images = [];

        for ($i = 0; $i < $length; ++$i) {
            $images[] = $this->createDummyImage('Image ' . ($i + 1));
        }

        return $images;
    }

    /**
     * Create dummy image.
     *
     * @param string $name
     *
     * @return array
     */
    private function createDummyImage($name)
    {
        return [
            'id' => null,
            'title' => $name,
            'url' => null,
            'mimeType' => 'image/jpeg',
            'name' => 'test.jpg',
            'description' => $name . ' description',
            'copyright' => $name . ' copyright',
            'thumbnails' => $this->createPlaceholdItFormats(),
        ];
    }

    /**
     * Create placehold it formats.
     *
     * @return array
     */
    private function createPlaceholdItFormats()
    {
        $placeholdIts = [];
        $formats = array_keys($this->getParameter('sulu_media.image.formats'));

        foreach ($formats as $format) {
            $size = $format;

            $split = explode('-', $format);

            if ('sulu' === $split[0]) {
                $split[0] = $split[1];
            }

            $sizes = explode('x', $split[0]);

            if ('' === $sizes[1]) {
                $size = $sizes[0] . 'x' . (ceil($sizes[0] * 0.6));
            }

            $placeholdIts[$format] = 'https://placehold.it/' . $size . '?text=' . $format;
        }

        return $placeholdIts;
    }
}
