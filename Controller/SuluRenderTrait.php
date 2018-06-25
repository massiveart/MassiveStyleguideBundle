<?php

namespace Massive\Bundle\StyleguideBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

trait SuluRenderTrait
{
    /**
     * {@inheritdoc}
     */
    public function render($view, array $parameters = [], Response $response = null)
    {
        return parent::render(
            $view,
            $this->get('sulu_website.resolver.template_attribute')->resolve($parameters),
            $response
        );
    }
}
