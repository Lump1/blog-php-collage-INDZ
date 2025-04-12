<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./frontend/styles.css">
    <script src="./frontend/index.js"></script>
</head>
<body>
    <header>
        <!-- <img class="header-image" src="./assets/MEM-Cho.1024.3943042.webp" /> -->
        <p class="header-logo">
            LumpiPhosphate
        </p>
        <div class="links">
            <a class="link">Link1</a>
            <a class="link">Link2</a>
            <a class="link">Link3</a>
            <a class="link">Link4</a>
        </div>
    </header>
    <main>
        <?php 
        
        include("pageTemplate.php");
        echo '<div class="blog-container">';
    
        echo getTemplateWithManyDataFilled(
            ["ID" => 1,
                            "POSTTITLE" => "First post", 
                            "POSTTEXT" => "Some Text here, it would be long, so i should write a little to check if all is aoing to be great", 
                            "POSTLINK" => "https://music.youtube.com/watch?v=Nzm6QNXMLms&list=RDAMVMQTr_FEtGWl8",
                            "LIKESCOUNT" => 100,
                            "ISLIKEDSRC" => "./assets/heart.png",
                            "ISLIKED" => "false"], 
            "post");

        echo getTemplateWithManyDataFilled(
            ["ID" => 2,
                            "POSTTITLE" => "Second post", 
                            "POSTTEXT" => "Some Text here, it would be long, so i should write a little to check if all is aoing to be great", 
                            "POSTLINK" => "https://music.youtube.com/watch?v=Nzm6QNXMLms&list=RDAMVMQTr_FEtGWl8",
                            "LIKESCOUNT" => 254,
                            "ISLIKEDSRC" => "./assets/heart-full.png",
                            "ISLIKED" => "true"], 
            "post");

        echo "</div>"

        ?>
    </main>
    <footer>

    </footer>

    <script>
        loadScripts();
    </script>
</body>
</html>