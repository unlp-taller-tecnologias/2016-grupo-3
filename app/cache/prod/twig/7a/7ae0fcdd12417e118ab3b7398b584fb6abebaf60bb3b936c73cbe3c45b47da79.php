<?php

/* login/login.html.twig */
class __TwigTemplate_837b88686dc198d5229e9811e4603f2f61ee56067593249a00285f66a38efbe5 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        ";
        // line 6
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 9
        echo "        <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
    </head>
    <body  style=\"font-family: 'Dosis-Book'; background-color:#870028; \" >
        ";
        // line 12
        $this->displayBlock('body', $context, $blocks);
        // line 57
        echo "        ";
        $this->displayBlock('javascripts', $context, $blocks);
        // line 58
        echo "    </body>
</html>



";
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        echo "Bienvenido!";
    }

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 7
        echo "             <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/framework/css/bootstrap.css"), "html", null, true);
        echo "\">
        ";
    }

    // line 12
    public function block_body($context, array $blocks = array())
    {
        // line 13
        echo "        
\t\t
<div class=\"container\" >
 <div class=\"col-md-4\"></div>
\t<div class=\"col-md-4 \" style=\"margin-top: 100px;\"  id=\"form\" >
\t\t  <h4 style=\"border-bottom: 1px solid #c5c5c5;\">
\t\t \t<img src=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/framework/images/encabezado.png"), "html", null, true);
        echo "\" class=\"img-responsive\" style=\"margin:0 auto;width:450px;\"/>
\t\t\t<p style=\"margin: 0 auto; font-family: 'Dosis-Book'; \"></p>
\t\t  </h4>

\t\t  <div style=\"padding: 15px;\" id=\"form-olvidado\">
\t\t\t  <form accept-charset=\"UTF-8\" role=\"form\" id=\"login-form\" action=\"\" method=\"post\">  
\t\t\t\t  <fieldset>
\t\t\t\t\t<div class=\"form-group input-group\">
\t\t\t\t\t  <span class=\"input-group-addon\">
\t\t\t\t\t\t<i class=\"glyphicon glyphicon-user\"></i>
\t\t\t\t\t  </span>
\t\t\t\t\t  <input class=\"form-control\" placeholder=\"Usuario\" id=\"txtUsr\" name=\"txtUsr\" required=\"\" autofocus=\"\">
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"form-group input-group\">
\t\t\t\t\t  <span class=\"input-group-addon\">
\t\t\t\t\t\t<i class=\"glyphicon glyphicon-lock\">
\t\t\t\t\t\t</i>
\t\t\t\t\t  </span>
\t\t\t\t\t  <input class=\"form-control\" placeholder=\"Password\"  id=\"txtPass\" name=\"txtPass\" type=\"password\" value=\"\" required=\"\">
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t  <button type=\"submit\" class=\"btn btn-primary btn-block\">
\t\t\t\t\t\tIniciar Sesión
\t\t\t\t\t  </button>
\t\t\t\t\t  <p class=\"help-block\">
\t\t\t\t\t\t<!--<a class=\"pull-right text-muted\" href=\"#\" style=\"color:white\" id=\"olvidado\"><small>Olvid&oacute; su contrase&ntilde;a?</small></a>-->
\t\t\t\t\t  </p>
\t\t\t\t\t</div>
\t\t\t\t  </fieldset>
\t\t\t\t</form>
\t\t\t\t <div class=\"col-md-4\"></div>
\t\t  </div>
\t\t  
\t
\t</div>
</div>

        ";
    }

    // line 57
    public function block_javascripts($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "login/login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  125 => 57,  83 => 19,  75 => 13,  72 => 12,  65 => 7,  62 => 6,  56 => 5,  47 => 58,  44 => 57,  42 => 12,  35 => 9,  33 => 6,  29 => 5,  23 => 1,);
    }

    public function getSource()
    {
        return "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>{% block title %}Bienvenido!{% endblock %}</title>
        {% block stylesheets %}
             <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ asset('bundles/framework/css/bootstrap.css')}}\">
        {% endblock %}
        <link rel=\"icon\" type=\"image/x-icon\" href=\"{{ asset('favicon.ico') }}\" />
    </head>
    <body  style=\"font-family: 'Dosis-Book'; background-color:#870028; \" >
        {% block body %}
        
\t\t
<div class=\"container\" >
 <div class=\"col-md-4\"></div>
\t<div class=\"col-md-4 \" style=\"margin-top: 100px;\"  id=\"form\" >
\t\t  <h4 style=\"border-bottom: 1px solid #c5c5c5;\">
\t\t \t<img src=\"{{ asset('bundles/framework/images/encabezado.png') }}\" class=\"img-responsive\" style=\"margin:0 auto;width:450px;\"/>
\t\t\t<p style=\"margin: 0 auto; font-family: 'Dosis-Book'; \"></p>
\t\t  </h4>

\t\t  <div style=\"padding: 15px;\" id=\"form-olvidado\">
\t\t\t  <form accept-charset=\"UTF-8\" role=\"form\" id=\"login-form\" action=\"\" method=\"post\">  
\t\t\t\t  <fieldset>
\t\t\t\t\t<div class=\"form-group input-group\">
\t\t\t\t\t  <span class=\"input-group-addon\">
\t\t\t\t\t\t<i class=\"glyphicon glyphicon-user\"></i>
\t\t\t\t\t  </span>
\t\t\t\t\t  <input class=\"form-control\" placeholder=\"Usuario\" id=\"txtUsr\" name=\"txtUsr\" required=\"\" autofocus=\"\">
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"form-group input-group\">
\t\t\t\t\t  <span class=\"input-group-addon\">
\t\t\t\t\t\t<i class=\"glyphicon glyphicon-lock\">
\t\t\t\t\t\t</i>
\t\t\t\t\t  </span>
\t\t\t\t\t  <input class=\"form-control\" placeholder=\"Password\"  id=\"txtPass\" name=\"txtPass\" type=\"password\" value=\"\" required=\"\">
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t  <button type=\"submit\" class=\"btn btn-primary btn-block\">
\t\t\t\t\t\tIniciar Sesión
\t\t\t\t\t  </button>
\t\t\t\t\t  <p class=\"help-block\">
\t\t\t\t\t\t<!--<a class=\"pull-right text-muted\" href=\"#\" style=\"color:white\" id=\"olvidado\"><small>Olvid&oacute; su contrase&ntilde;a?</small></a>-->
\t\t\t\t\t  </p>
\t\t\t\t\t</div>
\t\t\t\t  </fieldset>
\t\t\t\t</form>
\t\t\t\t <div class=\"col-md-4\"></div>
\t\t  </div>
\t\t  
\t
\t</div>
</div>

        {% endblock %}
        {% block javascripts %}{% endblock %}
    </body>
</html>



";
    }
}
