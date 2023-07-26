<?php
include_once('config.php');

function isMobileDevice() {
    return preg_match('/\b(iphone|android|palm|blackberry|symbian)\b/i', $_SERVER['HTTP_USER_AGENT']);
}

if (!isMobileDevice()) {
    header("Location: /");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title><?php echo $yourname ?>'s Vouch Website</title>
    <?php    
    if (isset($faviconurl) && !empty($faviconurl)) {
        echo '<link rel="icon" type="image/png" href="' . $faviconurl . '">' . PHP_EOL;
    }
    else {
      echo '<link rel="icon" type="image/png" href="https://liteeagle.me/assets/img/rep.png">' . PHP_EOL;
    }
    ?>
    <meta property="og:title" content="<?php echo $yourname ?>'s Vouch Website">
    <meta property="og:description" content="<?php echo $yourname ?>'s Vouch Website stores all the vouches from a set discord server to insure you never lose your rep!">
    <?php    
    if (isset($faviconurl) && !empty($faviconurl)) {
        echo '<meta property="og:image" content="' . $faviconurl . '">' . PHP_EOL;
    }
    else {
      echo '<meta property="og:image" content="https://liteeagle.me/assets/img/rep.png">' . PHP_EOL;
    }
    ?>
</head>

<body class="bg-gray-900", style="overflow: hidden;">
    <div class="min-h-screen flex items-center justify-center">
        <div class="text-center">
            <h1 class="text-2xl font-bold text-white mb-4">Sorry, Not Accessible on Mobile</h1>
            <p class="text-white">Please view this page on a larger screen for the best experience.</p>
        </div>
    </div>
</body>

</html>
