/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
(function() {
    window.onload = () => {
        var i = 0;
            aList = document.querySelectorAll('a.webinse-faq3-remove'),
            length = aList.length;

        for(; i < length;) {
            aList[i++].onclick = () => {
                return confirm('Are you shure?') ? true : false;
            };
        }
    };
}());