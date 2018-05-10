jQuery(document).ready(function($) {
    function getStringID(arr) {
        let str = '';
        arr.forEach((a, b) => {
            str += b !== arr.length - 1
                ? a.recipe_id + '%2C'
                : a.recipe_id;
        })
        return str;
    }

    function fetchData(id) {
        return $.ajax({
            url: `https://spoonacular-recipe-food-nutrition-v1.p.mashape.com/recipes/informationBulk?ids=${id}&includeNutrition=true`,
            headers: {
                'X-Mashape-Key': 'yVNtwOy4YwmshW4SiqM6RgMT9S7ep1oWIcbjsnIe4j5rd3ZqiX',
                'Accept': 'application/json'
            }
        });
    }
    function round(price) {
        return Math.round(price * 100) / 100;
    }
    function displayCost(params, days, d) {
        let weekCost = 0;
        let weekCal = 0;
        params.forEach((a, b) => {
            if (a) {
                let data = [];
                let daysArr = JSON.parse(d[days[b]]);
                let recipeArr = a[0];
                let dayCost = 0;
                let dayCal = 0;
                recipeArr.forEach((x, y) => {

                    dayCost += x.pricePerServing * daysArr[y].quantity / 100;
                    dayCal += x.nutrition.nutrients[0].amount * daysArr[y].quantity ;
                    data.push({title:x.title,price:dayCost,calorie:dayCal})
                })
                dayCost = round(dayCost);
                weekCost += dayCost;
                weekCal += dayCal;
                $(`#${days[b]}`).html(`
                <li class="single-event" data-start="09:00" data-end="11:00" data-content="event-rowing-as" data-event="event-2">
                    <a href="#0">
                        <em class="event-name" style="font-size:2rem">Summary</em>
                        <em style="font-size:1.5rem;color:aqua">Cost: $ ${dayCost}</em><br/>
                        <em style="font-size:1.5rem;color:aqua">Calories: ${dayCal} cal</em>
                    </a>
                </li>`)
            }
        })
        return [weekCost,weekCal];
    }

    $.post('/assets/php/recentWeek.php', e => {
        let days = [
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
            'Sunday'
        ];
        let ajaxCall = [];
        let weekNo = `Week ${e}`;
        $.post('/assets/php/getRecipeID.php', function(d) {
            d = JSON.parse(d);
            days.forEach((day, i) => {
                let query = getStringID(JSON.parse(d[day]));
                if (query !== '') {
                    ajaxCall[i] = fetchData(query);
                }
            })

            $.when.apply($, ajaxCall).then(function(...params) {

                if (ajaxCall.length === 1) { // MOnday only case
                    // let quantityArr = JSON.parse(d[days[0]]);
                    // let recipeArr = a[0];
                    //
                    let temp = new Array();
                    temp[0] = params;
                    params = temp;

                }
                let data = displayCost(params, days, d);

                $('#weekNo').text(weekNo);
                let weekCost = data[0];
                let weekCal = data[1];

                $('#summary').append(`<h1>Total Cost: $ ${weekCost} Total Calories: ${weekCal} cal</h1>`)

                var transitionEnd = 'webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend';
                var transitionsSupported = ($('.csstransitions').length > 0);
                //if browser does not support transitions - use a different event to trigger them
                if (!transitionsSupported)
                    transitionEnd = 'noTransition';

                //should add a loding while the events are organized

                function SchedulePlan(element) {
                    this.element = element;
                    this.timeline = this.element.find('.timeline');
                    this.timelineItems = this.timeline.find('li');
                    this.timelineItemsNumber = this.timelineItems.length;
                    this.timelineStart = getScheduleTimestamp(this.timelineItems.eq(0).text());
                    //need to store delta (in our case half hour) timestamp
                    this.timelineUnitDuration = getScheduleTimestamp(this.timelineItems.eq(1).text()) - getScheduleTimestamp(this.timelineItems.eq(0).text());

                    this.eventsWrapper = this.element.find('.events');
                    this.eventsGroup = this.eventsWrapper.find('.events-group');
                    this.singleEvents = this.eventsGroup.find('.single-event');
                    this.eventSlotHeight = this.eventsGroup.eq(0).children('.top-info').outerHeight();

                    this.modal = this.element.find('.event-modal');
                    this.modalHeader = this.modal.find('.header');
                    this.modalHeaderBg = this.modal.find('.header-bg');
                    this.modalBody = this.modal.find('.body');
                    this.modalBodyBg = this.modal.find('.body-bg');
                    this.modalMaxWidth = 800;
                    this.modalMaxHeight = 480;

                    this.animating = false;

                    this.initSchedule();
                }

                SchedulePlan.prototype.initSchedule = function() {
                    this.scheduleReset();
                    this.initEvents();
                };

                SchedulePlan.prototype.scheduleReset = function() {
                    var mq = this.mq();
                    if (mq == 'desktop' && !this.element.hasClass('js-full')) {
                        //in this case you are on a desktop version (first load or resize from mobile)
                        this.eventSlotHeight = this.eventsGroup.eq(0).children('.top-info').outerHeight();
                        this.element.addClass('js-full');
                        this.placeEvents();
                        this.element.hasClass('modal-is-open') && this.checkEventModal();
                    } else if (mq == 'mobile' && this.element.hasClass('js-full')) {
                        //in this case you are on a mobile version (first load or resize from desktop)
                        this.element.removeClass('js-full loading');
                        this.eventsGroup.children('ul').add(this.singleEvents).removeAttr('style');
                        this.eventsWrapper.children('.grid-line').remove();
                        this.element.hasClass('modal-is-open') && this.checkEventModal();
                    } else if (mq == 'desktop' && this.element.hasClass('modal-is-open')) {
                        //on a mobile version with modal open - need to resize/move modal window
                        this.checkEventModal('desktop');
                        this.element.removeClass('loading');
                    } else {
                        this.element.removeClass('loading');
                    }
                };

                SchedulePlan.prototype.initEvents = function() {
                    var self = this;

                    this.singleEvents.each(function() {
                        //create the .event-date element for each event
                        // var durationLabel = '<span class="event-date">'+$(this).data('start')+' - '+$(this).data('end')+'</span>';
                        // $(this).children('a').append($(durationLabel));

                        //detect click on the event and open the modal
                        $(this).on('click', 'a', function(event) {
                            event.preventDefault();
                            if (!self.animating)
                                self.openModal($(this));
                            }
                        );
                    });

                    //close modal window
                    this.modal.on('click', '.close', function(event) {
                        event.preventDefault();
                        if (!self.animating)
                            self.closeModal(self.eventsGroup.find('.selected-event'));
                        }
                    );
                    this.element.on('click', '.cover-layer', function(event) {
                        if (!self.animating && self.element.hasClass('modal-is-open'))
                            self.closeModal(self.eventsGroup.find('.selected-event'));
                        }
                    );
                };

                SchedulePlan.prototype.placeEvents = function() {
                    var self = this;
                    this.singleEvents.each(function() {
                        //place each event in the grid -> need to set top position and height
                        var start = getScheduleTimestamp($(this).attr('data-start')),
                            duration = getScheduleTimestamp($(this).attr('data-end')) - start;

                        var eventTop = self.eventSlotHeight * (start - self.timelineStart) / self.timelineUnitDuration,
                            eventHeight = self.eventSlotHeight * duration / self.timelineUnitDuration;
                        var mq = self.mq();
                        if (mq !== 'mobile') {
                            $(this).css({
                                top: (eventTop - 1) + 'px',
                                height: (eventHeight + 1) + 'px'
                            });
                        }
                    });

                    this.element.removeClass('loading');
                };

                SchedulePlan.prototype.openModal = function(event) {
                    var self = this;
                    var mq = self.mq();
                    this.animating = true;

                    //update event name and time
                    this.modalHeader.find('.event-name').text(event.find('.event-name').text());
                    this.modal.attr('data-event', event.parent().attr('data-event'));

                    //update event content

                    let data = {
                        recipe_id: parseInt(event.find('.recipe_id').text()),
                        recipe_title: event.find('.event-name').text(),
                        quantity: parseInt(event.find('.qty').text().split('Quantity: ')[1]),
                        day: event.parent().parent().attr('id'),
                        week: $(document).find('#weekNo').text()
                    }

                    this.modalBody.find('.event-info').load('detail.php', data, function(d) {
                        //once the event content has been loaded
                        self.element.addClass('content-loaded');
                        // self.element.append('<h1>Hello</h1>')
                    });

                    this.element.addClass('modal-is-open');

                    setTimeout(function() {
                        //fixes a flash when an event is selected - desktop version only
                        event.parent('li').addClass('selected-event');
                    }, 10);

                    if (mq == 'mobile') {
                        self.modal.one(transitionEnd, function() {
                            self.modal.off(transitionEnd);
                            self.animating = false;
                        });
                    } else {
                        var eventTop = event.offset().top - $(window).scrollTop(),
                            eventLeft = event.offset().left,
                            eventHeight = event.innerHeight(),
                            eventWidth = event.innerWidth();

                        var windowWidth = $(window).width(),
                            windowHeight = $(window).height();

                        var modalWidth = (windowWidth * .8 > self.modalMaxWidth)
                                ? self.modalMaxWidth
                                : windowWidth * .8,
                            modalHeight = (windowHeight * .8 > self.modalMaxHeight)
                                ? self.modalMaxHeight
                                : windowHeight * .8;

                        var modalTranslateX = parseInt((windowWidth - modalWidth) / 2 - eventLeft),
                            modalTranslateY = parseInt((windowHeight - modalHeight) / 2 - eventTop);

                        var HeaderBgScaleY = modalHeight / eventHeight,
                            BodyBgScaleX = (modalWidth - eventWidth);

                        //change modal height/width and translate it
                        self.modal.css({
                            top: eventTop + 'px',
                            left: eventLeft + 'px',
                            height: modalHeight + 'px',
                            width: modalWidth + 'px'
                        });
                        transformElement(self.modal, 'translateY(' + modalTranslateY + 'px) translateX(' + modalTranslateX + 'px)');

                        //set modalHeader width
                        self.modalHeader.css({
                            width: eventWidth + 'px'
                        });
                        //set modalBody left margin
                        self.modalBody.css({
                            marginLeft: eventWidth + 'px'
                        });

                        //change modalBodyBg height/width ans scale it
                        self.modalBodyBg.css({
                            height: eventHeight + 'px',
                            width: '1px'
                        });
                        transformElement(self.modalBodyBg, 'scaleY(' + HeaderBgScaleY + ') scaleX(' + BodyBgScaleX + ')');

                        //change modal modalHeaderBg height/width and scale it
                        self.modalHeaderBg.css({
                            height: eventHeight + 'px',
                            width: eventWidth + 'px'
                        });
                        transformElement(self.modalHeaderBg, 'scaleY(' + HeaderBgScaleY + ')');

                        self.modalHeaderBg.one(transitionEnd, function() {
                            //wait for the  end of the modalHeaderBg transformation and show the modal content
                            self.modalHeaderBg.off(transitionEnd);
                            self.animating = false;
                            self.element.addClass('animation-completed');
                        });
                    }

                    //if browser do not support transitions -> no need to wait for the end of it
                    if (!transitionsSupported)
                        self.modal.add(self.modalHeaderBg).trigger(transitionEnd);
                    };

                SchedulePlan.prototype.closeModal = function(event) {
                    var self = this;
                    var mq = self.mq();

                    this.animating = true;

                    if (mq == 'mobile') {
                        this.element.removeClass('modal-is-open');
                        this.modal.one(transitionEnd, function() {
                            self.modal.off(transitionEnd);
                            self.animating = false;
                            self.element.removeClass('content-loaded');
                            event.removeClass('selected-event');
                        });
                    } else {
                        var eventTop = event.offset().top - $(window).scrollTop(),
                            eventLeft = event.offset().left,
                            eventHeight = event.innerHeight(),
                            eventWidth = event.innerWidth();

                        var modalTop = Number(self.modal.css('top').replace('px', '')),
                            modalLeft = Number(self.modal.css('left').replace('px', ''));

                        var modalTranslateX = eventLeft - modalLeft,
                            modalTranslateY = eventTop - modalTop;

                        self.element.removeClass('animation-completed modal-is-open');

                        //change modal width/height and translate it
                        this.modal.css({
                            width: eventWidth + 'px',
                            height: eventHeight + 'px'
                        });
                        transformElement(self.modal, 'translateX(' + modalTranslateX + 'px) translateY(' + modalTranslateY + 'px)');

                        //scale down modalBodyBg element
                        transformElement(self.modalBodyBg, 'scaleX(0) scaleY(1)');
                        //scale down modalHeaderBg element
                        transformElement(self.modalHeaderBg, 'scaleY(1)');

                        this.modalHeaderBg.one(transitionEnd, function() {
                            //wait for the  end of the modalHeaderBg transformation and reset modal style
                            self.modalHeaderBg.off(transitionEnd);
                            self.modal.addClass('no-transition');
                            setTimeout(function() {
                                self.modal.add(self.modalHeader).add(self.modalBody).add(self.modalHeaderBg).add(self.modalBodyBg).attr('style', '');
                            }, 10);
                            setTimeout(function() {
                                self.modal.removeClass('no-transition');
                            }, 20);

                            self.animating = false;
                            self.element.removeClass('content-loaded');
                            event.removeClass('selected-event');
                        });
                    }

                    //browser do not support transitions -> no need to wait for the end of it
                    if (!transitionsSupported) {
                        self.modal.add(self.modalHeaderBg).trigger(transitionEnd);
                    }

                    //
                    // $.ajax({url: '/assets/php/getRecipe.php'}).done(monday => {
                    //
                    //     $('#Monday').empty(e);
                    //     $('#Monday').append(e);
                    //
                    //     this.singleEvents = this.eventsGroup.find('.single-event');
                    //
                    //     this.initSchedule();
                    //     this.placeEvents();
                    //
                    // });
                    // $.ajax({url:'reset.php'}).done(e=>{
                    // 	$('.cd-schedule').empty();
                    // 	$('.cd-schedule').append(e);
                    // 	var schedules = $('.cd-schedule');
                    // 	var objSchedulesPlan = [],
                    // 		windowResize = false;
                    //
                    // 	if (schedules.length > 0) {
                    // 		schedules.each(function() {
                    // 		 create SchedulePlan objects
                    //
                    // 			objSchedulesPlan.push((plan = new SchedulePlan($(this))));
                    //
                    // 		});
                    // 	}
                    //
                    // })

                }
                SchedulePlan.prototype.reset = function() {
                    this.singleEvents = this.eventsGroup.find('.single-event');
                    // this.mq();
                    this.initSchedule();
                    this.placeEvents();
                }
                SchedulePlan.prototype.mq = function() {
                    //get MQ value ('desktop' or 'mobile')
                    var self = this;
                    return window.getComputedStyle(this.element.get(0), '::before').getPropertyValue('content').replace(/["']/g, '');
                };

                SchedulePlan.prototype.checkEventModal = function(device) {
                    this.animating = true;
                    var self = this;
                    var mq = this.mq();

                    if (mq == 'mobile') {
                        //reset modal style on mobile
                        self.modal.add(self.modalHeader).add(self.modalHeaderBg).add(self.modalBody).add(self.modalBodyBg).attr('style', '');
                        self.modal.removeClass('no-transition');
                        self.animating = false;
                    } else if (mq == 'desktop' && self.element.hasClass('modal-is-open')) {
                        self.modal.addClass('no-transition');
                        self.element.addClass('animation-completed');
                        var event = self.eventsGroup.find('.selected-event');

                        var eventTop = event.offset().top - $(window).scrollTop(),
                            eventLeft = event.offset().left,
                            eventHeight = event.innerHeight(),
                            eventWidth = event.innerWidth();

                        var windowWidth = $(window).width(),
                            windowHeight = $(window).height();

                        var modalWidth = (windowWidth * .8 > self.modalMaxWidth)
                                ? self.modalMaxWidth
                                : windowWidth * .8,
                            modalHeight = (windowHeight * .8 > self.modalMaxHeight)
                                ? self.modalMaxHeight
                                : windowHeight * .8;

                        var HeaderBgScaleY = modalHeight / eventHeight,
                            BodyBgScaleX = (modalWidth - eventWidth);

                        setTimeout(function() {
                            self.modal.css({
                                width: modalWidth + 'px',
                                height: modalHeight + 'px',
                                top: (windowHeight / 2 - modalHeight / 2) + 'px',
                                left: (windowWidth / 2 - modalWidth / 2) + 'px'
                            });
                            transformElement(self.modal, 'translateY(0) translateX(0)');
                            //change modal modalBodyBg height/width
                            self.modalBodyBg.css({
                                height: modalHeight + 'px',
                                width: '1px'
                            });
                            transformElement(self.modalBodyBg, 'scaleX(' + BodyBgScaleX + ')');
                            //set modalHeader width
                            self.modalHeader.css({
                                width: eventWidth + 'px'
                            });
                            //set modalBody left margin
                            self.modalBody.css({
                                marginLeft: eventWidth + 'px'
                            });
                            //change modal modalHeaderBg height/width and scale it
                            self.modalHeaderBg.css({
                                height: eventHeight + 'px',
                                width: eventWidth + 'px'
                            });
                            transformElement(self.modalHeaderBg, 'scaleY(' + HeaderBgScaleY + ')');
                        }, 10);

                        setTimeout(function() {
                            self.modal.removeClass('no-transition');
                            self.animating = false;
                        }, 20);
                    }
                };

                var schedules = $('.cd-schedule');
                var objSchedulesPlan = [],
                    windowResize = false;

                if (schedules.length > 0) {
                    schedules.each(function() {
                        //create SchedulePlan objects
                        objSchedulesPlan.push(new SchedulePlan($(this)));

                    });
                }

                $(window).on('resize', function() {
                    if (!windowResize) {
                        windowResize = true;
                        (!window.requestAnimationFrame)
                            ? setTimeout(checkResize)
                            : window.requestAnimationFrame(checkResize);
                    }
                });

                $(window).keyup(function(event) {
                    if (event.keyCode == 27) {
                        objSchedulesPlan.forEach(function(element) {
                            if (element.eventsGroup.find('.selected-event').offset() !== undefined) {
                                element.closeModal(element.eventsGroup.find('.selected-event'));
                            }

                        });
                    }
                });

                function checkResize() {
                    objSchedulesPlan.forEach(function(element) {
                        element.scheduleReset();
                    });
                    windowResize = false;
                }

                function getScheduleTimestamp(time) {
                    //accepts hh:mm format - convert hh:mm to timestamp
                    time = time.replace(/ /g, '');
                    var timeArray = time.split(':');
                    var timeStamp = parseInt(timeArray[0]) * 60 + parseInt(timeArray[1]);
                    return timeStamp;
                }

                function transformElement(element, value) {
                    element.css({'-moz-transform': value, '-webkit-transform': value, '-ms-transform': value, '-o-transform': value, 'transform': value});
                }
                function displayOtherWeekCost(params, days, d, weekCost) {
                    params.forEach((a, b) => {
                        if (a !== '') {
                            let quantityArr = JSON.parse(d[days[b]]);
                            let recipeArr = a[0];
                            let dayCost = 0;
                            recipeArr.forEach((x, y) => {
                                dayCost += x.pricePerServing * quantityArr[y].quantity / 100;
                            })
                            dayCost = round(dayCost);
                            weekCost += dayCost;
                            $(`#${days[b]}`).html(`<li class="single-event" data-start="09:00" data-end="11:00" data-content="event-rowing-as" data-event="event-4">
                            <a href="#0"><em class="event-name" style="font-size:2rem">Total Cost: $ ${dayCost} </em></a></li>`)
                        } else {
                            $(`#${days[b]}`).html('');
                        }

                    })
                }
                // ADD NEXT AND PREVIOUS EVENT HERE !!!!!!!!!!!!!
                $('#next').click(function() {
                    let week = parseInt($('#weekNo').html().split('Week ')[1]);
                    week = week === 4
                        ? 1
                        : week + 1;

                    $.post('/assets/php/updateRecentWeek.php', {
                        week: week
                    }, function() {
                        $.post('/assets/php/getRecipeID.php', function(d) {
                            d = JSON.parse(d);
                            let ajaxCall = [];
                            days.forEach((day, i) => {
                                let query = getStringID(JSON.parse(d[day]));
                                if (query !== '') {
                                    ajaxCall[i] = fetchData(query);
                                } else {
                                    ajaxCall[i] = '';
                                }
                            })
                            $.when.apply($, ajaxCall).then(function(...params) {
                                let weekCost;
                                if (ajaxCall.length === 1) {
                                    let temp = new Array();
                                    temp[0] = params;
                                    params = temp;

                                }
                                displayOtherWeekCost(params, days, d, weekCost);
                                weekCost = round(weekCost);
                                objSchedulesPlan[0].reset();
                                $('#weekNo').html(`Week ${week}`);

                            });
                        });
                    });
                })
                $('#previous').click(function() {
                    let week = parseInt($('#weekNo').html().split('Week ')[1]);
                    week = week === 1
                        ? 4
                        : week - 1;
                    $.post('/assets/php/updateRecentWeek.php', {
                        week: week
                    }, function() {
                        $.post('/assets/php/getRecipeID.php', function(d) {
                            d = JSON.parse(d);
                            let ajaxCall = [];
                            days.forEach((day, i) => {
                                let query = getStringID(JSON.parse(d[day]));
                                if (query !== '') {
                                    ajaxCall[i] = fetchData(query);
                                } else {
                                    ajaxCall[i] = '';
                                }
                            })
                            $.when.apply($, ajaxCall).then(function(...params) {
                                let weekCost;
                                if (ajaxCall.length === 1) {
                                    let temp = new Array();
                                    temp[0] = params;
                                    params = temp;

                                }
                                displayOtherWeekCost(params, days, d, weekCost);
                                weekCost = round(weekCost);
                                objSchedulesPlan[0].reset();
                                $('#weekNo').html(`Week ${week}`);

                            });
                        });
                    });

                })
            })

        })
    });

});
