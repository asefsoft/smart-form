@extends('app')

@section('content')
    <div class="vue-js">
        <h1>Farsisubtitle</h1>

        {{--search form--}}
        <form id="farsisubForm" v-on="submit: searchFarsisub" action="http://s8.farsisubtitle.com/download/search.ajax.php" method="post" class="form-inline" role="form">

            <div class="form-group">
                <label class="sr-only" for="">label</label>
                <input type="text" v-model="request.query" required class="form-control" name="query" id="" value="" placeholder="Search">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">جستجو</button>
                <div v-class="searching: isSearching" ></div>
            </div>
            
            {{--<div class="clearfix">--}}
                {{----}}
            {{--</div>--}}

            <div class="search_options">

                <select name="our_select" id="our_select" style="width:150px" class="form-control">
                    <option v-repeat="searchHistory">@{{$value}}</option>
                </select>

                <div class="radio">
                    <label title="جستجو به طور مستقیم توسط مرورگر - رکوئست آجاکس">
                        <input type="radio" name="searchEndpoint" v-on="change: changeSearchEndpoint" v-model="searchEndpoint" value="local">
                        جستجوی لوکال
                    </label>
                </div>

                <div class="radio">
                    <label title="جستجو توسط سرور پشتیبال برای دور زدن محدودیت آجاکس" >
                        <input type="radio" name="searchEndpoint" v-on="change: changeSearchEndpoint" v-model="searchEndpoint"  value="server" >
                        متصل به سرور
                    </label>
                </div>
            </div>
        </form>

        <hr>

        {{--info box--}}
        <div id="InfoBox" class="alert alert-info" v-show="displayInfo">

        </div>


        {{--result table--}}
        <table id="farsisubResultTable" class="table table-striped table-hover">
        	<thead>
        		<tr>
        			<th v-on="click: changeOrder('name')" ><a href="#">نام</a></th>
        			<th v-on="click: changeOrder('translator')" ><a href="#">مترجم</a></th>
        			<th v-on="click: changeOrder('release')" ><a href="#">ریلیز</a></th>
        			<th v-on="click: changeOrder('date')" ><a href="#">تاریخ</a></th>
        		</tr>
        	</thead>
        	<tbody>
        		<tr v-repeat="searchResult | orderBy orderKey orderReverse">
        			<td><a v-on="click: downloadSubtitle(this,url)" href="@{{ FarsisubBaseUrl + url}}">@{{name}}</a></td>
        			<td>@{{translator}}</td>
        			<td>@{{release}}</td>
        			<td>@{{date}}</td>
        		</tr>
        	</tbody>
        </table>


        <pre>
            @{{ $data | json }}
        </pre>

    </div>

@endsection

