<?php
    include_once '../vendor/autoload.php';
    include_once '../app/NewsController.php';

    use App\Controllers\NewsController;

    $controller = new NewsController();
    $index      = $controller->index();
    $news       = $index['news'];
    $total      = $index['total'];
    $current    = $index['current'];
    $pageSize   = $index['pageSize'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Avec - Desafio Desenvolvedor Jr.</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <style type="text/css">
        html, body {
            width: 90%;
            height: 100%;
            margin: 0 auto;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
        }

        header {
            padding: 20px 0;
        }

        ul {
            margin: 0;
            padding: 0;
        }

        ul li {
            list-style: none;
            padding: 20px 0;
        }

        ul li > h5 {
            margin: 0;
            padding: 0;
        }

        ul li > h3 {
            margin: 0;
            padding: 8px 0;
        }

        ul li > sup {
            color: #666;
            font-size: 10px;
        }

        #pagination {
            padding: 20px 0;
        }

        #pagination li {
            list-style: none;
            display: inline-block;
            padding: 5px;
        }
    </style>
</head>
<body>

<header>
    <div>
        <form id="formPageSize">
            <span>Itens por página:</span>
            <select name="page-size" id="page-size" class="form-control">
                <option <?php if ( $pageSize == 30 ) {
                    echo ' selected';
                } ?>>30
                </option>
                <option<?php if ( $pageSize == 50 ) {
                    echo ' selected';
                } ?>>50
                </option>
                <option <?php if ( $pageSize == 100 ) {
                    echo ' selected';
                } ?>>100
                </option>
            </select>
        </form
    </div>
</header>

<section id="news">
    <ul>
        <?php foreach ( $news as $new ): ?>
            <li>
                <h5><?= $new->sectionName ?></h5>
                <h3><?= $new->webTitle ?></h3>
                <sup>Publicada em: <?php $date = date_create($new->webPublicationDate);
                        echo date_format($date, 'd/m/Y H:i') ?></sup>
                <br>
                <a target="_blank" href="<?= $new->webUrl ?>">Visualizar Notícia</a>
            </li>
        <?php endforeach; ?>
    </ul>

    <ul id="pagination">
        <li><a href="?page=1&page-size=<?= $pageSize ?>" title="Página inicial">primeira</a></li>
        <li><a href="?page=<?= $current - 1 ?>&page-size=<?= $pageSize ?>" title="Página anterior">anterior</a></li>

        <li>...</li>
        <li></li>
        <li><?= $current ?></li>
        <li><?= ($current + 1) < ($total + 1) ? ($current + 1) : '' ?></li>
        <li><?= ($current + 2) < ($total + 1) ? ($current + 2) : '' ?></li>
        <li>...</li>

        <li><a href="?page=<?= $current + 1 ?>&page-size=<?= $pageSize ?>" title="Próxima página">próxima</a></li>
        <li><a href="?page=<?= $total ?>&page-size=<?= $pageSize ?>" title="Última página">última</a></li>
    </ul>
</section>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>
    const pageSizeSelect = $('#page-size');
    pageSizeSelect.change(() => window.location = `?page=<?= $current ?>&page-size=${pageSizeSelect.val()}`);
</script>

</body>
</html>