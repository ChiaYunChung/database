<?php
require_once('db/noun.php');
require_once('db/relation.php');
require_once('db/family.php');

$n = htmlspecialchars($_POST['n']);
$exp = htmlspecialchars($_POST['exp']);
$str = "";

Noun::create($n, $exp);
if(isset($_POST['other_f']))
{
    if(!empty($_POST['other_f']))
    {
        $other_f = $_POST['other_f'];
        Family::create($other_f);
        if(Relation::find_f($n, array($other_f)))
        {
            $str = $str . ' ' . $other_f;
        }
        else Relation::create_f($other_f, $n);
    }
    else echo '未選擇新增項目';
}

if(isset($_POST['fam']))
{
    if(!empty($_POST['fam']))
    {
        foreach($_POST['fam'] as $f)
        {
            if(Relation::find_f($n, array($f)))
            {
                $str = $str . ' ' . $f;
            }
            else Relation::create_f($f, $n);
        }
    }
}
else
{
    if(empty($_POST['other_f']))
    {
        header('location: view.php?n='.$n.'&exp='.$exp.'&alert=未選擇相關');
        return;
    }
}
header('location: view.php?n='.$n.'&exp='.$exp.'&dup='.$str);