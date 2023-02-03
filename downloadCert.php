<?
  $out_dir='fssp_cer';
  @mkdir($out_dir);
  $site = 'https://uc.fssp.gov.ru';
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
        echo "try - $u:\n";
        $fn=basename($u);
        if(strpos($u,'http')===false) $u=$site.$u;
        echo "Download $u --> to: $out_dir/$fn\n";
        if($t=file_get_contents($u))
          {
           file_put_contents("$out_dir/$fn",$t);
          }
       }
    }
?>
