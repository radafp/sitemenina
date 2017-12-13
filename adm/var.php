<?php
session_start();
header('Content-Type: text/html; charset=UTF-8', true);



echo "<pre>"; 
echo "SESSION - ";
print_r($_SESSION);
echo "</pre>";

/*
echo "<pre>"; 
echo "COOKIE - ";
print_r($_COOKIE);
echo "</pre>";

echo "<pre>";
echo "SERVER - "; 
print_r($_SERVER);
echo "</pre>";
*/
/*
//setlocale(LC_ALL, 'pt_BR');
setlocale(LC_NUMERIC, 'en_US'); // setting the numeric locale to
setlocale(LC_MONETARY, 'en_US'); // setting the monetary locale to

$locale_info = localeconv();

echo "<pre>\n";
echo "--------------------------------------------\n";
echo "  Monetary information for current locale:  \n";
echo "--------------------------------------------\n\n";

echo "int_curr_symbol:   {$locale_info["int_curr_symbol"]}\n";
echo "currency_symbol:   {$locale_info["currency_symbol"]}\n";
echo "mon_decimal_point: {$locale_info["mon_decimal_point"]}\n";
echo "mon_thousands_sep: {$locale_info["mon_thousands_sep"]}\n";
echo "positive_sign:     {$locale_info["positive_sign"]}\n";
echo "negative_sign:     {$locale_info["negative_sign"]}\n";
echo "int_frac_digits:   {$locale_info["int_frac_digits"]}\n";
echo "frac_digits:       {$locale_info["frac_digits"]}\n";
echo "p_cs_precedes:     {$locale_info["p_cs_precedes"]}\n";
echo "p_sep_by_space:    {$locale_info["p_sep_by_space"]}\n";
echo "n_cs_precedes:     {$locale_info["n_cs_precedes"]}\n";
echo "n_sep_by_space:    {$locale_info["n_sep_by_space"]}\n";
echo "p_sign_posn:       {$locale_info["p_sign_posn"]}\n";
echo "n_sign_posn:       {$locale_info["n_sign_posn"]}\n";
echo "</pre>\n";

*/

if(isset($_GET['c']))
    session_destroy();
?>
