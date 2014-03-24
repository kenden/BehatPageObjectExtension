<?php

namespace spec\SensioLabs\Behat\PageObjectExtension\Context\Initializer;

use PhpSpec\ObjectBehavior;
use SensioLabs\Behat\PageObjectExtension\Context\PageFactory;

class PageObjectAwareInitializerSpec extends ObjectBehavior
{
    function let(PageFactory $pageFactory)
    {
        $this->beConstructedWith($pageFactory);
    }

    function it_should_be_an_initializer()
    {
        $this->shouldHaveType('Behat\Behat\Context\Initializer\ContextInitializer');
    }

    function it_should_inject_the_page_factory_into_the_context($context, PageFactory $pageFactory)
    {
        $context->implement('SensioLabs\Behat\PageObjectExtension\Context\PageObjectAwareInterface');
        $context->implement('Behat\Behat\Context\Context');

        $context->setPageFactory($pageFactory)->shouldBeCalled();

        $this->initializeContext($context)->shouldReturn(null);
    }

    function it_should_not_inject_the_page_factory_into_other_contexts($context)
    {
        $context->implement('Behat\Behat\Context\Context');

        $this->initializeContext($context)->shouldReturn(null);
    }
}
