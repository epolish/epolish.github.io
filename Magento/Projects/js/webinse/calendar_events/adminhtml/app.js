/**
 * Comment for file
 *
 * @category	design
 * @package 	Webinse_CalendarEvents
 * @author  	Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license 	http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
(function() {
    document.addEventListener('DOMContentLoaded', function() {
        var getById = document.querySelector.bind(document),
            inputs = [
                getById('input[id $= background_current]'),
                getById('input[id $= background]'),
                getById('input[id $= text_color]')
            ];
        for(var i = 0, length = inputs.length; i < length; i++) {
            (new CP(inputs[i])).on("change", function(color) {
                this.target.value = '#' + color;
            });
        }
    });
}());