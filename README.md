# Styleguide Bundle

## Base Styleguide

The base styleguide will show you a side to side view off all your texts in all breakpoints.

```php
<?php

namespace AppBundle\Controller;

use L91\Bundle\StyleguideBundle\Controller\ParseBreakpointTrait;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StyleguideController extends Controller
{
    use ParseBreakpointTrait;

    public function baseAction()
    {
        $breakpoints = $this->parseBreakpoints(dirname(__DIR__) . '/Resources/css/settings/_breakpoint.scss');

        return $this->render(
            '@L91Styleguide/styleguide/base.html.twig',
            [
                'route' => 'app.styleguide.text',
                'breakpoints' => $breakpoints,
            ]
        );
    }

    public function textAction()
    {
        return $this->render(
            'styleguide/styleguide-text.html.twig',
            []
        );
    }
}
```

An example `_breakpoint.scss` can look like this:

```scss
// Breakpoints set by max-width value:
$breakpoints: (
    laptop: 1200px,     // 992px - 1440px
    tablet: 991px,      // 768px -  991px
    mobile: 767px,      //   0px -  767px
);
```

Define the routes:

```xml
<?xml version="1.0" encoding="UTF-8" ?>
<routes xmlns="http://symfony.com/schema/routing"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://symfony.com/schema/routing http://symfony.com/schema/routing/routing-1.0.xsd">

    <route id="app.styleguide.base" path="/_styleguide">
        <default key="_controller">AppBundle:Styleguide:base</default>
    </route>

    <route id="app.styleguide.text" path="/_styleguide/text">
        <default key="_controller">AppBundle:Styleguide:text</default>
    </route>
</routes>
```

You can then create the stylesheet in your `styleguide/styleguide-text.html.twig`

```twig
{% extends '@L91Styleguide/styleguide/base-text.html.twig' %}

{% block style %}
    <link rel="stylesheet" href="{{ asset('/bundles/app/css/main.css', 'static') }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
{% endblock %}

{% block content %}
    <div class="styleguide-container">
        <h1 class="intro__title">
            Intro Title<br/>
            with a break
        </h1>
    </div>

    <div class="styleguide-container">
        <div class="countdown__title">
            Countdown title<br/>
            with a break
        </div>
    </div>
{% endblock %}

{% block script %}
    <script src="{{ asset('/bundles/app/js/main.js', 'static') }}"></script>
{% endblock %}
```

## Sulu Styleguide

You can use the sulu traits to create a dummy data for rendering a sulu site.

```php
<?php

namespace AppBundle\Controller;

use L91\Bundle\StyleguideBundle\Controller\SuluRenderTrait;
use L91\Bundle\StyleguideBundle\DataTrait\SuluTrait;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StyleguideController extends Controller
{
    use SuluRenderTrait;
    use SuluTrait;

    public function homepageAction()
    {
        return $this->render(
            'templates/homepage.html.twig',
            $this->getHomepageAttributes()
        );
    }

    private function getHomepageAttributes()
    {
        $parameters = [
            'uuid' => null,
            'content' => [
                'title' => 'Styleguide Startpage',
                'headerImages' => $this->createDummyImages(1),
                'quoteText' => '<p>When people askme if<br />I went to film school I tell them:<br />≪No I went to films.≫</p>',
                'quoteAuthor' => 'Quentin Tarantino',
                'headline' => "A reader will be\ndistracted by the\nreadable content.",
                'description' => $this->createDummyText(),
                'homeBlocks' => [
                    [
                        'type' => 'countdown',
                        'title' => 'Until the topic assignment',
                        'date' => (new \DateTime())->modify('+2weeks')->format('Y-m-d H:i:s'),
                    ],
                ],
                'teasers' => $this->createDummyTeasers('Teaser', 3),
            ],
            'view' => [
            ],
        ];

        return $parameters;
    }
}
```
