<?php

namespace Massive\Bundle\StyleguideBundle\DataTrait;

trait HtmlTrait
{
    /**
     * Create dummy text.
     *
     * @param null $length
     *
     * @return string
     */
    private function createDummyText($length = null)
    {
        $text = 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren';

        if ($length) {
            while ($length > strlen($text)) {
                $text .= '. ' . $text;
            }

            $text = substr($text, 0, $length);
        }

        $text .= '.';

        return $text;
    }

    /**
     * Create dummy text editor.
     *
     * @param int $paragraphs
     * @param int|null $length
     *
     * @return string
     */
    private function createDummyTextEditor($paragraphs = 1, $length = null)
    {
        $text = '';

        for ($i = 0; $i < $paragraphs; ++$i) {
            $text .= '<p>' . $this->createDummyText($length) . '</p>';
        }

        return $text;
    }

    /**
     * Create dummy list.
     *
     * @param string $tag
     *
     * @return string
     */
    private function createDummyList($tag = 'ul')
    {
        return sprintf('<%s>
                <li>List 1</li>
                <li>List 2
                    <%s>
                        <li>List 2.1</li>
                        <li>List 2.2</li>
                    </%s>
                </li>
                <li>List 3</li>
            </%s>',
            $tag,
            $tag,
            $tag,
            $tag
        );
    }

    /**
     * Create dummy embed.
     *
     * @return string
     */
    private function createDummyEmbed()
    {
        return '<iframe width="800" height="350" style="border:none; overflow:hidden;" src="https://www.youtube.com/embed/muZ0JYBCnrU?autoplay=0&fs=0&iv_load_policy=3&showinfo=0&rel=0&cc_load_policy=0&start=0&end=0&origin=https://youtubeembedcode.com"></iframe>';
    }
}
