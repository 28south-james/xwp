(function( $ ) {
 
    $.fn.survey = function( actions ) {

    	var vars = {
    		speed: 800,
            stage: $(this),
            scenes: $('.scene'),
            resume: false,
            progressBar: $('#progressBar'),
            progressIndicator: $('.progress','#progressBar'),
            showProgress: false,
            sceneList: $('#sceneList'),
            sceneListItems: $('li','#sceneList')
    	};

 		return this.each(function() {

 			// Run this on page load
 			initialLoad(); 

	    });

 		function initialLoad() {
            if (vars.resume) {

            } else {
                loadScene(0,0);
            }
 		}

        function goBack() {
            // Transition back through the survey
            // Set the next question to the current minus one
            var question = vars.currentQuestion - 1;

            // If we're at the beginning of a 'scene' we need to go back to the
            // the previous scene
            if (question < 0) {

                // The next scene shall be the current minus one
                var scene = vars.currentScene - 1;

                // Load the next scene with these values
                loadScene(scene,question);

            } else {

                // Load the next question as we continue moving backwards
                loadQuestion(question,vars.currentQuestion);

            }

            // Set the global currentQuestion to the new question
            vars.currentQuestion = question;

        }

        function goForward() {
            // If we're moving forward in the survey
            // Set the next question to plus one
            var question = vars.currentQuestion + 1;

            // If we get to the end of the 'scene' we need to move
            // to the next scnee
            if (question >= vars.questions.length) {

                // Set the next scene to plus one
                var scene = vars.currentScene + 1;

                // Move to the next scene with question set to 0
                loadScene(scene,0);

            } else {

                // If we're not at the end yet, just load the next question
                loadQuestion(question,vars.currentQuestion);

            }

            // Set the global currentQuestion to the new question number
            vars.currentQuestion = question;

        }

        function loadQuestion(num, prev) {
            // Load our next question given the new question's number and the previous
            // If the previous question is at least 0 then we know we've already started 
            // so we need to load out the previous and load in the next
            if (prev > -1) {

                // Load out the old question
                hideQuestion(prev);

                // Wait for the animation and then load in the new question
                setTimeout(function(){revealQuestion(num);},500);

            } else {

                // Load in the new question w/no delay because we're starting a new scene
                revealQuestion(num);

            }

            setProgress(num);

        }

        function revealQuestion(num) {

            // Activate the new question
            vars.questions.eq(num).addClass('activeQuestion');

            // If we've loaded a question before, our buttons global will be set
            // We remove all event listeners if this is the case
            if (vars.buttons) { vars.buttons.off(); }

            // Cache the buttons for the current question
            vars.buttons = $('.btn',vars.questions.eq(num));

            // Loop through each button to attach the proper click event
            vars.buttons.each(function(){
                $(this).on('click',function(){
                    if ($(this).hasClass('back')) {
                        goBack();
                    } else {
                        goForward();
                    }
                });
            });
        }

        function hideQuestion(num) {
            // Transition from previous question
            // Add the loadOut class to activate the proper animation
            vars.questions.eq(num).addClass('loadOut');

            // Wait for the animation to finish before removing additional classes
            // which reset the previous question to its natural state
            setTimeout(function(){
                vars.questions.eq(num).removeClass('activeQuestion loadOut');
            },500)

        }

 		function lastQuestion() {

 		}

 		function nextQuestion() {
 
 		}

 		function loadScene(scene,question) {
            // Load a new scene
            // If no question value, load the scene from the beginning
            // otherwise load from a particular question
            if (!vars.stage.hasClass('loading')) {
                vars.stage.addClass('loading');
            }

            // Wait till after loading animation is finished
            // then do everything
            setTimeout(function(){

                // If we've already loaded a sene
                if (vars.currentScene > -1) {

                    // Deactivate the old scene
                    vars.scenes.eq(vars.currentScene).removeClass('activeScene')

                }

                // Activate the next scene
                vars.scenes.eq(scene).addClass('activeScene');

                // Cache the questions for this scene
                vars.questions = $('.question',vars.scenes.eq(scene));

                // Build the progress bar 
                buildProgressBar();

                // Set the global current question variable to the specified number
                vars.currentQuestion = question;

                // Load the right question
                loadQuestion(question,false);

                // Set the scene list
                sceneList(scene);

                // Bring the scene back in
                vars.stage.removeClass('loading');
                
                // Set the global variable current scene to the loaded scene
                vars.currentScene = scene;

            },750);

 		}

        function buildProgressBar() {
            // Build out the progress bar for each scene
            // Remove any previous markers
            if (vars.markers) { 
                vars.markers.remove();
                vars.progressIndicator.css({width:'100%'});
            }

            // Get the number of markers needed for the bar
            var markerCount = vars.questions.length - 1;

            var markers = [];
            var markerLeft = 0;
            var markerGap = 100 / markerCount;

            for (x = 0; x <= markerCount; x++) {
                markerLeft = markerGap * x;
                markers.push('<span class="marker" data-progress="' + (markerLeft/100) +'" style="left: ' + markerLeft +'%"></span>');
            }

            vars.progressBar.append(markers);

            vars.markers = $('.marker',vars.progressBar);

        }

        function setProgress(num) {

            var newMarker = vars.markers.eq(num);
            var position = 1 + Number(newMarker.attr('data-progress'));

            if ((num == 0) && (vars.showProgress)) {
                vars.progressBar.css({opacity:0});
                vars.showProgress = false;
            } else if ((num != 0) && (!vars.showProgress)) {
                vars.progressBar.css({opacity:1});
                vars.showProgress = true;
            }

            setTimeout(function(){
                vars.progressIndicator.css('transform', 'scale(' +position +',1)');
                newMarker.addClass('done');
            },750);
            
        }

 		function resume() {

 		}

 		function retrieveData() {

 		}

 		function saveData() {

 		}

        function sceneList(num) {
            // Update the scene list to keep track of progress
            // Variables used: vars.sceneList, vars.sceneListItems
            var sceneCount = vars.scenes.length;
            vars.sceneListItems.removeClass('active');
            if (!vars.sceneListItems.eq(num).hasClass('active')) {
                vars.sceneListItems.eq(num).addClass('active');
            }
        }

    };
 
}( jQuery ));

$(document).ready(function(){

	$('#stage').survey();

});


function setCookie(cname, cvalue, exhours) {
    var d = new Date();
    d.setTime(d.getTime() + (exhours*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function checkCookie(cookieName) {
    var cookieCheck = getCookie(cookieName);
    if (cookieCheck != "") {
        return true
    } else {
        return false
    }
}