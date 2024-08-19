<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>dictionary.php</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<div class="container">
    <nav class="navbar navbar-light bg-light" style="margin:50px 0px;">
        <div class="container-fluid">
        <span class="navbar-brand mb-0 h1"> <a href="view.php"><b>🏡 名詞與它的解釋</b></a></span>
        </div>
    </nav>
    <nav style="margin:20px 0px;">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h3"><b>
                    <body>
                        <?php
                        require_once('db/noun.php');
                        $n = $_GET['n'];
                        $exp = Noun::find_by_value($n);
                        $exp = $exp['exp'];
                        echo $n;
                        ?>
                </b></span>
        </div>
    </nav>
    <form method="post" action="save_n.php">
        <table class="table table-bordered  table-hover">
            <tr>
                <th>
                    名詞
                </th>
                <th>
                    解釋
                </th>
                <th>
                </th>
            </tr>
            <?php
            echo '<tr>';
            echo '<td>';
            echo $n;
            echo '</td>';
            echo '<td>';
            echo '<textarea class="form-control" name="exp" rows="6" cols="50">' . $exp . '</textarea>';
            echo '</td>';
            echo "<td>";
            echo '<button type="submit" class="btn btn-primary">送出</button>';
            echo "</td>";
            echo "</tr>";
            echo '<input type="hidden" name="n" value="' . $n . '">';
            ?>
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