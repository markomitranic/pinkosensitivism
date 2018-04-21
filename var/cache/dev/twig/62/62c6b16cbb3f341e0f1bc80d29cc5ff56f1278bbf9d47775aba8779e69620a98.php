<?php

/* about.html.twig */
class __TwigTemplate_5ac1567fa30f2a1bcf9728f25a1051049797efff18f49c82a3007310fa0f6de4 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base.html.twig", "about.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'hero' => array($this, 'block_hero'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "about.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "about.html.twig"));

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
        echo "    Pinkosensitivism ~ About
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
        echo "    <h1 class=\"title title-small\">#PINKOSENSITIVISM</h1>
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
        echo "    <main class=\"content\">

        <h2>Pinkosensitivism as Neologism</h2>
        <p>Pinkosensitivism is a new word coined especially for an user affected by the color pink, and is meaningless otherwise. It's a combination of two existing words pink, sensitive and a suffix -ism which in general describes the audience and the goal of the project. </p>

        <blockquote>
            <i class=\"fa fa-quote-left\" aria-hidden=\"true\"></i>
            <strong>Pink</strong>
            - Pale red color that is named after a flower of the same name. Pink is the color most often associated with charm, politeness, sensitivity, tenderness, sweetness, childhood, femininity and the romantic.
            <br><br>
            <strong>Sensitive</strong>
            - Adjective which derives from Middle French sensitif, and describes having the faculty of sensation, pertaining to the senses. Responsive to stimuli.
            <br><br>
            <strong>-ism</strong>
            - Suffix in many English words, originally derived from the Ancient Greek suffix -ισμός (-ismós). It is often used in philosophy to define specific ideologies, and, as such, at times it is used as a noun when referring to a broad range of ideologies in a general sense.
        </blockquote>

        <h2>Explore #pinkosensitivism</h2>
        <p>Pinkosensitivism is an ongoing Art Project which formed itself spontaneously by the author’s interest in femininity and with further research of the feminine space. The project is conceived as a hashtag (#) on social platforms (mainly on Instagram because it provides a powerful visual experience) where individual authors can tag their own posts with #pinkosensitivism and create an overall experience of dominant pink environment. Instagram profile @pinkosensitivism should not be the sole focus of this project because it serves as a showcase where individuals can submit photos, artworks etc...</p>

        <h2>Terms of Use </h2>
        <p>There are no rules on what you can tag with #pinkosensitivism as long as it is pink (in any shades). All daily active users are encouraged to use #pinkosensitivism on individual photographs, and avoid unknown pictures on Internet, or at least if reposted to be credited properly, because ownership rights are important.</p>

        <h2>Future plans</h2>
        <p>At the moment, Pinkosensitivism exist only in the realms of digital platforms but in the future, a special format of an exhibition could be possible in which a selection of photographs could be brought to physical space (with the authors’ permission)</p>

    </main>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "about.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  96 => 13,  87 => 12,  75 => 8,  66 => 7,  55 => 4,  46 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"base.html.twig\" %}

{% block title %}
    Pinkosensitivism ~ About
{% endblock %}

{% block hero %}
    <h1 class=\"title title-small\">#PINKOSENSITIVISM</h1>
    <p class=\"title-sub\">/pɪŋkoʊˈsɛnsətɪvɪz(ə)m/ - Neologism that represents the </br>collective work of art in the age of virtual connectivity</p>
{% endblock %}

{% block body %}
    <main class=\"content\">

        <h2>Pinkosensitivism as Neologism</h2>
        <p>Pinkosensitivism is a new word coined especially for an user affected by the color pink, and is meaningless otherwise. It's a combination of two existing words pink, sensitive and a suffix -ism which in general describes the audience and the goal of the project. </p>

        <blockquote>
            <i class=\"fa fa-quote-left\" aria-hidden=\"true\"></i>
            <strong>Pink</strong>
            - Pale red color that is named after a flower of the same name. Pink is the color most often associated with charm, politeness, sensitivity, tenderness, sweetness, childhood, femininity and the romantic.
            <br><br>
            <strong>Sensitive</strong>
            - Adjective which derives from Middle French sensitif, and describes having the faculty of sensation, pertaining to the senses. Responsive to stimuli.
            <br><br>
            <strong>-ism</strong>
            - Suffix in many English words, originally derived from the Ancient Greek suffix -ισμός (-ismós). It is often used in philosophy to define specific ideologies, and, as such, at times it is used as a noun when referring to a broad range of ideologies in a general sense.
        </blockquote>

        <h2>Explore #pinkosensitivism</h2>
        <p>Pinkosensitivism is an ongoing Art Project which formed itself spontaneously by the author’s interest in femininity and with further research of the feminine space. The project is conceived as a hashtag (#) on social platforms (mainly on Instagram because it provides a powerful visual experience) where individual authors can tag their own posts with #pinkosensitivism and create an overall experience of dominant pink environment. Instagram profile @pinkosensitivism should not be the sole focus of this project because it serves as a showcase where individuals can submit photos, artworks etc...</p>

        <h2>Terms of Use </h2>
        <p>There are no rules on what you can tag with #pinkosensitivism as long as it is pink (in any shades). All daily active users are encouraged to use #pinkosensitivism on individual photographs, and avoid unknown pictures on Internet, or at least if reposted to be credited properly, because ownership rights are important.</p>

        <h2>Future plans</h2>
        <p>At the moment, Pinkosensitivism exist only in the realms of digital platforms but in the future, a special format of an exhibition could be possible in which a selection of photographs could be brought to physical space (with the authors’ permission)</p>

    </main>
{% endblock %}
", "about.html.twig", "/Users/markomitranic/Sites/personal/pinkosensitivism/templates/about.html.twig");
    }
}
