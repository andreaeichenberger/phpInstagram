<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>

<body>
    <div class="container">
        <h2>Profile <?php echo $this->d['user']->getUsername(); ?></h2>

        <?php
        $user = $this->d['user'];
        $posts = $user->getPosts();

        foreach ($posts as $p) { ?>

            <div class="card mt-2">
                <div class="card-body">
                    <img class="rounded-circle" src="public/img/photos/<?php echo $p->getUser()->getProfile() ?>" width="32" />
                    <?php echo $p->getUser()->getUsername() ?>
                </div>
                <img src="public/img/photos/<?php echo $p->getImage() ?>" width="100%" />
                <div class="card-body">

                    <div class="card-title">
                        <form action="/instagram/addLike" method="POST">
                            <input type="hidden" name="post_id" value="<?php echo $p->getId() ?>">
                            <input type="hidden" name="origin" value="profile">
                            <button type="submit" class="btn btn-danger"><?php echo $p->getLikes(); ?> Likes</button>
                        </form>
                    </div>
                    <p class="card-text"><?php echo $p->getTitle() ?></p>
                </div>
            </div>

        <?php } ?>
    </div>
</body>

</html>