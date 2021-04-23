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
				<td style="background: #7a9739; padding: 20px;"><a href="#" style="display: table;width: 100%;text-align: center;
				"><img src="http://pergola.previewforclient.com//frontend/images/logo.png" alt=""></a></td>
			</tr>
			<tr>
				<td>
					<h4 style="    font-family: 'Open Sans', sans-serif;
						color: #999;
						text-decoration: none;
						font-size: 14px;
					font-weight: 600;">{{ $data['new_useremail'] }} sent you an article</h4>
					<p style="font-family: 'Open Sans', sans-serif;">{{ $data['new_usercomment'] }}</p>
					<h3 style="    font-family: 'Open Sans', sans-serif;
					font-size: 25px;
					letter-spacing: 0;
					border-bottom: 2px solid #333;
					padding: 0 0 8px;
					margin-bottom: 11px;">Custom Pergola Builder</h3>
					<p style="font-family: 'Open Sans', sans-serif;">Custom Builder Product width : {{ $data['master_width_length'] }}, length : {{ $data['master_height_length'] }}, overhead shades : {{ $data['overhead_shades'] }}, piller length : {{ $data['piller_length'] }}, pick mount type : {{ $data['mount_count'] }}, pick canopy type : {{ $data['final_canopy_type'] }}, Total Price : {{ $data['final_price'] }}</p>
				</td>
			</tr>
			<tr>
				<td style="background-color: #555555; padding: 0;"><p style="color: #fff;font-family: 'Open Sans', sans-serif; text-align: center;">© COPYRIGHT 2021 PERGOLA BUILDER</p></td>
			</tr>
		</table>
	</body>
</html>