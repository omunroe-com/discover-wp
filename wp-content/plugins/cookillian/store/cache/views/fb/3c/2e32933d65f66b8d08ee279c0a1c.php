<?php

/* cookies.html.twig */
class __TwigTemplate_fb3c2e32933d65f66b8d08ee279c0a1c extends Twig_Template
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
<div style=\"position: relative; width: 100%;\"> ";
        // line 9
        echo "    <form method=\"post\" action=\"";
        if (isset($context["action_url"])) { $_action_url_ = $context["action_url"]; } else { $_action_url_ = null; }
        echo twig_escape_filter($this->env, $_action_url_, "html", null, true);
        echo "\" id=\"cookies_form\">
        ";
        // line 10
        if (isset($context["nonce"])) { $_nonce_ = $context["nonce"]; } else { $_nonce_ = null; }
        echo $_nonce_;
        echo "

        <div class=\"tablenav top hide-if-no-js \">
            <div class=\"alignleft actions\">
                <a href=\"#\" id=\"add_new_cookie_btn\" class=\"button-secondary action\">Add New Cookie</a>
            </div>
            <div class=\"alignright\">
                <span class=\"displaying-num\">";
        // line 17
        if (isset($context["known_cookie_count"])) { $_known_cookie_count_ = $context["known_cookie_count"]; } else { $_known_cookie_count_ = null; }
        echo twig_escape_filter($this->env, $_known_cookie_count_, "html", null, true);
        echo " cookies</span>
            </div>
        </div>

        <table class=\"wp-list-table widefat fixed cookie_table\">
            <thead>
                <tr>
                    ";
        // line 24
        if (isset($context["is_rtl"])) { $_is_rtl_ = $context["is_rtl"]; } else { $_is_rtl_ = null; }
        if ($_is_rtl_) {
            echo "<th scope=\"col\" class=\"col_blank\">&nbsp;</th>";
        }
        // line 25
        echo "                    <th scope=\"col\" class=\"col_name\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Cookie Name"), "html", null, true);
        echo "</th>
                    <th scope=\"col\" class=\"col_desc\">";
        // line 26
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Description"), "html", null, true);
        echo "</th>
                    <th scope=\"col\" class=\"col_group\">";
        // line 27
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Group"), "html", null, true);
        echo "</th>
                    <th scope=\"col\" class=\"col_req\">";
        // line 28
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Required"), "html", null, true);
        echo "</th>
                    <th scope=\"col\" class=\"col_del\">";
        // line 29
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Remove"), "html", null, true);
        echo "</th>
                    ";
        // line 30
        if (isset($context["is_rtl"])) { $_is_rtl_ = $context["is_rtl"]; } else { $_is_rtl_ = null; }
        if ((!$_is_rtl_)) {
            echo "<th scope=\"col\" class=\"col_blank\">&nbsp;</th>";
        }
        // line 31
        echo "                </tr>
            </thead>
            <tbody>
                <td colspan=\"6\" class=\"scroll\">
                    <div>
                        <table class=\"widefat\" style=\"border:0;\">
                            <tbody>
                                ";
        // line 38
        if (isset($context["known_cookies"])) { $_known_cookies_ = $context["known_cookies"]; } else { $_known_cookies_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_known_cookies_);
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
        foreach ($context['_seq'] as $context["cookie_name"] => $context["cookie_value"]) {
            // line 39
            echo "                                <tr id=\"row";
            if (isset($context["loop"])) { $_loop_ = $context["loop"]; } else { $_loop_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_loop_, "index"), "html", null, true);
            echo "\">
                                    <td class=\"col_name\">
                                        <input type=\"text\" value=\"";
            // line 41
            if (isset($context["cookie_name"])) { $_cookie_name_ = $context["cookie_name"]; } else { $_cookie_name_ = null; }
            echo twig_escape_filter($this->env, $_cookie_name_, "html", null, true);
            echo "\" name=\"known_cookies[";
            if (isset($context["cookie_name"])) { $_cookie_name_ = $context["cookie_name"]; } else { $_cookie_name_ = null; }
            echo twig_escape_filter($this->env, $_cookie_name_, "html", null, true);
            echo "][name]\" placeholder=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Enter the cookie name here"), "html", null, true);
            echo "\" />
                                    </td>
                                    <td class=\"col_desc\">
                                        <textarea name=\"known_cookies[";
            // line 44
            if (isset($context["cookie_name"])) { $_cookie_name_ = $context["cookie_name"]; } else { $_cookie_name_ = null; }
            echo twig_escape_filter($this->env, $_cookie_name_, "html", null, true);
            echo "][desc]\">";
            if (isset($context["cookie_value"])) { $_cookie_value_ = $context["cookie_value"]; } else { $_cookie_value_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_cookie_value_, "desc"), "html", null, true);
            echo "</textarea>
                                        <input type=\"hidden\" name=\"known_cookies[";
            // line 45
            if (isset($context["cookie_name"])) { $_cookie_name_ = $context["cookie_name"]; } else { $_cookie_name_ = null; }
            echo twig_escape_filter($this->env, $_cookie_name_, "html", null, true);
            echo "][ua]\" value=\"";
            if (isset($context["cookie_value"])) { $_cookie_value_ = $context["cookie_value"]; } else { $_cookie_value_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_cookie_value_, "ua"), "html", null, true);
            echo "\" />
                                        ";
            // line 46
            if (isset($context["debug_mode"])) { $_debug_mode_ = $context["debug_mode"]; } else { $_debug_mode_ = null; }
            if ($_debug_mode_) {
                // line 47
                echo "                                        <span class=\"description\">";
                if (isset($context["cookie_value"])) { $_cookie_value_ = $context["cookie_value"]; } else { $_cookie_value_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_cookie_value_, "ua"), "html", null, true);
                echo "</span>
                                        ";
            }
            // line 49
            echo "                                    </td>
                                    <td class=\"col_group\">
                                        <div class=\"hide-if-no-js group-dropdown\">
                                            <select>
                                            ";
            // line 53
            if (isset($context["groups"])) { $_groups_ = $context["groups"]; } else { $_groups_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_groups_);
            foreach ($context['_seq'] as $context["_key"] => $context["group"]) {
                // line 54
                echo "                                                <option value=\"";
                if (isset($context["group"])) { $_group_ = $context["group"]; } else { $_group_ = null; }
                echo twig_escape_filter($this->env, $_group_, "html", null, true);
                echo "\" ";
                if (isset($context["group"])) { $_group_ = $context["group"]; } else { $_group_ = null; }
                if (isset($context["cookie_value"])) { $_cookie_value_ = $context["cookie_value"]; } else { $_cookie_value_ = null; }
                if (($_group_ == $this->getAttribute($_cookie_value_, "group"))) {
                    echo "selected=\"selected\"";
                }
                echo ">";
                if (isset($context["group"])) { $_group_ = $context["group"]; } else { $_group_ = null; }
                echo twig_escape_filter($this->env, $_group_, "html", null, true);
                echo "</option>
                                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['group'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 56
            echo "                                            </select>
                                        </div>
                                        <input class=\"hide-if-js\" type=\"text\" value=\"";
            // line 58
            if (isset($context["cookie_value"])) { $_cookie_value_ = $context["cookie_value"]; } else { $_cookie_value_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_cookie_value_, "group"), "html", null, true);
            echo "\" name=\"known_cookies[";
            if (isset($context["cookie_name"])) { $_cookie_name_ = $context["cookie_name"]; } else { $_cookie_name_ = null; }
            echo twig_escape_filter($this->env, $_cookie_name_, "html", null, true);
            echo "][group]\" />
                                        <a href=\"#\" class=\"edit-group hide-if-no-js add\">";
            // line 59
            echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Add new group"), "html", null, true);
            echo "</a>
                                    </td>
                                    <td class=\"col_req\">
                                        <input type=\"checkbox\" name=\"known_cookies[";
            // line 62
            if (isset($context["cookie_name"])) { $_cookie_name_ = $context["cookie_name"]; } else { $_cookie_name_ = null; }
            echo twig_escape_filter($this->env, $_cookie_name_, "html", null, true);
            echo "][required]\" ";
            if (isset($context["cookie_value"])) { $_cookie_value_ = $context["cookie_value"]; } else { $_cookie_value_ = null; }
            if ($this->getAttribute($_cookie_value_, "required")) {
                echo "checked=\"checked\"";
            }
            echo " />
                                    </td>
                                    <td class=\"col_del\">
                                        <input  type=\"checkbox\" class=\"delete-cb hide-if-js\" name=\"known_cookies[";
            // line 65
            if (isset($context["cookie_name"])) { $_cookie_name_ = $context["cookie_name"]; } else { $_cookie_name_ = null; }
            echo twig_escape_filter($this->env, $_cookie_name_, "html", null, true);
            echo "][delete]\" />
                                        <button class=\"delete-btn button-secondary hide-if-no-js\" data-row=\"row";
            // line 66
            if (isset($context["loop"])) { $_loop_ = $context["loop"]; } else { $_loop_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_loop_, "index"), "html", null, true);
            echo "\" title=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Click to remove, save changes to make the removal permanent"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Remove"), "html", null, true);
            echo "</button>
                                    </td>
                                </tr>
                                ";
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
        unset($context['_seq'], $context['_iterated'], $context['cookie_name'], $context['cookie_value'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 70
        echo "
                                <tr id=\"row_clonable\" style=\"display:none\">
                                    <td class=\"col_name\">
                                        <input type=\"text\" value=\"\" name=\"\" placeholder=\"Enter the cookie name here\" />
                                    </td>
                                    <td class=\"col_desc\">
                                        <textarea name=\"\"></textarea>
                                    </td>
                                    <td class=\"col_group\">
                                        <div class=\"hide-if-no-js group-dropdown\">
                                            <select>
                                            ";
        // line 81
        if (isset($context["groups"])) { $_groups_ = $context["groups"]; } else { $_groups_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_groups_);
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
        foreach ($context['_seq'] as $context["_key"] => $context["group"]) {
            // line 82
            echo "                                                <option value=\"";
            if (isset($context["group"])) { $_group_ = $context["group"]; } else { $_group_ = null; }
            echo twig_escape_filter($this->env, $_group_, "html", null, true);
            echo "\" ";
            if (isset($context["loop"])) { $_loop_ = $context["loop"]; } else { $_loop_ = null; }
            if (($this->getAttribute($_loop_, "index") == 1)) {
                echo "selected=\"selected\"";
            }
            echo ">";
            if (isset($context["group"])) { $_group_ = $context["group"]; } else { $_group_ = null; }
            echo twig_escape_filter($this->env, $_group_, "html", null, true);
            echo "</option>
                                            ";
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 84
        echo "                                            </select>
                                        </div>
                                        <input class=\"hide-if-js\" type=\"text\" value=\"";
        // line 86
        if (isset($context["groups"])) { $_groups_ = $context["groups"]; } else { $_groups_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_groups_, 0, array(), "array"), "html", null, true);
        echo "\" name=\"\" />
                                        <a href=\"#\" class=\"edit-group hide-if-no-js add\">";
        // line 87
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Add new group"), "html", null, true);
        echo "</a>
                                    </td>
                                    <td class=\"col_req\">
                                        <input type=\"checkbox\" name=\"\" />
                                    </td>
                                    <td class=\"col_del\">
                                        <button class=\"delete-btn button-secondary hide-if-no-js\" data-row=\"\" title=\"";
        // line 93
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Click to remove"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Remove"), "html", null, true);
        echo "</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tbody>
        </table>

        <div class=\"alignleft actions\" style=\"margin-top: 30px;\">
            ";
        // line 104
        if (isset($context["submit_button"])) { $_submit_button_ = $context["submit_button"]; } else { $_submit_button_ = null; }
        echo $_submit_button_;
        echo " <a href=\"";
        if (isset($context["action_url"])) { $_action_url_ = $context["action_url"]; } else { $_action_url_ = null; }
        echo twig_escape_filter($this->env, $_action_url_, "html", null, true);
        echo "\" class=\"button-secondary action\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Cancel Changes"), "html", null, true);
        echo "</a>
        </div>

    </form>
</div> ";
    }

    public function getTemplateName()
    {
        return "cookies.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  332 => 104,  316 => 93,  307 => 87,  302 => 86,  298 => 84,  272 => 82,  254 => 81,  241 => 70,  218 => 66,  213 => 65,  201 => 62,  195 => 59,  187 => 58,  183 => 56,  164 => 54,  159 => 53,  153 => 49,  146 => 47,  143 => 46,  135 => 45,  127 => 44,  115 => 41,  108 => 39,  90 => 38,  81 => 31,  76 => 30,  72 => 29,  68 => 28,  64 => 27,  60 => 26,  55 => 25,  50 => 24,  39 => 17,  28 => 10,  22 => 9,  19 => 7,);
    }
}
