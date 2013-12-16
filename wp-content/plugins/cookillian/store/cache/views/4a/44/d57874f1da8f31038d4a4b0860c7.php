<?php

/* stats.html.twig */
class __TwigTemplate_4a44d57874f1da8f31038d4a4b0860c7 extends Twig_Template
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
";
        // line 8
        $context["thr"] = "";
        // line 9
        $context["total_display"] = 0;
        // line 10
        $context["total_optin"] = 0;
        // line 11
        $context["total_optout"] = 0;
        // line 12
        echo "<div style=\"position: relative; width: 100%;\"> ";
        // line 13
        echo "    <form method=\"post\" action=\"\" id=\"stats_form\">
        ";
        // line 14
        if (isset($context["nonce"])) { $_nonce_ = $context["nonce"]; } else { $_nonce_ = null; }
        echo $_nonce_;
        echo "
        <div class=\"tablenav top\">
            <div class=\"alignleft actions\">
                <select name=\"stat_year\">
                    ";
        // line 18
        if (isset($context["years"])) { $_years_ = $context["years"]; } else { $_years_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_years_);
        foreach ($context['_seq'] as $context["_key"] => $context["a_year"]) {
            // line 19
            echo "                    <option value=\"";
            if (isset($context["a_year"])) { $_a_year_ = $context["a_year"]; } else { $_a_year_ = null; }
            echo twig_escape_filter($this->env, $_a_year_, "html", null, true);
            echo "\" ";
            if (isset($context["a_year"])) { $_a_year_ = $context["a_year"]; } else { $_a_year_ = null; }
            if (isset($context["year"])) { $_year_ = $context["year"]; } else { $_year_ = null; }
            if (($_a_year_ == $_year_)) {
                echo "selected=\"selected\"";
            }
            echo ">";
            if (isset($context["a_year"])) { $_a_year_ = $context["a_year"]; } else { $_a_year_ = null; }
            echo twig_escape_filter($this->env, $_a_year_, "html", null, true);
            echo "</option>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['a_year'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 21
        echo "                </select>

                <input type=\"submit\" name=\"select-year\" class=\"button action\" value=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("View year"), "html", null, true);
        echo "\" title=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("View the statistics for the selected year"), "html", null, true);
        echo "\" />

                <input type=\"submit\" name=\"clear-stats\" id=\"clear-stats\" class=\"button action\" value=\"";
        // line 25
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Delete year"), "html", null, true);
        echo "\" title=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Delete the statistics for the selected year"), "html", null, true);
        echo "\" />
            </div>

            <div class=\"alignleft actions\">
                <input type=\"submit\" name=\"download-stats\" class=\"button action\" value=\"";
        // line 29
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Download Statistics"), "html", null, true);
        echo "\" title=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Download a CSV file with all the statistics"), "html", null, true);
        echo "\" />
            </div>
        </div>

        <h3>";
        // line 33
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Results for"), "html", null, true);
        echo " ";
        if (isset($context["year"])) { $_year_ = $context["year"]; } else { $_year_ = null; }
        echo twig_escape_filter($this->env, $_year_, "html", null, true);
        echo "</h3>
        <table class=\"widefat fixed\">
            <thead>
                <tr>
                    <th scope=\"col\">Country</th>
                    <th scope=\"col\">Alerts Displayed</th>
                    <th scope=\"col\">Opted In</th>
                    <th scope=\"col\">Opted Out</th>
                    <th scope=\"col\">Ignored</th>
                </tr>
            </thead>
            <tbody>
                ";
        // line 45
        if (isset($context["stats"])) { $_stats_ = $context["stats"]; } else { $_stats_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_stats_);
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["month_name"] => $context["month_stat"]) {
            // line 46
            echo "                    ";
            if (isset($context["thr"])) { $_thr_ = $context["thr"]; } else { $_thr_ = null; }
            if (isset($context["month_name"])) { $_month_name_ = $context["month_name"]; } else { $_month_name_ = null; }
            if (($_thr_ != $_month_name_)) {
                // line 47
                echo "                        ";
                if (isset($context["month_name"])) { $_month_name_ = $context["month_name"]; } else { $_month_name_ = null; }
                $context["thr"] = $_month_name_;
                // line 48
                echo "                        ";
                if (isset($context["stats"])) { $_stats_ = $context["stats"]; } else { $_stats_ = null; }
                if (isset($context["loop"])) { $_loop_ = $context["loop"]; } else { $_loop_ = null; }
                if ((twig_length_filter($this->env, $_stats_) == $this->getAttribute($_loop_, "index"))) {
                    // line 49
                    echo "                            ";
                    $context["is_last"] = true;
                    // line 50
                    echo "                        ";
                } else {
                    // line 51
                    echo "                            ";
                    $context["is_last"] = false;
                    // line 52
                    echo "                        ";
                }
                // line 53
                echo "
                        <tr>
                            <th scope=\"row\" colspan=\"5\" class=\"month-row ";
                // line 55
                if (isset($context["is_last"])) { $_is_last_ = $context["is_last"]; } else { $_is_last_ = null; }
                if ($_is_last_) {
                    echo "expanded";
                }
                echo "\" id=\"row_";
                if (isset($context["month_name"])) { $_month_name_ = $context["month_name"]; } else { $_month_name_ = null; }
                echo twig_escape_filter($this->env, $_month_name_, "html", null, true);
                echo "\" title=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Click to expand"), "html", null, true);
                echo "\">
                                <strong>";
                // line 56
                if (isset($context["month_name"])) { $_month_name_ = $context["month_name"]; } else { $_month_name_ = null; }
                echo twig_escape_filter($this->env, $_month_name_, "html", null, true);
                echo "</strong>
                                <span class=\"hide-if-no-js collapse-btn\">
                                    ";
                // line 58
                if (isset($context["is_last"])) { $_is_last_ = $context["is_last"]; } else { $_is_last_ = null; }
                if ((!$_is_last_)) {
                    echo "&#9660;";
                } else {
                    echo "&#9650;";
                }
                // line 59
                echo "                                </span>
                            </th>
                        </tr>
                    ";
            }
            // line 63
            echo "
                    ";
            // line 64
            if (isset($context["month_stat"])) { $_month_stat_ = $context["month_stat"]; } else { $_month_stat_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable(twig_sort_filter($_month_stat_));
            foreach ($context['_seq'] as $context["country_abbr"] => $context["country_stat"]) {
                // line 65
                echo "                        ";
                if (isset($context["total_display"])) { $_total_display_ = $context["total_display"]; } else { $_total_display_ = null; }
                if (isset($context["country_stat"])) { $_country_stat_ = $context["country_stat"]; } else { $_country_stat_ = null; }
                $context["total_display"] = ($_total_display_ + $this->getAttribute($_country_stat_, 0));
                // line 66
                echo "                        ";
                if (isset($context["total_optin"])) { $_total_optin_ = $context["total_optin"]; } else { $_total_optin_ = null; }
                if (isset($context["country_stat"])) { $_country_stat_ = $context["country_stat"]; } else { $_country_stat_ = null; }
                $context["total_optin"] = ($_total_optin_ + $this->getAttribute($_country_stat_, 1));
                // line 67
                echo "                        ";
                if (isset($context["total_optout"])) { $_total_optout_ = $context["total_optout"]; } else { $_total_optout_ = null; }
                if (isset($context["country_stat"])) { $_country_stat_ = $context["country_stat"]; } else { $_country_stat_ = null; }
                $context["total_optout"] = ($_total_optout_ + $this->getAttribute($_country_stat_, 2));
                // line 68
                echo "
                        ";
                // line 69
                if (isset($context["country_abbr"])) { $_country_abbr_ = $context["country_abbr"]; } else { $_country_abbr_ = null; }
                if (twig_test_empty($_country_abbr_)) {
                    // line 70
                    echo "                            ";
                    $context["country_name"] = "Unknown";
                    // line 71
                    echo "                        ";
                } elseif (($_country_abbr_ == "EU")) {
                    // line 72
                    echo "                            ";
                    $context["country_name"] = "Europe (country unknown)";
                    // line 73
                    echo "                        ";
                } elseif (($_country_abbr_ == "AP")) {
                    // line 74
                    echo "                            ";
                    $context["country_name"] = "Asia/Pacific (country unknown)";
                    // line 75
                    echo "                        ";
                } else {
                    // line 76
                    echo "                            ";
                    if (isset($context["countries"])) { $_countries_ = $context["countries"]; } else { $_countries_ = null; }
                    if (isset($context["country_abbr"])) { $_country_abbr_ = $context["country_abbr"]; } else { $_country_abbr_ = null; }
                    $context["country_name"] = $this->getAttribute($this->getAttribute($_countries_, $_country_abbr_, array(), "array"), "country");
                    // line 77
                    echo "                        ";
                }
                // line 78
                echo "
                        <tr class=\"";
                // line 79
                if (isset($context["is_last"])) { $_is_last_ = $context["is_last"]; } else { $_is_last_ = null; }
                if ((!$_is_last_)) {
                    echo "hide-if-js ";
                }
                echo "row_";
                if (isset($context["month_name"])) { $_month_name_ = $context["month_name"]; } else { $_month_name_ = null; }
                echo twig_escape_filter($this->env, $_month_name_, "html", null, true);
                echo "_details\">
                            <td>";
                // line 80
                if (isset($context["country_name"])) { $_country_name_ = $context["country_name"]; } else { $_country_name_ = null; }
                echo twig_escape_filter($this->env, $_country_name_, "html", null, true);
                echo "</td>
                            <td>";
                // line 81
                if (isset($context["country_stat"])) { $_country_stat_ = $context["country_stat"]; } else { $_country_stat_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_country_stat_, 0), "html", null, true);
                echo "</td>
                            <td>";
                // line 82
                if (isset($context["country_stat"])) { $_country_stat_ = $context["country_stat"]; } else { $_country_stat_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_country_stat_, 1), "html", null, true);
                echo "</td>
                            <td>";
                // line 83
                if (isset($context["country_stat"])) { $_country_stat_ = $context["country_stat"]; } else { $_country_stat_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_country_stat_, 2), "html", null, true);
                echo "</td>
                            <td>";
                // line 84
                if (isset($context["country_stat"])) { $_country_stat_ = $context["country_stat"]; } else { $_country_stat_ = null; }
                echo twig_escape_filter($this->env, ($this->getAttribute($_country_stat_, 0) - ($this->getAttribute($_country_stat_, 1) + $this->getAttribute($_country_stat_, 2))), "html", null, true);
                echo "</td>
                        </tr>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['country_abbr'], $context['country_stat'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 87
            echo "                ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['month_name'], $context['month_stat'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 88
        echo "            </tbody>
            <tfoot>
                <tr>
                    <th scope=\"col\">";
        // line 91
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Total:"), "html", null, true);
        echo "</th>
                    <th scope=\"col\">";
        // line 92
        if (isset($context["total_display"])) { $_total_display_ = $context["total_display"]; } else { $_total_display_ = null; }
        echo twig_escape_filter($this->env, $_total_display_, "html", null, true);
        echo "</th>
                    <th scope=\"col\">";
        // line 93
        if (isset($context["total_optin"])) { $_total_optin_ = $context["total_optin"]; } else { $_total_optin_ = null; }
        echo twig_escape_filter($this->env, $_total_optin_, "html", null, true);
        echo "</th>
                    <th scope=\"col\">";
        // line 94
        if (isset($context["total_optout"])) { $_total_optout_ = $context["total_optout"]; } else { $_total_optout_ = null; }
        echo twig_escape_filter($this->env, $_total_optout_, "html", null, true);
        echo "</th>
                    <th scope=\"col\">";
        // line 95
        if (isset($context["total_display"])) { $_total_display_ = $context["total_display"]; } else { $_total_display_ = null; }
        if (isset($context["total_optin"])) { $_total_optin_ = $context["total_optin"]; } else { $_total_optin_ = null; }
        if (isset($context["total_optout"])) { $_total_optout_ = $context["total_optout"]; } else { $_total_optout_ = null; }
        echo twig_escape_filter($this->env, ($_total_display_ - ($_total_optin_ + $_total_optout_)), "html", null, true);
        echo "</th>
                </tr>
            </tfoot>
        </table>

        <p><em>";
        // line 100
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Note: The statistics do not include visitors using the \"Do Not Track\" browser option, as they cannot be reliably tracked."), "html", null, true);
        echo "</em></p>

    </form>


</div> ";
    }

    public function getTemplateName()
    {
        return "stats.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  340 => 100,  329 => 95,  324 => 94,  319 => 93,  314 => 92,  310 => 91,  305 => 88,  291 => 87,  281 => 84,  276 => 83,  271 => 82,  266 => 81,  261 => 80,  251 => 79,  248 => 78,  245 => 77,  240 => 76,  237 => 75,  234 => 74,  231 => 73,  228 => 72,  225 => 71,  222 => 70,  219 => 69,  216 => 68,  211 => 67,  206 => 66,  201 => 65,  196 => 64,  193 => 63,  187 => 59,  180 => 58,  174 => 56,  162 => 55,  158 => 53,  155 => 52,  152 => 51,  149 => 50,  146 => 49,  141 => 48,  137 => 47,  132 => 46,  114 => 45,  96 => 33,  87 => 29,  78 => 25,  71 => 23,  67 => 21,  48 => 19,  43 => 18,  35 => 14,  32 => 13,  30 => 12,  28 => 11,  26 => 10,  24 => 9,  22 => 8,  19 => 7,);
    }
}
