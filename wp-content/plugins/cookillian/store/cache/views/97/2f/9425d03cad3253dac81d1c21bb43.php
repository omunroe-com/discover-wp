<?php

/* dashboard_main.html.twig */
class __TwigTemplate_972f9425d03cad3253dac81d1c21bb43 extends Twig_Template
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
        echo "
<div id=\"cookillian_new_cookies_dash\">
    <h4>";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("New Cookies"), "html", null, true);
        echo "</h4>
    ";
        // line 10
        if (isset($context["new_cookies"])) { $_new_cookies_ = $context["new_cookies"]; } else { $_new_cookies_ = null; }
        if ((!twig_test_empty($_new_cookies_))) {
            // line 11
            echo "        <p>
            ";
            // line 12
            echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("The following new cookie(s) were detected:"), "html", null, true);
            echo "
            <em>
                ";
            // line 14
            if (isset($context["new_cookies"])) { $_new_cookies_ = $context["new_cookies"]; } else { $_new_cookies_ = null; }
            echo twig_escape_filter($this->env, $_new_cookies_, "html", null, true);
            echo "
            </em>
            &ndash;
            <a href=\"";
            // line 17
            if (isset($context["cookie_url"])) { $_cookie_url_ = $context["cookie_url"]; } else { $_cookie_url_ = null; }
            echo twig_escape_filter($this->env, $_cookie_url_, "html", null, true);
            echo "\" title=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Edit the cookies"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Edit"), "html", null, true);
            echo "</a>
        </p>


    ";
        } else {
            // line 22
            echo "        <p>";
            echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("No new cookies detected"), "html", null, true);
            echo "</p>
    ";
        }
        // line 24
        echo "</div>

<div id=\"cookillian_stats_dash\">
    <h4>";
        // line 27
        if (isset($context["max_stats"])) { $_max_stats_ = $context["max_stats"]; } else { $_max_stats_ = null; }
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter((("Top " . $_max_stats_) . " Statistics for")), "html", null, true);
        echo " ";
        if (isset($context["month"])) { $_month_ = $context["month"]; } else { $_month_ = null; }
        echo twig_escape_filter($this->env, $_month_, "html", null, true);
        echo " ";
        if (isset($context["year"])) { $_year_ = $context["year"]; } else { $_year_ = null; }
        echo twig_escape_filter($this->env, $_year_, "html", null, true);
        echo "</h4>
    ";
        // line 28
        if (isset($context["stats"])) { $_stats_ = $context["stats"]; } else { $_stats_ = null; }
        if ((!twig_test_empty($_stats_))) {
            // line 29
            echo "        <br />
        <table class=\"widefat\">
            <thead>
                <tr>
                    <th scope=\"col\">";
            // line 33
            echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Country"), "html", null, true);
            echo "</th>
                    <th scope=\"col\">Alerts Displayed</th>
                    <th scope=\"col\">Opted In</th>
                    <th scope=\"col\">Opted Out</th>
                    <th scope=\"col\">Ignored</th>
                </tr>
            </thead>
            <tbody>
                ";
            // line 41
            if (isset($context["stats"])) { $_stats_ = $context["stats"]; } else { $_stats_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_stats_);
            foreach ($context['_seq'] as $context["country_abbr"] => $context["country_stat"]) {
                // line 42
                echo "                    ";
                if (isset($context["country_abbr"])) { $_country_abbr_ = $context["country_abbr"]; } else { $_country_abbr_ = null; }
                if (twig_test_empty($_country_abbr_)) {
                    // line 43
                    echo "                        ";
                    $context["country_name"] = "Unknown";
                    // line 44
                    echo "                    ";
                } elseif (($_country_abbr_ == "EU")) {
                    // line 45
                    echo "                        ";
                    $context["country_name"] = "Europe (country unknown)";
                    // line 46
                    echo "                    ";
                } elseif (($_country_abbr_ == "AP")) {
                    // line 47
                    echo "                        ";
                    $context["country_name"] = "Asia/Pacific (country unknown)";
                    // line 48
                    echo "                    ";
                } else {
                    // line 49
                    echo "                        ";
                    if (isset($context["countries"])) { $_countries_ = $context["countries"]; } else { $_countries_ = null; }
                    if (isset($context["country_abbr"])) { $_country_abbr_ = $context["country_abbr"]; } else { $_country_abbr_ = null; }
                    $context["country_name"] = $this->getAttribute($this->getAttribute($_countries_, $_country_abbr_, array(), "array"), "country");
                    // line 50
                    echo "                    ";
                }
                // line 51
                echo "
                    <tr>
                        <td>";
                // line 53
                if (isset($context["country_name"])) { $_country_name_ = $context["country_name"]; } else { $_country_name_ = null; }
                echo twig_escape_filter($this->env, $_country_name_, "html", null, true);
                echo "</td>
                        <td>";
                // line 54
                if (isset($context["country_stat"])) { $_country_stat_ = $context["country_stat"]; } else { $_country_stat_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_country_stat_, 0), "html", null, true);
                echo "</td>
                        <td>";
                // line 55
                if (isset($context["country_stat"])) { $_country_stat_ = $context["country_stat"]; } else { $_country_stat_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_country_stat_, 1), "html", null, true);
                echo "</td>
                        <td>";
                // line 56
                if (isset($context["country_stat"])) { $_country_stat_ = $context["country_stat"]; } else { $_country_stat_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_country_stat_, 2), "html", null, true);
                echo "</td>
                        <td>";
                // line 57
                if (isset($context["country_stat"])) { $_country_stat_ = $context["country_stat"]; } else { $_country_stat_ = null; }
                echo twig_escape_filter($this->env, ($this->getAttribute($_country_stat_, 0) - ($this->getAttribute($_country_stat_, 1) + $this->getAttribute($_country_stat_, 2))), "html", null, true);
                echo "</td>
                    </tr>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['country_abbr'], $context['country_stat'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 60
            echo "            </tbody>
        </table>

        ";
            // line 63
            if (isset($context["max_stats"])) { $_max_stats_ = $context["max_stats"]; } else { $_max_stats_ = null; }
            if (isset($context["stats_count"])) { $_stats_count_ = $context["stats_count"]; } else { $_stats_count_ = null; }
            if ((($_max_stats_ > 0) && ($_stats_count_ > $_max_stats_))) {
                echo "<p><a href=\"";
                if (isset($context["stats_url"])) { $_stats_url_ = $context["stats_url"]; } else { $_stats_url_ = null; }
                echo twig_escape_filter($this->env, $_stats_url_, "html", null, true);
                echo "\" title=\"See more statistics\">";
                echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("See more"), "html", null, true);
                echo " &hellip;</a></p>";
            }
            // line 64
            echo "    ";
        } else {
            // line 65
            echo "        <p>";
            echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("No statistics reported yet. Not to worry, they'll come soon."), "html", null, true);
            echo "</p>
    ";
        }
        // line 67
        echo "
</div>
";
    }

    public function getTemplateName()
    {
        return "dashboard_main.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  194 => 67,  188 => 65,  185 => 64,  174 => 63,  169 => 60,  159 => 57,  154 => 56,  149 => 55,  144 => 54,  139 => 53,  135 => 51,  132 => 50,  127 => 49,  124 => 48,  121 => 47,  118 => 46,  115 => 45,  112 => 44,  109 => 43,  105 => 42,  100 => 41,  89 => 33,  83 => 29,  80 => 28,  69 => 27,  64 => 24,  58 => 22,  45 => 17,  38 => 14,  33 => 12,  30 => 11,  27 => 10,  23 => 9,  19 => 7,);
    }
}
