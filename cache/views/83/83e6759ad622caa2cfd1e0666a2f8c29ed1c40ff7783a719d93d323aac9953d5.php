<?php

/* view.twig */
class __TwigTemplate_648af0bfb61b51faf57e18b515962295a94fdab7a4a4508ca80a648195362b67 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
<head>
    <meta charset=\"UTF-8\">
    <title>Hello world page</title>
</head>
<body>
    <h1>Hello world!</h1>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "view.twig";
    }

    public function getDebugInfo()
    {
        return array (  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "view.twig", "/var/www/web-skeleton/resources/views/view.twig");
    }
}
