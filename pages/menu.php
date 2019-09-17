<ul class="nav nav-pills">
    <?php $page=isset($_GET['page'])?$_GET['page']:1;?>
    <li<?= ($page==1)?' class="active"':''?> >
        <a href="index.php?page=1">Tours</a>
    </li>
    <li<?= $page==2?' class="active"':''?> >
        <a href="index.php?page=2">Comments</a>
    </li>
    <li<?= $page==3?' class="active"':''?> >
        <a href="index.php?page=3">Registration</a>
    </li>
    <li<?= $page==4?' class="active"':''?> >
        <a href="index.php?page=4">Admin Forms</a>
    </li>
</ul>