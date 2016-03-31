<?php

  $tempfile = tempnam('', 'source');
  @rename($tempfile, $tempfile.'.c');

  $tempfile .= '.c';
  $exefile = 'test.o';

  file_put_contents($tempfile, $_REQUEST['c_code']);

  // invoke GCC
  $output = shell_exec('gcc '.escapeshellarg($tempfile).' -o '.escapeshellarg($exefile));

  // run the created program
  $output .= shell_exec(escapeshellarg($exefile));

  echo '<pre>'.htmlspecialchars($output,ENT_QUOTES).'</pre>';

  unlink($tempfile);
