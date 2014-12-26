<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
</head>
<body>
	<div>
		<p>
            Сообщение от @if($name) {{ $name }} @endif @if($email) &lt;{{ $email }}&gt; @endif
		</p>
		<p>
			Текст сообщения:
		</p>
		<p>
			{{ Helper::nl2br($text) }}
		</p>
	</div>
</body>
</html>