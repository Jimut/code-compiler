<?php

  // do {
  $tempfile = tempnam('/temp', 'source');
  // }while(!@rename($tempfile, $tempfile.'.c'));
  @rename($tempfile, $tempfile.'.c');

  $tempfile .= '.c';
  $exefile = 'test.o';

  file_put_contents($tempfile, $_REQUEST['c_code']);

  // invoke GCC
  $output = shell_exec('gcc '.escapeshellarg($tempfile).' -o '.escapeshellarg($exefile));
  // set sticky bit
  // $output.= shell_exec('sudo +s '.escapeshellarg($exefile)); // I need to set this on my server
  // run the created program
  $output .= shell_exec(escapeshellarg($exefile));

  echo '<pre>'.htmlspecialchars($output,ENT_QUOTES).'</pre>';

  unlink($tempfile);
