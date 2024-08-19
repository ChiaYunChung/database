<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>dictionary.php</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<?php
if(isset($_GET['dup'])&&isset($_GET['n']))
{
    if(!($_GET['dup']===''))
        echo '<script>alert("'.$_GET['n'].' 已經存在 '.$_GET['dup'].' 中，加入失敗！")</script>'; 
}
if(isset($_GET['alert']))
echo '<script>alert("'.$_GET['alert'].' ，請至少選擇一項！")</script>'; 
?>
<body>
    <div class="container">
        <nav class="navbar navbar-light bg-light" style="margin:50px 0px;">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1"> <a href="view.php"><b>🏡 名詞與它的解釋</b></a></span>
            </div>
        </nav>
        <form method="post" action="save_t.php">
            <table class="table table-bordered  table-hover">
                <tr>
                    <th>
                        名詞
                    </th>
                    <td colspan="2">
                        <input class="form-control" name="n" type="text" size="46" required
                        value="<?php
                            if (isset($_GET['n']))
                                echo $_GET['n'];
                            ?>">
                        </input>
                    </td>
                </tr>
                <tr>
                    <th>
                        解釋
                    </th>
                    <td colspan="2">
                        <textarea class="form-control" name="exp" rows="6" cols="50"  required><?php
                            if (isset($_GET['exp']))
                                echo $_GET['exp'];
                            ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th>
                        科目
                    </th>
                    <td>

                        <?php
                        require_once('db/tag.php');
                        $all = Tag::show();
                        foreach ($all as $a) {
                            $name = $a['name'];
                            echo '<div class="form-check form-check-inline">';
                            echo '<input class="form-check-input" type="checkbox" id="flexCheck'.$name.'" name="tag[]" value="' . $name . '"> ';
                            echo '<label class="form-check-label" for="flexCheck'.$name.'">' . $name . ' </label>';
                            echo '</div>';
                        }
                        ?>
                        <label class="form-input-label" for="other"></label> 其他 <input type="text" name="other_t"
                            id="other">

                    </td>
                    <td>
                        <button type="submit" class="btn btn-primary">選擇</button>
                    </td>
                </tr>
                <tr>
                    <th>
                        相關
                    </th>
                    <td>
                        <?php
                        require_once('db/family.php');
                        $all = Family::show();
                        foreach ($all as $a) {
                            $name = $a['name'];
                            echo '<div class="form-check form-check-inline">';
                            echo '<input class="form-check-input" type="checkbox" id="flexCheck'.$name.'" name="fam[]" value="' . $name . '">';
                            echo '<label class="form-check-label" for="flexCheck'.$name.'">' . $name . '</label>';
                            echo '</div>';
                        }
                        ?>
                        <label class="form-input-label" for="otherf"> 其他 <input type="text" name="other_f"
                                id="otherf"></label>
                    </td>
                    <td>
                        <button type="submit" formaction="save_f.php" class="btn btn-primary">選擇</button>
                    </td>
                </tr>
            </table>

        </form>
        <?php
        require_once('db/tag.php');
        require_once('db/family.php');
        $tag = Tag::show();
        echo '<br>科目 ︱ &nbsp;&nbsp;';
        foreach ($tag as $t) {
            $name = $t['name'];
            echo '<a href="tag_show.php?tag=' . $name . '">' . $name . '</a>' . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        }
        echo '<br><br>相關 ︱ &nbsp;&nbsp;';
        $family = Family::show();
        foreach ($family as $f) {
            $name = $f['name'];
            echo '<a href="tag_show.php?family=' . $name . '">' . $name . '</a>' . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        }
        ?>
    </div>
</body>

</html>