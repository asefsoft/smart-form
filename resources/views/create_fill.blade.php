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
            <form @submit.prevent="saveForm()" method="post" role="form">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">لطفا فرم زیر را پر نمایید!
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
                                <p class="well-sm">
                                    @{{ question.questionText }}
                                </p>

                                {{--small answer--}}
                                <div v-if="question.questionType === 'Text'">
                                    <input type="text" class="form-control" v-model="question.questionAnswer" required
                                           placeholder="جواب سوال کوتاه">
                                </div>

                                {{--large answer--}}
                                <div v-else-if="question.questionType === 'TextLarge'">
                                    <textarea class="form-control" rows="3" v-model="question.questionAnswer" required
                                              >جواب سوال بلند</textarea>
                                </div>

                                {{--Multi options--}}
                                <div class="col-sm-offset-1" v-else-if="isMultiItemQuestion(question.questionType)">

                                    <div class="" v-for="(item,itemIndex) in question.questionItems">
                                        <template v-if="question.questionType === 'MultiOption'">
                                            <label class="radio">
                                                <input type="radio" :name="'radioField[' + index + ']'" v-model="question.questionAnswer" :value="item" required>
                                                @{{ item }}
                                            </label>
                                        </template>
                                        <template v-else-if="question.questionType === 'MultiCheckbox'">
                                            <label class="checkbox">
                                                <input :name="'checkBoxField[' + index + ']'" type="checkbox" v-model="question.questionAnswerCheckbox" :value="item" >
                                                @{{ item }}
                                            </label>
                                        </template>
                                    </div>

                                </div>
                            </div>

                        </div>


                    </div>
                </div>


                {{--save button--}}
                <button type="submit" class="btn btn-primary">ارسال</button>
            </form>

        </div>
        <pre style="direction: ltr; text-align: left">
        @{{ $data }}
        </pre>
    </div>


@endsection
