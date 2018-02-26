<?php

/* TripBookingEngineBundle:Default:searchHotel.html.twig */
class __TwigTemplate_03dc55cae425dc4c2feb740ca7a1dcc438199b907c3f5144a986bdf58d4acac9 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("TripSiteManagementBundle:Default:index.html.twig", "TripBookingEngineBundle:Default:searchHotel.html.twig", 1);
        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "TripSiteManagementBundle:Default:index.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 3
        echo " <link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/ion.rangeSlider.css"), "html", null, true);
        echo "\" />
  <link rel=\"stylesheet\" href=\"";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/ion.rangeSlider.skinFlat.css"), "html", null, true);
        echo "\" />
 
    <!-- Default Styles -->
    <link href=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/search-style.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">
 <link href=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/awe-booking-font.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">

 ";
    }

    // line 11
    public function block_javascripts($context, array $blocks = array())
    {
        // line 12
        echo "<script src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/ionrangeslider.min.js"), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("https://cdnjs.cloudflare.com/ajax/libs/stickyfill/2.0.3/stickyfill.js"), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("https://cdnjs.cloudflare.com/ajax/libs/stickyfill/2.0.3/stickyfill.min.js"), "html", null, true);
        echo "\"></script>
<script type=\"text/javascript\">
var elements = document.getElementById('wrapper');
Stickyfill.add(elements);
\$(\"#filter-search\").on('change', ':checkbox', function (e) {
\t   \$(\"form[name='hotel_search_filter']\").submit();
\t});
\t
\$(\"#hotel_search_filter_price\").ionRangeSlider({
    type: 'double',
    prefix: \"<i class='fa fa-inr'></i> \",
    onChange: function (data) {
    \t\$(\"form[name='hotel_search_filter']\").submit();
    },
    prettify: false,
    hasGrid: true
});
</script>
<script>
var room = \$('#guests-room').html();
\$(\"#guests-box\").on('click','#add-room',function(e){
\te.preventDefault();    \t
    \t//alert(room);
    \tvar roomCount = parseInt(\$(this).attr('value'));
    \tvar adultCount = parseInt(\$('#trip_hotel_search_numAdult').val());

    \tif(roomCount==4){
        \talert(\"You reached maximum rooms allowed per booking\");
        \texit();
    \t}
    \t
    \troomCount+=1;    \t
    \t\$(this).attr('value',roomCount);
    \t//\$('#guests-room').append(\"<h5>Room \"+roomCount+\"</h5>\");
    \t//\$('#guests-room').append(room);
    \t\$('#trip_hotel_search_numRooms').val(roomCount);
    \t\$('#trip_hotel_search_numAdult').val(adultCount+1);
    \t  \t \$.ajax({
    \t\t      url: \"";
        // line 52
        echo $this->env->getExtension('routing')->getPath("trip_booking_engine_add_room");
        echo "\",
    \t\t      type: \"GET\",
    \t\t       data: { \"adults\" : '1',\"child\" : '0'},
    \t\t   \t       
    \t\t      success: function(data) {\t
    \t\t\t     \$('#guests-room').html(data);
    \t\t\t\t     
    \t\t      },
    \t
    \t\t      error: function(XMLHttpRequest, textStatus, errorThrown)
    \t\t      {
    \t\t        alert('Error: ' +  errorThrown);
    \t\t      }
    \t\t   });
    \t var totalAdultCount = parseInt(\$('#trip_hotel_search_numAdult').val());
    \t var totalChildCount = parseInt(\$('#trip_hotel_search_numChildren').val());
    \tvar guests = totalAdultCount + totalChildCount;
    \tvar guestsText = guests+' Guests, '+roomCount+' Rooms';
    \t\$('#guests').val(guestsText);
});
\$(\"#guests-box\").on('click','.adults',function(e){\t
\te.preventDefault(); //STOP default action 
\t var id = \$(this).attr('id');
\t var key = \$(this).attr('href');
\t var value = parseInt(\$(this).attr('value'));
\t// var value = 3;
\t var totalAdultCount = parseInt(\$('#trip_hotel_search_numAdult').val());
\t var totalChildCount = parseInt(\$('#trip_hotel_search_numChildren').val());
\t //alert(totalChildCount);
\t var roomCount = parseInt(\$('#trip_hotel_search_numRooms').val());
\t var adultsCount = \$(this).closest('.row').find('.adults-count');
\t var adults =parseInt( \$(adultsCount).html());
\t if (isNaN(adults)) { 
\t\t adults= 0
        } 
\t// alert(adults);
\t if(id=='decrement'){
\t\t adults-=1;
\t\t totalAdultCount-=1;
\t\t if(adults>=value) \$(adultsCount).html(adults); else exit();
\t  }else{
\t\tadults+=1;
\t\ttotalAdultCount+=1;
\t    if(adults<=2)  \$(adultsCount).html(adults); else exit();
\t\t}
\t \$.ajax({
\t\t \t      url: \"";
        // line 98
        echo $this->env->getExtension('routing')->getPath("trip_booking_engine_add_adults");
        echo "\",
\t\t \t      type: \"GET\",
\t\t \t       data: { \"adults\" : adults,\"key\" : key},
\t\t \t   \t       
\t\t \t      success: function(data) {\t
\t\t \t\t    //\$('#guests-room').html(data);
\t\t \t\t     
\t\t \t      },
\t\t 
\t\t \t      error: function(XMLHttpRequest, textStatus, errorThrown)
\t\t \t      {
\t\t \t        alert('Error: ' +  errorThrown);
\t\t \t      }
\t\t \t   });\t
\t \$('#trip_hotel_search_numAdult').val(totalAdultCount);
\t var guests = totalAdultCount + totalChildCount;
 \tvar guestsText = guests+' Guests, '+roomCount+' Rooms';
 \t\$('#guests').val(guestsText);\t
});
\$(\"#guests-box\").on('click','.children',function(e){\t
\te.preventDefault(); //STOP default action 
\t var id = \$(this).attr('id');
\t var key = \$(this).attr('href');
\t var value = parseInt(\$(this).attr('value'));
\t var totalAdultCount = parseInt(\$('#trip_hotel_search_numAdult').val());
\t var totalChildCount = parseInt(\$('#trip_hotel_search_numChildren').val());
\t var childrenCount = \$(this).closest('.row').find('.children-count');
\t var roomCount = parseInt(\$('#trip_hotel_search_numRooms').val());
\t var children =parseInt( \$(childrenCount).html());
\t if (isNaN(children)) { 
\t\t children= 0
        } 
\t if(id=='decrement'){
\t\t children-=1;
\t\t totalChildCount-=1;
\t\t if(children>=value) \$(childrenCount).html(children); else exit();
\t  }else{
\t\t  children+=1;
\t\t  totalChildCount+=1;
\t    if(children<=2)  \$(childrenCount).html(children); else exit();
\t\t}
\t \$.ajax({
\t\t      url: \"";
        // line 140
        echo $this->env->getExtension('routing')->getPath("trip_booking_engine_add_childs");
        echo "\",
\t\t       type: \"GET\",
\t\t        data: { \"child\" : children,\"key\" : key},
\t\t    \t       
\t\t       success: function(data) {\t
\t\t \t    //\$('#guests-room').html(data);
\t\t\t\t     
\t\t       },
\t\t 
\t\t      error: function(XMLHttpRequest, textStatus, errorThrown)
\t\t \t      {
\t\t         alert('Error: ' +  errorThrown);
\t\t \t      }
\t\t \t   });\t
\t \$('#trip_hotel_search_numChildren').val(totalChildCount);
\t var guests = totalAdultCount + totalChildCount;
 \tvar guestsText = guests+' Guests, '+roomCount+' Rooms';
 \t\$('#guests').val(guestsText);
});


\$('#guests').click(function(e){
\t//var room = \$('#guests-room').html();
\t//\$('#guests-room').next(room);
\te.preventDefault();
\t\$.ajax({
\t\t      url: \"";
        // line 166
        echo $this->env->getExtension('routing')->getPath("trip_booking_engine_update_room");
        echo "\",
\t\t      type: \"GET\",
\t\t       data: { \"adults\" : '1',\"child\" : '0'},
\t\t\t   \t       
\t\t      success: function(data) {\t
\t\t\t\t     \$('#guests-room').html(data);
\t\t\t\t\t     
\t\t\t      },
\t\t
\t\t\t      error: function(XMLHttpRequest, textStatus, errorThrown)
\t\t\t      {
\t\t\t        alert('Error: ' +  errorThrown);
\t\t\t      }
\t\t\t\t   });\t
    \t \$('#guests').popover({
    \t\t    placement: \"bottom\",
    \t\t    trigger: \"manual\",
    \t\t    html : true,
    \t\t    content: \$(\"#popover-content\").html()
    \t\t}).popover(\"show\");


        
    });


\$(\"#guests-box\").on('click','.guestclose',function(e){ 
\t e.preventDefault(); //STOP default action 
\t //alert('hi');
\t \$('#guests').popover('hide');
\t
\t/* var x = document.getElementById(\"guestsclosediv\");
\t
\t 
\t   if (x.style.display === \"none\") {
\t         x.style.display = \"block\";
\t     } else {
\t         
\t    \t x.style.display = \"none\";
\t         
\t     } */
\t}); 

function getcheckin() {
    document.getElementById(\"hotel_search_checkIn\").focus();
}
function getcheckout() {
    document.getElementById(\"hotel_search_checkOut\").focus();
}

\t
    </script>
    <script>

\$(document).ready(function() {
    // Configure/customize these variables.
    var showChar = 100;  // How many characters are shown by default
    var ellipsestext = \"...\";
    var moretext = \"Show more >\";
    var lesstext = \"Show less\";
    

    \$('.more').each(function() {
        var content = \$(this).html();
 
        if(content.length > showChar) {
 
            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);
 
            var html = c + '<span class=\"moreellipses\">' + ellipsestext+ '&nbsp;</span><span class=\"morecontent\"><span>' + h + '</span>&nbsp;&nbsp;<a href=\"\" class=\"morelink\">' + moretext + '</a></span>';
 
            \$(this).html(html);
        }
 
    });
 
    \$(\".morelink\").click(function(){
        if(\$(this).hasClass(\"less\")) {
            \$(this).removeClass(\"less\");
            \$(this).html(moretext);
        } else {
            \$(this).addClass(\"less\");
            \$(this).html(lesstext);
        }
        \$(this).parent().prev().toggle();
        \$(this).prev().toggle();
        return false;
    });
});

</script>
";
    }

    // line 260
    public function block_body($context, array $blocks = array())
    {
        // line 261
        echo "
    <section class=\"section clearfix\" style=\"font-family:calibri;\">
        <div class=\"container\">
            <div class=\"row\">
                <div id=\"fullwidth\" class=\"col-sm-12\" style=\"margin-bottom: 0px;\">
                  <div role=\"tabpanel\" class=\"tab-pane active\" id=\"tab_02\" >
                        <h3 style=\"text-transform: uppercase;text-align: center;font-family: calibri;color:#EE2E24;\">Book Your Hotel Now</h3>
                            <div id=\"search-form\">
                                 ";
        // line 269
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_start');
        echo "
                                 ";
        // line 270
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors', array("global_errors" => true));
        echo "
                                <div class=\"row\" style=\"margin-left:0px;\">  
                                 <div id=\"search-form\">
                                  <div class=\"col-lg-12 col-sm-12 form-group has-error\">
\t\t\t    <div class=\"col-lg-1 col-sm-12 form-group has-error\" style=\"width:60px;\">
\t\t\t    </div>
                                    ";
        // line 276
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_start');
        echo "
                                     <span class=\"city select-box \">
                                        ";
        // line 278
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "goingTo", array()), 'widget');
        echo "
                                      </span>
                                      <span class=\" \" style=\"border:none;height: 35px;\">
                                      \t
                                        ";
        // line 282
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "date", array()), 'widget');
        echo "
                                       
                                        <i class=\"fa fa-calendar\" onclick=\"getcheckin()\"></i>
                                      </span>
                                      <span class=\" \" style=\"border:none;height: 35px;\">
                                         ";
        // line 287
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "returnDate", array()), 'widget');
        echo "
                                        <i class=\"fa fa-calendar\" onclick=\"getcheckout()\"></i>
                                      </span>
                                      <span class=\"city guests\" id=\"guests-box\">
                                      <input type=\"text\" id=\"guests\" name=\"guests\" value=\"";
        // line 291
        echo twig_escape_filter($this->env, ($this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "numAdult", array()) + $this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "numChildren", array())), "html", null, true);
        echo " Guests, ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "numRooms", array()), "html", null, true);
        echo " Room\" readonly style=\"height:37px;border-radius:5px;padding-left: 5px;width:95%;background-color:#fff;color:#000;border-color:#e1e1e1;\"/>
                                      <div id=\"popover-content\" style=\"display: none\">
                                      
                                      <!--  \t<h5>Room 1</h5>-->
                                      \t<a class=\"close btnguestclosecase guestclose\" id=\"guestclose\">&times;</a>
                                      \t
                                      \t<div class=\"guests-room\" id=\"guests-room\">
                                      \t";
        // line 298
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["rooms"]) ? $context["rooms"] : $this->getContext($context, "rooms")));
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
        foreach ($context['_seq'] as $context["key"] => $context["room"]) {
            // line 299
            echo "                \t                      \t<h5>Room ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</h5>  
                                      \t<div class=\"row\">
                                      \t\t<div class=\"col-lg-8\">
                                      \t\t\t<i class=\"adults-count\">";
            // line 302
            echo twig_escape_filter($this->env, $this->getAttribute($context["room"], "numAdult", array()), "html", null, true);
            echo "</i> Adults <i class=\"guests-text\">(0-12 years)</i>
                                      \t\t</div>
                                      \t\t<div class=\"col-lg-4\">
                                      \t\t\t<a class=\"adults input-group-addon\" id=\"decrement\" value=\"1\" href=\"";
            // line 305
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo "\">-</a>
                                      \t\t\t<a class=\"adults input-group-addon\" id=\"increment\" href=\"";
            // line 306
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo "\">+</a>
                                      \t\t</div>                     \t
                                      \t</div>
                                      \t<hr>
                                      \t<div class=\"row\">
                                      \t\t<div class=\"col-lg-8\">
                                      \t\t\t<i class=\"children-count\">";
            // line 312
            echo twig_escape_filter($this->env, $this->getAttribute($context["room"], "numChildren", array()), "html", null, true);
            echo "</i> Children <i class=\"guests-text\">(3-12 years)</i>
                                      \t\t</div>
                                      \t\t<div class=\"col-lg-4\">
                                      \t\t\t<a class=\"children input-group-addon\" id=\"decrement\" value=\"0\" href=\"";
            // line 315
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo "\">-</a>
                                      \t\t\t<a class=\"children input-group-addon\" id=\"increment\" href=\"";
            // line 316
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo "\">+</a>
                                      \t\t</div>                     \t
                                      \t</div> 
                                      \t<hr> 
                                      \t";
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
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['room'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 321
        echo "                                      \t</div>
                                      \t<a href=\"#\" id=\"add-room\" value=\"";
        // line 322
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "numRooms", array()), "html", null, true);
        echo "\">Add Room</a>                                    \t                      \t
                                      </div>
                                      </span>
                                    
                                      <span class=\"submit-btn\">
                                      \t ";
        // line 327
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "numAdult", array()), 'widget');
        echo "
                                      \t  ";
        // line 328
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "numChildren", array()), 'widget');
        echo "
                                      \t   ";
        // line 329
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "numRooms", array()), 'widget');
        echo "
                                        <button class=\"btn btn-transparent\" style=\"color:#fff;height: 35px;width:100%;background-color:#EE2E24;\">Search</button>                       
                                      </span>
                                     ";
        // line 332
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_end');
        echo "
                                     </div>
                                        </div>        \t
                                     </div>
                                     </div>               
                                                    
                                     </div>
                            </div><!-- end tab-pane -->

    </div></div></section>
    <section>
     <div class=\"container\" >
        <div class=\"row\">
        \t<div class=\"col-md-3\">
        \t</div>
        \t<div class=\"col-md-9\">
        \t\t<h5 class=\"title pull-left\" style=\"text-align:center;font-family:calibri;background-color: #fff;width:72%;margin-left:15px;color:#000;padding: 7px;\">Available Hotels for  ";
        // line 348
        echo twig_escape_filter($this->env, (isset($context["adults"]) ? $context["adults"] : $this->getContext($context, "adults")), "html", null, true);
        echo "&nbsp;Adults,&nbsp;";
        echo twig_escape_filter($this->env, (isset($context["childs"]) ? $context["childs"] : $this->getContext($context, "childs")), "html", null, true);
        echo "&nbsp;Childs</h5>
        \t</div>
        </div>
        </div>
    </section>
                     
  <section id=\"listing\" style=\"font-family:calibri;\">
    <div class=\"container\" >
      <div class=\"row\">
      
        <nav class=\"col-md-3  border-box sidebar-filter \" style=\"background-color:#fff;\">
        \t<ul class=\"nav nav-pills nav-stacked\" data-spy=\"affix\" data-offset-top=\"205\">
          
            <h5 class=\"toggle-title\" >Filters Location</h5>
            <aside class=\"toggle-content\" id=\"filter-search\">
             ";
        // line 363
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["filterForm"]) ? $context["filterForm"] : $this->getContext($context, "filterForm")), 'form_start');
        echo "
             
              <div class=\"general\" >
                
                <ul class=\"custom-list additional-filter-list clearfix\">
                ";
        // line 368
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["filterForm"]) ? $context["filterForm"] : $this->getContext($context, "filterForm")), "location", array()), "children", array()));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            echo "\t\t\t
                  <li style=\"list-style-type: none;color:#000;\">
                    <span class=\"checkbox-input\">
                     
                      ";
            // line 372
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($context["item"], 'widget');
            echo "
                      ";
            // line 373
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($context["item"], 'label');
            echo "
                    </span>
                  </li>
                  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 376
        echo "                  
                </ul>
                
                <hr class=\"filter-divider\">
                <h5 class=\"title\">Price</h5>
                
                ";
        // line 382
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["filterForm"]) ? $context["filterForm"] : $this->getContext($context, "filterForm")), "price", array()), 'widget', array("attr" => array("data-min" => ("" . $this->getAttribute(        // line 383
(isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "min", array())), "data-max" => ("" . $this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "max", array())), "data-from" => ("" . $this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "minPrice", array())), "data-to" => ("" . $this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "maxPrice", array())))));
        // line 384
        echo "
\t\t\t\t\t\t\t\t
               <hr class=\"filter-divider\">
                <h5 class=\"title\">Property Type</h5>
                <ul class=\"custom-list additional-filter-list clearfix\">
                
                 ";
        // line 390
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["filterForm"]) ? $context["filterForm"] : $this->getContext($context, "filterForm")), "properties", array()), "children", array()));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            echo "\t\t\t
                  
                    <span class=\"checkbox-input\">
                     
                      ";
            // line 394
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($context["item"], 'widget');
            echo "
                      ";
            // line 395
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($context["item"], 'label');
            echo "
                    </span>
                  </br>
                  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 398
        echo " 
                 
                </ul>
              </div>
            </aside>
            </ul>
       
        </nav>
        <nav class=\"col-md-3  border-box sidebar-filters\" style=\"background-color:#fff;\">
        \t<ul class=\"nav nav-pills nav-stacked\" data-spy=\"affixresponsive\" data-offset-top=\"205\">
          
            <h5 class=\"toggle-title\" >Filters Location</h5>
            <aside class=\"toggle-content\" id=\"filter-search\">
             ";
        // line 411
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["filterForm"]) ? $context["filterForm"] : $this->getContext($context, "filterForm")), 'form_start');
        echo "
             
              <div class=\"general\" >
                
                <ul class=\"custom-list additional-filter-list clearfix\">
                ";
        // line 416
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["filterForm"]) ? $context["filterForm"] : $this->getContext($context, "filterForm")), "location", array()), "children", array()));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            echo "\t\t\t
                  <li style=\"list-style-type: none;color:#000;\">
                    <span class=\"checkbox-input\">
                     
                      ";
            // line 420
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($context["item"], 'widget');
            echo "
                      ";
            // line 421
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($context["item"], 'label');
            echo "
                    </span>
                  </li>
                  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 424
        echo "                  
                </ul>
                
                <hr class=\"filter-divider\">
                <h5 class=\"title\">Price</h5>
                
                ";
        // line 430
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["filterForm"]) ? $context["filterForm"] : $this->getContext($context, "filterForm")), "price", array()), 'widget', array("attr" => array("data-min" => ("" . $this->getAttribute(        // line 431
(isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "min", array())), "data-max" => ("" . $this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "max", array())), "data-from" => ("" . $this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "minPrice", array())), "data-to" => ("" . $this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "maxPrice", array())))));
        // line 432
        echo "
\t\t\t\t\t\t\t\t
               <hr class=\"filter-divider\">
                <h5 class=\"title\">Property Type</h5>
                <ul class=\"custom-list additional-filter-list clearfix\">
                
                 ";
        // line 438
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["filterForm"]) ? $context["filterForm"] : $this->getContext($context, "filterForm")), "properties", array()), "children", array()));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            echo "\t\t\t
                  
                    <span class=\"checkbox-input\">
                     
                      ";
            // line 442
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($context["item"], 'widget');
            echo "
                      ";
            // line 443
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($context["item"], 'label');
            echo "
                    </span>
                  </br>
                  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 446
        echo " 
                 
                </ul>
              </div>
            </aside>
            </ul>
       
        </nav>
       
        <div class=\"listing-content col-md-9 \">
       
         
          ";
        // line 458
        $context["i"] = 0;
        // line 459
        echo "          ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["result"]) ? $context["result"] : $this->getContext($context, "result")));
        foreach ($context['_seq'] as $context["_key"] => $context["hotel"]) {
            // line 460
            echo "          <div class=\"listing-room-list\" style=\"border: 1px solid #e1e1e1;\">
          <div class=\"row\" >
           <div class=\"col-md-3\">
            <div class=\"thumbnail\">
                ";
            // line 464
            if ($this->getAttribute($this->getAttribute($context["hotel"], "images", array()), "first", array())) {
                // line 465
                echo "                <img src=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl(("images/Hotels/" . $this->getAttribute($this->getAttribute($this->getAttribute($context["hotel"], "images", array()), "first", array()), "imagePath", array()))), "html", null, true);
                echo "\" alt=\"\" class=\"img-responsive\" height=\"100%\">
                              ";
            } else {
                // line 467
                echo "               <img src=\"/hotel/web/img/Hotels/shirdib3.jpg\" alt=\"\" class=\"img-responsive\" height=\"100%\">
               ";
            }
            // line 469
            echo "            </div>
          </div>
         
            <div class=\"listing-room-content\">
              
                <div class=\"col-md-9\">
                  <header style=\"margin-top:10px;margin-bottom:-20px;\">
                    <div class=\"pull-left\">
                    
                    ";
            // line 478
            $context["room"] = 1;
            // line 479
            echo "                  
            \t\t 
            \t\t  ";
            // line 481
            if ($this->getAttribute((isset($context["roomCountByHotel"]) ? $context["roomCountByHotel"] : null), $this->getAttribute($context["hotel"], "id", array()), array(), "array", true, true)) {
                // line 482
                echo "\t            \t\t  ";
                if (($this->getAttribute((isset($context["roomCountByHotel"]) ? $context["roomCountByHotel"] : $this->getContext($context, "roomCountByHotel")), $this->getAttribute($context["hotel"], "id", array()), array(), "array") >= $this->getAttribute($context["hotel"], "numRooms", array()))) {
                    // line 483
                    echo "\t\t\t\t                   ";
                    $context["room"] = 0;
                    // line 484
                    echo "\t\t\t\t          ";
                }
                // line 485
                echo "\t\t\t          ";
            }
            // line 486
            echo "                   
                     ";
            // line 487
            if ((((((((isset($context["numRoom"]) ? $context["numRoom"] : $this->getContext($context, "numRoom")) > $this->getAttribute($context["hotel"], "availableRooms", array())) || ($this->getAttribute($context["hotel"], "numRooms", array()) < (isset($context["numRoom"]) ? $context["numRoom"] : $this->getContext($context, "numRoom")))) || (($this->getAttribute($context["hotel"], "soldOut", array()) || ($this->getAttribute($context["hotel"], "numRooms", array()) < 1)) || ((isset($context["room"]) ? $context["room"] : $this->getContext($context, "room")) == 0))) || (($this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "date", array()) >= $this->getAttribute($context["hotel"], "hotelblockStartDate", array())) && ($this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "date", array()) <= $this->getAttribute($context["hotel"], "hotelblockEndDate", array())))) || (($this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "returnDate", array()) >= $this->getAttribute($context["hotel"], "hotelblockStartDate", array())) && ($this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "returnDate", array()) <= $this->getAttribute($context["hotel"], "hotelblockEndDate", array())))) || (($this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "date", array()) <= $this->getAttribute($context["hotel"], "hotelblockStartDate", array())) && ($this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "returnDate", array()) >= $this->getAttribute($context["hotel"], "hotelblockEndDate", array()))))) {
                // line 488
                echo "                      <h5 class=\"title\">
                        ";
                // line 489
                echo twig_escape_filter($this->env, $this->getAttribute($context["hotel"], "name", array()), "html", null, true);
                echo "
                      </h5>
                      ";
            } else {
                // line 492
                echo "                      <h5 class=\"title\">
                        <a href=\"";
                // line 493
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("trip_site_management_view_hotel", array("id" => $this->getAttribute($context["hotel"], "id", array()))), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($context["hotel"], "name", array()), "html", null, true);
                echo "</a>
                      </h5>
                      ";
            }
            // line 496
            echo "                      <ul class=\"tags custom-list list-inline pull-left\" style=\"border:none;padding:0 0 20px;\">
                      
                 
                        <li class=\"location\"><i class=\"fa fa-map-marker\"></i> ";
            // line 499
            echo twig_escape_filter($this->env, $this->getAttribute($context["hotel"], "location", array()), "html", null, true);
            echo ", ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["hotel"], "city", array()), "html", null, true);
            echo "</li>
                       
                      </ul>
                    </div>
                    <div class=\"pull-right\">
                   
                  
                        ";
            // line 506
            $context["guests"] = ($this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "numAdult", array()) + $this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "numchildren", array()));
            // line 507
            echo "                    ";
            $context["price"] = (($this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "numRooms", array()) * $this->getAttribute($context["hotel"], "price", array())) * (isset($context["numDay"]) ? $context["numDay"] : $this->getContext($context, "numDay")));
            // line 508
            echo "      
                      
                    </div>
                    
                    <div class=\"listing-facitilities\">
                    <div class=\"row\" style=\"font-family:calibri;\">
                      <div class=\"col-md-3 col-sm-5\" style=\"text-align: center;font-size: 20px;font-weight: 600;color: red;float:right;\">
                        ";
            // line 515
            $context["promotion"] = false;
            // line 516
            echo "              ";
            if ($this->getAttribute($context["hotel"], "promotionStartDate", array())) {
                // line 517
                echo "                ";
                if ((($this->getAttribute($context["hotel"], "promotionStartDate", array()) <= (isset($context["today"]) ? $context["today"] : $this->getContext($context, "today"))) && ((isset($context["today"]) ? $context["today"] : $this->getContext($context, "today")) <= $this->getAttribute($context["hotel"], "promotionEndDate", array())))) {
                    echo "  
                 ";
                    // line 518
                    $context["promotion"] = true;
                    // line 519
                    echo "                 <div class=\"tipsy from-right-top active txt-ac uprcse price-tipsy\">
                 <div class=\"arrow_box info theme-blue  savedprice\">You Save <i class=\"fa fa-inr\"> ";
                    // line 520
                    echo twig_escape_filter($this->env, ((isset($context["price"]) ? $context["price"] : $this->getContext($context, "price")) - $this->getAttribute($context["hotel"], "promotionPrice", array())), "html", null, true);
                    echo "</i>
          \t\t\t</div>
          \t\t\t</div>
                 
                    <span class=\"price\">
                        <i class=\"fa fa-inr\"></i> ";
                    // line 525
                    echo twig_escape_filter($this->env, $this->getAttribute($context["hotel"], "promotionPrice", array()), "html", null, true);
                    echo " <strike> <i class=\"fa fa-inr\"></i> ";
                    echo twig_escape_filter($this->env, (isset($context["price"]) ? $context["price"] : $this->getContext($context, "price")), "html", null, true);
                    echo " </strike>
                      </span>
                    ";
                }
                // line 528
                echo "                ";
            }
            // line 529
            echo "                   
                   ";
            // line 530
            if (((isset($context["promotion"]) ? $context["promotion"] : $this->getContext($context, "promotion")) == false)) {
                echo " 
                      <span class=\"price\">
                      
                      ";
                // line 533
                if (((isset($context["guests"]) ? $context["guests"] : $this->getContext($context, "guests")) == $this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "numRooms", array()))) {
                    // line 534
                    echo "    <p><span style=\"font-size:24px;\"><i class=\"fa fa-inr\"></i>&nbsp;";
                    echo twig_escape_filter($this->env, (isset($context["price"]) ? $context["price"] : $this->getContext($context, "price")), "html", null, true);
                    echo "</span></br><span style=\"color:#000;font-size:12px;font-weight:normal;\">";
                    echo twig_escape_filter($this->env, (isset($context["guests"]) ? $context["guests"] : $this->getContext($context, "guests")), "html", null, true);
                    echo "&nbsp;Guests,&nbsp;    ";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "numRooms", array()), "html", null, true);
                    echo "&nbsp;Rooms</span></p>
";
                } elseif (((                // line 535
(isset($context["guests"]) ? $context["guests"] : $this->getContext($context, "guests")) > 1) && ($this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "numRooms", array()) == 1))) {
                    // line 536
                    echo "\t";
                    if ((($this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "numAdult", array()) == 2) && ($this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "numchildren", array()) == 2))) {
                        // line 537
                        echo "\t";
                        $context["numRooms"] = ($this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "numRooms", array()) + 1);
                        // line 538
                        echo "\t\t";
                        $context["price"] = (($this->getAttribute($context["hotel"], "price", array()) * (isset($context["numRooms"]) ? $context["numRooms"] : $this->getContext($context, "numRooms"))) * (isset($context["numDay"]) ? $context["numDay"] : $this->getContext($context, "numDay")));
                        // line 539
                        echo "\t\t<p><span style=\"font-size:24px;\"><i class=\"fa fa-inr\"></i>&nbsp;";
                        echo twig_escape_filter($this->env, (isset($context["price"]) ? $context["price"] : $this->getContext($context, "price")), "html", null, true);
                        echo "</span></br><span style=\"color:#000;font-size:12px;font-weight:normal;\">";
                        echo twig_escape_filter($this->env, (isset($context["guests"]) ? $context["guests"] : $this->getContext($context, "guests")), "html", null, true);
                        echo "&nbsp;Guests,&nbsp;";
                        echo twig_escape_filter($this->env, (isset($context["numRooms"]) ? $context["numRooms"] : $this->getContext($context, "numRooms")), "html", null, true);
                        echo "&nbsp;Rooms</span></p>
\t";
                    } else {
                        // line 541
                        $context["xprice"] = ((isset($context["guests"]) ? $context["guests"] : $this->getContext($context, "guests")) - 1);
                        // line 542
                        $context["xprice"] = ((isset($context["xprice"]) ? $context["xprice"] : $this->getContext($context, "xprice")) * 500);
                        // line 543
                        echo "    <p><span style=\"font-size:24px;\"><i class=\"fa fa-inr\"></i>&nbsp;";
                        echo twig_escape_filter($this->env, ((isset($context["price"]) ? $context["price"] : $this->getContext($context, "price")) + (isset($context["xprice"]) ? $context["xprice"] : $this->getContext($context, "xprice"))), "html", null, true);
                        echo "</span></br><span style=\"color:#000;font-size:12px;font-weight:normal;\">";
                        echo twig_escape_filter($this->env, (isset($context["guests"]) ? $context["guests"] : $this->getContext($context, "guests")), "html", null, true);
                        echo "&nbsp;Guests,&nbsp;";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "numRooms", array()), "html", null, true);
                        echo "&nbsp;Rooms</span></p>
    ";
                    }
                    // line 545
                    echo "
";
                } elseif (((                // line 546
(isset($context["guests"]) ? $context["guests"] : $this->getContext($context, "guests")) > 2) && ($this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "numRooms", array()) == 2))) {
                    // line 547
                    if ((($this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "numAdult", array()) == 4) && ($this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "numchildren", array()) == 4))) {
                        // line 548
                        echo "\t";
                        $context["numRooms"] = ($this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "numRooms", array()) + 1);
                        // line 549
                        echo "\t\t";
                        $context["price"] = (($this->getAttribute($context["hotel"], "price", array()) * (isset($context["numRooms"]) ? $context["numRooms"] : $this->getContext($context, "numRooms"))) * (isset($context["numDay"]) ? $context["numDay"] : $this->getContext($context, "numDay")));
                        // line 550
                        echo "\t\t<p><span style=\"font-size:24px;\"><i class=\"fa fa-inr\"></i>&nbsp;";
                        echo twig_escape_filter($this->env, (isset($context["price"]) ? $context["price"] : $this->getContext($context, "price")), "html", null, true);
                        echo "</span></br><span style=\"color:#000;font-size:12px;font-weight:normal;\">";
                        echo twig_escape_filter($this->env, (isset($context["guests"]) ? $context["guests"] : $this->getContext($context, "guests")), "html", null, true);
                        echo "&nbsp;Guests,&nbsp;";
                        echo twig_escape_filter($this->env, (isset($context["numRooms"]) ? $context["numRooms"] : $this->getContext($context, "numRooms")), "html", null, true);
                        echo "&nbsp;Rooms</span></p>
\t";
                    } else {
                        // line 552
                        $context["xprice"] = ((isset($context["guests"]) ? $context["guests"] : $this->getContext($context, "guests")) - 2);
                        // line 553
                        $context["xprice"] = ((isset($context["xprice"]) ? $context["xprice"] : $this->getContext($context, "xprice")) * 500);
                        // line 554
                        echo "    <p><span style=\"font-size:24px;\"><i class=\"fa fa-inr\"></i>&nbsp;";
                        echo twig_escape_filter($this->env, ((isset($context["price"]) ? $context["price"] : $this->getContext($context, "price")) + (isset($context["xprice"]) ? $context["xprice"] : $this->getContext($context, "xprice"))), "html", null, true);
                        echo "</span></br><span style=\"color:#000;font-size:12px;font-weight:normal;\">";
                        echo twig_escape_filter($this->env, (isset($context["guests"]) ? $context["guests"] : $this->getContext($context, "guests")), "html", null, true);
                        echo "&nbsp;Guests,&nbsp;";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "numRooms", array()), "html", null, true);
                        echo "&nbsp;Rooms</span></p>
    ";
                    }
                } elseif (((                // line 556
(isset($context["guests"]) ? $context["guests"] : $this->getContext($context, "guests")) > 3) && ($this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "numRooms", array()) == 3))) {
                    // line 557
                    if ((($this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "numAdult", array()) == 6) && ($this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "numchildren", array()) == 6))) {
                        // line 558
                        echo "\t";
                        $context["numRooms"] = ($this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "numRooms", array()) + 1);
                        // line 559
                        echo "\t\t";
                        $context["price"] = (($this->getAttribute($context["hotel"], "price", array()) * (isset($context["numRooms"]) ? $context["numRooms"] : $this->getContext($context, "numRooms"))) * (isset($context["numDay"]) ? $context["numDay"] : $this->getContext($context, "numDay")));
                        // line 560
                        echo "\t\t<p><span style=\"font-size:24px;\"><i class=\"fa fa-inr\"></i>&nbsp;";
                        echo twig_escape_filter($this->env, (isset($context["price"]) ? $context["price"] : $this->getContext($context, "price")), "html", null, true);
                        echo "</span></br><span style=\"color:#000;font-size:12px;font-weight:normal;\">";
                        echo twig_escape_filter($this->env, (isset($context["guests"]) ? $context["guests"] : $this->getContext($context, "guests")), "html", null, true);
                        echo "&nbsp;Guests,&nbsp;";
                        echo twig_escape_filter($this->env, (isset($context["numRooms"]) ? $context["numRooms"] : $this->getContext($context, "numRooms")), "html", null, true);
                        echo "&nbsp;Rooms</span></p>
\t";
                    } else {
                        // line 562
                        $context["xprice"] = ((isset($context["guests"]) ? $context["guests"] : $this->getContext($context, "guests")) - 3);
                        // line 563
                        $context["xprice"] = ((isset($context["xprice"]) ? $context["xprice"] : $this->getContext($context, "xprice")) * 500);
                        // line 564
                        echo "    <p><span style=\"font-size:24px;\"><i class=\"fa fa-inr\"></i>&nbsp;";
                        echo twig_escape_filter($this->env, ((isset($context["price"]) ? $context["price"] : $this->getContext($context, "price")) + (isset($context["xprice"]) ? $context["xprice"] : $this->getContext($context, "xprice"))), "html", null, true);
                        echo "</span></br><span style=\"color:#000;font-size:12px;font-weight:normal;\">";
                        echo twig_escape_filter($this->env, (isset($context["guests"]) ? $context["guests"] : $this->getContext($context, "guests")), "html", null, true);
                        echo "&nbsp;Guests,&nbsp;";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "numRooms", array()), "html", null, true);
                        echo "&nbsp;Rooms</span></p>
    ";
                    }
                } elseif (((                // line 566
(isset($context["guests"]) ? $context["guests"] : $this->getContext($context, "guests")) > 4) && ($this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "numRooms", array()) == 4))) {
                    // line 567
                    if ((($this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "numAdult", array()) == 8) && ($this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "numchildren", array()) == 8))) {
                        // line 568
                        echo "\t";
                        $context["numRooms"] = ($this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "numRooms", array()) + 1);
                        // line 569
                        echo "\t\t";
                        $context["price"] = (($this->getAttribute($context["hotel"], "price", array()) * (isset($context["numRooms"]) ? $context["numRooms"] : $this->getContext($context, "numRooms"))) * (isset($context["numDay"]) ? $context["numDay"] : $this->getContext($context, "numDay")));
                        // line 570
                        echo "\t\t<p><span style=\"font-size:24px;\"><i class=\"fa fa-inr\"></i>&nbsp;";
                        echo twig_escape_filter($this->env, (isset($context["price"]) ? $context["price"] : $this->getContext($context, "price")), "html", null, true);
                        echo "</span></br><span style=\"color:#000;font-size:12px;font-weight:normal;\">";
                        echo twig_escape_filter($this->env, (isset($context["guests"]) ? $context["guests"] : $this->getContext($context, "guests")), "html", null, true);
                        echo "&nbsp;Guests,&nbsp;";
                        echo twig_escape_filter($this->env, (isset($context["numRooms"]) ? $context["numRooms"] : $this->getContext($context, "numRooms")), "html", null, true);
                        echo "&nbsp;Rooms</span></p>
\t";
                    } else {
                        // line 572
                        $context["xprice"] = ((isset($context["guests"]) ? $context["guests"] : $this->getContext($context, "guests")) - 4);
                        // line 573
                        $context["xprice"] = ((isset($context["xprice"]) ? $context["xprice"] : $this->getContext($context, "xprice")) * 500);
                        // line 574
                        echo "    <p><span style=\"font-size:24px;\"><i class=\"fa fa-inr\"></i>&nbsp;";
                        echo twig_escape_filter($this->env, ((isset($context["price"]) ? $context["price"] : $this->getContext($context, "price")) + (isset($context["xprice"]) ? $context["xprice"] : $this->getContext($context, "xprice"))), "html", null, true);
                        echo "</span></br><span style=\"color:#000;font-size:12px;font-weight:normal;\">";
                        echo twig_escape_filter($this->env, (isset($context["guests"]) ? $context["guests"] : $this->getContext($context, "guests")), "html", null, true);
                        echo "&nbsp;Guests,&nbsp;";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "numRooms", array()), "html", null, true);
                        echo "&nbsp;Rooms</span></p>
    ";
                    }
                    // line 576
                    echo "  ";
                } else {
                    echo "  
";
                }
                // line 578
                echo "   
                      </span>
                     ";
            }
            // line 581
            echo "                      </div>
                      </div>
                      </div>
                      
                    
                  </header>
                  <div class=\"listing-facitilities\">
                  <hr>
                    <div class=\"row\" style=\"margin-left: 0px;\">
                      <div class=\"col-md-3 col-sm-3\">
                        <ul class=\"facilities-list custom-list\" style=\"font-size:13px;color:#777;\">
                           <li><i class=\"fa fa-wifi\"></i><span> Free WiFi</span></li>
                        </ul>
                      </div>
                      
                      <div class=\"col-md-3 col-sm-3\">
                        <ul class=\"facilities-list custom-list\" style=\"font-size:13px;color:#777;\">                         
                          <li><i class=\"fa fa-cutlery\"></i><span>Free Hot Break Fast</span></li>
                        </ul>
                      </div>
                      <div class=\"col-md-3 col-sm-3\">
                        <ul class=\"facilities-list custom-list\" style=\"font-size:13px;color:#777;\">
                          <li><i class=\"fa fa-female\"></i><span> Room service</span></li>
                         
                        </ul>
                      </div>
                      <div class=\"col-md-3 col-sm-3\" style=\"margin-left: -20px;\">
                     <div class=\"pull-right\">
                   
                   ";
            // line 610
            if ((((((((isset($context["numRoom"]) ? $context["numRoom"] : $this->getContext($context, "numRoom")) > $this->getAttribute($context["hotel"], "availableRooms", array())) || ($this->getAttribute($context["hotel"], "numRooms", array()) < (isset($context["numRoom"]) ? $context["numRoom"] : $this->getContext($context, "numRoom")))) || (($this->getAttribute($context["hotel"], "soldOut", array()) || ($this->getAttribute($context["hotel"], "numRooms", array()) < 1)) || ((isset($context["room"]) ? $context["room"] : $this->getContext($context, "room")) == 0))) || (($this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "date", array()) >= $this->getAttribute($context["hotel"], "hotelblockStartDate", array())) && ($this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "date", array()) <= $this->getAttribute($context["hotel"], "hotelblockEndDate", array())))) || (($this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "returnDate", array()) >= $this->getAttribute($context["hotel"], "hotelblockStartDate", array())) && ($this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "returnDate", array()) <= $this->getAttribute($context["hotel"], "hotelblockEndDate", array())))) || (($this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "date", array()) <= $this->getAttribute($context["hotel"], "hotelblockStartDate", array())) && ($this->getAttribute((isset($context["searchHotel"]) ? $context["searchHotel"] : $this->getContext($context, "searchHotel")), "returnDate", array()) >= $this->getAttribute($context["hotel"], "hotelblockEndDate", array()))))) {
                echo " 
                             <a class=\"awe-btn awe-btn btn btn-primary btn-normal btn-sm\" disabled>
                          Sold Out
                        </a>                   
                        \t
                        ";
            } else {
                // line 616
                echo "                        <a href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("trip_site_management_view_hotel", array("id" => $this->getAttribute($context["hotel"], "id", array()))), "html", null, true);
                echo "\" class=\"awe-btn awe-btn btn btn-primary btn-normal btn-sm\" href=\"\">
                          Select Room
                        </a>
                        ";
            }
            // line 620
            echo "                        </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['hotel'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 628
        echo "                    
          
          

          
       
        </div>
      </div>
    </div>
  </section>


";
    }

    public function getTemplateName()
    {
        return "TripBookingEngineBundle:Default:searchHotel.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1083 => 628,  1069 => 620,  1061 => 616,  1052 => 610,  1021 => 581,  1016 => 578,  1010 => 576,  1000 => 574,  998 => 573,  996 => 572,  986 => 570,  983 => 569,  980 => 568,  978 => 567,  976 => 566,  966 => 564,  964 => 563,  962 => 562,  952 => 560,  949 => 559,  946 => 558,  944 => 557,  942 => 556,  932 => 554,  930 => 553,  928 => 552,  918 => 550,  915 => 549,  912 => 548,  910 => 547,  908 => 546,  905 => 545,  895 => 543,  893 => 542,  891 => 541,  881 => 539,  878 => 538,  875 => 537,  872 => 536,  870 => 535,  861 => 534,  859 => 533,  853 => 530,  850 => 529,  847 => 528,  839 => 525,  831 => 520,  828 => 519,  826 => 518,  821 => 517,  818 => 516,  816 => 515,  807 => 508,  804 => 507,  802 => 506,  790 => 499,  785 => 496,  777 => 493,  774 => 492,  768 => 489,  765 => 488,  763 => 487,  760 => 486,  757 => 485,  754 => 484,  751 => 483,  748 => 482,  746 => 481,  742 => 479,  740 => 478,  729 => 469,  725 => 467,  719 => 465,  717 => 464,  711 => 460,  706 => 459,  704 => 458,  690 => 446,  680 => 443,  676 => 442,  667 => 438,  659 => 432,  657 => 431,  656 => 430,  648 => 424,  638 => 421,  634 => 420,  625 => 416,  617 => 411,  602 => 398,  592 => 395,  588 => 394,  579 => 390,  571 => 384,  569 => 383,  568 => 382,  560 => 376,  550 => 373,  546 => 372,  537 => 368,  529 => 363,  509 => 348,  490 => 332,  484 => 329,  480 => 328,  476 => 327,  468 => 322,  465 => 321,  446 => 316,  442 => 315,  436 => 312,  427 => 306,  423 => 305,  417 => 302,  410 => 299,  393 => 298,  381 => 291,  374 => 287,  366 => 282,  359 => 278,  354 => 276,  345 => 270,  341 => 269,  331 => 261,  328 => 260,  231 => 166,  202 => 140,  157 => 98,  108 => 52,  67 => 14,  63 => 13,  58 => 12,  55 => 11,  48 => 8,  44 => 7,  38 => 4,  33 => 3,  30 => 2,  11 => 1,);
    }
}
