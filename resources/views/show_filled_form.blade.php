@extends('app')

@section('footer')
    @if(isset($form))
        <script>
            vue_instance.formData.formID = {!! $form->id !!};
            vue_instance.formData.formTitle = '{!! $form->title !!}';
            vue_instance.formData.formQuestions = JSON.parse('{!! $form->questions !="" ? addslashes($form->questions) : "[]"  !!}');
        </script>
    @endif
@endsection

@section('content')


    <div class="row smartForm">

        <div class="col-lg-12">


            {{-- form--}}
            <form action="" method="post" role="form">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">نمایش فرم پر شده
                        </h3>

                    </div>

                    <div class="panel-body">


                        {{--form title--}}
                        <div class="alert alert-success">
                            @{{ formData.formTitle }}
                        </div>

                        {{--all questons--}}
                        <div class="row questionItem form-group" v-for="(question,index) in formData.formQuestions">

                            <div class="col-sm-2">
                                <label class="control-label">سوال شماره @{{ index + 1 }}</label>
                            </div>

                            <div class="col-sm-9">
                                <div class="well-sm">
                                    @{{ question.questionText }}
                                </div>

                                {{--small answer--}}
                                <div v-if="question.questionType === 'Text'">
                                    <div class="well-sm">
                                        @{{ question.questionAnswer  }}
                                    </div>
                                </div>

                                {{--large answer--}}
                                <div v-else-if="question.questionType === 'TextLarge'">
                                    <div class="well-sm">
                                    @{{ question.questionAnswer }}
                                    </div>
                                </div>

                                {{--Multi options--}}
                                <div v-else-if="isMultiItemQuestion(question.questionType)" class="col-sm-offset-1">

                                    <div v-for="(item,itemIndex) in question.questionItems">
                                        <template v-if="question.questionType === 'MultiOption'">
                                            <label class="radio">
                                                <input type="radio" :name="'radioField[' + index + ']'"
                                                       v-model="question.questionAnswer" :value="item" disabled="disabled">
                                                @{{ item }}
                                            </label>
                                        </template>
                                        <template v-else-if="question.questionType === 'MultiCheckbox'">
                                            <label class="checkbox">
                                                <input disabled="disabled" type="checkbox" :name="'checkBoxField[' + index + ']'"
                                                       v-model="question.questionAnswerCheckbox" :value="item">
                                                @{{ item }}
                                            </label>
                                        </template>
                                    </div>

                                </div>
                            </div>

                        </div>


                    </div>
                </div>
            </form>

        </div>
        <pre style="direction: ltr; text-align: left">
        @{{ $data }}
        </pre>
    </div>


@endsection
