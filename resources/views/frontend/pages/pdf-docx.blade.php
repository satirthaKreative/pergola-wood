<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Document</title>
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
	</head>
	<body style="max-width: 760px; margin: 0 auto;">
	    <table style="width: 100%;">
			<tr>
				<td style="background: #7a9739; padding: 20px;"></td>
			</tr>
			<tr>
				<td>
					<h3 style="    font-family: 'Open Sans', sans-serif;
					font-size: 25px;
					letter-spacing: 0;
					border-bottom: 2px solid #333;
					padding: 0 0 8px;
					margin-bottom: 11px;">Custom Pergola Builder</h3>
					<a style="    font-family: 'Open Sans', sans-serif;
						color: #999;
						text-decoration: none;
						font-size: 14px;
					font-weight: 600;" href="http://custompergolabuilder.com/">custompergolabuilder.com</a>
				</td>
			</tr>
			<tr>
				<td>
					<h4  style="font-family: 'Open Sans', sans-serif;
					font-size: 18px;
					letter-spacing: 0;
					border-bottom: 2px solid #333;
					padding: 0 0 8px;
					margin-top: 45px;
					margin-bottom: 11px;">View Your Pergola</h4>
				</td>
			</tr>
			<tr>
					<td class="" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;background: #fff;font-size: 15px;
                        font-family: 'Lato', sans-serif;line-height: 24px; padding: 10px 38px;text-align: justify;text-align: center;">
                        <p  style="padding: 27px 0; display: block;"><img border="0" class="banner" alt="banner" src="{{ $image_data }}" style="display: inline-block; -ms-interpolation-mode: bicubic;border: none !important;height: auto;line-height: 100%;outline: none;text-decoration: none;width: 600px;"></p>
                        
                    </td>							
			</tr>
					<table style="width: 100%;     margin: 0 0 60px;">
						
						<tr>
							<td style="width: 50%;">
								<p style="font-family: 'Open Sans', sans-serif;font-size: 20px;">Selected Pergola:</p>
								<p style="font-family: 'Open Sans', sans-serif;font-size: 20px;">Width is: {{ $master_width_length }}px</p>
								<p style="font-family: 'Open Sans', sans-serif;font-size: 20px;">Length is: {{ $master_height_length }}px</p>
								<p style="font-family: 'Open Sans', sans-serif;font-size: 20px;">Post Length is: {{ $piller_length }} ft</p>
								<p style="font-family: 'Open Sans', sans-serif;font-size: 20px;">Overhead Shade is: {{ $overhead_shades }}</p>
								
							</td>
							<td style="width: 50%;">
								<p style="font-family: 'Open Sans', sans-serif;font-size: 20px;">Mount Bracket: {{ $mount_count }}</p>
								<p style="font-family: 'Open Sans', sans-serif;font-size: 20px;">Retactable Canopy: {{ $final_canopy_type }}</p>
								<p style="font-family: 'Open Sans', sans-serif;font-size: 20px;">Louvered Panel: {{ $final_lpanel_type }}</p>
								<p style="font-family: 'Open Sans', sans-serif;font-size: 20px;">Final Price: $ {{ $final_price }}</p>
							</td>
						</tr>
					</table>
				
			<tr>
				<td style="background-color: #555555; padding: 0;"><p style="color: #fff;font-family: 'Open Sans', sans-serif; text-align: center;">© COPYRIGHT 2021 PERGOLA BUILDER</p></td>
			</tr>
		</table>
		
	</body>
</html>