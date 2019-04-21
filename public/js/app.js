var vue_instance=new Vue ({
    el: '.smartForm',

    data: {

        isCreatingForm : false,

        formData: {
            formID: -1, // id of saved form on database
            formTitle: "", // title of form
            formQuestions:[] // all question info
            /*
                [{
                questionID: 1
                questionType: "",
                questionText:"",
                questionItems: {}
                questionAnswer: ""              // simple answers
                questionAnswerCheckbox: [""]    // multi item answers

             }]
            */
        }

    },

    methods: {
        createForm: function(e) {
            this.isCreatingForm = true;
        },

        closeForm:function (e) {
            this.isCreatingForm = false;
            this.clearFormdata();
        },

        clearFormdata:function () {
            this.formData = {
                formID : -1,
                formTitle: "", // title of form
                formQuestions:[]
            };

        },

        // just for test
        addSampleQuestions:function () {
            this.addNewQuestion("Text","نام شما چیست؟");
            this.addNewQuestion("TextLarge","شرح حال شما چیست؟");
            this.addNewQuestion("MultiOption","علاقه مندی های شما",['ورزش','سلامتی']);
        },

        addNewQuestion:function (type, text, items) {

            var newQuestion = {
                questionType: type,
                questionText: text,
                questionItems: items,
                questionAnswer: "",
                questionAnswerCheckbox: [""]

            };
            this.formData.formQuestions.push(newQuestion);
        },

        removeQuestion:function(questionIndex){
            this.formData.formQuestions.splice(questionIndex,1);

        },

        removeQuestionItem:function(question, itemIndex){
            question.questionItems.splice(itemIndex,1);
        },

        addQuestionItem:function(question){
            if (typeof question.questionItems === 'undefined')
                question.questionItems = [];

            question.questionItems.push('');
        },


        // save form or a form with answers (filled form)
        // send ajax post request
        saveForm:function(e){

            var request = {
                action: 'saveForm',
                formData: this.formData
            };

            var thisVue = this;


            $.ajax({
                type: 'POST',
                crossDomain: true,
                url: '',
                data: request,

                success: function(data) {

                    if (data.result === 'OK'){
                        thisVue.formData.formID = data.formID;
                    }
                    else{
                        alert (data.message);
                    }

                    alert(data.result);

                },
                error: function(data) {
                    alert(data)

                }

            });
        },

        // is new question of multi item type? {Radio option or Check box}
        isMultiItemQuestion: function (questionType) {
            return questionType === 'MultiOption' || questionType === 'MultiCheckbox';
        }


    }, //end methods

    computed:{
        formStatusText:function () {
            if (this.formData.formID === -1) {
                return 'فرم ذخیره نشده'
            }else {
                return 'فرم ذخیره شده با شماره ی ' + this.formData.formID;
            }
        },

        isFormSaved:function () {
            return this.formData.formID !== -1
        },

    },

    //when document is ready. do inits...
    mounted: function(){

          //this.addSampleQuestions();

    }

}); //end vue instance