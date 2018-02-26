<?php

/* TripSiteManagementBundle:Default:hotels.html.twig */
class __TwigTemplate_ba91cd12ce3536cc466a2d030c68380851dcae7111d61541cc3ab887f027278d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("TripSiteManagementBundle:Default:index.html.twig", "TripSiteManagementBundle:Default:hotels.html.twig", 1);
        $this->blocks = array(
            'javascripts' => array($this, 'block_javascripts'),
            'navTabs' => array($this, 'block_navTabs'),
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

    // line 3
    public function block_javascripts($context, array $blocks = array())
    {
        // line 4
        echo "<script>
var room = \$('.guests-room').html();
\$(\"#guests-box\").on('click','.add-room',function(e){
\te.preventDefault();    \t
    \t//alert(room);
    \tvar roomCount = parseInt(\$(this).attr('value'));
    \tvar adultCount = parseInt(\$('#trip_hotel_search_numAdult').val());
    \tif(roomCount==4){
        \talert(\"You reached maximum rooms allowed per booking\");
        \texit();
    \t}
    \troomCount+=1;    \t
    \t\$(this).attr('value',roomCount);
    \t//\$('.guests-room').append(\"<h5>Room \"+roomCount+\"</h5>\");
    \t//\$('.guests-room').append(room);
    \t\$('#trip_hotel_search_numRooms').val(roomCount);
    \t\$('#trip_hotel_search_numAdult').val(adultCount+1);
    \t\t \$.ajax({
    \t\t      url: \"";
        // line 22
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
    \t\t   });\t
    \t var totalAdultCount = parseInt(\$('#trip_hotel_search_numAdult').val());
    \t var totalChildCount = parseInt(\$('#trip_hotel_search_numChildren').val());
    \tvar guests = totalAdultCount + totalChildCount;
    \tvar guestsText = guests+' Guests, '+roomCount+' Rooms';
    \t\$('#guests').val(guestsText);

    \te.preventDefault();
   \t
});
\$(\"#guests-box\").on('click','.adults',function(e){\t
\te.preventDefault(); //STOP default action 
\t var id = \$(this).attr('id');
\t var key = \$(this).attr('href');
\t var value = parseInt(\$(this).attr('value'));
\t// var value = 3;
\t var totalAdultCount = parseInt(\$('#trip_hotel_search_numAdult').val());
\t var totalChildCount = parseInt(\$('#trip_hotel_search_numChildren').val());
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
\t\t if(adults>=1) \$(adultsCount).html(adults); else exit();
\t  }else{
\t\tadults+=1;
\t\ttotalAdultCount+=1;
\t    if(adults<=2)  \$(adultsCount).html(adults); else exit();
\t\t}
\t \t\t\$.ajax({
\t\t \t      url: \"";
        // line 70
        echo $this->env->getExtension('routing')->getPath("trip_booking_engine_add_adults");
        echo "\",
\t\t \t      type: \"GET\",
\t\t \t       data: { \"adults\" : adults,\"key\" : key},
\t\t \t   \t       
\t\t \t      success: function(data) {\t
\t\t \t\t    //\$('#guests-room').html(data);
\t\t\t\t\t     
\t\t \t      },
\t\t 
\t\t \t      error: function(XMLHttpRequest, textStatus, errorThrown)
\t\t \t      {
\t\t\t        alert('Error: ' +  errorThrown);
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
\t\t if(children>=0) \$(childrenCount).html(children); else exit();
\t  }else{
\t\t  children+=1;
\t\t  totalChildCount+=1;
\t    if(children<=2)  \$(childrenCount).html(children); else exit();
\t\t}
\t\t\t \$.ajax({
\t\t       url: \"";
        // line 112
        echo $this->env->getExtension('routing')->getPath("trip_booking_engine_add_childs");
        echo "\",
\t\t \t   type: \"GET\",
\t\t       data: { \"child\" : children,\"key\" : key},
\t\t \t   \t       
\t\t      success: function(data) {\t
\t\t \t\t    //\$('#guests-room').html(data);
\t\t \t\t     
\t\t       },
\t\t 
\t\t       error: function(XMLHttpRequest, textStatus, errorThrown)
\t\t      {
\t\t         alert('Error: ' +  errorThrown);
\t\t       }
\t\t \t   });
\t \$('#trip_hotel_search_numChildren').val(totalChildCount);
\t var guests = totalAdultCount + totalChildCount;
 \tvar guestsText = guests+' Guests, '+roomCount+' Rooms';
 \t\$('#guests').val(guestsText);
});


\$('#guests').click(function(e){
\t//var room = \$('#guests-room').html();
\t//\$('#guests-room').next(room);
\te.preventDefault();
\t\t\$.ajax({
\t\t      url: \"";
        // line 138
        echo $this->env->getExtension('routing')->getPath("trip_booking_engine_update_room");
        echo "\",
\t\t      type: \"GET\",
\t\t      data: { \"adults\" : '1',\"child\" : '0'},
\t\t   \t       
\t\t      success: function(data) {\t
\t\t\t     \$('#guests-room').html(data);
\t\t\t\t\t     
\t\t\t      },
\t\t
\t\t\t      error: function(XMLHttpRequest, textStatus, errorThrown)
\t\t\t      {
\t\t\t        alert('Error: ' +  errorThrown);
\t\t\t      }
\t\t\t   });\t
    \t \$('#guests').popover({
    \t\t    placement: \"bottom\",
    \t\t    trigger: \"manual\",
    \t\t    html : true,
    \t\t    content: \$(\"#popover-content\").html()
    \t\t}).popover(\"show\");


        
    });

    
\$(\"#guests-box\").on('click','.guestclose',function(e){ 
\t e.preventDefault(); //STOP default action 
\t var id=\$(this).attr('id');
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


\$(function () {

\t// implementation of disabled form fields
\t
});
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

    // line 237
    public function block_navTabs($context, array $blocks = array())
    {
        // line 238
        echo " 
                        ";
    }

    // line 240
    public function block_body($context, array $blocks = array())
    {
        // line 241
        echo "
<!-- Start Banner -->
  <section id=\"banner\" class=\"home-page\" style=\"background-image:url(";
        // line 243
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/hotels/Grand-Hills-Broumana-Luxury-Hotel-Lebanon-Premier-Deluxe-Room.jpg"), "html", null, true);
        echo ");height:350px;background-position: 50% -297.702px;\" data-img-width=\"1920\" data-img-height=\"1503\" data-diff=\"100\">
  
    
        <div class=\"css-table\">
       
      <div class=\"css-table-cell\">
 
        <!-- Start Banner-Search -->
        <div class=\"banner-search\">
          <div class=\"container\">
              <div id=\"hero-tabs\" class=\"banner-search-inner\">
               
                <ul class=\"custom-list tab-content-list\">

                  <!-- Start Hotel -->
                
                  <div id=\"search-form\" class=\"search-form-boxnew\" >
                  <h1 style=\"text-transform: uppercase;text-align: center;font-family: calibri;color:#EE2E24;\">Book Your Hotel Now</h1>
                    ";
        // line 261
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["hotelForm"]) ? $context["hotelForm"] : $this->getContext($context, "hotelForm")), 'form_start');
        echo "
                    
           <div class=\"col-lg-12 col-sm-12 form-group has-error\">
\t\t\t    <div class=\"col-lg-1 col-sm-12 form-group has-error\" style=\"width:60px;\">
\t\t\t    </div>
                     <span class=\"city select-box\" style=\"\">
                        ";
        // line 267
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["hotelForm"]) ? $context["hotelForm"] : $this->getContext($context, "hotelForm")), "goingTo", array()), 'widget');
        echo "
                      </span>
                      <span class=\" \" id=\"checkIn\">
                      \t
                        ";
        // line 271
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["hotelForm"]) ? $context["hotelForm"] : $this->getContext($context, "hotelForm")), "date", array()), 'widget');
        echo "
                       
                        <i class=\"fa fa-calendar\" onclick=\"getcheckin()\" style=\"color:#000;margin-top:-15px;\"></i>
                      </span>
                     <span class=\" \" id=\"checkIn\">
                      \t
                        ";
        // line 277
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["hotelForm"]) ? $context["hotelForm"] : $this->getContext($context, "hotelForm")), "returnDate", array()), 'widget');
        echo "
                       
                        <i class=\"fa fa-calendar\" onclick=\"getcheckin()\" style=\"color:#000;margin-top:-15px;\"></i>
                      </span>
                      <span class=\"city guests\" id=\"guests-box\">
                     <input type=\"text\" id=\"guests\" value=\"";
        // line 282
        echo twig_escape_filter($this->env, ($this->getAttribute((isset($context["search"]) ? $context["search"] : $this->getContext($context, "search")), "numAdult", array()) + $this->getAttribute((isset($context["search"]) ? $context["search"] : $this->getContext($context, "search")), "numChildren", array())), "html", null, true);
        echo " Guests, ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["search"]) ? $context["search"] : $this->getContext($context, "search")), "numRooms", array()), "html", null, true);
        echo " Room\" readonly style=\"height:37px;border-radius:5px;padding-left: 5px;color:#000;background-color:#fff;\" />
                      
                      <div id=\"popover-content\" style=\"display: none\">
                      
                     <div id=\"guestsclosediv\" >
                     ";
        // line 313
        echo "                      
                      \t
\t\t\t\t\t\t
\t\t\t\t\t\t               \t 
                      \t<div class=\"guests-room\" id=\"guests-room\">
                      \t ";
        // line 318
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
            // line 319
            echo "                      \t
\t\t\t\t\t\t 
                      \t<h5>Room ";
            // line 321
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "</h5>
\t                      \t<a class=\"close btnguestclosecase guestclose\" id=\"guestclose\">&times;</a>
                      \t<div class=\"row\">
                      \t\t<div class=\"col-lg-8\">

                      \t\t\t<i class=\"adults-count\">1</i> Adults <i class=\"guests-text\">(0-12) years</i>


                      \t\t</div>
                      \t\t<div class=\"col-lg-4\">
                      \t\t\t<a class=\"adults input-group-addon\" id=\"decrement\" value=\"1\" href=\"";
            // line 331
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo "\">-</a>
                      \t\t\t<a class=\"adults input-group-addon\" id=\"increment\" href=\"";
            // line 332
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo "\">+</a>
                      \t\t</div>                     \t
                      \t</div>
                      \t<hr>
                      \t<div class=\"row\">
                      \t\t<div class=\"col-lg-8\">
                      \t\t\t<i class=\"children-count\">0</i> Children <i class=\"guests-text\">(3-12) years</i>
                      \t\t</div>
                      \t\t<div class=\"col-lg-4\">
                      \t\t\t<a class=\"children input-group-addon\" id=\"decrement\" value=\"";
            // line 341
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo "\" href=\"#\">-</a>
                      \t\t\t<a class=\"children input-group-addon\" id=\"increment\" href=\"";
            // line 342
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
        // line 347
        echo "                      \t</div>
                      \t<a href=\"#\" class=\"add-room\" value=\"1\">Add Room</a>   
                      \t</div>                   \t                      \t
                      </div>
                    
                      
                      ";
        // line 360
        echo "                       
                      </span>
                      ";
        // line 378
        echo "                      <span class=\"submit-btn\">
                      \t ";
        // line 379
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["hotelForm"]) ? $context["hotelForm"] : $this->getContext($context, "hotelForm")), "numAdult", array()), 'widget');
        echo "
                      \t  ";
        // line 380
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["hotelForm"]) ? $context["hotelForm"] : $this->getContext($context, "hotelForm")), "numChildren", array()), 'widget');
        echo "
                      \t   ";
        // line 381
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["hotelForm"]) ? $context["hotelForm"] : $this->getContext($context, "hotelForm")), "numRooms", array()), 'widget');
        echo "
                        <button class=\"btn btn-transparent\" style=\"color:#fff;height: 35px;width:100%;background-color:#EE2E24;\">Search</button>                      
                      </span>
                     ";
        // line 384
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["hotelForm"]) ? $context["hotelForm"] : $this->getContext($context, "hotelForm")), 'form_end');
        echo "
                     </div>
                  </li>
                  <!-- End Hotel -->
\t\t\t\t</div>
                 

                </ul>
            </div>
          </div>
        </div>
        <!-- End Banner-Search -->

      </div>
    </div>
    
  </section>
  ";
    }

    public function getTemplateName()
    {
        return "TripSiteManagementBundle:Default:hotels.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  469 => 384,  463 => 381,  459 => 380,  455 => 379,  452 => 378,  448 => 360,  440 => 347,  421 => 342,  417 => 341,  405 => 332,  401 => 331,  388 => 321,  384 => 319,  367 => 318,  360 => 313,  350 => 282,  342 => 277,  333 => 271,  326 => 267,  317 => 261,  296 => 243,  292 => 241,  289 => 240,  284 => 238,  281 => 237,  178 => 138,  149 => 112,  104 => 70,  53 => 22,  33 => 4,  30 => 3,  11 => 1,);
    }
}
