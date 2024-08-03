<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de Números Romanos</title>
    <link rel="stylesheet" href="resources/css/main.css">
    <script src="resources/js/main.js"></script>
</head>

<?php
require 'vendor/autoload.php';

use App\Services\Main;

$service = new Main();
$service->converter();
?>

<body>
    <h1>Conversor de Números Romanos</h1>
    <form method="post">
        <div class="form-group">
            <label for="integer">Número Inteiro:</label>
            <input type="text" id="integer" name="integer" value="<?php echo isset($_POST['integer']) ? htmlspecialchars($_POST['integer']) : ''; ?>">
            <div class="result">
                <?php if (isset($service->romanResult) && !empty($_POST['integer'])) : ?>
                    <p><strong>Resultado (Romano):</strong> <?php echo htmlspecialchars($service->romanResult); ?></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-group">
            <label for="roman">Número Romano:</label>
            <input type="text" id="roman" name="roman" value="<?php echo isset($_POST['roman']) ? htmlspecialchars($_POST['roman']) : ''; ?>">
            <div class="result">
                <?php if (isset($service->integerResult) && !empty($_POST['roman'])) : ?>
                    <p><strong>Resultado (Inteiro):</strong> <?php echo htmlspecialchars($service->integerResult); ?></p>
                <?php endif; ?>
            </div>
        </div>
        <input type="submit" value="Converter">
    </form>

    <?php if ($service->error) : ?>
        <p class="error"><?php echo htmlspecialchars($service->error); ?></p>
    <?php endif; ?>
</body>

</html>
