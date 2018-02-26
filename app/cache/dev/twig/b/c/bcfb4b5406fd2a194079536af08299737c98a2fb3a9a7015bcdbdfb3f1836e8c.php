<?php

/* TripBookingEngineBundle:Default:footerTabs.html.twig */
class __TwigTemplate_bcfb4b5406fd2a194079536af08299737c98a2fb3a9a7015bcdbdfb3f1836e8c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div class=\"tab\" role=\"tabpanel\">
                                <!-- Nav tabs -->
                                <ul class=\"nav nav-tabs\" role=\"tablist\">
                                \t<li role=\"presentation\" class=\"active\"><a href=\"#Section3\" aria-controls=\"messages\" role=\"tab\" data-toggle=\"tab\">Packages</a></li>
                                    <li role=\"presentation\"><a href=\"#Section2\" aria-controls=\"profile\" role=\"tab\" data-toggle=\"tab\">Bikes On Rent</a></li>
                                    <li role=\"presentation\"><a href=\"#Section1\" aria-controls=\"home\" role=\"tab\" data-toggle=\"tab\">Taxi Services</a></li>
                                </ul>
                                <!-- Tab panes -->
                                <div class=\"tab-content tabs\">
                                    <div role=\"tabpanel\" class=\"tab-pane fade in active\" id=\"Section3\" style=\"font-size: 12px;\">
                                           ";
        // line 11
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["onepackages"]) ? $context["onepackages"] : $this->getContext($context, "onepackages")));
        foreach ($context['_seq'] as $context["_key"] => $context["package"]) {
            echo " 
                                           <a href=\"";
            // line 12
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("trip_site_management_homepage_special_packages", array("url" => $this->getAttribute($context["package"], "locationUrl", array()))), "html", null, true);
            echo "\">
                                           <span class=\"packages-link\">";
            // line 13
            echo twig_escape_filter($this->env, $this->getAttribute($context["package"], "title", array()), "html", null, true);
            echo " In Tirupati</span></a>|
                                           ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['package'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 15
        echo "                                           
                                        </div>
                                    <div role=\"tabpanel\" class=\"tab-pane fade\" id=\"Section2\"  style=\"font-size: 12px;\">
                                        ";
        // line 18
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["bikes"]) ? $context["bikes"] : $this->getContext($context, "bikes")));
        foreach ($context['_seq'] as $context["_key"] => $context["bike"]) {
            echo " 
                                        <a href=\"";
            // line 19
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("trip_site_management_view_bikes", array("url" => $this->getAttribute($context["bike"], "locationUrl", array()))), "html", null, true);
            echo "\">
                                       <span class=\"packages-link\">";
            // line 20
            echo twig_escape_filter($this->env, $this->getAttribute($context["bike"], "title", array()), "html", null, true);
            echo " In Tirupati</span>
                                       </a>|
                                       ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['bike'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 23
        echo "                                        
                                    </div>
                                    <div role=\"tabpanel\" class=\"tab-pane fade\" id=\"Section1\" style=\"font-size: 12px;\">
                                      ";
        // line 26
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["cities"]) ? $context["cities"] : $this->getContext($context, "cities")));
        foreach ($context['_seq'] as $context["_key"] => $context["city"]) {
            echo " 
                                       <span>Taxi services in ";
            // line 27
            echo twig_escape_filter($this->env, $this->getAttribute($context["city"], "name", array()), "html", null, true);
            echo "</span>|
                                       ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['city'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 29
        echo "                                    </div>
                                </div>
</div>";
    }

    public function getTemplateName()
    {
        return "TripBookingEngineBundle:Default:footerTabs.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  92 => 29,  84 => 27,  78 => 26,  73 => 23,  64 => 20,  60 => 19,  54 => 18,  49 => 15,  41 => 13,  37 => 12,  31 => 11,  19 => 1,);
    }
}
