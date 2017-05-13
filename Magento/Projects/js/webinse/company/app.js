/**
 * Comment for file
 *
 * @category	design
 * @package 	Webinse_Company
 * @author  	Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license 	http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
(function($) {
    $(function() {
        var cookieName = 'webinse_company_checkout_mode';

        if(typeof $.cookie(cookieName) != 'undefined') {
            billing.save();
        }

        $('#billing\\:use_for_shipping_yes').parent().css('display', 'none');
        $('#billing\\:use_for_shipping_no').parent().css('display', 'none');
        $('#shipping\\:same_as_billing').parent().css('display', 'none');
        $('#billing-buttons-container button').on('click', function() {
            if(typeof $(this).attr('disabled') != 'undefined') {
                $.cookie(cookieName, '1', {expires : 1});
            } else {
                $.removeCookie(cookieName);
            }
        });
    });
}(jQuery));