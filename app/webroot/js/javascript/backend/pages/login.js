/* ========================================================================
 * login.js
 * Page/renders: page-login.html
 * Plugins used: parsley
 * ======================================================================== */

'use strict';

(function (factory) {
    if (typeof define === 'function' && define.amd) {
        define([
            'parsley'
        ], factory);
    } else {
        factory();
    }
}(function () {

    $(function () {
        // Login form function
        // ================================
        var $form = $('form[name=form-login]');

        // On button submit click
        $form.on('click', 'button[type=submit]', function (e) {
            var $this = $(this);

            // Run parsley validation
            if ($form.parsley().validate()) {
                jQuery("#spin-cargando-login").addClass('show');
                setTimeout(function ()
                {
                    $form.submit();
                    //jQuery("#spin-cargando-login").removeClass('show');
                }, 1500);
            } else {
                // toggle animation
                $form
                        .removeClass('animation animating shake')
                        .addClass('animation animating shake')
                        .one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                            $(this).removeClass('animation animating shake');
                        });
            }
            // prevent default
            e.preventDefault();
        });
    });

}));