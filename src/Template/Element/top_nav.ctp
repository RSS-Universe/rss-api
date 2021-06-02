<?php
/**
 * @var AppView $this
 */

use App\View\AppView;

?>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container">

        <a class="navbar-brand" href="#">RSS Universe</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarDiv"
                aria-controls="navbarDiv" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarDiv">
            <ul class="navbar-nav mr-auto">
                <?= $this->NavLinks->link('Home', '/') ?>
                <?= $this->NavLinks->link('Domains', ['controller' => 'RssDomains', 'action' => 'index']) ?>
                <?= $this->NavLinks->link('Feeds', ['controller' => 'DomainFeeds', 'action' => 'index']) ?>
                <?= $this->NavLinks->link('Items', ['controller' => 'FeedItems', 'action' => 'index']) ?>
                <?= $this->NavLinks->link('Users', ['controller' => 'Users', 'action' => 'index']) ?>
            </ul>
        </div>

        <div class="collapse navbar-collapse" id="navbarDiv">
            <ul class="navbar-nav mr-auto">
                <? if ($this->Auth->isLoggedIn()) : ?>
                    <?= $this->NavLinks->link('Log Out', ['controller' => 'Users', 'action' => 'logout']) ?>
                <? else: ?>
                    <?= $this->NavLinks->link('Log In', ['controller' => 'Users', 'action' => 'login']) ?>
                    <?= $this->NavLinks->link('Register', ['controller' => 'Users', 'action' => 'register']) ?>
                <? endif; ?>
            </ul>
        </div>
    </div>
</nav>
