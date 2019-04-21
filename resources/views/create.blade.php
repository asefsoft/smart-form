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
            <form action="" @submit.prevent="saveForm()" method="post" role="form">
                <div class="panel" :class="[ isFormSaved ? 'panel-success' : 'panel-default' ]">
                    <div class="panel-heading">
                        <h3 class="panel-title">@{{ formStatusText }}
                        </h3>
                    </div>

                    <div class="panel-body">


                            {{-- add new question menu--}}
                            <div class="btn-group">
                            <a class="btn btn-success dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-plus"></i> سوال جدید
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="#" @click="addNewQuestion('Text')">
                                        <i class="fa fa-file-o"></i> متن کوتاه</a></li>
                                <li><a href="#" @click="addNewQuestion('TextLarge')">
                                        <i class="fa fa-file-text-o"></i>  متن بلند</a></li>
                                <li><a href="#" @click="addNewQuestion('MultiOption','',['',''])">
                                        <i class="fa fa-dot-circle-o"></i>  چند گزینه ای رادیو</a></li>
                                <li><a href="#" @click="addNewQuestion('MultiCheckbox','',['',''])">
                                        <i class="fa fa-check-square"></i>  چند گزینه ای چک باکس</a></li>
                            </ul>


                            </div>

                            {{-- form operations --}}
                            <div class="btn-group pull-left" v-show="isFormSaved">
                                <a class="btn btn-default" :href="'{{route('show_fill','') }}/' + formData.formID">
                                    <i class="fa fa-wpforms fa-lg"></i> پرکردن کردن فرم</a>
                                <a class="btn btn-danger" :href="'{{route('delete_form','') }}/' + formData.formID">
                                    <i class="fa fa-trash-o fa-lg"></i> حذف فرم</a>
                            </div>


                        {{--form title--}}
                        <div class="form-group spacer">
                            <input type="text" class="form-control" placeholder="عنوان فرم" required
                                   v-model="formData.formTitle">
                        </div>

                        {{--all questons--}}
                        <div class="row questionItem form-group " :class="index%2 ? 'even' : 'odd'"  v-for="(question,index) in formData.formQuestions">

                            <div class="col-sm-2">
                                <label class="control-label">سوال شماره @{{ index + 1 }}</label>
                            </div>

                            <div class="col-sm-9">
                                <input type="text" class="form-control form-group" v-model="question.questionText"
                                       id="q-text" required
                                       placeholder="متن سوال">

                                {{--small answer--}}
                                <div v-if="question.questionType === 'Text'">
                                    <input type="text" class="form-control" disabled="disabled" required
                                           placeholder="جواب سوال کوتاه">
                                </div>

                                {{--large answer--}}
                                <div v-else-if="question.questionType === 'TextLarge'">
                                    <textarea class="form-control" rows="3"
                                              disabled="disabled">جواب سوال بلند</textarea>
                                </div>

                                {{--Multi options--}}
                                {{--Radio option or Check box--}}
                                <div v-else-if="isMultiItemQuestion(question.questionType)">
                                    {{--add button--}}
                                    <div class="row form-group">
                                        <div class="col-sm-12">
                                            <button @click="addQuestionItem(question)" type="button"
                                                    class="btn btn-success btn-sm">+
                                            </button>
                                        </div>
                                    </div>


                                    <div class="row form-group" v-for="(item,itemIndex) in question.questionItems">

                                        <div class="col-sm-11">
                                            <div class="input-group input-group-unstyled">
                                                <span class="input-group-addon">
                                                    <template v-if="question.questionType === 'MultiOption'">
                                                        <i class="fa fa-circle-o fa-lg"></i>
                                                    </template>
                                                    <template v-else-if="question.questionType === 'MultiCheckbox'">
                                                        <i class="fa fa-square-o fa-lg"></i>
                                                    </template>
                                                </span>
                                            <input type="text" class="form-control"
                                                   placeholder="متن گزینه" v-model="question.questionItems[itemIndex]">
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <button @click="removeQuestionItem(question, itemIndex)" type="button"
                                                    class="btn btn-default btn-sm" title="حذف گزینه">x
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            {{--remove question --}}
                            <div class="col-sm-1">
                                <button @click="removeQuestion(index)" type="button"
                                        class="btn btn-danger btn-sm " title="حذف سوال">x
                                </button>
                            </div>

                        </div>


                    </div>
                </div>


                {{--save button--}}
                <button type="submit" class="btn btn-primary">ذخیره</button>
            </form>

        </div>

        {{--debug--}}
        <pre style="direction: ltr; text-align: left">
            @{{ $data }}
        </pre>
    </div>


@endsection
