<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="./frontend/styles.css?v=<?php echo time(); ?>">
    <script src="./frontend/index.js?v=<?php echo time(); ?>"></script>
</head>
<body>
    <header>
        <!-- <img class="header-image" src="./assets/MEM-Cho.1024.3943042.webp" /> -->
        <p class="header-logo">
            LumpiPhosphate
        </p>
        <div class="links">
            <a class="link" href="https://www.youtube.com/@lumpiphosphate"><img class="soc-media-icon" src="./assets/SocMedia/youtube.png" /></a>
            <a class="link" href="https://www.twitch.tv/lump1irl"><img class="soc-media-icon" src="./assets/SocMedia/twitch.webp" /></a>
            <a class="link" href="https://discord.com/users/lumpi_phosphat"><img class="soc-media-icon" src="./assets/SocMedia/discord.png" /></a>
            <a class="link" href="https://t.me/lumpi_qwe"><img class="soc-media-icon" src="./assets/SocMedia/telegram.webp" /></a>
        </div>
    </header>
    <main>
    <?php 
        
        include("pageTemplate.php");
        include("db_worker.php");
        echo '<div class="blog-container">';

        $likedPosts = getLikedPostsFromCookies();

        for($i = 0; $i < count($posts); $i++) {
            $isLiked = in_array($posts[$i]['id'], $likedPosts);
            $isLikedSrc = $isLiked ? './assets/heart-full.png' : './assets/heart.png';

            $templateData = [
                "ID" => $posts[$i]['id'],
                "POSTTITLE" => $posts[$i]['title'],
                "POSTTEXT" => $posts[$i]['content'],
                "POSTLINK" => $posts[$i]['link'],
                "LIKESCOUNT" => $posts[$i]['likescount'],
                "ISLIKEDSRC" => $isLikedSrc,
                "ISLIKED" => $isLiked ? "true" : "false"
            ];
            
            echo getTemplateWithManyDataFilled($templateData, "post");
        }

        echo "</div>";

    ?>

    </main>
    <footer>
        <p class="footer-text">
            © lumpiphosphate 2025
        </p>
        <a class="footer-link" href="admin.php">
            Admin panel
        </a>
    </footer>

    <script>
        loadScripts();
    </script>
</body>
</html>