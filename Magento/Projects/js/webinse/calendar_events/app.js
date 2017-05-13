/**
 * Comment for file
 *
 * @category	design
 * @package 	Webinse_CalendarEvents
 * @author  	Webinse Team <info@webinse.com>
 * @copyright   2017 Webinse Ltd. (https://www.webinse.com)
 * @license 	http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0
 */
(function($) {
    $(function() {
        var protocol = window.location.protocol,
            host = window.location.host,
            url = protocol + '//' + host + '/',
            getRandomColor = function() {
                var letters = '0123456789ABCDEF',
                    color = '#';
                for (var i = 0; i < 6; i++ ) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }
        prepareEvents = function(events) {
            var eventArray = [];
            $.each(events, function(index, item) {
                eventArray.push({
                    id: item.page_id,
                    title: item.title,
                    start: item.from_date,
                    end: item.to_date,
                    editable: false,
                    backgroundColor: getRandomColor()
                });
            });
            return eventArray;
        };
        $.get(url + 'calendarevents/index/getjsondata', function(events) {
            $('#calendar, #webinse-widget').fullCalendar({
                defaultDate: '2017-03-12',
                editable: true,
                eventLimit: true,
                events: prepareEvents(events.items)
            });
            $.get(url + 'calendarevents/index/getjsonconfigdata', function(configData) {
                console.log(configData);
                $('.fc-today').css('background', configData.background_current);
                $('#calendar, #webinse-widget').css('background', configData.background);
                $('#calendar, #webinse-widget').css('font-size', configData.text_size + '%');
                $('#calendar h2, #webinse-widget h2').css('color', configData.text_color);
                $('#calendar h2, #webinse-widget h2').css('font-family', configData.text_font);
            });
        });
    });
}(jQuery));