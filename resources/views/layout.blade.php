<!--layout.blade.php -->
<!DOCTYPE html>
<head>
    <title>@yield('title', 'Portfolio')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="wrapper">
    <nav class="navbar">
        <ul>
            <li><a href="{{URL::to("/")}}">Home</a></li>
            <li><a href="{{URL::to("/assignments/")}}">Opdrachten</a></li>
            {{--            {{ (current_page("./")) ? 'class=active' : '' }}--}}
        </ul>
    </nav>

    <br>
    @yield('content')
</div>
</body>
<footer>

</footer>
<style>
    body {
        color: #333;
        background: #fafafa;
        line-height: 140%;
    }
    .wrapper {
        max-width: 950px;
        margin: 0 auto;
        background-color: white;
        padding: 30px 50px;
    }

    /* ------------ TEXT DECORATION ------------ */
    hr{
        margin: 50px;
        border: 2px solid #f2f2f2;
    }
    hr.sub{
        margin: 30px 50px;
        border: 1px solid #F5F5F5;
    }

    /* ------------ NAVIGATION ------------ */
    .navbar{
        box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
        display: flex; /* centering */
        justify-content: center;
        color: grey;
        padding: 20px 0;
    }
    .navbar ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }
    .navbar li {
        display: inline;
        padding-right: 5px;
    }
    .navbar a {
        color: grey;
        font-weight: 300;
        text-decoration: none;
    }
    .navbar .active, .navbar a:hover{ border-bottom: 2px solid grey; }
    .explanation h4 {
        color: black;
        font-size: 1.3em;
        font-weight:300;
        text-decoration: none;
        line-height: 2.5;
        font-family: 'Dosis', sans-serif;
    }
    /* responsive navbar */
    @media screen and (max-width:750px){
        .navbar a{ font-size: 13px; }
        div.wrapper{ padding: 30px 5px; }

        /* responsive home text */
        .explanation h4{
            font-size: 13px; /* 2vw */
            line-height: 1;
        }
    }

    /* ------------ PROFILE ------------ */
    /* Code writer */
    div.code-animation, video.code-animation{
        padding: 45px 0;
    }
    .code-animation{
        margin:-8px -8px 0 -8px;
        background-color:#27364A;
    }
    #typewriter{
        font-family: "Courier New";
        color: white;
        line-height: 1.0;
    }
    /* responsive text */
    @media screen and (min-width: 940px){
        pre#typewriter{
            font-size: 2vw;
        }
    }
    @media screen and (max-width: 610px){
        pre#typewriter{
            font-size: 14px;
            margin-left:-90px;
        }
    }
    .var-highlight{ color: #C0AD60; }
    .blue{ color: lightskyblue; }
    .orange{ color: rgba(253, 149, 90, 0.8); }
    .green{ color: greenyellow; }

    @-webkit-keyframes blink{
        0%{opacity: 0;}
        100%{opacity: 1;}
    }
    @-moz-keyframes blink{
        0%{opacity: 0;}
        100%{opacity: 1;}
    }
    @keyframes blink{
        0%{opacity: 0;}
        100%{opacity: 1;}
    }
</style>