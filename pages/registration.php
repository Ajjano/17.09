<h1>Registration</h1>
<?php
    if(!isset($_POST['reg_btn'])):?>
        <form action="index.php?page=3" method="post">
            <div class="form-group">
                <label>
                    Login: <input type="text" name="login" class="form-control">
                </label>
            </div>
            <div class="form-group">
                <label>
                    Password: <input type="password" name="password" class="form-control">
                </label>
            </div>
            <div class="form-group">
                <label>
                    Email: <input type="email" name="email" class="form-control">
                </label>
            </div>
            <button type="submit" class="btn-primary btn" name="reg_btn">Registration</button>
        </form>
<?php else:?>
    <?php
        if(register($_POST['login'], $_POST['password'], $_POST['email'])){
            $user_name=$_POST['login'];
            echo "<script>alert('User $login was added to db')</script>";
        }
        ?>
<?php endif;?>