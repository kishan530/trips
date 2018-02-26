<?php

/* TripSiteManagementBundle:Default:index.html.twig */
class __TwigTemplate_536dc2ece133dab40027038c6f08c6854dfc56f801961e19ecf2e217ca3f697d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.html.twig", "TripSiteManagementBundle:Default:index.html.twig", 1);
        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'body' => array($this, 'block_body'),
            'navTabs' => array($this, 'block_navTabs'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 3
        echo "\t\t<link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/jquery.timepicker.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" media=\"screen\">
\t\t
";
    }

    // line 6
    public function block_javascripts($context, array $blocks = array())
    {
        // line 7
        echo "<script src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/jquery.timepicker.min.js"), "html", null, true);
        echo "\"></script>



<script>
    
    
    \$('#trip_search_preferTime').timepicker({ 'scrollDefault': 'now' });
    
     \$('.adults').click(function(e){\t\t
\t\t\te.preventDefault(); //STOP default action 
\t\t\t var id = \$(this).attr('id');
\t\t\t var value = parseInt(\$(this).attr('value'));
\t\t\t var adults =parseInt( \$('#trip_search_numAdult').val());
\t\t\t if (isNaN(adults)) { 
\t\t\t\t adults= 0
\t            } 
\t\t\t if(id=='decrement'){
\t\t\t\t adults-=1;
\t\t\t\t if(adults>=value) \$('#trip_search_numAdult').val(adults); else exit();
\t\t\t  }else{
\t\t\t\tadults+=1;
\t\t\t    if(adults<=20)  \$('#trip_search_numAdult').val(adults); else exit();
\t\t\t\t}\t\t\t\t\t\t\t \t\t   \t\t\t   \t\t\t\t\t\t\t
\t    });
        \$('.days').click(function(e){\t\t
\t\t\te.preventDefault(); //STOP default action 
\t\t\t var id = \$(this).attr('id');
\t\t\t var value = parseInt(\$(this).attr('value'));
\t\t\t var days =parseInt( \$('#trip_search_numDays').val());
\t\t\t if (isNaN(days)) { 
\t\t\t\t days= 0
\t            } 
\t\t\t if(id=='decrement'){
\t\t\t\t days-=1;
\t\t\t\t if(days>=value) \$('#trip_search_numDays').val(days); else exit();
\t\t\t  }else{
\t\t\t\tdays+=1;
\t\t\t    if(days<=20)  \$('#trip_search_numDays').val(days); else exit();
\t\t\t\t}\t\t\t\t\t\t\t \t\t   \t\t\t   \t\t\t\t\t\t\t
\t    });
    
\$(\"#trip_search_goingTo\").change(function() {
\t\t\t\$('#trip_search_date').focus();\t\t\t\t
\t\t});
\$(\"#trip_search_leavingFrom\").change(function() {
            var selected = \$(this).val();
            \$('#trip_search_goingTo option').removeAttr('disabled');
            \$('#trip_search_goingTo option[value=\"'+selected+'\"]').attr('disabled',true);
            \$(\"#trip_search_goingTo\").trigger(\"chosen:updated\");\t\t\t\t
\t\t});
    
\$(\"#trip_search_multiple_0_leavingFrom\").change(function() {
            var selected = \$(this).val();
            \$('#trip_search_multiple_0_goingTo option').removeAttr('disabled');
            \$('#trip_search_multiple_0_goingTo option[value=\"'+selected+'\"]').attr('disabled',true);
            \$(\"#trip_search_multiple_0_goingTo\").trigger(\"chosen:updated\");\t\t\t\t
\t\t});
\$(\"#trip_search_multiple_1_leavingFrom\").change(function() {
            var selected = \$(this).val();
            \$('#trip_search_multiple_1_goingTo option').removeAttr('disabled');
            \$('#trip_search_multiple_1_goingTo option[value=\"'+selected+'\"]').attr('disabled',true);
            \$(\"#trip_search_multiple_1_goingTo\").trigger(\"chosen:updated\");\t\t\t\t
\t\t});
    
   \$(\"#trip_search_multiple_0_goingTo\").change(function() {\t
        var selected = \$(this).val();
       \$(\"#trip_search_multiple_1_leavingFrom\").val(selected);
       \$(\"#trip_search_multiple_1_leavingFrom\").trigger(\"chosen:updated\");
        \$('#trip_search_multiple_1_goingTo option').removeAttr('disabled');
        \$('#trip_search_multiple_1_goingTo option[value=\"'+selected+'\"]').attr('disabled',true);
        \$(\"#trip_search_multiple_1_goingTo\").trigger(\"chosen:updated\");\t
        \$(\"#trip_search_multiple_0_date\").focus();
\t\t      });
   \$(\"#trip_search_multiple_1_goingTo\").change(function() {\t
        var selected = \$(this).val();
       \$(\"#trip_search_multiple_2_leavingFrom\").val(selected);
       \$(\"#trip_search_multiple_2_leavingFrom\").trigger(\"chosen:updated\");
        \$('#trip_search_multiple_2_goingTo option').removeAttr('disabled');
        \$('#trip_search_multiple_2_goingTo option[value=\"'+selected+'\"]').attr('disabled',true);
        \$(\"#trip_search_multiple_2_goingTo\").trigger(\"chosen:updated\");\t
        \$(\"#trip_search_multiple_1_date\").focus();
\t\t      });
    
    \$(\".tripNav label\").change(function() {\t\t\t\t\t
        \$(\".tripNav label\").removeClass('tripSel');
        \$(this).addClass('tripSel');
       var type= \$(this).attr('for');
        if(type=='multicity'){
            \$('#multipleCity').show();
            \$('#genaral').hide();
        }else{
            \$('#multipleCity').hide();
            \$('#genaral').show();
        }
        if(type=='roundtrip'){
            \$(\"#trip_search_returnDate\").removeAttr(\"readonly\");
             \$(\"#trip_search_returnDate\").attr(\"required\",\"true\");
        }else{
            if(type!='dailyRent'){
            \$(\"#trip_search_returnDate\").attr(\"readonly\",\"readonly\");
            \$(\"#trip_search_returnDate\").val('');
            \$(\"#trip_search_returnDate\").removeAttr(\"required\");
            }
        }
     });
    
    
    
     // keep track of how many city fields have been rendered
    var cityCount = '";
        // line 117
        echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "multiple", array())), "html", null, true);
        echo "';

   // \$(document).ready(function() {
        \$('#add-another-city').click(function(e) {
            e.preventDefault();
            if(cityCount>4){
                alert('Max 5 only');
                exit();
            }

            var cityList = \$('#city-fields-list');

            // grab the prototype template
            var newWidget = cityList.attr('data-prototype');
            // replace the \"__name__\" used in the id and name of the prototype
            // with a number that's unique to your city
            newWidget = newWidget.replace(/__name__/g, cityCount);
            cityCount++;

            // create a new list element and add it to the list
            var newLi = \$('<div></div>').html(newWidget);
            newLi.appendTo(cityList);
            var key = cityCount-1;
            var next = key+1;
             \$( \"#trip_search_multiple_\"+key+\"_date\" ).datepicker({ dateFormat: 'dd/mm/yy',numberOfMonths:2,minDate: 0, });
            \$(\".chosen-select\").chosen({no_results_text: \"Oops, nothing found!\"});
               \$(\"#trip_search_multiple_\"+key+\"_goingTo\").change(function() {\t
                    var selected = \$(this).val();
                   \$(\"#trip_search_multiple_\"+next+\"_leavingFrom\").val(selected);
                   \$(\"#trip_search_multiple_\"+next+\"_leavingFrom\").trigger(\"chosen:updated\");
                    \$('#trip_search_multiple_'+next+'_goingTo option').removeAttr('disabled');
                    \$('#trip_search_multiple_'+next+'_goingTo option[value=\"'+selected+'\"]').attr('disabled',true);
                    \$(\"#trip_search_multiple_\"+next+\"_goingTo\").trigger(\"chosen:updated\");\t
                    \$(\"#trip_search_multiple_\"+key+\"_date\").focus();
\t\t      });
            \$(\"#trip_search_multiple_\"+key+\"_leavingFrom\").change(function() {
                var selected = \$(this).val();
                \$('#trip_search_multiple_'+key+'_goingTo option').removeAttr('disabled');
                \$('#trip_search_multiple_'+key+'_goingTo option[value=\"'+selected+'\"]').attr('disabled',true);
                \$(\"#trip_search_multiple_\"+key+\"_goingTo\").trigger(\"chosen:updated\");\t\t\t\t
\t\t      });
            var prev = key-1;
            var selected = \$(\"#trip_search_multiple_\"+prev+\"_goingTo\").val();
            \$(\"#trip_search_multiple_\"+key+\"_leavingFrom\").val(selected);
            \$(\"#trip_search_multiple_\"+key+\"_leavingFrom\").trigger(\"chosen:updated\");
             \$('#trip_search_multiple_'+key+'_goingTo option').removeAttr('disabled');
            \$('#trip_search_multiple_'+key+'_goingTo option[value=\"'+selected+'\"]').attr('disabled',true);
             \$(\"#trip_search_multiple_\"+key+\"_goingTo\").trigger(\"chosen:updated\");
        });
   // });
    
   
   
</script>
";
    }

    // line 172
    public function block_body($context, array $blocks = array())
    {
        // line 173
        echo "<style>
    .tripNav label{
        cursor: pointer;
    }
    @media (min-width:992px){
    .remove_left{
        padding-left: 0px;
    }
    .remove_right{
        padding-right: 0px;
    }
    .btn-top{
        margin-top: 25px !important;
    }
    }
</style>
    <section class=\"section fullscreen background parallax\" style=\"background-image:url(";
        // line 189
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/home-banner.png"), "html", null, true);
        echo ");position: relative;padding: 73px 0;\" data-img-width=\"1920\" data-img-height=\"1003\" data-diff=\"100\">
        <div class=\"container\">
            <div class=\"row homeform\">
                ";
        // line 201
        echo "                <div class=\"col-md-12 col-xs-12\">
                    <div class=\"home-form\">
                        <h2>Want To Hire A Car On Rent</h2>
                        
                        <!-- Nav tabs -->
                        ";
        // line 206
        $this->displayBlock('navTabs', $context, $blocks);
        // line 488
        echo "
   
                    </div><!-- end homeform -->
                </div><!-- end col -->

                          
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end section -->
\t<section class=\"section clearfix section-bottom fullscreen background parallax\">
\t\t<div class=\"container\">
\t\t\t<div class=\"hotel-title\">
                <h3>HOW IT WORKS</h3>
                <hr class=\"left\">
            </div><!-- end hotel-title -->
            <div class=\"row\">
            \t<div class=\"col-md-3\">
            \t\t<div class=\"col-md-12\">
            \t\t<img src=\"";
        // line 506
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/how1.png"), "html", null, true);
        echo "\" alt=\"\" class=\"img-responsive home-how-to-img\">
            \t\t</div>
            \t\t<div class=\"col-md-12\">
            \t\t<h6 class=\"home-grid-title\">Search</h6>
            \t\t<p class=\"text-center\">Set the date of your ride and then search for the Taxi and bike that you want.</p>
            \t\t</div>
            \t</div>
            \t<div class=\"col-md-3\">
            \t\t<img src=\"";
        // line 514
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/how2.png"), "html", null, true);
        echo "\" alt=\"\" class=\"img-responsive home-how-to-img\">
            \t\t<h6 class=\"home-grid-title\">Select</h6>
            \t\t<p class=\"text-center\">Choose out of various Taxis and bikes that best suits the trip youre about to take.</p>
            \t</div>
            \t<div class=\"col-md-3\">
            \t\t<img src=\"";
        // line 519
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/how3.png"), "html", null, true);
        echo "\" alt=\"\" class=\"img-responsive\" style=\"margin: 0 auto;\">
            \t\t<h6 class=\"home-grid-title\">Pick-up</h6>
            \t\t<p class=\"text-center\">Get suited up and head to the drop location to pickup your ride.</p>
            \t</div>
            \t<div class=\"col-md-3\">
            \t\t<img src=\"";
        // line 524
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/how4.png"), "html", null, true);
        echo "\" alt=\"\" class=\"img-responsive home-how-to-img\">
            \t\t<h6 class=\"home-grid-title\">Ride</h6>
            \t\t<p class=\"text-center\">Get ready to roll and have a nice time tripping!</p>
            \t</div>
            </div>
        </div>
    </section>
   <section class=\"section clearfix section-bottom fullscreen background parallax sec-bg\">
\t\t<div class=\"container\">
\t\t\t
\t\t\t<div class=\"hotel-title\">
                <h3>OUR CARS </h3>
                <hr class=\"left\">
            </div><!-- end hotel-title -->
            <div class=\"row\">
                <div class=\"col-md-12\">
                \t<div class=\"col-md-3\">
                \t\t<div class=\"bike-background\">  
                \t\t<img src=\"";
        // line 542
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/justtrip-hasback.jpg"), "html", null, true);
        echo "\" alt=\"\" class=\"img-responsive\">
                \t\t<hr>
                \t\t<h6 class=\"home-grid-title\">Hatchback</h6>
                \t\t<p class=\"cars-grid-cont\">Seating Capacity :<span class=\"cars-grid-left\">4+1</span></p>
                \t\t<p class=\"cars-grid-cont\">Per Kilo Meter :<span class=\"cars-grid-left\">Rs 10/-</span></p>
                \t\t<p class=\"cars-grid-cont\">Minimum Kms :<span class=\"cars-grid-left\">300</span></p>
                \t\t<p class=\"cars-grid-cont\">Driver Allowance :<span class=\"cars-grid-left\">Rs 300/-</span></p>
                \t\t<p class=\"cars-grid-cont\">Local Usage :<span class=\"cars-grid-left\">Rs 1400/-+ Diesel</span></p>
                \t\t</div>
                \t</div>
                \t<div class=\"col-md-3\">
                \t\t<div class=\"bike-background\">  
                \t\t<img src=\"";
        // line 554
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/justtrip-sedan.jpg"), "html", null, true);
        echo "\" alt=\"\" class=\"img-responsive\">
                \t\t<hr>
                \t\t<h6 class=\"home-grid-title\">Sedan</h6>
                \t\t<p class=\"cars-grid-cont\">Seating Capacity :<span class=\"cars-grid-left\">4+1</span></p>
                \t\t<p class=\"cars-grid-cont\">Per Kilo Meter :<span class=\"cars-grid-left\">Rs 9/-</span></p>
                \t\t<p class=\"cars-grid-cont\">Minimum Kms :<span class=\"cars-grid-left\">300</span></p>
                \t\t<p class=\"cars-grid-cont\">Driver Allowance :<span class=\"cars-grid-left\">Rs 300/-</span></p>
                \t\t<p class=\"cars-grid-cont\">Local Usage :<span class=\"cars-grid-left\">Rs 1600/-+ Diesel</span></p>
                \t\t</div>
                \t</div>
                \t<div class=\"col-md-3\">
                \t\t<div class=\"bike-background\">  
                \t\t<img src=\"";
        // line 566
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/justtrip-innova.jpg"), "html", null, true);
        echo "\" alt=\"\" class=\"img-responsive\">
                \t\t<hr>
                \t\t<h6 class=\"home-grid-title\">SUV</h6>
                \t\t<p class=\"cars-grid-cont\">Seating Capacity :<span class=\"cars-grid-left\">7+1</span></p>
                \t\t<p class=\"cars-grid-cont\">Per Kilo Meter :<span class=\"cars-grid-left\">Rs 14/-</span></p>
                \t\t<p class=\"cars-grid-cont\">Minimum Kms :<span class=\"cars-grid-left\">300</span></p>
                \t\t<p class=\"cars-grid-cont\">Driver Allowance :<span class=\"cars-grid-left\">Rs 300/-</span></p>
                \t\t<p class=\"cars-grid-cont\">Local Usage :<span class=\"cars-grid-left\">Rs 2000/-+ Diesel</span></p>
                \t\t</div>
                \t</div>
                \t<div class=\"col-md-3\">
                \t\t<div class=\"bike-background\">  
                \t\t<img src=\"";
        // line 578
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/justtrip-tempo.jpg"), "html", null, true);
        echo "\" alt=\"\" class=\"img-responsive\" style=\"height: 132px;\">
                \t\t<hr>
                \t\t<h6 class=\"home-grid-title\">Tempo Traveller</h6>
                \t\t<p class=\"cars-grid-cont\">Seating Capacity :<span class=\"cars-grid-left\">12+1</span></p>
                \t\t<p class=\"cars-grid-cont\">Per Kilo Meter :<span class=\"cars-grid-left\">Rs 17/-</span></p>
                \t\t<p class=\"cars-grid-cont\">Minimum Kms :<span class=\"cars-grid-left\">350</span></p>
                \t\t<p class=\"cars-grid-cont\">Driver Allowance :<span class=\"cars-grid-left\">Rs 300/-</span></p>
                \t\t<p class=\"cars-grid-cont\">Local Usage :<span class=\"cars-grid-left\">Rs 2500/-+ Diesel</span></p>
                \t\t</div>
                \t</div>
                </div><!-- end col -->
            </div><!-- end row -->
\t\t</div><!-- end container -->
\t</section><!-- end section --> 
\t<section class=\"section clearfix section-bottom fullscreen background parallax\">
\t\t<div class=\"container\">
\t\t
\t\t\t<div class=\"hotel-title\">
                <h3>OUR FLEET</h3>
                <hr class=\"left\">
            </div><!-- end hotel-title -->
            <div class=\"row\">
                <div class=\"col-md-12\">
                \t";
        // line 601
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["bikes"]) ? $context["bikes"] : $this->getContext($context, "bikes")));
        foreach ($context['_seq'] as $context["_key"] => $context["bike"]) {
            echo " 
                            <div class=\"col-md-2\">
                            <div class=\"bike-background\">   
                            \t <img src=\"";
            // line 604
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl(("images/bikes/" . $this->getAttribute($context["bike"], "imgPath", array()))), "html", null, true);
            echo "\" style=\"width: 100%;\">                             
                                <h4 style=\"text-align:center;color:#000\"><a class=\"view-bikes-title\" href=\"";
            // line 605
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("trip_site_management_view_bikes", array("url" => $this->getAttribute($context["bike"], "locationUrl", array()))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["bike"], "title", array()), "html", null, true);
            echo "</a></h4>
                                <div><h6 style=\"text-align:center;color:#000\">Starts @";
            // line 606
            echo twig_escape_filter($this->env, $this->getAttribute($context["bike"], "statingPrice", array()), "html", null, true);
            echo "</h6></div>
                                 <div class=\"row\">
                                         <div class=\"col-md-12\" >
                                         </div>
                                         <div class=\"col-md-12\" >
                                         ";
            // line 611
            if (($this->getAttribute($context["bike"], "count", array()) <= 0)) {
                // line 612
                echo "                                          \t\t\t<a class=\"btn btn-book-now view-bike\" disabled>
                                                      Sold Out
                                                    </a>   
                                          \t";
            } else {
                // line 616
                echo "                                                <a class=\"btn btn-book-now view-bike\" href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("trip_site_management_view_bikes", array("url" => $this->getAttribute($context["bike"], "locationUrl", array()))), "html", null, true);
                echo "\">
                                                  Rent Now
                                                </a>
                                            ";
            }
            // line 620
            echo "        \t\t\t\t\t\t\t\t";
            // line 621
            echo "                                         </div>
                                         <div class=\"col-md-12\" >
                                         </div>
                                 </div>
                              
                              </div>
                            </div>
                           ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['bike'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 629
        echo "                </div>
           </div>
\t\t</div>
\t
\t</section>
    <section class=\"section clearfix sec-bg\">
        <div class=\"container\">
            <div class=\"hotel-title\">
                <h4>TOP POPULAR DESTINATIONS</h4>
            </div><!-- end hotel-title -->

            <div class=\"row\">
                <div class=\"col-md-6\">
                <a href=\"http://www.justtrip.in/packages/tirupati-to-tirumala-taxi-services\">
                    <div class=\"mini-desti row\">
                        <div class=\"col-md-4\">
                            
                            <img src=\"";
        // line 646
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/popular/Just-Trip-Tirumala-Drop.png"), "html", null, true);
        echo "\" alt=\"\" class=\"img-responsive\">
                        \t
                        </div><!-- end col -->
                        <div class=\"col-md-8\">
                            <div class=\"mini-desti-title\">
                                <div class=\"pull-left\">
                                    <h6>Tirupati To Tirumala </h6>
                                    <b>Indica A/c </b>
                                </div>
                                <div class=\"pull-right\">
                                    <h6><i class=\"fa fa-inr\"></i>700</h6>
                                </div>  
                                <div class=\"clearfix\"></div>   
                                <div class=\"mini-desti-desc\">
                                    <p>Book A Cab From Tirupati to Tirumala Drop</p>
                                </div>
                                <div class=\"clearfix\"></div> 
                                <div class=\"col-md-4\">
                                <a class=\"btn btn-book-now view-bike\" href=\"http://www.justtrip.in/packages/tirupati-to-tirumala-taxi-services\"> Book Now</a>
                                </div>
                                <div class=\"col-md-4\">
                                
                                </div>
                                <div class=\"col-md-4\">
                                </div>
                                
                            </div><!-- end title -->
                        </div><!-- end col -->
                    </div><!-- end mini-desti --></a>

                    <a href=\"http://www.justtrip.in/packages/renigunta-to-tirupati-taxi-services\"><div class=\"mini-desti row\">
                        <div class=\"col-md-4\">
                            <img src=\"";
        // line 678
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/popular/Tirupati-Airport-Drop-Just-Trip.png"), "html", null, true);
        echo "\" alt=\"\" class=\"img-responsive\">
                        </div><!-- end col -->
                        <div class=\"col-md-8\">
                            <div class=\"mini-desti-title\">
                                <div class=\"pull-left\">
                                    <h6>Tirupati Aiport To Tirumala</h6>
                                    <b>Sedan/Vertio/Etios</b>
                                </div>
                                <div class=\"pull-right\">
                                    <h6><i class=\"fa fa-inr\"></i>1300</h6>
                                </div>  
                                <div class=\"clearfix\"></div>   
                                <div class=\"mini-desti-desc\">
                                    <p>Book a Taxi Tirupati Airport To Tirumala Now.</p>
                                </div>
                                 <div class=\"clearfix\"></div> 
                                 <div class=\"col-md-4\">
                                 <a href=\"http://www.justtrip.in/packages/renigunta-to-tirupati-taxi-services\" class=\"btn btn-book-now view-bike\"> Book Now</a>
                                
                                </div>
                                <div class=\"col-md-4\">
                                
                                </div>
                                <div class=\"col-md-4\">
                                </div>
                                
                            </div><!-- end title -->
                        </div><!-- end col -->
                    </div><!-- end mini-desti --></a>

                    <a href=\"http://www.justtrip.in/packages/tirupati-to-chennai-airport-taxi-services\"><div class=\"mini-desti row noborder\">
                        <div class=\"col-md-4\">
                            <img src=\"";
        // line 710
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/popular/Chennai-International-Airport.jpg"), "html", null, true);
        echo "\" alt=\"\" class=\"img-responsive\">
                        </div><!-- end col -->
                        <div class=\"col-md-8\">
                            <div class=\"mini-desti-title\">
                                <div class=\"pull-left\">
                                    <h6>Tirupati to Chennai Airport</h6>
                                    <b>Indica/Vertio/Etios</b>
                                </div>
                                <div class=\"pull-right\">
                                    <h6><i class=\"fa fa-inr\"></i>3500</h6>
                                </div>  
                                <div class=\"clearfix\"></div>   
                                <div class=\"mini-desti-desc\">
                                    <p>Book A Cab From Tirupati To Chennai Aiport Now</p>
                                </div>
                                 <div class=\"clearfix\"></div> 
                                 <div class=\"col-md-4\">
                                <a class=\"btn btn-book-now view-bike\" href=\"http://www.justtrip.in/packages/tirupati-to-chennai-airport-taxi-services\"> Book Now</a>
                                </div>
                                <div class=\"col-md-4\">
                                
                                </div>
                                <div class=\"col-md-4\">
                                </div>
                                
                            </div><!-- end title -->
                        </div><!-- end col -->
                    </div><!-- end mini-desti --></a>
                </div><!-- end col -->

                <div class=\"col-md-6\">
                    <a href=\"http://www.justtrip.in/packages/tirupati-to-Vellore-taxi-services\"><div class=\"mini-desti row\">
                        <div class=\"col-md-4\">
                            <img src=\"";
        // line 743
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/popular/Vellore-Golden-Temple-Drop-Just-Trip.png"), "html", null, true);
        echo "\" alt=\"\" class=\"img-responsive\">
                        </div><!-- end col -->
                        <div class=\"col-md-8\">
                            <div class=\"mini-desti-title\">
                                <div class=\"pull-left\">
                                    <h6>Tirupati To Vellore Golden Temple</h6>
                                    <b>Indica/Vertio/Etios</b>
                                </div>
                                <div class=\"pull-right\">
                                    <h6><i class=\"fa fa-inr\"></i>3000</h6>
                                </div>  
                                <div class=\"clearfix\"></div>   
                                <div class=\"mini-desti-desc\">
                                    <p>Book A Taxi From Tirupati To Vellore Golden Temple.</p>
                                </div>
                                 <div class=\"clearfix\"></div> 
                                 <div class=\"col-md-4\">
                                  <a href=\"http://www.justtrip.in/packages/tirupati-to-Vellore-taxi-services\" class=\"btn btn-book-now view-bike\"> Book Now</a>
                                 
                                
                                </div>
                                <div class=\"col-md-4\">
                                
                                </div>
                                <div class=\"col-md-4\">
                                </div>
                               
                            </div><!-- end title -->
                        </div><!-- end col -->
                    </div><!-- end mini-desti --></a>

                    <a href=\"http://www.justtrip.in/packages/tirupati-to-kanipakam-taxi-services\"><div class=\"mini-desti row\">
                        <div class=\"col-md-4\">
                            <img src=\"";
        // line 776
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/popular/Kanipakam-Drop-just-Trip.png"), "html", null, true);
        echo "\" alt=\"\" class=\"img-responsive\">
                        </div><!-- end col -->
                        <div class=\"col-md-8\">
                            <div class=\"mini-desti-title\">
                                <div class=\"pull-left\">
                                    <h6>Tirupati To Kanipakam</h6>
                                    <b>Indica/Vertio/Etios</b>
                                </div>
                                <div class=\"pull-right\">
                                    <h6><i class=\"fa fa-inr\"></i>3000</h6>
                                </div>  
                                <div class=\"clearfix\"></div>   
                                <div class=\"mini-desti-desc\">
                                    <p>Book A Cab From Tirupati To Kanipakam Now.</p>
                                </div>
                                 <div class=\"clearfix\"></div> 
                                 <div class=\"col-md-4\">
                                  
                                  <a href=\"http://www.justtrip.in/packages/tirupati-to-kanipakam-taxi-services\" class=\"btn btn-book-now view-bike\"> Book Now</a>
                                 
                                </div>
                                <div class=\"col-md-4\">
                                
                                </div>
                                <div class=\"col-md-4\">
                                </div>
                                
                            </div><!-- end title -->
                        </div><!-- end col -->
                    </div><!-- end mini-desti --></a>

                    <a href=\"http://www.justtrip.in/packages/tirupati-to-srikalahasti-taxi-services\"><div class=\"mini-desti row noborder\">
                        <div class=\"col-md-4\">
                            <img src=\"";
        // line 809
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/popular/Srikalahasti-Drop-Just-Trip.png"), "html", null, true);
        echo "\" alt=\"\" class=\"img-responsive\">
                        </div><!-- end col -->
                        <div class=\"col-md-8\">
                            <div class=\"mini-desti-title\">
                                <div class=\"pull-left\">
                                    <h6>Tirupati to Srikalahasti</h6>
                                    <b>Indica/Vertio/Etios</b>
                                </div>
                                <div class=\"pull-right\">
                                    <h6><i class=\"fa fa-inr\"></i>1800</h6>
                                </div>  
                                <div class=\"clearfix\"></div>   
                                <div class=\"mini-desti-desc\">
                                    <p>Book A Cab From Tirupati To Srikalahasti Now.</p>
                                </div>
                                 <div class=\"clearfix\"></div> 
                                 <div class=\"col-md-4\">
                                 
                                  <a href=\"http://www.justtrip.in/packages/tirupati-to-srikalahasti-taxi-services\" class=\"btn btn-book-now view-bike\"> Book Now</a>
                                 
                                </div>
                                <div class=\"col-md-4\">
                                
                                </div>
                                <div class=\"col-md-4\">
                                </div>
                                
                            </div><!-- end title -->
                        </div><!-- end col -->
                    </div></a><!-- end mini-desti -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end section -->  
\t
\t
    <section class=\"section clearfix section-bottom fullscreen background parallax\">
        <div class=\"container\">
            <div class=\"hotel-title\">
                <h3>WHAT WE DO </h3>
                <hr class=\"left\">
            </div><!-- end hotel-title -->
            <div class=\"row\">
                <div class=\"col-md-12\">
                    <div class=\"service-style row\">
                        
                        <div class=\"col-md-12 col-xs-12 col-sm-12\">
                        <div class=\"txt\">
                        <p >We justtrip is one of the leading car rental services company in India. 
                        Having a decade of excellence in serving to the people we are become stronger. 
                        Our commitment towards safety and security of clients enhancing the credibility across the Region. 
                        Our exclusive Cab Service in Tirupati are come up with a flexible package plans which are suitable to everyone.</p>
                       <h5>Justtrip Tirupati Cab Services</h5>
                       <p>Our Taxi service in Tirupati provides complete end-to-end service like, pick-up point to dropping point.
                        We ensure passenger comfort levels throughout the journey and prominent response all the times. 
                        We provide services and assistance at 24 by 7. We are offering the best reasonable tirupati car rental services to the passengers.
                        No hidden charges or extra tariffs applicable.
                        Our luxurious cabs allows passenger to travel more convenient.
                        Cab Services in Tirupati by justtrip provides well experienced cab drivers, who have more than 10 years of experience in the field and have good knowledge about the location. 
                        Pick-up from any location in tirupati and dropping at tirumala is our exclusive package services.</p>
                        <h5>Cab Services to Tirumala</h5> 
                        <p>Justtriptirupati cabs service offers complete Tirupati city visits and tirupati to tirumala visits and also other locations like papavinashanam, kapilateerdham.
                         We are also extending our services for the passenger comforts like, exclusive pick-up and droppings from Chennai Airport, Sri kalahasthi, Golden Temple, Reniguntaairport and any other locations.
                         Taxi in Tirupati services by the justtrip have received number of recognitions and appraisals from the passengers and transport and safety organizations across India as well.
                         </p>
                        <h5>Justtrip Exclusive Cab services in Tirupati / Tirumala</h5>
                        <p>Tirupati Taxi by justtrip is the only online platform where passengers can check everything in detail about the services, packages and enquiry for any clarifications. 
                        Also passengers can select the pick-up and droppings in online and tariffs accordingly.</p>
                         <ul class=\"list\">
                         <li>Hassle free online cab booking services offering by justtrip.</li>
                         <li>Exclusive corporate packages and cab services also available at justtrip.</li>
                         <li>We facilitate customers / passenger by the regional language and other language expertise drivers. Which allows for better communication.</li> 
                         <li>On-road assistance is available only at justtrip. Visit our branched in tirupati or tirumala for live interaction with our guided team for more information.</li> 
                         </ul></br>
                        <p>Customer satisfaction is our motto. We serve better and Flexible.</p>
                        </div>
                        </div>
                    </div><!-- end service -->

                    
                  
                </div><!-- end col -->

                <div class=\"col-md-3\">
                    <!--<img src=\"images/upload/girl.png\" alt=\"\" class=\"img-responsive\">-->
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end section -->  
\t<section class=\"section clearfix section-bottom fullscreen background parallax sec-bg\">
\t\t<div class=\"container\">
\t\t\t<div class=\"hotel-title\">
                <h3>Do you have Questions?</h3>
                <hr class=\"left\">
            </div><!-- end hotel-title -->
            <div class=\"row\">
            \t<div class=\"col-md-6\">
            \t\t<img src=\"";
        // line 906
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/questions.png"), "html", null, true);
        echo "\" alt=\"\" class=\"img-responsive\">
            \t</div>
            \t<div class=\"col-md-6\">
            \t\t<div class=\"que\">
            \t\t<p>Have an issue or want to know about how things work? Just ring us up! We would love to hear you out!</p>
            \t\t<p>Have any Doubts?</p>
            \t\t<strong>Call us 24/7 Support</strong>
            \t\t<h2 class=\"que-numb\">+91-9663133008</h2>
            \t\t</div>
            \t</div>
            </div>
        </div>
    </section>

    <section class=\"section\" data-img-width=\"1920\" data-img-height=\"586\" data-diff=\"10\">
        <div class=\"container\">
            <div id=\"testimonials\">
                 <div class=\"testi-item\">
                    <div class=\"hotel-title text-center\">
                        <h3>THANKS YOU TRIPS! THIS IS AMAZING TRAVEL!</h3>
                        <hr>
                        <p>It was nice service provided by Just Trip, it was my first journey to tirupati.Just Trip people are so helpfull :)</p>
                        <h6>- Ravi / TCS Mumbai</h6>
                    </div>
                </div><!-- end testi-item -->

                <div class=\"testi-item\">
                    <div class=\"hotel-title text-center\">
                        <h3>THANKS YOU TRIPS! THIS IS AMAZING TRAVEL!</h3>
                        <hr>
                        <p>It was nice service provided by Just Trip, it was my first journey to tirupati.Just Trip people are so helpfull :)</p>
                        <h6>- Ravi / TCS Mumbai</h6>
                    </div>
                </div><!-- end testi-item -->
            </div><!-- end testimonials -->
        </div><!-- end container -->
    </section><!-- end section -->

    ";
        // line 953
        echo "
";
    }

    // line 206
    public function block_navTabs($context, array $blocks = array())
    {
        // line 207
        echo "
                        <ul class=\"nav nav-tabs\" role=\"tablist\">
                            <li class=\"active\"><a href=\"#tab_01\" aria-controls=\"tab_01\" role=\"tab\" data-toggle=\"tab\"><i class=\"icon-sedan3\"></i>   Cars</a></li>
\t\t\t\t\t\t\t<li><a href=\"";
        // line 210
        echo $this->env->getExtension('routing')->getPath("trip_site_management_bikes_on_rent");
        echo "\"><img src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/bike.png"), "html", null, true);
        echo "\" style=\"width:27px;height:23px;padding-right: 4px;top: 0px;position: relative;margin-bottom:-5px;\" /><span>Bikes</span></a></li>
 \t\t\t\t\t\t\t<li><a href=\"";
        // line 211
        echo $this->env->getExtension('routing')->getPath("trip_site_management_homepage_hotels");
        echo "\"> <span><i class=\"icon-hotel68\"></i> Hotels</span></a></li>

                            <!--<li><a href=\"#tab_02\" aria-controls=\"tab_02\" role=\"tab\" data-toggle=\"tab\"><i class=\"icon-hotel68\"></i>  Hotels</a></li>-->
                            <li><a href=\"";
        // line 214
        echo $this->env->getExtension('routing')->getPath("trip_site_management_homepage_packages");
        echo "\"><i class=\"icon-bag\"></i>  Packages</a></li>
                            
                            <li><a href=\"#tab_04\" aria-controls=\"tab_04\" role=\"tab\" data-toggle=\"tab\"><i class=\"icon-travel25\"></i>  Offers</a></li>
                            
                        </ul>
                        
                                     <div class=\"tab-content\">
                            <div role=\"tabpanel\" class=\"tab-pane active\" id=\"tab_01\">
                            ";
        // line 222
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_start');
        echo "
\t\t\t\t           ";
        // line 223
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors', array("global_errors" => true));
        echo "
\t\t\t\t\t\t   ";
        // line 231
        echo "                                <div class=\"row tripNav\">
                                    <span>
                                         <label for=\"oneway\" class=\"tripSel\">
                                             <input type=\"radio\" name=\"tripType\" value=\"oneway\" id=\"oneway\" checked> 
                                             One Way
                                         </label>
                                    </span>
                                    <span>
                                        <label for=\"roundtrip\">
                                            <input type=\"radio\" name=\"tripType\" value=\"roundtrip\" id=\"roundtrip\">
                                            Round Trip
                                        </label>
                                    </span>
                                    ";
        // line 252
        echo "                                    <span>
                                         <label for=\"dailyRent\">
                                            <input type=\"radio\" name=\"tripType\" value=\"dailyRent\" id=\"dailyRent\">
                                            Daily Rent
                                        </label>
                                    </span>
                                </div>
                                  
                                <div class=\"row\" id=\"genaral\">
                                    <div class=\"form-group fil col-md-2 col-sm-2 col-xs-12 remove_right\">
                                    \t<div class=\"home-search-align\">
                                         
                                         <div class=\"dropdown homesearch\">
                                             ";
        // line 265
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "leavingFrom", array()), 'widget', array("attr" => array("class" => "home-seacrh-desg")));
        echo "
                                        </div>
                                      \t </div>
                                    </div>
                                    ";
        // line 274
        echo "                                    <div class=\"form-group fil col-md-2 col-sm-2 col-xs-12 remove_right remove_left\">
                                    \t<div class=\"home-search-align\">
                                         
                                         <div class=\"dropdown homesearch\">
                                             ";
        // line 278
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "goingTo", array()), 'widget', array("attr" => array("class" => "home-seacrh-desg")));
        echo "              
                                        </div>
                                       </div>
                                    </div>
                                    <div class=\"form-group fil col-md-2 col-sm-2 col-xs-12 remove_right remove_left\">
                                    <div class=\"home-search-align\">
                                        
                                        <div class=\"input-group homesearch\">
                                            ";
        // line 286
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "date", array()), 'widget', array("attr" => array("class" => "home-seacrh-desg")));
        echo "
                                            <div class=\"input-group-addon\"><i class=\"fa fa-calendar\"></i></div>
                                        </div>
                                       </div>
                                    </div>
                                    <div class=\"form-group fil col-md-2 col-sm-2 col-xs-12 remove_right remove_left\">
                                    <div class=\"home-search-align\">
                                         
                                        <div class=\"input-group homesearch\">
                                            ";
        // line 295
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "returnDate", array()), 'widget', array("attr" => array("class" => "home-seacrh-desg")));
        echo "          
                                            
                                              
                                            <div class=\"input-group-addon\"><i class=\"fa fa-calendar\"></i></div>
                                        </div>
                                        </div>
                                    </div> 
                                    
                                    <div class=\"form-group fil col-md-1 col-sm-1 col-xs-12 remove_right remove_left\">
                                         
                                        <div class=\"input-group homesearch\">
                                            <a class=\"adults input-group-addon\" id=\"decrement\" value=\"1\" href=\"#\">-</a> 
                                                    ";
        // line 307
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "numAdult", array()), 'widget', array("attr" => array("class" => "home-seacrh-desg")));
        echo " 
                                            <a class=\"adults input-group-addon\" id=\"increment\" href=\"#\">+</a>
                                        </div>
                                    </div>
                                     <div class=\"form-group fil col-md-1 col-sm-1 col-xs-12 remove_right remove_left\">
                                      
                                     <div class=\"input-group homesearch-time\">
                                        ";
        // line 314
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "preferTime", array()), 'widget', array("attr" => array("class" => "home-seacrh-desg")));
        echo "
                                     </div>
                                    </div>
                                    <div class=\"form-group fil col-md-2 col-sm-2 col-xs-12\">
                                         <button type=\"submit\" class=\"search-button\">Search </button>
                                    </div>
                                    
                                    
                                </div>
                                    <div style=\"display:none\" class=\"row\" id=\"multipleCity\">
                                    
                                    
                                         ";
        // line 354
        echo "                                         <div id=\"city-fields-list\"
                                                data-prototype=\"";
        // line 355
        echo twig_escape_filter($this->env, $this->getAttribute($this, "information_prototype", array(0 => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "multiple", array()), "vars", array()), "prototype", array())), "method"));
        echo "\">
                                            ";
        // line 356
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "multiple", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["multiCity"]) {
            // line 357
            echo "                                             <div class=\"form-group make-margin fil col-md-4 col-sm-4 col-xs-12\">
                                                 ";
            // line 358
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($context["multiCity"], "leavingFrom", array()), 'label');
            echo "
                                                 <div class=\"dropdown\">
                                                     ";
            // line 360
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($context["multiCity"], "leavingFrom", array()), 'widget');
            echo "
                                                </div>

                                            </div>
                                    
                                            <div class=\"form-group make-margin fil col-md-4 col-sm-4 col-xs-12\">
                                                                                                     
                                                    ";
            // line 367
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($context["multiCity"], "goingTo", array()), 'label');
            echo "
                                                   
                                                    <div class=\"dropdown\">
                                                    ";
            // line 370
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($context["multiCity"], "goingTo", array()), 'widget');
            echo "
                                                   </div>
                                             </div>
                                            <div class=\"form-group make-margin fil col-md-4 col-sm-4 col-xs-12\">
                                                 ";
            // line 374
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($context["multiCity"], "date", array()), 'label');
            echo "
                                                 <div class=\"input-group\">
                                                     ";
            // line 376
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($context["multiCity"], "date", array()), 'widget');
            echo "
                                                </div>

                                            </div>
                                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['multiCity'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 381
        echo "                                    </div>
                                    
                                     <div class=\"form-group make-margin fil col-md-2 col-sm-2 col-xs-12\">
                                      ";
        // line 396
        echo "                                    </div>
                                    <div class=\"form-group make-margin fil col-md-6 col-sm-6 col-xs-12\">
                                     <a href=\"#\" id=\"add-another-city\">Add another city</a>
                                    
                                    </div>
                                </div>
                                <div class=\"row\">
                                     
                                   </div>
                                ";
        // line 412
        echo "                                ";
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_end');
        echo "
                                
                            </div><!-- end tab-pane -->

                            <div role=\"tabpanel\" class=\"tab-pane\" id=\"tab_03\">
                                <h3>WHEN WOULD YOU LIKE TO GO?</h3>
                                <form class=\"bookform form-inline row\">
                                    <div class=\"form-group col-md-12 col-sm-6 col-xs-12\">
                                        <input type=\"text\" class=\"form-control\" placeholder=\" Destination: Country, City,Airport...\">
                                    </div>
                                    <div class=\"form-group col-md-12 col-sm-6 col-xs-12\">
                                        <input type=\"text\" class=\"form-control\" placeholder=\" Hotel: TUNAI, HAWAI...\">
                                    </div>
                                    <div class=\"form-group col-md-12 col-sm-6 col-xs-12\">
                                        <input type=\"text\" class=\"form-control\" placeholder=\" Time: May, Jun, Jully...\">
                                    </div>

                                    <div class=\"form-group col-md-12 col-sm-6 col-xs-12\">
                                        <button type=\"submit\" class=\"btn btn-primary btn-block\"><i class=\"icon-search\"></i> BOOK NOW</button>
                                    </div>
                                </form>
                            </div><!-- end tab-pane -->

                            <div role=\"tabpanel\" class=\"tab-pane\" id=\"tab_02\">
                                <h3>Where Woulf You Like To Go?</h3>
                                       ";
        // line 437
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["hotelForm"]) ? $context["hotelForm"] : $this->getContext($context, "hotelForm")), 'form_start');
        echo "
                                        ";
        // line 438
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["hotelForm"]) ? $context["hotelForm"] : $this->getContext($context, "hotelForm")), 'errors', array("global_errors" => true));
        echo "
                                
                                
                                <div class=\"row\">                                
                                   
                                    <div class=\"form-group make-margin fil col-md-12 col-sm-12 col-xs-12\">
                                         ";
        // line 444
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["hotelForm"]) ? $context["hotelForm"] : $this->getContext($context, "hotelForm")), "goingTo", array()), 'label');
        echo "
                                         <div class=\"dropdown\">
                                             ";
        // line 446
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["hotelForm"]) ? $context["hotelForm"] : $this->getContext($context, "hotelForm")), "goingTo", array()), 'widget');
        echo "                
                                        </div>
                                    </div>
                                    <div class=\"form-group make-margin fil col-md-6 col-sm-6 col-xs-12\">
                                        ";
        // line 450
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["hotelForm"]) ? $context["hotelForm"] : $this->getContext($context, "hotelForm")), "date", array()), 'label');
        echo " 
                                        <div class=\"input-group\">
                                            ";
        // line 452
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["hotelForm"]) ? $context["hotelForm"] : $this->getContext($context, "hotelForm")), "date", array()), 'widget');
        echo " 
                                            <div class=\"input-group-addon\"><i class=\"fa fa-calendar\"></i></div>
                                        </div>
                                    </div>
                                    <div class=\"form-group make-margin fil col-md-6 col-sm-6 col-xs-12\">
                                         ";
        // line 457
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["hotelForm"]) ? $context["hotelForm"] : $this->getContext($context, "hotelForm")), "returnDate", array()), 'label');
        echo "
                                        <div class=\"input-group\">
                                            ";
        // line 459
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["hotelForm"]) ? $context["hotelForm"] : $this->getContext($context, "hotelForm")), "returnDate", array()), 'widget');
        echo "          
                                            
                                              
                                            <div class=\"input-group-addon\"><i class=\"fa fa-calendar\"></i></div>
                                        </div>
                                    </div> 
                                    
                                    <div class=\"form-group col-md-12 col-sm-6 col-xs-12\">
                                        <button type=\"submit\" class=\"btn-primary btn-block search-button\"><i class=\"icon-search\"></i> Search </button>
                                    </div>
                                </div>
                                   
                               ";
        // line 471
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["hotelForm"]) ? $context["hotelForm"] : $this->getContext($context, "hotelForm")), 'form_end');
        echo "
                            </div><!-- end tab-pane -->

                            <div role=\"tabpanel\" class=\"tab-pane\" id=\"tab_04\">
                                <h3>Get <i class=\"fa fa-inr\"></i> 50 OFF on First Ride</h3>
                                <div class=\"row\">
                                    <div class=\"col-md-12 col-xs-12 text-center\">
                                        <h3>Use This Coupon Code</h3>
                                        <h4><span>FIRSTRIDE</span></h4>
                                            
                                    </div>
                                </div>
                            </div><!-- end tab-pane -->

                            
                        </div><!-- end tab-content -->
                        ";
    }

    // line 326
    public function getinformation_prototype($__multiCity__ = null)
    {
        $context = $this->env->mergeGlobals(array(
            "multiCity" => $__multiCity__,
            "varargs" => func_num_args() > 1 ? array_slice(func_get_args(), 1) : array(),
        ));

        $blocks = array();

        ob_start();
        try {
            // line 327
            echo "                                    
                                    
                                            <div class=\"form-group make-margin fil col-md-4 col-sm-4 col-xs-12\">
                                                 ";
            // line 330
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["multiCity"]) ? $context["multiCity"] : $this->getContext($context, "multiCity")), "leavingFrom", array()), 'label');
            echo "
                                                 <div class=\"dropdown\">
                                                     ";
            // line 332
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["multiCity"]) ? $context["multiCity"] : $this->getContext($context, "multiCity")), "leavingFrom", array()), 'widget');
            echo "
                                                </div>

                                            </div>
                                    
                                            <div class=\"form-group make-margin fil col-md-4 col-sm-4 col-xs-12\">
                                                                                                     
                                                    ";
            // line 339
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["multiCity"]) ? $context["multiCity"] : $this->getContext($context, "multiCity")), "goingTo", array()), 'label');
            echo "
                                                   
                                                    <div class=\"dropdown\">
                                                    ";
            // line 342
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["multiCity"]) ? $context["multiCity"] : $this->getContext($context, "multiCity")), "goingTo", array()), 'widget');
            echo "
                                                   </div>
                                             </div>
                                            <div class=\"form-group make-margin fil col-md-4 col-sm-4 col-xs-12\">
                                                 ";
            // line 346
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["multiCity"]) ? $context["multiCity"] : $this->getContext($context, "multiCity")), "date", array()), 'label');
            echo "
                                                 <div class=\"input-group\">
                                                     ";
            // line 348
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["multiCity"]) ? $context["multiCity"] : $this->getContext($context, "multiCity")), "date", array()), 'widget');
            echo "
                                                </div>

                                            </div>
                                           
                                        ";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "TripSiteManagementBundle:Default:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1170 => 348,  1165 => 346,  1158 => 342,  1152 => 339,  1142 => 332,  1137 => 330,  1132 => 327,  1120 => 326,  1099 => 471,  1084 => 459,  1079 => 457,  1071 => 452,  1066 => 450,  1059 => 446,  1054 => 444,  1045 => 438,  1041 => 437,  1012 => 412,  1001 => 396,  996 => 381,  985 => 376,  980 => 374,  973 => 370,  967 => 367,  957 => 360,  952 => 358,  949 => 357,  945 => 356,  941 => 355,  938 => 354,  923 => 314,  913 => 307,  898 => 295,  886 => 286,  875 => 278,  869 => 274,  862 => 265,  847 => 252,  832 => 231,  828 => 223,  824 => 222,  813 => 214,  807 => 211,  801 => 210,  796 => 207,  793 => 206,  788 => 953,  747 => 906,  647 => 809,  611 => 776,  575 => 743,  539 => 710,  504 => 678,  469 => 646,  450 => 629,  437 => 621,  435 => 620,  427 => 616,  421 => 612,  419 => 611,  411 => 606,  405 => 605,  401 => 604,  393 => 601,  367 => 578,  352 => 566,  337 => 554,  322 => 542,  301 => 524,  293 => 519,  285 => 514,  274 => 506,  254 => 488,  252 => 206,  245 => 201,  239 => 189,  221 => 173,  218 => 172,  159 => 117,  45 => 7,  42 => 6,  34 => 3,  31 => 2,  11 => 1,);
    }
}
