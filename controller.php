<?php 

if(isset($_GET["page"]))
{
    if($_GET["page"] == "home" )
    {
        include("homeContent.php");

    }
    elseif ($_GET["page"] == "add")
    {
        include("ouvrageAdd.php");
    }
}
else
{
    include("homeContent.php");

}

?>