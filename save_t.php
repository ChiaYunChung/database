<?php
require_once('db/noun.php');
require_once('db/relation.php');
require_once('db/tag.php');

$n = htmlspecialchars($_POST['n']);
$exp = htmlspecialchars($_POST['exp']);
$str = "";

Noun::create($n, $exp);
if(isset($_POST['other_t']))
{
    if(!empty($_POST['other_t']))
    {
        $other_t = $_POST['other_t'];
        Tag::create($other_t);
        if(Relation::find_t($n, array($other_t)))
        {
            $str = $str . ' ' . $other_t;
        }
        else Relation::create_t($other_t, $n);
    }
}

if(isset($_POST['tag']))
{
    if(!empty($_POST['tag']))
    {
        foreach($_POST['tag'] as $t)
        {
            if(Relation::find_t($n, array($t)))
            {
                $str = $str . ' ' . $t;
            }
            else Relation::create_t($t, $n);
        }
    }
}
else
{
    if(empty($_POST['other_t']))
    {
        header('location: view.php?n='.$n.'&exp='.$exp.'&alert=未選擇科目');
         return;
    }
}

header('location: view.php?n='.$n.'&exp='.$exp.'&dup='.$str);