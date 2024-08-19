<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>dictionary.php</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-light bg-light" style="margin:50px 0px;">
            <div class="container-fluid">
            <span class="navbar-brand mb-0 h1"> <a href="view.php"><b>🏡 名詞與它的解釋</b></a></span>
            </div>
        </nav>
        <nav style="margin:20px 0px;">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h3"><b>
                        <?php
                        if (isset($_GET['tag']))
                            echo '▍&nbsp;&nbsp;'.$_GET['tag'];
                        else if (isset($_GET['family']))
                            echo '▍&nbsp;&nbsp;'.$_GET['family'];
                        ?>
                    </b></span>
            </div>
        </nav>
        <table class="table table-bordered  table-hover">
            <tr>
                <th>
                    名詞
                </th>
                <th>
                    解釋
                </th>
                <th colspan='2'>
                    功能
                </th>
            </tr>
            <?php
            require_once('db/noun.php');
            if (isset($_GET['tag'])) {
                $tag = Noun::show_tn($_GET['tag']);
                if ($tag) {
                    foreach ($tag as $t) {
                        echo "<tr>";
                        echo "<td>";
                        echo $t['value'];
                        echo "</td>";
                        echo "<td>";
                        echo $t['exp'];
                        echo "</td>";
                        echo "<td  colspan='2'>";
                        echo '<a href="edit.php?n=' . $t['value'] . '&t='.$_GET['tag'].'">';
                        echo '<button class="btn btn-primary">修改</button>';
                        echo '<a href="delete.php?n=' . $t['value'] . '&t='.$_GET['tag'].'">';
                        echo '<button class="btn btn-danger">刪除</button>';
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr>";
                    echo "<td colspan='3'>";
                    echo "沒有內容";
                    echo "</td>";
                    echo "</tr>";
                    echo "</table>";
                    echo '<a href="delete.php?t=' . $_GET['tag'] . '">';
                    echo '<button class="btn btn-primary">刪除科目</button></a><br><br>';
                }
            } else if (isset($_GET['family'])) {
                $family = Noun::show_fn($_GET['family']);
                if ($family) {
                    foreach ($family as $f) {
                        echo "<tr>";
                        echo "<td>";
                        echo $f['value'];
                        echo "</td>";
                        echo "<td>";
                        echo $f['exp'];
                        echo "</td>";
                        echo "<td colspan='2'>";
                        echo '<a href="edit.php?n=' . $f['value'] . '&f='.$_GET['family'].'">';
                        echo '<button class="btn btn-primary">修改</button></a>';
                        echo '<a href="delete.php?n=' . $f['value'] . '&f='.$_GET['family'].'">';
                        echo '<button class="btn btn-danger">刪除</button></a>';
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr>";
                    echo "<td colspan='3'>";
                    echo "沒有內容";
                    echo "</td>";
                    echo "</tr>";
                    echo "</table>";
                    echo '<a href="delete.php?f=' . $_GET['family'] . '">';
                    echo '<button class="btn btn-primary">刪除相關</button></a><br><br>';
                }

            }

            ?>

        </table>
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