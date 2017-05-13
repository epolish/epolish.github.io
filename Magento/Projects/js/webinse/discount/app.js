/**
 * Comment for file
 *
 * @category	design
 * @package 	Webinse_Discount
 * @author  	Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license 	http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
(function() {
    document.addEventListener("DOMContentLoaded", function() {
        var qtyPproducts = this.getElementById("qty_products"),
            itemPrice = this.getElementById("item_price"),
            calculate = this.getElementById("calculate"),
            subtotal = this.getElementById("subtotal"),
            valid = function() {
                return parseInt(qtyPproducts.value) && parseInt(itemPrice.value);
            },
            product = function() {
                subtotal.value = valid() ? qtyPproducts.value*itemPrice.value : "Not valid price or qty.";
            };

        calculate.value = "Calculate";
        calculate.onclick = product;
        qtyPproducts.oninput = product;
        itemPrice.oninput = product;
    });
}());