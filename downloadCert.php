<?
  $out_dir='fssp_cer';
  @mkdir($out_dir);
  $site = 'https://fssp.gov.ru';
  $url = "$site/sertif/";
  $html = file_get_contents($url);#extension=php_openssl.dll
  #var_dump($html);
  $doc = new DOMDocument();
  @$doc->loadHTML($html);
  $xpath = new DOMXpath($doc);
  $nodes = $xpath->query('//a');

  foreach($nodes as $node)
    {
     $u=$node->getAttribute('href');
     if((strpos($u,'.cer'))or(strpos($u,'.crl')))
       {
        $fn=basename($u);
        echo "Download $site$u --> to: $out_dir/$fn\n";
        if($t=file_get_contents($site.$u))
          {
           file_put_contents("$out_dir/$fn",$t);
          }
       }
    }
?>