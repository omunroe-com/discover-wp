<?php

/* settings.html.twig */
class __TwigTemplate_2c89e512fa07b2f7a83d091fd48e2928 extends Twig_Template
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
        echo "    <form method=\"post\" action=\"\" id=\"settings_form\" enctype=\"multipart/form-data\">
        ";
        // line 10
        if (isset($context["nonce"])) { $_nonce_ = $context["nonce"]; } else { $_nonce_ = null; }
        echo $_nonce_;
        echo "

        <h3>";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Geolocation"), "html", null, true);
        echo "</h3>
        <table class=\"form-table\">
            <tbody>
                <tr>
                    <th scope=\"row\">
                        ";
        // line 17
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Geolocation Service"), "html", null, true);
        echo "
                    </th>
                    <td>
                        ";
        // line 20
        if (isset($context["geo_services"])) { $_geo_services_ = $context["geo_services"]; } else { $_geo_services_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_geo_services_);
        foreach ($context['_seq'] as $context["geo_service_name"] => $context["geo_service_value"]) {
            // line 21
            echo "                        <p>
                            <label>
                                <input type=\"radio\" name=\"geo_service\" value=\"";
            // line 23
            if (isset($context["geo_service_name"])) { $_geo_service_name_ = $context["geo_service_name"]; } else { $_geo_service_name_ = null; }
            echo twig_escape_filter($this->env, $_geo_service_name_, "html", null, true);
            echo "\"";
            if (isset($context["geo_service_value"])) { $_geo_service_value_ = $context["geo_service_value"]; } else { $_geo_service_value_ = null; }
            if ($this->getAttribute($_geo_service_value_, "checked")) {
                echo "checked=\"checked\"";
            }
            echo " />
                                ";
            // line 24
            if (isset($context["geo_service_value"])) { $_geo_service_value_ = $context["geo_service_value"]; } else { $_geo_service_value_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_geo_service_value_, "title"), "html", null, true);
            echo "
                            </label>
                            <span class=\"description\">";
            // line 26
            if (isset($context["geo_service_value"])) { $_geo_service_value_ = $context["geo_service_value"]; } else { $_geo_service_value_ = null; }
            echo $this->getAttribute($_geo_service_value_, "desc");
            echo "</span>
                            ";
            // line 27
            if (isset($context["has_geo_data"])) { $_has_geo_data_ = $context["has_geo_data"]; } else { $_has_geo_data_ = null; }
            if (isset($context["geo_service_name"])) { $_geo_service_name_ = $context["geo_service_name"]; } else { $_geo_service_name_ = null; }
            if (($_has_geo_data_ == $_geo_service_name_)) {
                // line 28
                echo "                                <strong>(Detected)</strong>
                            ";
            }
            // line 30
            echo "                        </p>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['geo_service_name'], $context['geo_service_value'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 32
        echo "                    </td>
                </tr>

                <tr>
                    <th scope=\"row\">
                        ";
        // line 37
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Countries"), "html", null, true);
        echo "
                    </th>
                    <td>
                        <p>";
        // line 40
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Only visitors from the following selected countries will have their cookies filtered, unless they have already opted in:"), "html", null, true);
        echo "</p>
                        <ul class=\"multi_checkbox\">
                            ";
        // line 42
        if (isset($context["countries"])) { $_countries_ = $context["countries"]; } else { $_countries_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_countries_);
        foreach ($context['_seq'] as $context["country_key"] => $context["country_val"]) {
            // line 43
            echo "                            <li>
                                <label>
                                    <input type=\"checkbox\" name=\"countries[]\" value=\"";
            // line 45
            if (isset($context["country_key"])) { $_country_key_ = $context["country_key"]; } else { $_country_key_ = null; }
            echo twig_escape_filter($this->env, $_country_key_, "html", null, true);
            echo "\" ";
            if (isset($context["country_val"])) { $_country_val_ = $context["country_val"]; } else { $_country_val_ = null; }
            if ($this->getAttribute($_country_val_, "selected")) {
                echo "checked=\"checked\"";
            }
            echo " />
                                    ";
            // line 46
            if (isset($context["country_val"])) { $_country_val_ = $context["country_val"]; } else { $_country_val_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_country_val_, "country"), "html", null, true);
            echo "
                                </label>
                            </li>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['country_key'], $context['country_val'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 50
        echo "                        </ul>
                    </td>
                </tr>

                <tr>
                    <th scope=\"row\">
                        ";
        // line 56
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Undetermined Countries"), "html", null, true);
        echo "
                    </th>
                    <td>
                        <label>
                            <input type=\"checkbox\" name=\"show_on_unknown_location\" ";
        // line 60
        if (isset($context["show_on_unknown_location"])) { $_show_on_unknown_location_ = $context["show_on_unknown_location"]; } else { $_show_on_unknown_location_ = null; }
        if ($_show_on_unknown_location_) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 61
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Show the alert if the visitor's country could not be determined"), "html", null, true);
        echo "
                            <span class=\"description\">(";
        // line 62
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Recommended"), "html", null, true);
        echo ")</span>
                        </label>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class=\"maxmind_settings\">
            <h3>";
        // line 70
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("MaxMind Settings"), "html", null, true);
        echo "</h3>
            <table class=\"form-table\">
                <tbody>
                    <tr>
                        <th scope=\"row\">
                            ";
        // line 75
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("IPv4 Country Database"), "html", null, true);
        echo "
                        </th>
                        <td>
                            <label>
                                ";
        // line 79
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("File Location:"), "html", null, true);
        echo "
                                <input type=\"text\" name=\"maxmind_db\" id=\"maxmind_db\" value=\"";
        // line 80
        if (isset($context["maxmind_db"])) { $_maxmind_db_ = $context["maxmind_db"]; } else { $_maxmind_db_ = null; }
        echo twig_escape_filter($this->env, $_maxmind_db_, "html", null, true);
        echo "\" />
                            </label>
                            <br />
                            <label>
                                ";
        // line 84
        if (isset($context["maxmind_db"])) { $_maxmind_db_ = $context["maxmind_db"]; } else { $_maxmind_db_ = null; }
        if ($_maxmind_db_) {
            // line 85
            echo "                                    ";
            echo $this->env->getExtension('translate')->transFilter("or <em>replace</em> the existing database:");
            echo "
                                ";
        } else {
            // line 87
            echo "                                    ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("or upload a new database:"), "html", null, true);
            echo "
                                ";
        }
        // line 89
        echo "                                <input type=\"file\" name=\"maxmind_db_file\" id=\"madmind_db_file\" />
                            </label>
                        </td>
                    </tr>

                    <tr>
                        <th scope=\"row\">
                            ";
        // line 96
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("IPv6 Country Database"), "html", null, true);
        echo "
                        </th>
                        <td>
                            <label>
                                ";
        // line 100
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("File Location:"), "html", null, true);
        echo "
                                <input type=\"text\" name=\"maxmind_db_v6\" id=\"maxmind_db_v6\" value=\"";
        // line 101
        if (isset($context["maxmind_db_v6"])) { $_maxmind_db_v6_ = $context["maxmind_db_v6"]; } else { $_maxmind_db_v6_ = null; }
        echo twig_escape_filter($this->env, $_maxmind_db_v6_, "html", null, true);
        echo "\" />
                            </label>
                            <br />
                            <label>
                                ";
        // line 105
        if (isset($context["maxmind_db_v6"])) { $_maxmind_db_v6_ = $context["maxmind_db_v6"]; } else { $_maxmind_db_v6_ = null; }
        if ($_maxmind_db_v6_) {
            // line 106
            echo "                                    ";
            echo $this->env->getExtension('translate')->transFilter("or <em>replace</em> the existing database:");
            echo "
                                ";
        } else {
            // line 108
            echo "                                    ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("or upload a new database:"), "html", null, true);
            echo "
                                ";
        }
        // line 110
        echo "                                <input type=\"file\" name=\"maxmind_db_v6_file\" id=\"madmind_db_v6_file\" />
                            </label>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h3>";
        // line 118
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Alert Settings"), "html", null, true);
        echo "</h3>
        <table class=\"form-table\">
            <tbody>
                <tr>
                    <th scope=\"row\">
                        ";
        // line 123
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Display Alert"), "html", null, true);
        echo "
                    </th>
                    <td>
                        <label>
                            <input type=\"radio\" name=\"alert_show\" value=\"auto\" ";
        // line 127
        if (isset($context["alert_show"])) { $_alert_show_ = $context["alert_show"]; } else { $_alert_show_ = null; }
        if (($_alert_show_ == "auto")) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 128
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Automatic"), "html", null, true);
        echo "
                        </label>
                        <label>
                            <input type=\"radio\" name=\"alert_show\" value=\"manual\" ";
        // line 131
        if (isset($context["alert_show"])) { $_alert_show_ = $context["alert_show"]; } else { $_alert_show_ = null; }
        if (($_alert_show_ == "manual")) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 132
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Manually"), "html", null, true);
        echo "
                        </label>
                        <span class=\"description\">(";
        // line 134
        echo $this->env->getExtension('translate')->transFilter("See <strong>Help</strong> how to display the alert.");
        echo ")</span>
                    </td>
                </tr>

                <tr>
                    <th scope=\"row\">
                        ";
        // line 140
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Implied Consent"), "html", null, true);
        echo "
                    </th>
                    <td>
                        <label>
                            <input type=\"checkbox\" name=\"implied_consent\" ";
        // line 144
        if (isset($context["implied_consent"])) { $_implied_consent_ = $context["implied_consent"]; } else { $_implied_consent_ = null; }
        if ($_implied_consent_) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 145
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("If the visitor ignores the displayed alert, imply the visitor has opted in"), "html", null, true);
        echo "
                        </label>
                    </td>
                </tr>

                <tr>
                    <th scope=\"row\">
                        ";
        // line 152
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Alert Content"), "html", null, true);
        echo "
                    </th>
                    <td>
                        <label>
                            <input type=\"radio\" name=\"alert_content_type\" value=\"default\" ";
        // line 156
        if (isset($context["alert_content_type"])) { $_alert_content_type_ = $context["alert_content_type"]; } else { $_alert_content_type_ = null; }
        if (($_alert_content_type_ == "default")) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 157
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Default"), "html", null, true);
        echo "
                        </label>
                        <label>
                            <input type=\"radio\" name=\"alert_content_type\" value=\"custom\" ";
        // line 160
        if (isset($context["alert_content_type"])) { $_alert_content_type_ = $context["alert_content_type"]; } else { $_alert_content_type_ = null; }
        if (($_alert_content_type_ == "custom")) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 161
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Custom"), "html", null, true);
        echo "
                        </label>

                    </td>
                </tr>

                <tr>
                    <th scope=\"row\">
                        ";
        // line 169
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Alert Styling"), "html", null, true);
        echo "
                    </th>
                    <td>
                        <label>
                            <input type=\"radio\" name=\"alert_style\" value=\"default\" ";
        // line 173
        if (isset($context["alert_style"])) { $_alert_style_ = $context["alert_style"]; } else { $_alert_style_ = null; }
        if (($_alert_style_ == "default")) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 174
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Default"), "html", null, true);
        echo "
                        </label>
                        <label>
                            <input type=\"radio\" name=\"alert_style\" value=\"custom\" ";
        // line 177
        if (isset($context["alert_style"])) { $_alert_style_ = $context["alert_style"]; } else { $_alert_style_ = null; }
        if (($_alert_style_ == "custom")) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 178
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Custom"), "html", null, true);
        echo "
                        </label>
                    </td>
                </tr>

                <tr class=\"alert_custom_style_extra\">
                    <th scope=\"row\">
                        ";
        // line 185
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Custom Alert Style"), "html", null, true);
        echo "
                    </th>
                    <td>
                        <p>";
        // line 188
        echo $this->env->getExtension('translate')->transFilter("Use <abbr title=\"Cascading Style Sheet\">CSS</abbr> to style your alert:");
        echo "</p>
                        <label>
                            <textarea class=\"code\" name=\"alert_custom_style\" id=\"alert_custom_style\">";
        // line 190
        if (isset($context["alert_custom_style"])) { $_alert_custom_style_ = $context["alert_custom_style"]; } else { $_alert_custom_style_ = null; }
        echo twig_escape_filter($this->env, $_alert_custom_style_, "html", null, true);
        echo "</textarea>
                        </label>
                    </td>
                </tr>
            </tbody>
        </table>

        <h3>";
        // line 197
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Content"), "html", null, true);
        echo "</h3>
        <table class=\"form-table alert_normal\">
            <tbody>
                <tr>
                    <th scope=\"row\">
                        ";
        // line 202
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Alert Heading"), "html", null, true);
        echo "
                    </th>
                    <td>
                        <label>
                            <input type=\"text\" name=\"alert_heading\" id=\"alert_heading\" value=\"";
        // line 206
        if (isset($context["alert_heading"])) { $_alert_heading_ = $context["alert_heading"]; } else { $_alert_heading_ = null; }
        echo twig_escape_filter($this->env, $_alert_heading_, "html", null, true);
        echo "\" />
                        </label>
                    </td>
                </tr>

                <tr>
                    <th scope=\"row\">
                        ";
        // line 213
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Alert Text"), "html", null, true);
        echo "
                    </th>
                    <td>
                        <label>
                            <textarea name=\"alert_content\" id=\"alert_content\">";
        // line 217
        if (isset($context["alert_content"])) { $_alert_content_ = $context["alert_content"]; } else { $_alert_content_ = null; }
        echo twig_escape_filter($this->env, $_alert_content_, "html", null, true);
        echo "</textarea>
                        </label>
                    </td>
                </tr>

                <tr>
                    <th scope=\"row\">
                        ";
        // line 224
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Opt-In Button"), "html", null, true);
        echo "
                    </th>
                    <td>
                        <label>
                            <input type=\"text\" name=\"alert_ok\" id=\"alert_ok\" value=\"";
        // line 228
        if (isset($context["alert_ok"])) { $_alert_ok_ = $context["alert_ok"]; } else { $_alert_ok_ = null; }
        echo twig_escape_filter($this->env, $_alert_ok_, "html", null, true);
        echo "\" />
                        </label>
                    </td>
                </tr>

                <tr>
                    <th scope=\"row\">
                        ";
        // line 235
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Opt-Out Button"), "html", null, true);
        echo "
                    </th>
                    <td>
                        <label>
                            <input type=\"text\" name=\"alert_no\" id=\"alert_no\" value=\"";
        // line 239
        if (isset($context["alert_no"])) { $_alert_no_ = $context["alert_no"]; } else { $_alert_no_ = null; }
        echo twig_escape_filter($this->env, $_alert_no_, "html", null, true);
        echo "\" />
                        </label>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class=\"form-table alert_custom\">
            <tbody>
                <tr>
                    <th scope=\"row\">
                        ";
        // line 250
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Custom Alert Code"), "html", null, true);
        echo "
                    </th>
                    <td>
                        <p>";
        // line 253
        echo $this->env->getExtension('translate')->transFilter("Use <abbr title=\"Hypertext Markup Language\">HTML</abbr> to create your own custom alert:");
        echo "</p>
                        <label>
                            <textarea class=\"code\" name=\"alert_custom_content\" id=\"alert_custom_content\">";
        // line 255
        if (isset($context["alert_custom_content"])) { $_alert_custom_content_ = $context["alert_custom_content"]; } else { $_alert_custom_content_ = null; }
        echo twig_escape_filter($this->env, $_alert_custom_content_, "html", null, true);
        echo "</textarea>
                        </label>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class=\"form-table\">
            <tbody>
                <tr>
                    <th scope=\"row\">
                        ";
        // line 266
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("\"Required\" Cookie Text"), "html", null, true);
        echo "
                    </th>
                    <td>
                        <label>
                            <input type=\"text\" name=\"required_text\" id=\"required_text\" value=\"";
        // line 270
        if (isset($context["required_text"])) { $_required_text_ = $context["required_text"]; } else { $_required_text_ = null; }
        echo twig_escape_filter($this->env, $_required_text_, "html", null, true);
        echo "\" />
                        </label>
                        <span class=\"description\">";
        // line 272
        echo $this->env->getExtension('translate')->transFilter("This text is used to indicate required cookies when using the <code>[cookillian cookies]</code> shortcode");
        echo "</span>
                    </td>
                </tr>
            </tbody>
        </table>

        <h3>";
        // line 278
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("JavaScript"), "html", null, true);
        echo "</h3>
        <table class=\"form-table script_header_footer\">
            <tbody>
                <tr>
                    <th></th>
                    <td>
                        <p>";
        // line 284
        echo $this->env->getExtension('translate')->transFilter("The following JavaScript will <em>only</em> be loaded in the page header and/or footer when cookies are permitted. This could be used for scripts that set 3rd party cookies, such as Google Analytics. See <strong>Help</strong> for complex JavaScript use.");
        echo "</p>
                    </td>
                </tr>
                <tr>
                    <th scope=\"row\">
                        ";
        // line 289
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Header"), "html", null, true);
        echo "
                    </th>
                    <td>
                        <label>
                            <textarea class=\"code\" name=\"script_header\" id=\"script_header\">";
        // line 293
        if (isset($context["script_header"])) { $_script_header_ = $context["script_header"]; } else { $_script_header_ = null; }
        echo twig_escape_filter($this->env, $_script_header_, "html", null, true);
        echo "</textarea>
                        </label>
                    </td>
                </tr>

                <tr>
                    <th scope=\"row\">
                        ";
        // line 300
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Footer"), "html", null, true);
        echo "
                    </th>
                    <td>
                        <label>
                            <textarea class=\"code\" name=\"script_footer\" id=\"script_footer\">";
        // line 304
        if (isset($context["script_footer"])) { $_script_footer_ = $context["script_footer"]; } else { $_script_footer_ = null; }
        echo twig_escape_filter($this->env, $_script_footer_, "html", null, true);
        echo "</textarea>
                        </label>
                    </td>
                </tr>

                <tr>
                    <th scope=\"row\">
                        ";
        // line 311
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("JavaScript Tags"), "html", null, true);
        echo "
                    </th>
                    <td>
                        <label>
                            <input type=\"checkbox\" name=\"js_wrap\" ";
        // line 315
        if (isset($context["js_wrap"])) { $_js_wrap_ = $context["js_wrap"]; } else { $_js_wrap_ = null; }
        if ($_js_wrap_) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 316
        echo $this->env->getExtension('translate')->transFilter("Automatically wrap header and footer in <code>&lt;script&gt;</code> and <code>&lt;/script&gt;</code> tags");
        echo "
                        </label>
                    </td>
                </tr>
            </tbody>
        </table>

        <h3>";
        // line 323
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Advanced Options"), "html", null, true);
        echo "</h3>
        <table id=\"advanced_options\" class=\"form-table\">
            <tbody>
                <tr>
                    <th scope=\"row\">
                        ";
        // line 328
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Auto-add Cookies"), "html", null, true);
        echo "
                    </th>
                    <td>
                        <label>
                            <input type=\"checkbox\" name=\"auto_add_cookies\" ";
        // line 332
        if (isset($context["auto_add_cookies"])) { $_auto_add_cookies_ = $context["auto_add_cookies"]; } else { $_auto_add_cookies_ = null; }
        if ($_auto_add_cookies_) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 333
        echo $this->env->getExtension('translate')->transFilter("Automatically add new/unknown cookies to the <em>Cookies</em> list.");
        echo "
                        </label>

                        <label>
                            (";
        // line 337
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Detect at most"), "html", null, true);
        echo "
                            <input type=\"number\" min=\"0\" id=\"max_new_cookies\" name=\"max_new_cookies\" value=\"";
        // line 338
        if (isset($context["max_new_cookies"])) { $_max_new_cookies_ = $context["max_new_cookies"]; } else { $_max_new_cookies_ = null; }
        echo twig_escape_filter($this->env, $_max_new_cookies_, "html", null, true);
        echo "\">
                            ";
        // line 339
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("new cookies"), "html", null, true);
        echo ")
                        </label>
                    </td>
                </tr>

                <tr>
                    <th scope=\"row\">
                        ";
        // line 346
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Root Cookies"), "html", null, true);
        echo "
                    </th>
                    <td>
                        <label>
                            <input type=\"checkbox\" name=\"delete_root_cookies\" ";
        // line 350
        if (isset($context["delete_root_cookies"])) { $_delete_root_cookies_ = $context["delete_root_cookies"]; } else { $_delete_root_cookies_ = null; }
        if ($_delete_root_cookies_) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 351
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Delete root cookies in addition to local cookies"), "html", null, true);
        echo "
                        </label>
                    </td>
                </tr>

                <tr>
                    <th scope=\"row\">
                        ";
        // line 358
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Delete cookies"), "html", null, true);
        echo "
                    </th>
                    <td>
                        <label>
                            <input type=\"radio\" name=\"delete_cookies\" value=\"before_optout\" ";
        // line 362
        if (isset($context["delete_cookies"])) { $_delete_cookies_ = $context["delete_cookies"]; } else { $_delete_cookies_ = null; }
        if (($_delete_cookies_ == "before_optout")) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 363
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Before, or "), "html", null, true);
        echo "
                        </label>
                        <label>
                            <input type=\"radio\" name=\"delete_cookies\" value=\"after_optout\" ";
        // line 366
        if (isset($context["delete_cookies"])) { $_delete_cookies_ = $context["delete_cookies"]; } else { $_delete_cookies_ = null; }
        if (($_delete_cookies_ == "after_optout")) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 367
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("After"), "html", null, true);
        echo "
                        </label>
                        ";
        // line 369
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter(" opt out"), "html", null, true);
        echo "
                    </td>
                </tr>

                <tr>
                    <th scope=\"row\">
                        ";
        // line 375
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Scrub Cookies"), "html", null, true);
        echo "
                    </th>
                    <td>
                        <label>
                            <input type=\"checkbox\" name=\"scrub_cookies\" ";
        // line 379
        if (isset($context["scrub_cookies"])) { $_scrub_cookies_ = $context["scrub_cookies"]; } else { $_scrub_cookies_ = null; }
        if ($_scrub_cookies_) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 380
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Periodically attempt to clean cookies set by JavaScript and other sources"), "html", null, true);
        echo "
                        </label>
                    </td>
                </tr>

                <tr>
                    <th scope=\"row\">
                        ";
        // line 387
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("PHP Sessions"), "html", null, true);
        echo "
                    </th>
                    <td>
                        <label>
                            <input type=\"checkbox\" name=\"php_sessions_required\" ";
        // line 391
        if (isset($context["php_sessions_required"])) { $_php_sessions_required_ = $context["php_sessions_required"]; } else { $_php_sessions_required_ = null; }
        if ($_php_sessions_required_) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 392
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Do not destroy cookie-based PHP sessions"), "html", null, true);
        echo "
                            <span class=\"description\">(";
        // line 393
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Required by some plugins, such as WP e-Commerce"), "html", null, true);
        echo ")</span>
                        </label>
                    </td>
                </tr>

                ";
        // line 398
        if (isset($context["has_caching"])) { $_has_caching_ = $context["has_caching"]; } else { $_has_caching_ = null; }
        if ((!$_has_caching_)) {
            // line 399
            echo "                <tr>
                    <th scope=\"row\">
                        ";
            // line 401
            echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Non-JavaScript Support"), "html", null, true);
            echo "
                    </th>
                    <td>
                        <label>
                            <input type=\"checkbox\" name=\"noscript_tag\" id=\"noscript_tag\" ";
            // line 405
            if (isset($context["noscript_tag"])) { $_noscript_tag_ = $context["noscript_tag"]; } else { $_noscript_tag_ = null; }
            if ($_noscript_tag_) {
                echo "checked=\"checked\"";
            }
            echo " />
                            ";
            // line 406
            echo $this->env->getExtension('translate')->transFilter("Provide a dynamic <code>&lt;noscript&gt;</code> section containing the alert for non-JavaScript browsers");
            echo "
                        </label>
                        <span class=\"description\">(";
            // line 408
            echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Recommended, except when using caching plugins"), "html", null, true);
            echo ")</span>
                    </td>
                </tr>
                ";
        }
        // line 412
        echo "
                <tr>
                    <th scope=\"row\">
                        ";
        // line 415
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Geolocation Cache"), "html", null, true);
        echo "
                    </th>
                    <td>
                        <label>
                            ";
        // line 419
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Keep geolocation lookups in cache for up to"), "html", null, true);
        echo "
                            <input type=\"number\" step=\"60\" id=\"geo_cache_time\" name=\"geo_cache_time\" value=\"";
        // line 420
        if (isset($context["geo_cache_time"])) { $_geo_cache_time_ = $context["geo_cache_time"]; } else { $_geo_cache_time_ = null; }
        echo twig_escape_filter($this->env, $_geo_cache_time_, "html", null, true);
        echo "\"/>
                            ";
        // line 421
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("minutes."), "html", null, true);
        echo "
                        </label>
                        <input type=\"submit\" class=\"button button-action\" name=\"clear-geo-cache\" id=\"clear_geo_cache\" value=\"";
        // line 423
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Clear cache now"), "html", null, true);
        echo "\" />
                    </td>
                </tr>

                <tr>
                    <th scope=\"row\">
                        ";
        // line 429
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Geolocation Backup Service"), "html", null, true);
        echo "
                    </th>
                    <td>
                        <label>
                            <input type=\"checkbox\" name=\"geo_backup_service\" ";
        // line 433
        if (isset($context["geo_backup_service"])) { $_geo_backup_service_ = $context["geo_backup_service"]; } else { $_geo_backup_service_ = null; }
        if ($_geo_backup_service_) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 434
        echo $this->env->getExtension('translate')->transFilter("Use a backup geoloaction service, provided by <a href=\"http://freegeoip.net/\" target=\"_blank\">freegeoip.net</a>, if the default geolocation service has failed.");
        echo "
                        </label>
                    </td>
                </tr>

                <tr>
                    <th scope=\"row\">
                        ";
        // line 441
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Asynchronous AJAX"), "html", null, true);
        echo "
                    </th>
                    <td>
                        <label>
                            <input type=\"checkbox\" name=\"async_ajax\" ";
        // line 445
        if (isset($context["async_ajax"])) { $_async_ajax_ = $context["async_ajax"]; } else { $_async_ajax_ = null; }
        if ($_async_ajax_) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 446
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Initialize using asynchronous AJAX"), "html", null, true);
        echo "
                        </label>
                        <span class=\"description\">(";
        // line 448
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Increases speed, but requires JavaScript variables to be accessed via events"), "html", null, true);
        echo ")</span>
                    </td>
                </tr>

                <tr>
                    <th scope=\"row\">
                        ";
        // line 454
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Debug Mode"), "html", null, true);
        echo "
                    </th>
                    <td>
                        <label>
                            <input type=\"checkbox\" name=\"debug_mode\" ";
        // line 458
        if (isset($context["debug_mode"])) { $_debug_mode_ = $context["debug_mode"]; } else { $_debug_mode_ = null; }
        if ($_debug_mode_) {
            echo "checked=\"checked\"";
        }
        echo " />
                            ";
        // line 459
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Enable debug mode"), "html", null, true);
        echo "
                        </label>
                        <span class=\"description\">(";
        // line 461
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("An alert will always be shown to any logged-in user, and debug details can be seen using the JavaScript console"), "html", null, true);
        echo ")</span>
                    </td>
                </tr>
            </tbody>
        </table>

        ";
        // line 467
        if (isset($context["submit_button"])) { $_submit_button_ = $context["submit_button"]; } else { $_submit_button_ = null; }
        echo $_submit_button_;
        echo "

    </form>

    <div id=\"my_footer\">
        <img src=\"";
        // line 472
        if (isset($context["plugin_base_url"])) { $_plugin_base_url_ = $context["plugin_base_url"]; } else { $_plugin_base_url_ = null; }
        echo twig_escape_filter($this->env, $_plugin_base_url_, "html", null, true);
        echo "resources/images/myatus_logo_white.png\" alt=\"Myatu's\"/><br>
        <span>
            <a href=\"";
        // line 474
        if (isset($context["plugin_home"])) { $_plugin_home_ = $context["plugin_home"]; } else { $_plugin_home_ = null; }
        echo twig_escape_filter($this->env, $_plugin_home_, "html", null, true);
        echo "\" target=\"_blank\">";
        if (isset($context["plugin_name"])) { $_plugin_name_ = $context["plugin_name"]; } else { $_plugin_name_ = null; }
        echo twig_escape_filter($this->env, $_plugin_name_, "html", null, true);
        echo " ";
        if (isset($context["plugin_version"])) { $_plugin_version_ = $context["plugin_version"]; } else { $_plugin_version_ = null; }
        echo twig_escape_filter($this->env, $_plugin_version_, "html", null, true);
        echo "</a> |
            <a href=\"#\" id=\"footer_debug_link\">";
        // line 475
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Debug"), "html", null, true);
        echo "</a> |
            <a href=\"http://wordpress.org/extend/plugins/cookillian/\" target=\"_blank\">";
        // line 476
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Rate It"), "html", null, true);
        echo "</a> |
            <a href=\"http://wordpress.org/support/plugin/cookillian\" target=\"_blank\">";
        // line 477
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Forum"), "html", null, true);
        echo "</a> |
            <a href=\"http://pledgie.com/campaigns/16906\" target=\"_blank\">";
        // line 478
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Donate"), "html", null, true);
        echo "</a>
        </span>
    </div>

    <div id=\"footer_debug\" style=\"display:none;\">
        <table class=\"form-table\">
            <tbody>
                ";
        // line 485
        if (isset($context["debug_info"])) { $_debug_info_ = $context["debug_info"]; } else { $_debug_info_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_debug_info_);
        foreach ($context['_seq'] as $context["debug_name"] => $context["debug_value"]) {
            // line 486
            echo "                <tr>
                    <th scope=\"row\" style=\"font-weight: bold;\">";
            // line 487
            if (isset($context["debug_name"])) { $_debug_name_ = $context["debug_name"]; } else { $_debug_name_ = null; }
            echo twig_escape_filter($this->env, $_debug_name_, "html", null, true);
            echo ":</th>
                    <td>";
            // line 488
            if (isset($context["debug_value"])) { $_debug_value_ = $context["debug_value"]; } else { $_debug_value_ = null; }
            echo twig_escape_filter($this->env, $_debug_value_, "html", null, true);
            echo "</td>
                </tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['debug_name'], $context['debug_value'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 491
        echo "            </tbody>
        </table>
    </div>
</div> ";
    }

    public function getTemplateName()
    {
        return "settings.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1031 => 491,  1021 => 488,  1016 => 487,  1013 => 486,  1008 => 485,  998 => 478,  994 => 477,  990 => 476,  986 => 475,  975 => 474,  969 => 472,  960 => 467,  951 => 461,  946 => 459,  939 => 458,  932 => 454,  923 => 448,  918 => 446,  911 => 445,  904 => 441,  894 => 434,  887 => 433,  880 => 429,  871 => 423,  866 => 421,  861 => 420,  857 => 419,  850 => 415,  845 => 412,  838 => 408,  833 => 406,  826 => 405,  819 => 401,  815 => 399,  812 => 398,  804 => 393,  800 => 392,  793 => 391,  786 => 387,  776 => 380,  769 => 379,  762 => 375,  753 => 369,  748 => 367,  741 => 366,  735 => 363,  728 => 362,  721 => 358,  711 => 351,  704 => 350,  697 => 346,  687 => 339,  682 => 338,  678 => 337,  671 => 333,  664 => 332,  657 => 328,  649 => 323,  639 => 316,  632 => 315,  625 => 311,  614 => 304,  607 => 300,  596 => 293,  589 => 289,  581 => 284,  572 => 278,  563 => 272,  557 => 270,  550 => 266,  535 => 255,  530 => 253,  524 => 250,  509 => 239,  502 => 235,  491 => 228,  484 => 224,  473 => 217,  466 => 213,  455 => 206,  448 => 202,  440 => 197,  429 => 190,  424 => 188,  418 => 185,  408 => 178,  401 => 177,  395 => 174,  388 => 173,  381 => 169,  370 => 161,  363 => 160,  357 => 157,  350 => 156,  343 => 152,  333 => 145,  326 => 144,  319 => 140,  310 => 134,  305 => 132,  298 => 131,  292 => 128,  285 => 127,  278 => 123,  270 => 118,  260 => 110,  254 => 108,  248 => 106,  245 => 105,  237 => 101,  233 => 100,  226 => 96,  217 => 89,  211 => 87,  205 => 85,  202 => 84,  194 => 80,  190 => 79,  183 => 75,  175 => 70,  164 => 62,  160 => 61,  153 => 60,  146 => 56,  138 => 50,  127 => 46,  117 => 45,  113 => 43,  108 => 42,  103 => 40,  97 => 37,  90 => 32,  83 => 30,  79 => 28,  75 => 27,  70 => 26,  64 => 24,  54 => 23,  50 => 21,  45 => 20,  39 => 17,  31 => 12,  25 => 10,  22 => 9,  19 => 7,);
    }
}
