<?php
require_once('db/noun.php');
require_once('db/tag.php');
require_once('db/family.php');
require_once('db/relation.php');
if(isset($_GET['n']))
{
    
    //Noun::delete($n);
    if(isset($_GET['t']))
    {
        $n = $_GET['n'];
        //Relation::delete_t($t);
        $t = $_GET['t'];
        Relation::delete_tr($t,$n);
        if(Relation::find_by_value_t($n)!=false && Relation::find_by_value_f($n)!=false)
        {
            Noun::delete($n);
        }
        
        /*if(Relation::find_by_value_t($n)==false && Relation::find_by_value_t($n)==false)
        {
            //Noun::delete($n);
            print('刪名詞');
        }*/
        
        header('location: tag_show.php?tag='.$_GET['t']);
        return;
    }
    else if(isset($_GET['f']))
    {
        $n = $_GET['n'];
        $f = $_GET['f'];
        Relation::delete_fr($f,$n);
        if(Relation::find_by_value_t($n)!=false && Relation::find_by_value_f($n)!=false)
        {
            Noun::delete($n);
        }
        header('location: tag_show.php?family='.$_GET['f']);
        return;
    }
}
else if(isset($_GET['t']))
{
    $t = $_GET['t'];
    Tag::delete($t);
    //Relation::delete_t($t);
    //header('location: tag_show.php?tag='.$_GET['t']);
    //return;
}
else if(isset($_GET['f']))
{
    $f = $_GET['f'];
    Family::delete($f);
    //Relation::delete_f($f);
    //header('location: tag_show.php?family='.$_GET['f']);
    //return;
}

/*if(isset($_GET['t']))
{
    //$n = $_GET['n'];
    $t = $_GET['t'];
    Relation::delete_t($t);
}*/

header('location: view.php');