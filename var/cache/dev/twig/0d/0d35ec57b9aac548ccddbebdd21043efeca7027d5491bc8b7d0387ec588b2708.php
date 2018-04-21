<?php

/* home.html.twig */
class __TwigTemplate_9f920fea3623e40427e6fe335f436bbef39a6560fae4b5183691361cc79fadb5 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base.html.twig", "home.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'hero' => array($this, 'block_hero'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "home.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "home.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        // line 4
        echo "    Pinkosensitivism
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 7
    public function block_hero($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "hero"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "hero"));

        // line 8
        echo "    <h1 class=\"title\">#PINKOSENSITIVISM</h1>
    <p class=\"title-sub\">/pɪŋkoʊˈsɛnsətɪvɪz(ə)m/ - Neologism that represents the </br>collective work of art in the age of virtual connectivity</p>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 12
    public function block_body($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 13
        echo "    <div class=\"instagram-wrap\">
        <ul class=\"social\">
            <li>
                <a href=\"https://www.instagram.com/pinkosensitivism/\" target=\"_blank\" title=\"Open Pinkosensitivism Hashtag on Instagram\">
                    <svg width=\"40px\" height=\"40px\" viewBox=\"0 0 40 40\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\">
                        <g id=\"Symbols\" stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">
                            <g id=\"instagram\" fill-rule=\"nonzero\" fill=\"#FFFFFF\">
                                <g transform=\"translate(4.000000, 4.000000)\">
                                    <circle id=\"Oval\" fill-opacity=\"0.3\" cx=\"16\" cy=\"16\" r=\"16\"></circle>
                                    <path d=\"M19.7,9.1 L11.4,9.1 C10,9.1 8.8,10.3 8.8,11.7 L8.8,14.4 L8.8,20 C8.8,21.4 10,22.6 11.4,22.6 L19.7,22.6 C21.1,22.6 22.3,21.4 22.3,20 L22.3,14.5 L22.3,11.8 C22.3,10.3 21.1,9.1 19.7,9.1 Z M20.4,10.7 L20.7,10.7 L20.7,11 L20.7,13 L18.4,13 L18.4,10.7 L20.4,10.7 Z M13.6,14.5 C14,13.9 14.7,13.5 15.5,13.5 C16.3,13.5 17,13.9 17.4,14.5 C17.7,14.9 17.8,15.4 17.8,15.9 C17.8,17.2 16.7,18.3 15.4,18.3 C14.1,18.3 13,17.2 13,15.9 C13.2,15.3 13.3,14.9 13.6,14.5 Z M21,20 C21,20.7 20.4,21.3 19.7,21.3 L11.4,21.3 C10.7,21.3 10.1,20.7 10.1,20 L10.1,14.5 L12.1,14.5 C11.9,14.9 11.8,15.4 11.8,15.9 C11.8,17.9 13.5,19.6 15.5,19.6 C17.5,19.6 19.2,17.9 19.2,15.9 C19.2,15.4 19.1,14.9 18.9,14.5 L20.9,14.5 L20.9,20 L21,20 Z\" id=\"Shape\"></path>
                                </g>
                            </g>
                        </g>
                    </svg>
                </a>
            </li>
            <li>
                <a href=\"https://www.facebook.com/pinkosensitivism/?ref=br_rs\" target=\"_blank\" title=\"Open Pinkosensitivism Page on Facebook\">
                    <svg width=\"40px\" height=\"40px\" viewBox=\"0 0 40 40\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\">
                        <g id=\"Symbols\" stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">
                            <g id=\"facebook\" fill-rule=\"nonzero\" fill=\"#FFFFFF\">
                                <g transform=\"translate(4.000000, 4.000000)\">
                                    <circle id=\"Oval\" fill-opacity=\"0.289147418\" cx=\"16\" cy=\"16\" r=\"16\"></circle>
                                    <path d=\"M19.2,13.4 L16.9,13.4 L16.9,11.9 C16.9,11.3 17.3,11.2 17.5,11.2 L19.1,11.2 L19.1,8.7 L16.9,8.7 C14.4,8.7 13.9,10.5 13.9,11.7 L13.9,13.3 L12.5,13.3 L12.5,16 L13.9,16 L13.9,23.2 L16.9,23.2 L16.9,16 L18.9,16 L19.2,13.4 Z\" id=\"Shape\"></path>
                                </g>
                            </g>
                        </g>
                    </svg>
                </a>
            </li>
        </ul>

        <ul id=\"instagram-grid\" class=\"instagram-grid\">
            <?php
                for (\$i=0; \$i < count(\$posts); \$i++) :
                    if (\$i < 12) : ?>
            <li>
                <a href=\"https://www.instagram.com/explore/tags/pinkosensitivism/\" target=\"_blank\" title=\"Visit Pinkosensitivism Hashtag on Instagram\">
                    <article style=\"background-image: url('<?=\$posts[\$i]->getImage()?>');\">
                        <img src=\"<?=\$posts[\$i]->getImage()?>\" alt=\"Visit Pinkosensitivism Hashtag on Instagram\">
                    </article>
                </a>
            </li>
            <?php else : ?>
            <li>
                <a href=\"https://www.instagram.com/explore/tags/pinkosensitivism/\" target=\"_blank\" title=\"Visit Pinkosensitivism Hashtag on Instagram\">
                    <article class=\"lazy\" data-src=\"<?=\$posts[\$i]->getImage()?>\"></article>
                </a>
            </li>
            <?php endif; ?>
            <?php endfor; ?>
        </ul>

    </div>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 69
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        // line 70
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
    <script src=\"";
        // line 71
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("build/js/home.js"), "html", null, true);
        echo "\"></script>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "home.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  175 => 71,  170 => 70,  161 => 69,  97 => 13,  88 => 12,  76 => 8,  67 => 7,  56 => 4,  47 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"base.html.twig\" %}

{% block title %}
    Pinkosensitivism
{% endblock %}

{% block hero %}
    <h1 class=\"title\">#PINKOSENSITIVISM</h1>
    <p class=\"title-sub\">/pɪŋkoʊˈsɛnsətɪvɪz(ə)m/ - Neologism that represents the </br>collective work of art in the age of virtual connectivity</p>
{% endblock %}

{% block body %}
    <div class=\"instagram-wrap\">
        <ul class=\"social\">
            <li>
                <a href=\"https://www.instagram.com/pinkosensitivism/\" target=\"_blank\" title=\"Open Pinkosensitivism Hashtag on Instagram\">
                    <svg width=\"40px\" height=\"40px\" viewBox=\"0 0 40 40\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\">
                        <g id=\"Symbols\" stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">
                            <g id=\"instagram\" fill-rule=\"nonzero\" fill=\"#FFFFFF\">
                                <g transform=\"translate(4.000000, 4.000000)\">
                                    <circle id=\"Oval\" fill-opacity=\"0.3\" cx=\"16\" cy=\"16\" r=\"16\"></circle>
                                    <path d=\"M19.7,9.1 L11.4,9.1 C10,9.1 8.8,10.3 8.8,11.7 L8.8,14.4 L8.8,20 C8.8,21.4 10,22.6 11.4,22.6 L19.7,22.6 C21.1,22.6 22.3,21.4 22.3,20 L22.3,14.5 L22.3,11.8 C22.3,10.3 21.1,9.1 19.7,9.1 Z M20.4,10.7 L20.7,10.7 L20.7,11 L20.7,13 L18.4,13 L18.4,10.7 L20.4,10.7 Z M13.6,14.5 C14,13.9 14.7,13.5 15.5,13.5 C16.3,13.5 17,13.9 17.4,14.5 C17.7,14.9 17.8,15.4 17.8,15.9 C17.8,17.2 16.7,18.3 15.4,18.3 C14.1,18.3 13,17.2 13,15.9 C13.2,15.3 13.3,14.9 13.6,14.5 Z M21,20 C21,20.7 20.4,21.3 19.7,21.3 L11.4,21.3 C10.7,21.3 10.1,20.7 10.1,20 L10.1,14.5 L12.1,14.5 C11.9,14.9 11.8,15.4 11.8,15.9 C11.8,17.9 13.5,19.6 15.5,19.6 C17.5,19.6 19.2,17.9 19.2,15.9 C19.2,15.4 19.1,14.9 18.9,14.5 L20.9,14.5 L20.9,20 L21,20 Z\" id=\"Shape\"></path>
                                </g>
                            </g>
                        </g>
                    </svg>
                </a>
            </li>
            <li>
                <a href=\"https://www.facebook.com/pinkosensitivism/?ref=br_rs\" target=\"_blank\" title=\"Open Pinkosensitivism Page on Facebook\">
                    <svg width=\"40px\" height=\"40px\" viewBox=\"0 0 40 40\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\">
                        <g id=\"Symbols\" stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">
                            <g id=\"facebook\" fill-rule=\"nonzero\" fill=\"#FFFFFF\">
                                <g transform=\"translate(4.000000, 4.000000)\">
                                    <circle id=\"Oval\" fill-opacity=\"0.289147418\" cx=\"16\" cy=\"16\" r=\"16\"></circle>
                                    <path d=\"M19.2,13.4 L16.9,13.4 L16.9,11.9 C16.9,11.3 17.3,11.2 17.5,11.2 L19.1,11.2 L19.1,8.7 L16.9,8.7 C14.4,8.7 13.9,10.5 13.9,11.7 L13.9,13.3 L12.5,13.3 L12.5,16 L13.9,16 L13.9,23.2 L16.9,23.2 L16.9,16 L18.9,16 L19.2,13.4 Z\" id=\"Shape\"></path>
                                </g>
                            </g>
                        </g>
                    </svg>
                </a>
            </li>
        </ul>

        <ul id=\"instagram-grid\" class=\"instagram-grid\">
            <?php
                for (\$i=0; \$i < count(\$posts); \$i++) :
                    if (\$i < 12) : ?>
            <li>
                <a href=\"https://www.instagram.com/explore/tags/pinkosensitivism/\" target=\"_blank\" title=\"Visit Pinkosensitivism Hashtag on Instagram\">
                    <article style=\"background-image: url('<?=\$posts[\$i]->getImage()?>');\">
                        <img src=\"<?=\$posts[\$i]->getImage()?>\" alt=\"Visit Pinkosensitivism Hashtag on Instagram\">
                    </article>
                </a>
            </li>
            <?php else : ?>
            <li>
                <a href=\"https://www.instagram.com/explore/tags/pinkosensitivism/\" target=\"_blank\" title=\"Visit Pinkosensitivism Hashtag on Instagram\">
                    <article class=\"lazy\" data-src=\"<?=\$posts[\$i]->getImage()?>\"></article>
                </a>
            </li>
            <?php endif; ?>
            <?php endfor; ?>
        </ul>

    </div>
{% endblock %}

{% block javascripts %}
    {{ parent() }}
    <script src=\"{{ asset('build/js/home.js') }}\"></script>
{% endblock %}", "home.html.twig", "/Users/markomitranic/Sites/personal/pinkosensitivism/templates/home.html.twig");
    }
}
