<?php
//die;
if(isset($_POST['add_country'])){
    $country=trim(htmlspecialchars($_POST['country']));
    if($country==='') {
        echo "<script>window.location='index.php?page=4'</script>";
        return;
    }
    $ins="insert into countries (country) VALUES ('$country')";
    connect();
    mysql_query($ins);
    $message="<span class='alert alert-success'>Country was added successfully</span>";
}

if(isset($_POST['del_countries'])){
    connect();
    foreach ($_POST['indexes'] as $id){
        $del="delete from countries where id =$id";
        mysql_query($del);
        $message="<span class='alert alert-warning'>Country(s) was deleted successfully</span>";
    }
}

if(isset($_POST['add_city'])){
    $city=trim(htmlspecialchars($_POST['city']));
    if($city==='') {
        echo "<script>window.location='index.php?page=4'</script>";
        return;
    }
    $index=$_POST['country_id'];
    $ins_cities="insert into cities (city, country_id) VALUES ('$city',$index)" ;
    connect();
    mysql_query($ins_cities);
    $message_city="<span class='alert alert-success'>City was added successfully</span>";
}

if(isset($_POST['del_cities'])){
    connect();
    $index=$_POST['country_id'];
    foreach ($_POST['indexes'] as $id){
        $del="delete from cities where id =$id";
        mysql_query($del);
        $message_city="<span class='alert alert-warning'>Country(s) was deleted successfully</span>";
    }
}

if(isset($_POST['add_hotel'])){
    $hotel=trim(htmlspecialchars($_POST['hotel']));
    $stars=trim(htmlspecialchars($_POST['stars']));
    $price=trim(htmlspecialchars($_POST['price']));
    $info=trim(htmlspecialchars($_POST['info']));
    if($hotel===''||$stars===''||$price===''||$info==='') {
        echo "<script>window.location='index.php?page=4'</script>";
        return;
    }
    $index_country=explode(':', $_POST['city_country_index'])[1];
    $index_city=explode(':', $_POST['city_country_index'])[0];
    $ins_hotels="insert into hotels (hotel, city_id, country_id, stars, price, info ) VALUES ('$hotel',$index_city, $index_country,$stars,$price,'$info')";
    connect();
    mysql_query($ins_hotels);
    $message_hotel="<span class='alert alert-success'>Hotel was added successfully</span>";
}

if(isset($_POST['del_hotels'])){
    connect();
    foreach ($_POST['indexes'] as $id){
        $del="delete from hotels where id =$id";
        mysql_query($del);
        $message_hotel="<span class='alert alert-warning'>Hotels(s) was deleted successfully</span>";
    }
}
?>
<h1>Admin Panel</h1>
<div class="row">
    <div class="col-md-6">
<!--        section A: for form countries-->
        <form action="index.php?page=4" method="post">
            <div class="panel panel-primary">
                <div class="panel-heading"><h3>Form countries</h3></div>
                <div class="panel-body">
                    <?php
                    connect();
                    $sel='select * from countries';
                    $countries_res=mysql_query($sel);
                    ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Country</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row=mysql_fetch_array($countries_res)):?>
                        <tr>
                            <td><?=$row['id']?></td>
                            <td><?php echo $row['country']?></td>
                            <td><input type="checkbox" name="indexes[]" value="<?= $row['id']?>"></td>
                        </tr>
                        <?php endwhile;?>
                        </tbody>
                    </table>
                    <div class="form-group">
                        <label>
                            Country title <input class="form-control" type="text" name="country" placeholder="Enter a country">
                        </label>
                    </div>
                </div>
                <div class="panel-footer">
                    <button class="btn btn-primary" type="submit" name="add_country">Add</button>
                    <button class="btn btn-danger" type="submit" name="del_countries">Delete</button>
                    <?= $message?:''?>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-6">
<!--        section A: for form cities-->
        <form action="index.php?page=4" method="post">
            <div class="panel panel-success">
                <div class="panel-heading"><h3>Form cities</h3></div>
                <div class="panel-body">
                    <?php
                    connect();
                    $sel_table='select cities.id, cities.city, countries.country 
from cities, countries where cities.country_id=countries.id';
                    $sel_country="select * from countries";
                    $cities_res=mysql_query($sel_table);
                    $countries2_res=mysql_query($sel_country);
                    ?>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>City</th>
                            <th>Country</th>
                            <th>Option</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row=mysql_fetch_array($cities_res)):?>
                            <tr>
                                <td><?=$row['id']?></td>
                                <td><?=$row['city']?></td>
                                <td><?php echo $row['country']?></td>
                                <td><input type="checkbox" name="indexes[]" value="<?= $row['id']?>"></td>
                            </tr>
                        <?php endwhile;?>
                        </tbody>
                    </table>
                   <div class="form-group">
                       <select name="country_id" class="form-control">
                           <?php
                           while ($row=mysql_fetch_array($countries2_res)):?>
                               <option value="<?= $row['id']?>"><?=$row['country']?></option>
                           <?php endwhile;?>
                       </select>
                   </div>
                    <div class="form-group">
                        <label>
                            City title <input class="form-control" type="text" name="city" placeholder="Enter a city">
                        </label>
                    </div>
                </div>
                <div class="panel-footer">
                    <button class="btn btn-primary" type="submit" name="add_city">Add</button>
                    <button class="btn btn-danger" type="submit" name="del_cities">Delete</button>
                    <?= $message_city?:''?>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
<!--        section A: for form hotels-->
        <form action="index.php?page=4" method="post">
            <div class="panel panel-danger">
                <?php
                connect();
                $select="select cities.id, cities.city, countries.id, countries.country, hotels.id, hotels.hotel, hotels.city_id, 
                hotels.country_id, hotels.stars, hotels.price, hotels.info 
                        from cities, countries, hotels
                        WHERE cities.country_id=countries.id and hotels.city_id=cities.id";
                $sel_country_city="select cities.id, cities.city, countries.country, countries.id
                        from cities, countries
                        WHERE  cities.country_id=countries.id";
                if(isset($hotel_res)){
                    mysql_free_result($hotel_res);
                }
                $hotel_res=mysql_query($select);
                if(isset($country_city_res)){
                    mysql_free_result($country_city_res);
                }
                $country_city_res=mysql_query($sel_country_city);
                ?>
                <div class="panel-heading"><h3>Form hotels</h3></div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>City/Country</th>
                                <th>Name of hotel</th>
                                <th>Stars</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row=mysql_fetch_array($hotel_res)):?>
                            <tr>
                                <td><?=$row[4]?></td>
                                <td><?=$row[3].'/'.$row[1]?></td>
                                <td><?=$row[5]?></td>
                                <td><?=$row[8]?></td>
                                <td>
                                    <input type="checkbox" name="indexes[]" value="<?= $row[4]?>">
                                </td>
                            </tr>
                        <?php endwhile;?>
                        </tbody>
                    </table>
                    <div class="form-group">
                            <select name="city_country_index" class="form-control" >
                                <?php
                                while($row=mysql_fetch_array($country_city_res)):?>
                                    <option value="<?= $row[0].':'.$row[3]?>"><?=$row[1]?>: <?=$row[2]?></option>
                                <?php endwhile;?>
                            </select>
                        </div>
                    <div class="form-group">
                        <label>
                            Name of hotel <input class="form-control" type="text" name="hotel" placeholder="Enter a name of hotel">
                        </label>
                    </div>
                    <div class="form-group">
                        <label>
                            Stars <input class="form-control" min="1" max="5" type="number" name="stars" placeholder="Enter a stars">
                        </label>
                    </div>
                    <div class="form-group">
                        <label>
                            Price <input class="form-control" type="text" name="price" placeholder="Enter a cost">
                        </label>
                    </div>
                    <div class="form-group">
                        <label>
                            Info <textarea class="form-control" type="text" rows="3" cols="22" name="info" placeholder="Enter an info"></textarea>
                        </label>
                    </div>
                </div>
                <div class="panel-footer">
                    <button class="btn btn-primary" type="submit" name="add_hotel">Add</button>
                    <button class="btn btn-danger" type="submit" name="del_hotels">Delete</button>
                    <?= $message_hotel?:''?>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-6">
<!--        section A: for form images-->
        <div class="panel panel-warning">
            <div class="panel-heading"><h3>Form images</h3></div>
            <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium ad aliquam atque dolorem earum eius fugiat id, ipsam libero maxime natus neque obcaecati officia quidem, reprehenderit. A accusantium adipisci debitis, distinctio eveniet id ipsa maiores nobis voluptatem. At ex, sunt?</div>
            <div class="panel-footer">
                <button class="btn btn-primary">Add</button>
                <button class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>