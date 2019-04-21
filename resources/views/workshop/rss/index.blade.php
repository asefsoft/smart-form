<?php echo '<?xml version="1.0" encoding="utf-8"?>' ?>

<feed xmlns="http://www.w3.org/2005/Atom">
    <title type="text" xml:lang="en">Laravel Workshop - Site Feed</title>
    <subtitle>This is our atom feed - includes all new users info</subtitle>
    <link type="application/atom+xml" href="{{ route('feed_path') }}" rel="self"/>
    <updated>{{ Carbon\Carbon::now()->toAtomString() }}</updated>
    <author>
        <name>Asef</name>
    </author>
    <rights>copyright info</rights>
    <id>tag:oursite.com,{{ date('Y') }}:/workshop/feed</id>

    @foreach($users as $user)

    <entry>
        <title>{{$user->name}} Info</title>
        <id>{{users_tag_uri($user)}}</id>
        <link>{!! route('user_info_path',[$user->id]) !!}</link>
        <summary>{{$user->name }} - {{ $user->email}}</summary>
    </entry>
    @endforeach

</feed>