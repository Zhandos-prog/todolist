<?php

namespace App\View;

abstract class Base {

    public function render($data = [])
    {
        ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>TodoList</title>

                <!-- style -->
                <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
                <link rel="stylesheet" href="/assets/css/custom.css">
            </head>
            <body>
                
                <?php $this->container($data); ?>


                <!-- script -->
                <script src="/node_modules/jquery/dist/jquery.min.js"></script>
                <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

                <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

                <script src="/assets/js/custom.js"></script>
            </body>
            </html>
        <?php
    }

    public function header()
    {
        ?>
            <header>
                <div class="navbar navbar-dark bg-dark shadow-sm">
                    <div class="container d-flex justify-content-between">
                    <a href="/" class="navbar-brand d-flex align-items-center">
                        <strong>TodoList</strong>
                    </a>
                    <?php if(isset($_SESSION['auth'])): ?>
                        <a id="logout" href="" class="navbar-brand d-flex align-items-center">
                            <strong><?php echo $_SESSION['auth']['name']; ?></strong>
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-door-closed" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V2zm1 13h8V2H4v13z"/>
                                <path d="M9 9a1 1 0 1 0 2 0 1 1 0 0 0-2 0z"/>
                            </svg>
                        </a>    
                        <form id="logout-form" action="/logout" method="post">
                            <button type="submit"></button>
                        </form>   
                    <?php else: ?>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1" data-whatever="@mdo">Login</button>
                    </div>
                    <?php endif; ?>
                </div>
            </header>
        <?php
    }

    public function footer()
    {
        ?>
       <footer class="text-muted">
            <div class="container">
                <p class="float-right">
                <a href="https://github.com/Zhandos-prog/todolist">#GitHub</a>
                </p>
                <p>TodoList 2020</p>
            </div>
        </footer>
        <?php
    }
}