<?
include('header.php');
include('random.php');

for ($i=1; $i<=5; $i++)
{
    echo rand_string(10); echo "<br>\n";
}
include('footer.php');
?>


