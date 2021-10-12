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
    elseif ($_GET["page"] == "login")
    {
        include("loginContent.php");
    }
}
else
{
    include("homeContent.php");

}

?>