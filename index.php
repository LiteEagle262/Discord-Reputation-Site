<?php
function isMobileDevice() {
    return preg_match('/\b(iphone|android|palm|blackberry|symbian)\b/i', $_SERVER['HTTP_USER_AGENT']);
}

if (isMobileDevice()) {
    header("Location: mobile.php");
    exit();
}

include_once('config.php');

$vouch_data = json_decode(file_get_contents('vouches.json'), true);

$vouch_count = isset($vouch_data['vouch_count']) ? $vouch_data['vouch_count'] : 0;

$vouches = isset($vouch_data['vouches']) ? $vouch_data['vouches'] : array();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $yourname ?>'s Vouch Website</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://liteeagle.me/assets/css/stars.css" rel="stylesheet">
    <?php    
    if (isset($faviconurl) && !empty($faviconurl)) {
        echo '<link rel="icon" type="image/png" href="' . $faviconurl . '">';
    }
    else {
      echo '<link rel="icon" type="image/png" href="https://liteeagle.me/assets/img/rep.png">';
    }
    ?>
    <meta property="og:title" content="<?php echo $yourname ?>'s Vouch Website">
    <meta property="og:description" content="<?php echo $yourname ?>'s Vouch Website stores all the vouches from a set discord server to insure you never lose your rep!">
    <?php    
    if (isset($faviconurl) && !empty($faviconurl)) {
        echo '<meta property="og:image" content="' . $faviconurl . '">';
    }
    else {
      echo '<meta property="og:image" content="https://liteeagle.me/assets/img/rep.png">';
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <style>
        /* Custom styles */
        h1.text-3xl.vouch-title {
            color: <?php echo $titleTextColor; ?>;
            font-size: 1.875rem;
            font-weight: bold;
        }

        .vouch-accent {
            color: <?php echo $primaryColor; ?>;
        }

        .custom-table {
            background-color: <?php echo $tableColor; ?>;
        }

        .custom-table th,
        .custom-table td {
            border: 1px solid rgba(218, 171, 45, 0.3);
            color: #fff;
        }

        .custom-table th {
            background-color: <?php echo $tableColor; ?>;
            font-weight: bold;
        }

        .custom-table tr {
            height: 48px;
            background-color: rgba(0, 0, 0, 0.8); /* Slightly transparent background color */
        }

        /* Prevent color change on hover */
        .custom-table tr:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        /* Hyperlink styles */
        .discord-link {
            color: <?php echo $primaryColor; ?>;
            text-decoration: none;
        }

        .discord-link:hover {
            text-decoration: underline;
        }

        /* Set the maximum height of the table to the viewport height minus the border distance */
        @media (min-height: 600px) {
            .custom-table {
                max-height: calc(100vh - 200px); /* Adjust the value to control the border distance */
                border-bottom: 2px dotted <?php echo $primaryColor; ?>;
                padding-bottom: 20px;
            }
        }
      ::-webkit-scrollbar {
          width: 10px;
      }
      
        ::-webkit-scrollbar-thumb {
            background: <?php echo $scrollbarColor; ?>;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: <?php echo $scrollbar_hover_color; ?>;
        }
          *:focus {
              outline: none !important;
          }
    </style>
</head>

<body style="overflow: auto;">
    <div id="stars-group-1"></div>
    <div id="stars-group-2"></div>
    <div id="stars-group-3"></div>
    <div id="stars-group-4"></div>
    <div id="stars-group-5"></div>
    <div id="stars-group-6"></div>
    <div class="container mx-auto px-4 py-10">
        <div class="information text-left my-8">
            <div class="about">
                <h1 class="text-3xl vouch-title mb-2"><?php echo $yourname ?>'s Vouch Website</h1>
                <p class="text-white">Here are all the vouches I have received on my <b><a class="discord-link" href="<?php echo $discordServerLink; ?>" target="_blank">Discord Server</a></b>.</p>
            </div>

            <div class="contact">
            </div>

            <div class="vouches mt-4">
                <p class="font-bold text-white">Total Vouches: <span class="vouch-accent"><?php echo $vouch_count; ?></span></p>
            </div>

        </div>

        <div style="overflow:hidden;">
            <table class="table table-striped bg-gray-800 rounded-lg w-full custom-table">
                <thead>
                    <tr class="bg-daab2d">
                        <th class="w-1/6 text-center">Vouch ID</th>
                        <th class="w-1/6 text-center">Discord Tag</th>
                        <th class="w-1/6 text-center">Discord ID</th>
                        <th class="w-2/6 text-center">Vouch Message</th>
                        <th class="w-1/6 text-center">Date</th>
                    </tr>
                </thead>
                <tbody>
                <!-- rows -->
                    <?php
                       // Loop through the vouches and generate table rows
                    foreach ($vouches as $vouch) {
                        $vouch_id = $vouch['vouch_id'];
                        $discord_tag = $vouch['discord_tag'];
                        $discord_id = $vouch['discord_id'];
                        $vouch_content = $vouch['vouch_content'];
                        $date = $vouch['date'];
                        echo '<tr>';
                        echo '<td class="text-center" data-title="Vouch ID">' . $vouch_id . '</td>';
                        echo '<td class="text-center" data-title="Discord Tag">' . $discord_tag . '</td>';
                        echo '<td class="text-center" data-title="Discord ID">' . $discord_id . '</td>';
                        echo '<td class="text-center" data-title="Vouch"><span title="Message ID: ' . $vouch_content['message_id'] . '">' . $vouch_content['content'] . '</span></td>';
                        echo '<td class="text-center" data-title="Date">' . $date . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>
</body>

</html>
