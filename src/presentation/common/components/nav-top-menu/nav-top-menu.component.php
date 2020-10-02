<header>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark border-bottom">
        <div class="container">
            <a class="navbar-brand font-weight-bold" href="/">Robotics World</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#headerMenu"
                    aria-controls="headerMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse collapse d-sm-inline-flex" id="headerMenu">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold" href="about">About us</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link font-weight-bold" href="blog">Blog</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link font-weight-bold" href="contact">Contact us</a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="/" class="nav-link disabled font-weight-bold text-white">
                            Welcome, <?= $this->user->username ?>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="signin" class="nav-link font-weight-bold">Sign in</a>
                    </li>

                    <li class="nav-item">
                        <a href="signup" class="nav-link font-weight-bold">Sign up</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
