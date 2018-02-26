<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appDevUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        if (0 === strpos($pathinfo, '/css/bootstrap')) {
            // _assetic_bootstrap_css
            if ($pathinfo === '/css/bootstrap.css') {
                return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_css',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_bootstrap_css',);
            }

            if (0 === strpos($pathinfo, '/css/bootstrap_')) {
                // _assetic_bootstrap_css_0
                if ($pathinfo === '/css/bootstrap_bootstrap_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_css',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_bootstrap_css_0',);
                }

                // _assetic_bootstrap_css_1
                if ($pathinfo === '/css/bootstrap_form_2.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_css',  'pos' => 1,  '_format' => 'css',  '_route' => '_assetic_bootstrap_css_1',);
                }

                // _assetic_bootstrap_css_2
                if ($pathinfo === '/css/bootstrap_bootstrap_3.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_css',  'pos' => 2,  '_format' => 'css',  '_route' => '_assetic_bootstrap_css_2',);
                }

                // _assetic_bootstrap_css_3
                if ($pathinfo === '/css/bootstrap_form_4.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_css',  'pos' => 3,  '_format' => 'css',  '_route' => '_assetic_bootstrap_css_3',);
                }

            }

        }

        if (0 === strpos($pathinfo, '/js')) {
            if (0 === strpos($pathinfo, '/js/bootstrap')) {
                // _assetic_bootstrap_js
                if ($pathinfo === '/js/bootstrap.js') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => NULL,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js',);
                }

                if (0 === strpos($pathinfo, '/js/bootstrap_')) {
                    // _assetic_bootstrap_js_0
                    if ($pathinfo === '/js/bootstrap_transition_1.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 0,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_0',);
                    }

                    // _assetic_bootstrap_js_1
                    if ($pathinfo === '/js/bootstrap_alert_2.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 1,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_1',);
                    }

                    // _assetic_bootstrap_js_2
                    if ($pathinfo === '/js/bootstrap_button_3.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 2,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_2',);
                    }

                    if (0 === strpos($pathinfo, '/js/bootstrap_c')) {
                        // _assetic_bootstrap_js_3
                        if ($pathinfo === '/js/bootstrap_carousel_4.js') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 3,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_3',);
                        }

                        // _assetic_bootstrap_js_4
                        if ($pathinfo === '/js/bootstrap_collapse_5.js') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 4,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_4',);
                        }

                    }

                    // _assetic_bootstrap_js_5
                    if ($pathinfo === '/js/bootstrap_dropdown_6.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 5,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_5',);
                    }

                    // _assetic_bootstrap_js_6
                    if ($pathinfo === '/js/bootstrap_modal_7.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 6,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_6',);
                    }

                    // _assetic_bootstrap_js_7
                    if ($pathinfo === '/js/bootstrap_tooltip_8.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 7,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_7',);
                    }

                    // _assetic_bootstrap_js_8
                    if ($pathinfo === '/js/bootstrap_popover_9.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 8,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_8',);
                    }

                    // _assetic_bootstrap_js_9
                    if ($pathinfo === '/js/bootstrap_scrollspy_10.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 9,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_9',);
                    }

                    // _assetic_bootstrap_js_10
                    if ($pathinfo === '/js/bootstrap_tab_11.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 10,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_10',);
                    }

                    // _assetic_bootstrap_js_11
                    if ($pathinfo === '/js/bootstrap_affix_12.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 11,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_11',);
                    }

                    // _assetic_bootstrap_js_12
                    if ($pathinfo === '/js/bootstrap_bc-bootstrap-collection_13.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 12,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_12',);
                    }

                    // _assetic_bootstrap_js_13
                    if ($pathinfo === '/js/bootstrap_transition_14.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 13,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_13',);
                    }

                    // _assetic_bootstrap_js_14
                    if ($pathinfo === '/js/bootstrap_alert_15.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 14,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_14',);
                    }

                    // _assetic_bootstrap_js_15
                    if ($pathinfo === '/js/bootstrap_button_16.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 15,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_15',);
                    }

                    if (0 === strpos($pathinfo, '/js/bootstrap_c')) {
                        // _assetic_bootstrap_js_16
                        if ($pathinfo === '/js/bootstrap_carousel_17.js') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 16,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_16',);
                        }

                        // _assetic_bootstrap_js_17
                        if ($pathinfo === '/js/bootstrap_collapse_18.js') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 17,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_17',);
                        }

                    }

                    // _assetic_bootstrap_js_18
                    if ($pathinfo === '/js/bootstrap_dropdown_19.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 18,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_18',);
                    }

                    // _assetic_bootstrap_js_19
                    if ($pathinfo === '/js/bootstrap_modal_20.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 19,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_19',);
                    }

                    // _assetic_bootstrap_js_20
                    if ($pathinfo === '/js/bootstrap_tooltip_21.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 20,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_20',);
                    }

                    // _assetic_bootstrap_js_21
                    if ($pathinfo === '/js/bootstrap_popover_22.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 21,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_21',);
                    }

                    // _assetic_bootstrap_js_22
                    if ($pathinfo === '/js/bootstrap_scrollspy_23.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 22,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_22',);
                    }

                    // _assetic_bootstrap_js_23
                    if ($pathinfo === '/js/bootstrap_tab_24.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 23,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_23',);
                    }

                    // _assetic_bootstrap_js_24
                    if ($pathinfo === '/js/bootstrap_affix_25.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 24,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_24',);
                    }

                    // _assetic_bootstrap_js_25
                    if ($pathinfo === '/js/bootstrap_bc-bootstrap-collection_26.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 25,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_25',);
                    }

                }

            }

            if (0 === strpos($pathinfo, '/js/jquery')) {
                // _assetic_jquery
                if ($pathinfo === '/js/jquery.js') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'jquery',  'pos' => NULL,  '_format' => 'js',  '_route' => '_assetic_jquery',);
                }

                if (0 === strpos($pathinfo, '/js/jquery_jquery-1.1')) {
                    // _assetic_jquery_0
                    if ($pathinfo === '/js/jquery_jquery-1.11.1_1.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'jquery',  'pos' => 0,  '_format' => 'js',  '_route' => '_assetic_jquery_0',);
                    }

                    // _assetic_jquery_1
                    if ($pathinfo === '/js/jquery_jquery-1.10.2_2.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'jquery',  'pos' => 1,  '_format' => 'js',  '_route' => '_assetic_jquery_1',);
                    }

                }

            }

        }

        if (0 === strpos($pathinfo, '/_')) {
            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_wdt')), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
            }

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if (rtrim($pathinfo, '/') === '/_profiler') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_profiler_home');
                    }

                    return array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                }

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ($pathinfo === '/_profiler/search') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                    }

                    // _profiler_search_bar
                    if ($pathinfo === '/_profiler/search_bar') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                    }

                }

                // _profiler_purge
                if ($pathinfo === '/_profiler/purge') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:purgeAction',  '_route' => '_profiler_purge',);
                }

                // _profiler_info
                if (0 === strpos($pathinfo, '/_profiler/info') && preg_match('#^/_profiler/info/(?P<about>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_info')), array (  '_controller' => 'web_profiler.controller.profiler:infoAction',));
                }

                // _profiler_phpinfo
                if ($pathinfo === '/_profiler/phpinfo') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                }

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_search_results')), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                }

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler')), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                }

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_router')), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                }

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception')), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                }

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception_css')), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                }

            }

            if (0 === strpos($pathinfo, '/_configurator')) {
                // _configurator_home
                if (rtrim($pathinfo, '/') === '/_configurator') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_configurator_home');
                    }

                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::checkAction',  '_route' => '_configurator_home',);
                }

                // _configurator_step
                if (0 === strpos($pathinfo, '/_configurator/step') && preg_match('#^/_configurator/step/(?P<index>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_configurator_step')), array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::stepAction',));
                }

                // _configurator_final
                if ($pathinfo === '/_configurator/final') {
                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::finalAction',  '_route' => '_configurator_final',);
                }

            }

            // _twig_error_test
            if (0 === strpos($pathinfo, '/_error') && preg_match('#^/_error/(?P<code>\\d+)(?:\\.(?P<_format>[^/]++))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_twig_error_test')), array (  '_controller' => 'twig.controller.preview_error:previewErrorPageAction',  '_format' => 'html',));
            }

        }

        // trip_rest_homepage
        if (0 === strpos($pathinfo, '/hello') && preg_match('#^/hello/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'trip_rest_homepage')), array (  '_controller' => 'Trip\\RestBundle\\Controller\\DefaultController::indexAction',));
        }

        if (0 === strpos($pathinfo, '/api')) {
            if (0 === strpos($pathinfo, '/api/get-')) {
                // trip_rest_getlocation
                if ($pathinfo === '/api/get-location') {
                    return array (  '_controller' => 'Trip\\RestBundle\\Controller\\RestController::indexAction',  '_route' => 'trip_rest_getlocation',);
                }

                // trip_rest_getsearch
                if ($pathinfo === '/api/get-search') {
                    return array (  '_controller' => 'Trip\\RestBundle\\Controller\\RestController::searchAction',  '_route' => 'trip_rest_getsearch',);
                }

                if (0 === strpos($pathinfo, '/api/get-booking')) {
                    // trip_rest_getbooking
                    if ($pathinfo === '/api/get-bookingsubmit') {
                        return array (  '_controller' => 'Trip\\RestBundle\\Controller\\RestController::bookSubmitAction',  '_route' => 'trip_rest_getbooking',);
                    }

                    // trip_rest_instamojo_getbooking
                    if ($pathinfo === '/api/get-bookinginstamojosubmit') {
                        return array (  '_controller' => 'Trip\\RestBundle\\Controller\\RestController::bookSubmitInstamojoAction',  '_route' => 'trip_rest_instamojo_getbooking',);
                    }

                }

                // trip_rest_instamojo_payment
                if ($pathinfo === '/api/get-instamojo') {
                    return array (  '_controller' => 'Trip\\RestBundle\\Controller\\RestController::instamojoAction',  '_route' => 'trip_rest_instamojo_payment',);
                }

            }

            // trip_rest_payu_payment_trips
            if (0 === strpos($pathinfo, '/api/pay') && preg_match('#^/api/pay/(?P<bookingId>[^/]++)/online/?$#s', $pathinfo, $matches)) {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'trip_rest_payu_payment_trips');
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'trip_rest_payu_payment_trips')), array (  '_controller' => 'Trip\\RestBundle\\Controller\\RestController::payonlineAction',));
            }

            // trip_rest_booking_engine_success
            if ($pathinfo === '/api/customerpaymentconfirmation') {
                return array (  '_controller' => 'Trip\\RestBundle\\Controller\\RestController::paymentsucessAction',  '_route' => 'trip_rest_booking_engine_success',);
            }

            if (0 === strpos($pathinfo, '/api/get-')) {
                if (0 === strpos($pathinfo, '/api/get-pa')) {
                    // trip_rest_getpaymentupdate
                    if ($pathinfo === '/api/get-paymentupdate') {
                        return array (  '_controller' => 'Trip\\RestBundle\\Controller\\RestController::paymentcompleteAction',  '_route' => 'trip_rest_getpaymentupdate',);
                    }

                    if (0 === strpos($pathinfo, '/api/get-package')) {
                        // trip_rest_management_homepage_packages
                        if ($pathinfo === '/api/get-packages') {
                            return array (  '_controller' => 'Trip\\RestBundle\\Controller\\RestpackagesController::multipackagesAction',  '_route' => 'trip_rest_management_homepage_packages',);
                        }

                        // trip_rest_management_homepage_packagedetail_new
                        if ($pathinfo === '/api/get-packagedetail') {
                            return array (  '_controller' => 'Trip\\RestBundle\\Controller\\RestpackagesController::specialPackagesAction',  '_route' => 'trip_rest_management_homepage_packagedetail_new',);
                        }

                        // trip_rest_management_packagebookingsubmit
                        if ($pathinfo === '/api/get-packagebookingsubmit') {
                            return array (  '_controller' => 'Trip\\RestBundle\\Controller\\RestpackagesController::packagebookingsubmitAction',  '_route' => 'trip_rest_management_packagebookingsubmit',);
                        }

                    }

                }

                // trip_rest_management_Loginuserdetails
                if ($pathinfo === '/api/get-logindetail') {
                    return array (  '_controller' => 'Trip\\RestBundle\\Controller\\RestController::userLoginAction',  '_route' => 'trip_rest_management_Loginuserdetails',);
                }

            }

            // trip_rest_management_registeruser
            if ($pathinfo === '/api/user-register') {
                return array (  '_controller' => 'Trip\\RestBundle\\Controller\\RestController::registerAction',  '_route' => 'trip_rest_management_registeruser',);
            }

            // trip_rest_management_homepage_rentbikes
            if ($pathinfo === '/api/get-bikes') {
                return array (  '_controller' => 'Trip\\RestBundle\\Controller\\RestbikesController::bikesonRentAction',  '_route' => 'trip_rest_management_homepage_rentbikes',);
            }

        }

        // trip_security_sign_up
        if ($pathinfo === '/sign-up') {
            return array (  '_controller' => 'Trip\\SecurityBundle\\Controller\\SecurityLoginController::loginAction',  '_route' => 'trip_security_sign_up',);
        }

        // trip_site_management_add_vehicle
        if ($pathinfo === '/add/vehicle') {
            return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::addVehicleAction',  '_route' => 'trip_site_management_add_vehicle',);
        }

        // trip_site_management_edit_vehicle
        if (0 === strpos($pathinfo, '/edit') && preg_match('#^/edit/(?P<id>[^/]++)/vehicle$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'trip_site_management_edit_vehicle')), array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::editVehicleAction',));
        }

        if (0 === strpos($pathinfo, '/add')) {
            // trip_site_management_add_services
            if ($pathinfo === '/add/services') {
                return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::addServicesAction',  '_route' => 'trip_site_management_add_services',);
            }

            // trip_site_management_add_locations
            if ($pathinfo === '/add/locations') {
                return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::addLocationsAction',  '_route' => 'trip_site_management_add_locations',);
            }

        }

        // trip_site_management_hotels_list
        if ($pathinfo === '/hotels-list') {
            return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::hotelsListAction',  '_route' => 'trip_site_management_hotels_list',);
        }

        // trip_site_management_edit_hotel
        if (0 === strpos($pathinfo, '/edit') && preg_match('#^/edit/(?P<id>[^/]++)/hotel$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'trip_site_management_edit_hotel')), array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::editHotelAction',));
        }

        if (0 === strpos($pathinfo, '/add/package')) {
            // trip_site_management_add_package_price
            if ($pathinfo === '/add/package-price') {
                return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::addPackagePriceAction',  '_route' => 'trip_site_management_add_package_price',);
            }

            // trip_site_management_add_package
            if ($pathinfo === '/add/package') {
                return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::addPackageAction',  '_route' => 'trip_site_management_add_package',);
            }

        }

        // trip_site_management_package_list
        if ($pathinfo === '/package-list') {
            return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::packageListAction',  '_route' => 'trip_site_management_package_list',);
        }

        // trip_site_management_multipackage_list
        if ($pathinfo === '/multipackage-list') {
            return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::multipackageListAction',  '_route' => 'trip_site_management_multipackage_list',);
        }

        if (0 === strpos($pathinfo, '/edit')) {
            // trip_site_management_edit_package
            if (preg_match('#^/edit/(?P<id>[^/]++)/package$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'trip_site_management_edit_package')), array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::editPackageAction',));
            }

            // trip_site_management_edit_multipackage
            if (preg_match('#^/edit/(?P<id>[^/]++)/multipackage$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'trip_site_management_edit_multipackage')), array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::editMultiPackageAction',));
            }

            // trip_site_management_edit_itinerary
            if (preg_match('#^/edit/(?P<id>[^/]++)/itinerary$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'trip_site_management_edit_itinerary')), array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::editItineraryAction',));
            }

        }

        // trip_site_management_delete_itinerary
        if (0 === strpos($pathinfo, '/delete') && preg_match('#^/delete/(?P<id>[^/]++)/itinerary$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'trip_site_management_delete_itinerary')), array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::deleteItineraryAction',));
        }

        // trip_site_management_edit_package_content
        if (0 === strpos($pathinfo, '/edit') && preg_match('#^/edit/(?P<id>[^/]++)/packag\\-content$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'trip_site_management_edit_package_content')), array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::editPackageContentAction',));
        }

        // trip_site_management_delete_package_content
        if (0 === strpos($pathinfo, '/delete') && preg_match('#^/delete/(?P<id>[^/]++)/package\\-content$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'trip_site_management_delete_package_content')), array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::deletePackageContentAction',));
        }

        // trip_site_management_add_packagelocations
        if ($pathinfo === '/add/packagelocations') {
            return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::addPackageLocationsAction',  '_route' => 'trip_site_management_add_packagelocations',);
        }

        if (0 === strpos($pathinfo, '/package')) {
            if (0 === strpos($pathinfo, '/packages')) {
                // trip_site_management_homepage_packages_old
                if ($pathinfo === '/packages-old') {
                    return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::packagesAction',  '_route' => 'trip_site_management_homepage_packages_old',);
                }

                // trip_site_management_homepage_packages
                if ($pathinfo === '/packages') {
                    return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::multipackagesAction',  '_route' => 'trip_site_management_homepage_packages',);
                }

                // trip_site_management_homepage_special_packages
                if (preg_match('#^/packages/(?P<url>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'trip_site_management_homepage_special_packages')), array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::specialPackagesAction',));
                }

            }

            // trip_site_management_homepage_package_submit
            if ($pathinfo === '/package/submit') {
                return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::packageSubmitAction',  '_route' => 'trip_site_management_homepage_package_submit',);
            }

        }

        // trip_site_management_booking_search
        if ($pathinfo === '/booking-search') {
            return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::bookingSearchAction',  '_route' => 'trip_site_management_booking_search',);
        }

        if (0 === strpos($pathinfo, '/update-')) {
            // trip_site_management_booking_update_price
            if ($pathinfo === '/update-price') {
                return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::updatePriceAction',  '_route' => 'trip_site_management_booking_update_price',);
            }

            // trip_site_management_booking_update_service_price
            if ($pathinfo === '/update-service-price') {
                return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::updateServicePriceAction',  '_route' => 'trip_site_management_booking_update_service_price',);
            }

        }

        // trip_site_management_bookings
        if ($pathinfo === '/bookings') {
            return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::bookingsAction',  '_route' => 'trip_site_management_bookings',);
        }

        if (0 === strpos($pathinfo, '/exportB')) {
            // trip_site_management_export_bookings
            if ($pathinfo === '/exportBookings') {
                return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::exportBookingsAction',  '_route' => 'trip_site_management_export_bookings',);
            }

            // trip_site_management_export_billings
            if ($pathinfo === '/exportBillings') {
                return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::exportBillingsAction',  '_route' => 'trip_site_management_export_billings',);
            }

        }

        // trip_site_management_my_bookings
        if ($pathinfo === '/my-bookings') {
            return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::myBookingsAction',  '_route' => 'trip_site_management_my_bookings',);
        }

        if (0 === strpos($pathinfo, '/c')) {
            // trip_site_management_cancel
            if ($pathinfo === '/cancel-booking') {
                return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::cancelAction',  '_route' => 'trip_site_management_cancel',);
            }

            // trip_site_management_change_status
            if ($pathinfo === '/change-status') {
                return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::changeStatusAction',  '_route' => 'trip_site_management_change_status',);
            }

        }

        // trip_site_management_verify_booking
        if ($pathinfo === '/verify-bookings') {
            return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::cancelVerifyAction',  '_route' => 'trip_site_management_verify_booking',);
        }

        // trip_site_management_cancel_sucess
        if ($pathinfo === '/cancel-sucess') {
            return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::cancelConfirmAction',  '_route' => 'trip_site_management_cancel_sucess',);
        }

        // trip_site_management_users
        if ($pathinfo === '/users') {
            return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::userListAction',  '_route' => 'trip_site_management_users',);
        }

        if (0 === strpos($pathinfo, '/contact')) {
            // trip_site_management_contactList
            if ($pathinfo === '/contact-list') {
                return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::contactListAction',  '_route' => 'trip_site_management_contactList',);
            }

            // trip_site_management_contact
            if ($pathinfo === '/contact') {
                return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::contactAction',  '_route' => 'trip_site_management_contact',);
            }

        }

        // trip_site_management_about
        if ($pathinfo === '/aboutUs') {
            return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::aboutUsAction',  '_route' => 'trip_site_management_about',);
        }

        // trip_site_management_terms
        if ($pathinfo === '/privacy-policy') {
            return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::termsAction',  '_route' => 'trip_site_management_terms',);
        }

        // trip_site_management_faq
        if ($pathinfo === '/faq') {
            return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::faqAction',  '_route' => 'trip_site_management_faq',);
        }

        if (0 === strpos($pathinfo, '/view-')) {
            // trip_site_management_view_package
            if (0 === strpos($pathinfo, '/view-package') && preg_match('#^/view\\-package/(?P<url>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'trip_site_management_view_package')), array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::viewPackageAction',));
            }

            // trip_site_management_view_hotel
            if (0 === strpos($pathinfo, '/view-hotel') && preg_match('#^/view\\-hotel/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'trip_site_management_view_hotel')), array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::viewHotelAction',));
            }

        }

        if (0 === strpos($pathinfo, '/billing-')) {
            // trip_site_management_billing_details
            if ($pathinfo === '/billing-details') {
                return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::billingDetailsAction',  '_route' => 'trip_site_management_billing_details',);
            }

            // trip_site_management_billing_list
            if ($pathinfo === '/billing-list') {
                return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::billingListAction',  '_route' => 'trip_site_management_billing_list',);
            }

        }

        // trip_site_management_insert_image
        if (rtrim($pathinfo, '/') === '/insert-image') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'trip_site_management_insert_image');
            }

            return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::insertImageAction',  '_route' => 'trip_site_management_insert_image',);
        }

        // trip_site_management_view_image
        if ($pathinfo === '/view-image') {
            return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::viewImagesAction',  '_route' => 'trip_site_management_view_image',);
        }

        // trip_site_management_addPackageImage
        if ($pathinfo === '/addPackageImage') {
            return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::addPackageImageAction',  '_route' => 'trip_site_management_addPackageImage',);
        }

        // trip_site_management_delete_image
        if ($pathinfo === '/delete-image') {
            return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::deleteImagePackageAction',  '_route' => 'trip_site_management_delete_image',);
        }

        // trip_site_management_bikes_on_rent
        if ($pathinfo === '/bikes') {
            return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::bikesonRentAction',  '_route' => 'trip_site_management_bikes_on_rent',);
        }

        // trip_site_management_view_bikes
        if (0 === strpos($pathinfo, '/tirupati') && preg_match('#^/tirupati/(?P<url>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'trip_site_management_view_bikes')), array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::viewBikesAction',));
        }

        // trip_site_management_review_viewbikes
        if ($pathinfo === '/review-view-bikes') {
            return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::reviewViewbikesAction',  '_route' => 'trip_site_management_review_viewbikes',);
        }

        // trip_site_management_price_viewbikes
        if (0 === strpos($pathinfo, '/price') && preg_match('#^/price/(?P<id>[^/]++)/view\\-bikes$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'trip_site_management_price_viewbikes')), array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::priceViewbikesAction',));
        }

        // trip_site_management_homepage_bikes_submit
        if ($pathinfo === '/bike/submit') {
            return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::bikesSubmitAction',  '_route' => 'trip_site_management_homepage_bikes_submit',);
        }

        if (0 === strpos($pathinfo, '/twoday-packages')) {
            // trip_site_management_homepage_twoday_packages
            if ($pathinfo === '/twoday-packages') {
                return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::twodaypackagesAction',  '_route' => 'trip_site_management_homepage_twoday_packages',);
            }

            // trip_site_management_homepage_twospecial_packages
            if (preg_match('#^/twoday\\-packages/(?P<url>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'trip_site_management_homepage_twospecial_packages')), array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::twospecialPackagesAction',));
            }

        }

        if (0 === strpos($pathinfo, '/add')) {
            // trip_site_management_add_multipackage
            if ($pathinfo === '/add-multipackage') {
                return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::addMultiPackageAction',  '_route' => 'trip_site_management_add_multipackage',);
            }

            // trip_site_management_add_twoday_packagelocations
            if ($pathinfo === '/addtwoday/packagelocations') {
                return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::addtwodayPackageLocationsAction',  '_route' => 'trip_site_management_add_twoday_packagelocations',);
            }

        }

        // trip_site_management_add_packagecat
        if ($pathinfo === '/package-cat') {
            return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::addPackagecatAction',  '_route' => 'trip_site_management_add_packagecat',);
        }

        // trip_site_management_homepage_catpackage_submit
        if ($pathinfo === '/catpackage/submit') {
            return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::catpackageSubmitAction',  '_route' => 'trip_site_management_homepage_catpackage_submit',);
        }

        // trip_site_management_homepage_packagedetails_submit
        if ($pathinfo === '/packagedetails/submit') {
            return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::packagedetailsSubmitAction',  '_route' => 'trip_site_management_homepage_packagedetails_submit',);
        }

        // trip_site_management_homepage_addPackage_details
        if ($pathinfo === '/addPackagedetails') {
            return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::addPackagedetailsAction',  '_route' => 'trip_site_management_homepage_addPackage_details',);
        }

        // trip_site_management_bikes_terms
        if ($pathinfo === '/privacy-policy-bikes') {
            return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::bikestermsAction',  '_route' => 'trip_site_management_bikes_terms',);
        }

        // trip_site_management_hotel_book_room
        if ($pathinfo === '/book-room') {
            return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::bookRoomAction',  '_route' => 'trip_site_management_hotel_book_room',);
        }

        // trip_sitemanagementbundle_room_confirm
        if ($pathinfo === '/confirm-room') {
            return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::confirmRoomAction',  '_route' => 'trip_sitemanagementbundle_room_confirm',);
        }

        // trip_sitemanagementbundle_add_hotel
        if ($pathinfo === '/add-hotel') {
            return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::addHotelAction',  '_route' => 'trip_sitemanagementbundle_add_hotel',);
        }

        // trip_sitemanagementbundle_delete_hotel
        if (0 === strpos($pathinfo, '/delete') && preg_match('#^/delete/(?P<id>[^/]++)/hotel$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'trip_sitemanagementbundle_delete_hotel')), array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::deleteHotelAction',));
        }

        // trip_sitemanagementbundle_delete_hotelRoom
        if (preg_match('#^/(?P<id>[^/]++)/delete\\-hotelroom$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'trip_sitemanagementbundle_delete_hotelRoom')), array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::deleteHotelRoomAction',));
        }

        // trip_sitemanagementbundle_delete_hotelImage
        if (preg_match('#^/(?P<id>[^/]++)/delete\\-hotelimage$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'trip_sitemanagementbundle_delete_hotelImage')), array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::deleteHotelImageAction',));
        }

        // trip_site_management_edit_bikes
        if (0 === strpos($pathinfo, '/edit') && preg_match('#^/edit/(?P<id>[^/]++)/bikes$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'trip_site_management_edit_bikes')), array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::editBikesAction',));
        }

        // trip_site_management_bikes_list
        if ($pathinfo === '/bikes-list') {
            return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::bikesListAction',  '_route' => 'trip_site_management_bikes_list',);
        }

        // trip_site_management_add_bike
        if ($pathinfo === '/add-bike') {
            return array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::addBikeAction',  '_route' => 'trip_site_management_add_bike',);
        }

        // trip_site_management_delete_packageImage
        if (preg_match('#^/(?P<id>[^/]++)/delete\\-packageimage$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'trip_site_management_delete_packageImage')), array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::deletePackageImageAction',));
        }

        // trip_site_management_view_twoday_package
        if (0 === strpos($pathinfo, '/view-twoday-package') && preg_match('#^/view\\-twoday\\-package/(?P<url>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'trip_site_management_view_twoday_package')), array (  '_controller' => 'Trip\\SiteManagementBundle\\Controller\\SiteManagementController::viewtwodayPackageAction',));
        }

        // trip_site_management_homepage
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'trip_site_management_homepage');
            }

            return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::indexAction',  '_route' => 'trip_site_management_homepage',);
        }

        // trip_site_management_homepage_hotels
        if ($pathinfo === '/hotels') {
            return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::hotelsAction',  '_route' => 'trip_site_management_homepage_hotels',);
        }

        // trip_site_management_homepage_deals
        if ($pathinfo === '/deals') {
            return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::dealsAction',  '_route' => 'trip_site_management_homepage_deals',);
        }

        if (0 === strpos($pathinfo, '/search')) {
            // trip_booking_engine_search
            if ($pathinfo === '/search') {
                return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::searchAction',  '_route' => 'trip_booking_engine_search',);
            }

            // trip_booking_engine_search_hotel
            if ($pathinfo === '/searchHotel') {
                return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::searchHotelAction',  '_route' => 'trip_booking_engine_search_hotel',);
            }

        }

        if (0 === strpos($pathinfo, '/book')) {
            // trip_booking_engine_book
            if ($pathinfo === '/book') {
                return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::bookAction',  '_route' => 'trip_booking_engine_book',);
            }

            // trip_booking_engine_book_submit
            if ($pathinfo === '/book/submit') {
                return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::bookSubmitAction',  '_route' => 'trip_booking_engine_book_submit',);
            }

            // trip_booking_engine_payment
            if ($pathinfo === '/book/payment') {
                return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::paymentAction',  '_route' => 'trip_booking_engine_payment',);
            }

        }

        // trip_booking_engine_success
        if ($pathinfo === '/success') {
            return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::successAction',  '_route' => 'trip_booking_engine_success',);
        }

        // trip_booking_engine_confirm
        if ($pathinfo === '/confirm') {
            return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::confirmAction',  '_route' => 'trip_booking_engine_confirm',);
        }

        // trip_booking_engine_payment_payu
        if ($pathinfo === '/payu') {
            return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::payuAction',  '_route' => 'trip_booking_engine_payment_payu',);
        }

        // trip_booking_engine_apply_coupon
        if ($pathinfo === '/applyCoupon') {
            return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::applyCouponAction',  '_route' => 'trip_booking_engine_apply_coupon',);
        }

        // trip_booking_engine_customPackage
        if ($pathinfo === '/custom-package') {
            return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::customPackageAction',  '_route' => 'trip_booking_engine_customPackage',);
        }

        // trip_booking_engine_testcustomPackage
        if ($pathinfo === '/test-billing-dateails') {
            return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::testCustomPackageAction',  '_route' => 'trip_booking_engine_testcustomPackage',);
        }

        // trip_booking_engine_review_custom_package
        if (0 === strpos($pathinfo, '/review') && preg_match('#^/review/(?P<id>[^/]++)/custom\\-package$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'trip_booking_engine_review_custom_package')), array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::reviewCustomPackageAction',));
        }

        if (0 === strpos($pathinfo, '/edit')) {
            // trip_booking_engine_edit_customer_details
            if (preg_match('#^/edit/(?P<id>[^/]++)/customer\\-details$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'trip_booking_engine_edit_customer_details')), array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::editCustomerDetailsAction',));
            }

            // trip_booking_engine_edit_custom_package
            if (preg_match('#^/edit/(?P<id>[^/]++)/custom\\-package$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'trip_booking_engine_edit_custom_package')), array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::editCustomPackageAction',));
            }

        }

        // trip_booking_engine_confirm_custom_package
        if (0 === strpos($pathinfo, '/confirm') && preg_match('#^/confirm/(?P<id>[^/]++)/custom\\-package$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'trip_booking_engine_confirm_custom_package')), array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::confirmCustomPackageAction',));
        }

        // trip_booking_engine_hotel_booking
        if ($pathinfo === '/hotel-booking') {
            return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::hotelBookingAction',  '_route' => 'trip_booking_engine_hotel_booking',);
        }

        // trip_booking_engine_vendor_registraion_form
        if ($pathinfo === '/vendor-registraion-form') {
            return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::vendorRegistraionAction',  '_route' => 'trip_booking_engine_vendor_registraion_form',);
        }

        // trip_booking_engine_vendor_login
        if ($pathinfo === '/test-vendor-login') {
            return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::vendorLoginAction',  '_route' => 'trip_booking_engine_vendor_login',);
        }

        // trip_booking_engine_test_vendor_login
        if ($pathinfo === '/partner-with-us') {
            return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::vendorTestLoginAction',  '_route' => 'trip_booking_engine_test_vendor_login',);
        }

        if (0 === strpos($pathinfo, '/test-vendor-')) {
            // trip_booking_engine_test_vendor_password
            if ($pathinfo === '/test-vendor-password') {
                return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::vendorTestPasswordAction',  '_route' => 'trip_booking_engine_test_vendor_password',);
            }

            // trip_booking_engine_test_vendor_success
            if ($pathinfo === '/test-vendor-success') {
                return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::vendorTestSuccessAction',  '_route' => 'trip_booking_engine_test_vendor_success',);
            }

        }

        if (0 === strpos($pathinfo, '/vendor-')) {
            // trip_booking_engine_vendor_confirm_login
            if ($pathinfo === '/vendor-confirm-login') {
                return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::vendorConfirmLoginAction',  '_route' => 'trip_booking_engine_vendor_confirm_login',);
            }

            // trip_booking_engine_vendor_validate_login
            if ($pathinfo === '/vendor-validate-login') {
                return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::vendorValidateLoginAction',  '_route' => 'trip_booking_engine_vendor_validate_login',);
            }

            if (0 === strpos($pathinfo, '/vendor-reset-p')) {
                // trip_booking_engine_vendor_reset_password
                if ($pathinfo === '/vendor-reset-password') {
                    return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::vendorResetPasswordAction',  '_route' => 'trip_booking_engine_vendor_reset_password',);
                }

                // trip_booking_engine_vendor_reset_pwd_validation
                if ($pathinfo === '/vendor-reset-pwdvalidation') {
                    return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::vendorResetPasswordValidationAction',  '_route' => 'trip_booking_engine_vendor_reset_pwd_validation',);
                }

            }

            // trip_booking_engine_vendor_profile
            if ($pathinfo === '/vendor-profile') {
                return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::vendorProfileAction',  '_route' => 'trip_booking_engine_vendor_profile',);
            }

            if (0 === strpos($pathinfo, '/vendor-edit-')) {
                // trip_booking_engine_vendor_edit_login
                if ($pathinfo === '/vendor-edit-login') {
                    return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::vendorEditLoginAction',  '_route' => 'trip_booking_engine_vendor_edit_login',);
                }

                // trip_booking_engine_vendor_edit_validate_login
                if ($pathinfo === '/vendor-edit-validate-login') {
                    return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::vendorEditValidateLoginAction',  '_route' => 'trip_booking_engine_vendor_edit_validate_login',);
                }

            }

            if (0 === strpos($pathinfo, '/vendor-add-')) {
                // trip_booking_engine_vendor_add_vehicle
                if ($pathinfo === '/vendor-add-vehicle') {
                    return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::vendorAddVehicleAction',  '_route' => 'trip_booking_engine_vendor_add_vehicle',);
                }

                // trip_booking_engine_vendor_add_driver
                if ($pathinfo === '/vendor-add-driver') {
                    return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::vendorAddDriverAction',  '_route' => 'trip_booking_engine_vendor_add_driver',);
                }

            }

            if (0 === strpos($pathinfo, '/vendor-list-')) {
                // trip_booking_engine_vendor_list_vehicles
                if ($pathinfo === '/vendor-list-vehicles') {
                    return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::vendorListVehiclesAction',  '_route' => 'trip_booking_engine_vendor_list_vehicles',);
                }

                // trip_booking_engine_vendor_list_drivers
                if ($pathinfo === '/vendor-list-drivers') {
                    return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::vendorListDriversAction',  '_route' => 'trip_booking_engine_vendor_list_drivers',);
                }

            }

            // trip_booking_engine_vendor_edit_driver
            if ($pathinfo === '/vendor-edit-driver') {
                return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::vendorEditDriverAction',  '_route' => 'trip_booking_engine_vendor_edit_driver',);
            }

            if (0 === strpos($pathinfo, '/vendor-remove-')) {
                // trip_booking_engine_vendor_remove_driver
                if ($pathinfo === '/vendor-remove-driver') {
                    return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::vendorRemoveDriverAction',  '_route' => 'trip_booking_engine_vendor_remove_driver',);
                }

                // trip_booking_engine_vendor_remove_vehicle
                if ($pathinfo === '/vendor-remove-vehicle') {
                    return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::vendorRemoveVehicleAction',  '_route' => 'trip_booking_engine_vendor_remove_vehicle',);
                }

            }

            // trip_booking_engine_vendor_edit_vendor
            if ($pathinfo === '/vendor-edit-profile') {
                return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::vendorEditProfileAction',  '_route' => 'trip_booking_engine_vendor_edit_vendor',);
            }

        }

        // trip_booking_engine_booking_bike
        if ($pathinfo === '/booking-bike') {
            return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::bookingBikeAction',  '_route' => 'trip_booking_engine_booking_bike',);
        }

        // trip_booking_engine_confirm_bike
        if ($pathinfo === '/confirm-bike') {
            return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::confirmBikeAction',  '_route' => 'trip_booking_engine_confirm_bike',);
        }

        if (0 === strpos($pathinfo, '/book')) {
            // trip_booking_engine_book_bike_submit
            if ($pathinfo === '/book/bike/submit') {
                return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::bookbikeSubmitAction',  '_route' => 'trip_booking_engine_book_bike_submit',);
            }

            // trip_booking_engine_payment_bike
            if ($pathinfo === '/book/payment-bike') {
                return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::paymentBikeAction',  '_route' => 'trip_booking_engine_payment_bike',);
            }

        }

        // remove_trailing_slash
        if (preg_match('#^/(?P<url>.*/)$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_remove_trailing_slash;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'remove_trailing_slash')), array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::removeTrailingSlashAction',));
        }
        not_remove_trailing_slash:

        if (0 === strpos($pathinfo, '/vendor-')) {
            if (0 === strpos($pathinfo, '/vendor-payment')) {
                // trip_booking_engine_vendor_payment
                if ($pathinfo === '/vendor-payment') {
                    return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::vendorPaymentAction',  '_route' => 'trip_booking_engine_vendor_payment',);
                }

                if (0 === strpos($pathinfo, '/vendor-payment-')) {
                    // trip_booking_engine_vendor_payment_success
                    if ($pathinfo === '/vendor-payment-success') {
                        return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::vendorPaymentSuccessAction',  '_route' => 'trip_booking_engine_vendor_payment_success',);
                    }

                    // trip_booking_engine_vendor_payment_fail
                    if ($pathinfo === '/vendor-payment-fail') {
                        return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::vendorPaymentFailAction',  '_route' => 'trip_booking_engine_vendor_payment_fail',);
                    }

                }

            }

            if (0 === strpos($pathinfo, '/vendor-list')) {
                // trip_booking_engine_vendor_list
                if ($pathinfo === '/vendor-list') {
                    return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::vendorListAction',  '_route' => 'trip_booking_engine_vendor_list',);
                }

                // trip_booking_engine_vendor_list_view_more
                if ($pathinfo === '/vendor-list-view -more') {
                    return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::vendorListViewMoreAction',  '_route' => 'trip_booking_engine_vendor_list_view_more',);
                }

            }

        }

        if (0 === strpos($pathinfo, '/hotel-')) {
            // trip_booking_engine_hotel_book_room
            if ($pathinfo === '/hotel-book-room') {
                return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::hotelBookRoomAction',  '_route' => 'trip_booking_engine_hotel_book_room',);
            }

            // trip_booking_engine_hotel_filter
            if ($pathinfo === '/hotel-filter') {
                return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::hotelFilterAction',  '_route' => 'trip_booking_engine_hotel_filter',);
            }

        }

        if (0 === strpos($pathinfo, '/add-')) {
            // trip_booking_engine_add_room
            if ($pathinfo === '/add-room') {
                return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::addRoomAction',  '_route' => 'trip_booking_engine_add_room',);
            }

            // trip_booking_engine_add_adults
            if ($pathinfo === '/add-adults') {
                return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::addAdultsAction',  '_route' => 'trip_booking_engine_add_adults',);
            }

            // trip_booking_engine_add_childs
            if ($pathinfo === '/add-child') {
                return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::addChildsAction',  '_route' => 'trip_booking_engine_add_childs',);
            }

        }

        // trip_booking_engine_update_room
        if ($pathinfo === '/update-room') {
            return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::updateRommsAction',  '_route' => 'trip_booking_engine_update_room',);
        }

        // trip_booking_engine_hotel_book_submit
        if ($pathinfo === '/book/hotel/submit') {
            return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::bookHotelSubmitAction',  '_route' => 'trip_booking_engine_hotel_book_submit',);
        }

        // trip_hotel_booking_engine_success
        if ($pathinfo === '/hotel/success') {
            return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\BookingController::hotelPaymentSuccessAction',  '_route' => 'trip_hotel_booking_engine_success',);
        }

        // trip_hotel_add_coupon_code
        if ($pathinfo === '/add-coupon-code') {
            return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\CouponController::addCouponAction',  '_route' => 'trip_hotel_add_coupon_code',);
        }

        // trip_hotel_list_coupon_code
        if ($pathinfo === '/coupon-code-list') {
            return array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\CouponController::couponListAction',  '_route' => 'trip_hotel_list_coupon_code',);
        }

        // trip_hotel_edit_coupon_code
        if (preg_match('#^/(?P<id>[^/]++)/coupon\\-code\\-edit$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'trip_hotel_edit_coupon_code')), array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\CouponController::couponEditAction',));
        }

        // trip_hotel_delete_coupon_code
        if (preg_match('#^/(?P<id>[^/]++)/coupon\\-code\\-delete$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'trip_hotel_delete_coupon_code')), array (  '_controller' => 'Trip\\BookingEngineBundle\\Controller\\CouponController::couponDeleteAction',));
        }

        // trip_booking_engine_admin_apply_coupon
        if ($pathinfo === '/admin-apply') {
            return array (  '_controller' => 'RoomBookingEngineBundle:Booking:adminapplyCoupon',  '_route' => 'trip_booking_engine_admin_apply_coupon',);
        }

        // fos_user_security_login
        if (preg_match('#^/(?P<_locale>[^/]++)/login$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_fos_user_security_login;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_security_login')), array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::loginAction',));
        }
        not_fos_user_security_login:

        // fos_user_security_check
        if (preg_match('#^/(?P<_locale>[^/]++)/login_check$#s', $pathinfo, $matches)) {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_fos_user_security_check;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_security_check')), array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::checkAction',));
        }
        not_fos_user_security_check:

        // fos_user_security_logout
        if (preg_match('#^/(?P<_locale>[^/]++)/logout$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_fos_user_security_logout;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_security_logout')), array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::logoutAction',));
        }
        not_fos_user_security_logout:

        // fos_user_profile_show
        if (preg_match('#^/(?P<_locale>[^/]++)/profile/?$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_fos_user_profile_show;
            }

            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'fos_user_profile_show');
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_profile_show')), array (  '_controller' => 'FOS\\UserBundle\\Controller\\ProfileController::showAction',));
        }
        not_fos_user_profile_show:

        // fos_user_profile_edit
        if (preg_match('#^/(?P<_locale>[^/]++)/profile/edit$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_fos_user_profile_edit;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_profile_edit')), array (  '_controller' => 'FOS\\UserBundle\\Controller\\ProfileController::editAction',));
        }
        not_fos_user_profile_edit:

        // fos_user_registration_register
        if (preg_match('#^/(?P<_locale>[^/]++)/register/?$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_fos_user_registration_register;
            }

            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'fos_user_registration_register');
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_registration_register')), array (  '_controller' => 'Trip\\SecurityBundle\\Controller\\RegistrationController::registerAction',));
        }
        not_fos_user_registration_register:

        // fos_user_registration_check_email
        if (preg_match('#^/(?P<_locale>[^/]++)/register/check\\-email$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_fos_user_registration_check_email;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_registration_check_email')), array (  '_controller' => 'Trip\\SecurityBundle\\Controller\\RegistrationController::checkEmailAction',));
        }
        not_fos_user_registration_check_email:

        // fos_user_registration_confirm
        if (preg_match('#^/(?P<_locale>[^/]++)/register/confirm/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_fos_user_registration_confirm;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_registration_confirm')), array (  '_controller' => 'Trip\\SecurityBundle\\Controller\\RegistrationController::confirmAction',));
        }
        not_fos_user_registration_confirm:

        // fos_user_registration_confirmed
        if (preg_match('#^/(?P<_locale>[^/]++)/register/confirmed$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_fos_user_registration_confirmed;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_registration_confirmed')), array (  '_controller' => 'Trip\\SecurityBundle\\Controller\\RegistrationController::confirmedAction',));
        }
        not_fos_user_registration_confirmed:

        // fos_user_resetting_request
        if (preg_match('#^/(?P<_locale>[^/]++)/resetting/request$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_fos_user_resetting_request;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_resetting_request')), array (  '_controller' => 'Trip\\SecurityBundle\\Controller\\ResettingController::requestAction',));
        }
        not_fos_user_resetting_request:

        // fos_user_resetting_send_email
        if (preg_match('#^/(?P<_locale>[^/]++)/resetting/send\\-email$#s', $pathinfo, $matches)) {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_fos_user_resetting_send_email;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_resetting_send_email')), array (  '_controller' => 'Trip\\SecurityBundle\\Controller\\ResettingController::sendEmailAction',));
        }
        not_fos_user_resetting_send_email:

        // fos_user_resetting_check_email
        if (preg_match('#^/(?P<_locale>[^/]++)/resetting/check\\-email$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_fos_user_resetting_check_email;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_resetting_check_email')), array (  '_controller' => 'Trip\\SecurityBundle\\Controller\\ResettingController::checkEmailAction',));
        }
        not_fos_user_resetting_check_email:

        // fos_user_resetting_reset
        if (preg_match('#^/(?P<_locale>[^/]++)/resetting/reset/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_fos_user_resetting_reset;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_resetting_reset')), array (  '_controller' => 'Trip\\SecurityBundle\\Controller\\ResettingController::resetAction',));
        }
        not_fos_user_resetting_reset:

        // fos_user_change_password
        if (preg_match('#^/(?P<_locale>[^/]++)/profile/change\\-password$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_fos_user_change_password;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_change_password')), array (  '_controller' => 'FOS\\UserBundle\\Controller\\ChangePasswordController::changePasswordAction',));
        }
        not_fos_user_change_password:

        // _security_check
        if (preg_match('#^/(?P<_locale>[^/]++)/login_check$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => '_security_check')), array ());
        }

        // _security_logout
        if (preg_match('#^/(?P<_locale>[^/]++)/logout$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => '_security_logout')), array ());
        }

        // fos_facebook_channel
        if ($pathinfo === '/channel.html') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_fos_facebook_channel;
            }

            return array (  '_controller' => 'FOS\\FacebookBundle\\Controller\\FacebookController::channelAction',  '_route' => 'fos_facebook_channel',);
        }
        not_fos_facebook_channel:

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
