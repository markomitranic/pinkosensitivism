<?php

/* base.html.twig */
class __TwigTemplate_4c7ef4825dbb52b1c5f07797ddcf35809d6a719de46e4b93927cc13bd4ec88bb extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'meta' => array($this, 'block_meta'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'hero' => array($this, 'block_hero'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "base.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "base.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0\">

    <title>";
        // line 7
        $this->displayBlock('title', $context, $blocks);
        echo "</title>

    ";
        // line 9
        $this->displayBlock('meta', $context, $blocks);
        // line 25
        echo "
    ";
        // line 26
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 29
        echo "</head>
<body>

    <nav class=\"header\">
        <ul class=\"menu\">
            <li><a href=\"";
        // line 34
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("index");
        echo "\">Explore</a></li>
            <li><a href=\"";
        // line 35
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("manifesto");
        echo "\">Manifesto</a></li>
            <li><a href=\"";
        // line 36
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("about");
        echo "\">About</a></li>
        </ul>
        <ul class=\"social\">
            <li>
                <a href=\"mailto:info.pinkosensitivism@gmail.com\" target=\"_blank\" title=\"Send in a submission or contact via Email message\">
                    <svg width=\"40px\" height=\"40px\" viewBox=\"0 0 40 40\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\">
                        <g id=\"Symbols\" stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">
                            <g id=\"email\" fill-rule=\"nonzero\" fill=\"#FFFFFF\">
                                <g id=\"instagram\" transform=\"translate(4.000000, 4.000000)\">
                                    <circle id=\"Oval\" fill-opacity=\"0.289147418\" cx=\"16\" cy=\"16\" r=\"16\"></circle>
                                    <path d=\"M23.7115831,21.4756047 C22.9159931,21.1820068 19.1018825,19.802771 15.2359396,18.4088021 C7.53707039,15.6279646 8.00551353,15.8138153 8.00551353,15.5053067 C8.00551353,15.3975594 8.03160718,15.330639 8.10953312,15.2488079 C8.2135527,15.1298776 10.5816846,13.5015984 10.6857041,13.4719546 C10.7302586,13.4607716 20.0684126,18.3454318 21.9011809,19.3380556 C22.0462047,19.4198867 22.1688627,19.4793518 22.1688627,19.4718965 C22.1688627,19.4607135 19.986759,17.8249789 17.3175739,15.8361812 L12.4662851,12.2153767 L12.4774681,10.7060277 C12.4849234,9.27850977 12.4886511,9.18940085 12.5555715,9.11502507 C12.5963983,9.07047061 12.6707741,9.03692163 12.7227839,9.03692163 C12.7859767,9.03692163 13.191227,9.2859651 13.904986,9.76186357 C14.5035424,10.1596586 15.0016293,10.4868055 15.0128123,10.4868055 C15.0202676,10.4868055 15.5183546,10.1522033 16.116911,9.74340276 C17.105807,9.07064811 17.2210096,9 17.3623058,9 C17.4849638,9 17.5444289,9.02236599 17.6299876,9.10401958 C17.6894528,9.15975704 18.035238,9.6988483 18.3994841,10.3011323 C18.9533085,11.223108 22.7265922,17.4459997 24.8156818,20.8846812 C25.1428287,21.4237725 25.4030552,21.8920381 25.3955998,21.9255871 C25.3881445,21.9701415 25.3473177,21.9962352 25.2729419,21.9999629 C25.2097492,22.0033355 24.5369945,21.776658 23.7115831,21.4756047 Z\" id=\"Shape\" transform=\"translate(16.697878, 15.500000) rotate(-180.000000) translate(-16.697878, -15.500000) \"></path>
                                </g>
                            </g>
                        </g>
                    </svg>
                </a>
            </li>
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
    </nav>

    ";
        // line 84
        $this->displayBlock('hero', $context, $blocks);
        // line 85
        echo "    ";
        $this->displayBlock('body', $context, $blocks);
        // line 86
        echo "
    <div class=\"back-to-top\">
        <svg width=\"40px\" height=\"40px\" viewBox=\"0 0 40 40\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\">
            <defs>
                <rect id=\"path-1\" x=\"0\" y=\"0\" width=\"40\" height=\"40\" rx=\"20\"></rect>
            </defs>
            <g id=\"Symbols\" stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">
                <g id=\"Back-To-Top\">
                    <g>
                        <g id=\"Rectangle-3\">
                            <use fill-opacity=\"0.3\" fill=\"#FFFFFF\" fill-rule=\"evenodd\" xlink:href=\"#path-1\"></use>
                            <rect stroke=\"#FFFFFF\" stroke-width=\"4\" x=\"2\" y=\"2\" width=\"36\" height=\"36\" rx=\"18\"></rect>
                        </g>
                        <path d=\"M12.5,22.5 L19.5,15.5\" id=\"Line\" stroke=\"#FFFFFF\" stroke-width=\"4\" stroke-linecap=\"square\"></path>
                        <path d=\"M19.5,15.5 L26.5622577,22.5\" id=\"Line\" stroke=\"#FFFFFF\" stroke-width=\"4\" stroke-linecap=\"square\"></path>
                    </g>
                </g>
            </g>
        </svg>
    </div>

    ";
        // line 107
        $this->displayBlock('javascripts', $context, $blocks);
        // line 110
        echo "
</body>
</html>
";
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "Pinkosensitivism";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 9
    public function block_meta($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "meta"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "meta"));

        // line 10
        echo "        <meta name=\"description\" content=\"/pɪŋkoʊˈsɛnsətɪvɪz(ə)m/ - Neologism that represents the collective work of art in the age of virtual connectivity\"/>

        <meta property=\"og:url\" content=\"";
        // line 12
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("index");
        echo "\" />
        <meta property=\"og:type\" content=\"article\" />
        <meta property=\"og:title\" content=\"Pinkosensitivism\" />
        <meta property=\"og:description\" content=\"/pɪŋkoʊˈsɛnsətɪvɪz(ə)m/ - Neologism that represents the collective work of art in the age of virtual connectivity\" />
        <meta property=\"og:image\" content=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("build/images/og-hero.png"), "html", null, true);
        echo "\" />

        <meta name=\"twitter:card\" content=\"summary_large_image\">
        <meta name=\"twitter:site\" content=\"@markomitranic\">
        <meta name=\"twitter:creator\" content=\"@markomitranic\">
        <meta name=\"twitter:title\" content=\"Pinkosensitivism\">
        <meta name=\"twitter:description\" content=\"/pɪŋkoʊˈsɛnsətɪvɪz(ə)m/ - Neologism that represents the collective work of art in the age of virtual connectivity\">
        <meta name=\"twitter:image\" content=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("build/images/og-hero.png"), "html", null, true);
        echo "\">
    ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 26
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 27
        echo "        <link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("build/css/app.css"), "html", null, true);
        echo "\">
    ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 84
    public function block_hero($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "hero"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "hero"));

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 85
    public function block_body($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 107
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        // line 108
        echo "        <script src=\"";
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("build/js/app.js"), "html", null, true);
        echo "\"></script>
    ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  289 => 108,  280 => 107,  263 => 85,  246 => 84,  233 => 27,  224 => 26,  212 => 23,  202 => 16,  195 => 12,  191 => 10,  182 => 9,  164 => 7,  151 => 110,  149 => 107,  126 => 86,  123 => 85,  121 => 84,  70 => 36,  66 => 35,  62 => 34,  55 => 29,  53 => 26,  50 => 25,  48 => 9,  43 => 7,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0\">

    <title>{% block title %}Pinkosensitivism{% endblock %}</title>

    {% block meta %}
        <meta name=\"description\" content=\"/pɪŋkoʊˈsɛnsətɪvɪz(ə)m/ - Neologism that represents the collective work of art in the age of virtual connectivity\"/>

        <meta property=\"og:url\" content=\"{{ url('index') }}\" />
        <meta property=\"og:type\" content=\"article\" />
        <meta property=\"og:title\" content=\"Pinkosensitivism\" />
        <meta property=\"og:description\" content=\"/pɪŋkoʊˈsɛnsətɪvɪz(ə)m/ - Neologism that represents the collective work of art in the age of virtual connectivity\" />
        <meta property=\"og:image\" content=\"{{ asset('build/images/og-hero.png') }}\" />

        <meta name=\"twitter:card\" content=\"summary_large_image\">
        <meta name=\"twitter:site\" content=\"@markomitranic\">
        <meta name=\"twitter:creator\" content=\"@markomitranic\">
        <meta name=\"twitter:title\" content=\"Pinkosensitivism\">
        <meta name=\"twitter:description\" content=\"/pɪŋkoʊˈsɛnsətɪvɪz(ə)m/ - Neologism that represents the collective work of art in the age of virtual connectivity\">
        <meta name=\"twitter:image\" content=\"{{ asset('build/images/og-hero.png') }}\">
    {% endblock %}

    {% block stylesheets %}
        <link rel=\"stylesheet\" href=\"{{ asset('build/css/app.css') }}\">
    {% endblock %}
</head>
<body>

    <nav class=\"header\">
        <ul class=\"menu\">
            <li><a href=\"{{ path('index') }}\">Explore</a></li>
            <li><a href=\"{{ path('manifesto') }}\">Manifesto</a></li>
            <li><a href=\"{{ path('about') }}\">About</a></li>
        </ul>
        <ul class=\"social\">
            <li>
                <a href=\"mailto:info.pinkosensitivism@gmail.com\" target=\"_blank\" title=\"Send in a submission or contact via Email message\">
                    <svg width=\"40px\" height=\"40px\" viewBox=\"0 0 40 40\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\">
                        <g id=\"Symbols\" stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">
                            <g id=\"email\" fill-rule=\"nonzero\" fill=\"#FFFFFF\">
                                <g id=\"instagram\" transform=\"translate(4.000000, 4.000000)\">
                                    <circle id=\"Oval\" fill-opacity=\"0.289147418\" cx=\"16\" cy=\"16\" r=\"16\"></circle>
                                    <path d=\"M23.7115831,21.4756047 C22.9159931,21.1820068 19.1018825,19.802771 15.2359396,18.4088021 C7.53707039,15.6279646 8.00551353,15.8138153 8.00551353,15.5053067 C8.00551353,15.3975594 8.03160718,15.330639 8.10953312,15.2488079 C8.2135527,15.1298776 10.5816846,13.5015984 10.6857041,13.4719546 C10.7302586,13.4607716 20.0684126,18.3454318 21.9011809,19.3380556 C22.0462047,19.4198867 22.1688627,19.4793518 22.1688627,19.4718965 C22.1688627,19.4607135 19.986759,17.8249789 17.3175739,15.8361812 L12.4662851,12.2153767 L12.4774681,10.7060277 C12.4849234,9.27850977 12.4886511,9.18940085 12.5555715,9.11502507 C12.5963983,9.07047061 12.6707741,9.03692163 12.7227839,9.03692163 C12.7859767,9.03692163 13.191227,9.2859651 13.904986,9.76186357 C14.5035424,10.1596586 15.0016293,10.4868055 15.0128123,10.4868055 C15.0202676,10.4868055 15.5183546,10.1522033 16.116911,9.74340276 C17.105807,9.07064811 17.2210096,9 17.3623058,9 C17.4849638,9 17.5444289,9.02236599 17.6299876,9.10401958 C17.6894528,9.15975704 18.035238,9.6988483 18.3994841,10.3011323 C18.9533085,11.223108 22.7265922,17.4459997 24.8156818,20.8846812 C25.1428287,21.4237725 25.4030552,21.8920381 25.3955998,21.9255871 C25.3881445,21.9701415 25.3473177,21.9962352 25.2729419,21.9999629 C25.2097492,22.0033355 24.5369945,21.776658 23.7115831,21.4756047 Z\" id=\"Shape\" transform=\"translate(16.697878, 15.500000) rotate(-180.000000) translate(-16.697878, -15.500000) \"></path>
                                </g>
                            </g>
                        </g>
                    </svg>
                </a>
            </li>
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
    </nav>

    {% block hero %}{% endblock %}
    {% block body %}{% endblock %}

    <div class=\"back-to-top\">
        <svg width=\"40px\" height=\"40px\" viewBox=\"0 0 40 40\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\">
            <defs>
                <rect id=\"path-1\" x=\"0\" y=\"0\" width=\"40\" height=\"40\" rx=\"20\"></rect>
            </defs>
            <g id=\"Symbols\" stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">
                <g id=\"Back-To-Top\">
                    <g>
                        <g id=\"Rectangle-3\">
                            <use fill-opacity=\"0.3\" fill=\"#FFFFFF\" fill-rule=\"evenodd\" xlink:href=\"#path-1\"></use>
                            <rect stroke=\"#FFFFFF\" stroke-width=\"4\" x=\"2\" y=\"2\" width=\"36\" height=\"36\" rx=\"18\"></rect>
                        </g>
                        <path d=\"M12.5,22.5 L19.5,15.5\" id=\"Line\" stroke=\"#FFFFFF\" stroke-width=\"4\" stroke-linecap=\"square\"></path>
                        <path d=\"M19.5,15.5 L26.5622577,22.5\" id=\"Line\" stroke=\"#FFFFFF\" stroke-width=\"4\" stroke-linecap=\"square\"></path>
                    </g>
                </g>
            </g>
        </svg>
    </div>

    {% block javascripts %}
        <script src=\"{{ asset('build/js/app.js') }}\"></script>
    {% endblock %}

</body>
</html>
", "base.html.twig", "/Users/markomitranic/Sites/personal/pinkosensitivism/templates/base.html.twig");
    }
}
