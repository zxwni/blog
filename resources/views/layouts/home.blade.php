<!doctype html>
<html>
<head>
    <meta charset="utf-8">
   @yield('info')
    <link href="/resources/views/home/style/css/base.css" rel="stylesheet">
    <link href="/resources/views/home/style/css/index.css" rel="stylesheet">
    <link href="/resources/views/home/style/css/style.css" rel="stylesheet">
    <link href="/resources/views/home/style/css/new.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="/resources/views/home/style/js/modernizr.js"></script>
    <![endif]-->
</head>
<body>
<header>
    <div id="logo"><a href="/"></a></div>
    <nav class="topnav" id="topnav">
        @foreach($navs as $k=>$v)<a href="{{$v->nav_url}}"><span>{{$v->nav_name}}</span><span class="en">{{$v->nav_alias}}</span></a>@endforeach
    </nav>
</header>

@section('content')
    <h3>
        <p>最新<span>文章</span></p>
    </h3>
    <ul class="rank">
        @foreach($new as $n)
            <li><a href="{{url('a/'.$n->art_id)}}" title="{{$n->art_title}}" target="_blank">{{$n->art_title}}</a></li>
        @endforeach
    </ul>
    <h3 class="ph">
        <p>点击<span>排行</span></p>
    </h3>
    <ul class="paih">
        @foreach($hot2 as $h2)
            <li><a href="{{url('a/'.$h2->art_id)}}" title="{{$h2->art_title}}" target="_blank">{{$h2->art_title}}</a></li>
        @endforeach
    </ul>
@show
<footer>
    <p>Design by 陈华编程社区 <a href="http://www.miitbeian.gov.cn/" target="_blank">http://www.chenhua.club</a> <a href="/">网站统计</a></p>
</footer>
<script src="/resources/views/home/style/js/silder.js"></script>
</body>
</html>
