<!DOCTYPE html>
<html>
<head>
	<title>Biggest Reapeated String</title>
</head>
<body>
	<style type="text/css">
		body{
			font-family: arial;
			text-align: center;
			word-break: break-word;
		}
		.main-container{
			width: 100%;
			float: left;
		}
		.main-container form,
		.container-result{
			width: 100%;
			max-width: 400px;
			margin: 0 auto;
			padding:5px 10px;
			border: 1px dashed #000;
		}
		.question-container {
		    text-align: left;
		    font-size: 14px;
		    margin: 0 auto;
		    max-width: 720px;
		    padding: 20px 0;
		}
		.main-container form input[type='text']{
			float: left;
			width: 100%;
			margin-bottom: 10px;
		}
		.container-result{
			margin-top: 10px;
			text-align: left;
		}
		.container-result p {
			font-size: 14px;
		}
		span{
			background: yellow;
		}
		label{
			font-size: 13px;
		}
	</style>
<?php
function pr($str){
  echo '<pre>';
  print_r($str);
  echo '</pre>';
}
function BiggestRepeatedString($str)
{
	if ($str == null)
		return null;

	$N = strlen($str);
	$substrings = array();

	for ($i = 0; $i < $N; $i++)
	{
		$substrings[$i] = substr($str, $i);
	}
	sort($substrings);
	// pr($substrings);
	$result = "";
	for ($i = 0; $i < $N - 1; $i++)
	{
		$lcs = BiggestCommonString($substrings[$i], $substrings[$i + 1]);

		if (strlen($lcs) > strlen($result)) // compare new result with old one and replace if the result is bigger in length
		{
			$result = $lcs;
		}
	}

	return $result;
}

function BiggestCommonString($a, $b) // will find common string from $a , $b
{
	$n = min(strlen($a), strlen($b));
	$result = "";

	for ($i = 0; $i < $n; $i++)
	{
		if ($a[$i] == $b[$i]) //if match found store in $result
			$result = $result . $a[$i];
		else
			break;
	}

	return $result;
}

function all_positions($haystack, $needle_regex, $repeat_till="") //get all positions of string occurance 
{
    preg_match_all('/' . $needle_regex . '/', $haystack, $matches, PREG_OFFSET_CAPTURE);
    return array_map(function ($v) {
        return $v[1]+1; // added +1 to index to get the desired output.
    }, $matches[0]);
}
?>

	<div class="main-container">
		<p class="question-container">
			Write a PHP program to find the biggest repeating sub-string in a string and the starting position of both sub-strings.
			<br>Example :  string : "vibinfovibrantvibrantinfovibrant"
			<br>Output : 
			<br>Biggest Repeating string : "infovibrant"
			<br>Positions : 4,22
		</p>
		<?php 
			$inputstring = isset($_POST['inputstring']) ? $_POST['inputstring'] : '';
			$highlight = isset($_POST['highlight']) ? $_POST['highlight'] : '';
		?>
		<form name="repeatStringForm" id="repeatStringForm" method="post" action="" >
			<h3>Find Biggest Repeated String</h3>
			<input type="text" name="inputstring" placeholder="Enter your repeated string" value="<?php echo $inputstring;?>">
			<label for="highlight">Do you want to highlight: </label><input type="checkbox" id="highlight" name="highlight" value="1" <?php echo $highlight?'checked':'';?>>
			<input type="submit" name="submit" value="Find biggest repeated string">
		</form>
		<?php 
		if(!empty($inputstring)){ 
			$result = BiggestRepeatedString($inputstring);
    		if($highlight){ 
    			$highlightResult = str_replace($result,'<span>'.$result.'</span>',$inputstring);
    		}
			$finalResult = isset($highlightResult)? $highlightResult : $inputstring;
			?>
		<div class="container-result">
			<h4>Result:</h3>
			<p><b>Your input string:</b> <?php echo $finalResult;?></p>
			<p><b>Biggest Repeated String:</b> <?php echo $result ?:'No Repeated string found';?></p>
			<?php if($result){ ?><p><b>Positions:</b> <?php echo implode(',', all_positions($inputstring, $result));?></p><?php } ?>
		</div>
		<?php } 
	
    
		?>
	</div>
</body>
</html>