@extends('app')

@section('content')
    <div class="well">
        فرم های پر شده مربوط به: <b>{{$form->title}}</b>
    </div>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>تاریخ ثبت</th>
            <th>عملیات</th>
        </tr>
        </thead>
        <tbody>

        @forelse ($filledForms as $filledform)
            @if($form->title == '')
                <?php $form->title = "بدون عنوان" ?>
            @endif
            <tr>
                <td class="eng_in_rtl_context">
                     {{$filledform->created_at->diffForHumans()}}
                </td>

                <td>
                    <div class="btn-group">
                        <a class="btn btn-info"  href="{{ route("show_filled_form", $filledform->id)}}">نمایش</a>
                        <a class="btn btn-danger" title="حذف فرم" href="{{route("delete_filled_form", $filledform->id)}}">حذف</a>
                    </div>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="2">
                        فرمی یافت نشد
                    </td>
                </tr>
        @endforelse
        </tbody>
    </table>

{{--    {!!  $filledForms->render() !!}--}}
@endsection
