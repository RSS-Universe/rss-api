<?php
declare(strict_types=1);

/**
 * @var AppView $this
 */

use App\View\AppView;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <?= $this->fetch('meta') ?>
    <?= $this->Html->meta('icon') ?>
    <title>
        <?= $this->fetch('title') ?>
    </title>


    <?= $this->Html->css([
        '/assets/font-awesome/css/all',
        '/assets/bootstrap/css/bootstrap',
        'alpha'
    ]) ?>

    <?= $this->fetch('css') ?>
</head>

<body data-auth-status="<?= $this->Auth->isLoggedIn() ? 'true' : 'false' ?>">
<?= $this->element('top_nav') ?>

<?= $this->Flash->render() ?>
<main role="main">
    <?= $this->fetch('content') ?>
</main>

<footer class="container">
    <p>&copy; Company 2017-2018</p>
</footer>
<?= $this->Auth->isLoggedIn() ? '' : $this->Modal->load('LogInModal') ?>
<?= $this->Modal->loadAjax() ?>
<?= $this->Html->script([
    '/assets/jquery/jquery',
    '/assets/bootstrap/js/bootstrap',
]) ?>
<?= $this->fetch('script') ?>

</body>
</html>
