<?php

/* base.html.twig */
class __TwigTemplate_f70a6b37f33b86ea6b6cdf5ebc42d8bfe5131cf6d2b63ee3a4f85ed872a3c1e4 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'meta' => array($this, 'block_meta'),
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'header' => array($this, 'block_header'),
            'banner' => array($this, 'block_banner'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<!--[if lt IE 7 ]><html class=\"ie ie6\" lang=\"en\"> <![endif]-->
<!--[if IE 7 ]><html class=\"ie ie7\" lang=\"en\"> <![endif]-->
<!--[if IE 8 ]><html class=\"ie ie8\" lang=\"en\"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang=\"en\"> <!--<![endif]-->

<head>

    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, maximum-scale=1\">
     <meta name=\"author\" content=\"justrip.in\">
    <meta name=\"google-site-verification\" content=\"t9UottiGdtAaU1gGattiHZZNJOK3BF8qZ-qRfCqyYC0\" />
    ";
        // line 14
        $this->displayBlock('meta', $context, $blocks);
        // line 18
        echo "    <title>";
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
    <!-- Favicons -->
    <link rel=\"shortcut icon\" href=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/favicon.ico"), "html", null, true);
        echo "\" type=\"image/x-icon\" />
    <link rel=\"apple-touch-icon\" href=\"";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/apple-touch-icon.png"), "html", null, true);
        echo "\" />
    <link rel=\"apple-touch-icon\" sizes=\"72x72\" href=\"";
        // line 22
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/apple-touch-icon-72x72.png"), "html", null, true);
        echo "\" />
    <link rel=\"apple-touch-icon\" sizes=\"114x114\" href=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/apple-touch-icon-114x114.png"), "html", null, true);
        echo "\" />
    
    \t<link href=\"";
        // line 25
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/chosen.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" media=\"screen\">
\t<link href=\"";
        // line 26
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/prism.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" media=\"screen\">

    <!-- Bootstrap -->
    <link href=\"";
        // line 29
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/bootstrap.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">
    <link rel=\"stylesheet\" href=\"";
        // line 30
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/font-awesome.css"), "html", null, true);
        echo "\">
    <!-- Default Styles -->
    <link href=\"";
        // line 32
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/style.css?version=1.15"), "html", null, true);
        echo "\" rel=\"stylesheet\">
    <!-- Custom Styles -->
    <link href=\"";
        // line 34
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/custom.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">
\t<link type=\"text/css\" href=\"";
        // line 35
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/jquery.simple-dtpicker.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" />
\t<link type=\"text/css\" href=\"";
        // line 36
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/contact-buttons.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" />
\t
\t
    <!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
    ";
        // line 48
        echo "    
    ";
        // line 49
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 50
        echo "
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src=\"https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js\"></script>
      <script src=\"https://oss.maxcdn.com/respond/1.4.2/respond.min.js\"></script>
    <![endif]-->
    

   <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new
Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-68699839-1', 'auto');
  ga('send', 'pageview');

  

  
</script>

</head>
<body>

";
        // line 81
        echo "
<div id=\"wrapper\">
   
    <div class=\"topbar\">
        <div class=\"container\">
             <div class=\"pull-right hidden-sm hidden-xs\">
                <ul class=\"topbar-social list-inline\">
                     <li><a href=\"https://www.facebook.com/JustTripIndia\"><i class=\"icon-facebook\"></i></a></li>
                    <li><a href=\"https://twitter.com/JustTripIndia\"><i class=\"icon-twitter\"></i></a></li>                
                    <li><a href=\"#\"><i class=\"fa fa-youtube\"></i></a></li>                   
                </ul><!-- end list-style -->
            </div><!-- end right -->
            <div class=\"pull-right\">
                <ul class=\"topbar-drops list-inline\">
                    <a href=\"mailto:info@justtrip.in\"><i class=\"fa fa-envelope\" aria-hidden=\"true\"></i> info@justtrip.in</a>
                    <li><i class=\"icon-telephone5\"></i> +91-9663133008</li>
                </ul><!-- end list-style -->
            </div><!-- end left -->
           
        </div><!-- end container -->
    </div><!-- end topbar -->

    <header class=\"header  ";
        // line 103
        $this->displayBlock('header', $context, $blocks);
        echo "\">
        <div class=\"menu-container\">
            <div class=\"container\">
                <div class=\"menu-wrapper\">
                    <nav id=\"navigation\" class=\"navbar\" role=\"navigation\">
                        <div class=\"navbar-inner\">
                            <div class=\"navbar-header\">
                                <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-collapse\">
                                    <span class=\"sr-only\">Toggle navigation</span>
                                    <i class=\"icon-menu27\"></i>
                                </button>
\t\t\t\t\t\t\t\t";
        // line 114
        if ($this->env->getExtension('security')->isGranted("ROLE_ADMIN")) {
            // line 115
            echo "\t\t\t\t\t\t\t\t\t<a id=\"brand\" class=\"clearfix navbar-brand\" href=\"";
            echo $this->env->getExtension('routing')->getPath("trip_site_management_billing_list");
            echo "\">
                                    <img src=\"";
            // line 116
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/Juttrip-new-logoo.png"), "html", null, true);
            echo "\" alt=\"Trips\"></a>
\t\t\t\t\t\t\t\t";
        } else {
            // line 118
            echo "                                <a id=\"brand\" class=\"clearfix navbar-brand\" href=\"";
            echo $this->env->getExtension('routing')->getPath("trip_site_management_homepage");
            echo "\">
                                    <img src=\"";
            // line 119
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/Juttrip-new-logoo.png"), "html", null, true);
            echo "\" alt=\"Trips\"></a>
\t\t\t\t\t\t\t\t";
        }
        // line 121
        echo "                            </div><!-- end navbar-header -->
                            <div id=\"navbar-collapse\" class=\"navbar-right navbar-collapse collapse clearfix\">
                                <ul class=\"nav navbar-nav yamm\">
\t\t\t\t\t\t\t\t\t ";
        // line 124
        if (($this->env->getExtension('security')->isGranted("ROLE_ADMIN") === false)) {
            // line 125
            echo "                                    <li class=\"dropdown\">
                                        <a href=\"";
            // line 126
            echo $this->env->getExtension('routing')->getPath("trip_site_management_homepage");
            echo "\">Cars On Rent</a>
                                    </li><!-- end yamm-fw -->
                                   <!-- <li><a href=\"";
            // line 128
            echo $this->env->getExtension('routing')->getPath("trip_site_management_homepage_hotels");
            echo "\">Hotels</a></li>-->
                                    
                                    \t<li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Packages</a>
                                        <ul class=\"dropdown-menu\" role=\"menu\">
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"";
            // line 132
            echo $this->env->getExtension('routing')->getPath("trip_site_management_homepage_packages");
            echo "\" >One Day Packages</a></li>
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"";
            // line 133
            echo $this->env->getExtension('routing')->getPath("trip_site_management_homepage_twoday_packages");
            echo "\" >Two Day Packages</a></li>
\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"";
            // line 134
            echo $this->env->getExtension('routing')->getPath("trip_booking_engine_customPackage");
            echo "\">Custom Package</a></li>
\t\t\t\t\t\t\t\t\t\t\t";
            // line 135
            if ($this->env->getExtension('security')->isGranted("ROLE_SUPER_ADMIN")) {
                // line 136
                echo "                                            ";
                // line 137
                echo "                                             ";
                // line 138
                echo "                                             ";
                // line 139
                echo "                                              <li><a href=\"";
                echo $this->env->getExtension('routing')->getPath("trip_site_management_package_list");
                echo "\">Package List</a></li>
\t\t\t\t\t\t\t\t\t\t\t  <li><a href=\"";
                // line 140
                echo $this->env->getExtension('routing')->getPath("trip_site_management_multipackage_list");
                echo "\">Multi Package List</a></li>
\t\t\t\t\t\t\t\t\t\t\t  <li><a href=\"";
                // line 141
                echo $this->env->getExtension('routing')->getPath("trip_site_management_hotels_list");
                echo "\">Hotels List</a></li>
\t\t\t\t\t\t\t\t\t\t\t  <li><a href=\"";
                // line 142
                echo $this->env->getExtension('routing')->getPath("trip_site_management_bikes_list");
                echo "\">Bikes List</a></li>
\t\t\t\t\t\t\t\t\t\t\t  <li><a href=\"";
                // line 143
                echo $this->env->getExtension('routing')->getPath("trip_site_management_add_multipackage");
                echo "\">Add Multi Packages</a></li>
\t\t\t\t\t\t\t\t\t\t\t  <li><a href=\"";
                // line 144
                echo $this->env->getExtension('routing')->getPath("trip_site_management_add_packagecat");
                echo "\">Add Package Cat</a></li>
\t\t\t\t\t\t\t\t\t\t\t  <li><a href=\"";
                // line 145
                echo $this->env->getExtension('routing')->getPath("trip_site_management_add_twoday_packagelocations");
                echo "\">Add PackageDetails</a></li>

\t\t\t\t\t\t\t\t\t\t\t  <li><a href=\"";
                // line 147
                echo $this->env->getExtension('routing')->getPath("trip_booking_engine_vendor_list");
                echo "\">Vendor List</a></li>

\t\t\t\t\t\t\t\t\t\t\t  <li><a href=\"";
                // line 149
                echo $this->env->getExtension('routing')->getPath("trip_site_management_add_bike");
                echo "\">Add bike</a></li>

                                             ";
            }
            // line 151
            echo "  
                                            
                                        </ul>
                                    </li>            
\t\t\t\t\t\t\t\t\t\t<li><a href=\"";
            // line 155
            echo $this->env->getExtension('routing')->getPath("trip_site_management_bikes_on_rent");
            echo "\">Bikes On Rent</a></li>
                                   
\t\t\t\t\t\t\t\t    ";
        }
        // line 158
        echo "\t\t\t\t\t\t\t\t    ";
        if ($this->env->getExtension('security')->isGranted("ROLE_ADMIN")) {
            // line 159
            echo "\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t <li><a href=\"";
            // line 160
            echo $this->env->getExtension('routing')->getPath("trip_booking_engine_testcustomPackage");
            echo "\">Add  Accounts</a></li>
                                     <li><a href=\"";
            // line 161
            echo $this->env->getExtension('routing')->getPath("trip_site_management_billing_list");
            echo "\">Accounts List</a></li>
\t\t\t\t\t\t\t\t\t ";
            // line 162
            if ($this->env->getExtension('security')->isGranted("IS_AUTHENTICATED_FULLY")) {
                echo "  
                                                <li><a href=\"";
                // line 163
                echo $this->env->getExtension('routing')->getPath("fos_user_security_logout");
                echo "\"><b>";
                echo $this->env->getExtension('translator')->getTranslator()->trans("Logout", array(), "messages");
                echo "</b></a> </li>
\t\t\t\t\t\t\t\t\t\t";
            }
            // line 165
            echo "\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t ";
        }
        // line 167
        echo "                                   
                                    ";
        // line 168
        if ($this->env->getExtension('security')->isGranted("ROLE_SUPER_ADMIN")) {
            // line 169
            echo "                                    <li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Admin</a>
                                        <ul class=\"dropdown-menu\" role=\"menu\">
                                            <li><a href=\"";
            // line 171
            echo $this->env->getExtension('routing')->getPath("trip_site_management_add_locations");
            echo "\">Add Locations</a></li>
                                            <li><a href=\"";
            // line 172
            echo $this->env->getExtension('routing')->getPath("trip_site_management_add_vehicle");
            echo "\">Add Vehicles</a></li>
                                            <li><a href=\"";
            // line 173
            echo $this->env->getExtension('routing')->getPath("trip_site_management_add_services");
            echo "\">Add Services</a></li>
                                             <li><a href=\"";
            // line 174
            echo $this->env->getExtension('routing')->getPath("trip_sitemanagementbundle_add_hotel");
            echo "\">Add Hotel</a></li> 
                                             <li><a href=\"";
            // line 175
            echo $this->env->getExtension('routing')->getPath("trip_hotel_add_coupon_code");
            echo "\">Add Coupon Code</a></li>                                           
\t\t\t\t\t\t\t\t\t\t\t <li><a href=\"";
            // line 176
            echo $this->env->getExtension('routing')->getPath("trip_site_management_booking_update_price");
            echo "\">Update Price</a></li>
\t\t\t\t\t\t\t\t\t\t\t <li><a href=\"";
            // line 177
            echo $this->env->getExtension('routing')->getPath("trip_booking_engine_testcustomPackage");
            echo "\">Justtrip Accounts</a></li>
                                            <li><a href=\"";
            // line 178
            echo $this->env->getExtension('routing')->getPath("trip_site_management_billing_list");
            echo "\">Justtrip Accounts List</a></li>
                                            
                                        </ul>
                                    </li>
                                     <li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Dashbord</a>
                                        <ul class=\"dropdown-menu\" role=\"menu\">
                                            <li><a href=\"";
            // line 184
            echo $this->env->getExtension('routing')->getPath("trip_site_management_booking_search");
            echo "\">Bookings</a></li>
                                            <li><a href=\"";
            // line 185
            echo $this->env->getExtension('routing')->getPath("trip_site_management_users");
            echo "\">Users</a></li>
                                            <li><a href=\"";
            // line 186
            echo $this->env->getExtension('routing')->getPath("trip_site_management_contactList");
            echo "\">Contact List</a></li>
                                            
                                        </ul>
                                    </li>
                                    ";
        }
        // line 191
        echo "\t\t\t\t\t\t\t\t\t ";
        if (($this->env->getExtension('security')->isGranted("ROLE_ADMIN") === false)) {
            // line 192
            echo "                                     <li  class=\"dropdown\"><a href=\"";
            echo $this->env->getExtension('routing')->getPath("trip_security_sign_up");
            echo "\">My Account</a>
                                        <ul class=\"dropdown-menu\" role=\"menu\">
                                            ";
            // line 194
            if ($this->env->getExtension('security')->isGranted("IS_AUTHENTICATED_FULLY")) {
                echo "  
                                                <li><a href=\"";
                // line 195
                echo $this->env->getExtension('routing')->getPath("fos_user_security_logout");
                echo "\"><b>";
                echo $this->env->getExtension('translator')->getTranslator()->trans("Logout", array(), "messages");
                echo "</b></a> </li>
\t\t\t\t\t\t\t\t\t\t    ";
            } else {
                // line 197
                echo "                                                <li><a href=\"";
                echo $this->env->getExtension('routing')->getPath("trip_security_sign_up");
                echo "\">Login</a></li>
                                                <li><a href=\"";
                // line 198
                echo $this->env->getExtension('routing')->getPath("trip_security_sign_up");
                echo "\">Signup</a></li>
                                            ";
            }
            // line 200
            echo "                                             <li><a href=\"";
            echo $this->env->getExtension('routing')->getPath("trip_site_management_homepage_deals");
            echo "\">Hot Deals</a></li>
                                             <li><a href=\"";
            // line 201
            echo $this->env->getExtension('routing')->getPath("trip_site_management_my_bookings");
            echo "\">My Bookings</a></li>
                                             <li><a href=\"";
            // line 202
            echo $this->env->getExtension('routing')->getPath("trip_site_management_cancel");
            echo "\">Cancel Booking</a></li>
                                             <li><a href=\"";
            // line 203
            echo $this->env->getExtension('routing')->getPath("trip_booking_engine_test_vendor_login");
            echo "\">Parter With Us</a></li>
                                            
                                            
                                        </ul>                                    
                                    </li>
                                    <li><a href=\"";
            // line 208
            echo $this->env->getExtension('routing')->getPath("trip_site_management_contact");
            echo "\">Contact</a></li>
                                    <li class=\"sidebar-dropper\"><a data-toggle=\"sidebar\" data-target=\".sidebar-right\" class=\"noborder\" href=\"#\"><i class=\"icon-menu27\"></i></a></li>
\t\t\t\t\t\t\t\t\t ";
        }
        // line 211
        echo "                                </ul><!-- end navbar-right -->
                            </div><!-- end navbar-callopse -->
                        </div><!-- end navbar-inner -->
                    </nav><!-- end navigation -->
                </div><!-- menu wrapper -->
            </div><!-- end container -->
        </div><!-- end menu-container -->
        <div class=\"sidebar-menu-container\">
            <div class=\"col-sm-2 col-md-2 sidebar sidebar-right sidebar-animate\">
                <a data-toggle=\"sidebar\" data-target=\".sidebar-right\" class=\"text-right\" href=\"#\"><i class=\"icon-wrong6-1\"></i></a>
                <img src=\"";
        // line 221
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/justtrip-logo.png"), "html", null, true);
        echo "\" alt=\"Trips\">
                <ul class=\"nav navbar-stacked\">
                    <li><a href=\"";
        // line 223
        echo $this->env->getExtension('routing')->getPath("trip_site_management_homepage");
        echo "\">Home</a></li>
                    <li><a href=\"";
        // line 224
        echo $this->env->getExtension('routing')->getPath("trip_site_management_about");
        echo "\">About</a></li>
                    <li><a href=\"";
        // line 225
        echo $this->env->getExtension('routing')->getPath("trip_site_management_contact");
        echo "\">Contact</a></li>
                    <li><a href=\"";
        // line 226
        echo $this->env->getExtension('routing')->getPath("trip_site_management_faq");
        echo "\">FAQ</a></li>
                    <li><a href=\"";
        // line 227
        echo $this->env->getExtension('routing')->getPath("trip_site_management_terms");
        echo "\">Privacy policy</a></li>
                    <li><a href=\"http://blog.justtrip.in\">Blog</a></li>
                </ul>
            </div>
        </div><!-- end sidebar menu -->
    </header><!-- end header --> 
    
    ";
        // line 234
        $this->displayBlock('banner', $context, $blocks);
        // line 235
        echo "
         ";
        // line 236
        $this->displayBlock('body', $context, $blocks);
        // line 237
        echo "    <footer class=\"footer clearfix\">
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"col-md-3 text-center\">
                    <div class=\"flogo\">
                        <img src=\"";
        // line 242
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/Footerlogo.png"), "html", null, true);
        echo "\" alt=\"\">
                    </div><!-- end logo -->
                        <div class=\"textwidget\">
                              <p>©2017 Aairah Technologies Pvt. Ltd.</p>
                        </div><!-- end textwidget -->
                </div><!-- end col -->
                <div class=\"col-md-3\">
                    <div class=\"widget\">
                        <div class=\"widget-title\">
                            <h3>Explore</h3>
                        </div><!-- end title -->
                        <div class=\"textwidget\">
                             <p><a href=\"http://blog.justtrip.in\">Blog</a></p>
                             <p><a href=\"";
        // line 255
        echo $this->env->getExtension('routing')->getPath("trip_site_management_homepage_deals");
        echo "\">Offeres</a></p>
                        </div><!-- end textwidget -->
                    </div><!-- end widget -->
                </div><!-- end col -->
               \t<div class=\"col-md-3\">
                    <div class=\"widget\">
                        <div class=\"widget-title\">
                            <h3>Company</h3>
                        </div><!-- end title -->
                        <div class=\"textwidget\">
                              <p><a href=\"";
        // line 265
        echo $this->env->getExtension('routing')->getPath("trip_site_management_contact");
        echo "\">Contact US</a></p>
                             <p><a href=\"";
        // line 266
        echo $this->env->getExtension('routing')->getPath("trip_site_management_about");
        echo "\">About US</a></p>
                             <p><a href=\"";
        // line 267
        echo $this->env->getExtension('routing')->getPath("trip_site_management_faq");
        echo "\">FAQ</a></p>
                             <p><a href=\"";
        // line 268
        echo $this->env->getExtension('routing')->getPath("trip_site_management_terms");
        echo "\">Privacy Policy</a></p>                     
                        </div><!-- end textwidget -->
                    </div><!-- end widget -->
                </div><!-- end col -->
               \t<div class=\"col-md-3\">
                    <div class=\"widget\">
                        <div class=\"widget-title\">
                            <h3>Follow</h3>
                        </div><!-- end title -->
                        <div class=\"textwidget\">
                              <div class=\"social-footer text-center\">
                                 <a href=\"https://www.facebook.com/JustTripIndia\" title=\"Facebook\"><i class=\"icon-facebook\"></i></a>
                                <a href=\"https://twitter.com/JustTripIndia\" title=\"Twitter\"><i class=\"icon-twitter\"></i></a>
                                 <a href=\"#\" title=\"youtube\"><i class=\"fa fa-youtube\"></i></a>
                            </div><!-- end social-footer -->                     
                        </div><!-- end textwidget -->
                    </div><!-- end widget -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </footer><!-- end copyrights -->
<div class=\"footer-tabs clearfix\">
        <div class=\"container\">
            <div class=\"row\">
                    <div class=\"row\">
                        <div class=\"col-md-12\">
                            ";
        // line 294
        echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('http_kernel')->controller("TripBookingEngineBundle:Booking:footer"));
        echo "
                        </div>
                    </div>
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end copyrights -->
<div class=\"payment-sprite clearfix\">
        <div class=\"container\">
        <hr class=\"hr-nomargin\" style=\"border-color: #666;\">
            <div class=\"row\">
               <div class=\"secure\"> <ul class=\"list-unstyled\"> ";
        // line 304
        echo " <li> <span class=\"footer-seperator\">Verisign Secure<i class=\"sprite-footer ico-verisign-secure\"></i></span> </li> </ul> <ul class=\"list-unstyled\"> <li> <span>We accept</span> <i title=\"Visa-secure\" class=\"sprite-footer ico-visa-secure\"></i> </li> <li> <i class=\"Master-card\"></i> </li> <li> <i title=\"American-Express\" class=\"sprite-footer ico-american-secure\"></i> </li> <li> <i title=\"Diner-club\" class=\"sprite-footer ico-diner-club\"></i> </li> <li> <i title=\"Rupay\" class=\"sprite-footer ico-rupay\"></i> </li> ";
        echo " <li> <i title=\"Net-Banking\" class=\"sprite-footer ico-net-secure\"></i> </li> </ul> </div>
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end copyrights -->
    <div class=\"copyrights clearfix\">
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"col-md-6 text-left\">
                    <p>Copyright © Justtrip.in All Rights Reserved</p>
                </div><!-- end col -->

                <div class=\"col-md-6 text-right\">
                   ";
        // line 321
        echo "                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end copyrights -->
</div><!-- end wrapper -->

    <!-- Template core JavaScript's
    ================================================== -->
   
    <script src=\"";
        // line 330
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/jquery.min.js"), "html", null, true);
        echo "\"></script>
    <script defer=\"defer\" src=\"";
        // line 331
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/jquery-ui.js"), "html", null, true);
        echo "\"></script>
    <script defer=\"defer\" src=\"";
        // line 332
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/bootstrap.min.js"), "html", null, true);
        echo "\"></script>
    <script defer=\"defer\" src=\"";
        // line 333
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/retina.js"), "html", null, true);
        echo "\"></script>
    <script defer=\"defer\" src=\"";
        // line 334
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/sidebar.js"), "html", null, true);
        echo "\"></script>
    <script defer=\"defer\" src=\"";
        // line 335
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/circle.js"), "html", null, true);
        echo "\"></script>
    <script defer=\"defer\" src=\"";
        // line 336
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/progress.js"), "html", null, true);
        echo "\"></script>
    <script defer=\"defer\" src=\"";
        // line 337
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/jquery.prettyPhoto.js"), "html", null, true);
        echo "\"></script>
    <script defer=\"defer\" src=\"";
        // line 338
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/contact.js"), "html", null, true);
        echo "\"></script>
    <script defer=\"defer\" src=\"";
        // line 339
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/parallax.js"), "html", null, true);
        echo "\"></script>
   
    <script defer=\"defer\" src=\"";
        // line 341
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/owl.carousel.js"), "html", null, true);
        echo "\"></script>
    <script defer=\"defer\" src=\"";
        // line 342
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/bootstrap-select.js"), "html", null, true);
        echo "\"></script>
\t<!-- Date Picker -->
\t<script type=\"text/javascript\" src=\"";
        // line 344
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/jquery.simple-dtpicker.js"), "html", null, true);
        echo "\"></script>
\t<script type=\"text/javascript\" src=\"";
        // line 345
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/jquery.contact-buttons.js"), "html", null, true);
        echo "\"></script>
\t<script type=\"text/javascript\" src=\"";
        // line 346
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/demo.js"), "html", null, true);
        echo "\"></script>
   
    <!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
    
    
    <script defer=\"defer\" src=\"";
        // line 351
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/chosen.jquery.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
<script defer=\"defer\" src=\"";
        // line 352
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/prism.js"), "html", null, true);
        echo "\" type=\"text/javascript\" charset=\"utf-8\"></script>
    
      <script defer=\"defer\" src=\"";
        // line 354
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/custom.js?version=1.07"), "html", null, true);
        echo "\"></script>
    
    
        ";
        // line 357
        $this->displayBlock('javascripts', $context, $blocks);
        // line 358
        echo "
</body>
</html>";
    }

    // line 14
    public function block_meta($context, array $blocks = array())
    {
        // line 15
        echo "    <meta name=\"keywords\" content=\"cabs in tirupati, tirupati cabs, Cab Service in Tirupati, Cab Services in Tirupati, Taxi in Tirupati, Taxi service in Tirupati, Tirupati Taxi, tirupati car rental\">
    <meta name=\"description\" content=\"India's smart online taxi, hotel, tours and travel package booking services across pilgrim places in india. Just Trip wants to be a soul and spiritual partner to the pilgrims around the world\">  
";
    }

    // line 18
    public function block_title($context, array $blocks = array())
    {
        echo "Cab, Hotels, Tour Packages across Pilgrim Places in India | Justtrip.in";
    }

    // line 49
    public function block_stylesheets($context, array $blocks = array())
    {
    }

    // line 103
    public function block_header($context, array $blocks = array())
    {
        echo " ";
    }

    // line 234
    public function block_banner($context, array $blocks = array())
    {
        echo " ";
    }

    // line 236
    public function block_body($context, array $blocks = array())
    {
    }

    // line 357
    public function block_javascripts($context, array $blocks = array())
    {
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
        return array (  733 => 357,  728 => 236,  722 => 234,  716 => 103,  711 => 49,  705 => 18,  699 => 15,  696 => 14,  690 => 358,  688 => 357,  682 => 354,  677 => 352,  673 => 351,  665 => 346,  661 => 345,  657 => 344,  652 => 342,  648 => 341,  643 => 339,  639 => 338,  635 => 337,  631 => 336,  627 => 335,  623 => 334,  619 => 333,  615 => 332,  611 => 331,  607 => 330,  596 => 321,  581 => 304,  568 => 294,  539 => 268,  535 => 267,  531 => 266,  527 => 265,  514 => 255,  498 => 242,  491 => 237,  489 => 236,  486 => 235,  484 => 234,  474 => 227,  470 => 226,  466 => 225,  462 => 224,  458 => 223,  453 => 221,  441 => 211,  435 => 208,  427 => 203,  423 => 202,  419 => 201,  414 => 200,  409 => 198,  404 => 197,  397 => 195,  393 => 194,  387 => 192,  384 => 191,  376 => 186,  372 => 185,  368 => 184,  359 => 178,  355 => 177,  351 => 176,  347 => 175,  343 => 174,  339 => 173,  335 => 172,  331 => 171,  327 => 169,  325 => 168,  322 => 167,  318 => 165,  311 => 163,  307 => 162,  303 => 161,  299 => 160,  296 => 159,  293 => 158,  287 => 155,  281 => 151,  275 => 149,  270 => 147,  265 => 145,  261 => 144,  257 => 143,  253 => 142,  249 => 141,  245 => 140,  240 => 139,  238 => 138,  236 => 137,  234 => 136,  232 => 135,  228 => 134,  224 => 133,  220 => 132,  213 => 128,  208 => 126,  205 => 125,  203 => 124,  198 => 121,  193 => 119,  188 => 118,  183 => 116,  178 => 115,  176 => 114,  162 => 103,  138 => 81,  110 => 50,  108 => 49,  105 => 48,  98 => 36,  94 => 35,  90 => 34,  85 => 32,  80 => 30,  76 => 29,  70 => 26,  66 => 25,  61 => 23,  57 => 22,  53 => 21,  49 => 20,  43 => 18,  41 => 14,  26 => 1,);
    }
}
