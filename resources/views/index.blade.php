@extends('app')

@section('content')
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>عنوان</th>
            <th>عملیات</th>
        </tr>
        </thead>
        <tbody>

        @forelse ($allForms as $index => $form)
            @if($form->title == '')
                <?php $form->title = "بدون عنوان"; ?>
            @endif
                    <tr>
                        <td>
                            <strong>
                                {{$index + 1}} - {{$form->title}}
                            </strong>
                        </td>

                        <td>
                            <div class="btn-toolbar">
                                <a class="btn btn-success"  href="{{route('edit_form',$form->id) }}">ویرایش</a>
                                <a class="btn btn-info" title="نمایش فرم های پر شده"
                                   href="{{ route("show_filled_forms", $form->id)}}">فرم های پر شده ({{ $form->filled_forms()->count() }}) </a>
                                <a class="btn btn-warning"  href="{{route('show_fill',$form->id) }}">پر کردن</a>
                                <a class="btn btn-danger" title="حذف فرم" href="delete/{{$form->id}}">حذف</a>
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

    {!!  $allForms->render() !!}
@endsection
