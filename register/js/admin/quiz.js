var quizScript = function() {
    "use strict";

    var currentQuestionKey =   0;
    var currentSectionKey  =   0;
    var questionID      =   0;

    var questionData;
    var sectionData;

    var contentDataType =   "";
    var editDivHTML     =   "";//$(".editDiv").get(0).outerHTML;
    var textAreaElement =   $(".textAreaElement").html();

    $(".skipIntro").on("click", function(){
        $(".quizIntro").hide();
        $(".quiz").show();
    });



    // next button
    $(".nextQuestion").on("click", function(){
        currentQuestionKey =  parseInt($(this).attr('data-nextQuestionKey'));
        currentSectionKey  =  parseInt($(this).attr('data-nextSectionKey'));

        displayQuestion();
    });

    // previous button
    $(".previousQuestion").on("click", function(){
        currentQuestionKey =  parseInt($(this).attr('data-prevQuestionKey'));
        currentSectionKey  =  parseInt($(this).attr('data-prevSectionKey'))

        displayQuestion();
    });

    // question quick jump
    $(".score-sb li").on("click", function(){
        currentQuestionKey =  parseInt($(this).attr('data-questionKey'));
        currentSectionKey  =  parseInt($(this).attr('data-sectionKey'));

        displayQuestion();
    });


    function displayQuestion(){
        clearQuestion();

        // get sectionData and questionData from quizData;
        sectionData     =   quizData.section[currentSectionKey];
        questionData    =   quizData.section[currentSectionKey].questions[currentQuestionKey];

        // populate data
        $(".questionData .question").html(editDivHTML + questionData.question);
        $(".questionData .description").html(editDivHTML + questionData.description);

        for(var i = 1; i <= 5; i++){
            if(questionData['option_' + i]){
                $(".questionData .option_" + i).html(editDivHTML + questionData['option_' + i]).show();
            }
        }


        $(".score-sb li[data-sectionKey='"+ currentSectionKey +"'][data-questionKey='"+ currentQuestionKey +"']").addClass("current");
        if(!$(".score-sb li[data-sectionKey='"+ currentSectionKey +"'][data-questionKey='"+ currentQuestionKey +"']").parents(".accordion-body").hasClass("in")){
            console.log('adding class');
            $(".accordion-body").removeClass("in");
            $(".score-sb li[data-sectionKey='"+ currentSectionKey +"'][data-questionKey='"+ currentQuestionKey +"']").parents(".accordion-body").addClass("in");
        }

        var prevQuestionKey     =   0;
        var nextQuestionKey     =   0;
        var prevSectionKey      =   0;
        var nextSectionKey      =   0;

        if(currentQuestionKey > 0){
            prevQuestionKey =   parseInt(currentQuestionKey) - 1;
        }else if(currentSectionKey > 0){
            prevSectionKey  =   parseInt(currentSectionKey) - 1;
            prevQuestionKey =   quizData.section[prevSectionKey].questions.length - 1;
        }else{

        }

        if(quizData.section[currentSectionKey].questions[(currentQuestionKey + 1)]){
            nextSectionKey  =   currentSectionKey;
            nextQuestionKey =   (parseInt(currentQuestionKey) + 1);
        }else if(quizData.section[(parseInt(currentSectionKey) + 1)].questions[0]){
            nextSectionKey  =   (parseInt(currentSectionKey) + 1);
            nextQuestionKey =   0;
        }else{
            nextSectionKey  =   currentSectionKey;
            nextQuestionKey =   currentQuestionKey;
        }
        
        $(".previousQuestion")
            .attr('data-prevSectionKey', prevSectionKey)
            .attr('data-prevQuestionKey', prevQuestionKey);
        
        $(".nextQuestion")
            .attr('data-nextSectionKey', nextSectionKey)
            .attr('data-nextQuestionKey', nextQuestionKey);

    }
    displayQuestion();

    function clearQuestion(){
        $(".questionData .question").html("");
        $(".questionData .option_1").html("").hide();
        $(".questionData .option_2").html("").hide();
        $(".questionData .option_3").html("").hide();
        $(".questionData .option_4").html("").hide();
        $(".questionData .option_5").html("").hide();

        $(".questionData .description").html("");

        $(".score-sb li").removeClass("current");
        
        
    }


    $(".deleteQuizSection").on("click", function(){
        var response = confirm("Deleting this might also delete it from student analysis! Are you sure you want to remove it?");

        if(response == true){
            var parentElement = $(this).parents('tr');
            var quiz_section_id =   $(this).parents('tr').find("input[name='quiz_section_id[]']").val();
            // call ajax to remove quizSection
            $.ajax({
                url: $(this).attr('data-href'),
                type: "POST",
                data: "quiz_section_id=" + quiz_section_id,
                dateType: 'json',
                success: function(data){
                    if(data['success'] == "true" || data['success'] == "true"){
                        parentElement.remove();
                    }

                    if(data['message']){
                        lobibox(data['msgType'], data['message']);
                    }
                }
            });
        }
    })
    
    
    // loading textarea in place of text
    $(".questionData .question, .questionData .description,.questionData .option_1, .questionData .option_2, .questionData .option_3, .questionData .option_4, .questionData .option_5").on("dblclick", function(){
        if($(this).find('textarea').length <= 0){
            var dataType = $(this).attr('data-type');
            contentDataType = dataType;
            var tmpHTMLContaineer = $(this).html();
            $(this).html(textAreaElement);
            $(this).find('textarea')
                .attr('data-type', dataType)
                .attr('data-id', questionData['question_id'])
                .val(tmpHTMLContaineer);

            CKEDITOR.replace("content", {
                on:{
                    'instanceReady': function(evt) {
                        CKEDITOR.instances.content.focus();
                    }
                },
            });
            CKEDITOR.instances.content.on('blur', contentBlur);
        }
    });

    $(".questionData textarea").on("blur", function(){
        alert('focus lost');
    });

    function contentBlur(){
        var newContent = CKEDITOR.instances.content.getData();
        $(".questionData ." + contentDataType).html(newContent);
        
    }


    // remove Quiz Question
    $(".deleteQuizQuestion").on("click", function(e){
        e.preventDefault();
        var response = confirm("Deleting this might also delete it from student analysis! Are you sure you want to remove it?");

        if(response == true){
            // call ajax to remove quizSection
            $.ajax({
                url: $(this).attr('data-href'),
                type: "GET",
                dateType: 'json',
                success: function(data){
                    if(data['rows']){
                        $('#sample_1').dataTable().fnClearTable();
                        $('#sample_1').dataTable().fnAddData(data['rows']);
                    }

                    if(data['message']){
                        lobibox(data['msgType'], data['message']);
                    }
                }
            });
        }
    });


    /*$('.sortable').nestedSortable({
        handle: 'div',
        items: 'li',
        listType: 'ul',
        toleranceElement: '> div'
    });*/
}

quizScript();