<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Тест админки</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="/admin/js/jquery-1.8.3.js"></script>

    @include('back/scripts')
    @yield('scripts')
</head>
<body>
<header class="header">
    <p class="site-name">Имя Сайта</p>
    <div class="button">
        <a href="/auth/logout" class="logout">Выход</a>
    </div>
</header>

<div class="main-content">
    <aside class="left-side-bar">
        <nav class="main-menu">
            <ul id="menu">
                <li><span class="menu-title-1-2"><a href="/adm">Главная</a></span><span class="menu-title-1-2 menu-btn"> ► </span></li>
                <li><span class="menu-title">Страницы<i class="triangle">▼</i></span>
                    <ul>
                        <li><a href="/adm/edit/about">О клинике</a></li>
                        <li><a href="/adm/edit/specialists">Специалисты</a></li>
                        <li><a href="/adm/edit/services">Услуги</a></li>
                        <li><a href="/adm/edit/technology">Технологии</a></li>
                        <li><a href="/adm/edit/poleznoe">Полезное</a></li>
                        <li><a href="/adm/edit/questions">Вопросы и ответы</a></li>
                        <li><a href="/adm/edit/news">Новинки</a></li>
                        <li><a href="/adm/edit/contacts">Контакты</a></li>
                        <li><a href="/adm/edit/problems">Причины обращения</a></li>
                    </ul>
                </li>
                <li><span class="menu-title">Специальные блоки<i class="triangle">▼</i></span>
                    <ul>
                        <li><a href="/adm/edit/problems">Причины обращения</a></li>
                        <li><a href="/adm/edit/special">Специальные предложения</a></li>
                        <li><a href="/adm/edit/slider">Слайдер</a></li>
                        <li><a href="/adm/edit/video">Видео</a></li>
                    </ul>
                </li>
                <li>
                    <span class="menu-title">Сервисы<i class="triangle">▼</i></span>
                    <ul>
                        <li><a href="/adm/services/popups">Попапы и почта</a></li>
                    </ul>
                </li>
                <li>
                        <span class="menu-title href">
                            <a href="">Форум</a>
                        </span>
                </li>
                <li><span class="menu-title">Хитрости<i class="triangle">▼</i></span>
                    <ul>
                        <li><a href="">Использование CSS спрайтов</a></li>
                        <li><a href="">HEX и RGB коды цветов</a></li>
                        <li><a href="">Убрать www из адреса сайта</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </aside>
    @include('back.dom_all_images')
    @include('back.messenger')
    <article class="content">
        @yield('content')
        @yield('messenger')
        @yield('text')
    </article>
</div>
</body>
</html>