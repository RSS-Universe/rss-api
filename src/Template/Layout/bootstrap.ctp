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
        '/assets/bootstrap/css/bootstrap',
        'alpha'
    ]) ?>

    <?= $this->fetch('css') ?>
</head>

<body>
<?= $this->element('top_nav') ?>

<?= $this->Flash->render() ?>
<main role="main">
    <?= $this->fetch('content') ?>
</main>

<footer class="container">
    <p>&copy; Company 2017-2018</p>
</footer>

<?= $this->Html->script([
    '/assets/jquery/jquery',
    '/assets/bootstrap/js/bootstrap',
]) ?>
<?= $this->fetch('script') ?>

</body>
</html>