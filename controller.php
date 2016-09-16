<?php

$codefile = tempnam(__DIR__.'/temp', 'source');
@rename($codefile, $codefile.'.c');

$codefile .= '.c';
$exefile = 'prog.exe';
$errorfile = 'error-output.txt';

file_put_contents($codefile, $_REQUEST['c_code']);

$output_gcc = shell_exec('gcc '.escapeshellarg($codefile).' -o '.escapeshellarg('temp/'.$exefile).'2>&1');

if ($output_gcc !== NULL) {

  echo '<pre>'.htmlspecialchars($output_gcc, ENT_QUOTES).'</pre>';

} else {

  $stdin = $_REQUEST['stdin'];

  $descriptorspec = [
    ['pipe', 'r'],
    ['pipe', 'w'],
    ['file', 'temp/'.$errorfile, 'a']
  ];

  $process = proc_open($exefile, $descriptorspec, $pipes, __DIR__.'/temp');

  if (is_resource($process)) {
    fwrite ($pipes[0], $stdin);
    fclose ($pipes[0]);

    echo stream_get_contents($pipes[1]);
    fclose ($pipes[1]);

    $return_value = proc_close($process);

    if (!$return_value) echo file_get_contents('temp/'.$errorfile);
  }
  
  unlink('temp/'.$exefile);
  unlink('temp/'.$errorfile);
}

unlink($codefile);

