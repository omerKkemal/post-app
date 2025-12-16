<!DOCTYPE html>
<html>
<head>
    <title>Community Message</title>
</head>
<body>
    <h1>New Community Message</h1>
    <p><strong>Title:</strong> {{ $post->title }}</p>
    <p><strong>Message:</strong></p>
    <p>{{ $post->description }}</p>
    @if($post->media_url)
        <p><strong>Attachments:</strong></p>
        @foreach(explode(',', $post->media_url) as $media)
            <p><a href="{{ Storage::url($media) }}">{{ basename($media) }}</a></p>
        @endforeach
    @endif
    <p>Posted by: {{ $post->user->name ?? 'Unknown' }}</p>
</body>
</html>
