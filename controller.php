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
    elseif ($_GET["page"] == "loginCheck")
    {
        include("loginContentCheck.php");
    }
    elseif ($_GET["page"] == "list")
    {
        include("bookList.php");
    }
    elseif ($_GET["page"] == "detail")
    {
        include("bookDetails.php");
    }
}
else
{
    include("homeContent.php");

}

?>