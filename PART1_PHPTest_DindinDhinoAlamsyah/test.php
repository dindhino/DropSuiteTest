<html>
	<body>
		Directory: <?php echo $_POST["dirr"]; ?>
		<br></br>
		<?php
			function getFiles($dir, &$results = array()){
				$files = scandir($dir);
				foreach($files as $key => $value){
					//get path nya
					$path = realpath($dir.DIRECTORY_SEPARATOR.$value);
					//cek pathnya file atau folder
					if(!is_dir($path)) {
						//ambil filenya
						$results[] = $path;
					} else if($value != "." && $value != "..") {
						//kalau folder, lakuin rekursif
						getFiles($path, $results);
					}
				}
				return $results;
			}		

			function getContents($files, &$results = array()) {
				foreach($files as $key => $value) {
					$content = file_get_contents($value, true);	
					if (empty($results)) {
						$results[$content] = 1;
					} else if (array_key_exists($content, $results)) {
						$results[$content]++;
					} else {
						$results[$content] = 1;
					}
				}
				return $results;
			}
			
			function getMaxSameContent($contents){
				$content = '';
				$num = 0;
				foreach($contents as $key => $value) {
					if ($value>$num) {
						$content = $key;
						$num = $value;
					}
				}
				echo $content;
				echo " ";
				echo $num;
			}
			
			$files = getFiles($_POST["dirr"]);
			$contents = getContents($files);
			getMaxSameContent($contents);
		?>
	</body>
</html>