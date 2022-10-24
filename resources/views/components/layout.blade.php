<!doctype html>
<title>My page</title>
<link rel="stylesheet" href="/app.css"/>
<body> 
    <div class="page-wrapper">
        <div class="content-wrap">
            <div class="header">
                TopHat's Top Blog
            </div>
            <ul class="nav">
                <li>Home</li>
                <li>Posts</li>
                <li>Login</li>
            </ul>
            <div class="container">
                {{ $slot }}
            </div>
        </div>
    </div>
    <div class="footer">&copy; Thomas Pearson 2022</div>
</body>
