<?php
/**
 * ZfcUser Configuration
 *
 * If you have a ./config/autoload/ directory set up for your project, you can
 * drop this config file in it and change the values as you wish.
 */
$settings = array(
    /**
     * Registration Form Captcha
     *
     * Determines if a captcha should be utilized on the user registration form.
     * Default value is false.
     */
    'use_registration_form_captcha' => false,

    /**
     * Form Captcha Options
     *
     * Currently used for the registration form, but re-usable anywhere. Use
     * this to configure which Zend\Captcha adapter to use, and the options to
     * pass to it. The default uses the Figlet captcha.
     */
    'form_captcha_options' => array(
        'class'   => 'figlet',
        'options' => array(
            'wordLen'    => 5,
            'expiration' => 300,
            'timeout'    => 300,
        ),
    ),

    /**
     * Login Redirect Route
     *
     * Upon successful login the user will be redirected to the entered route
     *
     * Default value: 'zfcuser'
     * Accepted values: A valid route name within your application or a callback.
     *                  If callback used, it will receive the identity as the param
     *
     */
    'login_redirect_route' => 'home',

    /**
     * Logout Redirect Route
     *
     * Upon logging out the user will be redirected to the enterd route
     *
     * Default value: 'zfcuser/login'
     * Accepted values: A valid route name within your application
     */
    'logout_redirect_route' => 'home',
);

/**
 * You do not need to edit below this line
 */
return array(
    'zfcuser' => $settings,
    'service_manager' => array(
        'aliases' => array(
            'zfcuser_zend_db_adapter' => (isset($settings['zend_db_adapter'])) ? $settings['zend_db_adapter']: 'Zend\Db\Adapter\Adapter',
        ),
    ),
);
