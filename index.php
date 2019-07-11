<?php include "newscontroller.php"; ?>


<!DOCTYPE html>
<html>
  <head>
  <title>News</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <style>
      #comments{
        margin-left: 20px;
      }

      label{
        font-weight: bold;
        margin-top: 10px;
      }

      .btn-danger{
        float: right;
      }
  </style>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">
                <form action="newscontroller.php" method="post">
                    <label>Title:</label>
                    <input class="form-control" name="title" type="text" placeholder="PHP is Awesome">
                     <label>Body:</label>
                    <textarea class="form-control mt-1" rows="3" name="body"></textarea>
                    <input type="submit" class="btn btn-primary mt-2" name="submit" value="Save">
                </form>
            </div>
        </div>
        <hr>
        <h3>News Articles</h3>
        <div class="row">
            <?php
                $news = $obj->fetchRecord("news");
                foreach ($news as $article) {?>
                <div class="col-md-4 my-3">
                    <h4><?php echo $article["title"]; ?> <a href="newscontroller.php?delete=1&id=<?php echo $article["id"]; ?>" class="btn btn-danger btn-sm">Delete</a></h4>
                    <p><?php echo $article["body"]; ?></p>

                    <div id="comments">
                        <?php
                            $comments = $obj->fetchRecord("comment");
                            foreach ($comments as $comment) {

                                if($comment['news_id'] == $article['id'] ){?>

                                <p><?php echo $comment["body"]; ?></p>
                        <?php
                                }
                            }
                        ?>

                        <form action="newscontroller.php" method="post">
                            <input type="hidden" name="news_id" value="<?php echo $article['id']; ?>">
                            <input type="text" name="body" placeholder="Write Comment" class="form-control">
                            <input type="submit" class="btn btn-primary mt-2" name="createcomment" value="Add">
                        </form>
                    </div>
                </div>
            <?php
                }
            ?>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  </body>
</html>
