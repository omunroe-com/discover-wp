<?php

/* ask.html.twig */
class __TwigTemplate_921dd5c72c5c781a4a32e96c4d5e0e21 extends Twig_Template
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
        // line 7
        ob_start();
        // line 8
        echo "
<div class=\"cookillian-alert\" style=\"display:none;\">
    <a class=\"close\">&times;</a>
    <h3 class=\"alert-heading\">";
        // line 11
        if (isset($context["alert_heading"])) { $_alert_heading_ = $context["alert_heading"]; } else { $_alert_heading_ = null; }
        echo twig_escape_filter($this->env, $_alert_heading_, "html", null, true);
        echo "</h3>
    ";
        // line 12
        if (isset($context["alert_content"])) { $_alert_content_ = $context["alert_content"]; } else { $_alert_content_ = null; }
        echo $_alert_content_;
        echo "
    <div class=\"buttons\">
        <a class=\"btn btn-ok\" href=\"";
        // line 14
        if (isset($context["response_ok"])) { $_response_ok_ = $context["response_ok"]; } else { $_response_ok_ = null; }
        echo twig_escape_filter($this->env, $_response_ok_, "html", null, true);
        echo "\" rel=\"nofollow\"><i class=\"\"></i>";
        if (isset($context["alert_ok"])) { $_alert_ok_ = $context["alert_ok"]; } else { $_alert_ok_ = null; }
        echo twig_escape_filter($this->env, $_alert_ok_, "html", null, true);
        echo "</a>&nbsp;
        <a class=\"btn btn-no\" href=\"";
        // line 15
        if (isset($context["response_no"])) { $_response_no_ = $context["response_no"]; } else { $_response_no_ = null; }
        echo twig_escape_filter($this->env, $_response_no_, "html", null, true);
        echo "\" rel=\"nofollow\"><i class=\"\"></i>";
        if (isset($context["alert_no"])) { $_alert_no_ = $context["alert_no"]; } else { $_alert_no_ = null; }
        echo twig_escape_filter($this->env, $_alert_no_, "html", null, true);
        echo "</a>
    </div>
</div>

";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "ask.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  45 => 15,  37 => 14,  31 => 12,  26 => 11,  21 => 8,  19 => 7,);
    }
}
